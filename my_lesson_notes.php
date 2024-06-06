<?php $page_title = "My Lesson Note"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid'])) {
    $class_id = decrypt($_GET['cid']);
    $subj_id = decrypt($_GET['sid']);//Subject
    $term_id = decrypt($_GET['tid']);
} else {
	header("Location:view_lesson_notes");
}

//Create folder if not exist
$parentFolder = "lesson_notes";
if (!file_exists($parentFolder . '/' .str_replace(' ', '_', strtolower(getSubject($subj_id))))) {
	mkdir($parentFolder . '/' .str_replace(' ', '_', strtolower(getSubject($subj_id))), 0777, true);
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
	$week = $_POST['week'];
	$topic = $_POST['topic'];
	$year_created = date('Y');
    // Get the file information from the form
    $file = $_FILES['file'];
	
	if(empty($week)){
		$msg = 'Please Select a Week';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if(empty($topic)){
		$msg = 'Please Enter the Topic for the Week';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if(empty($file)){
		$msg = 'Please Select the File';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		// Set the target directory for the uploaded file
		$target_dir = "lesson_notes/".str_replace(' ', '_', strtolower(getSubject($subj_id))).'/';
		
		// Get the file extension
		$file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

		// Rename the file with the username and extension
		$new_file_name = getClass($class_id).'-'.getTerm($term_id).'_'.getSubject($subj_id).'-lessson_note'.'-'.$week.'.'.$file_extension;

		// Set the target path for the renamed file
		$target_path = $target_dir . $new_file_name;

		// Move the uploaded file to the target directory with the new name
		move_uploaded_file($file['tmp_name'], $target_path);
		
		//Checking if record exist
		$result = mysqli_query($conn, "SELECT * FROM lesson_notes WHERE class_id='$class_id' AND subj_id='$subj_id' AND term_id='$term_id' AND week='$week'");
		
		if (mysqli_num_rows($result) == true){
			mysqli_query($conn,"UPDATE `lesson_notes` SET `topic`='$topic',`lesson_note`='$new_file_name' WHERE `lesson_notes`.`subj_id` = $subj_id AND `lesson_notes`.`class_id` = $class_id AND `lesson_notes`.`term_id` = $term_id AND `lesson_notes`.`week` = $week");
			$msg = 'Updated '.getClass($class_id).'-'.getTerm($term_id).'_'.getSubject($subj_id).'-lessson_note'.'-'.$week;
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			// Insert the file name and username into the database
			$sql = "INSERT INTO lesson_notes (week, topic, lesson_note, subj_id, class_id, term_id, year_created) VALUES ('$week', '$topic', '$new_file_name', '$subj_id', '$class_id', '$term_id', '$year_created')";
			
			if (mysqli_query($conn,$sql) === true) {
				$msg = 'Lesson Note Created for '.getClass($class_id).'-'.getTerm($term_id).'_'.getSubject($subj_id).'-lessson_note'.'-'.$week;
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Error: " . $sql . "<br>" . $conn->error;
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles2.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
<!-- information -->
<?php include 'include/information.php'?>                 
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12"> 
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"></h3>
										<button type="button" class="btn btn-warning" data-toggle="modal"  data-target="#modal-default" style="float:left;"><a href="#"><i class="fa fa-upload"></i> Upload Lesson Note</a></button>
										<div style="float:right;">
											<table border="0" align="center" cellspacing="5px" style="width:100%;;">
												<tr>
													<td><b>CLASS : <?php echo getClass($class_id);?>&nbsp;&nbsp;</td>
													<td><b>SUBJECT : <?php echo strtoupper(getSubject($subj_id));?>&nbsp;&nbsp;</td>
													<td><b><?php echo strtoupper(getTerm($term_id));?>&nbsp;LESSON NOTE&nbsp;&nbsp;</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="card-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead align="center">
												<tr>
													<th align="center" width="15%" class="pad">WEEK(s)</th>
													<th class="pad">TOPIC(s)</th>
													<th align="center" width="15%" class="pad">VIEW</th>
													<th align="center" width="15%" class="pad">CONTENT</th>							
												</tr>
											</thead>
											<tbody>	
												<?php
												$result = mysqli_query($conn,"SELECT * FROM lesson_notes WHERE term_id='$term_id' AND class_id='$class_id' AND subj_id='$subj_id'");
												$subj_teacher = mysqli_query($conn,"SELECT DISTINCT user_id FROM staff_info WHERE subj_id='$subj_id' AND class_id='$class_id'");
												while ($row = mysqli_fetch_array($result)){ $modal_id = "lesson".$row['week']; $week = $row['week'];
												?>
												<tr>
													<td class="pad"><?php if ($week == $cweek){
														echo '<botton class="btn btn-success btn-block">'.'Week '.$row['week'].'</a>';
														} else {echo '<botton class="btn btn-danger btn-block">'.'Week '.$row['week'].'</a>';
														} ?></td>
													<td align="left" class="pad"><?php echo $row['topic'];?></td>
													<td align="center" class="pad"><?php
															if(!empty(getLessonNote($subj_id, $class_id, $term_id, $week))){
																echo '<a title="View" class="btn btn-info view-btn" data-toggle="modal" data-target="#'.$modal_id.'"><i class="fa fa-eye"></i> View</a>';
															} else {
																echo '<a link.href="#" class="btn btn-danger btn-block"><i class="fa fa-eye"></i> View</a>';
															}
															?></td>
													<td align="center" class="pad"><?php
														if(!empty(getLessonNote($subj_id, $class_id, $term_id, $week))){
															echo '<a onclick="window.open(\'print_lesson_note.php?url='.base64_encode('lesson_notes/'.getLessonNote($subj_id, $class_id, $term_id, $week)).'&topic='.base64_encode($row['topic']). '\', \'_blank\', \'width=800,height=600\')" class="btn btn-success btn-block"><i class="fa fa-download"></i> Download</a>';

														} else {
															echo '<a link.href="#" class="btn btn-danger btn-block"><i class="fa fa-download"></i> Download</a>';
														}
														?></td>
												</tr>
												<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><i class="fa fa-info-circle"></i> Note Information</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															</div>
															<div class="modal-body">
																<p><b>Subject:</b> <?php echo getSubject($subj_id);?></p>
																<p><b>Week:</b> <?php echo $row['week'];?></p>
																<p><b>Class:</b> <?php echo getClass($class_id);?></p>
																<p><b>Term:</b> <?php echo getTerm($term_id);?></p>
																<p><b>Topic:</b> <?php echo $row['topic'];?></p>
																<p><b>Lecture Time:</b> ...</p>
																<p><b>Name of Subject Teacher(s):</b> <?php foreach ($subj_teacher as $teacher) { 
																									 $staff[]  = getLastName($teacher['user_id']).' '.getFirstName($teacher['user_id']);
																									 }
																	echo json_encode($staff).', '; ?></p>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
						<?php } ?>
											</tbody>				
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="modal fade" id="modal-default">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title"><i class="fa fa-paper"></i>&nbsp;Upload Lesson Note</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<center style="color:red;" class="error"><?php if (isset($msg)&& isset($msg_toastr)) { echo $msg.$msg_toastr; }?></center>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<label for="exampleInputFile">Week</label>
										<select class="form-control" name="week">
											<option value="">Select Week</option>
											<?php
												for ($i = 1;$i <= 14;$i = $i + 1) {
													echo "<option value=". $i . ">" .'Week '. $i . "</option>";
													}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputFile">Topic</label>
										<input type="text" name="topic" placeholder="Topic for the Week" class="form-control" size="50"/>
									</div>
									<div class="form-group">
										<label for="exampleInputFile">Select file</label>
										<input type="file" name="file" accept="pdf/*" class="form-control" size="50"/>
									</div>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input name="submit" type="submit" value="Upload" class="btn btn-primary">
								</div>
							</form>			
						</div>
					</div>
				</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
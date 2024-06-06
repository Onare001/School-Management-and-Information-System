<?php $page_title = "Student Assignment"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['sesid'])) {
    $cid = decrypt($_GET['cid']);
    $did = decrypt($_GET['did']);
    $subj_id = decrypt($_GET['sid']);//Subject
    $tid = decrypt($_GET['tid']);
    $sid = decrypt($_GET['sesid']);
} else {
	header("Location:view_stu_assignment");
}

if (isset($_POST['submit'])){
		$uid = $_POST['student'];
		$score = $_POST['score'];
	if (empty($_POST['score'])){
		$msg = 'Please Select a Score for '.getLastname($uid).'&nbsp;'.getFirstname($uid).'';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		$result = mysqli_query($conn, "UPDATE stu_assignment SET assign_score = '$score' WHERE user_id = '$uid' AND subj_id = '$subj_id' AND term_id='$tid' AND session_id = '$sid'");
		if ($result == true){
			$msg = 'Assignment Score Submitted for '.getLastname($uid)."&nbsp;". getFirstname($uid).'';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		}
	}
}

// Check if the form has been submitted
if (isset($_POST['submit1'])) {
    // Get the file information from the form
    $file = $_FILES['file'];

    // Set the target directory for the uploaded file
    $target_dir = "student_assignment/assignment_questions/";

    // Get the file extension
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Rename the file with the username and extension
    $new_file_name = getSubject($subj_id).'-'.$ctid.'-'./*getSession($csid).*/"." . $file_extension;
	
    // Set the target path for the renamed file
    $target_path = $target_dir . $new_file_name;

    // Move the uploaded file to the target directory with the new name
    move_uploaded_file($file['tmp_name'], $target_path);
	
	//Checking if record exist
	$result = mysqli_query($conn, "SELECT * FROM stu_assignment WHERE user_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND session_id='$sid'");
	
	if (mysqli_num_rows($result) == true){
		$msg = 'Updated '.getSubject($subj_id).'.';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		// Insert the file info into the database
		$sql = "INSERT INTO assgn_questions (assgn_question, subj_id,class_id, term_id, session_id) VALUES ('$new_file_name', '$subj_id', '$cid', '$tid', '$sid')";
	
    if (mysqli_query($conn,$sql) === true) {
        $msg = 'Assignment Quiestion Uploaded for '.getSubject($subj_id).'.';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
    } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    }
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles2.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

<?php include 'include/information.php'?>                       

				<section class="content">
					<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;}?></center>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12"> 
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"></h3>
										<button type="button" class="btn btn-warning" data-toggle="modal"  data-target="#modal-default" style="float:left;"><a href="#"><i class="fa fa-upload"></i> Upload Question</a></button>
										<div style="float:right;">
											<table border="0" align="center" cellspacing="5px" style="width:100%;;">
												<tr>
													<td><b><?php echo strtoupper(getTerm($tid));?>&nbsp;ASSIGNMENT&nbsp;&nbsp;</td>
													<td><b>CLASS : <?php echo getClass($cid).'&nbsp;'.getCategory($did);?>&nbsp;&nbsp;</td>
													<td><b>SUBJECT : <?php echo strtoupper(getSubject($subj_id));?>&nbsp;&nbsp;</td>
													<td><b>SESSION : <?php echo getSession($sid).'&nbsp;'.'ACADEMIC SESSION';?>&nbsp;&nbsp;</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="card-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th align="center" class="pad">S/N</th>
													<th align="left" class="pad">STUDENT NAME</th>
													<th align="center" class="pad">DATE OF SUBMISSION</th>
													<th align="center" class="pad">ASSIGNMENT</th>
													<th align="center" class="pad">SCORE OBTAINED</th>
													<th align="center" class="pad">ENTER</th>
												</tr>
											</thead>
											<tbody>	
												<?php
												if (getSubjectType($subj_id)=='Elective'){
													$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN registered_subject ON sch_users.user_id = registered_subject.user_id WHERE sch_users.sch_id = '$sch_id' AND sch_users.priv_id = 3 AND registered_subject.sch_id= '$sch_id' AND registered_subject.class_id = '$cid' AND registered_subject.cat_id = '$did' AND registered_subject.subj_id = '$subj_id' AND registered_subject.user_id");
												} else {
													$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.sch_id = '$sch_id' AND stdnt_info.status_id = 1 AND sch_users.priv_id = 3 AND stdnt_info.sch_id= '$sch_id' AND stdnt_info.class_id = '$cid' AND stdnt_info.cat_id = '$did' ORDER BY sch_users.last_name ASC");
												}
												while ($row = mysqli_fetch_array($result)){
													$uid = $row["user_id"]; $modal_id = "myModal".$uid; // Generate unique ID for modal
													
													if (empty(getAssignment($uid, $subj_id, $tid, $sid))){
														$action = "disabled";
													} else {
														$action = "";
													}
													
													if (!empty(getAssignment($uid, $subj_id, $tid, $sid))){
														$assgn_score = getAssignScore($uid, $subj_id, $tid, $sid);
													} else {
														$assgn_score = 'SCORE';
													}
												?>
												<tr>			
													<td align="center" class="pad"><?php echo ++$counter; ?></td>
													<td class="pad"><?php echo getLastname($uid)."&nbsp;".getFirstname($uid);?></td>
													<td align="center" class="pad"><?php echo getAssignDateOS($uid, $subj_id, $tid, $sid);?></td>
													<td align="center" class="pad"><?php
													if(!empty(getAssignment($uid, $subj_id, $tid, $sid))){
														echo '<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#'.$modal_id.'"><i class="fa fa-eye"></i> View Assignment</button>';
													} else {
														echo '<a link.href="#" class="btn btn-danger btn-block">View Assignment</a>';
													}
													?></td>
													<form action="" method="post"> 
														<td align="center" class="pad">
														<input name="student" type="hidden" value="<?php echo $uid;?>">
															<select class="form-control" name="score" id="score" <?php echo $action;?>>
																<option value=""><?php echo $assgn_score;?></option>
																<?php
																if(!empty(getAssignment($uid, $subj_id, $tid, $sid))){
																	for ($i = 0;$i <= 20;$i = $i + 1) {
																		if (strlen($i) < 2) {
																			echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
																		} else {
																			echo "<option value=" . $i . ">" . $i . "</option>";
																		}
																	}
																} else {
																	
																}
																?>
															</select>
														</td>		
														<td align="center">
															<input type="submit" name="submit" title="Submit" value="Submit" class="btn btn-primary" <?php echo $action;?>/>
														</td>
													</form>	
													<!-- Modal -->
													<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content" style="width:950px;">
																<div class="modal-header">
																	<h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><?php echo getLastname($uid)."&nbsp;".getFirstname($uid);?></h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body">
																	<p><iframe src="<?php echo 'http://127.0.0.1/sms/student_assignment/'.getAssignment($uid, $subj_id, $tid, $sid).'.';?>" width="100%" height="400px"></iframe></p>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																</div>
															</div>
														</div>
													</div>
												</tr><?php } ?>
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
								<h4 class="modal-title"><i class="fa fa-question"></i>&nbsp;Upload Assignment Question</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<center style="color:red;" class="error"><?php if (isset($msg)) { echo $msg; }?></center>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<label for="exampleInputFile">Select file</label>
										<input type="file" name="file" accept="" class="form-control" size="50"/>
									</div>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input name="submit1" type="submit" value="Upload" class="btn btn-primary">
								</div>
							</form>			
						</div>
					</div>
				</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
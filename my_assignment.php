<?php $page_title = "My Assignment"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
	$tid = $ctid;
    $sid = $csid;

$showdata = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.user_id = '$user_id' ");
	$row = mysqli_fetch_array($showdata) ;
	$class_id = $row['class_id'];
	$cat_id = $row['cat_id'];

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the username and file information from the form
    $subj_id = $_POST['subject'];
    $file = $_FILES['file'];

    // Set the target directory for the uploaded file
    $target_dir = "student_assignment/";

    // Get the file extension
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Rename the file with the username and extension
    $new_file_name = getSubject($subj_id).'_'.$user_id.'-'.$ctid.'-'.$csid."." . $file_extension;
    // Set the target path for the renamed file
    $target_path = $target_dir . $new_file_name;

    // Move the uploaded file to the target directory with the new name
    move_uploaded_file($file['tmp_name'], $target_path);
	
	//Checking if record exist
	$result = mysqli_query($conn, "SELECT * FROM stu_assignment WHERE user_id='$user_id' AND subj_id='$subj_id' AND term_id='$ctid' AND session_id='$csid'");
	
	if (mysqli_num_rows($result) == true){
		$msg = '<span class="badge bg-success">'.'Updated '.getSubject($subj_id).'.'.'<span>';
	} else {
		// Insert the file name and username into the database
		$sql = "INSERT INTO stu_assignment (user_id, file_name, subj_id, term_id, session_id) VALUES ('$user_id','$new_file_name', '$subj_id', '$ctid', '$csid')";
	
    if (mysqli_query($conn,$sql) === true) {
		#header("location: my_assignment");
        $msg = '<span class="badge bg-success">'.'Assignment Submitted for '.getSubject($subj_id).'.'.'<span>';
    } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
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
				<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg;} ?></center>
				<div class="container-fluid">
					<div class="row">
						<div class="col-12"> 
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"></h3>
									<div style="float:right;">
										<table border="0" align="center" cellspacing="5px" style="width:100%;;">
											<tr>
												<td>
													<b><?php echo strtoupper(getTerm($tid));?>&nbsp;ASSIGNMENT&nbsp;&nbsp;
												</td>
												<td>
													<b>SESSION : <?php echo getSession($sid).'&nbsp;'.'ACADEMIC SESSION';?>&nbsp;&nbsp;
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th align="center" class="pad">S/N</th>
												<th align="left" class="pad">SUBJECT</th>
												<th align="center" class="pad">QUESTION</th>
												<th align="center" class="pad">UPLOAD</th>
												<th align="center" class="pad">ANSWER</th>
												<th align="center" class="pad">ACTION</th>
												<th align="center" class="pad">SCORE</th>
											</tr>
										</thead>
										<tbody>	
											<?php
											$result = mysqli_query($conn, "SELECT * FROM subj_info ORDER BY subj_info.subj_title ASC");
											while ($row = mysqli_fetch_array($result)){
												$subj_id = $row["subj_id"];

												if (((empty(getAssgnQues($class_id, $subj_id, $ctid, $csid))) && (empty(getAssignment($user_id, $subj_id, $ctid, $csid)))&& (empty(getAssignScore($user_id, $subj_id, $ctid, $csid)))) || ((!empty(getAssgnQues($class_id, $subj_id, $ctid, $csid))) && (!empty(getAssignment($user_id, $subj_id, $ctid, $csid)))&& (!empty(getAssignScore($user_id, $subj_id, $ctid, $csid))))){
													$action = "disabled";
												} else {
													$action = "";
												}
											?>
											<tr>
												<form action="" method="post" enctype="multipart/form-data">				
													<td align="center" class="pad"><?php echo ++$counter; ?></td>
													<td class="pad">
														<?php echo getSubject($subj_id);?><br/>
														<input name="subject" type="hidden" value="<?php echo $subj_id;?>">
													</td>
													<td align="center" class="pad">
													<?php
														if (!empty(getAssgnQues($class_id, $subj_id, $ctid, $csid))){
															echo '<a href="student_assignment/assignment_questions/'.getAssgnQues($class_id, $subj_id, $ctid, $csid).'" class="btn btn-success btn-block"><i class="fa fa-download"></i> Download</a>';
														} else {
															echo '<a link.href="#" class="btn btn-danger btn-block"><i class="fa fa-download"></i> Download</a>';
														}
													?>	
													</td>
													<td align="center" width="25%" class="pad">
														<input type="file" name="file" accept="/*" class="form-control" size="50" width="3px" <?php echo $action;?>/>
													</td>
													<td align="center" class="pad">
														<?php
														if(!empty(getAssignment($user_id, $subj_id, $ctid, $csid))){
															echo '<a href="student_assignment/'.getAssignment($user_id, $subj_id, $tid, $sid).'" class="btn btn-success btn-block"><i class="fa fa-eye"></i> view</a>';
														} else {
															echo '<a link.href="#" class="btn btn-danger btn-block"><i class="fa fa-eye"></i> view</a></a>';
														}
														?>	
													</td>
													<td align="center" class="pad">
														<input type="submit" name="submit" title="Submit" value="Submit" class="btn btn-primary" <?php echo $action;?>/>
													</td>		
													<td align="center">
														<?php 
														if (empty(getAssignScore($user_id, $subj_id, $ctid, $csid))){
															echo 'NA';
														} else {
															echo getAssignScore($user_id, $subj_id, $ctid, $csid).'/20';
														}
														?>
													</td>
												</form>
											</tr><?php } ?>
										</tbody>				
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
<?php $page_title = "Staff Details"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$uid="";
if (isset($_GET['uid'])) {
    $uid = decrypt($_GET['uid']);
	$staff_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$uid'");
	$sinfo = mysqli_fetch_array($staff_info);
} else {
	header("location:register_staff");
}

if (isset($_POST['submit1'])) {
	$subj_id = addslashes($_POST['subj_id']);
	$class_id = addslashes($_POST['class_id']);
	$cat_id = addslashes($_POST['cat_id']);
	if (empty($subj_id)) {
		$msg = 	'Select a Subject';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($class_id)) {
		$msg = 'Select a Class';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($cat_id)) {
		$msg = 'Select Class Category';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		//Check if Record already exist
		$sql0 = "SELECT * FROM staff_info WHERE user_id='$uid' AND subj_id='$subj_id' AND class_id='$class_id' AND cat_id ='$cat_id'";
		$result = mysqli_query($conn,$sql0);
		
        if (mysqli_num_rows($result) == true) {
            $msg = 'This Class has Already been assigned to this Staff';
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
        } else {
			//Insert task list
			$assign = mysqli_query($conn,"INSERT INTO staff_info (sch_id, user_id, subj_id, class_id, cat_id) VALUES ('$sch_id', '$uid', '$subj_id', '$class_id', '$cat_id')");
		
			//Update info
			$update_info = mysqli_query($conn,"UPDATE `staff_info` SET `sch_id`='$sch_id', `dept_id`=".$sinfo['dept_id'].",`rel_id`=".$sinfo['rel_id'].",`sex_id`='".$sinfo['sex_id']."',`dob`='".$sinfo['dob']."',`state_id`='".$sinfo['state_id']."',`lga`='".$sinfo['lga']."',`status_id`='".$sinfo['status_id']."',`phone_no`= '".$sinfo['phone_no']."',`address`='".$sinfo['address']."',`type_id`='".$sinfo['type_id']."',`post_id`='".$sinfo['post_id']."',`doa`='".$sinfo['doa']."',`qual_id`='".$sinfo['qual_id']."',`discipline`='".$sinfo['discipline']."',`file_no`='".$sinfo['file_no']."',`rank_id`='".$sinfo['rank_id']."',`bank_id`='".$sinfo['bank_id']."',`acc_no`='".$sinfo['acc_no']."' WHERE `staff_info`.`user_id` = '$uid'");
			
		//Feedback if Successfully Submitted			
			if ($assign) {
				$msg = 'Class & Subject has been Assigned Successfully';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Error: " . $assign . ":-" . mysqli_error($conn);
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
}
// check if the form is submitted
if (isset($_POST['delete'])) {
    
    // get array of selected IDs from checkboxes
    $selected_ids = $_POST['checkbox'];
	if (empty($selected_ids)){
		$msg = 'Please Select at least one Row';
		$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
	} else {
		// delete rows with selected IDs
		$sql = "DELETE FROM `staff_info` WHERE `staff_info`.`staff_id` IN (".implode(',',$selected_ids).") AND sch_id = '$sch_id'";
		if (mysqli_query($conn, $sql)) {
			$msg = 'The selected row(s) were deleted successfully.';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Error Deleting Selected Rows';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?php echo getPassport($uid);?>" alt="Staff-passport"/>
									</div>
									<h3 class="profile-username text-center"><?php echo getFirstname($uid).' '.getLastname($uid);?></h3>
									<p class="text-muted text-center"><?php echo getPriviledge($sinfo['priv_id']);?> 
									<a title="Edit Priviledge" onclick="location.href='edit_privilege?uid=<?php echo encrypt($uid);?>'"><i style="color:red;" class="fa fa-edit"></i></a></p>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item"><b>Category</b> <a class="float-right"><?php echo getStafftype($sinfo["type_id"]);?></a></li>
										<li class="list-group-item"><b>Department</b> <a class="float-right"><?php echo getDept($sinfo["dept_id"]);?></a></li>
										<li class="list-group-item"><b>Email</b> <a class="float-right" style="font-size:11px;"><?php echo getUsername($uid);?></a></li>
										<li class="list-group-item"><b>Phone Number</b><a class="float-right"><?php echo $sinfo["phone_no"];?></a></li>
									</ul>
									<a href="admin_compose?uid=<?php echo encrypt($uid);?>" class="btn btn-primary btn-block"><b><i class="fa fa-envelope"></i>&nbsp;Send a Message</b></a>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">About</h3>
								</div>
								<div class="card-body">
									<strong><i class="fas fa-book mr-1"></i> Qualification</strong>
									<p class="text-muted"><?php echo getQualification($sinfo["qual_id"]); if(!empty($sinfo["discipline"])){echo ' in '.$sinfo["discipline"];}?></p>
									<hr>
									<strong><i class="fas fa-map-marker-alt mr-1"></i>Address</strong>
									<p class="text-muted"><?php echo $sinfo["address"];?></p>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab" id="tab-activity">Task Information</a></li>
										<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab" id="tab-timeline">Add Task</a></li>
										<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" id="tab-settings">Edit Staff Profile</a></li>
										<!--li class="nv-item"><?php //if (isset($msg)){ echo $msg_toastr; }?></li-->
									</ul>
								</div>
								<div class="card-body">
									<div class="tab-content">
										<div class="active tab-pane" id="activity">
											<form method="post">
												<table border="0" align="center" class="table table-striped" style="border-collapse:collapse; width:80%;">
													<thead style="background-color:darkblue;color:white;">
														<th class="border" align="center" width="5px">S/N</th>
														<th class="border" align="center" width="5px"><input name="" type="checkbox" id="check-all"></th>
														<th class="border" align="center" width="20%">CLASS</th>
														<th class="border" align="center" width="5px">ARM</th>
														<th class="border" align="left" width="50%">SUBJECT</th>
														<th class="border" align="center" width="5px">TYPE</th>
														<th class="border" align="center" width="2px">DELETE</th>
													</thead>
													<tbody>
														<?php
															$result = mysqli_query($conn,"SELECT * FROM staff_info JOIN subj_info ON staff_info.subj_id=subj_info.subj_id WHERE staff_info.user_id = '$uid' AND staff_info.subj_id != '0' AND staff_info.sch_id = '$sch_id' AND staff_info.class_id !=0 ORDER BY staff_info.class_id,staff_info.cat_id,subj_info.subj_title ASC");
															
															if(mysqli_num_rows($result) == 0) {
																echo '<tr><td colspan="7" align="center" style="color:red">No task has been assigned to this staff</td></tr>';
															} else {
																while ($row = mysqli_fetch_array($result)){
														?>				  
															<tr>
																<td class="border" align="center"><?php echo ++$counter;?></td>
																<td class="border" align="center">
																	<input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo $row["staff_id"];?>"/>
																</td>
																<td class="border" align="center"><?php echo getClass($row["class_id"]);?></td>
																<td class="border" align="center"><?php echo getCategory($row["cat_id"]);?></td>
																<td class="border" align="left"><?php echo getSubject($row["subj_id"]);?></td>
																<td class="border" align="left"><?php echo getSubjectType($row["subj_id"]);?></td>		
																<td class="border" align="center">
																	<?php /*<!--a onclick="return confirm('Are you sure you want to delete this Record?');" href="confirm_delete?txid=<?php //echo encrypt($row["staff_id"]);?>&tuid=<?php echo encrypt($uid);?>"--><!--/a><br/-->*/;?><img src="assets/img/trash.png"/>
																</td>
															</tr>
														<?php 
																} 
															} 
														?>
													</tbody>
												</table>
												<div class="button-container">
													<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>		
													<button id="deleteButton" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete the Selected Record?');" id="buttonn" class="btn btn-danger" disabled> <i class="fa fa-trash"></i> Delete Selected</button>
												</div>
											</form>
										</div>
										<div class="tab-pane" id="timeline">
											<div class="">
												<div class="" id="selectbox">
													<form action="" method="post">
														<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
															<tr>
																<td align="left">
																	<div class="col-md-12">
																		<input name="staff_name" type="text" placeholder="Staff Name" value="<?php echo getFirstname($uid).'&nbsp;'.getLastname($uid);?>" class="form-control" disabled>
																	</div>
																</td>
															</tr>	
															<tr>
																<td>
																	<div class="col-md-12">    
																		<select name="subj_id" id="sel_subj" class="form-control">
																			<?php
																			echo '<option value="">'.'Select Subject'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM subj_info ORDER BY subj_title");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["subj_id"].'">'.$row["subj_title"].'</option>'; } ?>
																		</select>
																	</div>											
																</td>
															</tr>  
															<tr>
																<td>
																	<div class="col-md-12">    
																		<select name="class_id" id="sel_class" class="form-control">
																			<?php
																			echo '<option value="">'.'Select Class'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
																		</select>
																	</div>  
																</td>
															</tr>		  
															<tr>
																<td>
																	<div class="col-md-12">      
																		<select name="cat_id" id="sel_cat" class="form-control">
																			<?php
																			echo '<option value="">'.'Select Category'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM class_cat");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
																		</select>
																	</div> 
																</td>
															</tr>
															<tr>
																<td align="right">
																	<div class="col-md-12">&nbsp;
																		<input type="reset" value="Reset" class="btn btn-danger"/>
																		<input name="submit1" type="submit" value="Assign" class="btn btn-primary"/>
																	</div>
																</td>
															</tr> 
														</table>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="settings">
											<div class="form-group row">
												<div class="card card-success" style="width:900px;margin-left:20px;">
													<div class="card-header">
														<h3 class="card-title">Edit Staff Details</h3>
														<div class="card-tools">
															<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
															</button>
															<button type="button" class="btn btn-tool" data-card-widget="remove">
															<i class="fas fa-times"></i>
															</button>
														</div>
													</div>
													<div class="card-body">
													<?php include('include/edit_staff_data.php');?>
													<?php if (isset($msg)){ echo $msg_toastr; }?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/check_all.php');?>
<?php include ('include/page_scripts/options.php');?>
<?php include ('include/ajax/process_lga.php');?>
<!--script>
// add event listener to accordion
$('.nav-pills a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  // get ID of shown tab
  var id = e.target.id;
  // store ID in local storage
  localStorage.setItem('activeTab', id);
});

// retrieve ID of active tab from local storage
var activeTab = localStorage.getItem('activeTab');

// activate corresponding tab
if (activeTab) {
  $('#' + activeTab).tab('show');
}
</script-->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
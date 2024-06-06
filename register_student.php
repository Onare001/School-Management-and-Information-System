<?php $page_title = "Register Student";?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id = $cat_id = $did = $cid = $msg = $msg_toastr = "";
	if (isset($_GET['cid']) && isset($_GET['cat'])) {
		$class_id = decrypt($_GET['cid']);
		$cat_id = decrypt($_GET['cat']);
	} else {
		header("location: select_class");
	}

	//Total number of registered student in the class
	$total_in_class = getNumClassFemale($sch_id, $class_id, $cat_id) + getNumClassMale($sch_id, $class_id, $cat_id);

	if (isset($_POST['register'])){
		$last_name = addslashes($_POST['last_name']);
		$first_name = addslashes($_POST['first_name']);
		$sex_id = addslashes($_POST['sex_id']);
		
		//Generated StudentID
		$username = generateStudentID($sch_id, $class_id, $cat_id, '1');
		
		//constant Values
		$priv_id = "3";//Student
		$passport = $last_name.'_'.$firstname.'.jpg';
		
		$password = md5("1234");//Default
		
		//Prevent Blank Record
		$result1 = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id='$class_id' LIMIT 1");
		$row = mysqli_fetch_array($result1);
		$cid = $row['class_id'];
			
		$result2 = mysqli_query($conn,"SELECT * FROM class_cat WHERE cat_id='$cat_id' LIMIT 1");
		$row = mysqli_fetch_array($result2);
		$did = $row['cat_id'];
		
		
	if (($class_id == $cid) && ($cat_id == $did)){
		if (empty($last_name)){
			$msg = '<span class="badge bg-danger">'.'Enter Student Surname'.'</span>';
		} else if (empty($first_name)){
			$msg = '<span class="badge bg-danger">'.'Enter Student Othername(s)'.'</span>';
		} else if (empty($sex_id)){
			$msg = '<span class="badge bg-danger">'.'Select Student Gender'.'</span>';
		} else if($total_in_class >= 60){
			$msg = '<span class="badge bg-danger">'.'You have exceeded the total number of students that can be registered per class'.'</span>';
			//$msg_toastr = '<script>toastr.danger("'.$msg.'")</script>';	
		} else {
			// Insert record
			$insert_user = mysqli_query($conn,"INSERT INTO sch_users (last_name, first_name, username, sch_id, priv_id, password, passport) VALUES ('$last_name','$first_name','$username', '$sch_id', '$priv_id', '$password','$passport')");
			
			//$uid = mysqli_insert_id($conn);
			$getUserid = mysqli_query($conn,"SELECT user_id FROM sch_users WHERE username='$username'");
			$row = mysqli_fetch_assoc($getUserid);
			$uid = $row['user_id'];
				
			$insert_stdnt = mysqli_query($conn,"INSERT INTO stdnt_info (user_id, sch_id, class_id, cat_id, sex_id, status_id) VALUES ('$uid','$sch_id', '$class_id', '$cat_id','$sex_id','1')");
			
			if (($insert_stdnt) && ($insert_user)){
				$ms = getLastName($uid).'&nbsp;'.getFirstName($uid).'&nbsp;'.'Has been Registered to'.'&nbsp;'.getClass($class_id).getCategory($cat_id).'&nbsp;'.'with Student ID:'.'&nbsp;'.'<b>'.getUsername($uid);
				$msg = '<span class="badge bg-success">'.getLastName($uid).'&nbsp;'.getFirstName($uid).'&nbsp;'.'Has been Registered to'.'&nbsp;'.getClass($class_id).getCategory($cat_id).'&nbsp;'.'with Student ID:'.'&nbsp;'.'<b>'.getUsername($uid).'</b>'.'</span>';
				$msg_toastr = '<script>toastr.success("'.$ms.'")</script>';					 
			} else {
				$msg = 'Unable to Register new Student';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}	
		}
	} else {
		header("location: select_class");
	}
} else if (isset($_POST['transfer'])){
	$uid = decrypt($_POST['student']);
	$new_class = $_POST['newclass'];
	$new_cat = $_POST['newcat'];
	$transfer = mysqli_query($conn,"UPDATE stdnt_info SET class_id = '$new_class', cat_id = '$new_cat' WHERE user_id = '$uid'");
}

if (isset($_POST['delete'])) {
  $uid = decrypt($_POST['student']);
  
  // Check if student has record
  $result = mysqli_query($conn,"SELECT user_id FROM score_info WHERE user_id = $uid UNION SELECT user_id FROM cum_result WHERE user_id = $uid UNION SELECT user_id FROM stdnt_com WHERE user_id = $uid UNION SELECT user_id FROM payment_log WHERE user_id = $uid UNION SELECT user_id FROM ledger_info WHERE user_id = $uid");
  
  if (mysqli_num_rows($result) == 0) {
    // Delete user from sch_users and stdnt_info tables
    if (mysqli_multi_query($conn,"DELETE FROM sch_users WHERE user_id = $uid; DELETE FROM stdnt_info WHERE user_id = $uid;")) {
      $msg = "Deleted Successfully";
	  $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	  //header("location: register_student.php?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
    } else {
		$msg = "Error deleting user: " . mysqli_error($conn);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		//header("location: register_student.php?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
    }
  } else {
	$msg = "This student already has records. You are advised to deactivate them if they are no longer coming to school.";
	$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
	//header("location: register_student.php?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php include ("include/connection.php");?> 
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<?php include ("include/regstu_menu.php");?>
						</div>
						<div class="col-md-10">
							<div class="card" style="padding:5px;">
								<div class="card-header">
									<!--center style="margin-bottom:10px;"><?php //if (isset($msg)) { echo $msg;} ?></center-->
									<h3 class="card-title"></h3><?php if (isset($msg)) { echo $msg_toastr;} ?>
									<form action="" method="POST" autocomplete="off">
										<table border="0" align="center" style="border-collapse:collapse; width:100%;">
											<tr>
												<td><input name="last_name" type="text" placeholder="Surname" class="form-control" required /></td>
												<td><input name="first_name" type="text" placeholder="Firstname Middlename" class="form-control" required /></td> 
												<td>
													<select name="sex_id" id="sel_gender" class="form-control" required>
														<?php
														echo '<option value="">'.'Select Gender'.'</option>';
														$result = mysqli_query($conn,"SELECT * FROM gender_info");
														while ($row = mysqli_fetch_array($result)){
														echo '<option value="'.$row["sex_id"].'">'.$row["gender"].'</option>'; } ?><br/>
													</select>
												</td>
												<td>
													<select name="sno" class="form-control" required disabled>
														<option value="<?php echo generateStudentID($sch_id, $class_id, $cat_id, '0');?>"><?php echo generateStudentID($sch_id, $class_id, $cat_id, '0');?></option>
													</select>
												</td>
												<td><button type="submit" name="register" class="btn btn-primary"><i class="fa fa-user-plus"></i> REGISTER</button></td>
											</tr>	
										</table>
									</form>
								</div>
							</div>
							<div class="card" style="padding:10px;">
							<?php
							$students = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id = '$class_id' AND cat_id = '$cat_id' AND sch_id = '$sch_id' AND status_id = '1'");
							if (mysqli_num_rows($students)>0){
								echo
								'<table id="example1" class="table table-bordered table-striped" style="font-size:13px;">
									<thead class="custom">
										<tr>
											<th style="width:5%;">S/N</th>
											<th style="width:10%;">Passport</th>
											<th>Full Name</th>
											<th>Student ID</th>
											<th>Gender</th>
											<th>Class</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>';
									while ($row = mysqli_fetch_array($students)){
									$uid = $row["user_id"]; $modal_id = "myModal".$uid; $modal_id2 = "transfer".$uid; // Generate unique ID for modal
									echo	
										'<tr align="center">
											<td>'. ++$counter.'</td>
											<td><center><img src="'.getPassport($uid).'" alt="'.getLastname($uid).'" style="max-width:40px;" class="img-circle"/></center></td>
											<td><a title="'.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).'" href="stu_ctrl_panel?uid='.encrypt($row["user_id"]).'">'.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).'</a></td>
											<td><a title="'.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).'" href="edit_student?uid='.encrypt($row["user_id"]).'">'.getUsername($uid).'</a></td>
											<td>'.getGender($row['sex_id']).'</td>
											<td>'.getClass($class_id).' '.getCategory($cat_id).'</td>
											<td align="center">
												 <div class="btn-group">
													<a title="Send Message" href="admin_compose?uid='. encrypt($row["user_id"]).'"><button title="Send Message" class="btn btn-primary view-btn"><i class="fa fa-envelope"></i></button></a>
													<button title="View Profile" class="btn btn-info view-btn" data-toggle="modal" data-target="#'. $modal_id.'"><i class="fa fa-eye"></i></button>
													<button title="Transfer Class/School" class="btn btn-success view-btn" data-toggle="modal" data-target="#'. $modal_id2.'"><i class="fa fa-angle-double-right"></i></button>
													<a title="Edit" href="edit_student?uid='. encrypt($row["user_id"]).'"><button title="Edit" class="btn btn-warning edit-btn"><i class="fa fa-edit"></i></button></a>
													<form action="" method="post">
													  <input type="hidden" name="student" value="'. encrypt($row["user_id"]).'">
													  <button title="Delete" name="delete" onclick="return confirm(\'Are you sure you want to delete this Student?\');" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i></button></a>
													</form>
												 </div>
											</td>
										</tr>';
echo
										'<div class="modal fade" id="'. $modal_id.'" tabindex="-1" role="dialog" aria-labelledby="'. $modal_id.'Label" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="'. $modal_id.'Label">Student\' Profile</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<p><center><img src="'. getPassport($uid).'" alt="'. getLastname($uid).'" style="max-width:100px;" class="img-circle"/>  <h4>'. getLastname($uid).'&nbsp;'.getFirstname($uid).'</h4></center></p>
														<p><b>Class:</b> '. getClass($class_id).'&nbsp;'.getCategory($cat_id).'</p>
														<p><b>Admission Number:</b> '. $row['admn_no'].'</p>
														<p><b>Student Type:</b> '. getStudenttype($row['type_id']).'</p>
														<p><b>Date of Birth:</b> '. getAge($uid).', '.date("jS M, Y", strtotime($row['dob'])).'</p>
														<p><b>State of Origin:</b> '. getLga($row['lga']).', '.getState($row['state_id']).'</p>
														<p><b>Home Address:</b> '. $row['address'].'</p>
														<p><b>Parent Name/Contact:</b> '. $row['p_name'].', '.$row['parent_contact'].'</p>	
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<a href="edit_student?uid='. encrypt($row["user_id"]).'" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a></button>
													</div>
												</div>
											</div>
										</div>
										<div class="modal fade" id="'. $modal_id2.'" tabindex="-1" role="dialog" aria-labelledby="'. $modal_id2.'Label" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="'. $modal_id.'Label">Transfer School/Class</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													</div>
													<form action="" method="post">
														<div class="modal-body">
															'. getLastname($uid).'&nbsp;'.getFirstname($uid).'</p>
															<p><b>Current Class/Arm:</b> '. getClass($class_id).'&nbsp;'.getCategory($cat_id).'</p>
															<input type="hidden" name="student" value="'. encrypt($row['user_id']).'"/>
															<div class="form-group">
																<label>Class</label>
																<select name="newclass" id="sel_class" class="form-control">
																	<option value="'.$class_id.'">'.'Select New Class'.'</option>';
																	$newClass = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																	while ($row = mysqli_fetch_array($newClass)){
																	echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } echo'<br/>
																</select>
															</div>
															<div class="form-group">
																<label>Category</label>
																<select name="newcat" id="sel_cat" class="form-control">
																	<option value="'.$cat_id.'">'.'Select New Class Category'.'</option>';
																	$newCat = mysqli_query($conn,"SELECT * FROM class_cat");
																	while ($row = mysqli_fetch_array($newCat)){
																	echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } echo '<br/>
																</select>
															</div></p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" name="transfer" class="btn btn-primary">Transfer</button>
														</div>
													</form>
												</div>
											</div>
										</div>';
										} 
											} else {
												$msgr = 'No Student Has been registered in this class';
												echo '<center>'.$msgr.'</center>
												<script>toastr.error("'.$msgr.'")</script>';
											}
									echo ' 
									</tbody>					
								</table>	
							</div>
						</div>	
					</div>
				</div>
			</section>';?>		
<?php include('include/footer.php');?>
<?php include ("include/page_scripts/datatables.php");?>
<?php include ("include/page_scripts/reducebtn.php");?>
</html>
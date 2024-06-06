<?php
//Permissions
if ($priviledge == 1){
	$disabled = '';
	$personal = 'disabled';
	//Fetch Out Profile information
	$staff_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$uid'");
	$sinfo = mysqli_fetch_array($staff_info);
} else if ($priviledge == 2 || $priviledge > 4){
	$disabled = 'disabled';
	$personal = '';
	//Fetch Out Profile information
	$staff_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$user_id'");
	$sinfo = mysqli_fetch_array($staff_info);
} else {
	$disabled = '';
}

//Update Profile Information
if (isset($_POST['submit'])){
	$last_name = addslashes($_POST['last_name']);
	$first_name = addslashes($_POST['first_name']);
	//$username = addslashes($_POST['email']);
	$type_id = addslashes($_POST['type_id']);
	$dept_id = addslashes($_POST['dept_id']);
	#$subj_id = addslashes($_POST['subj_id']);
	$dob = addslashes($_POST['dob']); 
	$sex_id = addslashes($_POST['sex_id']); 
	$rel_id = addslashes($_POST['rel_id']); 
	$state_id = addslashes($_POST['state_id']); 
	$status_id = addslashes($_POST['status_id']); 
	$lga = addslashes($_POST['lga']); 
	$phone_no = addslashes($_POST['phone_no']); 
	$address = addslashes($_POST['address']); 
	$post_id = addslashes($_POST['post_id']);
	$doa = addslashes($_POST['emp_date']); 
	$discipline = addslashes($_POST['disc']);
	$rank_id = addslashes($_POST['rank_id']); 
	$qual_id = addslashes($_POST['qual_id']); 
	$file_no = addslashes($_POST['file_no']); 
	$address = addslashes($_POST['address']); 
	//$bank_id = addslashes($_POST['bank_id']); 
	//$acc_no = addslashes($_POST['acc_no']);
	
	if ($priviledge == 1){ //Admin
		$username = addslashes($_POST['email']);
	
		/*$update_info = mysqli_query($conn,"UPDATE `staff_info` SET `dept_id`='$dept_id',`rel_id`='$rel_id',`sex_id`='$sex_id',`dob`='$dob',`state_id`='$state_id',`lga`='$lga',`status_id`='$status_id',`phone_no`= '$phone_no',`address`='$address',`type_id`='$type_id',`post_id`='$post_id',`doa`='$doa',`qual_id`='$qual_id',`discipline`='$discipline',`file_no`='$file_no',`rank_id`='$rank_id' WHERE `staff_info`.`user_id` = $uid");//excluding account info

		$update_user = mysqli_query($conn,"UPDATE `sch_users` SET `first_name`= '$first_name',`last_name`= '$last_name',`username`= '$username' WHERE user_id = '$uid'");*/
		
		
		//$result = mysqli_query($conn, "SELECT * FROM `staff_info` WHERE `user_id` = $uid");
		if (mysqli_num_rows($staff_info) > 0) {
			// user_id exists, update the record
			$staff_record = mysqli_query($conn,"UPDATE `staff_info` SET `dept_id`='$dept_id',`rel_id`='$rel_id',`sex_id`='$sex_id',`dob`='$dob',`state_id`='$state_id',`lga`='$lga',`status_id`='$status_id',`phone_no`= '$phone_no',`address`='$address',`type_id`='$type_id',`post_id`='$post_id',`doa`='$doa',`qual_id`='$qual_id',`discipline`='$discipline',`file_no`='$file_no',`rank_id`='$rank_id' WHERE `staff_info`.`user_id` = $uid");

			$update_user = mysqli_query($conn,"UPDATE `sch_users` SET `first_name`= '$first_name',`last_name`= '$last_name',`username`= '$username' WHERE user_id = '$uid'");
		} else {
		  // user_id does not exist, insert a new record
		  $staff_record = mysqli_query($conn, "INSERT INTO `staff_info` (`user_id`, `sch_id`, `dept_id`, `rel_id`, `sex_id`, `dob`, `state_id`, `lga`, `status_id`, `phone_no`, `address`, `type_id`, `post_id`, `doa`, `qual_id`, `discipline`, `file_no`, `rank_id`) VALUES ('$uid', '$sch_id', '$dept_id', '$rel_id', '$sex_id', '$dob', '$state_id', '$lga', '$status_id', '$phone_no', '$address', '$type_id', '$post_id', '$doa', '$qual_id', '$discipline', '$file_no', '$rank_id')");
		  
		  $update_user = mysqli_query($conn,"UPDATE `sch_users` SET `first_name`= '$first_name',`last_name`= '$last_name',`username`= '$username' WHERE user_id = '$uid'");
		}
		
		//feedback
		if (($update_user && $staff_record) == true){
			$msg = 'Record Successfully Updated';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			//header("location:register_staff");
		 } else {
		   $msg = "Error: " . $update_user . ":-" . mysqli_error($conn);
		   $msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		 }
		} else if ($priviledge == 2 || $priviledge > 4){ //staff
			$bank_id = addslashes($_POST['bank_id']);
			$acc_no = addslashes($_POST['acc_no']);
		
			$update_info = mysqli_query($conn,"UPDATE `staff_info` SET `dept_id`='$dept_id',`rel_id`='$rel_id',`sex_id`='$sex_id',`dob`='$dob',`state_id`='$state_id',`lga`='$lga',`status_id`='$status_id',`phone_no`= '$phone_no',`address`='$address',`type_id`='$type_id',`post_id`='$post_id',`doa`='$doa',`qual_id`='$qual_id',`discipline`='$discipline',`file_no`='$file_no',`rank_id`='$rank_id',`bank_id`='$bank_id',`acc_no`='$acc_no' WHERE `staff_info`.`user_id` = $user_id");

			$update_user = mysqli_query($conn,"UPDATE `sch_users` SET `first_name`= '$first_name',`last_name`= '$last_name' WHERE user_id = '$user_id'");//excluding username
			
		//feedback
		if (($update_info && $update_user) == true){
			$msg = 'Record Successfully Updated';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			//echo "<script>window.location.reload();</script>";
		 } else {
		   $msg = "Error: " . $update_user . ":-" . mysqli_error($conn);
		   $msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		 }
	} else {
		$msg = 'You are not permitted to edit';
		$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
	}
}
?>
															
															<form action="" method="post" id="form">
																<fieldset>
																	<legend><i class="fa fa-user"></i>&nbsp;Basic Information</legend>
																	<table align="center" border="0" class="table table-striped">		  
																		<tr>
																			<!--td>
																				<label>Title</label>
																				<select class="form-control">
																					<option value="">Mr</option>
																					<option value="">Miss</option>
																				</select>
																			</td-->
																			<td>
																				<label>Surname</label>
																				<input name="last_name" type="text" placeholder="Last Name" value="<?php echo getLastname($uid);?>" class="form-control" required/>
																			</td>
																			<td>
																				<label>Firstname</label>
																				<input name="first_name" type="text" placeholder="First Name" value="<?php echo getFirstname($uid);?>" class="form-control" required/>
																			</td>
																			<td>
																				<label>Username</label>
																				<input name="email" type="email" placeholder="Email address" value="<?php echo getUsername($uid);?>" class="form-control" <?php echo $disabled;?>/> 
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Gender</label>
																				<select name="sex_id" class="form-control">
																					<?php if (empty($sinfo["sex_id"])){ echo '<option value="">*****Select Gender*****</option>';} else {echo '<option value="'.$sinfo["sex_id"].'">'.getGender($sinfo["sex_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM gender_info");	
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["sex_id"].'">'.$row["gender"].'</option>';	} ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>Date of birth</label>			
																				<input name="dob" type="date" placeholder=" Date of birth (DD/MM/YYYY)" value="<?php echo $sinfo["dob"];?>"class="form-control">
																			</td>
																			<td>
																				<label>Religion</label>
																				<select name="rel_id" class="form-control">
																					<?php if (empty($sinfo["rel_id"])){ echo '<option value="">*****Select Religion*****</option>';} else {echo '<option value="'.$sinfo["rel_id"].'">'.getReligion($sinfo["rel_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM religion_info");	
																					while ($row = mysqli_fetch_array($result)){ ?>	
																					<option value="<?php echo $row["rel_id"];?>"><?php echo $row["religion"];?></option><?php } ?><br/>
																				</select> 
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Marital Status</label>
																				<select name="status_id" class="form-control">
																					<?php
																					if (empty($sinfo["status_id"])){ echo '<option value="">*****Select Marital Status*****</option>';} else {echo '<option value="'.$sinfo["status_id"].'">'.getMaritalstatus($sinfo["status_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM m_status_info");	
																					while ($row = mysqli_fetch_array($result)){ ?>	
																					<option value="<?php echo $row["status_id"];?>"><?php echo $row["m_status"];?></option><?php } ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>State of Origin</label>
																				<select class="form-control select2bs4" name="state_id" id="state-dropdown">
																					<?php
																					if (empty($sinfo["state_id"])){ echo '<option value="">*****Select State*****</option>';} else {echo '<option value="'.$sinfo["state_id"].'">'.getState($sinfo["state_id"]).'</option>';} 
																					$result = mysqli_query($conn,"SELECT * FROM state_info");	
																					while ($row = mysqli_fetch_array($result)){	
																					echo '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>'; } ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>Local Government Area</label>
																				 <select class="form-control select2bs4" name="lga" id="lga-dropdown">
																					<?php if (empty( $sinfo["lga"])){ echo '<option value="">**Select State First**</option>';} else {echo '<option value="'.$sinfo["lga"].'">'.getLga($sinfo["lga"]).'</option>';}?><br/>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Phone No.</label>
																				<input name="phone_no" type="text" placeholder="Staff Phone Number" maxlength="11" value="<?php echo $sinfo["phone_no"];?>"  class="form-control" required/> 
																			</td>
																			<td>
																				&nbsp;
																			</td>
																			<td>
																				&nbsp;
																			</td>
																		</tr>
																	</table>		  
																</fieldset>		
																<fieldset>
																	<legend><i class="fa fa-chalkboard"></i>&nbsp;Job Information</legend>
																	<table align="center" border="0" class="table table-striped">		  
																		<tr>
																			<td>
																				<label>Staff Category</label>
																				<select name="type_id" class="form-control">
																					<?php
																					if (empty($sinfo["type_id"])){ echo '<option value="">*****Select Job Category*****</option>';} else {echo '<option value="'.$sinfo["type_id"].'">'.getStafftype($sinfo["type_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM staff_type_info");
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["type_id"].'">'.getStafftype($row["type_id"]).'</option>'; 
																					} ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>Department</label>
																				<select name="dept_id" class="form-control">
																					<?php
																					if (empty($sinfo["dept_id"])){ echo '<option value="">*****Select Department*****</option>';} else {echo '<option value="'.$sinfo["dept_id"].'">'.getDept($sinfo["dept_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM department");	
																					while ($row = mysqli_fetch_array($result)){	
																					echo '<option value="'.$row["dept_id"].'">'.getDept($row["dept_id"]).'</option>';
																					} ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>Subject</label>
																				<select name="subj_id" class="form-control" disabled>
																					<option value="<?php echo $sinfo["subj_id"];?>"><?php echo getSubject($sinfo["subj_id"]);?></option>  
																					<?php 
																						$result = mysqli_query($conn,"SELECT * FROM subj_info");	
																						while ($row = mysqli_fetch_array($result)){ ?>	
																						<option value="<?php echo $row["subj_id"];?>"><?php echo $row["subj_title"];?></option><?php } ?><br/>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Account Number</label>
																				<input name="acc_no" type="text" placeholder=" Account Number" maxlength="10" value="<?php echo $sinfo["acc_no"];?>" class="form-control" <?php echo $personal;?>/>
																			</td>
																			<td>
																				<label>Bank</label>			
																				<select name="bank_id" class="form-control" <?php echo $personal;?>>
																					<?php
																					if (empty($sinfo["bank_id"])){ echo '<option value="">*****Select Bank*****</option>';} else {echo '<option value="'.$sinfo["bank_id"].'">'.getBank($sinfo["bank_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM bank_info");	
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["bank_id"].'">'.$row["bank"].'</option>';
																					}?>
																				</select> 
																			</td>	
																			<td>
																				<label>Date of Employment</label>
																				<input name="emp_date" type="date" placeholder="Date of Employment (DD/MM/YYYY)" value="<?php echo $sinfo["doa"];?>" class="form-control"/>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Post/Job Description</label>
																				<select name="post_id" class="form-control">
																					<?php
																					if (empty($sinfo["post_id"])){ echo '<option value="">*****Select Position*****</option>';} else {echo '<option value="'.$sinfo["post_id"].'">'.getStaffposition($sinfo["post_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM post_info");	
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["post_id"].'">'.getStaffposition($row["post_id"]).'</option>';
																					} ?><br/>
																				</select>
																			</td>
																			<td>
																				<label>Grade/Level</label>
																				 <input name="grade" type="text" placeholder="Grade/Level" value="" class="form-control" readonly> 
																			</td>
																			<td>
																				<label>File Number</label>
																				<input name="file_no" type="text" placeholder="File Number" value="<?php echo $sinfo["file_no"];?>"  class="form-control" > 
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<label>Highest Qualification</label>
																				<select name="qual_id" class="form-control">
																					<?php
																					if (empty($sinfo["qual_id"])){ echo '<option value="">*****Select Qualification*****</option>';} else {echo '<option value="'.$sinfo["qual_id"].'">'.getQualification($sinfo["qual_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM qual_info");	
																					while ($row = mysqli_fetch_array($result)){	
																					echo '<option value="'.$row["qual_id"].'">'.getQualification($row["qual_id"]).'</option>';
																					} ?><br/>
																				</select> 
																			</td>
																			<td>
																				<label>Discipline</label>
																				<input name="disc" type="text" placeholder=" Discipline" value="<?php echo $sinfo["discipline"];?>" class="form-control"/>
																			</td>
																			<td>
																				<label>Rank</label>
																				<select name="rank_id" class="form-control">
																					<?php
																					if (empty($sinfo["rank_id"])){ echo '<option value="">*****Select Rank*****</option>';} else {echo '<option value="'.$sinfo["rank_id"].'">'.getRank($sinfo["rank_id"]).'</option>';}
																					$result = mysqli_query($conn,"SELECT * FROM rank_info");
																					while ($row = mysqli_fetch_array($result)){	?>
																					<option value="<?php echo $row["rank_id"];?>"><?php echo $row["rank"];?></option><?php } ?><br/>
																				</select>
																			</td>
																		<tr>
																	</table>		  
																</fieldset>
																<fieldset>
																	<legend><i class="fa fa-map-marker-alt mr-1"></i>&nbsp;Contact Address</legend>
																	<table align="center" border="0"  class="table">	
																		<tr>
																			<td align="left">
																				<label>Contact Address</label>
																			   <textarea name="address" cols="2" rows="2" class="form-control" placeholder="Contact Address"><?php echo $sinfo["address"]; ?></textarea>
																		   </td>
																		</tr>
																	</table>
																</fieldset>
																<div class="modal-footer">
																	<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
																	<input type="reset" value="Reset" class="btn btn-danger"/>
																	<input name="submit" type="submit" value="Save" class="btn btn-primary"/>
																</div>
															</form>
															<style>
																#form {
																	max-width: 900px;
																	margin: 0 auto;
																	padding: 20px;
																	border: 1px solid #ddd;
																	border-radius: 5px;
																	background-color: #f5f5f5;
																	font-family: Arial, sans-serif;
																}
															</style>

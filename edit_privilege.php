<?php $page_title = "Edit Privilege"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$uid="";
if (isset($_GET['uid'])) {
    $uid = decrypt($_GET['uid']);
    $result = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$uid' AND staff_info.user_id='$uid'");
	$row = mysqli_fetch_array($result);
	$priv_id = $row["priv_id"];
	
	$result = mysqli_query($conn,"SELECT * FROM form_teacher_info WHERE user_id='$uid'");
	if ($row = mysqli_fetch_array($result)){
		$cid = $row["class_id"];
		$did = $row["cat_id"];
	} else {
		$cid = "";
		$did = "";
	}
}

if (isset($_POST['submit'])) {
	
    $priv_id = addslashes($_POST['priv_id']);
	$class_id = addslashes($_POST['class_id']);
    $cat_id = addslashes($_POST['cat_id']);
	
	if (empty($priv_id)){
		$msg = 'Select a Privilege';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		
	} else if ($priv_id == 2 || $priv_id > 5) {
		// Check whether the record exist
		$result = mysqli_query($conn,"SELECT * FROM form_teacher_info WHERE user_id = '$uid'");
		if (mysqli_fetch_array($result) == 0) {
			// Add the record
			$result = mysqli_query($conn,"INSERT INTO form_teacher_info (user_id,sch_id) VALUES('$uid','$sch_id')");
			//Setting privilege to all except Form Teacher
			$result = mysqli_query($conn,"UPDATE sch_users SET priv_id='$priv_id' WHERE user_id='$uid'");
			if ($result){
				$msg = 'Assigned';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			}
		} else {
				//Setting privilege to all except Form Teacher
				$result = mysqli_query($conn,"UPDATE sch_users SET priv_id='$priv_id' WHERE user_id='$uid'");
			if($priv_id == 2){
				//Delete Other Task
				mysqli_query($conn,"DELETE FROM `form_teacher_info` WHERE `form_teacher_info`.`user_id` = '$uid' AND sch_id = '$sch_id'");
				if ($result){
					$msg = 'Assigned';
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';					
				}
			}
		}
	} else {
		if (empty($priv_id)) {
        $msg = 'Select a Privilege';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		
		} else if (empty($class_id)) {
			$msg = 'Select a Class!';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			
		} else if(empty($cat_id)){
			$msg = 'Select Class Category!';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			
		} else {
			// Check whether the record exist
			$result = mysqli_query($conn,"SELECT * FROM form_teacher_info WHERE user_id = '$uid'");
			if (mysqli_fetch_array($result) == 0) {
				// Add the record
				$result = mysqli_query($conn,"INSERT INTO form_teacher_info (user_id,sch_id,class_id,cat_id) VALUES('$uid','$sch_id','$class_id','$cat_id')");
			} else {
				// Update the record
				$result = mysqli_query($conn,"UPDATE form_teacher_info SET class_id='$class_id', cat_id='$cat_id' WHERE user_id='$uid'");
				
				// Assign privilege
				$result = mysqli_query($conn,"UPDATE sch_users SET priv_id='$priv_id' WHERE user_id='$uid'");
				//
				header("location: register_staff");
			}
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
						<div class="col-md-2">
							<div class="sticky-top mb-3">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b><?php echo getFirstName($uid);?></b></h3>
									</div>
									<div class="card-body">
										<div class="text-center">
											<img class="profile-user-img img-fluid img-circle" src="<?php echo getPassport($user_id);?>" alt="Staff-passport"/>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">	 
										<style> .btn-block{font-size:12px;}</style>
										<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
										<button title="View Staff Profile" onclick="location.href='staff_details?uid=<?php echo encrypt($uid); ?>'"class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> View Staff Profile </button>
										<button title="Edit Staff Details" onclick="location.href='edit_staff?uid=<?php echo encrypt($uid); ?>'"class="btn btn-primary btn-block btn-sm"><i class="fa fa-edit"></i> Edit Staff Profile </button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-10">
							<div class="card" style="padding:10px;">
								<div class="card card-primary" id="selectbox">
									<div class="card-header"><h3 class="card-title">Assign Special Task to Staff</h3></div>
									<!--center style="margin-bottom:10px;"--><?php if (isset($msg)) { echo $msg_toastr;} ?><!--/center-->
									<form action="" method="post">
										<table align="center" border="0" class="table">
											<tr>
												<td align="left">
													<div class="col-md-12">
														<label>Full Name of Staff</label>
														<input name="last_name" type="text" placeholder="Last Name" value="<?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?>"  class="form-control" disabled/> 
													</div>
												</td>
											</tr>
											<tr>
												<td align="left">
													<div class="col-md-12">
														<label>Email Address</label>
														<input name="email" type="email" placeholder="Email Address" value="<?php echo getUsername($uid);?>" class="form-control" disabled/> 
													</div>
												</td>
											</tr>
											<tr>
												<td align="left">
													<div class="col-md-12"> 
														<label>Privilege</label>
														<select name="priv_id" class="form-control">
															<?php
															if (!empty($priv_id)){
																echo '<option value="'.$priv_id.'">'.getPriviledge($priv_id).'</option>';
															} else {
																echo '<option value="'.''.'">'.'Select a Privilege'.'</option>';
															}
															$result = mysqli_query($conn,"SELECT * FROM privileges WHERE privilege_id > 4 AND Privilege_id < 10 OR privilege_id = 2 ");//privilege_id = 2 OR  AND privilege_id=9
															while ($row = mysqli_fetch_array($result)){
																$priv = $row["privilege"];?><option value="<?php echo $row["privilege_id"];?>"><?php echo $priv;?></option>
															<?php } ?>
														</select>
													</div>
												</td>
											</tr>
										</table>
										<table align="center" border="0" class="table">
											<tr>
												<td align="left">
													<div class="col-md-12"> 
														<select name="class_id" id="sel_class" class="form-control">
															<?php
															if (!empty($cid)){
															echo '<option value="'.$cid.'">'.getClass($cid).'</option>';
															} else {
															echo '<option value="'.''.'">'.'Select Class'.'</option>';
															}
															$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
															while ($row = mysqli_fetch_array($result)){
															echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
														</select>
													</div>
												</td>
												<td align="left" width="50%">
													<div class="col-md-12"> 
														<select name="cat_id" id="sel_cat" class="form-control">
															<?php
															if (!empty($did)){
															echo '<option value="'.$did.'">'.getCategory($did).'</option>';
															} else {
															echo '<option value="'.''.'">'.'Select Class Category'.'</option>';
															}
															$result = mysqli_query($conn,"SELECT * FROM class_cat");
															while ($row = mysqli_fetch_array($result)){
															echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
														</select>
													</div>
												</td>
											</tr>
										</table>
										<div class="modal-footer">
											<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
											<button type="reset" id="buttonn" class="btn btn-danger"><i class="fa fa-history"></i> Reset </button>
											<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</section>			
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
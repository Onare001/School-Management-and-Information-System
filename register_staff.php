<?php $page_title = "Register Staff"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit1'])) {
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$username = $_POST['email'];
	$type_id = $_POST['type_id'];
	$dept_id = $_POST['dept_id'];
	
	//constant Values
	$priv_id = "2";//Default Privilege
	$password = md5("2468");//Default Password
	$passport = $last_name.'_'.$firstname.'.jpg';
		
	if (empty($last_name)) {
		$ms = 'Please enter First Name';
		$msg = '<span class="badge bg-danger">'.$ms.'</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
	} else if (empty($first_name)) {
		$ms = 'Please enter Last Name';
		$msg = '<span class="badge bg-danger">'.$ms.'</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
	} else if (empty($username)) {
		$ms = 'Enter staff Email';
		$msg = '<span class="badge bg-danger">'.$ms.'</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
	} else if (empty($type_id)) {
		$ms = 'Select Category';
		$msg = '<span class="badge bg-danger">'.$ms.'</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
	} else if (empty($dept_id)) {
		$ms = 'Select Department';
		$msg = '<span class="badge bg-danger">'.$ms.'</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
	} else {
		$result = mysqli_query($conn,"SELECT username FROM sch_users WHERE username='$username' LIMIT 1");
		$row = mysqli_fetch_array($result); 
		$uname = $row['username'];
		if ($username == $uname){
			$ms = 'This Email Already Exist';
			$msg = '<span class="badge bg-danger">'.$ms.'</span>';
			$msg_toastr = '<script>toastr.warning("'.$ms.'")</script>';
		} else {
			// Insert record
			$insert_user = mysqli_query($conn,"INSERT INTO sch_users (last_name, first_name, username, sch_id, priv_id, password, passport) VALUES ('$last_name','$first_name','$username', '$sch_id', '$priv_id', '$password','$passport')");
			if ($insert_user){
				#$uid = mysqli_insert_id($conn);
				$getUserid = mysqli_query($conn,"SELECT user_id FROM sch_users WHERE username='$username'");
				$row = mysqli_fetch_assoc($getUserid);
				$uid = $row['user_id'];
				$file_no = generateFileNo($sch_id);//strtoupper(getSchAcronym($sch_id)).'/'.date("Y").'/'.$uid;//generating file no

				$insert_staff = mysqli_query($conn,"INSERT INTO staff_info (user_id, sch_id, dept_id, type_id, file_no) VALUES ('$uid','$sch_id','$dept_id','$type_id','$file_no')");
			} 
			//Sucessfully Added
			if (($insert_user) && ($insert_staff)){
				$ms = 'New Staff has been Added';
				$msg = '<span class="badge bg-success">'.$ms.'</span>';
				$msg_toastr = '<script>toastr.success("'.$ms.'")</script>';
			 } else {
				$ms = 'Unable to add New Staff';
				$msg = '<span class="badge bg-danger">'.$ms.'</span>';
				$msg_toastr = '<script>toastr.warning("'.$ms.'")</script>';
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
										<h3 class="card-title"><b>Staff List</b></h3>
									</div>
									<div class="card-body">
										<style> .btn-block{font-size:12px;}</style>	
										<button title="Add New Staff" type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-user-plus"></i> Add New Staff</button>
										<button type="button" onclick="location.href='staff_task_list'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-chalkboard-teacher"></i> Staff Class List </button>
										<button type="button" onclick="location.href='ft_list'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-users"></i> Form Teachers List </button>
										<button type="button" onclick="location.href='staff_record'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-users"></i> Staff Record </button>
										<button type="button" onclick="location.href='staff_profile'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> View Staff Profile </button>
										<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b></b></h3>
									</div>
									<div class="card-body">
										<div id="external-events" style="font-size:12px;">
										<?php
											echo '<div class="external-event bg-danger"><i class="fa fa-users"></i> Total No. of Saff: '. getNumStaff($sch_id).'</div>
											<div class="external-event bg-pink"><i class="fa fa-user-tie"></i> Academic Staff: '.  getNumStafftype($sch_id, 1).'</div>
											<div class="external-event bg-primary"><i class="fa fa-users"></i> Non Acad Staff: '. getNumStafftype($sch_id, 2).'</div>';?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-10">
							<div class="card">
<?php if (isset($msg)) { echo $msg_toastr; }?>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead class="custom">
										  <tr>
											<th style="width:5%;">S/N</th>
											<th style="width:10%;">Passport</th>
											<th style="width:10%;">File No.</th>
											<th style="width:30%;">Full Name of Staff</th>
											<th style="width:20%;">Email Address</th>
											<th align="center">Action(s)</th>
											<!--th>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch" checked data-tid="" data-state="" data-table="">
													<label class="custom-control-label" for="customSwitch"></label>
												</div>
											</th-->
										  </tr>
										</thead>
										<tbody>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM sch_users WHERE sch_id = '$sch_id' AND (priv_id = 2 OR priv_id>4 && priv_id<10)");
										if ($result){											
										while ($row = mysqli_fetch_array($result)){	
											echo '
											<tr>
												<td align="center">'.++$counter.'</td>
												<td align="center">
													<img src="'.getPassport($row["user_id"]).'" alt="'.getFirstname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/>
												</td>
												<td align="center">'.getFileNo($row["user_id"])/*$row['file_no']*/.'</td>
												<td><a href="staff_details.php?uid='.encrypt($row["user_id"]).'">'.getLastname($row["user_id"]).' '.getFirstname($row["user_id"]).'</a></td>
												<td>'.getUsername($row["user_id"]).'</td>
												<td align="center">
													<div class="btn-group">
														<!--a href="staff_details?uid=<?php echo encrypt($row["user_id"]); ?>"><button title="Staff Details" class="btn btn-success view-btn"><i class="fas fa-user-tie"></i></button></a-->
														<a href="edit_privilege?uid='.encrypt($row["user_id"]).'"><button title="Edit Privilege" class="btn btn-warning edit-btn"><i class="fa fa-edit"></i></button></a>
														<a href="admin_compose?uid='.encrypt($row["user_id"]).'"><button title="Send Message" class="btn btn-primary view-btn"><i class="fa fa-envelope"></i></button></a>
														<a href="confirm_delete?uid='.encrypt($row["user_id"]).'"><button onclick="return confirm(\'Are you sure you want to delete '.getLastname($row["user_id"]).' '.getFirstname($row["user_id"]).'\?\');"title="Delete" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i></button></a>
													</div>
												</td>
												<!--td align="center">
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="customSwitch'.$row['user_id'].'" '; echo ($row['status'] == '1') ? 'checked' : ''; echo 'data-uid="'.$row['user_id'].'" data-state="'; echo ($row['status'] == '1') ? '1' : '0'; echo '" data-table="staff_record">
														<label class="custom-control-label" for="customSwitch'.$row['user_id'].'"></label>
													</div>
												</td-->
											</tr>';
											} 
										} else {
											echo '<script>toastr.error("'.mysqli_error($conn).'")</script>';
										}
										?>            
										</tbody>
										<tfoot>
											<tr>
											<th style="width:5%;">S/N</th>
											<th style="width:10%;">Passport</th>
											<th style="width:10%;">File No.</th>
											<th style="width:30%;">Full Name of Staff</th>
											<th style="width:20%;">Email Address</th>
											<th align="center">Action(s)</th>
											<!--th>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch" checked data-tid="" data-state="" data-table="">
													<label class="custom-control-label" for="customSwitch"></label>
												</div>
											</th-->
											</tr>
										</tfoot>
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
						  <h4 class="modal-title"><i class="fa fa-user-plus"></i>&nbsp;Register Staff</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<center style="color:red;" class="error"><?php if (isset($msg)) { echo $msg; }?></center>
						<form action="register_staff" method="post" autocomplete="off">
							<div class="modal-body">
								<input name="scid" type="hidden" id="scid" value="<?php echo $sch_id;?>">
							  <p><input name="last_name" id="last_name" value="<?php echo (isset($_POST['last_name'])) ? $_POST['last_name'] : '';?>" type="text" placeholder="Surname" class="form-control"/></p>
							  <p><input name="first_name" id="first_name" value="" type="text" placeholder="Other name(s)" onkeyup="generateEmail()" class="form-control"/></p>	  
							  <p><input name="email" id="result" value="" type="email" placeholder="Email Address" class="form-control" readonly/></p>
							  <p><select name="type_id" id="type_id" class="form-control">
									<?php
									echo '<option value="">'.'Category'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM staff_type_info");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["type_id"].'">'.$row["staff_type"].'</option>'; } ?><br/>
								</select></p>
							  <p><select name="dept_id" id="dept_id" class="form-control">   
									<?php
									echo '<option value="">'.'Department'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM department");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["dept_id"].'">'.$row["department"].'</option>'; } ?><br/>
								</select></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="reset" value="Reset" class="btn btn-danger"/>
								<input name="submit1" type="submit" value="Register" class="btn btn-primary">
							</div>
						</form>			
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<script>
function generateEmail() {
	var firstName = document.getElementById("first_name").value;
	var lastName = document.getElementById("last_name").value;
	var schDomain = document.getElementById("scid").value;

    // Make AJAX request to generate email address
    $.ajax({
        type: "POST",
        url: "include/ajax/generate_stf_email.php",
        data: { first_name: firstName, last_name: lastName, scid: schDomain },
        success: function(response) {
            document.getElementById("result").value = response;
        }
    });
}
</script>
<?php include ('include/page_scripts/datatables.php');?>
</html>
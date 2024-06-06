<?php $page_title = "Student Payment Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
$susername="";
if (isset($_POST['submit'])) {
    $susername = addslashes($_POST['student_id']);
    if (empty($susername)) {
        $msg = ' Please Enter Student ID';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { 
		// Verify if Student ID Exist
		$verify = "SELECT username FROM sch_users WHERE username='$susername' AND priv_id='3'";
		$result = mysqli_query($conn,$verify);
		
		$suid = getUserid($susername);
		
		if(mysqli_num_rows($result) == true){
			header("location: stu_payment_history?uid=" . encrypt($suid));
		} else {
			$msg = 'Invalid Student ID';
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
<?php if (isset($msg)) { echo $msg_toastr;} ?>
			<div class="card card-primary" id="selectbox">
				<div class="card-header">
					<h3 class="card-title">Enter Student ID | Payment History</h3>
				</div>
				<form action="" method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Student ID</label>
							<input type="text" name="student_id" placeholder="Enter Student ID E.G SMS0/JS123A/000" class="form-control"/>
						</div>
						<div class="card" style="float:right;">
							<button type="submit" name="submit" class="btn btn-primary">View History</button>
						</div>
					</div>              
				</form>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
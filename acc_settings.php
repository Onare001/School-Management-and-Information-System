<?php $page_title = "Enter PSK"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
$psk = "";
if (isset($_POST['submit'])) {
    $psk = addslashes($_POST['psk']);
    if (empty($psk)) {
        $msg = 'Enter Setting Pin';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { 
		$check = "SELECT phone FROM sch_info WHERE phone='$psk' AND sch_id='$sch_id'";
		$result = mysqli_query($conn,$check);
		if(mysqli_num_rows($result) == true){
			$_SESSION['phone'] = $row['phone'];
			header("location: acct_settings");
		} else {
			$msg = 'Invalid PSK';
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
					<h3 class="card-title">Enter PSK | Account Settings</h3>
				</div>
				<form action="" method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Setting</label>
							<input type="password" name="psk" placeholder="Enter PSK" class="form-control"/>
						</div>
						<div class="card" style="float:right;">
							<button type="submit" name="submit" class="btn btn-primary">Proceed</button>
						</div>
					</div>              
				</form>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
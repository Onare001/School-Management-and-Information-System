<?php $page_title = "Report a Bug"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_POST['submit'])){
	$report = addslashes($_POST['report']);
	if (empty($report)){
		$msg = "Type Your Report";
	} else{
		$sql1 = "INSERT INTO `report_log`(`user_id`, `sch_id`, `report`) VALUES ('$user_id','$sch_id','$report')";
		$result5 = mysqli_query($conn,$sql1);
		if ($result5 == true){
			$msg = "Your Report has been Submitted And will be Acted On";
		} else {
			//$msg = "An Error Occured";
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
				<div class="card">
					<div class="card-body row">
						<div class="col-5 text-center d-flex align-items-center justify-content-center">
							<div class=""><img src="assets/img/ntt.gif"/></div>
						</div>
						<div class="col-7">
							<p style="color:red;text-align:center;" class="error"><?php if (isset($msg)) { echo ''. $msg;} ?></p>
							<form action="" method="post">
								<div class="form-group">
									<label for="inputName">Name</label>
									<input type="text" id="inputName" value="<?php echo getLastname($user_id).'&nbsp;'.getFirstname($user_id);?>" class="form-control" disabled/>
								</div>
								<div class="form-group">
									<label for="inputEmail">E-Mail</label>
									<input type="email" id="inputEmail" value="<?php echo getUsername($user_id);?>" class="form-control" disabled/>
								</div>
								<div class="form-group">
									<label for="inputSubject">Subject</label>
									<input type="text" id="inputSubject" class="form-control" disabled/>
								</div>
								<div class="form-group">
									<label for="inputMessage">Message</label>
									<textarea id="inputMessage" name="report" class="form-control" rows="4"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-primary" value="Submit Report">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
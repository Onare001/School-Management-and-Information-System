<?php $page_title = "Change Profile Picture"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
			<div class="card card-primary" id="selectbox">
				<div class="card-header"><h3 class="card-title"><i class="fa fa-user"></i> Change Passport</h3></div>
				<?php include 'change_user_passport.php'?>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
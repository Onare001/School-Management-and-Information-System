<?php $page_title = "Lock Screen"; ?>
<?php include ('include/connection.php');  include ('functions/functions.php'); ?>
<?php
if (isset($_GET['u'])) {
    $user_id = ($_GET['u']);//Username   
	}
	$result = mysqli_query($conn,"SELECT * FROM sch_users WHERE username='$user_id' LIMIT 1");
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>School Management System | <?php echo $page_title;?></title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<link rel="shortcut icon"  href="assets/img/sms3.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=0.29">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.min.css">
	</head>
	<body class="hold-transition lockscreen" style="background-color:blue;background: url(assets/login_bg.jpg); background-size:100% 100% no-repeat;">
		<div class="lockscreen-wrapper">
			<div class="lockscreen-logo">
				<a href="../../index2.html"><img src="images/<?php echo getSchLogo(1);?>" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="<?php echo getSchName(1);?>"/></a>
			</div>
			<div class="lockscreen-name" style="color:white;"><?php echo strtoupper(getLastname($user_id)).'&nbsp;'.strtoupper(getFirstname($user_id));?></div>
			<div class="lockscreen-item">
				<!-- lockscreen image -->
				<div class="lockscreen-image">
					<img src="<?php echo getPassport($user_id);?>" alt="User Image">
				</div>
				<form class="lockscreen-credentials">
					<div class="input-group">
						<input type="password" class="form-control" placeholder="password">
						<div class="input-group-append">
							<button type="button" name="submit" class="btn">
								<i class="fas fa-arrow-right text-muted"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="help-block text-center">Enter your password to retrieve your session</div>
			<div class="text-center">
				<a href="user_login">Or sign in as a different user</a>
			</div>
			<div class="lockscreen-footer text-center">
			<footer>
				<p align="center" style="padding:0px; color:white; font-size:14px; padding-bottom:30px; text-align:center;">
				<text>Copyright © 2023 SMS. All Rights Reserved. Powered by Niel Technologies <i class="fa fa-wifi"></i> | +2348145162722.&nbsp;</p></text>
			</footer>	
			</div>
		</div>
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
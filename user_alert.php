<?php 
$page_title = "Alert";
session_start(); include ("include/connection.php"); include ("functions/functions.php");
$sch_id = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> School Management System | <?php echo $page_title;?> </title>
	<meta name="keywords" content="School Management System"/>
	<meta name="description" content="Niel Technologies">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<link rel="shortcut icon"  href="assets/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
	<link rel="icon" type="image/x-icon" sizes="16x16" href="assets/img/favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/sms.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<img src="assets/img/<?php echo 'sms3.png';?>" alt="img" class="water_mark"/>
<body style="background: url(assets/img/bg2.png);">
	<?php
	//Information to Administrator
	if ($_SESSION['priv_id'] == 1 || $_SESSION['priv_id'] == 9) {
		echo '<div align="center" style="width:100%; margin:auto; margin-top:150px; margin-bottom:20px; max-width:550px; border:0px solid #CCC;">
		<div class="card card-danger" style="color:; margin:auto; width:auto;">
		<div class="card-header" style="text-align:left;">Access Denied! <img src="assets/img//alert.png" class="img-responsive" style="float:right;"></div>
		<div align="center" style=" margin:auto; padding:15px;">
		<div style="width:auto; height:auto; padding:15px;">
		 Your Account has been deactivated. Update is needed, Pay your Yearly Maintenance Fee to <p><b> DANIEL TAYO ONARE<br> ACCESS BANK Plc<br> Account Number: 0109309870</b><br> and Call<b> +2348145162722 </b> to Activate Your Account. Thank you!
		 </div>
		&nbsp;&nbsp;<a href="user_login" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> BACK </div></a>
		
		&nbsp;&nbsp;<a href="enter_actv_pin" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-key">&nbsp;&nbsp;</i> CLICK HERE TO ACTIVATE </div></a>
		
		&nbsp;&nbsp;<a href="index" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"> EXIT &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div></a>
		</div>
		</div>
	   </div>     
	</div>';
	}
	?>

	<?php
	//Information to Staff
	if ($_SESSION['priv_id'] == 2 || $_SESSION['priv_id'] > 4 && $_SESSION['priv_id'] < 9) {
		echo '<div align="center" style="width:100%; margin:auto; margin-top:150px; margin-bottom:20px; max-width:550px; border:0px solid #CCC;">
		<div class="card card-danger" style="color:; margin:auto; width:auto;">
		<div class="card-header" style="text-align:left;">Access Denied! <img src="assets/img//alert.png" class="img-responsive" style="float:right;"></div>
		<div align="center" style=" margin:auto; padding:15px;">
		<div style="width:auto; height:auto; padding:15px;">
		 Your Account has been deactivated. Contact your School<b> Administrator</b> to Activate Your Account. Thank you!
		 </div>
		<!--a href="user_login.php"><input name="" type="submit" value="" class="btn btn-primary" />
		<form action="user_login.php" method="post"><input name="" type="submit" value="" class="btn btn-primary" />
		<form action="logout.php" method="post"><input name="" type="submit" value="" class="btn btn-primary" /></form-->

		&nbsp;&nbsp;<a href="user_login.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> BACK </div></a>
		
		&nbsp;&nbsp;<a href="index.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"> EXIT &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div></a>
		</div> 
		</div>
	   </div>     
	</div>';
	}
?>

	<?php
	//Information to Student
	if ($_SESSION['priv_id'] == 3) {
		//include ("include/lock_student.php");
		echo '<div align="center" style="width:100%; margin:auto; margin-top:150px; margin-bottom:20px; max-width:550px; border:0px solid #CCC;">
		<div class="card card-danger" style="color:; margin:auto; width:auto;">
		<div class="card-header" style="text-align:left;">Access Denied! <img src="assets/img/alert.png" class="img-responsive" style="float:right;"></div>
		<div align="center" style=" margin:auto; padding:15px;">
		<div style="width:auto; height:auto; padding:15px;">
		 Your Account has been deactivated. Pay your School Charges to <p><b>';?> 
	
		<text style="text-transform:uppercase; font-weight:bold; font-size:18px;"><?php echo getSchname($sch_id);?></text>
	
		<br> <?php echo 'SCHOOL BANK Plc<br> Account Number: SCHOOL ACCOUNT NUMBER</b><br> and Submit your Receipt to <b> School Bursary Unit </b> to Activate Your Account. Thank you!
		 </div>
		<!--a href="user_login.php"><input name="" type="submit" value="" class="btn btn-primary" />
		<form action="user_login.php" method="post"><input name="" type="submit" value="" class="btn btn-primary" />
		<form action="logout.php" method="post"><input name="" type="submit" value="" class="btn btn-primary" /></form-->
		&nbsp;&nbsp;<a href="user_login.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> BACK </div></a>
		
		&nbsp;&nbsp;<a href="index.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"> EXIT &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div></a>
		</div> 
		</div>
	   </div>     
	</div>';
	}
?>
		<footer>
			<p align="center" style="padding:0px; color:; font-size:13px; padding-bottom:30px; text-align:center; color:white;"> Copyright © 2023 SMS.  Powered by Niel Technologies +2348145162722. All rights reserved. &nbsp;</p>
		</footer>
	</body>
</html>
<style>
.water_mark {
	position: absolute;
	width: 700px;
	height: 700px;
	top: 50%;
	left: 50%;
	opacity:0.05;
	transform: translate(-50%, -50%);
	background-color: rgba(255, 255, 255, 0.1);
	padding: 0px;
	display: list-item;
	list-style-position: inside;
	pointer-events: none;
}
.water_mark::before {
	content: "";
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background-color: transparent;
	pointer-events: auto;
}
</style>
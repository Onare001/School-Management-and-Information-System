<?php 
$page_title = "Site Alert"; include ("include/connection.php"); include ("functions/functions.php");
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
		<meta name="keyword" content="<?php echo getSchname($sch_id);?>">
		<link rel="shortcut icon"  href="assets/img/sms3.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=0.29">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.min.css">
	</head>
	<body style="background: url(assets/img/bg2.png);">
		<div align="center" style="width:100%; margin:auto; margin-top:150px; margin-bottom:20px; max-width:500px; border:0px solid #CCC;">
			<div class="card card-danger" style="color:; margin:auto; width:auto;">
				<div class="card-header" style="text-align:left;">Information! <img src="images/alert.png" class="img-responsive" style="float:right;"></div>
					<div align="center" style=" margin:auto; padding:15px;">
						<div style="width:auto; height:auto; padding:15px;">
							This Site is Being Maintained 
							<p>Please, Check Back Later Thank you!
						</div>
						&nbsp;&nbsp;<a href="user_login.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> BACK </div></a>

						&nbsp;&nbsp;<a href="index.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"> EXIT&nbsp;<i class="fa fa-arrow-right"></i></div></a>
					</div>   
			</div>
		</div>     	
		<footer>
			<p align="center" style="padding:0px; color:; font-size:13px; padding-bottom:30px; text-align:center; color:white;"> Copyright © 2024 SMS.  Powered by Niel Technologies +2348145162722. All rights reserved. &nbsp;</p>
		</footer>
	</body>
</html>
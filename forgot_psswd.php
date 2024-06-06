<?php $page_title = "Forgot Password"; ?>
<?php include 'include/connection.php'; include 'functions/functions.php'; ?>
<?php
$email = $password = "";
if (isset($_POST['submit'])) {
	$email = $_POST['email'];// User's email address
	
	if (empty($email)) {
		$msg = 'Please Enter your Email!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		$result = mysqli_query($conn, "SELECT * FROM sch_users WHERE username='$email' LIMIT 1");
		$row = mysqli_fetch_array($result);
		if($email==$row['username']){
			$password = rand(100000,999999);//generated pin
			$newpassword = md5($password);//encrypted pin
			
			$from = 'onaretayo@gmail.com';//Sender Address
			$fromName = 'Niel Technologies';//Sender Name
			
			// Email subject
			$subject = "Password Retrival";

			// Email message
			$htmlContent = ' 
				<html> 
					<head> 
						<title>Password Retrival</title> 
					</head> 
					<body>
						<div class="success" style="background-color:blue;color:white;width:500px;height:500px;border-radius:50px;text-align:center;
							padding:10px;margin:0px auto;margin-top:20px;">
							<center><img src="http://superschool.epizy.com/sms/junior/assets/ntt.gif" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="Niel Technologies"/></center>
							<div class="exam_info" style="background-color:darkblue;color:white;">'.'PASSWORD INFO'.'</div>
							<table class="" border="1" width="100%">
								<tr>
									<td>'.'Name'.'</td>
									<td>'.getFirstname(getUserid($email)).'&nbsp;'.getLastname(getUserid($email)).'</td>
								</tr>
								<tr>
									<td>'.'New Pasword'.'</td>
									<td>'.$password.'</td>
								</tr>
							</table>
						</div>
					</body>
				</html>'; 
			 
			// Set content-type header for sending HTML email 
			$headers = "MIME-Version: 1.0" . "\r\n"; 
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			 
			// Additional headers 
			$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
			$headers .= 'Cc: ' . "\r\n"; 
			$headers .= 'Bcc: ' . "\r\n"; 
			 
			// Send email 
			if(mail($email, $subject, $htmlContent, $headers)){
				$result1 = mysqli_query($conn, "UPDATE sch_users SET password = '$newpassword' WHERE username = '$email'");//Save generated pin
				$msg = 'Email sent successfully';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				$redirect = 'user_login';
				header('Refresh: 3; URL=' . $redirect);
			} else {
				$msg = 'Unable to send Password';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		} else {
			$msg = 'Invalid Email Address!';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
		<title>School Management System | <?php echo $page_title;?></title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<link rel="shortcut icon"  href="assets/img/favicon.ico">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.min.css">
		<link rel="stylesheet" href="assets/css/new-style.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Toastr -->
		<script src="assets/jquery/select/select_drop_down.js"></script>
		<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
		<script src="plugins/toastr/toastr.min.js"></script>
	</head>
	<body>
		<div class="app-container app-theme-white body-tabs-shadow" >
			<div class="app-container">
				<div class="h-100">
					<div class="h-100 no-gutters row">
						<div class="d-none d-lg-block col-lg-4">
							<div class="slider-light">
								<div class="slick-slider">
									<div>
										<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
											<div class="slide-img-bg" style="background-image: url('assets/img/img_1.jpg');"></div>
											<div class="slider-content">
												<h3>Revolutionize Your School Management</h3>
												<p>Say Goodbye to Chaos and Hello to Efficiency!</p>
											</div>
										</div>
									</div>
									<div>
										<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
											<div class="slide-img-bg" style="background-image: url('assets/img/img_2.jpg');"></div>
											<div class="slider-content">
												<h3>Empower Your School with Data-Driven Insights</h3>
												<p>Make Informed Decisions for Better Outcomes!</p>
											</div>
										</div>
									</div>
									<div>
										<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
											<div class="slide-img-bg" style="background-image: url('assets/img/img_3.jpg');"></div>
											<div class="slider-content">
												<h3>Join the Digital Revolution</h3>
												<p>Experience the Future of Education Today!</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="h-100 d-flex bg-orange justify-content-center align-items-center col-md-12 col-lg-8">
							 <div class="m-auto col-md-12">
									<div class="login-box mx-auto" style="padding:5px;">
										<div class="mx-auto">
											<div class="card card-outline card-<?php echo $sch_color;?>">
												<div class="card-head text-center">
													<br><img src="assets/img/sms3.png" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="<?php echo getSchName(1);?>"/>
												</div>
												<div class="card-body">
													<p class="login-box-msg" style="color:black;">You forgot your password? Here you can easily retrieve a new password.</p>
													<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
													<form action="forgot_psswd" autocomplete="off" method="post">
														<div class="input-group mb-3">
															<input type="email" name="email" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>" class="form-control" placeholder="Email Address"/>
															<div class="input-group-append">
																<div class="input-group-text">
																	<span class="fas fa-envelope"></span>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-12">
																<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-key"></i> Request new password</button>
															</div>
														</div>
													</form>
													<p class="mt-3 mb-1">
														<a href="user_login">Login</a>
													</p>
												</div>		
											</div>
										</div>
									</div>
								<footer>
									<p align="center" style="padding:0px; color:white; font-size:14px; padding-bottom:30px; text-align:center;">
									<text>Copyright © 2023 SMS. All Rights Reserved. Powered by Niel Technologies <i class="fa fa-wifi"></i> | +2348145162722.&nbsp;</p></text>
								</footer>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/slick.min.js"></script>
		<script>
		  $(document).ready(function(){
			$('.slick-slider').slick({
			  dots: false, // show navigation dots
			  autoplay: true, // autoplay slides
			  autoplaySpeed: 2000, // time between each slide in milliseconds
			  arrows: false, // hide arrow navigation
			  fade: true, // fade images as transition
			  speed: 1000, // transition speed in milliseconds
			});
		  });
		</script>
		<style>
			/* Define the animation */
			@keyframes login-box {
			  0% {
				opacity: 0;
				transform: translateY(-20px);
			  }
			  100% {
				opacity: 1;
				transform: translateY(0);
			  }
			}
			/* Apply the animation to the div class */
			.login-box {
			  animation: login-box 1s ease-out;
			}
		</style>
	</body>
</html>
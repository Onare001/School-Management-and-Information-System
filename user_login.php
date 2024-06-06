<?php $page_title = "Log in"; ?>
<?php include 'include/authenticate.php';?>
<?php include ("functions/functions.php"); ?>
<?php 
if (!$_SESSION['selected_database']){
	header('location: index');
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
												<div class="bg-<?php echo $sch_color;?>" style="font-size:15px;text-align:center;"><?php echo getSchSection(1);?></div>
												<div class="card-head text-center">
													<br><img src="<?php echo getSchLogo(1);?>" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="<?php echo getSchName(1);?>"/>
												</div>
												<div class="card-body">
													<span class="btn btn-block btn-<?php echo $sch_color;?> btn-flat"><i class="fa fa-school"></i> School Management System || LOGIN</span>
													<center>
														</p><!--span class="badge bg-danger text-center"></span></p--><?php if (isset($msg) && isset($msg_toastr)){echo $msg_toastr;} ?>
													</center>
													<form action="" method="post" autocomplete="off">
														<div class="input-group mb-3">
															<input type="text" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : '';?>" class="form-control" placeholder="LOGIN ID" id="exampleInputEmail1"/>
															<div class="input-group-append">
																<div class="input-group-text">
																  <span class="fas fa-user"></span>
																</div>
															</div>
														</div>
														<div class="input-group mb-3">
															<input type="password" name="password" class="form-control" placeholder="Password" onkeydown="checkCapsLock()"/>
															<div class="input-group-append">
																<div class="input-group-text">
																  <span class="fas fa-key"></span>
																</div>
															</div>
														</div>
														<div id="capsWarning" style="display:none;color:red;text-align:center;">Caps Lock is on!</div>
														<p class="mb-1"><a href="forgot_psswd">I forgot my password</a></p>
														<div class="row">
															<div class="col-6">
																<button type="button" onclick="location.href='index'" class="btn btn-danger btn-block">EXIT</button>
															</div>
															<div class="col-6">
																<button type="submit" name="submit" class="btn btn-primary btn-block">SIGN IN</button>
															</div>
														 </div>
													</form>	
												</div>		
											</div>
										</div>
									</div>
								<footer>
									<p align="center" style="padding:0px; color:white; font-size:14px; padding-bottom:30px; text-align:center;">
									<text>Copyright © 2024 SMS. All Rights Reserved. Powered by Niel Technologies <i class="fa fa-wifi"></i> | +2348145162722.&nbsp;</p></text>
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
		  
		  function checkCapsLock() {
			var capsLockWarning = document.getElementById('capsWarning');
			var passwordInput = document.getElementById('password');

			// Check if Caps Lock is pressed
			var isCapsLockOn = event.getModifierState('CapsLock');

			if (isCapsLockOn) {
				capsLockWarning.style.display = 'block';
			} else {
				capsLockWarning.style.display = 'none';
			}
		}
		</script>
	</body>
</html>
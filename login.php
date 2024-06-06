<?php $page_title = "Log in"; ?>
<?php 
session_start(); 
//Database connection
include ("include/connection.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
//Validate entries
    $username = validate($_POST['username']);
    $password = md5(validate($_POST['password']));
    if (empty($username)) {
		$msg = 'Username is Required!';
    }else if(empty($password)){
		$msg = 'Password is Required!';
    }else{
        $sql = "SELECT * FROM web_admin WHERE username='$username' AND password='$password' LIMIT 1";//
		$result = mysqli_query($conn,$sql);
		$privilege_id = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) === 1) {
				//Administrator
				if ($privilege_id['priv_id'] == 4 && $privilege_id['status'] == 1) {
					$_SESSION['username'] = $privilege_id['username'];
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: admin");
				//Staff
				} else { 
					$_SESSION['username'] = '';
					$_SESSION['password'] = '';
					$msg = "Invalid Username/Password!";
				}
			} else {
				$_SESSION['username'] = '';
				$_SESSION['password'] = '';
				$msg = "Invalid Username/Password!";
			}
		}
		
    }
include ("functions/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>School Management System | Log in</title>
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
	<body class="hold-transition login-page" style="background-color:blue;background: url(assets/img/login_bg.jpg); background-size:100% 100% no-repeat;">
		<div class="login-box">
			<div class="card card-outline card-secondary">
				<div class="card-header text-center">
					<center><img src="assets/img/sms3.png" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="Niel Technologies"/></center>
				</div>
				<div class="card-body">
					<span class="btn btn-block btn-<?php echo $sch_color;?> btn-flat"><i class="fa fa-school"></i> School Management System || LOGIN</span>
					<center>
						</p><span class="badge bg-danger text-center"><?php if (isset($msg) && isset($msg_toastr)){echo $msg.$msg_toastr;} ?></span></p>
					</center>
					<form action="" method="post" autocomplete="off">
						<div class="input-group mb-3">
							<input type="text" name="username" value="<?php if (isset($_POST['username'])){
								echo $_POST['username']; 
							} ?>" class="form-control" placeholder="Username@gmail.com" style="max-height:;"/>
							<div class="input-group-append">
								<div class="input-group-text">
								  <span class="fas fa-user"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" name="password" class="form-control" placeholder="Password" style="max-height:;"/>
							<div class="input-group-append">
								<div class="input-group-text">
								  <span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						<p class="mb-1">
							<a href="forgot_psswd">I forgot my password</a>
						</p>
						<div class="row">
							<div class="col-6">
								<a href="index.php"><div class="btn btn-danger btn-block">EXIT</div></a>
							</div>
							<div class="col-6">
								<button type="submit" name="submit" class="btn btn-primary btn-block">SIGN IN</button>
							</div>
						 </div>
					</form>	  
				</div>		
			</div>
		</div>
		<br>
		<footer>
			<p align="center" style="padding:0px; color:white; font-size:14px; padding-bottom:30px; text-align:center;">
			<text>Copyright © 2023 SMS. All Rights Reserved. Powered by Niel Technologies <i class="fa fa-wifi"></i> | +2348145162722.&nbsp;</p></text>
		</footer>	
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
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
</html>
<?php $page_title = "Log in"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); ?>
<?php
if (isset($_POST['submit'])) {
    $f_name = trim(addslashes($_POST['first_name']));
    $l_name = trim(addslashes($_POST['last_name']));
    $phone_no = addslashes($_POST['phone_no']);
    $email = trim(addslashes($_POST['email']));
    $password = md5(trim(addslashes($_POST['password'])));
    $confirm = Md5(trim(addslashes($_POST['confirm'])));
    $sch_name = trim(addslashes($_POST['sch_name']));
	$sch_logo = "logo.jpg";
	$passport = "avatar.jpg";
    $agree = $_POST['agree'];
	$date = date('d'.'/'.'m'.'/'.'Y');
    if (empty($sch_name)) {
        $msg = 'School name is required!';
    } else if (empty($f_name)) {
        $msg = 'Please Enter School Admin First Name';
    } else if (empty($l_name)) {
        $msg = 'Please Enter School Admin Last Name';
    } else if (empty($phone_no)) {
        $msg = 'Please Enter School Phone Number';
    } else if (empty($email)) {
        $msg = 'Please Enter School Email Address';
    } else if (empty($password)) {
        $msg = 'Password required!';
    } else if (empty($confirm)) {
        $msg = 'Confirm your Password!';
    } else if (!is_numeric($phone_no)) {
        $msg = 'Only numbers are allowed!';
    } else if (strlen($password) < 6) {
        $msg = 'Password must be at least 6 characters!';
    } else if ($password != $confirm) {
        $msg = 'Password Mismatched!';
    } else if(empty($agree)) {
		$msg = 'Please Agree to our Terms & Conditions!';
    } else {
        // Query1
        $query1 = "INSERT INTO sch_info(email,phone,sch_name,sch_logo,terms_condition,date_created) VALUES('$email','$phone_no','$sch_name','$sch_logo','$agree','$date')";
		$result1 = mysqli_query($conn,$query1);
        if (!$result1) {
            $msg = '<div class="alert alert-warning">Your account already exist!</div>';
        } else {
            $query2 = "SELECT sch_id FROM sch_info WHERE email = '$email'";
			$result2 = mysqli_query($conn,$query2);
            $row = mysqli_fetch_array($result2);
            $sch_id = $row['sch_id'];
            // Query3
            $query3 = "INSERT INTO sch_users (priv_id,sch_id,first_name,last_name,username,password,passport,registered_date)	VALUES(1,'$sch_id','$f_name','$l_name','$email','$password','$passport','$date')";
			$result3 = mysqli_query($conn,$query3);
            //Query 4
            $query4 = "UPDATE sch_users SET status = '0' WHERE sch_id = '$sch_id'";
			$result4 = mysqli_query($conn,$query4);
            $msg = 'Your account has been created Successfully!';
        }
    }
}
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
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.min.css">
	</head>
	<body class="hold-transition register-page" style="background: url(assets/img/login_bg.jpg); background-size:100% 100%;margin-top:50px;">
		<div class="card card-danger">
			<a href="#" class="btn btn-block btn-primary btn-flat">
					<i class="fa fa-school" ></i> School Management System || SIGN UP</a>
			<div class="text-center">
				<img src="assets/img/sms_logo.png" alt="logo" style="max-width:60px; padding-bottom:7px;"  class="user-image"/>
			</div>
			<p style="color:red;text-align:center;" class="bg bg-danger"><?php if (isset($msg)) { echo $msg;} ?></p>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="sch_name" type="text" placeholder="School Name" class="form-control">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-school"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="first_name" type="text" placeholder="Admin First Name" class="form-control" >
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="last_name" type="text" placeholder="Admin Last Name" class="form-control" >
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="phone_no" type="text" placeholder="Phone Number" maxlength="11" class="form-control" >
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-phone"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-group mb-3">
								<input type="email" name="email" class="form-control" placeholder="Username@gmail.com" style="max-height:;">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-envelope"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<input type="text" class="form-control" placeholder="XXXXXXXXXX" disabled>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="password" type="password" placeholder="Password (At least 6 characters)"  minlength="6" class="form-control">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-group mb-3">
								<input name="confirm" type="password" placeholder="Retype password"  minlength="6" class="form-control">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<p class="mb-1">
						<input name="agree" value="agreed" type="checkbox" required> I agree to the <a data-toggle="modal" data-target="#modal-default" href="#">terms</a>
						</p>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<!--button type="submit" name="submit" class="btn btn-primary btn-block">Register</button-->
						</div>					
						<div class="col-4">
							<a href="index.php"><div class="btn btn-danger btn-block">Exit</div></a>
						</div>
						<div class="col-4">
							<button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title">Terms and Conditions</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					
    <header>
        <h1>[Your Company Name] School Management Software</h1>
        <h2>Terms and Conditions</h2>
        <p>Last Updated: [Date]</p>
    </header>

    <section>
        <h3>1. Definitions</h3>
        <p>"Software" refers to [Your Company Name] School Management Software.</p>
        <p>"User" refers to any individual or entity accessing or using the software.</p>
    </section>

    <section>
        <h3>2. License</h3>
        <p>[Your Company Name] grants the user a non-exclusive, non-transferable, limited license to use the software for its intended purpose, subject to these terms and conditions.</p>
    </section>

    <!-- Add more sections for each point in your terms and conditions -->

    <section>
        <h3>14. Contact Information</h3>
        <p>For questions or concerns regarding these terms and conditions, please contact [Your Company Name] at [Contact Email].</p>
    </section>


				</div>
			</div>
		</div>
		<footer>
			<p align="center" style="padding:0px; color:white; font-size:13px; padding-bottom:50px; padding-bottom:30px; text-align:center;">
				<text>Copyright © 2023 SMS. All rights reserved. Powered by Niel Technologies <i class="fa fa-whatsapp"></i>+2348145162722.	&nbsp; 
			</p>
		</footer>
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="assets/js/main.min.js"></script>
	</body>
</html>
<?php
$page_title = "Complete School Registration";
// connect to the database
include ('include/connection.php'); include ('include/lock_admin.php');
if (isset($_POST['submit'])) {
    $sch_motto = addslashes($_POST['sch_motto']);
	$sch_address = addslashes($_POST['sch_address']);
	$other_phone = addslashes($_POST['other_phone']);
    $state_id = addslashes($_POST['state_id']);
	$sch_pmb = addslashes($_POST['sch_pmb']);
    $sch_color = addslashes($_POST['sch_color']);
	if (empty($sch_motto)) {
        $msg = 'Please enter the School Motto!';
    } else if (empty($sch_address)) {
        $msg = 'Please enter the school address!';
    } else if (empty($other_phone)) {
        $msg = 'Please enter other Phone Number';
    }  else if (empty($state_id)) {
        $msg = 'Please select your state!';
    } else if (empty($sch_pmb)) {
        $msg = 'Please enter your school P.M.B';
    } else if (empty($sch_color)) {
        $msg = 'Please Select School Color';
    } else { // Query
        $result = mysqli_query($conn,"UPDATE sch_info SET sch_motto='$sch_motto', sch_address='$sch_address', other_phone='$other_phone', state_id='$state_id', sch_pmb='$sch_pmb', theme_code='$sch_color' WHERE sch_info.sch_id='$sch_id'");
        if (!$result) {
            $msg = '&nbsp;&nbsp;Your School has already been registered!';
        } else {
            header("location: admin_dashboard.php");
        }

    }
}

include ("functions/functions.php");
$sql = mysqli_query($conn,"SELECT * FROM sch_info WHERE sch_info.sch_id='$sch_id'");
$row = mysqli_fetch_assoc($sql);
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
	<br><br>
	<body class="hold-transition register-page" style="background: url(assets/img/login_bg.jpg); background-size:100% 100%;">
		<div class="register-box">
			<div class="card card-outline card-primary">
				<div class="card-header text-center">
					<center>
						<img src="assets/img/sms_logo.png" alt="logo" style="max-width:60px; padding-bottom:7px;"  class="user-image"/>
					</center>
				</div>
				<div class="card-body">
					<a href="#" class="btn btn-block btn-primary btn-flat"><i class="fa fa-school" ></i> School Management System || COMPLETE SCHOOL REGISTRATION</a><p style="color:red;text-align:center;" class="error"><?php if (isset($msg)) { echo $msg;} ?></p>
					<form action="" method="post">
						<div class="input-group mb-3">
							<input name="sch_motto" type="text" placeholder="School Motto" class="form-control"/>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-school"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input name="sch_address" type="text" placeholder="Address" class="form-control" />
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-map"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input name="other_phone" type="text" placeholder="Other Phone No." class="form-control" />
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-phone"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<select name="state_id" id="state_id" class="form-control">
								<?php
								echo '<option value="">'.'Select State'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM state_info");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["state_id"].'">'.getState($row["state_id"]).'</option>';
								} ?>
							</select>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-map"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="text" name="sch_pmb" class="form-control" placeholder="School P.M.B"/>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-envelope"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<label>School Color</label>&nbsp;
							<input type="color" name="sch_color" class="form-control"/>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-school"></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<a href="index.php"><div class="btn btn-danger btn-block">Exit</div></a>
							</div>
							<div class="col-6">
								<button type="submit" name="submit" class="btn btn-primary btn-block">Next</button>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<br>
		<footer>
			<p align="center" style="padding:0px; color:white; font-size:13px; padding-bottom:50px; padding-bottom:30px; text-align:center;">
			<text>Copyright © 2023 SMS. All rights reserved. Powered by Niel Technologies <i class="fa fa-whatsapp"></i>+2348145162722.
			&nbsp;</p>
		</footer>
	</body>	
<?php include ('include/page_scripts/general_script.php');?>
</html>
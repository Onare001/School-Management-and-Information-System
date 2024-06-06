<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_database = base64_decode($_POST['section']);

    if (empty($selected_database)) {
		$ms = 'Kindly Select the School Section you want to Access';
		$msg = '<span class="bg bg-danger">&nbsp;'.$ms.'&nbsp;</span>';
		$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
    } else {
        $conn = mysqli_connect('localhost', 'root', '');
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        // Query the list of databases to see if the selected database exists
        $result = mysqli_query($conn,"SHOW DATABASES LIKE '$selected_database'");
        if (mysqli_num_rows($result) === 1) {
            $_SESSION['selected_database'] = $selected_database;
            header('location: portal');
        } else {
			$ms = 'You are not Permitted to Access the Selected Section Contact the Web Administrator.';
			$msg = '<span class="bg bg-danger">&nbsp;'.$ms.'&nbsp;</span>';
			$msg_toastr = '<script>toastr.error("'.$ms.'")</script>';
        }    
        mysqli_close($conn);// Close the database connection
    }
}

function greetBasedOnTime() {
    date_default_timezone_set('Africa/Lagos'); // Set the timezone for Nigeria

    $currentHour = date('G');
    $greeting = '';

    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = 'Good morning';
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }
    return $greeting;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> School Management System </title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<meta name="keyword" content="Niel Technologies">
		<link rel="shortcut icon" href="assets/img/sms3.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=0.29">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/index_style.css">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Drop drop menu -->
		<script src="jquery/select/select_drop_down.js"></script>
		<!-- Toastr -->
		<script src="assets/jquery/select/select_drop_down.js"></script>
		<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
		<script src="plugins/toastr/toastr.min.js"></script>
	</head>
	<body>
		<div class="card">
			<img src="assets/img/<?php echo 'sms3.png';?>" alt="img" class="water_mark"/>
			<div class="logo"><img src="assets/img/<?php echo 'sms3.png';?>" width="100px" height="100px" /></div>
			<div class="school-name" align="center">
				<h2 style="font-family:Imprint MT Shadow; margin:0px auto;">School Management System</h2>
			</div>
			<?php //<!--marquee behavior="alternate" direction="left" scrollamount="10" class="bg bg-danger" style="margin-top:5px;">This Version of School Management System would be made available by October 2023</marquee-->;?>
			<div class="bg bg-danger" align="center">
				<span id="info-text"></span>
			</div>
			<hr>
				<h3 align="center" style="font-family:cursive;"><?php echo greetBasedOnTime();?>, I'm ready to get your work simplified today</h3><?php if (isset($ms)){ echo $msg_toastr; } ?>
			<hr>
			<h6 align="center">Select School Section</h6>
			<!--h4 align="center"><?php echo (isset($msg)) ? $msg : ''?></h4-->		
			<div align="center" style="width:60%;margin:0px auto;">
				<form method="post">
					<select name="section" style="text-align:center;font-size:20px;" class="form-control">      
						<option value="">Select School Section</option>
						<option value="<?php echo base64_encode('goldspring_sms_primary');?>">Nursery & Primary School(Nursery 1 - Primary 6)</option>
						<option value="<?php echo base64_encode('goldspring_sms_junior');?>">Junior Secondary School (JS 1 - JS 3)</option>
						<option value="<?php echo base64_encode('sms_senior');?>">Senior Secondary School (SS 1 - SS 3)</option>
					</select>
					<div class="modal-footer">
						<button type="button" onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
						<button type="submit" name="submit" class="btn btn-danger">Continue</button>         
					</div>
				</form>
			</div><br/>
			<hr>
			<div class="footer">
				<small>Copyright © 2024 SMS.&nbsp;<a href="https://api.whatsapp.com/send?phone=2348145162722" target="blank">Powered by Niel Technologies <i class="fa fa-wifi"></i> +2348145162722</a>. All Rights Reserved.</small> 
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 1.23.0
				</div>
			</div>
		</div>
	</body>
	<script>
	  setInterval(function() {
		var element = document.getElementById("info-text");
		element.style.visibility = (element.style.visibility === 'hidden') ? 'visible' : 'hidden';
	  }, 1000); // Blinking interval in milliseconds (e.g., 1000ms = 1 second)
	</script>
<style>
html{
    zoom:100%;
}
</style>
</html>
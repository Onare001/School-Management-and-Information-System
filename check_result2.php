<?php $page_title = "Check Result"; ?>
<?php include ('functions/functions.php'); ?>
<?php
if (isset($_POST['submit'])) {
	$username = $_POST['student_id'];
    $uid = getUserid($username);
	$check_stu_id = mysqli_query($conn,"SELECT * FROM sch_users WHERE user_id='$uid' LIMIT 1");
	$row = mysqli_fetch_assoc($check_stu_id);
	$sch_id = $row['sch_id'];
    $class_id = $_POST['class_id'];
    $cat_id = $_POST['cat_id'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
	if (empty($username)) {
		$msg = 'Enter Student ID!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_enter_student_id.mp3" type="audio/mpeg">
			</audio>';
	} else if(mysqli_num_rows($check_stu_id) == 0){
		$msg = 'Invalid Student ID!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($term_id)) {
        $msg = 'Select Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_term.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    } else { //
		$check_result = mysqli_query($conn,"SELECT score_id FROM score_info WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND term_id='$term_id' AND sid='$session_id'"); //
		if (mysqli_num_rows($check_result)== true){
			$result = mysqli_query($conn,"SELECT score_id FROM score_info WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND term_id='$term_id' AND sid='$session_id' AND status='1'");
			if (mysqli_num_rows($result) == true) {
				$_SESSION['username'] = $username;
				$row = mysqli_fetch_assoc($result);
				header("location: student_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) ."&tid=" . encrypt($term_id) . "&sid=" . encrypt($session_id) . "");
			} else {
				$msg = 'This result is not yet Available';
				$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
				/*echo '<audio controls'.$autoplay.'hidden>
					<source src="audio/msg_student_result.mp3" type="audio/mpeg">
				</audio>';*/
			}
		} else {
			$msg = 'No Result Found for this Student';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_student_result.mp3" type="audio/mpeg">
			</audio>';
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
		<link rel="shortcut icon"  href="assets/img/sms3.png">
		<!-- Theme style -->
		<link rel="stylesheet" href="assets/css/main.min.css">
		<!--link rel="stylesheet" href="assets/css/new-style.css"-->
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Toastr -->
		<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
		<script src="plugins/toastr/toastr.min.js"></script>
	</head>
	<br>
	<body class="hold-transition login-page" style="background-color:blue;background: url(assets/img/login_bg.jpg); background-size:100% 100% no-repeat;margin-top:30px;zoom:93%;">
		<div class="login-box">
			<div class="card card-outline card-<?php echo $sch_color;?>">
			<div class="bg-<?php echo $sch_color;?>" style="font-size:15px;text-align:center;"><?php echo getSchSection(1);?></div>
				<div class="card-header text-center">
					<center><img src="<?php echo getSchLogo(1);?>" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="<?php echo getSchName(1);?>"/></center>
				</div>
				<div class="card-body">
					<span class="btn btn-block btn-<?php echo $sch_color;?> btn-flat"><i class="fa fa-school"></i> School Mgmt System || Check Result</span>
					<center>
						</p><span class="badge bg-danger text-center"><?php if (isset($msg) && isset($msg_toastr)){echo $msg.$msg_toastr;} ?></span></p>
					</center>
					<form action="" method="post" autocomplete="off">
						<div class="input-group mb-3">
							<div class="col-md-12"> 
								<input type="text" name="student_id" value="<?php if (isset($_POST['student_id'])){
									echo $_POST['student_id']; 
								} ?>" class="form-control" placeholder="STUDENT ID" style="max-height:;"/>
							</div>
						</div>
						<div class="input-group mb-3">
							<div class="col-md-12">    
								<select name="class_id" id="sel_class" class="form-control">
									<?php
									echo '<option value="">'.'Select Class'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
									} ?>
								</select>
							</div> 
						</div>
						<div class="input-group mb-3">
							<div class="col-md-12">    
								<select name="cat_id" id="sel_cat" class="form-control">
									<?php
									echo '<option value="">Select Category</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_cat");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>';
									} ?>
								</select>
							</div> 
						</div>
						<div class="input-group mb-3">
							<div class="col-md-12">    
								<select name="term_id" id="sel_term" class="form-control">
									<?php
									echo '<option value="">Select Term</option>';
									$result = mysqli_query($conn,"SELECT * FROM term_info");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
									} ?>
								</select>
							</div> 
						</div>
						<div class="input-group mb-3">
							<div class="col-md-12">    
								<select name="session_id" id="sel_session" class="form-control">
									<?php
									echo '<option value="">Select Session</option>';
									$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
									} ?>
								</select>
							</div> 
						</div>
						<div class="row">
							<div class="col-6">
								<a href="portal"><div class="btn btn-danger btn-block">EXIT</div></a>
							</div>
							<div class="col-6">
								<button type="submit" name="submit" class="btn btn-primary btn-block">CHECK</button>
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
		<?php include ('include/page_scripts/options.php');?>
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
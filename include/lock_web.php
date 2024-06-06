<?php
//session_start();
$result = mysqli_query($conn,"SELECT * FROM web_admin WHERE username='$_SESSION[username]' AND priv_id='4' LIMIT 1");
if ((mysqli_num_rows($result) == 1) && ($_SESSION['priv_id'] == 4)) {	
	$row = mysqli_fetch_array($result);	
	$sch_id = "";//School identifier
	$theme = ""; //School theme code
	$username = $_SESSION['username'] = $row['username']; //Username
	$passport = $_SESSION['passport'] = $row['passport']; //Passport
	$user_id = $_SESSION['admin_id'] = "";//$row['admin_id']; //User_id
	$priviledge = $_p = $_SESSION['priv_id'] = $row['priv_id']; //Priviledge
	
	$url = $url1="";
} else {
	header("Location: index");
	exit();
}

/*if (date("Y"."m") > base64_decode(($sch_year))) {
	mysqli_query($conn,"UPDATE `sch_users` SET `status` = '0' WHERE `sch_users`.`sch_id` = $sch_id");
	mysqli_query($conn,"UPDATE `sch_info` SET `status` = '0' WHERE `sch_info`.`sch_id` = $sch_id");
	header('location: user_alert');
	exit();
} else if (date("Y"."m") < base64_decode(($sch_year2))) {
	header('location: logout');
	exit();
}*/
?>
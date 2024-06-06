<?php
//session_start();
$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_info ON stdnt_info.sch_id = sch_info.sch_id WHERE stdnt_info.parent_contact='$_SESSION[username]' OR parent_email='$_SESSION[username]' LIMIT 1");
if ((mysqli_num_rows($result) == 1) && ($_SESSION['priv_id'] == 10)) {	
$row = mysqli_fetch_array($result);
	$sch_id = $_SESSION['sch_id'] = $row['sch_id']; //School identifier
	$sch_year = $_SESSION['sch_year'] = $row['sch_year']; //School Year
	$sch_year2 = $_SESSION['sch_year2'] = $row['sch_year2']; //Current Year
	$theme = $_SESSION['theme_code'] = $row['theme_code']; //School theme code
	$username = $_SESSION['username'] = $row['parent_contact']; //Username
	$user_id = $_SESSION['stdnt_id'] = ""; //User_id
	$priviledge = $_SESSION['priv_id'] = '10'; //Priviledge
} else {
	 header("Location: index");
	 exit();
}

LockSchool($sch_id, $sch_year, $sch_year2, $priviledge);

$result = mysqli_query($conn,"SELECT * FROM sch_users");
$row = mysqli_fetch_assoc($result); $site_state = $row['status'];
if ($site_state == 3) {
	header('location: site_alert.php');
}

$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE parent_contact='$username' LIMIT 1");
$p_info = mysqli_fetch_assoc($result);
?>
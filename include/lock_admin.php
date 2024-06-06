<?php
$priviledge = $sch_id = $sch_year = $sch_year2 = $theme = $username = $first_name = $last_name = $passport = $user_id = "";
$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN sch_info ON sch_users.sch_id = sch_info.sch_id  WHERE sch_users.username='$_SESSION[username]' LIMIT 1");
if ((mysqli_num_rows($result) == 1) && ($_SESSION['priv_id'] == 1)) {	
	$row = mysqli_fetch_array($result);	
	$sch_id = $_SESSION['sch_id'] = $row['sch_id']; //School identifier
	$theme = $_SESSION['theme_code'] = $row['theme_code']; //School theme code
	$sch_year = $_SESSION['sch_year'] = $row['sch_year']; //School Year
	$sch_year2 = $_SESSION['sch_year2'] = $row['sch_year2']; //Current Year
	$username = $_SESSION['username'] = $row['username']; //Username
	$firstname = $_SESSION['first_name'] = $row['first_name']; //First name
	$lastname = $_SESSION['last_name'] = $row['last_name']; // Last name
	$passport = $_SESSION['passport'] = "passport/".$row['passport']; //Passport
	$user_id = $_SESSION['user_id'] = $row['user_id']; //User_id
	$priviledge = $_SESSION['priv_id'] = $row['priv_id']; //Privilege
	$sch_add = $_SESSION['sch_address'] = $row['sch_address']; //School Address	
} else {
	header("Location: logout");
	exit();
}

LockSchool($sch_id, $sch_year, $sch_year2, $priviledge);

$result = mysqli_query($conn,"SELECT status FROM sch_users");
$row = mysqli_fetch_assoc($result); $site_state = $row['status'];
if ($site_state == '3') {
	header('location: site_alert');
}
?>
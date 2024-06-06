<?php
if (!$_SESSION['selected_database']){
	header('location: index');
}
$priviledge = $sch_id = $sch_year = $sch_year2 = $theme = $username = $first_name = $last_name = $passport = $user_id = "";
//session_start();
$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN sch_info ON sch_users.sch_id = sch_info.sch_id  WHERE sch_users.username='$_SESSION[username]' LIMIT 1");
$result002 = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_info ON stdnt_info.sch_id = sch_info.sch_id WHERE stdnt_info.parent_contact='$_SESSION[username]' OR parent_email='$_SESSION[username]' LIMIT 1");
if ((mysqli_num_rows($result) == 1)) {	
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
	$priviledge = $_SESSION['priv_id'] = $row['priv_id']; //Priviledge
	$sch_add = $_SESSION['sch_address'] = $row['sch_address']; //School Address
	
	if ($priviledge == 3){
		$showdata = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.user_id = '$user_id' ");
		$datarow = mysqli_fetch_array($showdata) ;
	}
	
} else if((mysqli_num_rows($result002) == 1)){
	//parent
	$row = mysqli_fetch_array($result002);
	$sch_id = $_SESSION['sch_id'] = $row['sch_id']; //School identifier
	$sch_year = $_SESSION['sch_year'] = $row['sch_year']; //School Year
	$sch_year2 = $_SESSION['sch_year2'] = $row['sch_year2']; //Current Year
	$theme = $_SESSION['theme_code'] = $row['theme_code']; //School theme code
	$username = $_SESSION['username'] = $row['parent_contact']; //Username
	//$passport = $_SESSION['passport'] = "passport/".$row['passport']; //Passport
	$user_id = $_SESSION['stdnt_id'] = "";//$row['stdnt_id']; //User_id
	$priviledge = $_SESSION['priv_id'] = '10'; //Priviledge
	
	$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE parent_contact='$username' LIMIT 1");
	$p_info = mysqli_fetch_assoc($result);
} else {
	header("Location: logout");
	exit();
}

LockSchool($sch_id, $sch_year, $sch_year2, $priviledge);

$result = mysqli_query($conn,"SELECT * FROM sch_users");
$row = mysqli_fetch_assoc($result); $site_state = $row['status'];
if ($site_state == 3) {
	header('location: site_alert');
}
?>
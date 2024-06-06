<?php $page_title = "Logout"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); ?>
<?php
if(isset($_GET['lt'])){
	$uid = decrypt($_GET['lt']);
	$Ldate = date('D, dS-M h:i:s A');
	$login_time = "UPDATE sch_users SET last_login ='$Ldate' WHERE user_id = '$uid'";
	mysqli_query($conn,$login_time);
}
session_start(); session_unset(); session_destroy();
//redirect to index page
header("Location: index");
?>

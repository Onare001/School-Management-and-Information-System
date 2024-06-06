<?php
include 'include/connection.php'; include 'functions/functions.php';
if (isset($_GET['tid'])){
	$term_id = $_GET['tid'];
	$sql = "UPDATE `term_info` SET `status` = '1' WHERE `term_info`.`term_id` = $term_id";
	mysqli_query($conn,$sql);
	header('location: manage_term');
} else if (isset($_GET['yid'])){
	$year_id = $_GET['yid'];
	$sql = "UPDATE `year_info` SET `status` = '1' WHERE `year_info`.`year_id` = $year_id";
	mysqli_query($conn,$sql);
	header('location: manage_year');
} else if (isset($_GET['sid'])){
	$sid = $_GET['sid'];
	$sql = "UPDATE `session_info` SET `status` = '1',`done` = '1' WHERE `session_info`.`sid` = $sid";
	mysqli_query($conn,$sql);
	header('location: manage_session');
} else if (isset($_GET['pid'])){
	$pid = $_GET['pid'];
	$sql = "UPDATE `payment_type` SET `status` = '1' WHERE `payment_type`.`payment_id` = $pid";
	mysqli_query($conn,$sql);
	header('location: acc_settings');
} else if (isset($_GET['xpid'])){
	$xpid = decrypt($_GET['xpid']);
	$sql = "UPDATE `ledger_info` SET `payment_status` = '3' WHERE `ledger_info`.`payment_id` = $xpid";
	mysqli_query($conn,$sql);
	header('location: account_dashboard.php');
} else if (isset($_GET['suid'])){
	$suid = decrypt($_GET['suid']);
	$sql = "UPDATE `stdnt_info` SET `status_id` = '1' WHERE `stdnt_info`.`user_id` = $suid";
	mysqli_query($conn,$sql);
	header('location: view_class_list');
} else if (isset($_GET['sch_id'])){
	$sch_id = decrypt($_GET['sch_id']);
	$sql1 = "UPDATE `sch_info` SET `status` = '1' WHERE `sch_info`.`sch_id` = $sch_id";
	mysqli_query($conn,$sql1);
	$sql2 = "UPDATE `sch_users` SET `status` = '1' WHERE `sch_users`.`sch_id` = $sch_id";
	mysqli_query($conn,$sql2);
	header('location: admin');
} else if (isset($_GET['msg_id'])){
	$msg_id = decrypt($_GET['msg_id']);
	$sql1 = "UPDATE `broadcast_msg` SET `status` = '1' WHERE `broadcast_msg`.`msg_id` = $msg_id";
	mysqli_query($conn,$sql1);
	header('location: broadcast_msg');
} else {
	header('location: gen_settings');
}
?>
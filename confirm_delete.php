<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_GET['uid'])){//Delete Staff Record
	$uid = decrypt($_GET['uid']);
	$sql = "DELETE FROM `staff_info` WHERE `staff_info`.`user_id` = '$uid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	$sql1 = "DELETE FROM `sch_users` WHERE `sch_users`.`user_id` = '$uid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql1);
	$sql = "DELETE FROM `form_teacher_info` WHERE `form_teacher_info`.`user_id` = '$uid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	header('location: register_staff.php');
} else if (isset($_GET['fuid'])){//Delete Form Teacher
	$fuid = decrypt($_GET['fuid']);
	$sql = "DELETE FROM `form_teacher_info` WHERE `form_teacher_info`.`user_id` = '$fuid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	$sql2 = "UPDATE `sch_users` SET `priv_id` = '2' WHERE `sch_users`.`user_id` = $fuid";
	mysqli_query($conn,$sql2);
	header('location: ft_list');
} else if (isset($_GET['txid'])){// && isset($_GET['tuid'])//Delete Subject Assigned to teacher
	$txid = decrypt($_GET['txid']);
	$tuid = $_GET['tuid'];
	$sql = "DELETE FROM `staff_info` WHERE `staff_info`.`staff_id` = '$txid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	header("location: staff_details.php?uid=".$tuid);
	
} else if (isset($_GET['msg_id'])){//Delete Broadcast Message
	$msg_id = decrypt($_GET['msg_id']);
	$sql = "DELETE FROM `broadcast_msg` WHERE `broadcast_msg`.`msg_id` = '$msg_id' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	header("location: broadcast_msg");	
} else {
	exit();
}
?>
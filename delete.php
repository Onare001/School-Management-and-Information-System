<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['did'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['did']);
}

/*if (isset($_GET['uid'])){
	$uid = decrypt($_GET['uid']);
	$sql1 = "DELETE FROM `sch_users` WHERE `sch_users`.`user_id` = '$uid' AND sch_id = '$sch_id'";
		mysqli_query($conn,$sql1);
	$sql2 = "DELETE FROM `stdnt_info` WHERE `stdnt_info`.`user_id` = '$uid' AND sch_id = '$sch_id'";
		mysqli_query($conn,$sql2);
	$sql3 = "DELETE FROM `score_info` WHERE `score_info`.`user_id` = '$uid' AND sch_id = '$sch_id'";
		//mysqli_query($conn,$sql3);
}
header("location: register_student.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "");
exit();*/

if (isset($_GET['uid'])) {
  $uid = decrypt($_GET['uid']);
  
  // Check if user_id is found in any other tables
  $result = mysqli_query($conn, "SELECT user_id FROM score_info WHERE user_id = $uid UNION SELECT user_id FROM cum_result WHERE user_id = $uid UNION SELECT user_id FROM stdnt_com WHERE user_id = $uid UNION SELECT user_id FROM payment_log WHERE user_id = $uid UNION SELECT user_id FROM ledger_info WHERE user_id = $uid");
  
  if (mysqli_num_rows($result) == 0) {
    // Delete user from sch_users and stdnt_info tables
    $deleteQuery = "DELETE FROM sch_users WHERE user_id = $uid; DELETE FROM stdnt_info WHERE user_id = $uid;";
    
    if (mysqli_multi_query($conn, $deleteQuery)) {
      $msg = "User with ID $uid has been deleted from sch_users and stdnt_info tables";
	  header("location: register_student?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
    } else {
		$msg = "Error deleting user: " . mysqli_error($conn);
		header("location: register_student?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
    }
  } else {
	$msg = "This student already has records in other tables. You are advised to deactivate them if they are no longer coming to school.";
	header("location: register_student?class=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&msg=".$msg."");
  }
}
?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_GET['score_id']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['ses_id'])){	//Delete Student Score
	$score_id = decrypt($_GET['score_id']);
	$class_id = decrypt($_GET['cid']); 
	$cat_id = decrypt($_GET['did']); 
	$subj_id = decrypt($_GET['sid']);
	$term_id = decrypt($_GET['tid']);
	$session_id = decrypt($_GET['ses_id']);
	
	//Deleting score from cumulative result...
	$result1 = mysqli_query($conn,"SELECT * FROM score_info WHERE score_id='$score_id'");
	$row = mysqli_fetch_assoc($result1);
	$uid = $row['user_id'];//Get Specific Student

	$result2 = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id='$uid' AND subj_id='$subj_id' AND class_id='$class_id' AND cat_id='$cat_id' AND sid='$session_id'");
	$first_term = $row['first_term_total'];
	$second_term = $row['second_term_total'];
	$third_term = $row['third_term_total'];

	if (($term_id==1) && ($second_term==0)&&($third_term==0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} else if (($term_id==2) && ($first_term==0)&&($third_term==0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `second_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} else if (($term_id==3) && ($first_term==0)&&($second_term==0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} else if (($term_id==1) && ($second_term!=0)&&($third_term!=0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} else if (($term_id==2) && ($first_term!=0)&&($third_term!=0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `second_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} else if (($term_id==3) && ($first_term!=0)&&($second_term!=0)){
		mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
	} 
	
	//Deleting score from terminal result...	
	$sql = "DELETE FROM `score_info` WHERE `score_info`.`score_id` = '$score_id' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	header("location: admin_view_score?cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) . "&sid=" . encrypt($subj_id) . "&tid=" . encrypt($term_id) ."&ses_id=" . encrypt($session_id) . "");
}
?>
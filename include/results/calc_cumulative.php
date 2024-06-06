<?php
//Cumulate during 3rd Term
	$tid = '3';
	
//Deleting Blank Cummulative Record...
	mysqli_query($conn,"DELETE FROM `cum_result` WHERE `cum_result`.`first_term_total` = '0' AND `cum_result`.`second_term_total` = '0' AND `cum_result`.`third_term_total` = '0' AND sch_id = '$sch_id'");

//Calculating Term Totals, Average & Updating...
	$cumulative = mysqli_query($conn,"SELECT * FROM cum_result WHERE sch_id = '$sch_id' AND class_id = '$cid' AND cat_id = '$did' AND sid = '$sid'");
	while ($row = mysqli_fetch_array($cumulative)){
		$stud_uid = $row['user_id'];
		$subject = $row['subj_id'];
		$first_term_total = $row['first_term_total'];
		$second_term_total = $row['second_term_total'];
		$third_term_total = $row['third_term_total'];
		$sum = $first_term_total + $second_term_total + $third_term_total;
		$average = $sum / 3;
//Updating Values...
		mysqli_query($conn,"UPDATE `cum_result` SET total = '$sum',`average` = '$average' WHERE sch_id = '$sch_id' AND class_id = '$cid' AND cat_id = '$did' AND sid = '$sid' AND user_id='$stud_uid' AND subj_id='$subject'");
	}
?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<!DOCTYPE html>
<?php
$cid = $did = $tid = $sid = $com = $allcount = "";
if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])) {
	$uid = decrypt($_GET['uid']);//Student
	$cid = decrypt($_GET['cid']);//Class
	$did = decrypt($_GET['did']);//Category
	$tid = decrypt($_GET['tid']);//Term
	$sid = decrypt($_GET['sid']);//Session
	$page_title = "Student Terminal Result";
	include('include/results/terminal_result_style.php');

	//Select From Score_info
	$showresult = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE stdnt_info.user_id='$uid' AND sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!='0' AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' AND score_info.status='1' LIMIT 1");
	while ($row = mysqli_fetch_array($showresult)){
		$uid = $row['user_id']; $ses_id = $row['sid']; $status = $row['status']; $subj_sno = 0;
		//Display the Terminal Result
		include ("include/results/terminal_result_file.php");
	} 
} else if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid'])) {
	$uid = decrypt($_GET['uid']);//Student
    $cid = decrypt($_GET['cid']);//Class
    $did = decrypt($_GET['did']);//Category
    $sid = decrypt($_GET['sid']);//Session
	$page_title = "Student Cumulative Result";
	include('include/results/cumulative_result_style.php');

	//Calculating cumulative result...
	include('include/results/calc_cumulative.php');

	// Getting the individual student's record
	$showresult = mysqli_query($conn,"SELECT DISTINCT * FROM cum_result JOIN sch_users ON cum_result.user_id=sch_users.user_id AND cum_result.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND sch_users.sch_id='$sch_id' AND cum_result.sch_id='$sch_id' AND stdnt_info.status_id!='0' AND cum_result.class_id='$cid' AND cum_result.cat_id='$did' AND cum_result.sid='$sid' AND cum_result.status='1' LIMIT 1");
	while ($row = mysqli_fetch_array($showresult)){
		$uid = $row['user_id']; $ses_id = $row['sid']; $subj_sno = 0;
		//Display the Cumulative Result
		include ("include/results/cumulative_result_file.php");
	}
} else {
	/*header("Location: terminal_result");
	exit();*/
}?>
<!--===============================PAGINATION P/N==================================-->
<div id="div_pagination">
	<form method="post" action="">
		<div id="div_pagination"> 	
			<button title="Back" onclick="goBack()" id="buttonn" class="button"><i class="fa fa-arrow-left"></i> Back </button>
			<button title="Print Result" onClick="javascript:window.print()" id="buttonn" class="button"><i class="fa fa-print"></i> Print </button>
		</div>
	</form>
</div>
</html>
<?php $page_title = "Terminal Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_parent.php');?>
<!DOCTYPE html>
<html>
<?php include('include/results/result_style.php');?>
<?php
$cid = $did = $tid = $sid = $com = $allcount = "";
if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])) {
	$uid = decrypt($_GET['uid']);//Ward
    $cid = decrypt($_GET['cid']);//Class
    $did = decrypt($_GET['did']);//Category
    $tid = decrypt($_GET['tid']);//Term
    $sid = decrypt($_GET['sid']);//Session
	}
	//Select From Score_info
	$showresult = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE stdnt_info.user_id='14' AND sch_users.sch_id='1' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!=0 AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' LIMIT 1");
	while ($row = mysqli_fetch_array($showresult)){
	$uid = $row['user_id']; 
	$ses_id = $row['sid']; 
	$subj_sno = 0;
	$status = $row['status'];

	if ($status == 0) {
		echo '<font color="red"> This result is NOT yet ready! </font>';
		header("location: check_result?msg=This Result is not yet ready or Might have not been Published");
	} else {
		include ("include/results/terminal_result_file.php");
	}
} ?>
<!--===============================!PAGINATION P/N==================================-->
	<div id="div_pagination">
		<input title="Print Result" type="submit" class="button" name="print" value="PRINT" '+' onClick="javascript:window.print()"> 
		<a href="check_result" title="back to class Selection" style="width:2px;" class="button">BACK</a>
	</div>
</html>
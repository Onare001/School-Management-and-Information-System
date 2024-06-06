<?php $page_title = "Student Cumulative Result"; ?>
<?php include ("include/connection.php"); ?>
<?php include ("include/lock_admin.php"); ?>
<?php include ("functions/functions.php"); ?>
<!DOCTYPE html>
<html>
<?php include('include/results/result_style.php');?>
<?php
$cid = $did = $sid = $com = "";
if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid'])) {
	$uid = decrypt($_GET['uid']);//StudentID
    $cid = decrypt($_GET['cid']);//Class
    $did = decrypt($_GET['did']);//Category
    $sid = decrypt($_GET['sid']);//Session
	} else {
		header("Location:cumulative_result");
	}	

//Calculating cumulative result...
	include('include/results/calc_cumulative.php');

// Getting the individual student's record
	$showresult = mysqli_query($conn,"SELECT DISTINCT * FROM cum_result JOIN sch_users ON cum_result.user_id=sch_users.user_id AND cum_result.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND sch_users.sch_id='$sch_id' AND cum_result.sch_id='$sch_id' AND stdnt_info.status_id!='0' AND cum_result.class_id='$cid' AND cum_result.cat_id='$did' AND cum_result.sid='$sid' LIMIT 1");
	while ($row = mysqli_fetch_array($showresult)){
	$ses_id = $row['sid']; $subj_sno =0;

//Display the result
	include ("include/results/cumulative_result_file.php");
} ?>

<!--===============================!PAGINATION P/N===============================-->
	<div id="div_pagination">
		<input title="Print Result" type="submit" class="button" name="print" value="PRINT" '+' onClick="javascript:window.print()"> 
		
		<a href="cumulative_result" title="back" style="width:2px;" class="button">BACK</a>
	</div>
</html>
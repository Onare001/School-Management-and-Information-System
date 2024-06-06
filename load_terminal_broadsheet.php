<?php $page_title = "Loading Terminal Broadsheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
<?php include('include/results/result_style.php');?>
	<body style="background: url(assets/img/bg2.png);">
		<div style="min-height:250px; padding-top:50; padding-bottom:60; margin-top:250px">
			 <center style="color:white;font-size:24px;">Loading Terminal Broadsheet</center>
			 <center><img src="assets/img/ajax-loader.gif" width="208" height="13" alt="loading"></center>
			 <center><div id="counter" style="color:white;font-size:20px;"></div></center>
			 <center>Please Wait...</center>
		</div>
		<?php
		$cid = $did = $sid = $com = "";
		if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])) {
			$cid = decrypt($_GET['cid']);//Class
			$did = decrypt($_GET['did']);//Category
			$tid = decrypt($_GET['tid']);//Category
			$sid = decrypt($_GET['sid']);//Session
		} else {
			header("Location:terminal_broadsheet.php");
		}
		
		$result456 = mysqli_query($conn,"SELECT DISTINCT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!=0 AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' GROUP BY stdnt_info.user_id");
		while ($row = mysqli_fetch_array($result456)){
		$uid = $row['user_id']; 
		$ses_id = $row['sid'];
		
		// Collating the individual aggregates
		$result567 = mysqli_query($conn,"SELECT total, SUM(total) AS aggregate FROM score_info WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
		$row = mysqli_fetch_array($result567);
		$aggregate = $row['aggregate'];
				
		// Updating the individual aggregate
		$result444 = mysqli_query($conn,"UPDATE score_info SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
				
		// Computing the total subject offered by student
		$result213 = mysqli_query($conn,"SELECT DISTINCT score_id, COUNT(score_id) AS total_subj FROM score_info WHERE user_id='$uid'  AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
		$row = mysqli_fetch_array($result213);
		$total_subj = $row['total_subj'];
		}
		$class_id = encrypt($cid);
		$cat_id = encrypt($did);
		$term_id = encrypt($tid);
		$session_id = encrypt($sid);

		$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'terminal_broadsheet?cid='.$class_id.'&did=' . $cat_id .'&tid=' . $term_id .'&sid=' . $session_id;
		header('Refresh: 6; URL=' . $redirect);
		?>
	</body>
	<?php include ('include/page_scripts/loader.php');?>
</html>
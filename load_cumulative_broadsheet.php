<?php $page_title = "Loading Cumulative Broadsheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
<?php include('include/results/result_style.php');?>
	<body style="background: url(assets/img/bg2.png);">
		<div style="min-height:250px; padding-top:50; padding-bottom:60; margin-top:250px">
			 <center style="color:white;font-size:24px;">Loading Cumulative Broadsheet</center>
			 <center><img src="assets/img/ajax-loader.gif" width="208" height="13" alt="loading"></center>
			 <center><div id="counter" style="color:white;font-size:20px;"></div></center>
			 <center>Please Wait...</center>
		</div>
		<?php
		$cid = $did = $sid = $com = "";
		if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid'])) {
			$cid = decrypt($_GET['cid']);//Class
			$did = decrypt($_GET['did']);//Category
			$sid = decrypt($_GET['sid']);//Session
		} else {
			header("Location:cumulative_broadsheet.php");
		}
		
		include('include/results/calc_cumulative.php');
		
		$class_id = encrypt($cid);
		$cat_id = encrypt($did);
		$session_id = encrypt($sid);

		$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'cumulative_broadsheet?cid='.$class_id.'&did=' . $cat_id .'&sid=' . $session_id;
		header('Refresh: 6; URL=' . $redirect);
		?>
	</body>
	<?php include ('include/page_scripts/loader.php');?>
</html>
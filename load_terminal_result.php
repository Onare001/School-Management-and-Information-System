<?php $page_title = "Loading Terminal Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
<?php include('include/results/terminal_result_style.php');?>
	<body style="background: url(assets/img/bg2.png);">
		<?php
		$cid = $did = $tid = $sid = $com = $allcount = "";
		if (isset($_GET['cid']) && isset($_GET['cat']) && isset($_GET['tid']) && isset($_GET['ses_id'])) {
			$cid = decrypt($_GET['cid']);//Class
			$did = decrypt($_GET['cat']);//Category
			$tid = decrypt($_GET['tid']);//Term
			$sid = decrypt($_GET['ses_id']);//Session
		} else if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])){
			$student = decrypt($_GET['uid']);//Student
			$cid = decrypt($_GET['cid']);//Class
			$did = decrypt($_GET['did']);//Category
			$tid = decrypt($_GET['tid']);//Term
			$sid = decrypt($_GET['sid']);//Session
		} else {
			header("location: view_terminal_result");
		}

		//Select From Score_info
		$showresult = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!=0 AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' GROUP BY sch_users.user_id");
		while ($row = mysqli_fetch_array($showresult)){
		$uid = $row['user_id']; $ses_id = $row['sid'];

		// Collating the individual aggregates
		$result567 = mysqli_query($conn,"SELECT total,status, SUM(total) AS aggregate FROM score_info WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
		$aggrow = mysqli_fetch_array($result567);
		$aggregate = $aggrow['aggregate'];
				
		// Updating the individual aggregate
		$result444 = mysqli_query($conn,"UPDATE score_info SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
		}      

		if ($aggrow['status'] == 1){//1
			echo '<div style="min-height:250px; padding-top:50; padding-bottom:60; margin-top:250px">
				<center style="color:white;font-size:24px;">Loading Terminal Result</center>
				<center><img src="assets/img/ajax-loader.gif" width="208" height="13" alt="loading"></center>
				<center><div style="color:white;font-size:20px;" id="messages"></div></center>
				<!--center><div id="counter" style="color:white;font-size:20px;"></div></center-->
				<center style="color:white;">Please Wait!</center>
			</div>';
			if(isset($_GET['cid']) && isset($_GET['cat']) && isset($_GET['tid']) && isset($_GET['ses_id'])){
				$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'terminal_result?cid=' . encrypt($cid) . '&cat=' . encrypt($did) .'&tid=' . encrypt($tid) . '&ses_id='. encrypt($sid);
				header('Refresh: 9; URL=' . $redirect);
			} else if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])) {
				$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'terminal_result?uid=' . encrypt($student)  . '&cid=' . encrypt($cid) . '&did=' . encrypt($did) .'&tid=' . encrypt($tid) . '&sid='. encrypt($sid);
				header('Refresh: 9; URL=' . $redirect);
			} 
		} else {
			echo '<!-- Theme style -->
				<link rel="stylesheet" href="assets/css/main.css">
				<div align="center" style="width:100%; margin:auto; margin-top:50px; margin-bottom:20px; max-width:900px; border:0px solid #CCC;">
					<div class="card card-danger" style="color:; margin:auto; width:auto;">
					<div class="card-header" style="text-align:left;">Information! <i class="fa fa-warning" class="img-responsive" style="float:right;font-size:20px;"></i></div>
						<div align="left" style=" margin:auto; padding:15px;">
							<div style="width:auto; height:auto; padding:15px;">
										<font color="red" size="40px"> This Result is not yet Ready! </font>
					<hr>
					Results can be viewed after it has been Published
					<p>Publishing means making <b>'.getTerm($tid).' '.getSession($sid).'</b> Result available to Parents and Students
					<p>This should be done officially by 9am on the day School closes for the term to enable Parent view their ward Results from home (<font color="red">Online</font>)
					<p>Publish and Print the Results a day before school closes for the term and to be distributed to the students (<font color="red">Offline</font>)
					<p>Before Publishing, ensure that the results have been reviewed by the scritiny committe or Examination office<!-- and are free from all input errors-->
					
					<p>You can use other means such as '.'<a href="terminal_broadsheet">Broadsheet</a> to view students Scores
					<p>Click '.'<a href="gen_settings">here</a>'.' to Publish Result
					</center>
				<div><hr>
					<p style="font-size:25px;">********<u>Steps to Review Results</u>********
					<li>Print this page, the terminal broadsheet, result statistics, the score entry tracker for the term, session and classes under review
					<li>Submit the printed documents to the committee incharge of result to do the following
					<li>Use the score entry tracker to identify teachers whose entry is complete or not 
					<li>(consider the core/elective: for electives number of students in class cannot/is not equal to the number of student taking the subject)
					<li>Check if the student have a complete and correct subjects recorded using the broadsheet
					<li>Check if comments have been set by the Form Teacher
					<li>Spot out all the errors for amendment
					<li>Stamp and sign all of the document to depict approved and return them to the web admin for online Publishing
						<center><button onclick="history.back()" class="btn btn-primary">Back</button></center>
					</div>
				</div>
			</div>
		</div>';
		} ?>
	</body>
<?php include ('include/page_scripts/loader.php');?>
</html>
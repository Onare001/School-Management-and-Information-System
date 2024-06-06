<?php $page_title = "Terminal Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
<?php 
include('include/results/terminal_result_style.php');

$rowperpage = 20;
$roww = 0;
// Previous Button
if(isset($_POST['but_prev'])){
	$roww = $_POST['row'];
	$roww -= $rowperpage;
	if( $roww < 0 ){
		$roww = 0;
	}
}
// Next Button
if(isset($_POST['but_next'])){
	$roww = $_POST['row'];
	$allcount = $_POST['allcount'];

	$val = $roww + $rowperpage;
	if( $val < $allcount ){
		$roww = $val;
	}
}

$cid = $did = $tid = $sid = $com = $allcount = "";
if (isset($_GET['cid']) && isset($_GET['cat']) && isset($_GET['tid']) && isset($_GET['ses_id'])) {
	$cid = decrypt($_GET['cid']);//Class
	$did = decrypt($_GET['cat']);//Category
	$tid = decrypt($_GET['tid']);//Term
	$sid = decrypt($_GET['ses_id']);//Session
	
	$show_class_result = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!='0' AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' AND score_info.status='1' GROUP BY sch_users.user_id LIMIT $roww," .$rowperpage);
	$show_student_result = '';
} else if (isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])){
	$uid = decrypt($_GET['uid']);//Student
	$cid = decrypt($_GET['cid']);//Class
	$did = decrypt($_GET['did']);//Category
	$tid = decrypt($_GET['tid']);//Term
	$sid = decrypt($_GET['sid']);//Session
	
	$show_student_result = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE stdnt_info.user_id='$uid' AND sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!='0' AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.status='1' AND score_info.sid='$sid' LIMIT 1");
	$show_class_result = '';
} else {
	header("location: view_terminal_result");
}

if ($show_class_result){
	while ($row = mysqli_fetch_array($show_class_result)){
		$uid = $row['user_id']; $ses_id = $row['sid'];
		include ("include/results/terminal_result_file.php");
	}
	echo '
		<div id="div_pagination">
			<form method="post" action="">
				<input type="hidden" name="row" value="'.$roww.'">
				<input type="hidden" name="allcount" value="'.$allcount.'">';
				if ($roww == 0) {
					echo '';
				} else if ($roww > 0) {
					echo '<button type="submit" class="button btn btn-primary" name="but_prev">&lt;&lt; PREVIOUS</button>';
				}
			
				if ($roww == ($allcount - $rowperpage)) {
					echo '';
				} else if ($roww <= $allcount) {
					echo '<button type="submit" class="button btn btn-primary" name="but_next"> NEXT >> </button>';
				} else if ($roww > $allcount - $rowperpage){
					echo '';
				}
				
	echo '<button title="Print Result" onClick="javascript:window.print()" class="button btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
			<button title="back to class Selection" onClick="href=\'view_terminal_result\'" class="button btn btn-primary"><i class="fa fa-arrow-left"></i> BACK</button>
		</form>
	</div>';
} else if ($show_student_result){
	while ($row = mysqli_fetch_array($show_student_result)){
		$uid = $row['user_id']; $ses_id = $row['sid'];
		include ("include/results/terminal_result_file.php");
	}
	echo '
<div id="div_pagination">
	<button title="Print Result" onClick="javascript:window.print()" class="button" class="btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
	<button title="back to class Selection" onClick="href=\'view_terminal_result\'" class="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i> BACK</button>
</div>';
} else {
	echo mysqli_error($conn);
}
 ?>
 
</html>
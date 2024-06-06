<?php $page_title = "View Mock Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> School Management System | <?php echo $page_title;?> </title>
	<meta name="keywords" content="School Management System, Niel Technologies"/>
	<meta name="description" content="School Management System">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="'.getSchname($sch_id).', School Management System">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=0.33">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/result_style.min.css">
	<!--b8d419290b8edd97a79170e51f22230b1456a4623fff769657eaa85511f01ef7621bcba3daaca1e30c051-->
	<link rel="stylesheet" href="assets/css/mock_result.css">
	<!--link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /-->
		<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<style>
	.custom, .passport{
		background-color:<?php echo getSchtheme($sch_id);?>;
		color:white;
	}
</style>
<?php 
//include('include/results/result_style.php');

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

$uid = $cid = $did = $tid = $sid = $com = $allcount = "";
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])) {
		$cid = decrypt($_GET['cid']);//Class
		$did = decrypt($_GET['did']);//Category
		$tid = decrypt($_GET['tid']);//Term
		$sid = decrypt($_GET['sid']);//Session
		//Select From Score_info
		$showresult = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!=0 AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' GROUP BY sch_users.user_id LIMIT $roww," .$rowperpage);//
	} else if (isset($_GET['uid']) && isset($_GET['c_id']) && isset($_GET['did']) && isset($_GET['tid']) && isset($_GET['sid'])){
		$uid = decrypt($_GET['uid']);//Student
		$cid = decrypt($_GET['c_id']);//Class
		$did = decrypt($_GET['did']);//Category
		$tid = decrypt($_GET['tid']);//Term
		$sid = decrypt($_GET['sid']);//Session
		//Select From Score_info
		$showresult = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE stdnt_info.user_id='$uid' AND sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND stdnt_info.status_id!=0 AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' LIMIT 1");
	} else {
		header("location: mock_result");
	}
	
while ($row = mysqli_fetch_array($showresult)){
	$uid = $row['user_id']; 
	$ses_id = $row['sid']; 
	$status = $row['status'];
	if (1==0) {
		echo '<font color="red"> This result is NOT yet ready! </font>';
		header("location: terminal_result?msg=This Result is not yet Ready or Might have not been Published");
	} else {
		include ("include/results/mock_result_file.php");
	}		
} ?>
	
<!--===============================PAGINATION P/N==================================-->
<div id="div_pagination">
	<form method="post" action="">
		<input type="hidden" name="row" value="<?php echo $roww; ?>">
		<input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
		<?php if ($roww == 0) {
			echo '';
		} else if ($roww > 0) {
			echo '<input type="submit" class="button" name="but_prev" value="<< PREVIOUS">';
		}
		
		if ($roww == $allcount - $rowperpage) {
			echo '';
		} else if ($roww <= $allcount) {
			echo '<input type="submit" class="button" name="but_next" value="NEXT >>">';
		} else if ($roww > $allcount - $rowperpage){
			echo '';
		}
		?>
		<button type="submit" name="print" value="PRINT" '+' onClick="javascript:window.print()" class="button" class="btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
		<a href="mock_result" title="back to class Selection" class="button" class="btn btn-primary">BACK</a>
	</form>
</div>

<script type="text/javascript">	 
	$(document).ready( function(){
		$('.tablerow:even').addClass('alt1');
		$('.tablerow:odd').addClass('alt2');
		}
	);	 	
	// target function
	$( function(){
	$("#target .tablerow").hover(
	function(){$(this).toggleClass("highlight");},
	function(){$(this).toggleClass("highlight");}	
		);
	});
</script>
<style type="text/css" >
	.tablerow {
		background-color:#FFF;
	}
	.alt1 {
		 background-color:#FFF;
	 }
	.alt2 {
		 background-color: #f1f1f1;
	 }	 
	.highlight{
		border: 0px solid  #428bca;
		color:;	
	}	 
</style>
</html>
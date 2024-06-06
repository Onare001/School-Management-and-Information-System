<?php $page_title = "View Class Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$cid=""; $did=""; $sid=""; $tid=""; $ses_id="";
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['ses_id'])) {
    $cid = decrypt($_GET['cid']);//Class
    $did = decrypt($_GET['did']);//Category
    $sid = decrypt($_GET['sid']);//Subject
    $tid = decrypt($_GET['tid']);//Term
	$ses_id = decrypt($_GET['ses_id']);//Session
} else {
	header("Location: admin_class_score");
}	
	
// check if the form is submitted
if (isset($_POST['delete'])) {
    // get array of selected IDs from checkboxes
    $selected_ids = $_POST['checkbox'];
	if (empty($selected_ids)){
		$msg = 'Please Select at least on Row';
		$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
	} else {
		$del = DeleteScore($sch_id, $selected_ids);
		if ($del) {
			$msg = 'Selected rows deleted successfully.';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Error Deleting Selected Rows';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
			<section class="content">
				<div class="container-fluid">
					<div class="card card-primary">
						<div id="content">	
							<div class=""> <?php if (isset($msg)) { echo $msg_toastr ;} ?>
								<div style="margin-top:50px;padding:0px;margin:20px;max-width:1050px; margin:auto;">
									<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
										<tr>
											<td align="left"> 
												<img src="<?php echo getSchlogo($sch_id);?>" alt="logo" style="float:right; padding:5px; margin-right:10px; width:120px; max-width:100px; border-radius:0px; border:0px solid #ccc;" class="img-responsive"/>
											</td>
											<td align="left">
												<p align="center" style="font-weight:bold; font-size:20px;"> &nbsp;&nbsp;&nbsp;<?php echo strtoupper(getSchname($sch_id)); echo " - SCHOOL MANAGEMENT SYSTEM";?></p>
												<p align="center" style="font-size:16px;"><?php echo getSchmotto($sch_id);?><br/>
												<p align="center" style="font-size:16px;"><?php echo getSchAddress($sch_id);?><br/>
											</td>
										</tr>
									</table>
									<div align="center" class="col-md-12 border" style="margin-bottom:10px;"><font color="#333">
										<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
											<tr>
												<td align="left">
													<b><?php echo strtoupper(getTerm($tid));?>&nbsp;SCORE RECORD </b>
												</td>
												<td align="left"> 
													<b><?php echo getSession($ses_id);?> ACADEMIC&nbsp;SESSION</b>
												</td>
												<td align="left">
													<b>CLASS : <?php echo getClass($cid); echo getCategory($did);?></b>
												</td>
												<td align="left">
													<b>SUBJECT : <?php echo strtoupper(getSubject($sid));?></b>
												</td>
											</tr>
										</table>
									</div>
									<form action="" method="post">
										<table class="table table-bordered table-striped" align="center" style="border-collapse:collapse;border-radius:10px; width:100%;">	
											<thead class="custom">
												<tr>
													<th align="center">S/N</th>
													<th align="center"><input name="" type="checkbox" id="check-all"></th>
													<th align="left">STUDENT NAME</th>
													<th align="center">1ST. CA</th>
													<th align="center">2ND. CA</th>
													<th align="center">3RD. CA</th>
													<th align="center">EXAM</th>
													<th align="center">TOTAL</th>
													<th align="center">POSTION</th>
													<th align="center">GRADE</th>
													<th align="left">REMARK</th>
													<th align="left">DEL</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id = sch_users.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.subj_id='$sid' AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$ses_id' ORDER BY sch_users.last_name ASC");//excluded status = 1;
											while ($row = mysqli_fetch_array($result)){ 
											$uid = $row["user_id"];
											echo '
												<tr class="tablerow">
													<td align="center" class="pad">'.++$counter.'</td>
													<td align="center" class="pad"><input type="checkbox" class="checkbox" name="checkbox[]" value="'.$row["score_id"].'"/></td>
													<td class="pad" style="width:50%;">'.getLastname($row["user_id"]).' '.getFirstname($row["user_id"]).'</td>
													<td align="center" class="pad">'.$row["first_ca"].'</td>
													<td align="center" class="pad">'.$row["second_ca"].'</td>
													<td align="center" class="pad">'.$row["third_ca"].'</td>
													<td align="center" class="pad">'.$row["exam"].'</td>
													<td class="pad" align="center"><b>';echo ($row["total"] < 39) ? '<text style="color:red;">'.$row["total"].'</text>' : ''.$row["total"].''; echo '</b></td>
													<td class="pad" align="center">'.Ordinal(getSubjPos($row["total"], $sch_id, $cid, $did, $sid, $tid, $ses_id)).'</td>
													<td class="pad" align="center">';echo ($row["total"] < 39) ? '<text style="color:red;">'.getGrade($row['total']).'</text>' : ''.getGrade($row['total']).''; echo '</td>
													<td class="pad" align="left">';echo ($row["total"] < 39) ? '<text style="color:red;">'.getRemark($row['total']).'</text>': ''.getRemark($row['total']).''; echo '</td>
													<td class="pad" align="center">
														<a onclick="return confirm(\'Are you sure you want to delete the score for '.getLastname($uid).' '.getFirstname($uid).'\?\')" href="delete_score?score_id='.encrypt($row['score_id']).'&cid='.encrypt($cid).'&did='.encrypt($did).'&sid='.encrypt($sid).'&tid='.encrypt($tid).'&ses_id='.encrypt($ses_id).'">
														<img src="assets/img/trash.png" width="16" height="16" alt="delete"></a>
													</td>
												</tr>';
												} ?>	
											</tbody>
										</table>
										<table id="pad" border="0" align="center" style="border-collapse:collapse; margin-top:20px; border:1px solid #CCC; width:100%; font-weight:bold;">
											<tr>
												<td class="pad" align="left">CLASS AVERAGE SCORE: <?php echo round(getAVG($sch_id, $cid, $did, $sid, $tid, $ses_id),2)?></td>
												<td class="pad" align="left">CLASS HIGHEST SCORE: <?php echo getHGST($sch_id, $cid, $did, $sid, $tid, $ses_id)?></td>
												<td class="pad" align="left">CLASS LOWEST SCORE: <?php echo getLWST($sch_id, $cid, $did, $sid, $tid, $ses_id)?></td>
												<td class="pad" align="left">NUMBER OF FAIL: <?php echo getFail($sch_id, $cid, $did, $sid, $tid, $ses_id)?></td>
											</tr>
										</table><br/>
										<div class="button-container">
											<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
											<button id="deleteButton" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete the Selected Record?');" id="buttonn" class="btn btn-danger" disabled> <i class="fa fa-trash"></i> Delete Selected</button>
											<button type="submit" name="print" value="PRINT" '+' onClick="javascript:window.print()" id="buttonn" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
										</div>
									</form>	
								</div>		
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/check_all.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
<?php $page_title = "Class Promotion Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$cid=""; $did=""; $sid=""; $ses_id="";
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['ses_id'])) {
    $cid = decrypt($_GET['cid']);//Class
    $did = decrypt($_GET['did']);//Category
    $sid = decrypt($_GET['sid']);//Subject
    //$tid = decrypt($_GET['tid']);//Term
	$ses_id = decrypt($_GET['ses_id']);//Session
	} else {
     header("Location: view_prom_score");
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

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
										<b><?php //echo strtoupper(getTerm($tid));?>&nbsp;SCORE RECORD </b>
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
						<form method="post">
							<table class="table table-bordered table-striped" align="center" style="border-collapse:collapse;border-radius:10px; width:100%;">	
								<thead class="custom">
									<tr>
										<th align="center">S/N</th>
										<th align="left">STUDENT NAME</th>
										<th align="center">1ST. TERM (100%)</th>
										<th align="center">2ND. TERM (100%)</th>
										<th align="center">3RD. TERM (100%)</th>
										<th align="center">AVERAGE(X/3)</th>
										<th align="center">REMARK</th>
										<th align="center">POSTN</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$result = mysqli_query($conn,"SELECT * FROM cum_result JOIN sch_users ON cum_result.user_id = sch_users.user_id WHERE sch_users.sch_id='$sch_id' AND cum_result.subj_id='$sid' AND cum_result.class_id='$cid' AND cum_result.cat_id='$did' AND cum_result.sid='$ses_id' ORDER BY sch_users.last_name,first_name ASC");
									while ($row = mysqli_fetch_array($result)){ 
									$uid = $row["user_id"]; $score_id = $row['score_id'];
								?>
								
									<tr class="tablerow">
										<td align="center" class="pad"><?php echo ++$counter; ?></td>
										<td class="pad" width="40%"><?php echo getLastname($row["user_id"]).'&nbsp;'.getFirstname($row["user_id"]);?></td>
										<td align="center" class="pad"><?php echo $row["first_term_total"];?></td>
										<td align="center" class="pad"><?php echo $row["second_term_total"];?></td>
										<td align="center" class="pad"><?php echo $row["third_term_total"];?></td>
										<td align="center" class="pad"><?php echo ($row["average"] < 39 ) ? '<text style="color:red;">'.$row["average"].'' : $row["average"];?></td>
										<td align="center" class="pad"><?php echo getRemark($row["average"]);?></td>
										<td class="pad" align="center"><?php echo Ordinal(getCumSubjPos($row["average"], $sch_id, $cid, $did, $sid, $ses_id));?></td>
									</tr>
									<?php } ?>	
								</tbody>
							</table>
							<table id="pad" border="0" align="center" style="border-collapse:collapse; margin-top:20px; border:1px solid #CCC; width:100%; font-weight:bold;">
								<tr>
									<td class="pad" align="left">CLASS AVERAGE SCORE: <?php //echo round(getCUMAVG($sch_id, $cid, $did, $sid, $ses_id),2)?></td>				
								
									<td class="pad" align="left">CLASS HIGHEST SCORE: <?php echo getCUMHGST($sch_id, $cid, $did, $sid, $ses_id);?></td>
									<td class="pad" align="left">CLASS LOWEST SCORE: <?php echo getCUMLWST($sch_id, $cid, $did, $sid, $ses_id);?></td>
									<td class="pad" align="left">NUMBER OF FAIL: <?php //echo getFail($sch_id, $cid, $did, $sid, $tid, $ses_id)?></td>
								</tr>
							</table><br/>
							<div class="button-container">
								<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
								<button type="submit" name="print" value="PRINT" '+' onClick="javascript:window.print()" id="buttonn" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
							</div>
						</form>	
					</div>		
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/check_all.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
<?php $page_title = "Examination Questions"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['stid'])) {
	$cid = decrypt($_GET['cid']);//Class
	$tid = decrypt($_GET['tid']);//Term
	$stid = decrypt($_GET['stid']);//Year
	$sid = decrypt($_GET['sid']);//Session    
} else {
	
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
            
			<div class="card" id="printableArea" style="margin-left:90px;margin-right:50px;width:900px;">
				<style type="text/css"> 
					p {
					  line-height:10px;
					  margin-top: 0.5em ;
					  margin-bottom: 0.3em ;
					}
				</style>
				<div style="padding:10px;">  
					<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
						<tr>
							<td><img src="<?php echo getSchlogo($sch_id);?>" alt="School Logo" style="max-width:100px;max-height:100px;"/></td>
							<td>
							<h3 align="center"><?php echo strtoupper(getSchname($sch_id)); ?></h3>
							<p align="center"><?php echo getSchmotto($sch_id)?></p>
							<p align="center"><?php echo getSchAddress($sch_id)?></p>
						</tr>
							<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
								<tr>
									<td align="center">
										CLASS: <?php echo getClass($cid);?>
									</td>
									<td align="center">
										SUBJECT: <?php echo strtoupper(getSubject($stid));?>
									</td>
									<td align="center">
										<?php echo strtoupper(getTerm($tid)).'&nbsp;'.'EXAMINATION QUESTIONS';?>
									</td>
									<td align="center">
										SESSION: <?php echo getSession($sid).'&nbsp;';?>
									</td>
								</tr>
							</table>
							</td>	
					</table>
					<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
						<tr>
							<td>
								&nbsp;General Instruction:&nbsp; Answer Both Sections
							</td>
							<td>
								&nbsp;Time Allowed : 2Hrs
							</td>
							<td>
								&nbsp;Point Obtainable: 70%
							</td>
						</tr>
					</table><br>
					<div class="question_area">					
						<!--p>Student's Name:____________________&nbsp;&nbsp;Class Category:____&nbsp;&nbsp;Serial Number:____&nbsp;&nbsp;Score:____</p-->
						<p><b>SECTION A:</b> Objectives&nbsp;&nbsp;<b>Instrution:</b>&nbsp;Select the Correct Answer from the options Lettered A to D</p>
						<?php
						$sql = "SELECT DISTINCT * FROM examination_question WHERE sch_id='$sch_id' AND class_id='$cid' AND term_id='$tid' AND subj_id='$stid' AND sid='$sid' AND question_type='1'";
						$result = mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_array($result)){
							$question = $row['question']; $optionA = $row['optionA']; $optionB = $row['optionB']; $optionC = $row['optionC']; $optionD = $row['optionD'];
						?>
						<p><b><?php echo 'Q'.++$counter.'.&nbsp</b>'.$question;?><p>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						(A)&nbsp;<?php echo $optionA;?>
						(B)&nbsp;<?php echo $optionB;?>
						(C)&nbsp;<?php echo $optionC;?>
						(D)&nbsp;<?php echo $optionD;?></p>
						<?php } ?>
						<br/><p><b>SECTION B: Theory</b></p><p>
						<?php
						$tcounter=0;
						$sql = "SELECT DISTINCT * FROM examination_question WHERE sch_id='$sch_id' AND class_id='$cid' AND term_id='$tid' AND subj_id='$stid' AND sid='$sid' AND question_type='2'";
						$result = mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_array($result)){
							$question = $row['question']; $optionA = $row['optionA']; $optionB = $row['optionB']; $optionC = $row['optionC']; $optionD = $row['optionD'];
						?>
						<p><b><?php  echo 'Q'.++$tcounter.'.&nbsp</b>'.$question;?></p>
						<?php if(!empty($optionA)){ echo '<p>&nbsp;&nbsp;&nbsp;(a)&nbsp;' .$optionA.'</p>';}?>
						<?php if(!empty($optionB)){ echo '<p>&nbsp;&nbsp;&nbsp;(b)&nbsp;' .$optionB.'</p>';}?>
						<?php if(!empty($optionC)){ echo '<p>&nbsp;&nbsp;&nbsp;(c)&nbsp;' .$optionC.'</p>';}?>
						<?php if(!empty($optionD)){ echo '<p>&nbsp;&nbsp;&nbsp;(d)&nbsp;' .$optionD.'</p>';}?>
						<?php } ?>
						
					</div>
				</div> 
			</div>
			<a href="javascript:void(0);" style="margin-left:450px;" class="btn btn-primary" onclick="printPageArea('printableArea')">PRINT QUESTION</a>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/print.php');?>
</html>
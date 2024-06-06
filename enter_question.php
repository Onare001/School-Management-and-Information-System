<?php $page_title = "Enter Questions"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['session_id']) && isset($_GET['qt'])) {
	$cid = decrypt($_GET['cid']);//Class
	$tid = decrypt($_GET['tid']);//Term
	$subj_id = decrypt($_GET['sid']);//Subject
	$session_id = decrypt($_GET['session_id']);//Session
	$question_type = decrypt($_GET['qt']);//Question type   
} else {
	//header('location: create_exam_ques.php');
}
?>
<?php 
if ($question_type == 1){
	$qt = "Objectives";
	if (isset($_POST['submit'])) {
    $question = addslashes($_POST['question']);
    $optionA = addslashes($_POST['optionA']);
	$optionB = addslashes($_POST['optionB']);
	$optionC = addslashes($_POST['optionC']);
	$optionD = addslashes($_POST['optionD']);
    if (empty($question)) {
        $msg = 'Enter Question!';
    } else if (empty($optionA)) {
        $msg = 'Enter option A!';
    } else if (empty($optionB)) {
        $msg = 'Enter option B!';
    } else if (empty($optionC)) {
        $msg = 'Enter option C!';
    } else if (empty($optionD)) {
        $msg = 'Enter option D!';
    } else {
		$ent_question = mysqli_query($conn,"INSERT INTO `examination_question`(sch_id, class_id, subj_id, term_id, sid, question, optionA, optionB, optionC, optionD, question_type) VALUES ('$sch_id','$cid','$subj_id','$tid','$session_id','$question','$optionA','$optionB','$optionC','$optionD', '$question_type')");
		if ($ent_question){
			$msg = 'Question Saved';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Unable to save Question';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	  }
	}
} else if ($question_type == 2){
	$qt="Theory/Essay";
	if (isset($_POST['submit'])) {
    $question = $_POST['question'];
    $optionA = $_POST['optionA'];
	$optionB = $_POST['optionB'];
	$optionC = $_POST['optionC'];
	$optionD = $_POST['optionD'];
    if (empty($question)) {
        $msg = 'Enter Question!';
    } else {
		$ent_question = mysqli_query($conn,"INSERT INTO `examination_question`(sch_id, class_id, subj_id, term_id, sid, question, optionA, optionB, optionC, optionD, question_type) VALUES ('$sch_id','$cid','$subj_id','$tid','$session_id','$question','$optionA','$optionB','$optionC','$optionD', '$question_type')");
		if ($ent_question){
			$msg = 'Question Saved';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = 'Unable to save Question';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
}
?>
			<div class="card card-primary" style="width:900px;margin-left:50px;margin:0 auto;"><?php if (isset($msg) && isset($msg_toastr)) { echo $msg_toastr; }?>
				<div class="card-header">
					<h3 class="card-title">Enter Examination Question | <?php echo $qt;?></h3>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default" style="float:right;"><i class="fa fa-eye"></i>&nbsp;Preview Entered Questions</button>
					<button type="button" class="btn btn-danger" data-toggle="modal" style="float:right;"><a href="edit_exam_question?cid=<?php echo encrypt($cid);?>&&sid=<?php echo encrypt($subj_id);?>&&tid=<?php echo encrypt($tid);?>&&session_id=<?php echo encrypt($session_id);?>&&qt=<?php echo encrypt($question_type);?>"><i class="fa fa-edit"></i>&nbsp;Edit Questions</a>
					</button>
				</div>
				<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo '<text>'.$msg.'</text>';} ?></center>
				<form action="" method="post"> 
					<div class="box-body">
						<div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;Type in the Question and Options that follow in the Spaces Provided </div>
						<div class="form-group">
							<textarea id="compose-textarea" name="question" class="form-control" placeholder="Type Question Here" style="height: 300px"> </textarea>
							<input class="form-control" name="optionA" placeholder="Option A"/>
							<input class="form-control" name="optionB" placeholder="Option B"/>
							<input class="form-control" name="optionC" placeholder="Option C"/>
							<input class="form-control" name="optionD" placeholder="Option D"/>
						</div>
					</div>
					<div class="box-footer">
						<div class="pull-right" style="float:right;margin-bottom:10px;margin-right:10px">
							<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Submit </button>
						</div>              
					</div>
				</form>
			</div>        
			<div class="modal fade" id="modal-default">
				<div class="modal-dialog" style="margin-right:900px;">
					<div class="modal-content" style="width:1000px;margin-left:100px;margin-right:100px;">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fa fa-file"></i>&nbsp;Examination Question</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="card" id="printableArea" style="margin-left:10px;margin-right:10px;width:900px;">
								<div style="margin-left:30px;margin-right:10px;margin-top:15px;">
									<style type="text/css"> 
										p {
										line-height:10px;
										margin-top: 0.5em ;
										margin-bottom: 0.3em ;
										}
									</style>
									<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
										<tr>
											<td>
												<img src="<?php echo getSchlogo($sch_id);?>" alt="School Logo" style="max-width:100px;max-height:100px;"/>
											</td>
											<td>
												<h3 align="center"><?php echo strtoupper(getSchname($sch_id)); ?></h3>
												<p align="center"><?php echo getSchmotto($sch_id)?></p>
												<p align="center"><?php echo getSchAddress($sch_id)?></p>
											</td>
										</tr>
										<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
											<tr>
												<td align="center" width="105px">CLASS: <?php echo getClass($cid);?></td>
												<td align="center">SUBJECT: <?php echo strtoupper(getSubject($subj_id));?></td>
												<td align="center"><?php echo strtoupper(getTerm($tid)).'&nbsp;'.'EXAMINATION QUESTIONS';?></td>
												<td align="center">SESSION: <?php echo getSession($session_id).'&nbsp;';?></td>
											</tr>
										</table>
									</table>
									<table border="1" cellspacing="2" cellpadding="2" align="center" width="800px">
										<tr>
											<td>&nbsp;General Instruction:&nbsp; Answer Both Sections</td>
											<td>&nbsp;Time Allowed : 2Hrs</td>
											<td>&nbsp;Point Obtainable: 70 Marks</td>
										</tr>
									</table><br>
									<!--p>Student's Name:____________________&nbsp;&nbsp;Class Category:____&nbsp;&nbsp;Serial Number:____&nbsp;&nbsp;Score:____</p-->
									<p><b>SECTION A:</b> Objectives&nbsp;&nbsp;<b>Instrution:</b>&nbsp;Select the Correct Answer from the options Lettered A to D</p>
									<?php
									$result = mysqli_query($conn,"SELECT DISTINCT * FROM examination_question WHERE sch_id='$sch_id' AND class_id='$cid' AND term_id='$tid' AND subj_id='$subj_id' AND sid='$session_id' AND question_type='1'"); 
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
									<p><b>SECTION B: Theory</b></p>
									<?php
									$tcounter=0;
									$result = mysqli_query($conn,"SELECT DISTINCT * FROM examination_question WHERE sch_id='$sch_id' AND class_id='$cid' AND term_id='$tid' AND subj_id='$subj_id' AND sid='$session_id' AND question_type='2'"); 
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
							<a href="javascript:void(0);" class="btn btn-primary" onclick="printPageArea('printableArea')">PRINT QUESTION</a>
						</div>
					</div>
				</div> 
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/text_editor.php');?>
<?php include ('include/page_scripts/print.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
<?php $page_title = "Edit Questions"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['session_id']) && isset($_GET['qt'])) {
    //Getting the classID, CategoryID, SubjectID, TermID & YearID
    $cid = decrypt($_GET['cid']);//Class
	$tid = decrypt($_GET['tid']);//Term
	$subj_id = decrypt($_GET['sid']);//Year
    $session_id = decrypt($_GET['session_id']);//Session
	$question_type = decrypt($_GET['qt']);//Question type   
    //
	} else {
		//header('location: create_exam_ques.php');
	}
 
if ($question_type == 1){
	$qt="Objectives";
	if (isset($_POST['submit'])) {
	$qid = trim($_POST['qid']);
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
		$ent_question = "UPDATE `examination_question` SET `question`='$question',`optionA`='$optionA',`optionB`='$optionB',`optionC`='$optionC',`optionD`='$optionD' WHERE question_id='$qid'";//`sch_id`='$sch_id' AND `class_id`='$cid' AND `subj_id`='$subj_id' AND `term_id`='$tid', AND `sid`='$session_id' AND `question_type`='$question_type'	
	$result = mysqli_query($conn,$ent_question);
	if ($result){
		echo ('<script>alert("Correction has been made on the Question")</script>');
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
		$ent_question = "INSERT INTO `examination_question`(sch_id, class_id, subj_id, term_id, sid, question, optionA, optionB, optionC, optionD, question_type) VALUES ('$sch_id','$cid','$subj_id','$tid','$session_id','$question','$optionA','$optionB','$optionC','$optionD', '$question_type')";
	$result = mysqli_query($conn,$ent_question);
	if ($result){
		echo ('<script>alert("Entered")</script>');
			}
		}
	}
}
?>
<?php if (isset($msg)) { echo '<p style="color:red;text-align:center;" class="error">'. $msg.'</p>';} ?> 
<?php 
 $result = mysqli_query($conn,"SELECT DISTINCT * FROM examination_question WHERE sch_id='$sch_id' AND class_id='$cid' AND term_id='$tid' AND subj_id='$subj_id' AND sid='$session_id' AND question_type='1'"); 
			while($row = mysqli_fetch_array($result)){
				$question = $row['question']; $optionA = $row['optionA']; $optionB = $row['optionB']; $optionC = $row['optionC']; $optionD = $row['optionD'];
	 
?>

<div class="card card-primary" style="width:900px;margin-left:50px;margin:0 auto;">
  <div class="card-header">
	<h3 class="card-title">Question Number: <?php echo ++$counter;?></h3>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default" style="float:right;">
	  <i class="fa fa-eye"></i>&nbsp;Preview Entered Questions
	</button>
	<button type="button" class="btn btn-danger" data-toggle="modal" style="float:right;">
	  <a href="#"><i class="fa fa-edit"></i>&nbsp;Edit Questions</a>
	</button>
  </div>
	 
                <div class="box-body">
                  <div class="form-group">
					<form action="" method="post">			  
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" name="question" class="form-control" placeholder="Type Question Here" style="height: 300px" >
                      <?php echo $question = $row['question'];?>
                    </textarea>
						<input class="form-control" value="<?php echo $optionA;?>" name="optionA" placeholder="Option A"/>
						<input class="form-control" value="<?php echo $optionB;?>" name="optionB" placeholder="Option B"/>
						<input class="form-control" value="<?php echo $optionC;?>" name="optionC" placeholder="Option C"/>
						<input class="form-control" value="<?php echo $optionD;?>" name="optionD" placeholder="Option D"/>
						<input type="hidden" name="qid" value="<?php echo $row['question_id'];?>"/>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="pull-right">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Submit</button>
                  </div>
				  </form> 
                </div>
              </div>
     <p>
 <?php } ?>	
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/text_editor.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
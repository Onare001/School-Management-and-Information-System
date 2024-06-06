<?php $page_title = "View Examination Question"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$tid="";$cid="";$stid="";$sid="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$term_id = $_POST['term_id'];
	$subj_id = $_POST['subj_id'];
	$sid = $_POST['session_id']; 
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';	
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($subj_id)) {
        $msg = 'Select a Subject!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';	
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_subj.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($term_id)) {
        $msg = 'Select a Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';	
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_term.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($sid)) {
        $msg = 'Select a Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    } else { //
        $sql = "SELECT question_id FROM examination_question WHERE sch_id='$sch_id' AND class_id='$class_id' AND term_id='$term_id' AND subj_id='$subj_id' AND sid='$sid'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: examination_ques?cid=" . encrypt($class_id) . "&tid=" . encrypt($term_id) . "&stid=" . encrypt($subj_id) . "&sid=" . encrypt($sid));
        } else {
            $msg = 'No Examination Question for this Class Contact the Subject Teacher';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_no_exam_question.mp3" type="audio/mpeg">
			</audio>';
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

			<div class="card card-primary" id="selectbox">
				<div class="card-header">
					<h3 class="card-title">Select Class & Subject | Print Examination Questions</h3>
				</div>
				<div class="card-body">	
					<!--center style="margin-bottom:10px;"--><?php if (isset($msg)) { echo $msg_toastr;} ?><!--/center-->
					<form action="" method="post">	   
						<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
							<tr>
								<td align="left">
									<div class="col-md-12"> 
										<select name="class_id" id="sel_class" class="form-control">
											<?php
											echo '<option value="">'.'Select Class'.'</option>';
											$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
											} ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td align="left">
									<div class="col-md-12"> 
										<select name="subj_id" id="sel_subj" style="width:100%;" class="form-control">
											<?php
											echo '<option value="">Select Subject</option>';
											$result = mysqli_query($conn,"SELECT * FROM subj_info ORDER BY subj_title");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row['subj_id'].'">'.getSubject($row['subj_id']).'</option>';
											} ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="col-md-12">    
										<select name="term_id" id="sel_term" class="form-control">
											<?php
											echo '<option value="">Select Term</option>';
											$result = mysqli_query($conn,"SELECT * FROM term_info");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
											} ?>
										</select>
									</div>  
								</td>
							</tr>
							<tr>
								<td>
									<div class="col-md-12">      
										<select name="session_id" id="sel_session" class="form-control">
											<?php
											echo '<option value="">Select Session</option>';
											$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
											} ?>
										</select>
									</div>  
								</td>  
							</tr>
						</table>
						<div class="modal-footer">
							<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
							<input name="submit" type="submit" value="Continue" class="btn btn-primary"/>
						</div>
					</form>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
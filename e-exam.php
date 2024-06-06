<?php $page_title = "Schedule Exam"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
if (isset($_POST['submit'])) {
	$exam_type = $_POST['exam_type'];
	$subj_id = $_POST['subj_id'];
    $class_id = $_POST['class_id'];
	$term_id = $_POST['term_id'];
	$session_id = $_POST['session_id'];
	$duration = $_POST['duration'];
	$no_of_question = $_POST['no_of_question'];
	
    if (empty($exam_type)) {
        $msg = 'Please select an examination type';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($subj_id)) {
        $msg = 'Please select a subject';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($class_id)) {
        $msg = 'Please select a class';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Please select a term for the '.$exam_type;
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = 'Please select a session for '.$exam_type;
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($duration)) {
        $msg = 'Please select the duration for the '.$exam_type;
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($no_of_question)) {
        $msg = 'Please select number of questions';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
		$check_record = mysqli_query($conn,"SELECT * FROM e_exam WHERE sch_id='$sch_id' AND class_id='$class_id' AND subj_id='$subj_id' AND term_id = '$term_id' AND session_id='$session_id' AND exam_type='$exam_type'");
		if (mysqli_num_rows($check_record) == false){
			$result = mysqli_query($conn,"INSERT INTO `e_exam`(`sch_id`, `class_id`, `session_id`,`subj_id`,`term_id`,`duration`,`no_of_question`,`exam_type`) VALUES ('$sch_id','$class_id','$session_id','$subj_id','$term_id','$duration','$no_of_question','$exam_type')");
			if ($result) {
				$msg = 'New Examination has been Created';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = 'Something went Wrong please try again';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		} else {
			$msg = 'This '.$exam_type.' has already been Created';
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		}
    }
}

if (isset($_GET['eid'])) {
  $eid = decrypt($_GET['eid']);
    // Delete examination record
	$result = mysqli_multi_query($conn,"DELETE FROM e_exam WHERE exam_id = $eid;");
    if ($result) {
		$msg = "Deleted Successfully";
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		header("location: e-exam");
    } else {
		$msg = "Error deleting user: " . mysqli_error($conn);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
				
			<div class="card" style="margin-left:10px;margin-right:10px;">
				<div class="card-header">
					<h3 class="card-title"><i class="fa fa-clock"></i> Schedule an E-Examination</h3>
					<div style="float:right;">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" style="float:right;"><i class="fa fa-plus"></i>&nbsp;Create New Examination</button>
					</div>	
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SN</th>
								<th width="45%">Subject</th>
								<th width="5%">Class</th>
								<th width="15%">Term</th>
								<th width="5%">Session</th>
								<th width="5%">Duration</th>
								<th width="15%">#Quest</th>
								<th width="5%">Status</th>
								<th width="5%">Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$result = mysqli_query($conn,"SELECT * FROM e_exam WHERE sch_id='$sch_id'");
						while ($row = mysqli_fetch_array($result)){
						?> 
							<tr>
								<td align="center"><?php echo ++$counter;?></td>
								<td><?php echo getSubject($row['subj_id']).'_'.$row['exam_type'];?></td>
								<td><?php echo getClass($row['class_id']);?></td>
								<td><?php echo getTerm($row['term_id']);?></td>
								<td><?php echo getSession($row['session_id']);?></td>
								<td><?php echo $row['duration'].' Minutes';?></td>
								<td><?php echo $row['no_of_question'].' questions';?></td>
								<td align="center" width="5px">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="customSwitch<?php echo $row['exam_id']; ?>" <?php echo ($row['status'] == '1') ? 'checked' : ''; ?> data-tid="<?php echo $row['exam_id']; ?>" data-state="<?php echo ($row['status'] == '1') ? '1' : '0'; ?>" data-table="e_exam">
										<label class="custom-control-label" for="customSwitch<?php echo $row['exam_id']; ?>"></label>
									</div>
								</td>
								<td><center><a title="Delete" onclick="return confirm('Are you sure you want to delete this Information?');" href="?eid=<?php echo encrypt($row['exam_id']);?>"><img src="assets/img/trash.png" width="16" height="16" alt="img"></a></center></td>
							</tr>
						<?php } ?>
					  </tbody>
					</table><p>		
				</div>
			</div>
			<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;Create New Examination</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<center style="color:red;" class="error">
							<?php if (isset($msg)) { 
								echo '<center><span class="badge bg-danger" align:center">'.$msg.'</span><center>';
								echo $msg_toastr;
							} ?>
						</center>
						<form action="e-exam" method="post" autocomplete="off">
							<div class="modal-body">
							<p><select name="exam_type" id="exam_type" class="form-control">   
									<?php
									echo '<option value="">'.'Select Examination Type'.'</option>';
									echo '<option value="Test">'.'Test'.'</option>';
									echo '<option value="Examination">'.'Examination'.'</option>';
									echo '<option value="Common Entrance">'.'Common Entrance'.'</option>';
									?><br/>
								</select></p>
							  <p><select name="subj_id" id="sel_subj" class="form-control">   
									<?php
									echo '<option value="">'.'Subject'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM subj_info ORDER BY subj_title");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["subj_id"].'">'.$row["subj_title"].'</option>'; } ?><br/>
								</select></p>
							  <p><select name="class_id" id="sel_class" class="form-control">   
									<?php
									echo '<option value="">'.'Class'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
								</select></p>  
							  <p><select name="term_id" id="sel_term" class="form-control">   
									<?php
									echo '<option value="">'.'Term'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM term_info");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["term_id"].'">'.getTerm($row["term_id"]).'</option>'; } ?><br/>
								</select></p>
							  <p><select name="session_id" id="sel_session" class="form-control">
									<?php
									echo '<option value="">Select Session</option>';
									$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
									} ?>
								</select></p>
							  <p><select name="duration" id="duration" class="form-control">   
									<?php
									echo '<option value="">'.'Duration'.'</option>';
									for ($i = 10;$i <= 60;$i = $i + 10) {
										echo '<option value="'.$i.'">'.$i.' Minutes'.'</option>';
									}
									?>
								</select></p>
							 <p><select name="no_of_question" id="noquestion" class="form-control">   
									<?php
									echo '<option value="">'.'Number of Questions'.'</option>';
									for ($i = 10;$i <= 60;$i = $i + 10) {
										echo '<option value="'.$i.'">'.$i.' Question'.'</option>';
									}
									?>
								</select></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="reset" value="Reset" class="btn btn-danger"/>
								<input name="submit" type="submit" value="Schedule" class="btn btn-primary">
							</div>
						</form>			
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<?php include ('include/ajax/switcher.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
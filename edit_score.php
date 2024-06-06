<?php $page_title = "Edit Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['scrid']) && isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['sesid'])) {
    $score_id = decrypt($_GET['scrid']);//ScoreID
	$cid = decrypt($_GET['cid']);//ClassID
    $did = decrypt($_GET['did']);//CatID
    $subj_id = decrypt($_GET['sid']);//Subject
    $tid = decrypt($_GET['tid']);//TermID
    $session_id = decrypt($_GET['sesid']);//SessID
} else {
	header("Location:enter_class_score");
}

if (isset($_POST['submit'])) {
    $uid = $_POST['user_id'];
    $first_ca = $_POST['first_ca'];
    $sec_ca = $_POST['sec_ca'];
    $third_ca = $_POST['third_ca'];
    $exam = $_POST['exam'];
    $class_id = $cid;
    $cat_id = $did;
    $term_id = $tid;
     if (empty($first_ca)) {
        $msg = 'Enter First C.A.!';
    } else if (empty($sec_ca)) {
        $msg = 'Enter Second C.A.!';
    } else if (empty($third_ca)) {
        $msg = 'Enter Third C.A.!';
    } else if (empty($exam)) {
        $msg = 'Enter Exam Score!';
    } else { // compute the total
        $total = $first_ca + $sec_ca + $third_ca + $exam;
		
		if ($total == '0'){
			$msg = 'You cannot submit zero(0) score for a student. You are advised to Request Delete from the Admin, if this entry was a mistake.';
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		} else {
			$edit_score = mysqli_query($conn,"UPDATE score_info SET user_id='$uid', first_ca='$first_ca', second_ca='$sec_ca', third_ca='$third_ca', exam='$exam',total='$total' WHERE score_id='$score_id'");
			EditCumulative($sch_id, $subj_id, $class_id, $cat_id,  $session_id, $term_id, $uid, $total);

			if ($edit_score == TRUE){
				header("location: preview_score?cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) . "&sid=" . encrypt($subj_id) . "&tid=" . encrypt($term_id) . "&sesid=" . encrypt($session_id));
			} else {
				echo mysqli_error($conn);
			}
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

		<section class="contet">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<div class="sticky-top mb-3">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b><?php echo getClass($cid).' '.getCategory($did);?></b></h3>
									</div>
									<div class="card-body">
										<!--div id="external-events" style="font-size:12px;">
										<?php
											echo '<div class="external-event bg-green"><i class="fa fa-arrow-up"></i> Highest Score: '. getHGST($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>
											<div class="external-event bg-danger"><i class="fa fa-arrow-down"></i> Lowest Score: '.  getLWST($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>
											<div class="external-event bg-primary"><i class="fa fa-users"></i> Average: '. round(getAVG($sch_id, $cid, $did, $sid, $tid, $session_id),2).'</div>
											<div class="external-event bg-danger"><i class="fa fa-times"></i> Number of Fail: '. getFail($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>';?>
										</div-->
									</div>
								</div>
								<div class="card">
									<div class="card-body">	
										<form action="" method="post">
											<style> .btn-block{font-size:12px;}</style>
											<button title="back" type="button" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
											
											<button title="Print Score" type="submit" name="print" value="PRINT" '+' onClick="javascript:window.print()" class="btn btn-primary btn-block btn-sm"><i class="fa fa-print"></i> Print Score</button>
											
											<button type="submit" name="download_csv" class="btn btn-primary btn-block btn-sm"><i class="fa fa-download"></i> Download CSV Format</button>
											
											<button title="Preview Entered Score" type="button" onclick="location.href='preview_score?<?php echo 'cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id);?>'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> Preview Entered Score</button>
											
											<button type="button" onclick="location.href='enter_score?<?php echo 'cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id);?>'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-percent">&nbsp;&nbsp;</i>Back to Enter Score</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-10">	
							<div class="card content">
								<div class="card-header">
									<h3 class="card-title">Edit Score</h3>
									<div style="float:right;">
										<table border="0" align="center" cellspacing="50px" style="width:100%;;">
											<tr>
											<td><b>NAME : <?php //echo strtoupper(getFirstName($uid)).' '.strtoupper(getLastName($uid));?></td>
											<td><b>CLASS : <?php echo getClass($cid).'&nbsp;'.getCategory($did);?>&nbsp;&nbsp;</td>
											<td><b>SUBJECT : <?php echo strtoupper(getSubject($subj_id));?>&nbsp;&nbsp;</td>
											<td><b>SESSION : <?php echo getSession($session_id).'&nbsp;'.'ACADEMIC SESSION';?>&nbsp;&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="card card-primary" id="selectbox" style="margin-top:45px;margin-bottom:45px;">
									<div class="card-header"><h3 class="card-title">Edit Score Entries</h3></div>
									<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
									<form action="" method="post">
										<table align="center" border="0" class="table" style="width:100%;">
											<div style="width:400px;margin:0 auto;">
												<label>Student Name</label>
													<?php
													  $sql001 = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id WHERE score_info.score_id = '$score_id'");
													$row = mysqli_fetch_array($sql001);
														$uid = $row['user_id'];
														$first_name = $row['first_name'];
														$last_name = $row['last_name'];
														$first_ca = $row['first_ca']; $sec_ca = $row['second_ca']; $third_ca = $row['third_ca']; $exam = $row['exam'];
													?>
													<input name="user_id" type="hidden" value="<?php echo $uid; ?>">
													<select name="" class="form-control" disabled>
														<option value="<?php echo $row['user_id']; ?>"><?php echo $last_name.'&nbsp;'.$first_name; ?></option>
													</select>
											</div><br/>
											<tr>
												<td align="left">
													<label>First CA</label>
													<select name="first_ca" class="form-control">
														<option value="<?php echo $first_ca;?>"><?php echo $first_ca;?></option>
														<?php
														for ($i = 0;$i <= 10;$i = $i + 1) {
															if (strlen($i) < 2) {
																echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
															} else {
																	echo "<option value=" . $i . ">" . $i . "</option>";
																}
															}
														?>
													</select>
												</td>
												<td align="left">
													<label>Second CA</label>
													<select name="sec_ca" class="form-control">
														<option value="<?php echo $sec_ca;?>"><?php echo $sec_ca;?></option>
														<?php
														for ($i = 0;$i <= 10;$i = $i + 1) {
															if (strlen($i) < 2) {
																echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
															} else {
																echo "<option value=" . $i . ">" . $i . "</option>";
															}
														}
														?>
													</select>
												</td>
												<td align="left">
												<label>Third CA</label>
													<select name="third_ca" class="form-control">
														<option value="<?php echo $third_ca;?>"><?php echo $third_ca;?></option>
														<?php
														for ($i = 0;$i <= 10;$i = $i + 1) {
															if (strlen($i) < 2) {
																echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
															} else {
																echo "<option value=" . $i . ">" . $i . "</option>";
																}
															}
														?>
													</select>
											   </td>
												<td>
													<label>Exam Score</label>			
													<select name="exam" class="form-control">
														<option value="<?php echo $exam;?>"><?php echo $exam;?></option>
														<?php
														for ($i = 0;$i <= 70;$i = $i + 1) {
															if ($i < 10) {
																echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
															} else {
																echo "<option value=" . $i . ">" . $i . "</option>";
																}
															}
														?>
													</select>
												</td>
											</tr>
										</table>
										<div class="modal-footer">
											<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
											<button type="submit" name="submit" id="buttonn" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
											<!--a href="preview_score?<?php echo '&cid='.encrypt($cid).'&did='.encrypt($did).'&sid='.encrypt($subj_id).'&tid='.encrypt($tid).'&sesid='.encrypt($session_id);?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a-->
										</div>
									</form>   
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
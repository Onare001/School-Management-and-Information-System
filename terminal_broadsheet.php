<?php $page_title = "Terminal Broadsheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$tid = $cid = $did = $sid = "";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$cat_id = $_POST['cat_id'];
	$term_id = $_POST['term_id'];
	$sid = $_POST['session_id']; 
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Select Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($sid)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
        $sql = "SELECT score_id FROM score_info WHERE sch_id='$sch_id' AND class_id='$class_id' AND term_id='$term_id' AND sid='$sid'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: load_terminal_broadsheet?cid=" . encrypt($class_id) . "&tid=" . encrypt($term_id)."&did=" . encrypt($cat_id) . "&sid=" . encrypt($sid));
        } else {
            $msg = 'No Score Record for this Class';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
        }
    }
}

if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid'])) {
    $cid = decrypt($_GET['cid']);//Class
	$did = decrypt($_GET['did']);//Category
	$tid = decrypt($_GET['tid']);//Term
    $sid = decrypt($_GET['sid']);//Session    
} else {
	//header("location: terminal_broadsheet.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<div style="margin-left:10px;margin-right:10px;"><?php if (isset($msg)) {echo $msg_toastr; } ?>
				<form action="" method="post">
					<table border="0" align="center" style="border-collapse:collapse; width:100%;">
						<tr>
							<td>
								<select name="class_id" id="sel_class" class="form-control">
									<?php
									echo '<option value="">'.'Select Class'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; 
									} ?><br/>
								</select>
							</td>
							<td>
								<select name="cat_id" id="sel_cat" class="form-control">
									<?php
									echo '<option value="">'.'Select Category'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_cat");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; 
									} ?><br/>
								</select>
							</td>
							<td>
								<select name="term_id" id="sel_term" class="form-control">
									<?php
									echo '<option value="">'.'Select Term'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM term_info");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>'; 
									} ?><br/>
								</select>				
							</td>
							<td>
								<select name="session_id" id="sel_session" class="form-control">
									<?php
									echo '<option value="">'.'Select Session'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>'; } ?><br/>
								</select>
							</td>
							<td width="50">
								<input name="submit" type="submit" value="Submit" class="btn btn-primary" style="vertical-align:top;height:34px;"/>
							</td>
							<td width="40">    
								<input title="Print" type="submit" class="btn btn-primary" name="print" value="PRINT" '+' onClick="javascript:window.print()" style="vertical-align:top;height:34px;"/>
							</td>
						</tr>
					</table><p> 
				</form>
			</div>
			<div class="card" style="margin-left:10px;margin-right:10px;zoom:95%;">
				<div class="card-header">
					<h3 class="card-title">Terminal Broadsheet <?php if(isset($_GET['sid'])) { echo '|&nbsp;'.getClass($cid).getCategory($did).'&nbsp;'.getTerm($tid).'&nbsp;'.getSession($sid).'&nbsp;'.'ACADEMIC SESSION';}?> </h3>
				</div>
				<div class="card-body">
					<?php
					$result456 = mysqli_query($conn,"SELECT DISTINCT * FROM score_info JOIN sch_users ON score_info.user_id=sch_users.user_id AND score_info.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND score_info.cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid' GROUP BY stdnt_info.user_id");
					while ($row = mysqli_fetch_array($result456)){
					$uid = $row['user_id']; 
					$ses_id = $row['sid'];
					
					// Collating the individual aggregates
					$result567 = mysqli_query($conn,"SELECT total, SUM(total) AS aggregate FROM score_info WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
					$row = mysqli_fetch_array($result567);
					$aggregate = $row['aggregate'];
							
					// Updating the individual aggregate
					$result444 = mysqli_query($conn,"UPDATE score_info SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
							
					// Computing the total subject offered by student
					$result213 = mysqli_query($conn,"SELECT DISTINCT score_id, COUNT(score_id) AS total_subj FROM score_info WHERE user_id='$uid'  AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
					$row = mysqli_fetch_array($result213);
					$total_subj = $row['total_subj'];
					
					// Getting the comment
					$result498 = mysqli_query($conn,"SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND session_id='$sid'");
					$row = mysqli_fetch_array($result498);
					$com = $row['com_id'];
					
					//Show Position on Result
					$show_pstn = "SELECT show_pstn FROM sch_info WHERE sch_id = '$sch_id'";
					$result = mysqli_query($conn,$show_pstn);
					$row = mysqli_fetch_array($result);
					$postn = $row['show_pstn'];
						if($postn == 1){
							$position = Ordinal(getStudentPos($aggregate, $sch_id, $cid, $did, $tid, $sid));
						} else {
							$position = '';
						}
					echo '  
					<table class="table table-bordered" style="width:100%;zoom:85%;">
						<thead>
							<tr>
								<td align="center">'.++$counter.'</td>
								<td align="center" colspan="'.($total_subj + '3').'"><b>'.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).'-----'.getUsername($uid).'</b></td>
							</tr>
							<tr>
								<th>Subject('.$total_subj.')</th>';
								$result = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id = '$uid' AND sch_id = '$sch_id' AND class_id = '$cid' AND cat_id='$did' AND term_id = '$tid'AND sid = '$ses_id' ORDER BY subj_id");
								while($row = mysqli_fetch_array($result)){	
								$subj_id = $row['subj_id'];
								echo '<th style="width:30px;font-size:9px;">'.getSubjectAbbr($subj_id).'</th>';}echo '<br>
								<th style="width:30px;font-size:9px;">Aggr</th>
								<th style="width:30px;font-size:9px;">Postn</td>
								<th style="width:30px;font-size:9px;">Com</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="width:30px" align="center"><b>Total</b></td>';
								$result = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id = '$uid' AND sch_id = '$sch_id' AND class_id = '$cid' AND cat_id='$did' AND term_id = '$tid'AND sid = '$ses_id' ORDER BY subj_id");
								while($row = mysqli_fetch_array($result)){	
								$total = $row['total'];
								echo '<td style="width:30px" align="center">'.$total;'</td>'; } echo '<br/>
								<td style="width:30px;font-weight:bold;font-size:10;" align="center">'.$aggregate.'</td>
								<td style="width:30px;font-weight:bold;" align="center">'.$position.'</td>
								<td style="width:30px;font-weight:bold;" align="center">	
									<div class="icheck-danger">
										<input type="checkbox" style="display:none" id="check'.++$counter2.'" class="checkbox"'; echo (!empty($com)) ? 'checked disabled' : ' disabled';echo '/>
										<label for="check'.++$counter1.'"></label>
									</div>
								</td>
							</tr>
						</tbody>
					</table><p>';
					} ?>
				</div>
				<div class="card-footer clearfix"> </div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
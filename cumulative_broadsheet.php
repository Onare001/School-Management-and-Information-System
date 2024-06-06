<?php $page_title = "Cumulative Broadsheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$cid="";$did="";$sid="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$cat_id = $_POST['cat_id'];
	$sid = $_POST['sid']; 
    if (empty($class_id)) {
        $msg = 'Select Class!';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
    } else if (empty($sid)) {
        $msg = 'Select Session!';
    } else { //
        $sql = "SELECT score_id FROM cum_result WHERE sch_id='$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND sid='$sid'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: load_cumulative_broadsheet?cid=" . encrypt($class_id) ."&did=" . encrypt($cat_id) . "&sid=" . encrypt($sid));
        } else {
            $msg = '<span class="badge bg-danger">'.'No Score Record for this Class'.'</span>';
        }
    }
}

$cid = $did = $sid = $com = $uid = "";
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid'])) {
	//Obtaining Class_id, Cat_id, Term_id && Year_id
	$cid = decrypt($_GET['cid']);//Class
	$did = decrypt($_GET['did']);//Category
	$sid = decrypt($_GET['sid']);//Session
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>
<?php include('include/page_title.php');?>
    
			<div style="margin-left:10px;margin-right:10px;">
				<text style="color:red;"><?php if (isset($msg)) {echo '<div align="center">'.$msg. '</div>'; } ?></text>
				<form action="" method="post">
					<table border="0" align="center" style="border-collapse:collapse; width:100%;">
						<tr>
							<td>
								<select name="class_id" id="sel_class" class="form-control">
									<?php
									echo '<option value="">'.'Select Class'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
								</select>
							</td>
							<td>
								<select name="cat_id" id="sel_cat" class="form-control">
									<?php
									echo '<option value="">'.'Select Category'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_cat");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
								</select>
							</td>
							<td>
								<select name="sid" id="sel_session" class="form-control">
									<?php
									echo '<option value="">'.'Select Session'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
									while ($row = mysqli_fetch_array($result)){	
									echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>';
									} ?><br/>
								</select>
							</td>
							<td width="50">
								<input name="submit" type="submit" value="Submit" class="btn btn-primary" style="vertical-align:top; height:34px;">
							</td>
							<td width="50">    
								<input title="Print" type="submit" class="btn btn-primary" name="print" value="PRINT" '+' onClick="javascript:window.print()" style="vertical-align:top; height:34px;">
							</td>
						</tr>
					</table> 	
				</form>
			</div>			
			<div class="card" id="printableArea" style="margin-left:10px;margin-right:10px;zoom:85%;">
				<div class="card-header">
					<h3 class="card-title">Cumulative Broadsheet | <?php if (isset($_GET['sid'])) { echo getClass($cid).getCategory($did).'&nbsp;'.'&nbsp;'.getSession($sid).'&nbsp;'.'ACADEMIC SESSION';}?> </h3>
				</div>
				<div class="card-body">
					<?php
					// Calculating Cumulative result...
						include('include/results/calc_cumulative.php');

					// Getting the individual student's record for the first term
						$showresult = mysqli_query($conn,"SELECT DISTINCT * FROM cum_result JOIN sch_users ON cum_result.user_id=sch_users.user_id AND cum_result.sch_id=sch_users.sch_id JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cum_result.cat_id='$did' AND cum_result.sid='$sid' GROUP BY stdnt_info.user_id ORDER BY cum_result.aggregate_score DESC");
						while ($row = mysqli_fetch_array($showresult)){
						$uid = $row['user_id']; 
						$ses_id = $row['sid'];
						$subj_sno = 0;

					// Collating the individual aggregates
						$result567 = mysqli_query($conn,"SELECT average, SUM(average) AS aggregate FROM cum_result WHERE user_id='$uid' AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
						$row = mysqli_fetch_array($result567);
						$aggregate = $row['aggregate'];
							
					// Updating the individual aggregate
						$result444 = mysqli_query($conn,"UPDATE cum_result SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
							
					// Computing the total subject offered by student
						$result213 = mysqli_query($conn,"SELECT DISTINCT score_id, COUNT(score_id) AS total_subj FROM cum_result WHERE user_id='$uid'  AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
						$row = mysqli_fetch_array($result213);
						$total_subj = $row['total_subj'];       
					?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td align="center"><?php echo ++$counter;?></td>
								<td align="center" colspan="<?php echo $total_subj + 3;?>"><b><?php echo strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid)).'-----'.getUsername($uid).'---'.getStatus($uid);?></b></td>
							</tr>
							<tr>
								<th>Subject(<?php echo $total_subj;?>)</th>
								<?php 
								$result = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id = '$uid' AND sch_id = '$sch_id' AND class_id = '$cid' AND cat_id='$did' AND sid = '$ses_id' ORDER BY subj_id");
								while ($row = mysqli_fetch_array($result)){
									echo '<th style="width:30px;font-size:9px;">'.getSubjectAbbr($row['subj_id']).'</th>';
								} ?>
								<th style="width:30px;font-size:9px;">Aggr</th>
								<th style="width:30px;font-size:9px;">Postn</th>
								<th style="width:30px;font-size:9px;">Remark</th>			
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="width:30px" align="center"><b>Total</b></td>
								<?php 
								$result = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id = '$uid' AND sch_id = '$sch_id' AND class_id = '$cid' AND cat_id='$did' AND sid = '$ses_id' ORDER BY subj_id");
								while($row = mysqli_fetch_array($result)){
									echo '<td style="width:30px;font-size:12px;" align="center">'.$row['average'].'</td>';
								} ?> 
								<td style="width:30px;font-size:12px;" align="center"><?php echo $aggregate ;?></td>
								<td style="width:30px;font-size:12px;" align="center"><?php echo Ordinal(getStudentcumPos($aggregate, $sch_id, $cid, $did, $sid));?></td>
								<td style="width:30px;font-size:9px;" align="center"><?php echo getPromStatus($sch_id, $uid, $cid, $did, $sid, $aggregate, $total_subj);?></td>
							</tr>
						</tbody>
					</table><p>
					<?php } ?>
				</div>
				<div class="card-footer clearfix">
					<table class="table" border="1">
						<tr>
							<td>Promoted: <?php echo count([1,2,3],'1');?></td>
							<td>Repeat: </td>
							<td>On Probation: </td>
							<td>Resit Mathematics: </td>
							<td>Resit English: </td>
							<td>Resit Mathematics & English: </td>
						</tr>
					</table>
			   </div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
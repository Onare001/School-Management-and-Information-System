<?php $page_title = "Preview Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['sesid'])) {
    $cid = decrypt($_GET['cid']);
    $did = decrypt($_GET['did']);
    $sid = decrypt($_GET['sid']);//Subject
    $tid = decrypt($_GET['tid']);
    $session_id = decrypt($_GET['sesid']);
} else {
	header("Location:enter_class_score.php");
}

//
$total =""; $uid = "";
$class_id = $cid;
$cat_id = $did;
$subj_id = $sid;
$term_id = $tid;  
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<div class="sticky-top mb-3">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b><?php echo getClass($class_id).' '.getCategory($cat_id);?></b></h3>
									</div>
									<div class="card-body">
										<div id="external-events" style="font-size:12px;">
										<?php
											echo '<div class="external-event bg-green"><i class="fa fa-arrow-up"></i> Highest Score: '. getHGST($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>
											<div class="external-event bg-danger"><i class="fa fa-arrow-down"></i> Lowest Score: '.  getLWST($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>
											<div class="external-event bg-primary"><i class="fa fa-users"></i> Average: '. round(getAVG($sch_id, $cid, $did, $sid, $tid, $session_id),2).'</div>
											<div class="external-event bg-danger"><i class="fa fa-times"></i> Number of Fail: '. getFail($sch_id, $cid, $did, $sid, $tid, $session_id).'</div>';?>
										</div>
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
									<h3 class="card-title">Preview Score</h3>
									<div style="float:right;">
										<table border="0" align="center" cellspacing="50px" style="width:100%;;">
											<tr>
											<td><b><?php echo strtoupper(getTerm($tid));?>&nbsp;SCORE&nbsp;&nbsp;</td>
											<td><b>CLASS : <?php echo getClass($cid).'&nbsp;'.getCategory($did);?>&nbsp;&nbsp;</td>
											<td><b>SUBJECT : <?php echo strtoupper(getSubject($sid));?>&nbsp;&nbsp;</td>
											<td><b>SESSION : <?php echo getSession($session_id).'&nbsp;'.'ACADEMIC SESSION';?>&nbsp;&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th align="center" class="pad">S/N</th>
											<th align="left" class="pad">STUDENT NAME</th>
											<th align="center" class="pad">1ST CA</th>
											<th align="center" class="pad">2ND CA</th>
											<th align="center" class="pad">3RD CA</th>
											<th align="center" class="pad">EXAM SCORE</th>
											<th align="center" class="pad">TOTAL</th>
											<th align="center" class="pad">GRADE</th>
											<th align="center" class="pad">EDIT</th>
										</thead>
										<tbody>	
										<?php
										$result = mysqli_query($conn,"SELECT * FROM score_info JOIN sch_users ON score_info.user_id = sch_users.user_id WHERE sch_users.sch_id = '$sch_id' AND score_info.class_id= '$cid' AND score_info.cat_id='$did' AND score_info.subj_id='$sid' AND score_info.sid='$session_id' AND term_id = '$tid' ORDER BY sch_users.last_name,sch_users.first_name");
										while ($row = mysqli_fetch_array($result)){
											echo '
											<tr>	
												<td align="center" class="pad">'.++$counter.'</td>
												<td class="pad">'.strtoupper(getLastname($row["user_id"]).' '.getFirstname($row["user_id"])).'</td>
												<td align="center" class="pad">'.$row['first_ca'].'</td>
												<td align="center" class="pad">'.$row['second_ca'].'</td>
												<td align="center" class="pad">'.$row['third_ca'].'</td>
												<td align="center" class="pad">'.$row['exam'].'</td>
												<td class="pad" align="center">'; if ($row["total"] < 39.5) echo '<text style="color:red;">';?><?php echo $row['total'].'</text></td>
												<td class="pad" align="center">'.getGrade($row['total']).'</td>
												<td align="center" class="border">
												<a title="Edit" href="edit_score?'. 'scrid='.encrypt($row['score_id']).'&cid='.encrypt($cid).'&did='.encrypt($did).'&sid='.encrypt($sid).'&tid='.encrypt($tid).'&sesid='.encrypt($session_id).'"><img src="assets/img/edit.png" alt="edit"></a>
												</td>
											</tr>';
										} ?>
										</tbody>				
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
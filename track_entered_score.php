<?php $page_title = "Track Entered Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$tid="";$cid="";$id="";$sid="";$result="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id']; 
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
		$result = mysqli_query($conn,"SELECT *, COUNT(user_id) AS num_of_class_student FROM stdnt_info WHERE sch_id='$sch_id' AND status_id='1' AND class_id='$class_id'");
		$row = mysqli_fetch_assoc($result);
		if ($row['num_of_class_student']!=0){
            header("location: track_entered_score?cid=" . encrypt($class_id) . "&tid=" . encrypt($ctid) ."&sid=" . encrypt($csid));
		} else {
			$msg = 'There are no Students in'.'&nbsp;'.getClass($class_id).'';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
        }
    }
	
if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid'])) {
    $cid = decrypt($_GET['cid']);//Class
	$tid = decrypt($_GET['tid']);//Term
    $sid = decrypt($_GET['sid']);//Session    
	}	
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
		        
			<section class="">
				<div class="container-fluid">
					<div class="card content" style="margin:0px auto;">
						<div class="card-header">
							<h3 class="card-title">Track Entered Score <?php if (isset($_GET['sid'])) { echo '|&nbsp;'.getClass($cid).'&nbsp;'.getTerm($tid).'&nbsp;'.getSession($sid).'&nbsp;'.'ACADEMIC SESSION';}?></h3>
							<div style="margin: 0px auto;"><?php if (isset($msg)) {echo $msg_toastr; } ?>
								<table border="0" align="center" style="border-collapse:collapse; width:40%;">
									<form action="" method="post">
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
											<td width="50">
												<input name="submit" type="submit" value="Track" class="btn btn-primary" style="vertical-align:top; height:34px;">
											</td>
											<td width="50">    
												<input title="Print" type="submit" class="btn btn-primary" name="print" value="PRINT" '+' onClick="javascript:window.print()" style="vertical-align:top; height:34px;">
											</td>
										</tr> 
									</form>
								</table> 
							</div>    
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
							<?php if (!empty($cid)){ 
							echo'
								<thead style="background-color:darkblue;color:white;">
									<tr>
										<th style="width: 10px">#</th>
										<th>Subject</th>
										<th>Type</th>
										<th>Subject Teacher</th>
										<th width="70px">Class</th>
										<th>#Students</th>
										<th>#Entered</th>
										<th><i class="fa fa-award"></i>&nbsp;Progress</th>
										<th><i class="fa fa-calendar"></i>&nbsp;Start date</th>
										<th><i class="fa fa-calendar"></i>&nbsp;End date</th>
									</tr>
								</thead>
								<tbody>';
								}
								$result = mysqli_query($conn,"SELECT DISTINCT * FROM staff_info JOIN subj_info ON subj_info.subj_id=staff_info.subj_id WHERE staff_info.class_id='$cid' AND staff_info.subj_id!=0 GROUP BY staff_info.user_id,staff_info.subj_id,staff_info.cat_id ORDER BY staff_info.user_id,staff_info.subj_id,staff_info.cat_id");
								if($result){
									while($row = mysqli_fetch_array($result)){	
									$subj_id = $row['subj_id']; $cat_id = $row['cat_id'];
									$num_class = getNumStuClass($sch_id, $cid, $cat_id);
									$num_score = getNumScore($sch_id, $cid, $cat_id, $subj_id, $tid, $sid);
									echo '  
									<tr>
										<td>'.++$counter.'</td>
										<td>'.getSubject($subj_id).'</td>
										<td>'.getSubjectType($subj_id).'</td>                     
										<td><a href="'.'staff_details?uid='.encrypt(getSubjectTeacher($sch_id, $cid, $cat_id, $subj_id,'')).'">'. getSubjectTeacher($sch_id, $cid, $cat_id, $subj_id,'name').'</a></td>
										<td><a href="'.'register_student?cid='.encrypt($cid).'&cat='.encrypt($cat_id).'">'.getClass($cid).'&nbsp;'.getCategory($cat_id).'</a></td>
										<td align="center">'.getTotalNumStuPerSubj($sch_id, $cid, $cat_id, $subj_id).'</td>
										<td align="center">'.getNumScore($sch_id, $cid, $cat_id, $subj_id, $tid, $sid).'</td>
										<td align="center"><a href="'.'admin_view_score?cid=' . encrypt($cid) . '&did=' . encrypt($cat_id) . '&sid=' . encrypt($row['subj_id']) . '&tid=' . encrypt($ctid) .'&ses_id=' . encrypt($csid).'">'.getEntryProgress($row["subj_id"], getTotalNumStuPerSubj($sch_id, $row["class_id"], $row["cat_id"], $row["subj_id"]), getNumScore($sch_id, $row["class_id"], $row["cat_id"], $row["subj_id"], $ctid, $csid), $sch_id, $row["class_id"], $row["cat_id"]).'</a></td>
										<td>'.date('d/m/y').'</td>
										<td>'.date('d/m/y').'</td>
									</tr>';
									} 
								} else {
									echo '<script>toastr.error("'.mysqli_error($conn).'")</script>';
								}
								?>  
							  </tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
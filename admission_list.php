<?php $page_title = "Admission List"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id = $cat_id = $did = $cid = $msg = $msg_toastr = "";
	if (isset($_GET['cid']) && isset($_GET['exam_type']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['ses_id'])) {
		$class_id = decrypt($_GET['cid']);
		$subj_id = decrypt($_GET['sid']);
		$term_id = decrypt($_GET['tid']);
		$session_id = decrypt($_GET['ses_id']);
		$exam_type = base64_decode($_GET['exam_type']);
	} else {
//header("location: select_class");
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php include ("include/connection.php"); ?>  
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-2">
								<div class="sticky-top mb-3">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title"><b></b> Statistics</h3>
										</div>
										<div class="card-body">
											<div id="external-events" style="font-size:14px;">
											  <?php
												$color_list = array('0','bg-success','bg-warning','bg-primary','bg-danger','bg-success','bg-warning','bg-primary','bg-danger','bg-info');
												$result = mysqli_query($conn,"SELECT class_id FROM class_info WHERE class_id<$class_limit");
													while($class = mysqli_fetch_array($result)){
														echo '<div class="external-event '.$color_list[$class['class_id']].'">'.getClass($class['class_id']).'-------('.'0'.')'.'</div>';
													}
												?>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">	
										<style> .btn-block{font-size:12px;}</style>
										<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
										<button title="List of Applicants" onclick="location.href='adm_application'"class="btn btn-primary btn-block btn-sm"><i class="fa fa-download"></i> List of Applicants </button>
										
										<button type="button" title="Common Entrance Result" onclick="location.href='com_ent_result?cid=<?php $class_id='1'; $subj_id='31'; echo encrypt($class_id);?>&exam_type=<?php echo base64_encode('Common Entrance');?>&sid=<?php echo encrypt($subj_id);?>&tid=<?php echo encrypt($ctid);?>&ses_id=<?php echo encrypt($csid);?>'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-table"></i> Common Entrance Result </button>
										
										<button title="Set Bench Mark" onclick="location.href='view_score_sheet?cid=<?php echo encrypt($class_id);?>&cat=<?php echo encrypt($cat_id);?>'"class="btn btn-primary btn-block btn-sm"><i class="fa fa-see-saw"></i> Set Bench Mark </button>
										<button title="Admission List (Qualified Candidate Only)" onclick="location.href='view_stdnt_photo?cid=<?php echo encrypt($class_id);?>&cat=<?php echo encrypt($cat_id)?>' "class="btn btn-primary btn-block btn-sm"><i class="fa fa-list"></i> Admission List (Qualified Candidate Only)</button>
										<button title="Admission Letter" onclick="location.href='view_inactive_stu?cid=<?php echo encrypt($class_id);?>&cat=<?php echo encrypt($cat_id)?>'"class="btn btn-primary btn-block btn-sm"><i class="fa fa-file"></i> Admission Letter </button> 
										<button onclick="window.open('stdnt_idcard?cid=<?php echo urlencode(encrypt($class_id));?>&cat=<?php echo urlencode(encrypt($cat_id));?>', '_blank', 'width=800,height=600')" class="btn btn-primary btn-block btn-sm"><i class="fa fa-tag"></i> Print Identity Card </button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="card card-primary">
									<div class="card-body p-0">
										<div class="card-body">
											<table id="example1" class="table table-bordered table-striped" style="font-size:13px;">
									<thead class="custom">
										<tr>
											<th style="width:5%;">S/N</th>
											<th>Appl No.</th>
											<th>Full Name</th>
											
											<th>Class</th>
											<th>Session</th>
											<th>Score</th>
											<th>Remark</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
									$cbt_score = mysqli_query($conn,"SELECT DISTINCT * FROM cand_questions WHERE class_id = '$class_id' AND subj_id = '$subj_id' AND exam_type = '$exam_type' AND sch_id = '$sch_id' GROUP BY user_id ORDER BY cat_id");
										while ($row = mysqli_fetch_array($cbt_score)){
									?>		
										<tr align="center">
											<td><?php echo ++$counter; ?></td>
											<td><?php echo $row["user_id"];?></td>
											<td><?php echo strtoupper(getApplicantName($row["user_id"]));?></td>
											<td><?php echo getClass($class_id).'&nbsp;'.getCategory($row['cat_id']);?></td>
											<td align="center"><?php echo getSession($row['session_id']);?></td>
											<td align="center"><?php echo $row['score'];?></td>
											<td align="center"><?php echo getRemark($row['score']);?></td>
											
										</tr>
<?php } ?>
									</tbody>					
								</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>	
<?php include('include/footer.php');?>
<?php include ("include/page_scripts/datatables.php"); ?> 
</html>
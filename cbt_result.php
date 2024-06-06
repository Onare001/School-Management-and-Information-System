<?php $page_title = "CBT Score"; ?>
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
										<h3 class="card-title"><b><?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></b></h3>
									</div>
									<div class="card-body">
										<div id="external-events" style="font-size:12px;">
											<?php
											$count = mysqli_query($conn, "SELECT DISTINCT *, COUNT(score) AS present FROM cand_questions WHERE sch_id='$sch_id' AND exam_type='$exam_type' AND class_id='$class_id' AND subj_id='$subj_id' AND term_id='$term_id' AND session_id='$session_id' GROUP BY user_id AND subj_id");
											$row = mysqli_fetch_array($count);
											$present = $row['present'];
											?>
											<div class="external-event bg-primary"><i class="fa fa-check"></i> Present: <?php echo $present;?></div>
											<div class="external-event bg-danger"><i class="fa fa-times"></i> Absent: <?php echo  getNumClassFemale($sch_id, $class_id, $cat_id);?></div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">	
										<style> .btn-block{font-size:12px;}</style>
										<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
										
										<button type="button" title="Record Score" onclick="" class="btn btn-primary btn-block btn-sm"><i class="fa fa-percent"></i> Record Score </button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-10">
							<div class="card" style="padding:10px;">
								<table id="example1" class="table table-bordered table-striped" style="font-size:13px;">
									<thead class="custom">
										<tr>
											<th style="width:5%;">S/N</th>
											<th>Full Name</th>
											<th>Student ID</th>
											<th>Subject</th>
											<th>Type</th>
											<th>Class</th>
											<th>Term</th>
											<th>Session</th>
											<th>Score</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$cbt_score = mysqli_query($conn,"SELECT DISTINCT * FROM cand_questions WHERE class_id = '$class_id' AND subj_id = '$subj_id' AND exam_type = '$exam_type' AND sch_id = '$sch_id' GROUP BY user_id ORDER BY cat_id");
										while ($row = mysqli_fetch_array($cbt_score)){
									?>		
										<tr align="center">
											<td><?php echo ++$counter; ?></td>
											<td><?php echo strtoupper(getLastname($row["user_id"])).'&nbsp;'.strtoupper(getFirstname($row["user_id"]));?></td>
											<td><?php echo getUsername($row["user_id"]);?></td>
											<td><?php echo getSubject($row['subj_id']);?></td>
											<td><?php echo $row['exam_type'];?></td>
											<td><?php echo getClass($class_id).'&nbsp;'.getCategory($row['cat_id']);?></td>
											<td align="center"><?php echo getTerm($row['term_id']);?></td>
											<td align="center"><?php echo getSession($row['session_id']);?></td>
											<td align="center"><?php echo $row['score'];?></td>
										</tr>
<?php } ?>
									</tbody>					
								</table>
							</div>
						</div>	
					</div>
				</div>
			</section>			
<?php include('include/footer.php');?>
<?php include ("include/page_scripts/datatables.php"); ?>
<?php include ("include/page_scripts/reducebtn.php"); ?> 
</html>
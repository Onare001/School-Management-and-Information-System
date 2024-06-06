<?php $page_title = "Admission"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
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
									<button title="Admission List (Qualified Candidate Only)" onclick="location.href='admission_list' "class="btn btn-primary btn-block btn-sm"><i class="fa fa-list"></i> Admission List (Qualified Candidate Only)</button>
									<button title="Admission Letter" class="btn btn-primary btn-block btn-sm"><i class="fa fa-file"></i> Admission Letter </button> 
									<button class="btn btn-primary btn-block btn-sm"><i class="fa fa-tag"></i> Print Identity Card </button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-10">
							<div class="card card-primary">
								<div class="card-body p-0">
									<div class="card-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead class="custom">
												<tr>
													<th style="width:12%;">Appl. No</th>
													<th>Full Name</th>
													<th>Gender</th>
													<th>Class</th>
													<th>Profile</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM admission WHERE sch_id = '$sch_id' AND session_id='$csid'");
											if ($result){
												while ($row = mysqli_fetch_array($result)){	
											?>		
												<tr align="center">
													<td><?php echo $row['appl_no']; ?></td>
													<td><?php echo $row['last_name'].'&nbsp;'.$row['first_name'].'&nbsp;'.$row['middle_name'];?></td>
													<td><?php echo getGender($row['sex_id']);?></td>
													<td><?php echo getClass($row['class_id']);?></td>
													<td align="center">
														 
													</td>
													<td align="center">
														 <!--button class="btn btn-primary">Admit</button-->
													</td>
												</tr>
<?php } 
	} else {
		echo 
		'<script>toastr.error("'.mysqli_error($conn).'")</script>';
	}
?>
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
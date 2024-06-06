<?php $page_title = "Staff Task List"; ?>
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
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<h3 class="card-title">Staff Class/Subject Record</h3>
									<a href="register_staff" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary" style="float:right;margin-left:10px;"><i class="fa fa-arrow-left"></i>&nbsp;Back</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th style="width:10px;">S/N</th>
												<th style="width:20px;">Passport</th>
												<th>Staff Name</th>
												<th width="5%">Details</th>
												<th>Subject</th>
												<th>Classes Assigned to</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$result = mysqli_query($conn,"SELECT *, COUNT(user_id) AS num FROM staff_info WHERE sch_id = '$sch_id' GROUP BY user_id HAVING COUNT(user_id) > 0");
										while ($row = mysqli_fetch_array($result)){
										$uid = $row["user_id"]; 

										$result1 = mysqli_query($conn,"SELECT * FROM staff_info WHERE user_id = '$uid' AND subj_id != '0' AND sch_id = '$sch_id' AND class_id !=0 GROUP BY class_id,cat_id ORDER BY class_id,cat_id ASC");//Class && Category

										$result20 = mysqli_query($conn,"SELECT *, COUNT(DISTINCT subj_id) AS num_subj,COUNT(user_id) AS num_class FROM staff_info WHERE user_id = '$uid' AND subj_id != '0' AND sch_id = '$sch_id' AND class_id !=0");//Subject

										$result2 = mysqli_query($conn,"SELECT * FROM staff_info JOIN subj_info ON staff_info.subj_id=subj_info.subj_id WHERE staff_info.user_id = '$uid' AND staff_info.subj_id != '0' AND staff_info.sch_id = '$sch_id' AND staff_info.class_id !=0 GROUP BY staff_info.subj_id ORDER BY subj_info.subj_title ASC");//Subject
										echo '
											<tr>
												<td align="center">'.++$counter.'</td>
												<td align="center"><img src="'.getPassport($row["user_id"]).'" alt="'.getFirstname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/></td>
												<td>'.getLastname($row["user_id"]).' '.getFirstname($row["user_id"]).'</td>
												<td align="center"><a title="Detail" href="staff_details?uid='.encrypt($row["user_id"]).'"><img src="assets/img/info.png" width="16" height="16" alt="img"/></a></td>
												<td align="center">';while ($task2 = mysqli_fetch_array($result20)){
													echo $task2["num_subj"] .'['. $task2["num_class"].']';
												} echo '</td>
												<td>';
												if (mysqli_num_rows($result1) == true){
													while ($task = mysqli_fetch_array($result2)) {
														$subj_id = $task["subj_id"];
														$subjectAbbr = getSubjectAbbr($subj_id);
														$classAndCategory = '';

														$result1 = mysqli_query($conn,"SELECT * FROM staff_info WHERE user_id = '$uid' AND subj_id = '$subj_id' AND sch_id = '$sch_id' AND class_id !=0 GROUP BY class_id,cat_id ORDER BY class_id,cat_id ASC");// code to retrieve data from $result1 table
														
														while ($row = mysqli_fetch_array($result1)) {
															$class_id = $row["class_id"]; 
															$cat_id = $row["cat_id"];
															$class = getClass($class_id);
															$category = getCategory($cat_id);
															
															$classAndCategory .= $class . '&nbsp;' . $category . ', ';
														}
														echo '<b>'.$subjectAbbr.'</b>'. '[' . rtrim($classAndCategory, ', ') . '], ';
													}
												} else {
													echo '<font color="red">No Class/Subject Allocated</font>';
												} echo '</td>
											</tr>';
											} ?>               
										</tbody>
										<tfoot>
											<tr>
											<th style="width:10px;">S/N</th>
											<th style="width:20px;">Passport</th>
											<th>Staff Name</th>
											<th>Details</th>
											<th>Subject</th>
											<th>Classes Assigned to</th>
											</tr>
										</tfoot>
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
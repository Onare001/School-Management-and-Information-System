<?php $page_title = "Staff Record"; ?>
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
									<h3 class="card-title">Staff Record</h3>
									<a href="register_staff" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary" style="float:right;margin-left:10px;"><i class="fa fa-arrow-left"></i>&nbsp;Back</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Staff Name</th>
												<th>Gender</th>
												<th>Category</th>
												<th>Dept</th>
												<th>Marital<br>Status</th>
												<th>DOB</th>
												<th>State</th>
												<th>LGA</th>
												<th>Contact</th>
												<th>Address</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT DISTINCT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.sch_id='$sch_id' AND sch_users.priv_id>1 GROUP BY staff_info.user_id ORDER BY sch_users.last_name ASC");
											if($result){
											while ($row = mysqli_fetch_array($result)){
										echo '<tr>
												<td  align="center">'.++$counter.'</td>
												<td>'.getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']).'</td>
												<td>'.getGender($row["sex_id"]).'</td>
												<td>'.getStafftype($row["type_id"]).'</td>
												<td>'.getDept($row["dept_id"]).'</td>
												<td>'.getMaritalstatus($row["status_id"]).'</td>
												<td>';echo ($row["dob"] != '0000-00-00') ? date("jS M, Y", strtotime($dob = $row["dob"])) : ''; 		echo '</td>
												<td>'.getState($row["state_id"]).'</td>
												<td>'.getLGA($row["lga"]).'</td>
												<td>'.$row["phone_no"].'</td>
												<td>'.$row["address"].'</td>
											</tr>'; } 
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
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
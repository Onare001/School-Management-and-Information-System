<?php $page_title = "Staff Account Details"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
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
									<h3 class="card-title">Staff Account Details</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th>SN</th>
											<th>File No.</th>
											<th>Full Name</th>
											<th>Category</th>
											<th>Role</th>
											<th>Account No.</th>
											<th>Bank</th>
											<th>Phone No.</th>
										</thead>
										<tbody>
<?php
$result = mysqli_query($conn,"SELECT DISTINCT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.sch_id='$sch_id' AND sch_users.priv_id>1 GROUP BY staff_info.user_id ORDER BY sch_users.last_name ASC");
while ($row = mysqli_fetch_array($result)){
?>	
											<tr>
												<td align="center"><?php echo ++$counter; ?></td>
												<td><?php echo $row['file_no']; ?></td>
												<td><?php echo getLastname($row['user_id']).' '.getFirstname($row['user_id']);?></td>
												<td><?php echo getStaffType($row['type_id']); ?></td>
												<td><?php echo getPriviledge($row['priv_id']); ?></td>
												<td><?php echo $row['acc_no']; ?></td>
												<td><?php echo getBank($row['bank_id']); ?></td>
												<td><?php echo $row['phone_no']; ?></td>
											</tr>
<?php } ?>               
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
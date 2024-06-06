<?php $page_title = "Report Log"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
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
									<h3 class="card-title">Report Log</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Full Name</th>
												<th>School</th>
												<th>Sch Code</th>
												<th>Report</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM report_log");
											while ($row = mysqli_fetch_array($result)){				
											?>	
											<tr>
												<td><?php echo ++$counter; ?></td>
												<td><?php echo getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']);?></td>
												<td><?php echo getSchname($row["sch_id"]); ?></td>
												<td><?php echo $row["sch_id"]; ?></td>
												<td><?php echo $row["report"]; ?></td>
												<td><?php echo $row["status"];?></td>
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
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
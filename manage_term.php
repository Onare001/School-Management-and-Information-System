<?php $page_title = "Basic Settings"; ?>
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
									<h3 class="card-title">Manage Term</h3>
									<div style="float:right;">
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
									<a href="manage_term" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-tag">&nbsp;&nbsp;</i> Manage Term </div></a>

									<a href="manage_session" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-clock">&nbsp;&nbsp;</i> Manage Session</div></a>

									<a href="manage_year" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-calendar">&nbsp;&nbsp;</i> Manage Year</div></a>
									</div>
								</div>
								<div class="card-body">
									<center>
									<table id="example1" class="table table-bordered table-striped" style="width:70%">
										<thead>
											<th>S/N</th>
											<th>Term</th>
											<th>Status</th>
											<th>Activate</th>
											<th>Activate</th>
										</thead>
										<tbody>					
										<?php
										$counter = "0";
										$result = mysqli_query($conn,"SELECT * FROM term_info");
										while ($row = mysqli_fetch_array($result)){
										?>
											<tr> 
												<td align="center" width="5px"><?php echo ++$counter;?></td>
												<td><?php echo $row["term_title"];?></td>
												<td id="status-<?php echo $row['term_id']; ?>" style="text-decoration:none;color:#007bff;"><?php echo ($row["status"]=='1') ? 'Active' : 'Inactive';?></td>
												<td align="center" width="5px"><?php echo ($row['status']=='1') ? '<a href="deactivate.php?tid='.$row['term_id'].'"><img src="assets/img/tick.png" alt="active"></a>' : '<a href="activate.php?tid='.$row['term_id'].'"><img src="assets/img/drop.png" alt="inactive"></a>'; ?></td>
												<td align="center" width="5px">
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="customSwitch<?php echo $row['term_id']; ?>" <?php echo ($row['status'] == '1') ? 'checked' : ''; ?> data-tid="<?php echo $row['term_id']; ?>" data-state="<?php echo ($row['status'] == '1') ? '1' : '0'; ?>" data-table="term_info">
														<label class="custom-control-label" for="customSwitch<?php echo $row['term_id']; ?>"></label>
													</div>
												</td>
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
<?php include ('include/ajax/switcher.php');?>
</html>
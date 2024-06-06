<?php $page_title = "Attempted Payment"; ?>
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
									<h3 class="card-title" style="color:red;">Click Requery if Payer was debited and payment was not submitted to the School</b></h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:5px;align:center">S/N</th>
											<th style="width:20px;">Student Name</th>
											<th style="width:30px;">Reference</th>
											<th style="width:20px;">Amount</th>
											<th style="width:10px;">Payment Type</th>
											<th style="width:10px;">Status</th>
											<th style="width:5px;">Action</th>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM attempted_payment WHERE sch_id='$sch_id' AND online_status!='2' ORDER BY trial_id DESC");
												while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"];
											
											if ($row['online_status'] == 1){
												$paymentstatus = '<span class="badge bg-danger">Pending</span>';
											} else if ($row['online_status']  == 2){
												$paymentstatus = '<span class="badge bg-warning">Successful</span>';
											} else if ($row['online_status']  == 3){
												$paymentstatus = '<span class="badge bg-warning">Abandoned</span>';
											} else {
												$paymentstatus = '<span class="badge bg-danger">Undefined</span>';
											}
											?>  
											<tr>
												<td width="5%"><?php echo ++$counter; ?></td>
												<td width="20%"><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
												<td width="15%"><?php echo $row['reference'];?></td>
												<td width="5%"><?php echo '&#8358;'. number_format($row['amount']);?></td>
												<td width="15%"><?php echo getPaymentType($row['payment_type']);?></td>
												<td width="5%"><?php echo $paymentstatus;?></td>
												<td class="border" align="center" width="12%">
													<a title="Requery" href="verify_payment?reference=<?php echo $row['reference'];?>&uid=<?php echo encrypt($uid); ?>&pt=<?php echo encrypt($row['payment_type']);?>"><button id="buttonn" class="btn btn-primary"><i class="fa fa-reload"></i> Requery </button></a>
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
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
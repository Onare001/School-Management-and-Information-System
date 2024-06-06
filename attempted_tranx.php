<?php $page_title = "Attempted Payment"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$uid="";
if(isset($_GET['uid'])){
	$uid = decrypt($_GET['uid']);
	$pt = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
					<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
					<button onclick="location.href='pay_sch_fee2?uid=<?php echo encrypt($uid);?>&pt=<?php echo encrypt($pt);?>'"id="buttonn" class="btn btn-primary"><i class="fa fa-credit-card">&nbsp;&nbsp;</i> Pay Fees  </button>
					<button onclick="location.href='stu_payment_history?<?php echo 'uid='.encrypt($uid);?>'"id="buttonn" class="btn btn-success"><i class="fa fa-clock"></i> Payment History </button>
					<button onclick="location.href='stu_payment_log?uid=<?php echo encrypt($uid);?>'"id="buttonn" class="btn btn-primary"><i class="fa fa-server"></i> Payment Log </button>
					<button onclick="location.href='attempted_tranx?uid=<?php echo encrypt($uid);?>'"id="buttonn" class="btn btn-danger"><i class="fa fa-cancel"></i> Attempted Transaction(s) </button>
				</div>
			</div>  
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-cancel">&nbsp;&nbsp;</i>Attempted Transactions | <?php echo getLastname($uid).' '.getFirstname($uid);?><p></h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search"/>
								<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<tr>
									<td colspan="6"><span style="color:red;">Click Requery if Payer was debited and payment was not submitted to the School</span></td>
								</tr>
								<th>#SN</th> 
								<th>Reason</th>
								<th>Transaction No.</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Requery</th>
							</thead>
							<tbody>							
							<?php
							$result = mysqli_query($conn,"SELECT * FROM attempted_payment WHERE sch_id='$sch_id' AND online_status!='2' AND user_id='$uid' ORDER BY trial_id DESC");
							while ($row = mysqli_fetch_array($result)){
								/*$date = $row["date_paid"];
								$term_id = $row["term_id"];
								$sid = $row["sid"];
								$teller_no = $row["receipt_no"];
								$class_id = $row["class_id"];
								$cat_id = $row["cat_id"];
								$payment_status = $row["payment_status"];
								$payment_type = $row["payment_type"];
								$payment_id = $row["payment_id"];
								$balance = $row["balance"];*/
								
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
								<td width="15%"><?php echo getPaymentType($row['payment_type']);?></td>
								<td width="5%"><?php echo $row['reference'];?></td>
								<td width="5%"><?php echo '&#8358;'. number_format($row['amount']);?></td>
								<td width="5%"><?php echo $paymentstatus;?></td>
								<td width="12%">
									<a title="Requery" href="verify_payment?reference=<?php echo $row['reference'];?>&uid=<?php echo encrypt($uid); ?>&pt=<?php echo encrypt($row['payment_type']);?>"><button id="button" class="btn btn-primary"><i class="fa fa-reload"></i> Requery </button></a>
								</td>
								
							</tr>
			<?php } ?>		
							</tbody>
						</table>
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
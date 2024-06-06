<?php $page_title = "Account Details"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
   
			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="pay_sch_fee" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
					<a href="account_details" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-info-circle">&nbsp;&nbsp;</i> Account Details </div></a>
					<a href="payment_history" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-history">&nbsp;&nbsp;</i> Payment History </div></a><p>
				</div>
			</div><p>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-info-circle">&nbsp;&nbsp;</i>School Account Details</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append">
									<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>#SN</th>
									<th>Payment Type</th>
									<th>Amount</th>
									<th>Account Number</th>
									<th>Account Name</th>
									<th>Bank</th>
								</tr>
							</thead>
							<tbody>	
							<?php
							$sql = "SELECT * FROM account_details JOIN payment_type ON account_details.payment_id = payment_type.payment_id WHERE account_details.sch_id = '$sch_id' AND payment_type.status = '1'";
							$result = mysqli_query($conn,$sql);
							while ($row = mysqli_fetch_array($result)){
							$payment_id = $row["payment_id"];
							$acc_no = $row["acc_no"];
							$acc_name = $row["acc_name"];
							$bank_id = $row["bank_id"];
							?>	
								<tr>
									<td align="center"><?php echo ++$counter;?></td>
									<td><?php echo getPaymenttype($payment_id);?></td>
									<td><?php echo '&#8358;'.number_format(getAmount($payment_id));?></td>
									<td><?php echo $acc_no;?></td>
									<td><?php echo $acc_name;?></td>
									<td><?php echo getBank($bank_id);?></td>
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
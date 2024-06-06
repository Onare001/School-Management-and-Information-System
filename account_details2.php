<?php $page_title = "Payment Info"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_POST['submit'])) {
	$payment_type = addslashes($_POST["payment_id"]);
	$acc_no = addslashes($_POST["acc_no"]);
	$acc_name = addslashes($_POST["acc_name"]);
	$bank_id = addslashes($_POST["bank_id"]);
	if (empty($payment_type)) {
		$msg = 'Please Select Payment type';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($acc_no)) {
		$msg = 'Please Enter Account Number';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($acc_name)) {
		$msg = 'Please Enter Account Name';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($bank_id)){
		$msg = 'Please Select a Bank';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		//Check if Payment already exist
		$sql0 = "SELECT * FROM account_details WHERE sch_id='$sch_id' AND payment_id='$payment_type'";
		$result = mysqli_query($conn,$sql0);

		if (mysqli_num_rows($result) == true) {
			$msg = 'This Entry already Exist';
		} else {
			//Insert Payment Info
			$pay_info = "INSERT INTO account_details (sch_id, acc_no, acc_name, bank_id, payment_id) VALUES ('$sch_id', '$acc_no', '$acc_name', '$bank_id', '$payment_type')";
			$result = mysqli_query($conn,$pay_info);

		//Fedback if Successfully Submitted			
			if ($result == true) {
				$msg = 'Payment Type Added Successfully';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Error: " . $pay_info . ":-" . mysqli_error($conn);
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
}		
?>
 
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
  
			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
					<a href="payment_type" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-square">&nbsp;&nbsp;</i>Purpose of Payments</div></a>
					<a href="account_details2.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-info-circle">&nbsp;&nbsp;</i> Account Details </div></a><p>
				</div>
			</div>
			<?php if (isset($msg)) { $msg_toastr; } ?>
			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
					<form action="" method="post">
						<table border="0" align="center" style="border-collapse:collapse; width:100%;">
							<tr>
								<td>
									<select name="payment_id"  id="payment-dropdown" class="form-control" required>
										<option value=""> Select Payment Type</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id = '$sch_id'");
										while ($row = mysqli_fetch_array($result)){ ?>
										<option value="<?php echo $row["payment_id"];?>"><?php echo $row["payment_type"];?></option>
										<?php } ?>
									</select>
								</td>
								<td><select name="amount" id="amount-dropdown" class="form-control" disabled></select></td> 
								<td><input name="acc_no" type="text" placeholder="Account Number" maxlength="10" class="form-control" required/></td>
								<td><input name="acc_name" type="text" placeholder="Account Name" class="form-control" required></td>
								<td>
									<select name="bank_id"  placeholder="Bank" class="form-control" required>
										<option value="">Bank</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM bank_info");
										while ($row = mysqli_fetch_array($result)){ ?>
										<option value="<?php echo $row["bank_id"];?>"><?php echo $row["bank"];?></option>
										<?php } ?>
									</select>
								</td>
								<td><input name="submit" type="submit" value="Add" class="btn btn-primary" style="vertical-align:top; height:34px;"/></td>
							</tr>
						</table>
					</form><p>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
					<h3 class="card-title"><i class="fa fa-info-circle">&nbsp;&nbsp;</i>School Account Details</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#SN</th>
									<th>Payment Type</th>
									<th>Amount</th>
									<th>Account Number</th>
									<th>Account Name</th>
									<th>Bank</th>
									<th>Edit</th>
									<th>Status</th>
								</tr>
							</thead>	
							<?php
							$sql = "SELECT * FROM account_details JOIN payment_type ON account_details.payment_id = payment_type.payment_id WHERE account_details.sch_id = '$sch_id'";
							$result = mysqli_query($conn,$sql);
							while ($row = mysqli_fetch_array($result)){
							$payment_id = $row["payment_id"];
							$acc_no = $row["acc_no"];
							$acc_name = $row["acc_name"];
							$bank_id = $row["bank_id"];
							?>
							<tbody>
								<tr>
								  <td><?php echo ++$counter;?></td>
								  <td><?php echo getPaymenttype($payment_id);?></td>
								  <td><?php echo '&#8358;'.number_format(getAmount($payment_id));?></td>
								  <td><?php echo $acc_no;?></td>
								  <td><?php echo $acc_name;?></td>
								  <td><?php echo getBank($bank_id);?></td>
								  <td><a href="#"><img src="assets/img/edit.png"/><a></td>
								  <td align="center"><?php if ($row["status"]== 1) {
										echo '<img src="assets/img/tick.png" alt="active"/>';
									  } 
									else { 
										echo '<img src="assets/img/drop.png" alt="inactive">';
								} ?></td>
								</tr>
							</tbody>
							<?php } ?>					
						</table>
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/ajax/process_amount.php');?>
<?php include('include/options.php');?>
</html>
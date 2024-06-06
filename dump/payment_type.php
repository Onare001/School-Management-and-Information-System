<?php $page_title = "Purpose of Payments"; ?>
<?php include ("include/connection.php"); ?>
<?php include ("include/lock_staff.php"); ?>
<?php include ("functions/functions.php"); ?>
<?php
if (isset($_POST['submit'])) {
	$payment_type = addslashes($_POST["payment_type"]);
	$amount = addslashes($_POST["amount"]);
	if (empty($payment_type)) {
		$msg = 'Please enter Payment type';
	} else if (empty($amount)) {
		$msg = 'Enter an Amount to be Paid';
	} else {
		//Check if Payment already exist
		$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id' AND payment_type='$payment_type'");
		if (mysqli_num_rows($result) == true) {
			$msg = 'This Entry already Exist';
		} else {
			//Insert Payment Type
			$result = mysqli_query($conn,"INSERT INTO payment_type (sch_id, payment_type, amount) VALUES ('$sch_id', '$payment_type', '$amount')");
			//Fedback if Successfully Submitted			
			if ($result == true) {
				$msg = "Purpose of Payment Submitted Successfully";
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Something went wrong";
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
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
				<a href="payment_type" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-square">&nbsp;&nbsp;</i> Purpose of Payments </div></a>
				<a href="account_details2" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-info-circle">&nbsp;&nbsp;</i> Account Details </div></a><p>
				</div>
			</div>
			<?php if (isset($msg_toastr)) { echo $msg_toastr;} ?>
			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
				<form action="" method="post">
					<table border="0" align="center" style="border-collapse:collapse; width:95%;margin-left:30px;">
						<tr>
							<td><input name="payment_type" type="text" placeholder="Payment Type" class="form-control" required></td>  
							<td><input name="amount" type="text" placeholder="Amount E.g  25000 Without Comma, Unit or Spaces" class="form-control" required></td>  
							<td><input name="submit" type="submit" value="Add" class="btn btn-primary"></td>
						</tr>
					</table>
				</form>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-info-circle">&nbsp;&nbsp;</i>Purpose of Payments</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width:150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<th>#SN</th>
								<th>Payment Type</th>
								<th>Amount</th>
								<th>Edit</th>
								<th>Status</th>
								<th align="center">Action</th>
							</thead>			
						<?php
						$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id = '$sch_id'");
						while ($row = mysqli_fetch_array($result)){
						$payment_id = $row["payment_id"];
						?>		
						<tr>
							<td><?php echo ++$counter;?></td>
							<td><?php echo getPaymenttype($payment_id);?></td>
							<td><?php echo '&#8358;'.number_format(getAmount($payment_id));?></td>
							<td><a href="#"><img src="assets/img/edit.png"/><a></td>
							<td><a style="text-decoration:none;" href="#"><?php if ($row["status"]=='1') echo "Active"; else echo "Inactive"; ?><a></td>
							<td><a style="text-decoration:none;" <?php if ($row["status"]=='1') echo "<a href=deactivate.php?pid=".$row['payment_id']."><img src=assets/img/tick.png alt=active></a>"; 
							else echo "<a href=activate.php?pid=".$row['payment_id']."><img src=assets/img/drop.png alt=active></a>"; ?></td>
						</tr>
						<?php } ?>					
						</table>
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include('include/page_scripts/options.php');?>
</html>
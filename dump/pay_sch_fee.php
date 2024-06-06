<?php $page_title = "Pay School Charges"; ?>
<?php include ("include/connection.php"); ?>
<?php include ("include/lock_student.php"); ?>
<?php include ("functions/functions.php"); ?>
<?php
$sql = "SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$user_id' AND stdnt_info.user_id='$user_id'";
$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	$class_id = $row["class_id"];
	$cat_id = $row["cat_id"];
	$username = $row["username"];
	$uid = $user_id;
?>
<?php
/*include "include/connection.php";
if (isset($_POST['submit'])) {
	$sch_id = addslashes($_POST['sch_id']);
	$payment_type = addslashes($_POST["payment_type"]);
	$teller_no = addslashes($_POST["teller_no"]);
	$amount = getAmount($payment_type);
	$date = date('h:i:s A d'.'-'.'m'.'-'.'Y');
	$tranx_id = (rand(100000,999999).$username);
	$term_id = addslashes($_POST["term_id"]);
	$session_id = addslashes($_POST["session_id"]);
	if (empty($payment_type)) {
		$msg = 'Payment type is required';
	} else if (empty($teller_no)) {
		$msg = 'Enter your teller Number';
	} else if (empty($term_id)) {
		$msg = 'Select Term';
	} else if (empty($session_id)) {
		$msg = 'Select Session';
	} else {
		//Check if Payment already exist
$sql0 = "SELECT * FROM ledger_info WHERE user_id='$user_id' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'";
$result = $conn->query($sql0);

if (mysqli_num_rows($result) == true) {
	$msg = 'You have already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!';
} else {
	//Insert Payment Info
	$pay = "INSERT INTO ledger_info (sch_id, transaction_id, payment_type, amount_paid, date_paid, receipt_no, user_id, class_id, cat_id, term_id, sid) VALUES ('$sch_id', '$tranx_id', '$payment_type', '$amount', '$date', '$teller_no', '$user_id', '$class_id', '$cat_id', '$term_id', '$session_id')";
	$result = mysqli_query($conn,$pay);
	
	//Payment Status
	$pstatus = "UPDATE ledger_info SET payment_status = '1' WHERE user_id = '$user_id' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'";
	$result = mysqli_query($conn,$pstatus);

//Fedback if Successfully Submitted			
	if ($result == true) {
		echo ('<script>alert("Payment Submitted wait for Verification")</script>');
	} else {
		echo "Error: " . $pay . ":-" . mysqli_error($conn);
	} mysqli_close($conn);
		header("location: payment_history.php");
}
}
}*/		
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
       
	  
		   <div class="card card-primary" id="selectbox">
				<div class="card-header"><h3 class="card-title">&nbsp;&nbsp;<i class="fa fa-credit-card"></i>&nbsp;Pay School Charges</h3></div>
				<center style="color:red;margin:1px auto;"><?php if (isset($msg)) { ?><p class="error"><?php echo $msg;?></p><?php } ?></center>
				<span id="feedback"></span>
				<form action="" id="paymentForm" method="post" autocomplete="off">
				<?php if (1==0){?>
					<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">	
						<div class="col-md-12" style="margin:5px auto;width:95%;">
							<input type="text" value="<?php echo getFirstname($user_id).'&nbsp;'.getLastname($user_id);?>" class="form-control" disabled/>
							<input type="hidden" id="email-address" value="<?php echo $email;?>" />
							<input type="hidden" id="first-name" value="<?php echo getFirstname($uid);?>"/>
							<input type="hidden" id="last-name"value="<?php echo getLastname($uid);?>"/>
						</div>
						<tr>
							<td>
								<div class="col-md-12">    
									<select name="payment_type" id="payment-dropdown" class="form-control" required>
										<option value="">Purpose of Payment</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE status = '1'");
										while ($row = mysqli_fetch_array($result)){ 
										echo '<option value="'.$row["payment_id"].'">'.$row["payment_type"].'</option>';
										} ?>
									</select>
								</div>  
							</td>
							<td width="50%">
								<div class="col-md-12"> 
									<select name="amount" id="amount-dropdown" class="form-control" disabled></select> 
								</div>
							</td>
						</tr>
						<tr>
							<td align="left">
								<div class="col-md-12">
									<input  type="text" name="teller_no" placeholder="Enter Receipt Number E.g 3XXXX8" id="reference" value="<?php echo 'SMS-'.(rand(100,999).'-'.rand(100,999).'-'.rand(100,999));?>" maxlength="15" class="form-control" required disabled/>
								</div>
							</td>
							<td align="left">
								<div class="col-md-12">
									<input type="text" name="amount_paid" id="amount" placeholder="Enter Amount" class="form-control" placeholder="Enter Avaliable Amount to be Paid Without comma or Spaces"onkeyup="formatMoney(event)" max="1000" required/>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="col-md-12">    
									<select name="term_id" id="term" class="form-control" required>
										<option value=""> Select Term</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
										while ($row = mysqli_fetch_array($result)){ 
										echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
										} ?>
									</select>
								</div>  
							</td>
							<td>
								<div class="col-md-12">      
									<select name="session_id" id="session" class="form-control" required>
										<option value="">Select Session</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
										while ($row = mysqli_fetch_array($result)){ echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>';
										} ?>
									</select>
								</div> 
							</td>
						</tr>	
					</table>
				<?php } else {
		   	 echo '<center>This Service is not made available to you</center>';
		}?>

					<div class="modal-footer">
						<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
						<button type="reset" id="buttonn" class="btn btn-danger"><i class="fa fa-history"></i> Reset </button>
						<button onclick="location.href='stu_payment_history?<?php echo 'uid='.encrypt($uid);?>'"id="buttonn" class="btn btn-success"><i class="fa fa-clock"></i> History </button>
						<button type="submit" name="submit" onclick="payWithPaystack()" class="btn btn-primary"><i class="fa fa-credit-card"></i> Pay</button>
						 <span style="margin:0 auto"><img src="assets/img/398x60xremita-payment-logo-horizonal.png.pagespeed.ic.qovZ9TFzVk.webp" width="398" height="60" alt="" data-pagespeed-url-hash="1293401689" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span>            
					</div>
				</form>
			</div>
	   
			
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php //include ('include/page_scripts/payment_gateway.php');?>
</html>
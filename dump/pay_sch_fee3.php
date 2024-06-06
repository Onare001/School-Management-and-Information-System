<?php $page_title = "Pay Outstanding School Charges"; ?>
<?php include ("include/connection.php"); ?>
<?php include ("include/lock_staff.php"); ?>
<?php include ("functions/functions.php"); ?>
<?php
$uid=""; $pt="";
if (isset($_GET['uid'])){
	$uid = decrypt($_GET['uid']);
	#$pt = decrypt($_GET['pt']);
	$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND stdnt_info.user_id='$uid'");
	$row = mysqli_fetch_array($result);
	$class_id = $row["class_id"];
	$cat_id = $row["cat_id"];
	$username = $row["username"];
	} else {
		#header("location: class_payment_record.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		$payment_type = addslashes($_POST["payment_type"]);
		$teller_no = addslashes($_POST["teller_no"]);
		$amount = getAmount($payment_type);
		$amount_paid = addslashes($_POST["amount_paid"]);
		$balance = $amount - $amount_paid;
		$date = date('h:i:s A d'.'-'.'m'.'-'.'Y');
		$tranx_id = '0'.(rand(00001,99999).$username);
		$term_id = addslashes($_POST["term_id"]);
		$session_id = addslashes($_POST["session_id"]);
		
		//Verifying Receipt Number
		$result1 = mysqli_query($conn,"SELECT receipt_no FROM ledger_info WHERE receipt_no='$teller_no'");
		$row = mysqli_fetch_assoc($result1); $receipt_no = $row['receipt_no'];
		
		if (empty($payment_type)) {
			$msg = 'Payment type is required';
		} else if (empty($teller_no)) {
			$msg = 'Enter your teller Number';
		} else if (empty($amount_paid)) {
			$msg = 'Enter Availiable Amount to be Paid';
		} else if ($amount_paid > $amount) {
			$msg = 'You cannot Pay More than'.'&nbsp;'.'&#8358;'.$amount;
		} else if (mysqli_num_rows($result1) == true) {
			$msg = 'Receipt No. Already Exist';
		} else if (empty($term_id)) {
			$msg = 'Select Term';
		} else if (empty($session_id)) {
			$msg = 'Select Session';
		} else {
		//Check if Payment already exist
		$result_check = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'");
		$row =  mysqli_fetch_assoc($result_check);
		$bal = $row['balance'];

	if ((mysqli_num_rows($result_check) == false)) {
		//Insert New Payment if Payment do not Exist
		$new_payment = mysqli_query($conn,"INSERT INTO ledger_info (sch_id, transaction_id, payment_type, amount, amount_paid,balance, date_paid, receipt_no, user_id, class_id, cat_id, term_id, sid) VALUES ('$sch_id', '$tranx_id', '$payment_type', '$amount', '$amount_paid', '$balance', '$date', '$teller_no', '$uid', '$class_id', '$cat_id', '$term_id', '$session_id')");
		
		//Getting Balance info...
		$get_balance = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'");
		$row =  mysqli_fetch_assoc($get_balance);
		$balance = $row['balance'];
		
		//Payment Status
		if($balance != 0) {
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '1' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'"); #Remaining
		} else if ($balance == 0) {
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '3' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'");#No Outstanding Payment
		}

	//Feedback if Successfully Submitted			
		if ($new_payment == true) {
			echo ('<script>alert("Payment Successful")</script>');
		} else {
			echo "Error: " . $new_payment . ":-" . mysqli_error($conn);
		} mysqli_close($conn);
			#header("location: class_payment_record.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");

		
	} else if ((mysqli_num_rows($result_check) == true)) {
		if ($bal != 0){
			if ($amount_paid <= $bal){
			
		//Updating Existing Payment Info, Balance Payment
		$pay_balance = mysqli_query($conn,"UPDATE `ledger_info` SET `amount_paid` = amount_paid + $amount_paid, `balance` = balance - $amount_paid WHERE `ledger_info`.`user_id` = '$uid' AND `ledger_info`.`payment_type` = '$payment_type'");//AND `ledger_info`.`receipt_no` = '$teller_no'
		} else {
			$pay_balance = "";
			$msg = 'You cannot pay more than'.'&nbsp;'.'&#8358;'.$bal.'(Balance)';
			}
		} else {
			$pay_balance = "";
			$msg = getFirstname($uid).'&nbsp;'.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!';
		}
		
		
		//Getting Balance info...
		$get_balance = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'");
		$row =  mysqli_fetch_assoc($get_balance);
		$balance = $row['balance'];
		
		//Payment Status
		if($balance != 0) {
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '1' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'"); #Remaining
		} else if ($balance == 0) {
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '3' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'");#No Outstanding Payment
		}
		
		//Feedback if Successfully Updated			
		if ($pay_balance == true) {
			echo ('<script>alert("Payment Successful")</script>');
		} else {
			echo "Error: " . $pay_balance . ":-" . mysqli_error($conn);
		} mysqli_close($conn);
			#header("location: class_payment_record.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");

		} else if ((mysqli_num_rows($result) == true)&&($bal == 0)){
			$msg = getFirstname($uid).'&nbsp;'.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!';
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
			<a href="acc_graduated_student" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>

			<a href="stu_payment_history.php?uid=<?php echo encrypt($uid);?>" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-history">&nbsp;&nbsp;</i> Payment History </div></a>
		</div>
</div><p>
		     
<!-- general form elements -->
<div class="card card-primary" id="selectbox">
  <div class="card-header">
	<h3 class="card-title">&nbsp;&nbsp;&nbsp;<i class="fa fa-credit-card"></i>&nbsp; Pay Outstanding School Charges for Graduated Student</h3>
  </div>
     <!--Error-->
<center style="color:red;"><?php if (isset($msg)) { ?><p class="error"><?php echo $msg;?></p><?php } ?></center>
		<form action="" method="post">	   
			<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
				<tr>
					<td>
						<div class="col-md-12">    
							<select name="payment_type" id="payment-dropdown" class="form-control" required>
								<option value="">Purpose of Payment</option>
								<!--Option Content-->
								<?php
								$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id'");
								while ($row = mysqli_fetch_array($result)){ ?>
								<option value="<?php echo $row["payment_id"];?>"><?php echo $row["payment_type"];?></option>
								<?php }	?>
							</select>
						</div>  
					</td>
				</tr>
	
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<select name="amount" id="amount-dropdown" class="form-control" disabled>
							</select> 
						</div>
					</td>
				</tr>
	
				<tr>
					<td align="left">
						<div class="col-md-12">
							<input name="student_name" type="text" placeholder="Student' Name" value="<?php echo getFirstname($uid).'&nbsp;'.getLastname($uid);?>" maxlength="13" class="form-control" disabled>
						</div>
					</td>
				</tr>

				<tr>
					<td align="left">
						<div class="col-md-12">
							<input name="teller_no" type="text" placeholder="Enter Receipt Number E.g 3XXXX8" maxlength="5" class="form-control" required>
						</div>
					</td>
				</tr>
  
				<tr>
					<td align="left">
						<div class="col-md-12">
							<input name="amount_paid" type="text" placeholder="Enter Avaliable Amount to be Paid Without comma or Spaces" class="form-control" required>
						</div>
					</td>
				</tr>
  
				<tr>
					<td>
						<div class="col-md-12">    
							<select name="term_id" class="form-control">
								<option value=""> Select Term</option>
								<!--Option Content-->
								<?php
								$result = mysqli_query($conn,"SELECT * FROM term_info");
								while ($row = mysqli_fetch_array($result)){ ?>
								<option value="<?php echo $row["term_id"];?>"><?php echo $row["term_title"];?></option>
								<?php } ?>
							</select>
						</div>  
					</td>
				</tr>

				<tr>
					<td>
						<div class="col-md-12">      
							<select name="session_id" class="form-control">
								<option value="">Select Session</option>
								<!--Option Content-->
								<?php
								$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done = '1'");
								while ($row = mysqli_fetch_array($result)){ $sid = $row["sid"];?>
								<option value="<?php echo $sid ;?>"><?php echo getSession($sid);?></option>
								<?php }	?>
							</select>
						</div> 
					</td>
				</tr>

				<tr>
					<td align="right">
						<div class="col-md-12">&nbsp;
							<input name="submit" type="submit" value="Submit Payment" class="btn btn-primary">
						</div>
					</td> 
				</tr>
			</table>	
		</form>
</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
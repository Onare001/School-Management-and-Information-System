<?php $page_title = "Verify Payment"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$last_name=$first_name=$message=$online_status=$online_amount=$ref=$referrer=$paid_at=$channel=$payment_type=$feedback="";
if (isset($_GET['reference'])&& isset($_GET['uid'])){
	$reference = $_GET['reference'];
	$uid = decrypt($_GET['uid']);
	$secret_key = getSchSecretKey($sch_id);
} else {
	header("location:javascript://history.go(-1)");
}

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($reference),
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
  "Authorization: Bearer sk_test_303578a5dc6943e3b3ed1e710713f9e581cca959",#$secret_key
  "Cache-Control: no-cache",
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	$msg = "cURL Error #:" . $err;
	$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
} else {
	$result = json_decode($response);
	//echo $response;
	if (isset($result->data)) {
	  // Access the data property if it exists
	  $feedback = $result->data->status;
	} else {
	  // Handle the case where the data property is undefined
	  $feedback = null;
	}
}

if($feedback == 'success'){
	$online_status = '<span class="badge bg-success" style="font-size:16px;">'.$result->data->status.'</span>';
	$online_amount = $result->data->currency.number_format($result->data->amount/100);
	$ref = $result->data->reference;
	$message = $result->data->message;
	$paid_at = $result->data->paid_at;
	$channel = $result->data->channel;
	$referrer = $result->data->metadata->referrer;
	$first_name = $result->data->customer->first_name;
	$last_name = $result->data->customer->last_name;

	//Verifying Reference Number
	$check_reference = mysqli_query($conn,"SELECT * FROM payment_log WHERE transaction_id='$reference'");
	$row = mysqli_fetch_assoc($check_reference); 
	
	//Values to copy
	$transfer_record = mysqli_query($conn,"SELECT * FROM attempted_payment WHERE reference='$reference'");
	$row = mysqli_fetch_assoc($transfer_record); 
	$payer = $row['user_id'];
	$class_id = $row['class_id'];
	$cat_id = $row['cat_id'];
	$term_id = $row['term_id'];
	$session_id = $row['session_id'];	
	$payment_type = $pt = $row['payment_type'];
	$amount_recorded = $row['amount'];
	
	$tranx_id = $reference;
	$teller_no = generateReceiptNo($sch_id, $payment_type, $term_id, $session_id);
	$date = $paid_at;//date('h:i:s A d'.'-'.'m'.'-'.'Y');
	
	//Getting Student payment Status for the term, session and Payment type
	$confirm_payments = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid='$session_id'");
	$row = mysqli_fetch_assoc($confirm_payments);
	
	#Evaluate the Amount
	$fixed_amount = getAmount($payment_type);
	$amount_paid = $result->data->amount / 100  - Process_charges($amount_recorded);
	$balance = $fixed_amount - $amount_paid;
	
	if ((mysqli_num_rows($check_reference) == false)) {	
		$record_payment = mysqli_query($conn,"INSERT INTO payment_log (sch_id, transaction_id, payment_type, amount, amount_paid, balance, date_paid, user_id, class_id, cat_id, term_id, sid) VALUES ('$sch_id', '$tranx_id', '$payment_type', '$fixed_amount', '$amount_paid', '$balance', '$date', '$payer', '$class_id', '$cat_id', '$term_id', '$session_id')");

		// Collating the total amount paid in the term and session
		$compute_total_amount = mysqli_query($conn,"SELECT amount_paid, SUM(amount_paid) AS total_amount_paid FROM payment_log WHERE user_id='$payer' AND payment_log.sch_id='$sch_id' AND payment_log.class_id='$class_id' AND cat_id='$cat_id' AND payment_log.payment_type='$payment_type' AND payment_log.term_id='$term_id' AND payment_log.sid='$session_id'");
		$row = mysqli_fetch_array($compute_total_amount);
		$total_amount_paid = $row['total_amount_paid'];
		$check_balance = $fixed_amount - $total_amount_paid;
		
		// Save into Ledger_info
		if (mysqli_num_rows($confirm_payments) == false){
			$save_payment = mysqli_query($conn,"INSERT INTO ledger_info (sch_id, payment_type, amount, amount_paid, balance, date_paid, receipt_no, user_id, class_id, cat_id, term_id, sid) VALUES ('$sch_id', '$payment_type', '$fixed_amount', '$total_amount_paid', '$check_balance', '$date', '$teller_no', '$payer', '$class_id', '$cat_id', '$term_id', '$session_id')");
		} else {
			$update_payment = mysqli_query($conn,"UPDATE ledger_info SET amount_paid = '$total_amount_paid', balance = '$check_balance' WHERE user_id='$uid' AND ledger_info.sch_id='$sch_id' AND ledger_info.class_id='$class_id' AND cat_id='$cat_id' AND ledger_info.term_id='$term_id' AND ledger_info.sid='$session_id'");
		}
		
		if ($check_balance == '0'){
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '3' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'");#No Outstanding Payment
		} else if ($check_balance != '0'){
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '1' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'"); #There is an Outstanding Payment
		} else {
			//Do Nothing...
		}
		
		if ($record_payment){
			//Delete the pending record ---- last step
			mysqli_query($conn,"DELETE FROM attempted_payment WHERE reference='$reference'");
			//Alert
			$msg = 'Payment has been Recorded';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			//OR UPDATE
			$msg = 'Unable to Record Payment';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}/* else if((mysqli_num_rows($check_reference) == false) && ){//Remove this line for whole payment
		$update_payment = mysqli_query($conn,"UPDATE `ledger_info` SET `amount_paid` = amount_paid + $amount_paid, `balance` = balance - $amount_paid WHERE `ledger_info`.`user_id` = '$uid' AND `ledger_info`.`payment_type` = '$payment_type'");#Paying balance...
		
		if ($balance == '0'){
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '3' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'");#No Outstanding Payment
		} else if ($balance != '0'){
			mysqli_query($conn,"UPDATE ledger_info SET payment_status = '1' WHERE user_id = '$uid' AND payment_type = '$payment_type' AND term_id = '$term_id' AND sid = '$session_id'"); #There is an Outstanding Payment
		} else {
			//Do Nothing...
		}
		
		if ($update_payment){
			//Delete the pending record ---- last step
			mysqli_query($conn,"DELETE FROM attempted_payment WHERE reference='$reference'");
			//Alert
			$msg = 'Payment has been Recorded';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			//OR UPDATE
			$msg = 'Unable to Record Payment';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}*/ else {
		$msg = 'Record Already Exist';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	}
} else if($feedback == 'abandoned'){
		$online_status = '<span class="badge bg-danger" style="font-size:16px;">'.$result->data->status.'</span>';
		$online_amount = $result->data->currency.number_format($result->data->amount/100);
		$ref = $result->data->reference;
		$message = $result->data->gateway_response;
		$paid_at = $result->data->paid_at;
		$channel = $result->data->channel;
		$referrer = $result->data->metadata->referrer;
		$first_name = $result->data->customer->first_name;
		$last_name = $result->data->customer->last_name;
		//Return status
		mysqli_query($conn,"UPDATE attempted_payment SET online_status = '3' WHERE reference='$reference'");#Abandoned
		//Alert
		$msg_toastr = '<script>toastr.success("'.$message.'")</script>';
} else if($feedback == 'ongoing'){
		$online_status = '<span class="badge bg-warning" style="font-size:16px;">'.$result->data->status.'</span>';
		$online_amount = $result->data->currency.number_format($result->data->amount/100);
		$ref = $result->data->reference;
		$message = $result->data->gateway_response;
		$paid_at = $result->data->paid_at;
		$channel = $result->data->channel;
		$referrer = $result->data->metadata->referrer;
		$first_name = $result->data->customer->first_name;
		$last_name = $result->data->customer->last_name;
		
		$msg_toastr = '<script>toastr.warning("'.$message.'")</script>';
} else {
	$online_status = '<span class="badge bg-danger" style="font-size:16px;">'.'failed'.'</span>';
	$online_amount = '????';
	$ref = 'Not found';
	$message = 'Transaction was not Processed';
	$paid_at = 'Not found';
	$channel = 'Not found';
	$referrer = 'Not found';
	$first_name = getFirstName($uid);
	$last_name = getLastName($uid);
	//Return status
	mysqli_query($conn,"UPDATE attempted_payment SET online_status = '4' WHERE reference='$reference'");#not found
	//Alert
	$msg_toastr = '<script>toastr.error("'.$message.'")</script>';
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
     
			<div class="card card-primary" id="selectbox">
				<div class="card-header">
					<h3 class="card-title">&nbsp;&nbsp;<i class="fa fa-credit-card"></i>&nbsp;Payment Verification | ACCOUNT UNIT</h3>
				</div>
				<?php if (isset($msg_toastr)) { echo $msg_toastr;}?>
				<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;color:white;margin-top:2px;margin-bottom:2px;">
					<tr height="3px">
						<td>Name</td>
						<td><?php echo $last_name.'&nbsp;'.$first_name;?></td>
					</tr>
					<tr>
						<td>Message</td>
						<td><?php echo $message;?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><?php echo $online_status;?></td>
					</tr>
					<tr>
						<td>Amount</td>
						<td><?php echo $online_amount;?></td>
					</tr>
					<tr>
						<td>Reference Code</td>
						<td><?php echo $ref;?></td>
					</tr>
					<tr>
						<td>Reference Link</td>
						<td><?php echo $referrer;?></td>
					</tr>
					<tr>
						<td>Paid At</td>
						<td><?php echo $paid_at;?></td>
					</tr>
					<tr>
						<td>Channel</td>
						<td><?php echo $channel;?></td>
					</tr>
				</table>
				<div class="modal-footer">
					<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
					<?php 
					if ($feedback != 'success'){
						echo '<a title="Repay"'.' href="pay_sch_fee2?uid='.encrypt($uid).'&pt='.encrypt($payment_type).'"><button id="buttonn" class="btn btn-primary"><i class="fa fa-clock"></i>Iniaite New Payment</button></a>';
					}
					?>
					<a title="Payment history" href="stu_payment_history?uid=<?php echo encrypt($uid); ?>"><button id="buttonn" class="btn btn-primary"><i class="fa fa-clock"></i>Payment History</button></a>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
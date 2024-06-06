<?php $page_title = "Pay School Charges"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$uid=""; $pt=""; $amount_paid="";
$paymentChannel = getPaymentChannel($sch_id);

if ($priviledge == 6 || $priviledge == 9 || $priviledge == 10){
	if (isset($_GET['uid'])){
		$uid = decrypt($_GET['uid']);
		$pt = decrypt($_GET['pt']);
		$public_key = getSchPublicKey($sch_id);
		$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND stdnt_info.user_id='$uid'");
		$row = mysqli_fetch_array($result);
		$class_id = $row["class_id"];
		$cat_id = $row["cat_id"];
		$username = $row["username"];
		if(!empty($row['parent_email'])){
			$email = $row['parent_email'];
		} else {
			$email = getLastName($uid).'@goldspringschool.com';//
		}
	} else {
		header("location: class_payment_record?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");
	}
} else if ($priviledge == 3){
	$uid = $user_id;
	$pt = "";
	$public_key = getSchPublicKey($sch_id);
	$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND stdnt_info.user_id='$uid'");
	$row = mysqli_fetch_array($result);
	$class_id = $row["class_id"];
	$cat_id = $row["cat_id"];
	$username = $row["username"];
	if(!empty($row['parent_email'])){
		$email = $row['parent_email'];
	} else {
		$email = getLastName($uid).'@goldspringschool.com';//
	}
} else {
	header("location: logout");
}

if ($paymentChannel == '1'){
	if (isset($_POST['submit'])) {
		$payment_type = addslashes($_POST["payment_type"]);
		$teller_no = addslashes($_POST["teller_no"]);
		$amount = getAmount($payment_type);
		$entered_amount_paid = addslashes($_POST["amount_paid"]);
		$amount_paid = str_replace(array("₦", ",", " "), "", $entered_amount_paid);// Remove symbols, commas, and spaces from the input number
		$balance = $amount - $amount_paid;
		$date = date('h:i:s A d'.'-'.'m'.'-'.'Y');
		$tranx_id = '0'.(rand(00001,99999).$username);
		$term_id = addslashes($_POST["term_id"]);
		$session_id = addslashes($_POST["session_id"]);

		//Verifying Receipt Number
		$result1 = mysqli_query($conn,"SELECT receipt_no FROM ledger_info WHERE receipt_no='$teller_no'");
		$row = mysqli_fetch_assoc($result1); $receipt_no = $row['receipt_no'];
		
		if (empty($payment_type)) {
			$msg = '<span class="badge bg-danger">'.'Payment type is required'.'</span>';
		} else if (empty($teller_no)) {
			$msg = '<span class="badge bg-danger">'.'Enter your teller Number'.'</span>';
		} else if (empty($amount_paid)) {
			$msg = '<span class="badge bg-danger">'.'Enter Availiable Amount to be Paid'.'</span>';
		} else if ($amount_paid <= "0"){
			$msg = '<span class="badge bg-danger">'.'Please Enter a valid amount'.'<span>';
		} else if ($amount_paid > $amount) {
			$msg = '<span class="badge bg-warning">'.'You cannot Pay more than'.'&nbsp;'.'&#8358;'.number_format($amount).'</span>';
		} else if (empty($term_id)) {
			$msg = '<span class="badge bg-danger">'.'Select Term'.'</span>';
		} else if (empty($session_id)) {
			$msg = '<span class="badge bg-danger">'.'Select Session'.'</span>';
		} else {
			//Check if Payment already exist
			$check_teller = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'");
			$row =  mysqli_fetch_assoc($check_teller);
			$bal = $row['balance'];
		
			if ((mysqli_num_rows($check_teller) == false)) {
				if (mysqli_num_rows($result1) == true) {
					$msg = '<span class="badge bg-danger">'.'Receipt No. Already Exist'.'</span>';
				} else {
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
					#echo "Error: " . $new_payment . ":-" . mysqli_error($conn);
				} mysqli_close($conn);
					#header("location: class_payment_record.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");
				} 
			} else if ((mysqli_num_rows($result_check) == true)) {
				if ($bal != 0){
					if ($amount_paid <= $bal){		
				//Updating Existing Payment Info, Balance Payment
				$pay_balance = mysqli_query($conn,"UPDATE `ledger_info` SET `amount_paid` = amount_paid + $amount_paid, `balance` = balance - $amount_paid WHERE `ledger_info`.`user_id` = '$uid' AND `ledger_info`.`payment_type` = '$payment_type'");//AND `ledger_info`.`receipt_no` = '$teller_no'
				} else {
					$pay_balance = "";
					$msg = '<span class="badge bg-danger">'.'You cannot pay more than'.'&nbsp;'.'&#8358;'.number_format($bal).'(Balance)'.'</span>';
					}
				} else {
					$pay_balance = "";
					$msg = '<span class="badge bg-danger">'.getFirstname($uid).'&nbsp;'.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!'.'</span>';
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
					echo ('<script>alert("Payment Unsuccessful")</script>');
					#echo "Error: " . $pay_balance . ":-" . mysqli_error($conn);
				} mysqli_close($conn);
					#header("location: class_payment_record.php?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");
				} else if ((mysqli_num_rows($result) == true)&&($bal == 0)){
					$msg = getFirstname($uid).'&nbsp;'.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!';
				}
		}
	}
} else if (($priviledge == 6 || $priviledge == 9) && $paymentChannel == '0') {
	//Record Payment
	if (isset($_POST['submit2'])) {
		$uid = decrypt($_POST["student"]);
		$payment_type = addslashes($_POST["payment_type"]);
		$pt = $payment_type;
		$teller_no = addslashes($_POST["teller_no"]);
		$amount = getAmount($payment_type);
		$removeN = str_replace('₦', '', addslashes($_POST["amount_paid"]));
		$amount_paid = str_replace(',', '', addslashes($removeN));								
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
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else if (empty($teller_no)) {
			$msg = 'Enter your teller Number';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else if (empty($amount_paid)) {
			$msg = 'Enter Availiable Amount to be Paid';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else if ($amount_paid > $amount) {
			$msg = 'You cannot Pay More than'.'&nbsp;'.'&#8358;'.number_format($amount);
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		} else if (empty($term_id)) {
			$msg = 'Select Term';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else if (empty($session_id)) {
			$msg = 'Select Session';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else {
			//Check if Payment already exist
			$result_check = mysqli_query($conn,"SELECT * FROM ledger_info WHERE user_id='$uid' AND payment_type='$payment_type' AND term_id='$term_id' AND sid ='$session_id'");
			$row =  mysqli_fetch_assoc($result_check);
			$bal = $row['balance'];
		
			if ((mysqli_num_rows($result_check) == false)) {
				if (mysqli_num_rows($result1) == true) {
					$msg = 'Receipt No. Already Exist';
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				} else {
					//Insert New Payment if Payment do not Exist
					$new_payment = mysqli_query($conn,"INSERT INTO ledger_info (sch_id, payment_type, amount, amount_paid, balance, date_paid, receipt_no, user_id, class_id, cat_id, term_id, sid) VALUES ('$sch_id', '$payment_type', '$amount', '$amount_paid', '$balance', '$date', '$teller_no', '$uid', '$class_id', '$cat_id', '$term_id', '$session_id')");
					
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
						$msg = 'Payment record saved Successfully';
						$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
						
						$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'class_payment_record?class=' . encrypt($class_id) . '&category=' . encrypt($cat_id) . '&pt=' . encrypt($pt);
						header('Refresh: 2; URL=' . $redirect);
					} else {
						#$msg = "Error: " . $new_payment . ":-" . mysqli_error($conn);
						#$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
					} 
				} 
			} else if ((mysqli_num_rows($result_check) == true)) {
				if ($bal != 0){
					if ($amount_paid <= $bal){		
						//Updating Existing Payment Info, Balance Payment
						$pay_balance = mysqli_query($conn,"UPDATE `ledger_info` SET `amount_paid` = amount_paid + $amount_paid, `balance` = balance - $amount_paid WHERE `ledger_info`.`user_id` = '$uid' AND `ledger_info`.`payment_type` = '$payment_type'");//AND `ledger_info`.`receipt_no` = '$teller_no'
						
						$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'class_payment_record?class=' . encrypt($class_id) . '&category=' . encrypt($cat_id) . '&pt=' . encrypt($pt);
						header('Refresh: 2; URL=' . $redirect);
					} else {
						$pay_balance = "";
						$msg = 'You cannot pay more than'.'&nbsp;'.'&#8358;'.number_format($bal).' (Balance)';
						$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
					}
				} else {
					$pay_balance = "";
					$msg = getFirstname($uid).'&nbsp;'.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).'&nbsp;'.'for this Term!';
					$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
					
					$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'class_payment_record?class=' . encrypt($class_id) . '&category=' . encrypt($cat_id) . '&pt=' . encrypt($pt);
					header('Refresh: 2; URL=' . $redirect);
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
					$msg = "Payment Successful";
					$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
					
					$redirect = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'class_payment_record?class=' . encrypt($class_id) . '&category=' . encrypt($cat_id) . '&pt=' . encrypt($pt);
					header('Refresh: 2; URL=' . $redirect);
				} else {
					#$msg = "Error: " . $pay_balance . ":-" . mysqli_error($conn);
					#$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				}
			} else if ((mysqli_num_rows($result) == true)&&($bal == 0)){
				$msg = getFirstname($uid).' '.'has already paid'.' '.getPaymenttype($payment_type).' '.'for this Term!';
				$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
			}
		}
	}
} else {
	$msg = 'This Service is temporarily Suspended';
	$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';	
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

		<?php 
		if(isset($msg)){echo $msg_toastr;}
		if ($paymentChannel == '1'){
			echo '
			<div class="card card-primary" id="selectbox">
				<div class="card-header"><h3 class="card-title"><i class="fa fa-credit-card"></i>&nbsp;Pay School Charges</h3></div>
				<center style="color:red;margin:1px auto;">';
			echo '<span id="feedback"></span>
				<form action="" id="paymentForm" method="post" autocomplete="off">';
				if($priviledge == 6 || $priviledge == 9 || $priviledge == 10){
					echo '<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">	
						<div class="col-md-12" style="margin:5px auto;width:95%;">
							<input type="text" value="'.getFirstname($uid).'&nbsp;'.getLastname($uid).'" class="form-control" disabled/>
							<input type="hidden" id="email-address" value="'.$email.'" />
							<input type="hidden" id="first-name" value="'.getFirstname($uid).'"/>
							<input type="hidden" id="last-name"value="'.getLastname($uid).'"/>
						</div>
						<tr>
							<td>
								<div class="col-md-12">    
									<select name="payment_type" id="payment-dropdown" class="form-control" required>
										<option value="">Purpose of Payment</option>';
										$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE status = 1");
										while ($row = mysqli_fetch_array($result)){ 
										echo '<option value="'.$row["payment_id"].'">'.$row["payment_type"].'</option>';
										} echo'
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
									<input  type="text" name="teller_no" placeholder="Enter Receipt Number E.g 3XXXX8" id="reference" value="'. 'SMS-'.(rand(100,999).'-'.rand(100,999).'-'.rand(100,999)).'" maxlength="15" class="form-control" required disabled/>
								</div>
							</td>
							<td align="left">
								<div class="col-md-12">
									<input type="text" name="amount_paid" id="amount" placeholder="Enter Amount" class="form-control" onkeyup="formatMoney(event)" max="1000" required/>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="col-md-12">    
									<select name="term_id" id="term" class="form-control" required>
										<option value=""> Select Term</option>';
										$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
										while ($row = mysqli_fetch_array($result)){ 
										echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
										}echo'
									</select>
								</div>  
							</td>
							<td>
								<div class="col-md-12">      
									<select name="session_id" id="session" class="form-control" required>
										<option value="">Select Session</option>'.
										$ses = "SELECT * FROM session_info WHERE status = '1'";
										$result = mysqli_query($conn,$ses);
										while ($row = mysqli_fetch_array($result)){ echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>';
										}echo'
									</select>
								</div> 
							</td>
						</tr>	
					</table>';
				} else {
					echo '<center>This Service is not made available to you</center>';
				}
				echo '<div class="modal-footer">
						<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
						<button type="reset" id="buttonn" class="btn btn-danger"><i class="fa fa-history"></i> Reset </button>
						<button onclick="location.href=\'stu_payment_history.php?uid='.encrypt($uid).'"id="buttonn" class="btn btn-success"><i class="fa fa-clock"></i> History </button>
						<button type="submit" name="submit" onclick="payWithPaystack()" class="btn btn-primary"><i class="fa fa-credit-card"></i> Pay</button>
						 <span style="margin:0 auto"><img src="assets/img/paystack99876.png" width="400" height="80" alt="" data-pagespeed-url-hash="1293401689" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span>            
					</div>
				</form>
			</div>';
		} else if (($priviledge == 6 || $priviledge == 9) && $paymentChannel == '0'){
			echo '
			<div id="selectbox" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="<?php echo $modal_id; ?>Label">Record Student Payment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" autocomplete="off">
					<div class="modal-body">
						<div class="col-md-12">
							<input type="text" value="'.getLastname($uid).' '.getFirstname($uid).'" class="form-control" disabled/>
							<input type="hidden" name="student" value="'.encrypt($uid).'"/>
						</div>
						<div class="col-md-12">																	
							<select name="payment_type" id="payment-dropdown" class="form-control" required>
								<option value="">Purpose of Payment</option>';
								$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE status = '1'");
								while ($row = mysqli_fetch_array($result)){ 
								echo '<option value="'.$row["payment_id"].'">'.$row["payment_type"].'</option>';
								} 
						echo '</select>
						</div>  
						<div class="col-md-12"> 
							<select name="amount" id="amount-dropdown" class="form-control" disabled></select> 
						</div>';
					echo '<div class="col-md-12">
							<input type="text" name="teller_no" placeholder="Enter Receipt Number E.g 3XXXX8" maxlength="6" class="form-control" required />
						</div>';
					echo '<div class="col-md-12">
							<input type="text" name="amount_paid" id="amount" placeholder="Enter Amount" class="form-control" placeholder="Enter Avaliable Amount to be Paid Without comma or Spaces"onkeyup="formatMoney(event)" max="1000" required/>
						</div>
						<div class="col-md-12">    
							<select name="term_id" id="term" class="form-control" required>
								<option value=""> Select Term</option>';
								$result001 = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");										
								while ($row = mysqli_fetch_array($result001)){ 
								echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
								}
						echo '</select>
						</div>  
						<div class="col-md-12">      
							<select name="session_id" id="session" class="form-control" required>
								<option value="">Select Session</option>';
								$result002 = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
								while ($row = mysqli_fetch_array($result002)){ echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>';
								} 
						echo '</select>
						</div>
						<div class="modal-footer">
							<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
							<button type="reset" id="buttonn" class="btn btn-danger"><i class="fa fa-history"></i> Reset </button>
							<button type="submit" name="submit2" class="btn btn-primary"><i class="fa fa-credit-card"></i> Pay</button>		   
						</div>
					</div>
				</form> 
			</div>
			<style>
			 .col-md-12{
				margin:5px auto;
				width:95%;
			 }
			</style>'; 
		} else {
			echo '<div align="center" style="width:100%; margin:auto; margin-top:50px; margin-bottom:20px; max-width:550px; border:0px solid #CCC;">
				<div class="card card-danger" style="color:; margin:auto; width:auto;">
		<div class="card-header" style="text-align:left;">Information! <i class="fa fa-warning" class="img-responsive" style="float:right;font-size:20px;"></i></div>
					<div align="center" style=" margin:auto; padding:15px;">
						<div style="width:auto; height:auto; padding:15px;">
							All Payments are to be made in the School or Bank. <p>Bank:<b> '.getSchAccDet($sch_id,'bank').', '.getSchAccDet($sch_id,'number').'</b>
						</div>
					</div>
				</div>
			</div>';
		}
		?>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/payment_gateway.php');?>
</html>
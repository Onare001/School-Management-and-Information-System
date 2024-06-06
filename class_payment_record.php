<?php $page_title = "Payment Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
$class_id=""; $cat_id="";
if (isset($_GET['class']) && isset($_GET['category']) && isset($_GET['pt'])) {
    $class_id = decrypt($_GET['class']);
    $cat_id = decrypt($_GET['category']);
	$pt = decrypt($_GET['pt']);
} else {
	header("location: class_payment_record?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($pt) . "");
}

$paymentChannel = getPaymentChannel($sch_id);

if ($paymentChannel == '0'){
	//Record Payment
	if (isset($_POST['submit'])) {
		$uid = decrypt($_POST["student"]);
		$payment_type = addslashes($_POST["payment_type"]);
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
					} else {
						$pay_balance = "";
						$msg = 'You cannot pay more than'.' '.'&#8358;'.number_format($bal).' (Balance)';
						$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
					}
				} else {
					$pay_balance = "";
					$msg = getFirstname($uid).' '.'has already paid for'.'&nbsp;'.getPaymenttype($payment_type).' '.'for this Term!';
					$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
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
	$msg = "Only Online Payments are accepted";
	$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
}
?>
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
								<?php if(isset($msg)){echo $msg_toastr;}?>
									<h3 class="card-title">Class Payment List | <?php echo getClass($class_id).'&nbsp'.getCategory($cat_id);?> | <b><?php echo getPaymenttype($pt).'-'.'&#8358;'.number_format(getAmount($pt));?> (<i>for Current Term and Session</i>)</b></h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:5%;">S/N</th>
											<th style="width:10%;">Passport</th>
											<th>Student Name</th>
											<th>Receipt No.</th>
											<th style="width:10px;">Amount<br>Paid</th>
											<th style="width:10px;">Balance</th>
											<th style="width:5px;">Pay</th>
											<th style="width:5px;">Payment<br>History</th>
											<th style="width:5px;">Remark</th>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id = sch_users.user_id WHERE stdnt_info.class_id = '$class_id' AND stdnt_info.cat_id = '$cat_id' AND sch_users.sch_id = '$sch_id' AND stdnt_info.status_id!='0' ORDER BY sch_users.last_name");
											while ($row = mysqli_fetch_array($result)){
											$uid = $row["user_id"];
											$modal_id = "myModal".$uid; $modal_id2 = "transfer".$uid; // Generate unique ID for modal
											
											$tid = $ctid; $sid = $csid; //Getting Payment Record for Current Term And Session
											if (getMPaymentstatus($uid, $tid, $sid, $pt) == 0){
												$paymentstatus = '<span class="badge bg-danger">Not Paid</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 1){
												$paymentstatus = '<span class="badge bg-warning">Ouststanding</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 2){
												$paymentstatus = '<span class="badge bg-danger">Denied</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 3){
												$paymentstatus = '<span class="badge bg-success">Paid</span>';//Approved
											} else {
												$paymentstatus = '<span class="badge bg-danger">Not Paid</span>';
											}
											
											//$result001 = mysqli_query($conn,"SELECT * FROM payment_type WHERE status = '1'");
											$result001 = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
											$result002 = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
											
											echo '  
											<tr>
												<td align="center">'.++$counter.'</td>
												<td><center><img src="'.getPassport($row["user_id"]).'" alt="'.getLastname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/></center></td>
												<td>'.getLastname($uid).' '.getFirstname($uid).'</td>
												<td>'.getTellerno($row["user_id"], $tid, $sid, $pt).'</td>
												<td>';
													if (empty(getAmountPaid($row["user_id"], $tid, $sid, $pt))){
														echo '';
													} else {
														echo '&#8358;'.getAmountPaid($row["user_id"], $tid, $sid, $pt);
													}
											echo '</td>
												<td>';
													if (getBalance($row["user_id"], $tid, $sid, $pt) == 0){
														echo '';
													} else {
														echo '&#8358;'.getBalance($row["user_id"], $tid, $sid, $pt);
													}
											echo '</td>
												<td class="border" align="center">';
													if ($paymentChannel == '0'){
														echo '<button title="Pay" class="btn btn-info view-btn" data-toggle="modal" data-target="#'.$modal_id.'"><i class="fa fa-pen"></i></button>';
													} else {
														echo '<a title="Pay" href="pay_sch_fee2?uid='.encrypt($uid).'&pt='.encrypt($pt).'">
														<img src="assets/img/pay.png" width="16" height="16" alt="img">
														</a>';
													}
											echo '</td>
												<td class="border" align="center">
													<a title="View payment history" href="stu_payment_history?uid='.encrypt($row["user_id"]).'">
													<img src="assets/img/record.png" width="16" height="16" alt="img">
													</a>
												</td>
												<td class="border" align="center">'.$paymentstatus.'</td>
											</tr>';
											if ($paymentChannel == '0'){
												echo '
											<div class="modal fade" id="'.$modal_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$modal_id.' Label" aria-hidden="true">
												<div class="modal-dialog" role="document">
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
																	<input type="hidden" name="student" value="'.encrypt($row["user_id"]).'"/>
																</div>
																<div class="col-md-12">																	
																	<select name="payment_type" id="payment-dropdown" class="form-control" readonly>
																		<option value="'.$pt.'">'.getPaymenttype($pt).'</option>
																	</select>
																</div>  
																<div class="col-md-12"> 
																	<input name="amount" id="amount-dropdown" value="'.'&#8358;'.number_format(getAmount($pt)).'" class="form-control" disabled/> 
																</div>';
															echo '<div class="col-md-12">
																	<input type="text" name="teller_no" placeholder="Enter Receipt Number E.g 3XXXX8" value="'.getTellerno($row["user_id"], $tid, $sid, $pt).'" maxlength="6" class="form-control"'; echo getTellerno($row["user_id"], $tid, $sid, $pt) ? " readonly" : " required"; echo ' />
																</div>';
															echo '<div class="col-md-12">
																	<input type="text" name="amount_paid" id="amount" placeholder="Enter Amount" class="form-control" placeholder="Enter Avaliable Amount to be Paid Without comma or Spaces"onkeyup="formatMoney(event)" max="1000" required/>
																</div>
																<div class="col-md-12">    
																	<select name="term_id" id="term" class="form-control" required>
																		<option value=""> Select Term</option>';
																		while ($row = mysqli_fetch_array($result001)){ 
																		echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
																		}
																echo '</select>
																</div>  
																<div class="col-md-12">      
																	<select name="session_id" id="session" class="form-control" required>
																		<option value="">Select Session</option>';
																		while ($row = mysqli_fetch_array($result002)){ echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>';
																		} 
																echo '</select>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="reset" id="buttonn" class="btn btn-danger"><i class="fa fa-history"></i> Reset </button>
																	<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-credit-card"></i> Pay</button>		   
																</div>
															</div>
														</form> 
													</div> 
												</div>
											</div>';
											} else {
												echo '';
											}
										} ?>	
										</tbody>				
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<style>
			 .col-md-12{
				margin:5px auto;
				width:95%;
			 }
			</style>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<script>
function formatMoney(event) {
  const maxAmount = document.getElementById("amount-dropdown").value;; // set the maximum amount here
  
  let input = event.target.value;
  // Remove all non-numeric characters
  input = input.replace(/[^0-9]/g, '');
  // Format as money
  input = "₦" + Number(input).toLocaleString('en-US');
  
  // Check if input exceeds the maximum amount
  const numericInput = Number(input.replace(/[^0-9]/g, ''));
  if (numericInput > maxAmount) {
    input = "₦" + maxAmount.toLocaleString('en-US');
  }
  
  // Update input value
  event.target.value = input;
  
  // Show red boundary if input is invalid
  if (event.target.value === "$NaN") {
    event.target.classList.add("error");
  } else {
    event.target.classList.remove("error");
  }
}

</script>
</html>
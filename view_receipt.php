<?php $page_title = "Payment Receipt"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$payment_id="";
if(isset($_GET['pid'])){
	$payment_id = decrypt($_GET['pid']);
	}
?>
<?php
$uid = ""; $class_id = ""; $cat_id = ""; $payment_type = ""; $teller_no  = ""; $term_id = ""; $session_id = ""; $tranx_id = ""; $date = ""; $payment_status = "";
$sql = "SELECT * FROM ledger_info WHERE payment_id = '$payment_id' LIMIT 1";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
	$uid = $row["user_id"];
	$class_id = $row["class_id"];
	$cat_id = $row["cat_id"];
	$payment_type = $row["payment_type"];
	$teller_no  = $row["receipt_no"];
	$payment_status =$row["payment_status"];
	$term_id = $row["term_id"];
	$session_id = $row["sid"];
	$tranx_id = "";
	$date = $row["date_paid"];
}

if ($payment_status == 1){
	$receipt = '<span class="badge bg-warning">Outstanding</span>';
	$view = "";
} else if ($payment_status == 2){
	$receipt = '<span class="badge bg-danger">Denied</span>';
	$view = "repay";
} else if ($payment_status == 3){
	$receipt = '<span class="badge bg-success">Paid</span>';
	$view = "view";
} else {
	$receipt = '<span class="badge bg-danger">Not paid</span>';
	$view = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>
<?php include 'include/side_nav.php';?>

<?php include('include/page_title.php');?>

			<div class="card" style="margin-left:100px;margin-right:100px;width:900px;">
				<div class="col-10" style="margin:0 auto;border:1px solid;width:800px;margin-top:20px;margin-bottom:20px;">
					<div class="panel panel-default plain" id="dash_0">
						<!-- Start .panel -->
						<div class="panel-body" style="margin-top:25px;">
						<h3 style="text-align:center;"><?php echo strtoupper(getSchname($sch_id));?></h3>
						<p style="text-align:center;"><?php echo getSchAddress($sch_id);?></p>
						<p style="text-align:center;"> 
						---------------------
						<?php echo getSchPhone($sch_id);?> 
						---------------------</p>
						<hr style="background-color:red;width:100%">
							<div class="row">
								<div class="col-6">
									<div class="invoice-logo"><img width="100" src="<?php echo getPassport($uid);?>" alt="Student_Passport"></div>
								</div>
								<div class="col-6">
									<div class="invoice-from">
										<ul class="list-unstyled text-right">
										<li><img width="100" src="<?php echo getSchlogo($sch_id);?>" alt="School_logo"></li>   
										</ul>
									</div>
								</div>
								<hr style="background-color:red;width:100%">
								<!-- col-lg-6 end here -->
								<div class="col-lg-12">
									<!-- col-lg-12 start here -->
									<div class="invoice-details mt25">
										<div class="well">
											<ul class="list-unstyled mb0">
												<li><strong>Reciept NO</strong>&nbsp;<?php echo $teller_no;?></li>
												<li><strong>Transaction ID(s)</strong>&nbsp;<?php echo $tranx_id;?></li>
												<?php 
												 $result = mysqli_query($conn,"SELECT * FROM payment_log WHERE sch_id='$sch_id' AND user_id='$uid' AND payment_type ='$payment_type' AND term_id = '$term_id' AND sid = '$session_id'");
													while($row = mysqli_fetch_array($result)){
														echo $row['transaction_id'].'<p>';
													}
												?>
												  <img src="<?php
													// Include the QR code library
													require_once('assets/lib/phpqrcode/qrlib.php');
													// Get the username for the QR code
													$data = '('.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).') '.getUsername($uid).', '.getTerm($term_id).' '.getSession($session_id).' Receipt';
													// Generate the QR code and get the image data
													ob_start();
													QRcode::png($data, null, QR_ECLEVEL_Q);
													$qr_code = ob_get_contents();
													ob_end_clean();
													// Output the base64-encoded image data
													echo 'data:image/png;base64,' . base64_encode($qr_code);
												  ?>" style="max-width:100px;max-height:100px;"/>
												<li><strong>Student' Name</strong>&nbsp;<?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></li>
												<li><strong>Class</strong>&nbsp;<?php echo getClass($class_id).getCategory($cat_id);?></li>
												<li><strong>Term</strong>&nbsp;<?php echo getTerm($term_id);?></li>
												<li><strong>Session</strong>&nbsp;<?php echo getSession($session_id);?></li>
												<li><strong>Number of Times Paid - </strong>&nbsp;<?php echo countTx($sch_id, $uid, $payment_type, $term_id, $session_id);?></li>
												<li><strong>Payment Time/Date</strong>&nbsp;<?php echo $date;?></li>
												<li><strong>Status:</strong>&nbsp;<?php echo $receipt;?></li>
											</ul>
										</div>
									</div>
									<div class="invoice-items">
										<div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th class="per70 text-center">Purpose of Payment</th>
														<th class="per25 text-center">Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>&nbsp;<?php echo getPaymenttype($payment_type);?></td>
														<td class="text-center">&nbsp;<?php echo '&#8358;'.number_format(getAmount($payment_type));?></td>
													</tr>
													<table border="1" width="100%">
													<tr>
														<td width="20%"><b>&nbsp;&nbsp;Amount in Words</b></td>
														<td>&nbsp;<?php echo AmountInWords(getAmount($payment_type));?></td>
													</tr>
													</table>
												</tbody>
											</table>
										</div>
									</div>
									<br>
									<div class="invoice-footer mt25">
										<p class="text-center">Generated on <?php echo date('D, dS-M-Y h:i:s A');?> 
										<a href="#" value="Print" '+' onClick="javascript:window.print()" class="btn btn-default ml15"><i class="fa fa-print mr5"></i> Print</a></p>
										<table border="1" cellpadding="5" cellspacing="0" style="width:730px;margin-bottom:2px;">
											<tr>
												<td align="center">
													<div style="font-size:15px;">Copyright © 2023 SMS. Powered by Niel Technologies <i class="fa fa-square-whatsapp"></i> +2348145162722. All Rights Reserved.</div>
												</td>
											</tr>
										</table>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
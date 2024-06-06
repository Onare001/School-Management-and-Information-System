<?php $page_title = "School Activator"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php
	if ((isset($_GET['sch'])) && (isset($_GET['pin']))){
		$sch_id = base64_decode($_GET['sch']);
		$pin_code = base64_decode($_GET['pin']);
	} else {
		header('location: print_pin');
	}
?>
<?php
function groupDigitsInSetsOf4($digits) {
    $groupedDigits = '';

    // Ensure the input is a valid string
    if (is_string($digits)) {
        $digits = preg_replace('/\D/', '', $digits); // Remove non-digit characters

        // Group the digits in sets of 4 and separate with hyphens
        $groupedDigits = implode('-', str_split($digits, 4));
    }

    return $groupedDigits;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> School Management System | <?php echo $page_title;?> </title>
	<meta name="keywords" content="School Management System"/>
	<meta name="description" content="Niel Technologies">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<link rel="shortcut icon"  href="assets/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
	<link rel="icon" type="image/x-icon" sizes="16x16" href="assets/img/favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/sms.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/result_style.min.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<?php
$result = mysqli_query($conn,"SELECT DISTINCT * FROM sch_info JOIN sch_users ON sch_info.sch_id=sch_users.sch_id WHERE sch_info.sch_id='$sch_id' GROUP BY sch_users.sch_id");
$row = mysqli_fetch_array($result);
	$sch_admin = $row['user_id'];
	
	$expires_on = base64_decode($row['sch_year']);
	$month = substr($expires_on,4);
	$year = substr($expires_on,0,4);
	$schyear = $year.'-'.$month;
	
	$last_sub_date = base64_decode($row['sch_year2']);
	$month2 = substr($last_sub_date,4);
	$year2 = substr($last_sub_date,0,4);
	$schyear2 = $year2.'-'.$month2;

//New year
	$new_sub_date = base64_decode($row['sch_year']);
	$month_2 = date('M');//substr($new_sub_date,4);
	$year_2 = substr($new_sub_date,0,4)+1;
	$schyear3 = $year_2.'-'.$month_2;
	
	$status = $row['status'];
	//echo $expires_on.'<br>';
	//echo $month.'<br>';
	//echo $schyear.'<br>';
	
	$trRef = 'SMS000002';
	$maintenance_fee = '0.00';
	$no_of_term = '3';
	$fee_per_term = '10000.00';
	$subscription_fee = $no_of_term * $fee_per_term;
	
	 // Get IP address and device name
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $device_name = gethostname();
	
	// Usage
	if (isOnline()) {
		$hosttype = 'Online';
		$hostfee = '30000';
		//echo 'The application is online (accessible from any part of the world).';
	} else {
		$hosttype = 'Offline';
		$hostfee = '0.0';
		//echo 'The application is offline (accessed from localhost or a local network).';
	}
	
	$grand_total = $subscription_fee + $hostfee;
?>	
<body>
	<div class="sch_actv">
		<div class="org_name" style="text-align:center;background-color:#ccc;margin-bottom:10px;">
			<img src="images/logo_size.jpg">
			<text style="font-size: 50px;">NIEL TECHNOLOGIES NIG</text>
			<hr>
			<small>Email: Onaretayo@gmail.com &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phone: +234 (0) 8145162722</small>
		</div>
		<div class="pin_holder" style="margin-bottom:10px;">
			<div class="qrcode">
				<!--img src="images/qrcode.png" style="width:120px;height:120px;"-->
				<img src="<?php
				// Include the QR code library
				require_once('assets/lib/phpqrcode/qrlib.php');
				// Get the username for the QR code
				$data = $pin_code;
				// Generate the QR code and get the image data
				ob_start();
				QRcode::png($data, null, QR_ECLEVEL_Q);
				$qr_code = ob_get_contents();
				ob_end_clean();
				// Output the base64-encoded image data
				echo 'data:image/png;base64,' . base64_encode($qr_code);?>" style="width:150px;height:150px;"/>
			</div>
			<div class="activator">
				<div class="rinfo" style="width:350px;margin-left:400px;">
					<div style="">
						<p><b>Subscription Payment Receipt</b>
						</br><small>Generated on <?php echo date('d'.'/'.'m'.'/'.'Y');?></small>
					</div>
					<div class="pinholder" style="background-color:red;color:white;margin-bottom:5px;">
						<div style="background-color:darkblue;color:white;text-align:center;">School Activation Key (SAK)</div>
						<div class="pin">
							<?php echo groupDigitsInSetsOf4(base64_decode($pin_code));?>
						</div>
					</div>
				</div>
			</div></br>
		</div>
		<div class="sch_info">
			<table id="example1" class="table table-bordered table-striped" width="100%">
				<tr style="background-color:darkblue;color:white;padding:5px;">
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;SCHOOL INFORMATION</td>
				</tr>
				<tr>
					<td class="thh" style="width:30%;">NAME OF SCHOOL</td>
					<td class="ttd" style="width:70%;"><b><?php echo strtoupper(getSchName($sch_id));?></b></td>
				</tr>
				<tr>
					<td class="thh" style="width:30%;">SECTION</td>
					<td class="ttd" style="width:70%;"><b><?php echo $sch_type;?></b></td>
				</tr>
				<tr>
					<td class="thh">SCHOOL ADDRESS</td>
					<td class="ttd" ><?php echo getSchAddress($sch_id);?></td>
				</tr>
				<tr>
					<td class="thh">EMAIL</td>
					<td class="ttd" ><?php echo $row['email'];?></td>
				</tr>
				<tr>
					<td class="thh">PHONE NUMBER</td>
					<td class="ttd" ><?php echo getSchphone($sch_id);?></td>
				</tr>
				<tr>
					<td class="thh">NAME OF SCHOOL ADMIN</td>
					<td class="ttd"><?php echo getFirstname($sch_admin).'&nbsp;'.getLastname($sch_admin);?></td>
				</tr>
			</table>
		</div>
		<div class="subscr_info" style="margin-top:10px;">
			<table id="example1" class=" table-bordered table-striped" width="100%">
			<thead style="background-color:darkblue;color:white;font-size:14px;">
				<tr>
					<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;SUBSCRIPTION INFORMATION --------------------------------------------------- REFERENCE CODE <?php echo $trRef;?></td>
				</tr>
				<tr align="center">
					<td>DATE LAST OF SUB</td>
					<td>EXPIRED ON</td>
					<td>NEW SUB. EXPIRES ON</td>
					<td>DURATION</td>
					<td>AMOUNT</td>
					<td>MAINTENANCE FEE</td>
					<td>TOTAL</br><small>(NGN)</small></td>
				</tr>
			</thead>
				<tr align="center">
					<td><?php echo date('F Y', strtotime($schyear2));?></td>
					<td><?php echo date('F Y', strtotime($schyear));?></td>
					<td><?php echo date('F Y', strtotime($schyear3));?></td>
					<td>1 Year</td>
					<td><small><?php echo number_format($fee_per_term);?>/term</small><br/><?php echo number_format($subscription_fee);?></td>
					<td>FREE</td>
					<td><?php echo number_format($subscription_fee);?></td>
				</tr>
			</table>
		</div>
		<div class="software_info" style="margin-top:10px;">
			<table id="example1" class=" table-bordered table-striped" width="100%">
			<thead style="background-color:darkblue;color:white;font-size:14px;">
				<tr>
					<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;PACKAGE INFORMATION</td>
				</tr>
				<tr align="center">
					<td>TYPE</td>
					<td>CATEGORY</td>
					<td>HOST TYPE</td>
					<td>SERVER ADDRESS</td>
					<td>HOST NAME</td>
					<td>HOST CHARGES</td>
					<td>TOTAL</br><small>(NGN)</small></td>
				</tr>
			</thead>
				<tr align="center">
					<td>School Management Software<br><small>Beta Version</small></td>
					<td><?php echo $_SERVER['HTTP_HOST'];;?></td>
					<td><?php echo $hosttype;?></td>
					<td><?php echo $_SERVER['REMOTE_ADDR'];?></td>
					<td><?php echo $device_name;?></td>
					<td><?php echo number_format($hostfee);?></td>
					<td><?php echo number_format($hostfee);?></td>
				</tr>
			</table>
		</div>
		<div class="upgrade" style="margin-top:10px;">
			<table id="example1" class="table table-bordered table-striped" width="100%">
			<thead style="background-color:darkblue;color:white;font-size:14px;">
				<tr>
					<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;UPGRADE</td>
				</tr>
				<tr align="center">
					<td>INSTALLED VERSION</td>
					<td>NEW VERSION</td>
					<td>AVAILABILITY</td>
					<td>FEATURES</td>
				</tr>
			</thead>
				<tr align="center">
					<td>School Management Software<br><small>Beta Version</small></td>
					<td>School Management Software<br><small>1.23.0</small></td>
					<td>READY</td>
					<td>Improved beta Version with 15 new functions</td>
				</tr>
			</table>
		</div>
		<div class="payment_channel" style="margin-top:10px;">
			<table id="example1" class="table table-bordered table-striped" width="100%">
			<thead style="background-color:darkblue;color:white;font-size:14px;">
				<tr>
					<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;PAYMENT CHANNEL INFORMATION</td>
				</tr>
				<tr align="center">
					<td>CHANNEL/MERCHANT NAME</td>
					<td>PAID BY</td>
					<td>RECEIVED BY</td>
					<td>ACCOUNT NUMBER</td>
					<td>GRAND TOTAL</br><small>(NGN)</small></td>
				</tr>
			</thead>
				<tr align="center">
					<td>
						<select>
							<option>Paystack</option>
							<option>POS Transfer</option>
							<option>Mobile Transfer</option>
							<option>Cash Deposit</option>
						</select>
					</td>
					<td><?php echo 'School Admin';?></td>
					<td>Daniel Tayo Onare</td>
					<td>0109309870<br><small>Access Bank Plc</small></td>
					<td><b><?php echo number_format($grand_total);?></b></td>
				</tr>
			</table>
		</div>
		<div style="margin-top:20px; border:1px black solid;">
			<div class="instruction" style="background-color:darkblue;color:white;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;INSTRUCTIONS</div>
			HOW TO USE
			<ul>
				<li>Connect to the server</li>
				<li>Log in as an Admin</li>
				<li>Click Enter Activation Pin</li>
				<li>Enter the School Activation Key embossed on this Slip</li>
				<li>You will get a feedback of a successfull Activation and you will be redirected to Login Again</li>
			</ul>
	</div>
</body>
<footer>

</footer>
</html>
<style>
	.sch_actv{
		margin: auto;
		border: 3px black solid;
		width:900px;
		padding:10px;
	}
	.org_name {
		//font-size: 50px;
	}
	.pin_holder {
		display: flex;
	}
	.pin {
		font-size:30px;
		font-weight:bold;
		text-align:center;
	}
	.thh {
		background-color:darkblue;
		color:white;
	}
	.ttd {
		background-color:#ccc;
	}
</style>
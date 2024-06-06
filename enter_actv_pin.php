<?php $page_title = "Activate"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php');?>
<?php
$priviledge = $sch_id = $sch_year = $sch_year2 = $theme = $username = $first_name = $last_name = $passport = $user_id = "";
$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN sch_info ON sch_users.sch_id = sch_info.sch_id  WHERE sch_users.username='$_SESSION[username]' LIMIT 1");
if ((mysqli_num_rows($result) == 1) && ($_SESSION['priv_id'] == 1)) {	
	$row = mysqli_fetch_array($result);	
	$sch_id = $_SESSION['sch_id'] = $row['sch_id']; //School identifier
	$theme = $_SESSION['theme_code'] = $row['theme_code']; //School theme code
	$sch_year = $_SESSION['sch_year'] = $row['sch_year']; //School Year
	$sch_year2 = $_SESSION['sch_year2'] = $row['sch_year2']; //Current Year
	$user_id = $_SESSION['user_id'] = $row['user_id']; //User_id
	$priviledge = $_SESSION['priv_id'] = $row['priv_id']; //Privilege
} else {
	/*header("Location: logout");
	exit();*/
}

if (isset($_POST['sch_id']) && isset($_POST['activator'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

//Validate entries
    $sch_id = validate($_POST['sch_id']);
    $activator = base64_encode(validate($_POST['activator']));
	$sch_year = base64_encode('20'. substr($_POST['activator'], 8,2).date("m"));//Next
	$sch_year2 = base64_encode('20'.(substr($_POST['activator'], 8,2)-1) .date("m"));//Current
		$public_key = getSchPublicKey($sch_id);	
    if (empty($sch_id)) {
		$msg = '<span class="badge bg-danger">'.'Select Your School!'.'</span>';
    } else if(empty($activator)){
		$msg = '<span class="badge bg-danger">'.'Activator Pin is Required!'.'</span>';
	} else if(strlen($_POST['activator']) < 16){
		$msg = '<span class="badge bg-danger">'.'Activator Pin must be up to 16 Digits'.'</span>';
    } else {
        $sql1 = "SELECT * FROM sch_pin WHERE pin_code='$activator' AND status!='1' LIMIT 1";
        $result = mysqli_query($conn, $sql1);
		$row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) === 1) {
				if ($row['pin_code'] == $activator) {
						mysqli_query($conn,"UPDATE `sch_users` SET `status` = '1' WHERE `sch_users`.`sch_id` = $sch_id");
						mysqli_query($conn,"UPDATE `sch_info` SET `sch_year` = '$sch_year',`status` = '1',`sch_year2` = '$sch_year2' WHERE `sch_info`.`sch_id` = $sch_id");
						mysqli_query($conn,"UPDATE `sch_pin` SET `status`='1',`sch_id`='$sch_id' WHERE `pin_code`='$activator'");
					$msg = '<span class="badge bg-success">'.'You have been Granted Access for the Next One Year'.'</span>';
						echo '<audio controls'.$autoplay.'hidden>
								<source src="audio/msg_subscribed_sms.mp3" type="audio/mpeg">
							</audio>';
					$url = (isset($_REQUEST['redirect'])) ? trim($_REQUEST['redirect']) : 'user_login.php';
					header('Refresh: 10; URL=' . $url);
					} else { 
					$msg = '<span class="badge bg-danger">'.'Invalid Activator!'.'</span>';
					$msg_toastr = '<script>toastr.error("Invalid Activator!")</script>';
			} 
		} else {
			$msg = '<span class="badge bg-danger">'.'Invalid Activator!'.'<span>';	
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/main.min.css">
</head>
<style>
	.enterpin {
		display: none;
	}
</style>
<body style="background: url(assets/img/bg2.png);">
	<div align="center" style="width:100%;margin:0 auto; margin-top:150px; margin-bottom:80px; max-width:500px; border:0px solid #CCC;">
		<div class="card card-danger" style="color:; margin:auto; width:auto;">
			<div class="card-header" style="text-align:left;">Enter Pin! <i class="fa fa-key" style="float:right;margin-top:0px;margin-bottom:0px;"></i></div>
			<div align="center" style=" margin:auto; padding:15px;">
				<div style="width:auto; height:auto; padding:5px;"><?php if (isset($msg)) { echo $msg;}?></div>
				<div class="col-md-12" style="width:450px;">
					<button class="btn btn-primary" id="payWithCardBtn"><i class="fa fa-credit-card"></i> Pay with Card</button>
					<button class="btn btn-primary"id="enterPin"><i class="fa fa-key"></i> Enter Activation Pin</button>
					<hr>
					<div id="payWithPinContent" class="enterpin">
						<form action="" method="post">
							<select name="sch_id" id="sel_school" style="width:100%;" class="form-control">
								<option value="">Select School</option>
									<?php
									$result = mysqli_query($conn,"SELECT * FROM sch_info WHERE status = '0'");
									while ($row = mysqli_fetch_array($result)){ ?>
									<option value="<?php echo $row["sch_id"];?>"><?php echo $row["sch_name"];?></option><?php } ?>
							</select>
							&nbsp;&nbsp;&nbsp;
							<table style="width:100%;">
								<tr>
									<td>
										<input name="activator" type="text" onkeypress="return isNumber(event)" value="" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="16" style="width:100%;" class="form-control" required/>
									</td>
									<script>
										function isNumber(evt) {
										evt = (evt) ? evt : window.event;
										var charCode = (evt.which) ? evt.which : evt.keyCode;
										if (charCode > 31 && (charCode < 48 || charCode > 57)) {
											return false;
										}
										return true;
									}
									</script>
									<td style="width:30%;">
										<!--input name="submit" type="submit" title="Enter" value="ENTER" style="width:100%;" class="btn btn-primary"/-->
										<button title="Enter" name="submit" type="submit" class="btn btn-primary" ><i class="fa fa-key"></i> ENTER </button>
									</td>
								</tr>
							</table><p>
							<!--div class="modal-footer">
								&nbsp;&nbsp;<a href="user_login" title="Back to Login" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> BACK </div></a>
								&nbsp;&nbsp;<a href="index" title="Exit" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"> EXIT &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div></a>
							</div--> 
						</form>
					</div>
					<div id="payWithCardContent" class="onlinepayment">
						<form id="paymentForm" method="post">
							<select id="year" class="form-control" required/>
								<option value="">Select number of year</option>
								<option value="0.5">6 Months</option>
								<option value="1">1 Year</option>
								<option value="2">2 Years</option>
							</select>
							<table style="width:100;">
								<tr>
									<td>
										<input id="amount" type="text" value="" disabled class="form-control" required/>
										<input type="hidden" id="email-address" value="<?php echo getUsername($sch_id);?>" />
										<input type="hidden" id="first-name" value="<?php echo getFirstname($user_id);?>"/>
										<input type="hidden" id="last-name"value="<?php echo getLastname($user_id);?>"/>
										<!--input type="hidden" id="amount" value="30000" /-->
										<input type="hidden" id="reference" value="<?php echo 'NT-'.(rand(100,999).'-'.rand(100,999).'-'.rand(100,999));?>" maxlength="15"/>
									</td>
									<td style="width:30%;">
										<input type="hidden" id="message" value="Web Access Fee"/><p>
										&nbsp;&nbsp;&nbsp;<button type="submit" onclick="payWithPaystack()" class="btn btn-primary"><i class="fa fa-credit-card"></i> PAY NOW </button>
										 <!--input type="submit" value="PAY NOW" class="form-control btn btn-primary" onclick="payWithPaystack()"-->
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p align="center" style="padding:0px;font-size:13px;padding-bottom:50px; padding-bottom:30px;text-align:center;color:white;">
	Copyright © 2024 SMS.  Powered by Niel Technologies +2348145162722. All rights reserved. 
	&nbsp;</p>
</body>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
	function removeSymbolsAndSpaces(number) {
	// Convert the input to a string and remove spaces, commas, and currency symbols
	const cleanedNumber = String(number).replace(/[^\d.-]/g, '');

	// Convert the cleaned string back to a number and return it
	return Number(cleanedNumber);
	}

	function Percent(value) {
		return (0.5/100) * value;
	}

	const yearSelect = document.getElementById('year');
	const amountInput = document.getElementById('amount');

	yearSelect.addEventListener('change', () => {
	  const selectedYear = parseInt(yearSelect.value);
	  const amount = selectedYear * 30000;
	  amountInput.value = amount;
	});

	const paymentForm = document.getElementById('paymentForm');
	paymentForm.addEventListener("submit", payWithPaystack, false);
	function payWithPaystack(e) {
	  e.preventDefault();

		var reference = document.getElementById("reference").value;
		//var amount = document.getElementById("amount").value;
		var processed_amount = removeSymbolsAndSpaces(amount);
		var x = Percent(processed_amount);
		
	  let handler = PaystackPop.setup({
		key: 'pk_test_8e5536652ca115d577a896db088ec04aead9da75',
		email: document.getElementById("email-address").value,
		amount: (processed_amount) * 100 + x * 100,
		lastname: document.getElementById("last-name").value,
		firstname: document.getElementById("first-name").value,
		message: document.getElementById("message").value,
		ref: document.getElementById("reference").value,
		// label: "Optional string that replaces customer email"
		onClose: function(){
			//toastr.error("You closed the window, and for this reason we couldn't validate your payment");
			window.location = "/sms/subscription_history.php";
		  alert('Window closed.');
		},
		callback: function(response){
		  let message = 'Payment complete! Reference: ' + response.reference;
		  //alert(message);
		  window.location = "/sms/junior/activate?reference=" + response.reference + "&uid=" + uid;
		}
	  });

	  handler.openIframe();
	}
</script>
<script>
	const enterPin = document.getElementById('enterPin');
	const payWithCardBtn = document.getElementById('payWithCardBtn');
	const payWithPinContent = document.getElementById('payWithPinContent');
	const payWithCardContent = document.getElementById('payWithCardContent');

	enterPin.addEventListener('click', () => {
		payWithPinContent.style.display = 'block';
		payWithCardContent.style.display = 'none';
	});

	payWithCardBtn.addEventListener('click', () => {
		payWithPinContent.style.display = 'none';
		payWithCardContent.style.display = 'block';
	});
</script>
<script>
  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
	}
</script>
<style>
.water_mark {
	position: absolute;
	width: 700px;
	height: 700px;
	top: 50%;
	left: 50%;
	opacity:0.05;
	transform: translate(-50%, -50%);
	background-color: rgba(255, 255, 255, 0.1);
	padding: 0px;
	display: list-item;
	list-style-position: inside;
	pointer-events: none;
}
.water_mark::before {
	content: "";
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background-color: transparent;
	pointer-events: auto;
}
</style>
</html>
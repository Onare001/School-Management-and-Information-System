<?php 
// My Functions; Daniel Tayo Onare;
ini_set('zlib.output_compression', 'On');
date_default_timezone_set('Africa/Lagos');

function convertDateToYYYYMM($dateString) {
    // Convert the date string to a DateTime object
    $dateTime = new DateTime($dateString);

    // Format the DateTime object as "YYYYMM"
    $formattedDate = $dateTime->format("Ym");

    return $formattedDate;
}

function LockSchool($sch_id, $sch_year, $sch_year2, $privilege){
	include 'include/connection.php';
	if (date("Y"."m") >= base64_decode(($sch_year))) {
		mysqli_query($conn,"UPDATE `sch_users` SET `status` = '0' WHERE `sch_users`.`sch_id` = $sch_id");
		mysqli_query($conn,"UPDATE `sch_info` SET `status` = '0' WHERE `sch_info`.`sch_id` = $sch_id");
		if ($privilege == '1'){
			$redirect = header('location: user_alert');
			exit();
		} else if (($privilege == '2') || ($privilege > '4' && $privilege < '9')) {
			$redirect = header('location: user_alert');
			exit();
		} else if ($privilege == '9'){
			$redirect = header('location: user_alert');
			exit();
		} else if ($privilege == '3'){
			$redirect = ''; //header('location: user_alert');
			exit();
		} else if ($privilege == '10'){
			$redirect = ''; //header('location: user_alert');
			exit();
		} else {
			$redirect = '';
		}
	} else if (date("Y"."m") < base64_decode(($sch_year2))) {
		$redirect = header('location: logout');
		//exit();
	} else {
		$redirect = '';
	}
	return $redirect;
}

function sch_reminder($sch_year, $sch_year2){
    $current_date = date("Y"."m");
	$exp = base64_decode(($sch_year));
    
    $diff_months = ($exp - $current_date ) ;

    if ($diff_months <= 3) {
        $msg = 'Reminder: Your subscription expires on ' . DateTime::createFromFormat("Ym", $exp)->format("F Y") .'.';
        $alert = '<script>toastr.warning("' . $msg . '")</script>'; 
    } else if (date("Y"."m") < base64_decode(($sch_year2))) {
		$msg = 'Your server date is behind, This will cause some features to malfunction.';
        $alert = '<script>toastr.error("' . $msg . '")</script>';
		/* $redir = 'logout';
		header('Refresh: 6; URL=' . $redir); */
	} else {
		return '';
	}
	return $alert;
}

function encrypt($value) {
	// Generate a random encryption key
	$key = random_bytes(16);

	// Encrypt the value with the key using AES-256-CBC encryption
	$iv = random_bytes(16);
	$encrypted_value = openssl_encrypt($value, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

	// Combine the encrypted value and IV into a single string
	$combined_value = $encrypted_value . $iv . $key;

	// Encode the combined value with hexadecimal encoding
	$encoded_value = bin2hex($combined_value);

	return $encoded_value;
}

function decrypt($encoded_value) {
	// Decode the encoded value from hexadecimal encoding
	$combined_value = hex2bin($encoded_value);

	// Split the combined value into the encrypted value, IV, and key
	$encrypted_value = substr($combined_value, 0, -32);
	$iv = substr($combined_value, -32, 16);
	$key = substr($combined_value, -16);

	// Decrypt the value using AES-256-CBC decryption
	$decrypted_value = openssl_decrypt($encrypted_value, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

	return $decrypted_value;
}

//alternate encoder
function encrypt1($sData){
	$id = (double)$sData * 525325.24;
	$encrypt = base64_encode($id);
	return $encrypt;
}

function decrypt1($sData){
	$url_id = base64_decode($sData);
	$decrypt = (double)$url_id / 525325.24;
	return $decrypt;
}
/*Just Some Site Constant*/
if (1==1){
	$autoplay = 'autoplay';
} else {
	$autoplay = '';
}	

//Get Current Session
include 'include/connection.php';
$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
if ($row = mysqli_fetch_array($result)){
	$current_session = $row['session'];
	$csid = $row['sid'];
} else {
	$current_session = 'Annual Recess';
	$csid = "0";
}
//Get Current Term
$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
if ($row = mysqli_fetch_array($result)){
	$current_term = $row['term_title'];
	$ctid = $row['term_id'];
} else {
	$current_term = 'Holiday';
	$ctid = "0";
}

$cweek = '2';
/*End Just some Site Constants*/

// Get Payment Status for Current Term and Session
function getPaymentstatus($user_id, $ctid, $csid){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT payment_status FROM ledger_info WHERE user_id='$user_id' AND term_id='$ctid' AND sid='$csid' AND payment_type='1'");
    $row = mysqli_fetch_array($result);
    $status = $row['payment_status'];
    return $status;
}

function getPaymentStatusValue($payment_status){
if ($payment_status == 1){
	$pstatus_v = '<span class="badge bg-warning">Outstanding</span>';
} else if ($payment_status == 2){
	$pstatus_v = '<span class="badge bg-danger">Denied</span>';
} else if ($payment_status == 3){
	$pstatus_v = '<span class="badge bg-success">Paid</span>';
} else {
	$pstatus_v = '<span class="badge bg-danger">Not paid</span>';
	}
	return $pstatus_v;
}

// Get Payment Status
function getMPaymentstatus($user_id, $tid, $sid, $pt){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT payment_status FROM ledger_info WHERE user_id='$user_id' AND term_id='$tid' AND sid='$sid' AND payment_type='$pt'");
    $row = mysqli_fetch_array($result);
    $Mstatus = $row['payment_status'];
    return $Mstatus;
}

function getCPaymentStatus($uid, $tid, $sid, $pt){
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
	return $paymentstatus;
}

// Get Payment Transaction id
function getTranXid($user_id, $tid, $sid, $pt){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT transaction_id FROM ledger_info WHERE user_id='$user_id' AND term_id='$tid' AND sid='$sid' AND payment_type='$pt'");
	$row = mysqli_fetch_array($result);
    $TranXid = $row['transaction_id'];
    return $TranXid;
}

// Get Payment Teller Number
function getTellerno($user_id, $tid, $sid, $pt){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT receipt_no FROM ledger_info WHERE user_id='$user_id' AND term_id='$tid' AND sid='$sid' AND payment_type='$pt'");
    $row = mysqli_fetch_array($result);
    $Teller_no = $row['receipt_no'];
    return $Teller_no;
}

// Get Amount Paid For Current Term and Session
function getAmountPaid($user_id, $tid, $sid, $pt){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT amount_paid FROM ledger_info WHERE user_id='$user_id' AND term_id='$tid' AND sid='$sid' AND payment_type='$pt'");
    $row = mysqli_fetch_array($result);
    $Amount_paid = number_format($row['amount_paid']);
    return $Amount_paid;
}

// Get Balance For Current Term and Session
function getBalance($user_id, $tid, $sid, $pt){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT balance FROM ledger_info WHERE user_id='$user_id' AND term_id='$tid' AND sid='$sid' AND payment_type='$pt'");
    $row = mysqli_fetch_array($result);
    $Balance = number_format($row['balance']);
    return $Balance;
}

function getOutstandingFee($sch_id, $pt, $term, $session){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT balance, SUM(balance) AS outstanding FROM ledger_info WHERE sch_id='$sch_id' AND payment_type='$pt' AND term_id='$term' AND sid='$session'");
	$row = mysqli_fetch_array($result);
	$outstanding_fee = $row['outstanding'];
	return $outstanding_fee;
}

function getStuOutstandingFee($sch_id, $uid, $pt){
	include 'include/connection.php';
	if($pt == '1'){
		$result = mysqli_query($conn,"SELECT balance, SUM(balance) AS outstanding FROM ledger_info WHERE sch_id='$sch_id' AND user_id='$uid' AND payment_type='1'");
		$row = mysqli_fetch_array($result);
		$outstanding_fee = $row['outstanding'];//School Fee Only
	} else {
		$result = mysqli_query($conn,"SELECT balance, SUM(balance) AS outstanding FROM ledger_info WHERE sch_id='$sch_id' AND user_id='$uid'  AND payment_type!='1'");
		$row = mysqli_fetch_array($result);
		$outstanding_fee = $row['outstanding'];//Others
	}
	return $outstanding_fee;
}

function getNoTermSpent($sch_id, $uid){
	include 'include/connection.php';
	$result1 = mysqli_query($conn,"SELECT *, COUNT(aggregate_score) AS first_term FROM score_info WHERE sch_id='$sch_id' AND user_id='$uid' AND term_id='1' GROUP BY class_id");
	$first_term = mysqli_fetch_array($result1);
	
	$result2 = mysqli_query($conn,"SELECT DISTINCT *, COUNT(aggregate_score) AS second_term FROM score_info WHERE sch_id='$sch_id' AND user_id='$uid' AND term_id='2' GROUP BY class_id");
	$second_term = mysqli_fetch_array($result2);

	$result3 = mysqli_query($conn,"SELECT DISTINCT *, COUNT(aggregate_score) AS third_term FROM score_info WHERE sch_id='$sch_id' AND user_id='$uid' AND term_id='3' GROUP BY class_id");
	$third_term = mysqli_fetch_array($result3);

	$total_no_of_terms = $first_term['first_term'] /*+ $second_term['second_term'] + $third_term['third_term']*/;
	
	if ($total_no_of_terms == NULL){
		$no_of_terms = '0';
	} else {
		$no_of_terms = $total_no_of_terms;
	}
	return $no_of_terms;
}

function getTotalPaid($sch_id, $pt, $term, $session){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT amount_paid, SUM(Amount_paid) AS total_paid FROM ledger_info  WHERE sch_id='$sch_id' AND payment_type='$pt' AND term_id='$term' AND sid='$session'");
	$row = mysqli_fetch_array($result);
	$total_paid = $row['total_paid'];
	return $total_paid;
}

function getSubstatus($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT sch_year FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_year = $row['sch_year'];
    return $sch_year;
}

function getPaymentChannel($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT payment_channel FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$payment_channel = $row['payment_channel'];
    return $payment_channel;
}

function getSchname($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT sch_name FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_name = $row['sch_name'];
    return $sch_name;
}

function getSchmotto($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT sch_motto FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_motto = $row['sch_motto'];
    return $sch_motto;
}

function getSchphone($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT phone,other_phone FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_phone = $row['phone'].',&nbsp;'.$row['other_phone'];
    return $sch_phone;
}

function getSchAddress($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT sch_address FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_address = $row['sch_address'];
    return $sch_address;
}
			
function getSchfee($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT amount FROM payment_type WHERE sch_id = '$sch_id' AND payment_id='1'");
	$row = mysqli_fetch_array($result);
	$amount = number_format($row['amount']);
    return $amount;
}

function getSchlogo($sch_id){
	include 'include/connection.php';
	if ($sch_id == ""){
		$logo_Path = 'images/sch_logo/logo.jpg';

		// Read the image file content
		$imageData = file_get_contents($logo_Path);

		// Encode the image data as base64
		$base64Image = base64_encode($imageData);

		// Create the data URI for embedding the image
		$sch_logo = 'data:image/jpeg;base64,' . $base64Image;

		return $sch_logo;
	} else {
		$result = mysqli_query($conn,"SELECT sch_logo FROM sch_info WHERE sch_id = '$sch_id'");
		$row = mysqli_fetch_array($result);
		$sch_logo = $row['sch_logo'];
		$logo_Path = 'images/sch_logo/'.$sch_logo;	
		
		if (file_exists($logo_Path)){
			// Read the image file content
			$imageData = file_get_contents($logo_Path);

			// Encode the image data as base64
			$base64Image = base64_encode($imageData);

			// Create the data URI for embedding the image
			$sch_logo = 'data:image/jpeg;base64,' . $base64Image;
			
			return $sch_logo;
		} else {
			$logo_Path = 'images/sch_logo/sms_logo.png';
			
			// Read the image file content
			$imageData = file_get_contents($logo_Path);

			// Encode the image data as base64
			$base64Image = base64_encode($imageData);

			// Create tshe data URI for embedding the image
			$sch_logo = 'data:image/jpeg;base64,' . $base64Image;
			
			return $sch_logo;
		}	
	}
}

function getSchtheme($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT theme_code FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$theme_code = $row['theme_code'];
    return $theme_code;
}

function getSchSecretKey($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT secret_key FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$secret_key = $row['secret_key'];
    return $secret_key;
}

function getSchPublicKey($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT public_key FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$public_key = $row['public_key'];
    return $public_key;
}

function getResultStyle($sch_id){
	include 'include/connection.php';
	$res_design = mysqli_query($conn, "SELECT * FROM sch_info WHERE sch_id='$sch_id' LIMIT 1");
	$type = mysqli_fetch_assoc($res_design);
	$result_style = $type['result_type'];
    return $result_style;
}

function getSchAcronym($sch_id) {
  $school_name = getSchName($sch_id);
  $words = explode(" ", $school_name);
  $sch_acronym = "";
  foreach ($words as $word) {
    $sch_acronym .= strtoupper(substr($word, 0, 1));
	$sch_acronym = substr($sch_acronym, 0, 3);
  }
  return $sch_acronym;
}

function getSchSection($sid){
		/*Getting School Type*/
	if (getClass($sid) == "JS 1"){
		$sch_type = 'Junior Secondary School';
	} else if(getClass($sid) == "SS 1") {
		$sch_type = 'Senior Secondary School';
	} else if(getClass($sid) == "Nursery 1" || getClass($cid) == "Primary 1"){
		$sch_type = 'Nusery & Primary School';
	} else {
		$sch_type = '';
	}
	return $sch_type;
}

function getFileNo($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT file_no FROM staff_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$file_no = $row['file_no'];
    return $file_no;
}

function processNo($num) {
	if ($num < 10) {
		$number = "00" . $num;
	} else if ($num >= 10 && $num < 100) {
		$number = "0" . $num;
	} /*else if ($num >= 100 && < 1000) {
		$number = "00000" . $num;
	}*/ else{
		$number = $num;
	}
  return $number;
}

function ScoreFormat($num) {
	if ($num < 10) {
		$score = "0" . $num;
	} else if ($num >= 10 && $num < 100) {
		$score = $num;
	} else{
		$score = $num;
	}
  return $score;
}

function generateRandomAlphabetCombination() {
	$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomIndex1 = rand(0, strlen($alphabet) - 1);
	$randomIndex2 = rand(0, strlen($alphabet) - 1);
	$randomCombination = $alphabet[$randomIndex1] . $alphabet[$randomIndex2];
	return $randomCombination;
}

//$randomLetters = generateRandomAlphabetCombination();
//echo $randomLetters;

function generateFileNo($sch_id){
	include 'include/connection.php';	
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS serial_no FROM sch_users WHERE sch_id = '$sch_id' AND (priv_id = 2 OR priv_id>4 && priv_id<10)");
	$row = mysqli_fetch_array($result);
	$sn = $row['serial_no'];
	$file_no = strtoupper(getSchAcronym($sch_id)).'/'.date("Y").'/'.processNo($sn);//generating file no
    return $file_no;
}

function generateStudentID($sch_id, $class_id, $cat_id, $rand){
	include 'include/connection.php';
	//To ensure counting continue from the last entered one
	$result = mysqli_query($conn,"SELECT username FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id = '$sch_id' AND stdnt_info.class_id='$class_id' AND stdnt_info.cat_id='$cat_id' ORDER BY stdnt_info.stdnt_id DESC");//AND stdnt_info.status_id='1'
	$row = mysqli_fetch_assoc($result);
	
	$prefix = 'SMS';
	
	/*Getting School Type*/
	if (getClass(1) == "JS 1"){
		$sch_type = 'JS';
		$sn = substr($row['username'],12,15) + 1;//Last Username
	} else if(getClass(1) == "SS 1") {
		$sch_type = 'SS';
		$sn = substr($row['username'],12,15) + 1;//Last Username
	} else if(getClass(1) == "Nursery 1" || getClass(1) == "Primary 1"){
		$sch_type = 'NPS';
		$sn = substr($row['username'],13,16) + 1;//Last Username
	} else {
		$sch_type = '';
		//$sn = substr($row['username'],12,15) + 1;//Last Username
	}
	
	if ($rand == '1'){
		$randx = rand(100,999);
	} else {
		$randx = '***';
	}
	
	$studentID =  addslashes($prefix.$sch_id.'/'.$sch_type.$randx.getCategory($cat_id).'/'.processNo($sn));
    return $studentID;
}

function getFirstname($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT first_name FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$first_name = $row['first_name'];
    return $first_name;
}

function getLastname($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT last_name FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$last_name = $row['last_name'];
    return $last_name;
}

function getUsername($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT username FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$username = $row['username'];
    return $username;
}

function getAdmissionNo($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT admn_no FROM stdnt_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$admission_No = $row['admn_no'];
    return $admission_No;
}

function getAge($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT dob FROM stdnt_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
		if (!empty($row['dob'])){
			$check_age = date("Y") - substr($row['dob'],0,4).'&nbsp;'.'years';
				if ($check_age <= 1){
					$age = date("Y") - substr($row['dob'],0,4).'&nbsp;'.'year';
				} else {
					$age = date("Y") - substr($row['dob'],0,4).'&nbsp;'.'years';
				}
		} else {
			$age = "";
		}
    return $age;
}

function getDOB($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT dob FROM stdnt_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$dob = $row['dob'];
    return $dob;
}

function getStudentGender($user_id){
	include 'include/connection.php';
	$procGender = mysqli_query($conn,"SELECT sex_id FROM stdnt_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($procGender);
	$userGender = $row['sex_id'];
	return $userGender;
}

function PreparePassportDir($user_id){
	include 'include/connection.php';
	$procPriv = mysqli_query($conn,"SELECT priv_id FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($procPriv);
	$user_type = $row['priv_id'];
	
	if (($user_type == '1') || ($user_type == '2') || ($user_type > 3)){
		$passp_dir = 'passport/staff/';
	} else if ($user_type == '3'){
		$passp_dir = 'passport/student/';
	} else {
		$passp_dir = 'passport/avatars/';
	}
	return $passp_dir;
}

function getPassport($user_id){
	include 'include/connection.php';
	$procPriv = mysqli_query($conn,"SELECT priv_id FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($procPriv);
	$user_type = $row['priv_id'];
	
	/* if ($user_type == '1' || $user_type == '2' || $user_type > 3){
		$passp_dir = PreparePassportDir($user_id);//'passport/staff/';
	} else if ($user_type == '3'){
		$passp_dir = PreparePassportDir($user_id);//'passport/student/';
	} else {
		$passp_dir = PreparePassportDir($user_id);//'./passport/avatars';
	} */
	
	$passp_dir = PreparePassportDir($user_id);//'./passport/avatars';
	
	if ($user_id == ""){
		$Passport_Path = $passp_dir.'/avatar.jpg';

		// Read the image file content
		$imageData = file_get_contents($Passport_Path);

		// Encode the image data as base64
		$base64Image = base64_encode($imageData);

		// Create the data URI for embedding the image
		$passport = 'data:image/jpeg;base64,' . $base64Image;

		return $passport;
	} else {
		$result = mysqli_query($conn,"SELECT passport FROM sch_users WHERE user_id = '$user_id'");
		$row = mysqli_fetch_array($result);
		$passport = $row['passport'];
		$Passport_Path = $passp_dir.'/'.$passport; //'../passport/avatars/'.$passport;	

		if (file_exists($Passport_Path)){
			// Read the image file content
			$imageData = file_get_contents($Passport_Path);

			// Encode the image data as base64
			$base64Image = base64_encode($imageData);

			// Create the data URI for embedding the image
			$passport = 'data:image/jpeg;base64,' . $base64Image;
			
			return $passport;
		} else {
			if ($user_type == '1' || $user_type == '2' || $user_type > 3){
				$procGender = mysqli_query($conn,"SELECT sex_id FROM staff_info WHERE user_id = '$user_id'");
				$row = mysqli_fetch_array($procGender);
				$userGender = $row['sex_id'];
			} else if ($user_type == '3'){
				$procGender = mysqli_query($conn,"SELECT sex_id FROM stdnt_info WHERE user_id = '$user_id'");
				$row = mysqli_fetch_array($procGender);
				$userGender = $row['sex_id'];
			} else {
				$userGender = '';
			}
			
			if ($userGender == '1'){
				$Passport_Path = 'passport/avatars/avatar_male.jpg';
			} else if ($userGender == '2'){
				$Passport_Path = 'passport/avatars/avatar_female.jpg';
			} else {
				$Passport_Path = 'passport/avatars/avatar.jpg';
			}
			
			// Read the image file content
			$imageData = file_get_contents($Passport_Path);

			// Encode the image data as base64
			$base64Image = base64_encode($imageData);

			// Create the data URI for embedding the image
			$passport = 'data:image/jpeg;base64,' . $base64Image;
			
			return $passport;
		}
	}
}

function getStatus($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT status_id FROM stdnt_info WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	if ($row['status_id'] == 1){
		$status = "Active";
		$status_color = "success";
	} else if ($row['status_id'] == 0) {
		$status = "Inactive";
		$status_color = "danger";
	} else {
		$status = "Graduated";
		$status_color = "primary";
	}
    return $status;
}

function getLastlogintime($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT last_login FROM sch_users WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	$last_login = $row['last_login'];
    return $last_login;
}

function getRempin($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT status FROM pin_details WHERE user_id = '$user_id' AND status < 5 LIMIT 1");
	$row = mysqli_fetch_array($result);
	$status = 5 - $row['status'];
    return $status;
}

function getMTime($message_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT datetime FROM messages WHERE message_id = '$message_id'");
	$row = mysqli_fetch_array($result);
	$datetime = $row['datetime'];
    return $datetime;
}

function getUserid($receiver){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id FROM sch_users WHERE username = '$receiver'");
	while ($row = mysqli_fetch_array($result)){
	$receiver = $row['user_id'];
    return $receiver;
	}
}

function getUserPassword($email){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT password FROM sch_users WHERE username = '$email'");
	$row = mysqli_fetch_array($result);
	$password = $row['password'];
    return $password;
}

function getStafftype($type_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT staff_type FROM staff_type_info WHERE type_id = '$type_id'");
	if($result){
	$row = mysqli_fetch_array($result);
	$staff_type = $row['staff_type'];
	} else {
		$staff_type = mysqli_error($conn);
	}
    return $staff_type;
}

function getDept($dept_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT department FROM department WHERE dept_id = '$dept_id'");
	$row = mysqli_fetch_array($result);
	$department = $row['department'];
    return $department;
}

function getClub($club_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT club_name FROM club_info WHERE club_id = '$club_id'");
	$row = mysqli_fetch_array($result);
	$club = $row['club_name'];
    return $club;
}

function getHouse($house_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT house FROM house_info WHERE house_id = '$house_id'");
	$row = mysqli_fetch_array($result);
	$house = $row['house'];
    return $house;
}

function getHouse_color($house_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT house FROM house_info WHERE house_id = '$house_id'");
	$row = mysqli_fetch_array($result);
	$house = '<span class="float-right badge bg-'.$row['house_color'].'">'.$row['house'].'</span>';
    return $house;
}

function getGender($sex_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT gender FROM gender_info WHERE sex_id = '$sex_id'");
	$row = mysqli_fetch_array($result);
	$gender = $row['gender'];
    return $gender;
}

function getMaritalstatus($status_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT m_status FROM m_status_info WHERE status_id = '$status_id'");
	$row = mysqli_fetch_array($result);
	$m_status = $row['m_status'];
    return $m_status;
}

function getStaffposition($post_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT position FROM post_info WHERE post_id = '$post_id'");
	$row = mysqli_fetch_array($result);
	$position = $row['position'];
    return $position;
}

function getRank($rank_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT rank FROM rank_info WHERE rank_id = '$rank_id'");
	$row = mysqli_fetch_array($result);
	$rank = $row['rank'];
    return $rank;
}

function getBank($bank_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT bank FROM bank_info WHERE bank_id = '$bank_id'");
	if ($result){
		$row = mysqli_fetch_array($result);
		$bank = $row['bank'];
	} else {
		$bank = mysqli_error($conn);
	}
    return $bank;
}

function getSchAccDet($sch_id,$req){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT * FROM account_details WHERE sch_id = '$sch_id'");
	if ($result){
		$row = mysqli_fetch_array($result);
		if ($req == 'number'){
			$detail = $row['acc_no'];
		} else if ($req == 'name'){
			$detail = $row['acc_name'];
		} else if ($req == 'bank'){
			$detail = getBank($row['bank_id']);
		}
	} else {
		$detail = mysqli_error($conn);
	}
    return $detail;
}

function getQualification($qual_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT qualification FROM qual_info WHERE qual_id = '$qual_id'");
	$row = mysqli_fetch_array($result);
	$qualification = $row['qualification'];
    return $qualification;
}

function getState($state_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT state_name FROM state_info WHERE state_id = '$state_id'");
	if ($result){
		$row = mysqli_fetch_array($result);
		$state_name = $row['state_name'];
	} else {
		$state_name = mysqli_error($conn);
	}
    return $state_name;
}

function getLga($lg_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT name FROM local_governments WHERE lg_id = '$lg_id'");
	$row = mysqli_fetch_array($result);
	$lga = $row['name'];
    return $lga;
}

function getPriviledge($priviledge){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT privilege FROM privileges WHERE privilege_id = '$priviledge'");
	$row = mysqli_fetch_array($result);
	$priviledge = $row['privilege'];
    return $priviledge;
}

function getSubject($subj_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT subj_title FROM subj_info WHERE subj_id = '$subj_id'");
	if ($result){
		$row = mysqli_fetch_array($result);
		$subj_title = $row['subj_title'];
	} else {
		$subj_title = mysqli_error($conn);
	}
    return $subj_title;
}

function getSubjectAbbr($subj_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT subj_abr FROM subj_info WHERE subj_id = '$subj_id'");
	$row = mysqli_fetch_array($result);
	$subj_abbr = $row['subj_abr'];
    return $subj_abbr;
}

function getRSubject($subj_id){
    include 'include/connection.php';
    $result = mysqli_query($conn, "SELECT subj_title, subj_abr FROM subj_info WHERE subj_id = '$subj_id'");
    
    if ($result) {
        $row = mysqli_fetch_array($result);
        $subj_title = $row['subj_title'];
        $subj_abbr = $row['subj_abr'];
        
        // Check the length of subj_title and return subj_abbr if greater than 15 characters
        if (strlen($subj_title) > 20) {
            return $subj_abbr;
        } else {
            return $subj_title;
        }
    } else {
        return mysqli_error($conn);
    }
}

function getRegSubject($user_id, $subj_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT * FROM registered_subject WHERE user_id = '$user_id' AND subj_id = '$subj_id'");
	if (mysqli_num_rows($result) == true){
		$subj_status = 'checked';
	} else {
		$subj_status = '';
	}
    return $subj_status;
}

function getSubjectType($subj_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT subj_type FROM subj_info WHERE subj_id = '$subj_id'");
	$row = mysqli_fetch_array($result);
	$subj_type = $row['subj_type'];
    return $subj_type;
}

function getSubjectTeacher($sch_id, $cid, $cat_id, $subj_id, $req) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id FROM staff_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$cat_id' AND subj_id='$subj_id'");
    $row = mysqli_fetch_array($result);
	if ($req == 'name'){
		$teacher = getLastname($row['user_id']).'&nbsp;'.getFirstName($row['user_id']);
	} else {
		$teacher = $row['user_id'];
	}
    return $teacher;
}

function getClass($class_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT class_name FROM class_info WHERE class_id = '$class_id'");
	$row = mysqli_fetch_array($result);
	$class_name = $row['class_name'];
    return $class_name;
}

//Setting Class Limit for Each School Type
if (getClass(1) == 'JS 1'){#Junior Secondary style="margin-left:20px;"
	$class_limit = '4';
	$sch_type = 'FOR JUNIOR SECONDARY SCHOOL ONLY';
	$sch_type_label = '<i class="bg badge-danger">&nbsp;<i class="fa fa-square"></i> <i class="fa fa-square"></i>&nbsp;Junior Secondary School&nbsp;<i class="fa fa-square"></i>&nbsp;&nbsp;</i>&nbsp;';
	$sch_color = 'primary';
} else if (getClass(1) == 'SS 1') {#Senior Secondary
	$class_limit = '4';
	$sch_type = 'FOR SENIOR SECONDARY SCHOOL ONLY';
	$sch_type_label = '<i class="bg badge-danger">&nbsp;<i class="fa fa-square"></i> <i class="fa fa-square"></i>&nbsp;Senior Secondary School&nbsp;<i class="fa fa-square"></i>&nbsp;&nbsp;</i>&nbsp;';
	$sch_color = 'warning';
} else if (getClass(1) == 'Nursery 1'){#Nursery & Primary School
	$class_limit = '9';
	$sch_type = 'FOR NURSERY & PRIMARY SCHOOL ONLY';
	$sch_type_label = '<i class="bg badge-danger">&nbsp;<i class="fa fa-square"></i> <i class="fa fa-square"></i>&nbsp;Nursery & Primary School&nbsp;<i class="fa fa-square"></i>&nbsp;&nbsp;</i>&nbsp;';
	$sch_color = 'danger';
} else if (getClass(1) == 'Primary 1'){#Primary School
	$class_limit = '7';
	$sch_type = 'FOR PRIMARY SCHOOL ONLY';
	$sch_type_label = '<i class="bg badge-danger">&nbsp;<i class="fa fa-square"></i> <i class="fa fa-square"></i>&nbsp;Primary School&nbsp;<i class="fa fa-square"></i>&nbsp;&nbsp;</i>&nbsp;';
	$sch_color = 'danger';
} else {
	$class_limit = '';
	$sch_type = '';
	$sch_type_label = '';
	$sch_color = 'primary';
}

function getCategory($cat_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT category FROM class_cat WHERE cat_id = '$cat_id'");
	$row = mysqli_fetch_array($result);
	$category = $row['category'];
    return $category;
}

function getBloodgroup($bld_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT * FROM blood_info WHERE bld_id = '$bld_id'");
	$row = mysqli_fetch_array($result);
	$group = $row['group'];
    return $group;
}

function getGenotype($geno_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT gtype FROM genotype_info WHERE geno_id = '$geno_id'");
	$row = mysqli_fetch_array($result);
	$genotype = $row['gtype'];
    return $genotype;
}

function getStudenttype($type_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT student_type FROM student_type WHERE type_id = '$type_id'");
	$row = mysqli_fetch_array($result);
	$studenttype = $row['student_type'];
    return $studenttype;
}

function getYear($year_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT year_title FROM year_info WHERE year_id = '$year_id'");
	if ($result){
		$row = mysqli_fetch_array($result);
		$year_title = $row['year_title'];
	} else {
		$year_title = mysqli_error($conn);
	}
    return $year_title;
}

function getTerm($term_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT term_title FROM term_info WHERE term_id = '$term_id'");
	$row = mysqli_fetch_array($result);
	$term_title = $row['term_title'];
    return $term_title;
}

function getSession($sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT session FROM session_info WHERE sid = '$sid'");
	$row = mysqli_fetch_array($result);
	$session = $row['session'];
    return $session;
}

function getReligion($rel_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT religion FROM religion_info WHERE rel_id = '$rel_id'");
	$row = mysqli_fetch_array($result);
	$religion = $row['religion'];
    return $religion;
}

function getNumStdnt($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numstdnt FROM stdnt_info WHERE sch_id = '$sch_id' AND status_id='1'");
	$row = mysqli_fetch_array($result);
	$numstdnt = $row['numstdnt'];
	return $numstdnt;
}

function getTotalGraduated($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numgrad FROM stdnt_info WHERE sch_id = '$sch_id' AND class_id>3 AND status_id!='1'");
	$row = mysqli_fetch_array($result);
	$numgrad = $row['numgrad'];
	return $numgrad;
}

function getGradYear($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT yid FROM stdnt_info WHERE yid <> 0 AND sch_id = '$sch_id' AND class_id>3 AND status_id!='1' ORDER BY ABS(yid) LIMIT 1");
	$row = mysqli_fetch_array($result);
	$gradYear = $row['yid'];
	return $gradYear;
}

function getTotal_in_class($sch_id,$class_id,$cat_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_in_class FROM stdnt_info WHERE sch_id = '$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND status_id!='0'");
	$row = mysqli_fetch_array($result);
	$num_in_class = $row['num_in_class'];
	return $num_in_class;
}

function getNumMale($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS nummale FROM stdnt_info WHERE sch_id = '$sch_id' AND status_id='1' AND sex_id='1'");
	$row = mysqli_fetch_array($result);
	$nummale = $row['nummale'];
	return $nummale;
}

function getNumFemale($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numfemale FROM stdnt_info WHERE sch_id = '$sch_id' AND status_id='1' AND sex_id='2'");
	$row = mysqli_fetch_array($result);
	$numfemale = $row['numfemale'];
	return $numfemale;
}

function getNumStaff($sch_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numstaff FROM staff_info WHERE sch_id = '$sch_id' GROUP BY user_id HAVING COUNT(user_id) > 0");
	$numstaff = mysqli_num_rows($result);
	return $numstaff;
}

function getNumClassMale($sch_id, $class_id, $cat_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numclassmale FROM stdnt_info WHERE sch_id = '$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND status_id='1' AND sex_id='1'");
	$row = mysqli_fetch_array($result);
	$numclassmale = $row['numclassmale'];
	return $numclassmale;
}

function getNumClassFemale($sch_id, $class_id, $cat_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numclassfemale FROM stdnt_info WHERE sch_id = '$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND status_id='1' AND sex_id='2'");
	$row = mysqli_fetch_array($result);
	$numclassfemale = $row['numclassfemale'];
	return $numclassfemale;
}

function getNumStafftype($sch_id, $type_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numstafftype FROM staff_info WHERE sch_id = '$sch_id' AND type_id = '$type_id' GROUP BY user_id HAVING COUNT(user_id) > 0");
	$numstafftype = mysqli_num_rows($result);
	return $numstafftype;
}

function getNuminbox($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT receiver, COUNT(receiver) AS numrec FROM messages WHERE receiver = '$user_id' GROUP BY receiver HAVING COUNT(receiver) > 0");
	$row = mysqli_fetch_array($result);
	$numrec = $row['numrec'];
	return $numrec;
}

//Unread Messages
function getNumUinbox($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT receiver, COUNT(receiver) AS numurec FROM messages WHERE receiver = '$user_id' AND message_status = '1' GROUP BY receiver HAVING COUNT(receiver) > 0");
	$row = mysqli_fetch_array($result);
	$numurec = $row['numurec'];
	return $numurec;
}

function getNumsentbox($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT sender, COUNT(sender) AS numsend FROM messages WHERE sender = '$user_id' GROUP BY sender HAVING COUNT(sender) > 0");
	$row = mysqli_fetch_array($result);
	$numsend = $row['numsend'];
	return $numsend;
}

function getPaymenttype($payment_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT payment_type FROM payment_type WHERE payment_id = '$payment_id'");
	$row = mysqli_fetch_array($result);
	$payment_type = $row['payment_type'];
    return $payment_type;
}

function getAmount($payment_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT amount FROM payment_type WHERE payment_id = '$payment_id'");
	$row = mysqli_fetch_array($result);
	$amount = $row['amount'];
    return $amount;
}

// Count number of Paid
function getNumPaid($sch_id,$paymenttype,$session,$term){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numpaid FROM ledger_info WHERE sch_id='$sch_id' AND payment_type = '$paymenttype' AND sid = '$session' AND term_id = '$term' AND payment_status = '3'");
    $row = mysqli_fetch_array($result);
    $numpaid = $row['numpaid'];
    return $numpaid;
}

// Count number of UNPaid
function getUNNumPaid($sch_id,$paymenttype,$session,$term){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numUNpaid FROM stdnt_info WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND stdnt_info.user_id NOT IN (SELECT user_id FROM ledger_info WHERE ledger_info.term_id='$term' AND payment_type= '$paymenttype' AND ledger_info.sid='$session')");
    $row = mysqli_fetch_array($result);
    $numUNpaid = $row['numUNpaid'];
    return $numUNpaid;
}

// Count number of Outstanding
function getNumHPaid($sch_id,$paymenttype,$session,$term){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS numHpaid FROM ledger_info WHERE sch_id='$sch_id' AND payment_type = '$paymenttype' AND sid = '$session' AND term_id = '$term' AND payment_status = '1'");
    while ($row = mysqli_fetch_array($result)){
    $numHpaid = $row['numHpaid'];
    return $numHpaid;
}

// Count number of Classes
function getNumclass($sch_id){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT class_id, COUNT(class_id) AS numclass FROM class_info WHERE sch_id='$sch_id'");
    $row = mysqli_fetch_array($result);
    $numclass = $row['numclass'];
    return $numclass;
	}
}

function getHGST($sch_id, $cid, $did, $subj_id, $tid, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT score_id, MAX(total) AS max FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $max = $row['max'];
    return $max;
}

function getLWST($sch_id, $cid, $did, $subj_id, $tid, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT score_id, MIN(total) AS min FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    while ($row = mysqli_fetch_array($result)){
    $min = $row['min'];
    return $min;
	}
}

function getAVG($sch_id, $cid, $did, $subj_id, $tid, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT score_id, AVG(total) AS avg FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $average = $row['avg'];
    return $average;
}

// Count the number fail Grades
function getFail($sch_id, $cid, $did, $subj_id, $tid, $sid){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT score_id, COUNT(score_id) AS no_fail FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total < 39.5");
    $row = mysqli_fetch_array($result);
    $number_fail = $row['no_fail'];
    return $number_fail;
}

function getSubjPos($total, $sch_id, $cid, $did, $subj_id, $tid, $sid) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT subj_id, COUNT(subj_id) AS subj_pos FROM score_info WHERE total > '$total' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
	$subj_pos = $row['subj_pos'] + 1;
    return $subj_pos;
}

function getCumSubjPos($average, $sch_id, $cid, $did, $subj_id, $sid) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT subj_id, COUNT(subj_id) AS csubj_pos FROM cum_result WHERE average > '$average' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
	$csubj_pos = $row['csubj_pos'] + 1;
    return $csubj_pos;
}

function getStudentPos($total, $sch_id, $cid, $did, $tid, $sid) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT score_id, COUNT(DISTINCT user_id) AS stdnt_pos FROM score_info WHERE aggregate_score > '$total' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
	$stdnt_pos = $row['stdnt_pos'] + 1;
    return $stdnt_pos;
}

function getStudentcumPos($aggregate, $sch_id, $cid, $did, $sid) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT score_id, COUNT(DISTINCT user_id) AS stdnt_cum_pos FROM cum_result WHERE aggregate_score > '$aggregate' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $stdnt_cum_pos = $row['stdnt_cum_pos'] + 1;
    return $stdnt_cum_pos;
}

// Count the number fail Grades for student
function getStuFail($sch_id, $user_id, $cid, $did, $sid){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT score_id, COUNT(score_id) AS no_Stu_fail FROM cum_result WHERE sch_id='$sch_id' AND user_id='$user_id' AND class_id='$cid' AND cat_id='$did' AND sid='$sid' AND average < 39.5");
    $row = mysqli_fetch_array($result);
    $number_stu_fail = $row['no_Stu_fail'];
    return $number_stu_fail;
}

// Count the number pass Grades for student
function getStuPass($sch_id, $user_id, $cid, $did, $sid){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT score_id, COUNT(score_id) AS no_Stu_fail FROM cum_result WHERE sch_id='$sch_id' AND user_id='$user_id' AND class_id='$cid' AND cat_id='$did' AND sid='$sid' AND average > 39");
    $row = mysqli_fetch_array($result);
    $number_stu_pass = $row['no_Stu_fail'];
    return $number_stu_pass;
}

function getCUMHGST($sch_id, $cid, $did, $subj_id, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT score_id, MAX(average) AS cummax FROM cum_result WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $cummax = $row['cummax'];
    return $cummax;
}

function getCUMLWST($sch_id, $cid, $did, $subj_id, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT score_id, MIN(average) AS cummin FROM cum_result WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND subj_id='$subj_id' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $cummin = $row['cummin'];
    return $cummin;
}

function getGrade($total) {
    if ($total > 69) {
        $grade = "A";
    } else if ($total > 59) {
        $grade = "B";
    } else if ($total > 49) {
        $grade = "C";
    } else if ($total > 44) {
        $grade = "D";
    } else if ($total > 39) {
        $grade = "E";
    } else {
        $grade = '<font style="color:red">'.'F'.'</font>';
    }
    return $grade;
}

function getRemark($total) {
    if ($total > 69) {
        $remark = "Excellent";
    } else if ($total > 59) {
        $remark = "V. Good";
    } else if ($total > 49) {
        $remark = "Credit";
    } else if ($total > 44) {
        $remark = "Fair";
    } else if ($total > 39) {
        $remark = "Pass";
    } else {
        $remark = "<font style='color:red'>"."Fail"."</font>";
    }
    return $remark;
}

function getMockgrade($score) {
  if ($score >= 75 && $score <= 100) {
    return 'A1';
  } elseif ($score >= 70 && $score <= 74) {
    return 'B2';
  } elseif ($score >= 65 && $score <= 69) {
    return 'B3';
  } elseif ($score >= 60 && $score <= 64) {
    return 'C4';
  } elseif ($score >= 55 && $score <= 59) {
    return 'C5';
  } elseif ($score >= 50 && $score <= 54) {
    return 'C6';
  } elseif ($score >= 45 && $score <= 49) {
    return 'D7';
  } elseif ($score >= 40 && $score <= 44) {
    return 'E8';
  } elseif ($score >= 0 && $score <= 39) {
    return 'F9';
  } else {
    return 'Invalid Score';
  }
}

function getMockRemark($total) {
    if($total >= 75 && $total <= 100) {
        return "Excellent";
    } elseif($total >= 70 && $total <= 74) {
        return "Very Good";
    } elseif($total >= 65 && $total <= 69) {
        return "Good";
    } elseif($total >= 60 && $total <= 64) {
        return "Credit";
    } elseif($total >= 55 && $total <= 59) {
        return "Credit";
    } elseif($total >= 50 && $total <= 54) {
        return "Credit";
    } elseif($total >= 45 && $total <= 49) {
        return "Pass";
    } elseif($total >= 40 && $total <= 44) {
        return "Pass";
    } elseif($total >= 0 && $total <= 39) {
        return "Fail";
    } else {
        return "Invalid total score";
    }
}

function aggregate($aggregate){
	if ($aggregate < 100) {
		$zaggr = '00'.$aggregate;
	} else if ($aggregate < 1000) {
		$zaggr = '0'.$aggregate;
	} else {
		$zaggr =  $aggregate;
	}
	return  $zaggr;
}

function getComment($sch_id, $aggregate, $total_subj) {
	$student_score = round(($aggregate / $total_subj),0);
    if ($student_score < 50) {
        $comment = "Poor Result! You can do Better Next Term.";
		#Grade D,E,F
    } else if ($student_score >= 49 && $student_score <= 54) {
        $comment = "Good Result! Please Work Harder.";
		#Grade C
    } else if ($student_score >= 55 && $student_score <= 69.5) {
        $comment = "Very Good Performance! Improve on it.";
		#Grade B
    } else if ($student_score >= 70) {
        $comment = "A Brilliant Performance! Keep it up.";
		#Grade A
    } else {
		$comment = "";
		#Undefined
	}
    return $comment;
}

function getPromStatus($sch_id, $uid, $class_id, $did, $sid, $aggregate, $total_subj) {
	include 'include/connection.php';
	//English
	$result = mysqli_query($conn,"SELECT average FROM cum_result WHERE sch_id = '$sch_id' AND user_id='$uid' AND class_id='$class_id' AND cat_id='$did' AND sid='$sid' AND (subj_id='1')");
	$eng = mysqli_fetch_array($result);
	$english = $eng['average'];
	
	//Mathematics
	$result = mysqli_query($conn,"SELECT average FROM cum_result WHERE sch_id = '$sch_id' AND user_id='$uid' AND class_id='$class_id' AND cat_id='$did' AND sid='$sid' AND (subj_id='2')");
	$maths = mysqli_fetch_array($result);
	$mathematics = $maths['average'];
	
	#Promoted
    if ($aggregate / $total_subj > 44 && (($english > 39) && ($mathematics > 39))) {
        $comment = '<text style="color:green">'.'PROMOTED TO'.'&nbsp;'.getClass($class_id + 1).'</text>';//Promoted
    } else if ($aggregate / $total_subj > 44 && (($english < 40) && ($mathematics > 39))){
		$comment = '<text style="color:red">'.'Resit'.'&nbsp;'.'English'.'</text>';//Failed Engish
	} else if ($aggregate / $total_subj > 44 && (($english > 39) && ($mathematics < 40))){
		$comment = '<text style="color:red">'.'Resit'.'&nbsp;'.'Mathematics'.'</text>';//Failed Mathematics
	} else if ($aggregate / $total_subj > 44 && (($english < 40) && ($mathematics < 40))) {
		$comment = '<text style="color:red">'.'Resit'.'&nbsp;'.'Mathematics and English'.'</text>';//Failed Mathematics and English
	} else {
		#Promoted on Probation
		if ($aggregate / $total_subj > 39 && $aggregate / $total_subj < 45 && (($english > 39) && ($mathematics > 39))) {
			$comment = 'PROMOTED TO'.'&nbsp;'.getClass($class_id + 1).'&nbsp;'.'ON PROBATION';//Probation
		} else if (($aggregate / $total_subj > 39 && $aggregate / $total_subj < 45) && (($english < 40) && ($mathematics > 39))){
			$comment = 'PROMOTED TO'.'&nbsp;'.getClass($class_id + 1).'&nbsp;'.'ON PROBATION'.'&nbsp;'.'(<text style="color:red">Resit'.'&nbsp;'.'English!</text>)';//Failed Engish
		} else if (($aggregate / $total_subj > 39 && $aggregate / $total_subj < 45) && (($english > 39) && ($mathematics < 40))){
			$comment = 'PROMOTED TO'.'&nbsp;'.getClass($class_id + 1).'&nbsp;'.'ON PROBATION'.'&nbsp;'.'(<text style="color:red">Resit'.'&nbsp;'.'Mathematics!</text>)';//Failed Mathematics
		} else if (($aggregate / $total_subj > 39 && $aggregate / $total_subj < 45) && (($english < 40) && ($mathematics < 40))){
			$comment = 'PROMOTED TO'.'&nbsp;'.getClass($class_id + 1).'&nbsp;'.'ON PROBATION'.'&nbsp;'.'(<text style="color:red">Resit'.'&nbsp;'.'Mathematics & English!</text>)';//Failed Mathematics & English
		} else {
			#Repeat
			if ($aggregate / $total_subj < 40 ) {//&& $aggregate / $total_subj < 44
				$comment = '<font color="red">'.'REPEAT'.'&nbsp;'.getClass($class_id).'</font>';
			} else {
				$comment = 'Unable to Determine Student Status';//Unable to determine Student Status
			}
		}
	}	
    return $comment;
}

//Form Teacher Comment
function getCom($com_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT comment FROM teachers_com WHERE com_id = '$com_id'");
		if ($result){
			$row = mysqli_fetch_array($result);
			$tcomment = $row['comment'];
		} else {
			$tcomment = "";
		}
    return $tcomment;
}

function getAttendanceRem($sch_id, $user_id, $class_id, $cat_id, $term, $session, $date){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT attendance FROM attendance WHERE sch_id='$sch_id' AND user_id='$user_id' AND class_id='$class_id' AND cat_id='$cat_id' AND term_id='$term' AND session_id='$session' AND date='$date'");
    $row = mysqli_fetch_array($result);
    $remark = $row['attendance'];
	return $remark;
}

function CountPresent($sch_id, $user_id, $class_id, $cat_id, $term, $session){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT *, COUNT(*) AS present FROM attendance WHERE attendance='present' AND sch_id='$sch_id' AND user_id='$user_id' AND class_id='$class_id' AND cat_id='$cat_id' AND term_id='$term' AND session_id='$session'");
    $row = mysqli_fetch_array($result);
	if ($row['present'] < '10'){
		$present = '00'.$row['present'];
	} else if ($row['present'] <= '100'){
		$present = '0'.$row['present'];
	} else {
		$present = $row['present'];
	}
	return $present;
}

function CountAbsent($sch_id, $user_id, $class_id, $cat_id, $term, $session){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT *, COUNT(*) AS absent FROM attendance WHERE attendance='absent' AND sch_id='$sch_id' AND user_id='$user_id' AND class_id='$class_id' AND cat_id='$cat_id' AND term_id='$term' AND session_id='$session'");
    $row = mysqli_fetch_array($result);
    $absent = $row['absent'];
	return $absent;
}

function getNoofDaysSchOpen($sch_id, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT no_of_times_sch_open FROM resumption_date WHERE sch_id='$sch_id' AND term_id='$tid' AND sid='$sid'");
	if ($result){
		$row = mysqli_fetch_array($result);
		if ($row['no_of_times_sch_open'] == NULL){
			$no_of_days_sch_open = '0';
		} else {
			$no_of_days_sch_open = $row['no_of_times_sch_open'];
		}
	} else {
		$no_of_days_sch_open = '';
	}
	return $no_of_days_sch_open;
}

function getAttendence($uid, $sch_id, $cid, $did, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT attnd_present FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND session_id='$sid'");
	if ($result){
		$row = mysqli_fetch_array($result);
		if ($row['attnd_present'] == '0'){
			$present = '000';
		} else if ($row['attnd_present'] < '10'){
			$present = '00'.$row['attnd_present'];
		} else if ($row['attnd_present'] <= '100'){
			$present = '0'.$row['attnd_present'];
		} else {
			$present = $row['attnd_present'];
		}
	} else {
		$present = "";
	}
    return $present;
}

function CalcAttendance($present, $no_of_days_sch_open){
	if ($no_of_days_sch_open != 0){
		$value = round(($present/$no_of_days_sch_open) * 100,2);
		if ($value >= '75'){
			$remark = '<font color="green">'.$value.'%'.'</font>';
		} else {
			$remark = '<font color="red">'.$value.'%'.'</font>';
		}
	} else {
		$remark = '';
	}

	return $remark;
}

function getResumptionDate($sch_id, $term_id, $sid) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT * FROM resumption_date WHERE sch_id='$sch_id' AND term_id='$term_id' AND sid='$sid'");
	$row = mysqli_fetch_array($result);
    $date = $row['next_date'];
    return $date;
}

//Form Teacher's Name
function getFormTeacher($sch_id, $class_id, $cat_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT * FROM form_teacher_info JOIN sch_users ON form_teacher_info.user_id = sch_users.user_id JOIN staff_info ON form_teacher_info.user_id = staff_info.user_id WHERE form_teacher_info.sch_id = '$sch_id' AND form_teacher_info.class_id = '$class_id' AND form_teacher_info.cat_id = '$cat_id' AND sch_users.priv_id = '5';");
	$row = mysqli_fetch_array($result);
	
	//getting form teacher Status
	$gender = $row['sex_id']; $marital_status = $row['status_id'];
	
	if($gender == '1'){
		$title = 'Mr.';
	} else if($gender == '2' && $marital_status == '1'){
		$title = 'Miss.';
	} else if($gender == '2' && $marital_status == '2'){
		$title = 'Mrs.';
	} else {
		$title = '';
	}
	
	$ft_name = $title.' '.$row['first_name'].'&nbsp;'.$row['last_name'];
    return $ft_name;
}

function getHeadTeacher($sch_id) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT * FROM sch_users WHERE sch_id='$sch_id' AND priv_id='1' LIMIT 1");
	$row = mysqli_fetch_array($result);
    $headteacher = $row['first_name'].'&nbsp;'.$row['last_name'];
    return $headteacher;
}

function getSecondT($uid, $did, $sch_id, $sid, $subj_id) {
	include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT total FROM score_info WHERE user_id = '$uid' AND cat_id = '$did' AND term_id = '2' AND sch_id = '$sch_id' AND sid = '$sid' AND subj_id = '$subj_id'");
    $row = mysqli_fetch_array($result);
	$total2 = $row['total'];
	return $total2;
}

function Ordinal($number) {
	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if((($number%100) >= 11)&&(($number%100) <= 13)) {
		return strtoupper($number. 'th');
	} else {
		return strtoupper($number.$ends[$number%10]);
	}	
}

// Create a function for converting the amount in words
function AmountInWords(float $amount) {
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Million', 'Billion');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Naira = implode('', array_reverse($string));
   $get_value = ($amount_after_decimal > 0) ? "and " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Naira' : '';
   return ($implode_to_Naira? $implode_to_Naira . 'Naira ' : '') . $get_value;
}

function arabicToRoman($number) {
  $result = '';
  $romanNumerals = array(
    'M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1
  );

  foreach ($romanNumerals as $roman => $value) {
    while ($number >= $value) {
      $result .= $roman;
      $number -= $value;
    }
  }
  return $result;
}

//Constant Values
$counter = '0'; $counter1 = '0'; $counter2 = '0';
$date = date('d'.'m'.'Y');
$yearlim = date("Y");

function Process_charges($amount){
	//include 'include/connection.php';
	//$result = mysqli_query($conn,"SELECT amount FROM payment_type WHERE payment_id = '$payment_id'");
	//$row = mysqli_fetch_array($result);
	//$amount = $row['amount'];
	$charges = $amount * (0.5/100);
    return $charges;
}

function getNumStuClass($sch_id, $cid, $cat_id) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_in_class FROM stdnt_info WHERE status_id='1' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$cat_id'");
    $row = mysqli_fetch_array($result);
	$num_in_class = $row['num_in_class'];
    return $num_in_class;
}

function getTotalNumStuPerSubj($sch_id, $cid, $cat_id, $subj_id) {
	include 'include/connection.php';
	if (getSubjectType($subj_id) == 'Core'){
		$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_in_class_subj FROM stdnt_info WHERE status_id='1' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$cat_id'");
		$row = mysqli_fetch_array($result);
		$num_in_class_subj = $row['num_in_class_subj'];
	} else if (getSubjectType($subj_id) == 'Elective') {
		/*$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_in_class_subj FROM stdnt_info JOIN registered_subject ON stdnt_info.user_id = registered_subject.user_id WHERE stdnt_info.status_id='1' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id='$cid' AND stdnt_info.cat_id='$cat_id'");*/
		$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_in_class_subj FROM registered_subject WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$cat_id' AND subj_id='$subj_id'");
		$row = mysqli_fetch_array($result);
		$num_in_class_subj = $row['num_in_class_subj'];
	} else {
		$num_in_class_subj = '??';
	}
    return $num_in_class_subj;
}

function getNumScore($sch_id, $cid, $cat_id, $subj_id, $tid, $sid) {
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT user_id, COUNT(user_id) AS num_of_score FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$cat_id' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
	$num_of_score = $row['num_of_score'];
    return $num_of_score;
}

function getEntryProgress($subj_id, $num_class, $num_score, $sch_id, $cid, $cat_id){
	if ($num_class!=0){
		$percent_done = (($num_score)/$num_class * 100).'%';
		$percent_undone = round((($num_class - $num_score)/$num_class * 100),0).'%';
		  if ($num_class == $num_score){
			$progress = '<span class="badge bg-success">'.$percent_done.'&nbsp;'.'Completed</span>';
			} else if ($num_score == 0){
				$progress = '<span class="badge bg-danger">Entered Nothing</span>'; 
			} else if ($num_class != $num_score){
				$progress = '<span class="badge bg-warning">'.$percent_undone.'&nbsp;'.'Incomplete</span>';
			} else {
				$progress = '<span class="badge bg-danger">???</span>'; 
			}
	} else if ((getSubjectType($subj_id) == 'Elective') && (getNumStuClass($sch_id, $cid, $cat_id)!='0')) {
		$progress = '<span class="badge bg-orange">'.'&nbsp;'.'No Student Registered</span>';
	} else {
		$progress = '<span class="badge bg-primary">'.'&nbsp;'.'Empty Class</span>';
	}
	return $progress;
	}

//Assignments	
function getAssignment($user_id, $subj_id, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT file_name FROM stu_assignment WHERE user_id = '$user_id' AND subj_id = '$subj_id' AND term_id='$tid' AND session_id = '$sid'");
	$row = mysqli_fetch_array($result);
	$assignment = $row['file_name'];
    return $assignment;
}

function getAssignScore($user_id, $subj_id, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT assign_score FROM stu_assignment WHERE user_id = '$user_id' AND subj_id = '$subj_id' AND term_id='$tid' AND session_id = '$sid'");
	$row = mysqli_fetch_array($result);
	$assign_score = $row['assign_score'];
    return $assign_score;
}

function getAssignDateOS($user_id, $subj_id, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT date_of_subm FROM stu_assignment WHERE user_id = '$user_id' AND subj_id = '$subj_id' AND term_id='$tid' AND session_id = '$sid'");
	$row = mysqli_fetch_array($result);
	$date_of_subm = $row['date_of_subm'];
    return $date_of_subm;
}

function getAssgnQues($cid, $subj_id, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT assgn_question FROM assgn_questions WHERE class_id = '$cid' AND subj_id = '$subj_id' AND term_id='$tid' AND session_id = '$sid'");
	$row = mysqli_fetch_array($result);
	$assgnQues = $row['assgn_question'];
    return $assgnQues;
}

function getLessonNote($subj_id, $class_id, $term_id, $week){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT lesson_note FROM lesson_notes WHERE class_id = '$class_id' AND subj_id = '$subj_id' AND term_id='$term_id' AND week = '$week'");
	$row = mysqli_fetch_array($result);
	$lesson_note = str_replace(' ', '_', strtolower(getSubject($subj_id))).'/'.$row['lesson_note'];
    return $lesson_note;
}

function CountLessonNote($subj_id, $class_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT lesson_id, COUNT(lesson_id) AS num_note FROM lesson_notes WHERE class_id = '$class_id' AND subj_id = '$subj_id'");
	$row = mysqli_fetch_array($result);
	$num_lesson_note = $row['num_note'];
    return $num_lesson_note;
}

function generateReceiptNo($sch_id, $pt, $tid, $sid){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT receipt_no FROM ledger_info WHERE sch_id = '$sch_id' AND payment_type = '$pt' AND term_id='$tid' AND sid = '$sid' ORDER BY receipt_no DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) == false){
		$num = '1';
		$receipt_no = str_pad($num, 5, "0", STR_PAD_LEFT);
	} else {
		$num = $row['receipt_no'] + 1;
		$receipt_no = str_pad($num, 5, "0", STR_PAD_LEFT);
	}
    return $receipt_no;
}

function countTx($sch_id, $user_id, $pt, $tid, $sid){
    include 'include/connection.php';
    $result = mysqli_query($conn,"SELECT *, COUNT(transaction_id) AS num_tx FROM payment_log WHERE sch_id='$sch_id' AND user_id='$user_id' AND payment_type ='$pt' AND term_id = '$tid' AND sid = '$sid'");
    $row = mysqli_fetch_array($result);
    $number_tx = $row['num_tx'];
    return $number_tx;
}

function getExamNumber($user_id, $class_id, $sch_id) {
    include 'include/connection.php';
    // Produce the list of all the student in the class
    $result = mysqli_query($conn, "SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE stdnt_info.class_id='$class_id' AND stdnt_info.status_id='1' ORDER BY sch_users.last_name,sch_users.first_name ASC");

    $names_of_student = array(); // Initialize an array to store last names
    while ($row = mysqli_fetch_assoc($result)) {
        $names_of_student[] = ($row['last_name'].' '.$row['first_name']); // Add last names to the array
    }
	$last_name = getLastName($user_id).' '.getFirstName($user_id);
    // Find the index of the user's last name in the sorted array
    $index = array_search($last_name, $names_of_student);

    
    if ($index !== false) {
		$examination_no = $index + 1;// If the user's last name is found, return the array index + 1 as the exam number
    } else {
		$examination_no = '0';// If the user's last name is not found, return 0
	}
	return $examination_no;
}

function examNoFormat($exam_no){
	if ($exam_no<10 && $exam_no<100){
		$p_exam_no = '00'.$exam_no;
	} else if ($exam_no>=10){
		$p_exam_no = '0'.$exam_no;
	} else {
		$p_exam_no = $exam_no;
	}
	return $p_exam_no;
}

function RecordCumulative($sch_id, $subj_id, $class_id, $cat_id,  $session_id, $term_id, $uid, $total){
	include 'include/connection.php';
	//Recording Cumulative...
	$cumulative = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id = '$uid' AND sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND sid = '$session_id'");
	$row = mysqli_fetch_array($cumulative);
	
	$cum_total = "";//$row['total'] + $total; 
	$average = "";//($row['first_term_total'] + $row['second_term_total'] + $row['third_term_total']) / 3;

	if ($term_id == 1){
		if (mysqli_num_rows($cumulative) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,first_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($cumulative) == true) {
			mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
			} else {
				//Do Nothing...
			}
	} else if ($term_id == 2) {
		if (mysqli_num_rows($cumulative) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,second_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($cumulative) == true) {
			mysqli_query($conn,"UPDATE `cum_result` SET `second_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
			} else {
				//Do Nothing...
			}
	} else if ($term_id == 3){
		if (mysqli_num_rows($cumulative) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,third_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($cumulative) == true) {
			mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else {
			//Do Nothing...
		}
	} else {
		//Do Nothing...
	}
}

function EditCumulative($sch_id, $subj_id, $class_id, $cat_id,  $session_id, $term_id, $uid, $total){
	include 'include/connection.php';

	$result001 = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id = '$uid' AND sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND sid = '$session_id'");
	$row = mysqli_fetch_array($result001);

	$cum_total = "";//$row['total'] + $total; 
	$average = "";//($row['first_term_total'] + $row['second_term_total'] + $row['third_term_total']) / 3;
	
	if ($term_id == 1){
		if (mysqli_num_rows($result001) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,first_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($result001) == true) {
			$result = mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else {
			
		}
	} else if ($term_id == 2) {
		if (mysqli_num_rows($result001) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,second_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($result001) == true) {
			$result = mysqli_query($conn, "UPDATE `cum_result` SET `second_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else {
		
		}
	} else if ($term_id == 3){
		if (mysqli_num_rows($result001) == false) {		
			$result = mysqli_query($conn,"INSERT INTO cum_result (sch_id,subj_id,class_id,cat_id,user_id,third_term_total,total,average,sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$total','$cum_total','$average','$session_id')");
		} else if (mysqli_num_rows($result001) == true) {
			$result = mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '$total',`total` = '$cum_total',`average` = '$average' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else {
			
		}
	} else {
		
	}
}

function DeleteScore($sch_id, $selected_ids){
	include 'include/connection.php';
	// Fetch information from score_info table before deleting
		$result = mysqli_query($conn,"SELECT * FROM score_info WHERE score_id IN (".implode(',',$selected_ids).") AND sch_id = '$sch_id'");
		
	// Iterate over the result and fetch the information
	while ($row = mysqli_fetch_assoc($result)) {
		// Access the fetched data
		$uid = $row['user_id'];
		$class_id = $row['class_id'];
		$cat_id = $row['cat_id'];
		$subj_id = $row['subj_id'];
		$term_id = $row['term_id'];
		$session_id = $row['sid'];

		// Perform any necessary operations with the fetched data
		$result2 = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id='$uid' AND subj_id='$subj_id' AND class_id='$class_id' AND cat_id='$cat_id' AND sid='$session_id'");
		$cumrow = mysqli_fetch_assoc($result2);
		$first_term = $cumrow['first_term_total'];
		$second_term = $cumrow['second_term_total'];
		$third_term = $cumrow['third_term_total'];

		if (($term_id==1) && ($second_term==0)&&($third_term==0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else if (($term_id==2) && ($first_term==0)&&($third_term==0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `second_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else if (($term_id==3) && ($first_term==0)&&($second_term==0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else if (($term_id==1) && ($second_term!=0)&&($third_term!=0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `first_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else if (($term_id==2) && ($first_term!=0)&&($third_term!=0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `second_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		} else if (($term_id==3) && ($first_term!=0)&&($second_term!=0)){
			mysqli_query($conn,"UPDATE `cum_result` SET `third_term_total` = '0' WHERE sch_id = '$sch_id' AND subj_id = '$subj_id' AND class_id = '$class_id' AND cat_id = '$cat_id' AND user_id = '$uid' AND sid = '$session_id'");
		}
	}
	
	// Delete rows with selected IDs
	$del = mysqli_query($conn,"DELETE FROM `score_info` WHERE `score_info`.`score_id` IN (".implode(',',$selected_ids).") AND sch_id = '$sch_id'");
	
	if ($del) {
		$msg = 'Selected rows deleted successfully.';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		$msg = 'Error Deleting Selected Rows';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
	return $msg_toastr;
}

function CountWard($sch_id,$phone_no){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT stdnt_id, COUNT(stdnt_id) AS num_ward FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact = '$phone_no' AND status_id!=0 GROUP BY parent_contact");//AND class_id < $class_limit
	$row = mysqli_fetch_array($result);
	$num_ward = $row['num_ward'];
    return $num_ward;
}

function getApplicantName($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT last_name,first_name,middle_name FROM admission WHERE appl_no = '$user_id'");
	$row = mysqli_fetch_array($result);
	$applicant_fullname = $row['last_name'].' '.$row['first_name'].' '.$row['middle_name'];
    return $applicant_fullname;
}

function getPSignature($sch_id){
	include 'include/connection.php';
	if ($sch_id == ""){
		$signature_Path = 'images/signature/default_signature.png';

		// Read the image file content
		$imageData = file_get_contents($signature_Path);

		// Encode the image data as base64
		$base64Image = base64_encode($imageData);

		// Create the data URI for embedding the image
		$signature = 'data:image/jpeg;base64,' . $base64Image;

		return $signature;
	} else {
		$result = mysqli_query($conn,"SELECT signature FROM sch_info WHERE sch_id = '$sch_id'");
		if ($result){
			$row = mysqli_fetch_array($result);
			$signature = $row['signature'];
			$signature_Path = 'images/signature/'.$signature;	
			
			if (file_exists($signature_Path)){
				// Read the image file content
				$imageData = file_get_contents($signature_Path);

				// Encode the image data as base64
				$base64Image = base64_encode($imageData);

				// Create the data URI for embedding the image
				$signature = 'data:image/jpeg;base64,' . $base64Image;
				
				return $signature;
			} else {
				$signature_Path = 'images/signature/default_signature.png';
				
				// Read the image file content
				$imageData = file_get_contents($signature_Path);

				// Encode the image data as base64
				$base64Image = base64_encode($imageData);

				// Create tshe data URI for embedding the image
				$signature = 'data:image/jpeg;base64,' . $base64Image;
				
				return $signature;
			}	
		} else {
			$signature = mysqli_error($conn);
		}
	}
}

function isOnline() {
    // List of local IP address prefixes
    $localIpPrefixes = array(
        '127.',    // Loopback
        '10.',     // Private network
        '192.168.', // Private network
        '172.16.', '172.17.', '172.18.', '172.19.', '172.20.', '172.21.', '172.22.', '172.23.', '172.24.', '172.25.', '172.26.', '172.27.', '172.28.', '172.29.', '172.30.', '172.31.' // Private network
    );

    // Get the client's IP address
    $clientIp = $_SERVER['REMOTE_ADDR'];

    // Check if the IP address is a local address
    foreach ($localIpPrefixes as $prefix) {
        if (strpos($clientIp, $prefix) === 0) {
            return false; // IP address is a local address, therefore offline
        }
    }

    return true; // IP address is not a local address, therefore online
}

function getGHGST($sch_id, $cid, $subj_id, $tid, $sid) {
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT score_id, MAX(total) AS max FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $max = $row['max'];
    return $max;
}

function getGLWST($sch_id, $cid, $subj_id, $tid, $sid) {
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT score_id, MIN(total) AS min FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $min = $row['min'];
    return $min;
}

function getGAVG($sch_id, $cid, $subj_id, $tid, $sid) { 
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT score_id, AVG(total) AS avg FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid'");
    $row = mysqli_fetch_array($result);
    $average = $row['avg'];
    return $average;
}

function getNumGrade($sch_id, $cid, $subj_id, $tid, $sid, $grade) {
	include "include/connection.php";
	if ($grade == 'A'){
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total>69";
	} else if ($grade == 'B'){
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total>59 AND total<70";
	} else if ($grade == 'C'){
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total>49 AND total<60";
	} else if ($grade == 'D'){
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total>44 AND total<50";
	} else if ($grade == 'E'){
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total>39 AND total<45";
	} else {
		$sql = "SELECT score_id, COUNT(total) AS numgrade FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total<40";
	}
	$result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $numgrade = $row['numgrade'];
    return $numgrade;
}

function getBestStudent($sch_id, $cid, $subj_id, $tid, $sid, $score) {
    include "include/connection.php";
    $result = mysqli_query($conn, "SELECT user_id FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total='$score'");
    $bestStudents = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $uid = $row['user_id'];
        $resulcat = mysqli_query($conn, "SELECT cat_id FROM score_info WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$cid' AND subj_id='$subj_id' AND term_id='$tid' AND sid='$sid' AND total='$score'");
        $rowcat = mysqli_fetch_array($resulcat);

        // Construct the student information
        $studentInfo = array(
            'name' => strtoupper(getFirstName($uid) . ' ' . getLastName($uid)),
            'class' => getClass($cid),
            'category' => getCategory($rowcat['cat_id'])
        );

        // Add the student information to the array
        $bestStudents[] = $studentInfo;
    }

    return $bestStudents;
}
?>
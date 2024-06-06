<?php
if (isset($_GET['reference'])){
	$reference = $_GET['reference'];
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
  "Authorization: Bearer sk_test_303578a5dc6943e3b3ed1e710713f9e581cca959",
  "Cache-Control: no-cache",
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
	$result = json_decode($response);
	//echo $result;
}

if($result->data->status == 'success'){
		$_1 = $result->data->status;
		$_2 = $result->data->currency.$result->data->amount;
		$_3 = $result->data->reference;
		$_4 = $result->data->message;
		$_5 = $result->data->paid_at;
		$_6 = $result->data->channel;
		$_7 = $result->data->metadata->referrer;
		$_8 = $result->data->customer->first_name;
		$_9 = $result->data->customer->last_name;
		$_10 = $result->data->channel;
		echo $_1;
		
		echo $_2;
		echo $_3;
		echo $_4;echo $_5; echo $_7;  echo $_8; echo $_9; echo $_10;
} else {
	$msg = '<span class="badge bg-danger">'.'Transaction Unsuccessful'.'</span>';
}
?>
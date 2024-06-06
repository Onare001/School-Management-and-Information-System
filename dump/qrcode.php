<?php
// Include the QR code library
require_once('assets/lib/phpqrcode/qrlib.php');

// Get the user data from the query string
if (isset($_GET['data'])) {
  $user_data = $_GET['data'];
} else {
  // If no user data is specified, use a default value
  $user_data = "niel technologies";
}

// Generate the QR code and store the image data in a variable
$qr_code = QRcode::png($user_data, false, QR_ECLEVEL_Q);

// Output the QR code image to the browser
header("Content-Type: image/png");
echo $qr_code;
?>
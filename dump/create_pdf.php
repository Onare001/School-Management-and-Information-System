<?php
// Include the TCPDF library
require_once('assets/lib/tcpdf/tcpdf.php');
// Include my Functions
require_once('functions/functions.php');

// Start output buffering
ob_start();

// Output your HTML content here
echo '<!DOCTYPE html>
<html>
<head>
	<title>My Test Page</title>
</head>
<body>
	<center><h1 style="color:blue;">'.strtoupper(getSchname(1)).'</h1></center>
	<img src="../images/'.getSchLogo(1).'"/>
	<hr>
	<p>hdshdhdsnmgnhm gnmdsh hjgdsh</p>
	<ul>
		<li>Item 1</li>
		<li>Item 2</li>
		<li>Item 3</li>
	</ul>
</body>
</html>';

// Get the HTML content of the page
$html = ob_get_clean();

// Create new TCPDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document properties
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Document Title');
$pdf->SetSubject('Document Subject');
$pdf->SetKeywords('Keywords');

// Add a page
$pdf->AddPage();

// Write the HTML content to the page
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF to the browser
$pdf->Output('example.pdf', 'I');
?>

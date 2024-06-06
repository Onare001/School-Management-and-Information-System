<?php
if (isset($_POST['download_csv'])){
	
	include('include/connection.php');
// SQL query to retrieve data
$sql = "SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='1' AND sch_users.priv_id='3' AND stdnt_info.class_id='3' AND stdnt_info.cat_id='1' AND stdnt_info.status_id='1'";

// Execute query and get result set
$result = mysqli_query($conn, $sql);

// Open CSV file for writing
$file = fopen('php://temp', 'w+');

// Write headers to CSV file
$headers = array('SN', 'LASTNAME', 'FIRSTNAME','1ST_CA', '2ND_CA', '3RD_CA', 'EXAM_SCORE');
fputcsv($file, $headers);

$counter = 0;

// Loop through result set and write data to CSV file
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data = array(++$counter, $row['last_name'], $row['first_name']);
    fputcsv($file, $data);
}

// Set file pointer to beginning
rewind($file);

// Set headers for file download
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="output.csv";');

// Send CSV file as download attachment
fpassthru($file);

// Close CSV file
fclose($file);

// Close MySQL database connection
mysqli_close($conn);

exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Download CSV File</title>
</head>
<body>
    <h1>Download CSV File</h1>
    <p>Click the button below to download the CSV file:</p>
    <form action="" method="post">
        <button type="submit" name="download_csv">Download CSV</button>
    </form>
</body>
<a href="upload_csv.php">Upload</a>
</html>


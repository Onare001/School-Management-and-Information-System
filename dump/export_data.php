<?php include ("include/connection.php"); ?>
<?php //include ("include/lock_admin.php"); ?>
<?php include ("functions/functions.php"); ?>
<?php
// BEGIN: Establish a connection to the database
// INSTRUCTION: Fill in the following four variables with your specific connection.

// Server hostname or IP address
$server_hostname = "localhost"; 

// The name of your MySQL database instance
$database_name = ""; 

// The username of your database login credential 
$username = "root";

// The password of your database login credential
$password = ""; 

$link_sqli = mysqli_connect($server_hostname, $username, $password, $database_name);

// If an error occurred while connecting to the database, display the error code and exit.
if (!$link_sqli) {
echo "Error: Unable to connect to MySQL." . PHP_EOL;
echo "Debugging error #: " . mysqli_connect_errno() . PHP_EOL;
echo "Error description: " . mysqli_connect_error() . PHP_EOL;
exit;
}
// END: Establish a connection to the database

// BEGIN: Define some variables
// INSTRUCTION: Specify your table name and the name of your export file.
if (isset($_GET['tname']) && isset($_GET['query'])){
	$tname = $_GET['tname'];
	$query = decrypt($_GET['query']);
// The name of data table containing the data you wish to export
$TableName = "$tname";
$Command = "$query";
}
// The filename you want your export file to be named
$Filename = "$TableName"; 
// END: Define some variables

// *** No more configurable options below this point for this code to function on most servers ***
// Fetch records from the database table specified in the variable $TableName
$Output = "";
//$strSQL = "SELECT * FROM $TableName";
$strSQL = "$Command";
$sql = mysqli_query($link_sqli, $strSQL); 
// If the database query encounters an error, display the error message.
// Otherwise, start the export process.
if (mysqli_error($link_sqli)) { 
echo mysqli_error($link_sqli);
} else {
// Determine the number of data columns in the table
$columns_total = mysqli_num_fields($sql);

// Get the name of the data columns so it can be used in the header row of the export file.
// Content of the export file is temporarily saved in the variable $Output
for ($i = 0; $i < $columns_total; $i++) {
  $Heading = mysqli_fetch_field_direct($sql, $i);
  $Output .= '"' . $Heading->name . '",';
}
$Output .= "\n";		
// The /n is the control code to go to a new line in the export file.

// Loop through each record in the table and read the data value from each column.
while ($row = mysqli_fetch_array($sql)) {
  for ($i = 0; $i < $columns_total; $i++) {
     $Output .= '"' . $row["$i"] . '",';
  }
  $Output .= "\n";
}

// Create the export file and name it with the name specified in variable $Filename
// Also appends the current timestamp (in the format yyyymmddhhmmss) to the filename and give it a .CSV file extension.
// The timestamp serves as a time reference to identify when the data was exported.
//File is comma delimited with double-quote used a the text qualifier
// Once  file is created, download of the file begins automatically (tested on Google Chrome).
$TimeNow = date("YmdHis");
$Filename .= $TimeNow . ".csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=' . $Filename);
echo $Output;
}
exit;
?>					
                
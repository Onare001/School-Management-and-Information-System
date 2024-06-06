<?php
    /*$host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $database_name = 'goldspring_sms_junior';//goldspring_school superschool_sms
    $conn = mysqli_connect($host, $db_username, $db_password, $database_name);
    if(!$conn){
         die('Unable to Connect to Server:');// .mysqli_error()
	}*/
	if (session_status() == PHP_SESSION_NONE) {
	  session_start();
	}
	$conn = mysqli_connect('localhost', 'root', '', $_SESSION['selected_database']);
	$database_name = $_SESSION['selected_database'];
	if (!$conn){
		header('location: index');
	}
?>
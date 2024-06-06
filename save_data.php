<?php
	include ("include/connection.php"); 
	include ("functions/functions.php");
	
	 // Get the data from the form submission
	$sch_id = $_POST['sch_id'];
	$reference = $_POST['teller_no'];
	$amount = $_POST['amount_paid'];
	$term_id = $_POST['term'];
	$session_id = $_POST['session'];
	$class_id = decrypt($_POST['class']);
	$cat_id = decrypt($_POST['cat']);
	$uid = decrypt($_POST['uid']);
	$payment_type = $_POST['pt'];
  
	$check_reference = mysqli_query($conn,"SELECT reference FROM attempted_payment WHERE reference='$reference'");
	
	if(mysqli_num_rows($check_reference) == FALSE){
		mysqli_query($conn,"INSERT INTO attempted_payment (sch_id, reference, amount, user_id, class_id, cat_id, payment_type, term_id, session_id, online_status) VALUES ('$sch_id','$reference','$amount','$uid','$class_id','$cat_id','$payment_type','$term_id','$session_id','1')");
	} else {
		//echo "Record already exist";
	}	
?>
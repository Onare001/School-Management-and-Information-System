<?php
include ("connection.php");
//Fetch Local Government Area
    $state_id = $_POST["state_id"];
    $result = mysqli_query($conn,"SELECT * FROM local_governments WHERE state_id = '$state_id'");
	while($row = mysqli_fetch_array($result)) {
    echo '<option value="'.$row["lg_id"].'">'.$row["name"].'</option>';
 } 

//Fetch Amount
    $payment_id = $_POST["payment_id"];
    $result = mysqli_query($conn,"SELECT amount FROM payment_type WHERE payment_id = '$payment_id'");
	if (!($result)){
			echo '<option value="'.$row["amount"].'">'.'amount'.'</option>';
	} else {
		while($row = mysqli_fetch_array($result)) {
			echo '<option value="'.$row["amount"].'">'.'&#8358;'.number_format($row["amount"]).'</option>';
		}
	}
?>
    
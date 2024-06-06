<?php
include ("connection.php");
if(isset($_POST['id']) && isset($_POST['state']) && isset($_POST['isChecked']) && isset($_POST['table'])) {
    $id = $_POST['id'];
    $isChecked = $_POST['isChecked'];
	$state = $_POST['state'];
	$table_name = $_POST['table'];
	
	if ($state == '1'){
		 $status = ($isChecked) ? 0 : 1; // Set status to 1 if checked, 0 if unchecked
	} else {
		 $status = ($isChecked) ? 1 : 0; // Set status to 1 if checked, 0 if unchecked
	}
	
	if ($table_name == 'term_info'){
		$x_id = 'term_id';
		$result = mysqli_query($conn,"UPDATE $table_name SET `status` = '$status' WHERE `$table_name`.`$x_id` = $id");
	} else if ($table_name == 'session_info'){
		$x_id = 'sid';
		$result = mysqli_query($conn,"UPDATE $table_name SET `status` = '$status' WHERE `$table_name`.`$x_id` = $id");
	} else if ($table_name == 'year_info'){
		$x_id = 'year_id';
		$result = mysqli_query($conn,"UPDATE $table_name SET `status` = '$status' WHERE `$table_name`.`$x_id` = $id");
	} else if ($table_name == 'stdnt_info'){
		$x_id = 'user_id';
		$result = mysqli_query($conn,"UPDATE $table_name SET `status_id` = '$status' WHERE `$table_name`.`$x_id` = $id");
	} else if ($table_name == 'e_exam'){
		$x_id = 'exam_id';
		$result = mysqli_query($conn,"UPDATE $table_name SET `status` = '$status' WHERE `$table_name`.`$x_id` = $id");
	}
	

   
    // Update the status column in the database
    $result = mysqli_query($conn,"UPDATE $table_name SET `status` = '$status' WHERE `$table_name`.`$x_id` = $id");

    if ($result) {
        echo 'Switch ' . $id . ' is now ' . ($isChecked ? 'activated' : 'deactivated');
    } else {
        echo 'Error updating database: ' . mysqli_error($conn);
    }
} else {
    echo "Error: missing parameters";
}

?>


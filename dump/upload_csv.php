<?php
if(isset($_POST["submit"])) {
    $target_dir = "csv/"; // Change the directory as per your needs
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Allow only CSV files
    if($fileType != "csv") {
        echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        // Prompt the user to enter the subject term and session
		$sch_id = '1';
        $subj_id = '9';//$_POST["subject_term"];
		$class_id = '3';
		$cat_id = '1';
		$term_id = '1';
        $session_id = '1';//$_POST["session"];

        // Open the CSV file for reading
        $file = fopen($_FILES["fileToUpload"]["tmp_name"], "r");

		include('include/connection.php');

        // Parse the CSV file line by line
        while (($data = fgetcsv($file)) !== FALSE) {
            $sn = $data[0];
            $last_name = $data[1];
			$first_name = $data[2];
            $first_ca = $data[3];
            $sec_ca = $data[4];
            $third_ca = $data[5];
            $exam = $data[6];
            $total = $first_ca + $sec_ca + $third_ca + $exam;

            // Check if the student exists in the sch_users table
            $sql = "SELECT user_id FROM sch_users WHERE last_name='$last_name' AND first_name='$first_name'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // If the student exists, get the user_id
                $row = $result->fetch_assoc();
                $uid = $row["user_id"];

                // Insert the data into the score_info table
                $result005 = mysqli_query($conn,"INSERT  INTO score_info (sch_id, subj_id, class_id, cat_id, user_id, term_id, first_ca, second_ca, third_ca, exam, total, sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$term_id','$first_ca','$sec_ca','$third_ca','$exam','$total','$session_id')");
                if ($result005 === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                // If the student does not exist, display an error message
                echo "Error: student '$last_name $firstname' not found";
            }
        }
	}
}
?>

<div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title"><i class="fa fa-user-plus"></i>&nbsp;Upload CSV</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<center style="color:red;" class="error"><?php if (isset($msg)) { echo $msg; }?></center>
	<div class="modal-body">
		<form action="" method="post" enctype="multipart/form-data">
		  <label>Select CSV file to upload:</label>
			<input type="file" name="fileToUpload" id="fileToUpload" class="form-control"> 
			<div class="modal-footer">
				<!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="reset" value="Reset" class="btn btn-danger"/-->
				<input type="submit" value="Upload CSV" name="submit" class="btn btn-primary">
			</div>
		</form>	
	</div>
</div>
<a href="download_csv.php">Download</a>
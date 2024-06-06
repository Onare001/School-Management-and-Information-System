<?php
// connect to mysql server & select database
include ("connection.php");

//Create folder if not exist
$parentFolder = "backup";
//$newFolder = "new-folder-name";
if (!file_exists($parentFolder . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))))) {
	mkdir($parentFolder . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))), 0777, true);
}

if(isset($_POST['submit1'])){
	$maxsize = 200000; // 200KB#  
	$file_name = $_FILES['file_name']['name'];
	$target_dir = "images/";
	$target_file = $target_dir . $_FILES["file_name"]["name"];

	// Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png");

	// Check extension
	if( in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			$msg = "Photo file too large. Must be less than 200KB.";
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else {// Upload   
		if (move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
		// Update record					
		$query = "UPDATE `sch_info` SET `sch_logo` = '$file_name' WHERE `sch_info`.`sch_id` = '$_SESSION[sch_id]'";				
		mysqli_query($conn,$query);
		$msg = 'School Logo Uploaded successfully.';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			}
		}
	} else {
		$msg = 'Invalid Photo file.';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
}
// Adding Classes
else if (isset($_POST['submit2'])) {
    $class = addslashes($_POST['class']);
    if (empty($class)) {
        $msg = 'Class name is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
        $query = "INSERT INTO class_info(class_name,sch_id) VALUES('$class','$sch_id')";
		 mysqli_query($conn,$query);
        if ($result){
			$msg = 'Class Added Successfully';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		echo ('<script>alert("Class Added Successfully")</script>');
		}
    }
}
// Adding Class Category
else if (isset($_POST['submit3'])){	
	$category = addslashes(strtoupper($_POST['category']));
	$class_dept = addslashes($_POST['dept_id']);
	if (empty($category)) {
        $msg = 'Class Category is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($class_dept)){
		$msg = 'Class Department is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
	//Insert data
	$result = mysqli_query($conn, "INSERT INTO class_cat (category, class_dept, sch_id) VALUES ('$category', '$class_dept', '$sch_id')");
	if ($result){
		$msg = 'Class Category Added Successfully';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		}	
	} 
} else if (isset($_POST['editCat'])){
	$cat_id = $_POST['cat_id'];
	$category = addslashes(strtoupper($_POST['category']));
	$class_dept = addslashes($_POST['dept_id']);
	if (empty($category)) {
        $msg = 'Class Category is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($class_dept)){
		$msg = 'Class Department is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
	//Insert data
	$result = mysqli_query($conn, "UPDATE `class_cat` SET `category` = '$category', `class_dept` = '$class_dept' WHERE `class_cat`.`cat_id` = '$cat_id'");
	if ($result){
			$msg = 'Class Category Edited Successfully';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Unable to Edit Class Category';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}	
	} 
}
// Adding Houses
else if (isset($_POST['submit14'])){	
	$house_name = addslashes($_POST['house_name']);
	$house_color = $_POST['house_color'];
	if (empty($house_name)) {
        $msg = 'House Name is Required';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($house_color)) {
        $msg = 'House Color is Required';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
	//Insert data
	$result = mysqli_query($conn,"INSERT INTO house_info (sch_id, house, house_color) VALUES ('$sch_id','$house_name','$house_color')");
	if ($result){
		$msg = '<span class="badge bg-success">'.'House Added Successfully'.'</span>';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		}	
	} 
}
// Adding Clubs and Societies
else if (isset($_POST['submit15'])){	
	$club_name = addslashes($_POST['club_name']);
	$club_abbr = addslashes($_POST['club_abbr']);
	$staff_in_charge = addslashes($_POST['teacher']);
	if (empty($club_name)) {
        $msg = 'Club Name is Required';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($club_abbr)) {
        $msg = 'Club Abbreviation is Required';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($staff_in_charge)) {
        $msg = 'Please Assign this Club to a Teacher';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
	//Insert data
	$result = mysqli_query($conn,"INSERT INTO club_info (sch_id, club_name, club_abbr, staff_in_charge) VALUES ('$sch_id','$club_name','$club_abbr','$staff_in_charge')");
	if ($result){
		$msg = '<span class="badge bg-success">'.'Club and Society Added Successfully'.'</span>';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		}	
	} 
}
// Adding Subject
else if (isset($_POST['submit4'])) {
    $subject = addslashes($_POST['subject']);
    $abr = addslashes($_POST['abbreviation']);
	$subj_type = addslashes($_POST['subj_type']);
    if (empty($subject)) {
        $msg = 'Subject name is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($abr)) {
        $msg = 'Subject abbreviation is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($subj_type)) {
        $msg = 'Select Subject Type';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
		$query = "INSERT INTO subj_info(subj_title,subj_abr,subj_type) VALUES ('$subject','$abr','$subj_type')";
        $result = mysqli_query($conn,$query);		
		// Get the name of the folder to create from the form data
		$folder_name = $subject;	
		// Set the path to the parent folder where the new folder should be created
		$parent_folder_path = dirname(dirname(__FILE__)) . '/lesson_notes/';
		// Create the full path to the new folder
		$new_folder_path = $parent_folder_path . $folder_name;
		
		// Check if the folder already exists
		if (!file_exists($new_folder_path)) {
			// Create the new folder
			mkdir($new_folder_path);
			// Create the index file
			$index_file_path = $new_folder_path . '/index.php';
			if (!file_exists($index_file_path)) {
				$index_file = fopen($index_file_path, 'w');
				fwrite($index_file, '<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> School Management System | Unathorized </title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<meta name="keyword" content="">
		<link rel="shortcut icon"  href="assets/sms3.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=0.29">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
	</head>
	<body>
		<center><text  style="font-size:100px;">UNAUTHORIZED</text></center>
	</body>
	<footer>
		Copyright © 2023 SMS. All Rights Reserved. Powered by Niel Technologies  | +2348145162722. 
	</footer>
</html>');
				fclose($index_file);
			}
			//echo 'Folder created successfully.';
		} else {
			//echo 'Folder already exists.';
		}
        if ($result){
			$msg = 'New Subject has been Added';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		}
    }
}

else if (isset($_POST['submitA'])) {
	$subj_id = $_POST['subj_id'];
    $new_subj = addslashes($_POST['subject']);
    $subj_abr = addslashes($_POST['abbreviation']);
	$subj_type = addslashes($_POST['subject_type']);
    if (empty($new_subj)) {
        $msg = 'Subject name is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($subj_abr)) {
        $msg = 'Subject abbreviation is required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($subj_type)) {
        $msg = 'Select Subject Type';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
    } else {
        $result = mysqli_query($conn, "UPDATE `subj_info` SET `subj_title` = '$new_subj', `subj_abr` = '$subj_abr', `subj_type` = '$subj_type' WHERE `subj_info`.`subj_id` = $subj_id");
        if ($result){
			$msg = 'Subject has been Edited';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Unable to Edit Subject';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
    }
}

// Result publishing & unpublishing
else if (isset($_POST['submit5'])) {
    $class_id = $_POST['class_id'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
	//$date = date(m);
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Select Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
        mysqli_query($conn,"UPDATE score_info SET status = '1' WHERE sch_id = '$sch_id' AND class_id='$class_id' AND term_id='$term_id' AND sid='$session_id'");
		if ($term_id == '3'){
			mysqli_query($conn,"UPDATE cum_result SET status = '1' WHERE sch_id = '$sch_id' AND class_id='$class_id' AND sid='$session_id'");
		}
        $msg = getClass($class_id).'&nbsp;'.getSession($session_id).'&nbsp;'.getTerm($term_id).'&nbsp;'.'Result has been Published!';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
    }
}
// Unpublishing the result
else if (isset($_POST['submit6'])) {
    $class_id = $_POST['class_id'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Select Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
        mysqli_query($conn,"UPDATE score_info SET status = '0' WHERE sch_id = '$sch_id' AND class_id='$class_id' AND term_id='$term_id' AND sid='$session_id'");
		if ($term_id == '3'){
			mysqli_query($conn,"UPDATE cum_result SET status = '0' WHERE sch_id = '$sch_id' AND class_id='$class_id' AND sid='$session_id'");
		}
        $msg = getClass($class_id).'&nbsp;'.getSession($session_id).'&nbsp;'.getTerm($term_id).'&nbsp;'.'Result has been Unpublished!';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
    }
} 
// Class promotion
else if (isset($_POST['submit7'])) {
    //$sch_id = $_POST['sch_id'];
    $promote = $_POST['promote'];
    $year_id = $_POST['year_id'];
    if (empty($promote)) {
        $msg = 'Select an Option!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($year_id)) {
        $msg = 'Select Year of graduation for Final Year Student';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
        if ($promote == 'promote') {
            $query = "UPDATE stdnt_info SET yid = '$year_id' WHERE class_id = 3 AND sch_id='$sch_id'";
			$result1 = mysqli_query($conn,$query);//Setting year of Graduation for Final Year Students
            $sql = "UPDATE stdnt_info SET status_id = '2' WHERE yid = '$year_id' AND sch_id='$sch_id'";
			$result2 = mysqli_query($conn,$sql);//Deactivating Final Year Students - Graduated
            $sql2 = "UPDATE stdnt_info SET class_id = class_id + 1 WHERE class_id<$class_limit AND sch_id='$sch_id'";
			$result3 = mysqli_query($conn,$sql2);//Promoting All Students
            $msg = 'Students have been Promoted Successfully!';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';			
        } else if ($promote == 'demote') {
			$sql2 = "UPDATE stdnt_info SET class_id = class_id - 1 WHERE sch_id='$sch_id' AND class_id<$class_limit";//Demoting All Students
			$result3 = mysqli_query($conn,$sql2);
			$sql3 = "UPDATE stdnt_info SET class_id = class_id - 1 WHERE sch_id='$sch_id' AND yid = '$year_id'";
			$result4 = mysqli_query($conn,$sql3);//Demoting Graduated Students for the selected Year       
            $query = "UPDATE stdnt_info SET status_id = '1' WHERE yid = '$year_id' AND sch_id='$sch_id'";//Activating Final Year Students For the selected Year
			$result1 = mysqli_query($conn,$query);
            $sql = "UPDATE stdnt_info SET yid = '0' WHERE yid = '$year_id' AND sch_id='$sch_id'";
			$result2 = mysqli_query($conn,$sql);//Changing Year of Graduation to None
			$msg = 'Students have been Demoted Successfully!';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';			
        }
    }
}
// Resumption Date
else if (isset($_POST['submit8'])) {
    //$sch_id = $_POST['sch_id'];
    $no_of_days_sch_open = $_POST['numopen'];
	$term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
    $next_date = addslashes($_POST['next_date']);
    if (empty($no_of_days_sch_open)) {
        $msg = "Enter the number of times school opened this Term";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = "Select term!";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = "Select Session!";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($next_date)) {
        $msg = "Select resumption date!";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
		$result = mysqli_query($conn,"SELECT * FROM resumption_date WHERE sch_id='$sch_id' AND term_id='$term_id' AND sid='$session_id'");
        if (mysqli_num_rows($result) == true) {
			$result = mysqli_query($conn,"UPDATE resumption_date SET no_of_times_sch_open='$no_of_days_sch_open', next_date='$next_date' WHERE sch_id='$sch_id' AND term_id='$term_id' AND sid='$session_id'");
			if ($result){
				$msg = 'The Resumption date has been Reset Successfully!';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = 'Unable to Reset Resumption date!';//mysqli_error($conn);
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
        } else {
			$result = mysqli_query($conn,"INSERT INTO resumption_date (sch_id, term_id, sid, next_date, no_of_times_sch_open) VALUES('$sch_id','$term_id','$session_id','$next_date', '$no_of_days_sch_open')");
			if ($result){
				$msg = 'Resumption date has been Set Successfully!';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';  
			} else {
				$msg = 'Unable to Set Resumption date!';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>'; 
			}
        }
    }
}
// Reseting user password
else if (isset($_POST['submit18'])) {
    $username = addslashes($_POST['username']);
	$new = md5('2468');
    if (empty($username)) {
        $msg = 'Enter the Username!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
        $query = "SELECT * FROM sch_users WHERE username='$username' AND priv_id!='1' AND priv_id!='9' LIMIT 1";
        $result = mysqli_query($conn,$query) ;
        $row = mysqli_fetch_array($result);
        if ($row['username']==$username) {
            // Reset Password
            $query1 = "UPDATE sch_users SET password = '$new' WHERE username = '$username' AND priv_id!='1' AND priv_id!='9' AND sch_id='$sch_id' LIMIT 1";
            $result1 = mysqli_query($conn,$query1) ;
            $msg = 'The password has been Reset Successfully!';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        } else if (!$row) {
            $msg = 'The Username Entered is Incorrect!';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
        }
    }
}
// Changing Administrative password
else if (isset($_POST['submit9'])) {
    $username = stripslashes($_POST['username']);
    $old = md5(stripslashes($_POST['old']));
    $new = md5(stripslashes($_POST['new']));
    $confirm = md5(stripslashes($_POST['confirm']));
    if (empty($old)) {
        $msg = 'Old Password Required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($new)) {
        $msg = 'New Password Required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($confirm)) {
        $msg = 'Confirm Password Required!';
    } else {
        if ($confirm != $new) {
            $msg = 'Password Mismatched!';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
        } else {
            $query = "SELECT * FROM sch_users WHERE username='$username' AND password='$old' LIMIT 1";
            $result = mysqli_query($conn, $query) ;
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $username) {
                $query1 = "UPDATE sch_users SET password = '$new' WHERE username = '$username'";
                $result1 = mysqli_query($conn, $query1) ;
                header("location: logout.php");
                $msg = 'Your Password has been Reset Successfully!'; 
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';				
            } else if ($row['username'] != $username) {
                $msg = 'Incorrect Old Password!';
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
            }
        }
    }
}

if (isset($_POST['submit29'])){
	$set_pstn = $_POST['set_pstn'];
	if (mysqli_query($conn,"UPDATE `sch_info` SET `show_pstn` = '$set_pstn' WHERE `sch_info`.`sch_id` = $sch_id")){
		$msg = 'Position Setting Saved';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	}	
}	

$onposition=""; $offposition="";
$show_pstn = "SELECT show_pstn FROM sch_info WHERE sch_id = '$sch_id'";
$result = mysqli_query($conn,$show_pstn);
$row = mysqli_fetch_array($result);
$postn = $row['show_pstn'];
	if($postn == 1){
		$onposition = "checked";
	} else if ($postn == 0){
		$offposition = "checked";
	}

 if (isset($_GET['file'])){
	 $file = $_GET['file'];
	 $status = unlink("backup/".str_replace(' ', '_', strtolower(getSchName($sch_id))).'/'.$file);
	if($status){  
		$msg = 'File Has been Deleted';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';	
	} else {  
		$msg = 'Unable to delete file Please Try Again';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		header("location: gen_settings");
	} 
 } 

if (isset($_POST['send_backup'])) {
	$msg = 'Please Wait until Page Complete Loading and success feedback is displayed';
	echo '<script>alert("'.$msg.'")</script>';
	
	$file = $_POST['file'];
	$date_created = $_POST['date_created'];
	
	$to = 'onaretayo@gmail.com';//Niel technologies
	$subject = "Back Up File from ".getSchName($sch_id); // Email subject
	$from = 'onaretayo@gmail.com';//getUsername($user_id); //Sender Address
	$fromName = getSchName($sch_id);//Sender Name
	$message = '<html> 
				<head> 
					<title>Back Up</title> 
				</head> 
				<body>
					<div class="success" style="background-color:blue;color:white;width:500px;height:500px;border-radius:50px;text-align:center;
						padding:10px;margin:0px auto;margin-top:20px;">
						<center><img src="http://superschool.epizy.com/sms/junior/assets/ntt.gif" alt="logo" style="max-width:60px; padding-bottom:7px;" class="user-image" title="Niel Technologies"/></center>
						<div class="exam_info" style="background-color:darkblue;color:white;">'.'BACK UP FILE INFO'.'</div>
						<table class="" border="1" width="100%">
							<tr>
								<td>'.'School Name'.'</td>
								<td>'.getSchName($sch_id).'</td>
							</tr>
							<tr>
								<td>'.'Name of School Admin'.'</td>
								<td>'.getFirstname($user_id).'&nbsp;'.getLastname($user_id).'</td>
							</tr>
							<tr>
								<td>'.'School Address'.'</td>
								<td>'.getSchAddress($user_id).'</td>
							</tr>
							<tr>
								<td>'.'File Name'.'</td>
								<td>'.$file.'</td>
							</tr>
							<tr>
								<td>'.'Date Created'.'</td>
								<td>'.$date_created.'</td>
							</tr>
							<tr>
								<td>'.'File'.'</td>
								<td>'.'<a href='.$file.'>Download</a>'.'</td>
							</tr>
						</table>
					</div>
				</body>
			</html>';
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$attachment = $file;//Back File path

	// encode file attachment in base64
	$file_content = file_get_contents($attachment);
	$attachment_content = chunk_split($file_content);
	$attachment_filename = basename($attachment);

	// generate a unique boundary string
	$boundary = md5(time());

	// construct the email headers
	$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
	$headers .= 'Reply-To: '.$from. "\r\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
	$headers .= 'Cc: ' . "\r\n"; 
	$headers .= 'Bcc: ' . "\r\n";

	// construct the email body
	$body = "--$boundary\r\n";
	$body .= "Content-Type: text/html; charset=UTF-8\r\n";
	$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
	$body .= $message . "\r\n\r\n";

	// add the attachment to the email body
	$body .= "--$boundary\r\n";
	$body .= "Content-Type: application/pdf; name=\"$attachment_filename\"\r\n";
	$body .= "Content-Transfer-Encoding: base64\r\n";
	$body .= "Content-Disposition: attachment; filename=\"$attachment_filename\"\r\n\r\n";
	$body .= $attachment_content . "\r\n\r\n";
	$body .= "--$boundary--";

		// send the email
		if (mail($to, $subject, $body, $headers)){
			$msg = "Email sent with attachment!";
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
		  $msg = "An Error occurred while uploading Backup. Ensure you have an Internet Connection";
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}
?>
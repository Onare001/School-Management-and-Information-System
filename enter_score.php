<?php $page_title = "Enter Score"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
//Just to ensure that the form is filled
$result = mysqli_query($conn,"SELECT * FROM staff_info WHERE user_id='$user_id'");
$info = mysqli_fetch_array($result);
if (empty($info['phone_no']) || empty($info['file_no']) || empty($info['acc_no']) || empty($info['dob']) || empty($info['state_id']) || empty($info['lga']) || empty($info['status_id']) || empty($info['discipline']) || empty($info['address']) || empty($info['sex_id']) || empty($info['qual_id']) || empty($info['type_id']) || empty($info['doa']) || empty($info['dept_id']) || empty($info['rel_id']) || empty($info['post_id'])){
	header("Location:edit_staff_profile");
}

if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['sesid'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['did']);
    $subj_id = decrypt($_GET['sid']);//Subject
    $term_id = decrypt($_GET['tid']);
    $session_id = decrypt($_GET['sesid']);
} else {
	header("Location:enter_class_score");
}

if (isset($_POST['download_csv'])){
	if(getSubjectType($subj_id)=='Elective'){
		$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN registered_subject ON sch_users.user_id = registered_subject.user_id WHERE sch_users.sch_id = '$sch_id' AND sch_users.priv_id = 3 AND registered_subject.sch_id= '$sch_id' AND registered_subject.class_id = '$class_id' AND registered_subject.cat_id = '$cat_id' AND registered_subject.subj_id = '$subj_id' AND registered_subject.user_id ORDER BY sch_users.last_name,sch_users.first_name ASC");
	} else {
		// Execute query and get result set
		$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND sch_users.priv_id='3' AND stdnt_info.class_id='$class_id' AND stdnt_info.cat_id='$cat_id' AND stdnt_info.status_id='1' ORDER BY sch_users.last_name,sch_users.first_name ASC");
	}
	

	// Open CSV file for writing
	$file = fopen('php://temp', 'w+');

	// Write headers to CSV file
	$headers = array('SN', 'LASTNAME', 'FIRSTNAME', 'SUBJECT', '1ST_CA(10)', '2ND_CA(10)', '3RD_CA(10)', 'EXAM_SCORE(70)');
	fputcsv($file, $headers);

	$counter = '0';

	// Loop through result set and write data to CSV file
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$data = array(++$counter, $row['last_name'], $row['first_name'], getSubject($subj_id));
		fputcsv($file, $data);
	}

	// Set file pointer to beginning
	rewind($file);

	// Set headers for file download
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="'.getSubject($subj_id).'-'.getTerm($term_id).'-'.getSession($session_id).'_'.getClass($class_id).getCategory($cat_id).'.csv";');

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
<html lang="en">
<?php include('include/styles2.php');?>
<?php
 if (isset($_POST["upload_csv"])) {
    $target_dir = "csv/"; // Change the directory as per your needs
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Allow only CSV files
    if($fileType != "csv") {
       // echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {   
        $file = fopen($_FILES["fileToUpload"]["tmp_name"], "r");// Open the CSV file for reading

        // Parse the CSV file line by line
        while (($data = fgetcsv($file)) !== FALSE) {
            $sn = $data[0];
            $last_name = $data[1];
			$first_name = $data[2];

            // Check if the student exists in the sch_users table
            $result001 = mysqli_query($conn,"SELECT user_id FROM sch_users WHERE last_name='$last_name' AND first_name='$first_name'");

            if (mysqli_num_rows($result001) == true) {
                // If the student exists, get the user_id
                $row = mysqli_fetch_assoc($result001);
                $uid = $row["user_id"];
			
				// Check whether the score has been entered already
				$result002 = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id='$uid' AND subj_id='$subj_id' AND term_id='$term_id' AND sid='$session_id'");
		
				if (mysqli_num_rows($result002) == true) {
					$msg = 'Score Already Exist for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
					echo '<script>toastr.error("'.$msg.'")</script>';		
				} else {
					$subject = $data[3];
					$first_ca = ScoreFormat($data[4]);
					$sec_ca = ScoreFormat($data[5]);
					$third_ca = ScoreFormat($data[6]);
					$exam = ScoreFormat($data[7]);

					// Validating the scores
					if ($subject == getSubject($subj_id) && $first_ca <= 10 && $sec_ca <= 10 && $third_ca <= 10 && $exam <= 70) {
						$total = $first_ca + $sec_ca + $third_ca + $exam;
						
						if ($total!='0'){
							$result005 = mysqli_query($conn,"INSERT INTO score_info (sch_id, subj_id, class_id, cat_id, user_id, term_id, first_ca, second_ca, third_ca, exam, total, sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$term_id','$first_ca','$sec_ca','$third_ca','$exam','$total','$session_id')");
							
							// Record into Cumulative
							RecordCumulative($sch_id, $subj_id, $class_id, $cat_id,  $session_id, $term_id, $uid, $total);
							
							if ($result005 == true) {
								echo '<script>toastr.success("'.'Score Submitted for '.getLastname($uid).'&nbsp;'.getFirstname($uid).'")</script>';
							} else {
								$msg = "Error: " . "<br>" . mysqli_error($conn);
								$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
							}
						} else {
							$msg = "Zero (0) Scores Skipped<br> Some zero(0) Score Exist";
							$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
						}
					} else {
					  // Display an error message if any score is out of range
					  echo '<script>toastr.error("Invalid Score or Subject.<br> Please ensure all Scores are within the valid range for '.getLastname($uid).'&nbsp;'.getFirstname($uid).'.")</script>';
					}
				}
            } else {
                // If the student does not exist, display an error message
				if($last_name!='LASTNAME' && $first_name!='FIRSTNAME') {
					$msg = 'Error: student '.$last_name.' '.$first_name.' not found';
					echo '<script>toastr.error("'.$msg.'")</script>';
				}
            }
        }
	}
} else if (isset($_POST['submit'])) {
    $uid = decrypt($_POST['student']);
    $first_ca = $_POST['first_ca'];
    $sec_ca = $_POST['sec_ca'];
    $third_ca = $_POST['third_ca'];
	/*$fourth_ca = $_POST['fourth_ca'];
    $fifth_ca = $_POST['fifth_ca'];
    $sixth_ca = $_POST['sixth_ca'];*/
    $exam = $_POST['exam'];

    if (empty($uid)) {
        $msg = 'Select Student Name!';
    } else if ($first_ca == "") {
		$msg = 'Enter First C.A. for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if ($sec_ca == "") {
        $msg = 'Enter Second C.A. for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if ($third_ca == "") {
        $msg = 'Enter Third C.A. for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if ($exam == "") {
        $msg = 'Enter Exam Score for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
        $total = $first_ca + $sec_ca + $third_ca + $exam;// compute the total
		
		if ($total == '0'){
			$msg = 'You cannot submit zero(0) score for a student. You are advised to ignore, if the student has exited the school or did not seat for the examination.';
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		} else {
			 // check whether the score has been entered already
			$result = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id='$uid' AND subj_id='$subj_id' AND term_id='$term_id' AND sid='$session_id'");
			
			if (mysqli_num_rows($result) == true) {
				$msg = 'Score Already Exist for '.getLastname($uid).' '.getFirstname($uid);
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			} else {
				$enter_score = mysqli_query($conn,"INSERT INTO score_info (sch_id, subj_id, class_id, cat_id, user_id, term_id, first_ca, second_ca, third_ca, exam, total, sid) VALUES('$sch_id','$subj_id','$class_id','$cat_id','$uid','$term_id','$first_ca','$sec_ca','$third_ca','$exam','$total','$session_id')");
				//Record into Cummulative
				RecordCumulative($sch_id, $subj_id, $class_id, $cat_id,  $session_id, $term_id, $uid, $total);
				if($enter_score == true){
					$msg = 'Score Entered for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
					$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				} else {
					$msg = 'Unable to Save Score for '.getLastname($uid).'&nbsp;'.getFirstname($uid);
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				}
			}	
		}
	}
}
if (isset($msg) && isset($msg_toastr)) { echo $msg_toastr; }
?>
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>
<?php include('include/page_title.php');?>

			<section class="content">
				<div class="card box-solid" style="margin-left:10px;margin-right:10px;height:60px;width:0 auto;">
					<div class="card-header" id="button-container">
						<form action="" method="post">
							<button title="back" type="button" onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
							<button title="Download CSV Format" type="submit" name="download_csv" id="buttonn" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV Format</button>
							<button title="Upload CSV" type="button" name="upload_csv" id="buttonn" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-upload"></i> Upload CSV</button>
							<button title="Preview Entered Score" type="button" onclick="location.href='preview_score?<?php echo 'cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id);?>'" class="btn btn-primary"><i class="fa fa-eye"></i> Preview Entered Score</button>
							<button title="Instrutions" type="button" id="buttonn" class="btn btn-primary" data-toggle="modal" data-target="#instructions-default"><i class="fa fa-list"></i> Instructions</button>
							<?php if (getSubjectType($subj_id)=='Elective'){
								echo '
							<button title=" Student Subject Registration" type="button" onclick="location.href=\'reg_stu_subj?cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id).'\'" class="btn btn-primary"><i class="fa fa-server"></i>  Stu. Subject Registration</button>';} else {echo '<button title=" Student Subject Registration" disabled type="button" onclick="location.href=\'reg_stu_subj?cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id).'\'" class="btn btn-primary"><i class="fa fa-server"></i> Stu. Subject Registration</button>';}?>
							<button title="Print Score Sheet" type="button" onclick="location.href='view_score_sheet?<?php echo 'cid='.encrypt($class_id).'&cat='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id);?>'" class="btn btn-primary"><i class="fa fa-print"></i> Print Score Sheet</button>
						</form>
					</div>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-12"> 
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"></h3>
									<div style="float:right;">
										<table border="0" align="center" cellspacing="5px" style="width:100%;;">
											<tr>
												<td><b><?php echo strtoupper(getTerm($term_id));?>&nbsp;SCORE&nbsp;&nbsp;</td>
												<td><b>CLASS : <?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?>&nbsp;&nbsp;</td>
												<td><b>SUBJECT : <?php echo strtoupper(getSubject($subj_id));?>&nbsp;&nbsp;</td>
												<td><b>SESSION : <?php echo getSession($session_id);?>&nbsp;&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="card-body">
									<?php
									$result989 = mysqli_query($conn,"SELECT * FROM sch_users JOIN registered_subject ON sch_users.user_id = registered_subject.user_id WHERE sch_users.sch_id = '$sch_id' AND sch_users.priv_id = 3 AND registered_subject.sch_id= '$sch_id' AND registered_subject.class_id = '$class_id' AND registered_subject.cat_id = '$cat_id' AND registered_subject.subj_id = '$subj_id' AND registered_subject.user_id NOT IN (SELECT user_id FROM score_info WHERE score_info.term_id='$term_id' AND score_info.sid='$session_id' AND subj_id='$subj_id') ORDER BY sch_users.last_name ASC");
									
									if ((getSubjectType($subj_id) == 'Core') || ((getSubjectType($subj_id) == 'Elective') && (mysqli_num_rows($result989) != 0))){
									echo '
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th align="center">S/N</th>
											<th align="left">STUDENT NAME</th>
											<th align="center">1ST CA</th>
											<th align="center">2ND CA</th>
											<th align="center">3RD CA</th>
											<th align="center">EXAM SCORE</th>
											<th align="center">ENTER</th>
										</thead>
										<tbody>';
											if (getSubjectType($subj_id )== 'Elective') {
												$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN registered_subject ON sch_users.user_id = registered_subject.user_id WHERE sch_users.sch_id = '$sch_id' AND sch_users.priv_id = 3 AND registered_subject.sch_id= '$sch_id' AND registered_subject.class_id = '$class_id' AND registered_subject.cat_id = '$cat_id' AND registered_subject.subj_id = '$subj_id' AND registered_subject.user_id NOT IN (SELECT user_id FROM score_info WHERE score_info.term_id='$term_id' AND score_info.sid='$session_id' AND subj_id='$subj_id') ORDER BY sch_users.last_name ASC");
											} else {
												$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.sch_id = '$sch_id' AND stdnt_info.status_id = 1 AND sch_users.priv_id = 3 AND stdnt_info.sch_id= '$sch_id' AND stdnt_info.class_id = '$class_id' AND stdnt_info.cat_id = '$cat_id' AND stdnt_info.user_id NOT IN (SELECT user_id FROM score_info WHERE score_info.term_id='$term_id' AND score_info.sid='$session_id' AND subj_id='$subj_id') ORDER BY sch_users.last_name,sch_users.first_name ASC");//LIMIT 10
											}
											while ($row = mysqli_fetch_array($result)){
											echo '	
											<tr>
												<form action="" method="post" id="myForm">				
													<td align="center" width="3px">'. ++$counter.'</td>
													<td>'. strtoupper(getLastname($row["user_id"]).' '.getFirstname($row["user_id"])).'<input name="student" type="hidden" value="'. encrypt($row["user_id"]).'"></td>
													<td align="center">
														<select class="form-control" name="first_ca" id="first_ca">
															<option value="">1ST C.A.</option>';
																for ($i = 0;$i <= 10;$i = $i + 1) {
																	if (strlen($i) < 2) {
																		echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
																	} else {
																		echo "<option value=" . $i . ">" . $i . "</option>";
																	}
																}
														echo '	
														</select>
													</td>
													<td align="center">
														<select class="form-control" name="sec_ca" id="sec_ca">
															<option value="" >2ND C.A.</option>';
																for ($i = 0;$i <= 10;$i = $i + 1) {
																	if (strlen($i) < 2) {
																		echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
																	} else {
																		echo "<option value=" . $i . ">" . $i . "</option>";
																	}
																}
														echo '	
														</select>
													</td>
													<td align="center">
														<select class="form-control" name="third_ca" id="third_ca">
															<option value="" >3RD C.A.</option>';
																for ($i = 0;$i <= 10;$i = $i + 1) {
																	if (strlen($i) < 2) {
																		echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
																	} else {
																		echo "<option value=" . $i . ">" . $i . "</option>";
																	}
																}
															echo '
														</select>
													</td>
													<td align="center">
														<select class="form-control" name="exam" id="exam">
															<option value="">EXAM</option>';
																for ($i = 0;$i <= 70;$i = $i + 1) {
																	if (strlen($i) < 2) {
																		echo "<option value=" . '0' . $i . ">" . '0' . $i . "</option>";
																	} else {
																		echo "<option value=" . $i . ">" . $i . "</option>";
																	}
																}
														echo '
														</select>
													</td>		
													<td align="center">
														<input name="submit" title="Submit Score" type="submit" value="Submit" class="btn btn-primary"/>
													</td>
												</form>
											</tr>';
											}
										echo '
										</tbody>				
									</table>';
									} else {
										echo '<center style="color:red;">There are no Student to display, Click here to register student subject <br> (Tick <input type="checkbox" name="student[]" value="" id="check'.++$counter2.'" checked/>
										<label for="check'.++$counter1.'"></label> only the students offering this subject) <br> <button title="" type="button" onclick="location.href=\'reg_stu_subj?cid='.encrypt($class_id).'&did='.encrypt($cat_id).'&sid='.encrypt($subj_id).'&tid='.encrypt($term_id).'&sesid='.encrypt($session_id).'\'" class="btn btn-primary"><i class="fa fa-server"></i>  Student Subject Registration</button></center>';
									} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title"><i class="fa fa-upload"></i>&nbsp;Upload CSV (Score)</h4>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<h5 style="margin:0px auto;font-size:14px;"><?php echo getSubject($subj_id).'-'.getTerm($term_id).'-'.getSession($session_id).'_'.getClass($class_id).getCategory($cat_id);?> Score</h5>
						<center style="color:red;" class="error"><?php //if (isset($msg)) { echo $msg; }?></center>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
							  <label>Select CSV file to upload:</label>
								<input type="file" name="fileToUpload" accept=".csv" id="fileToUpload" class="form-control" required/> 
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="reset" value="Reset" class="btn btn-danger"/>
									<input type="submit" value="Upload CSV" name="upload_csv" class="btn btn-primary">
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="instructions-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fa fa-list"></i>&nbsp;Instructions</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<ul>
								<li>To work offline, download the CSV file containing the students' names in the class.</li>
								<li>Use Microsoft Excel to open the downloaded file and input the student scores and ensure you save your progress as you go.</li>
								<li>Click on "Upload CSV" to upload the students' scores.</li>
								<li>After a successful upload, verify if all the scores were accurately uploaded.</li>
								<hr>
								<li style="color:red">If you have entered a score for the wrong student(<i><b>not taking the subject</b></i>), kindly contact the administrator and provide them with the student's name, class & category, subject, term and academic session so that the score can be deleted and corrected.</li>
								<li style="color:red">Do not enter zero (0) score for any student even if they are absent for the examination.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php')?>
<script>
function reduceButtons() {
  var buttonContainer = document.getElementById("button-container");
  var buttons = buttonContainer.getElementsByClassName("btn btn-primary");
  var screenWidth = window.innerWidth;
  var buttonCount = buttons.length;

  // Determine whether to show button text or icons based on screen size
  if (screenWidth >= 768) {
    // Show button text if screen width is 768px or greater
    for (var i = 0; i < buttonCount; i++) {
    buttons[0].innerHTML = '<i class="fa fa-arrow-left"></i> Back ';
    buttons[1].innerHTML = '<i class="fa fa-download"></i> Download CSV Format ';
    buttons[2].innerHTML = '<i class="fa fa-upload"></i> Upload CSV ';
    buttons[3].innerHTML = '<i class="fa fa-eye"></i> Preview Entered Score';
    buttons[4].innerHTML = '<i class="fa fa-list"></i> Instructions';
	buttons[5].innerHTML = '<i class="fa fa-server"></i> Stu. Subject Registration';
	buttons[6].innerHTML = '<i class="fa fa-print"></i> Print Score Sheet';
    }
  } else {
    // Show icons if screen width is less than 768px
    for (var i = 0; i < buttonCount; i++) {
      // Show different icons if screen width is less than 768px
    buttons[0].innerHTML = '<i class="fa fa-arrow-left"></i>';
    buttons[1].innerHTML = '<i class="fa fa-download"></i>';
    buttons[2].innerHTML = '<i class="fa fa-upload"></i>';
    buttons[3].innerHTML = '<i class="fa fa-eye"></i>';
    buttons[4].innerHTML = '<i class="fa fa-list"></i>';
	buttons[5].innerHTML = '<i class="fa fa-server"></i>';
	buttons[6].innerHTML = '<i class="fa fa-print"></i>';
    }
  }
}

// Call the function on page load and whenever the window is resized
reduceButtons();
window.addEventListener("resize", reduceButtons);

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script type="text/javascript">
    document.getElementById('first_ca').value = "<?php echo isset($_POST['first_ca']) ? $_POST['first_ca'] : ''; ?>";
    document.getElementById('sec_ca').value = "<?php echo isset($_POST['sec_ca']) ? $_POST['sec_ca'] : ''; ?>";
    document.getElementById('third_ca').value = "<?php echo isset($_POST['third_ca']) ? $_POST['third_ca'] : ''; ?>";
    document.getElementById('exam').value = "<?php echo isset($_POST['exam']) ? $_POST['exam'] : ''; ?>";
</script>
<script type="text/javascript">
    <?php if(isset($enter_score)) {
		// Clear input values after successful submission
		echo '
        document.getElementById("first_ca").value = "";
        document.getElementById("sec_ca").value = "";
        document.getElementById("third_ca").value = "";
        document.getElementById("exam").value = "";
		';
	} ?>
</script>
</html>
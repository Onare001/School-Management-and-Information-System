<?php $page_title = "Student Control Panel"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id = $cat_id = $address = $parent_contact = $relation = $p_name="";
if(isset($_GET['uid'])) {
	$uid = decrypt($_GET['uid']);
	$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid' AND stdnt_info.user_id='$uid'");
	$row = mysqli_fetch_array($result);
		$rel_id = $row["rel_id"];
		$sex_id = $row["sex_id"];
		$class_id = $row["class_id"];
		$cat_id = $row["cat_id"];
		$state_id = $row["state_id"];
		$lga = $row["lga"];
		$admn_no = $row["admn_no"];
		$address = $row["address"];
		$bld_id = $row["bld_grp"];
		$geno_id = $row["gtype"];
		$dob = $row["dob"];
		$p_name = $row["p_name"];
		$parent_contact = $row["parent_contact"];
		$relation = $row["relationship"];
		$type_id = $row["type_id"];
		$club_id = $row["club_id"];
		$sthouse = $row['house_id'];
	} else if (empty($_GET['uid'])){
		//header("location: ert");
	}
	
//Save Student Data
include "include/connection.php";
if (isset($_GET['uid']) && isset($_POST['submit'])) {
	$uid = decrypt($_GET['uid']);
	$last_name = addslashes($_POST['last_name']);
	$first_name = addslashes($_POST['first_name']);
	$username = addslashes($_POST['email']);
	$type_id = addslashes($_POST['type_id']);
	$class_id = addslashes($_POST['class_id']);
	$cat_id = addslashes($_POST['cat_id']);
	$sch_id = addslashes($_POST['sch_id']);
	$rel_id = addslashes($_POST["rel_id"]);
	$sex_id = addslashes($_POST["sex_id"]);
	$class_id = addslashes($_POST["class_id"]);
	$cat_id = addslashes($_POST["cat_id"]);
	$state_id = addslashes($_POST["state_id"]);
	$lga = addslashes($_POST["lga"]);
	$admn_no = addslashes($_POST["admn_no"]);
	$address = addslashes($_POST["address"]);
	$bld_id = addslashes($_POST["bld_grp"]);
	$geno_id = addslashes($_POST["gtype"]);
	$club_id = addslashes($_POST["club_soc"]);
	$house_id = addslashes($_POST["house"]);
	$dob =addslashes($_POST["dob"]);
	$p_name = addslashes($_POST["p_name"]);
	$relation = addslashes($_POST["relation"]);
	$parent_contact = addslashes($_POST["parent_contact"]);
	$type_id = addslashes($_POST["type_id"]);	
//Update info
$update_info = "UPDATE `stdnt_info` SET `class_id`='$class_id', `cat_id` = '$cat_id', `rel_id`='$rel_id',`sex_id`='$sex_id',`dob`='$dob',`state_id`='$state_id',`lga`='$lga',`type_id`='$type_id',`admn_no`= '$admn_no',`address`='$address',`p_name`='$p_name',`relationship`='$relation',`parent_contact`='$parent_contact',`bld_grp`='$bld_id',`gtype`='$geno_id',`house_id`='$house_id',`club_id`='$club_id' WHERE `stdnt_info`.`user_id` = '$uid'";
$result = mysqli_query($conn,$update_info);
		
//Update User
$update_user = "UPDATE `sch_users` SET `first_name`= '$first_name',`last_name`= '$last_name',`username`= '$username' WHERE user_id = '$uid'";
if (mysqli_query($conn,$update_user)){
		$msg = 'Updated Successfully';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';	
     } else {
       $msg = "Error: " . $update_user . ":-" . mysqli_error($conn);
	   $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';	
     }
     mysqli_close($conn);
	 header("location: register_student?cid=" . encrypt($class_id)."&cat=".encrypt($cat_id) . "");
} else if(isset($_POST['submit_passport'])) {
    // Get the file name and size
    $passport_name = $_FILES['passport']['name'];
    $passport_size = $_FILES['passport']['size'];

    // Define the allowed file extensions and their respective error messages
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

    // Define the maximum file size in bytes
    $max_file_size = 200000; // 200KB#

    // Get the file extension
    $file_extension = strtolower(pathinfo($passport_name, PATHINFO_EXTENSION));

    // Check if a file has been selected
    if(empty($passport_name)) {
        $msg = "Please select a file to upload";
        $msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    // Check if the file extension is allowed
    } else if(!in_array($file_extension, $allowed_extensions)) {
        $msg = "Invalid extension, Only JPG, JPEG, PNG or GIF are allowed";
        $msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    // Check if the file size is within the limit 
    } else if($passport_size > $max_file_size) {
        $msg = "File size exceeds the limit of 200kB";
        $msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
        // Get the temporary file name
        $temp_passport_name = $_FILES['passport']['tmp_name'];

        // Define the destination directory where the passport photo will be uploaded
        $destination_dir = PreparePassportDir($uid);

        // Generate a unique name for the passport photo
        $passport_name = getLastName($uid).uniqid().'.'.$file_extension;

        // Resize the image to 150px by 170px
        list($width, $height) = getimagesize($temp_passport_name);
        $new_width = 150;
        $new_height = 170;
        $image = imagecreatefromstring(file_get_contents($temp_passport_name));
        $resized_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the resized image to the destination directory
        imagejpeg($resized_image, $destination_dir.$passport_name, 100);

        // Update the database with the new passport photo
        $result = mysqli_query($conn, "UPDATE sch_users SET passport = '$passport_name' WHERE user_id = '$uid'");
        if ($result){
            $msg = "Passport photo uploaded and saved successfully";
            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        } else {
            $msg = "Unable to upload Passport";
            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        }
    }  
} /*else if (isset($_POST['save_subject'])) {
    // Get selected subjects from the form
    if (isset($_POST["subjects"]) && is_array($_POST["subjects"])) {
        $selectedSubjects = $_POST["subjects"];

        // Insert selected subjects into the database
        foreach ($selectedSubjects as $subject) {
			$result = mysqli_query($conn,"SELECT * FROM registered_subject WHERE user_id='$uid' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subject'");
			if (mysqli_num_rows($result) == false){
				$reg_subj = mysqli_query($conn,"INSERT INTO registered_subject (user_id, sch_id, class_id, cat_id, subj_id) VALUES ('$uid', $sch_id, $class_id, $cat_id, '$subject')");

				if ($reg_subj == TRUE) {
					$msg = "Subject Registration Successful!";
		            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				} else {
					$msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				}
			} else {
				$msg = "Record already exist";
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
        }
    } else {
        $msg = "Please select at least one Subject.";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    }
}*/

else if (isset($_POST['save_subject'])) {
    if (isset($_POST['subjects']) && is_array($_POST['subjects'])) {
        $selectedSubjects = $_POST['subjects'];

        // Insert selected subjects into the database
        foreach ($selectedSubjects as $subject) {
            $result = mysqli_query($conn, "SELECT * FROM registered_subject WHERE user_id='$uid' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subject'");
            if (mysqli_num_rows($result) == false) {
                $reg_subj = mysqli_query($conn, "INSERT INTO registered_subject (user_id, sch_id, class_id, cat_id, subj_id) VALUES ('$uid', $sch_id, $class_id, $cat_id, '$subject')");

                if ($reg_subj == TRUE) {
                    $msg = "Subject Registration Successful!";
                    $msg_toastr = '<script>toastr.success("' . $msg . '")</script>';
                } else {
                    $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    $msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
                }
            } else {
                 $msg = "Subject Registration Successful!";//$msg = "Record already exists";
                $msg_toastr = '<script>toastr.success("' . $msg . '")</script>';
            }
        }

        // Delete unchecked subjects from the previous list (if any)
        $previousSubjects = mysqli_query($conn, "SELECT subj_id FROM registered_subject WHERE user_id='$uid' AND class_id='$class_id' AND cat_id='$cat_id'");
        $previousSubjectsArray = mysqli_fetch_all($previousSubjects, MYSQLI_ASSOC);
        $uncheckedSubjects = array_diff(array_column($previousSubjectsArray, 'subj_id'), $selectedSubjects);

        // Perform deletion logic here (e.g., remove from the database)
        foreach ($uncheckedSubjects as $uncheckedSubject) {
            mysqli_query($conn, "DELETE FROM registered_subject WHERE user_id='$uid' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$uncheckedSubject'");
        }
    } else {
        $msg = "Please select at least one Subject.";
        $msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content" id="classes">
			<?php if (isset($msg)) { echo $msg_toastr;} ?>
				<div class="card card-<?php echo $sch_color;?> card-outline">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-user"></i> Student Control Panel</h3>
					</div>
					<div class="card-body">
						<h4><?php echo getFirstName($uid).' '.getLastName($uid);?></h4>
						<div class="row">
							<div class="col-5 col-sm-3">
								<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Profile Information</a>
									<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Edit Profile</a>
									<a class="nav-link" id="vert-tabs-right-settings-tab" data-toggle="pill" href="#vert-tabs-right-settings" role="tab" aria-controls="vert-tabs-right-settings" aria-selected="false">Registered Subject</a>
									<a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Academic Performance</a>
									<a class="nav-link" id="vert-tabs-right-messages-tab" data-toggle="pill" href="#vert-tabs-right-messages" role="tab" aria-controls="vert-tabs-right-messages" aria-selected="false">Attendance</a>
									<a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">View Payment History</a>
								</div>
							</div>
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-tabContent">
									<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
										<div class="modal-body" id="selectbox">
											<p><center><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:100px;" class="img-circle"/>  <h4><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></h4></center></p>
											<p><b>Class:</b> <?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></p>
											<p><b>Admission Number:</b> <?php echo $row['admn_no'];?></p>
											<p><b>Student Type:</b> <?php echo getStudenttype($row['type_id']);?></p>
											<p><b>Date of Birth:</b> <?php echo getAge($uid).', '.date("jS M, Y", strtotime($row['dob']));?></p>
											<p><b>State of Origin:</b> <?php echo getLga($row['lga']).', '.getState($row['state_id']);?></p>
											<p><b>Home Address:</b> <?php echo $row['address'];?></p>
											<p><b>Parent Name/Contact:</b> <?php echo $row['p_name'].', '.$row['parent_contact'];?></p>	
										</div>
									</div>
									<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
										<?php include('include/edit_stdnt_data.php');?>
									</div>
									<div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
										<!--div class="row"-->
											<!--div class="col-md-6" style="zomm:100%;"-->
												<div class="card card-info">
													<!--div class="card-header">
														<h3 class="card-title">MY ACADEMIC PERFORMANCE</h3>
														<div class="card-tools">
															<button type="button" class="btn btn-tool" data-card-widget="collapse">
																<i class="fas fa-minus"></i>
															</button>
															<button type="button" class="btn btn-tool" data-card-widget="remove">
																<i class="fas fa-times"></i>
															</button>
														</div>
													</div-->
													<!--div class="card-body"-->
														<div class="chart">
															<canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 70%;"></canvas>
														</div>
													<!--/div-->
												</div>
											<!--/div-->
											<?php /*<!--div class="col-md-6">
												<div class="card card-info">
													<div class="card-header">
														<h3 class="card-title">BEHAVIOUR</h3>
														<div class="card-tools">
															<button type="button" class="btn btn-tool" data-card-widget="collapse">
																<i class="fas fa-minus"></i>
															</button>
															<button type="button" class="btn btn-tool" data-card-widget="remove">
																<i class="fas fa-times"></i>
															</button>
														</div>
													</div>
													<div class="card-body">
														<div class="chart">
															<?php include('include/results/behaviour.php');?>
															Honesty <?php echo $a;?><br>
															Puntuality <?php echo $b;?><br>
															------- <?php echo $c;?><br>
															------- <?php echo $d;?><br>
															------- <?php echo $e;?><br>
															------- <?php echo $a;?><br>
															------- <?php echo $b;?><br>
															------- <?php echo $c;?><br>
															------- <?php echo $d;?><br>
															------- <?php echo $e;?><br>
														</div>
													</div>
												</div>
											</div-->*/;?>
										<!--/div-->
									</div>
									<div class="tab-pane fade" id="vert-tabs-right-messages" role="tabpanel" aria-labelledby="vert-tabs-right-messages-tab">
									Attendance Record
									</div>
									<div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
										<div class="col-12">
											<div class="card">
												<div class="card-header">
													<h3 class="card-title"><i class="fa fa-history"></i> Payment History</h3>
													<div class="card-tools">
														<div class="input-group input-group-sm" style="width: 150px;">
															<input type="text" name="table_search" class="form-control float-right" placeholder="Search"/>
															<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
														</div>
													</div>
												</div>
												<div class="card-body table-responsive p-0">
													<table class="table table-hover">
														<thead>
															<th>Reason</th>
															<th>Receipt No.</th>
															<th>Balance</th>
															<th>Term</th>
															<th>Session<br>(class)</th>
															<th>Time/Date</th>
															<th>Status</th>
															<th>Receipt</th>
														</thead>				
														<?php
														$result = mysqli_query($conn,"SELECT * FROM ledger_info WHERE ledger_info.user_id='$uid'");
														while ($row = mysqli_fetch_array($result)){
														echo '					
														<tr>
															<td>'.getPaymenttype($row["payment_type"]).'</td>
															<td>'.$row["receipt_no"].'</td>
															<td>'.'&#8358;'.$row["balance"].'</td>
															<td>'.getTerm($row["term_id"]).'</td>
															<td>'.getSession($row["sid"]).'<br>'.getClass($row["class_id"]).'</td>
															<td>'.$row["date_paid"].'</td> 
															<td>';
																if ($row["payment_status"] == 1){
																	echo '<span class="badge bg-warning">Outstanding</span>';
																	$receipt = '';
																	$view = '';
																} else if ($row["payment_status"] == 2){
																	echo '<span class="badge bg-danger">Denied</span>';
																	$receipt = 'repay?pid=';
																	$view = 'repay';
																} else if ($row["payment_status"] == 3){
																	echo '<span class="badge bg-success">Paid</span>';
																	$receipt = 'view_receipt?pid=';
																	$view = 'view';
																} else {
																	echo '<span class="badge bg-danger">Not paid</span>';
																	$receipt = '';
																	$view = '';
																}
															echo '
															</td>
															<td><a href="'.$receipt. encrypt($row["payment_id"]).'">'.$view.'</a></td>
														</tr>';
														} ?>					
													</table>
												</div>
											</div>
											<div class="card" id="custom" style="padding:10px;">
												<table width="100%" cellspacing="5" cellpadding="5">
													<tr align="center">
														<td>Number of Terms Spent in School:</td>
														<td>Total Outstanding Payment: (Sch fee)</td>
														<td>Total Outstanding Payment: (Other Charges)</td>
													</tr>
													<tr align="center">
														<td><?php echo 'QPSK';//getNoTermSpent($sch_id, $uid);?></td>
														<td><?php echo '₦'.number_format(getStuOutstandingFee($sch_id, $uid, '1'));?></td>
														<td><?php echo '₦'.number_format(getStuOutstandingFee($sch_id, $uid, ''));?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="vert-tabs-right-settings" role="tabpanel" aria-labelledby="vert-tabs-right-settings-tab">
									<?php
										echo '
										<div style="border:1px solid darkblue;padding:5px; font-family: Arial, sans-serif;text-align:center;color:red;">From the list of Elective subjects, tick and save the subject that is peculiar to the student</div>
										<form action="" method="POST">
											<div style="border:1px solid darkblue;padding:5px;display: flex; flex-direction:row; gap:50px; font-family: Arial, sans-serif;">
												<table class="table-striped" border="1" cellspacing="1" cellpadding="1" width="50%">
													<thead>
														<tr>
															<td align="center">SN</td>
															<td>SUBJECT</td>
															<td align="center">TYPE</td>
															<td align="center">
															<div class="icheck-primary">
																<input type="checkbox" value="" id="check"/>
																<label for="check"></label>
															</div></td>
														</tr>
													</thead>
													<tbody>';
												$result = mysqli_query($conn, "SELECT subj_id FROM subj_info WHERE subj_type='Core'");
												while ($row = mysqli_fetch_assoc($result)){
													echo '
														<tr>
															<td align="center">'.++$counter.'</td>
															<td>'.getSubject($row['subj_id']).'</td>
															<td align="center">'.getSubjectType($row['subj_id']).'</td>
															<td align="center">                      
																<div class="icheck-primary">
																	<input type="checkbox" name="subjects[]" value="'.$row['subj_id'].'" id="check'.++$counter2.'"'; echo (getSubjectType($row['subj_id']) == 'Core') ? ' checked ' : ''; echo  'disabled/>
																	<label for="check'.++$counter1.'"></label>
																</div>
															</td>
														</tr>';}
													echo '
														</tbody>
													</table>
													<div style="width:450px;">
													<table class="table-striped" border="1" cellspacing="1" cellpadding="1" width="100%" height="20px;" >
														<thead>
															<tr>
																<td align="center">SN</td>
																<td>SUBJECT</td>
																<td align="center">TYPE</td>
																<td align="center"><div class="icheck-primary">
																	<input type="checkbox" value="" id="check0"'; echo '/>
																	<label for="check0"></label>
																</div></td>
															</tr>
														</thead>
														<tbody>';
													$result = mysqli_query($conn, "SELECT subj_id FROM subj_info WHERE subj_type='Elective'");
													while ($row = mysqli_fetch_assoc($result)){
														echo '
															<tr>
																<td align="center">'.++$counter.'</td>
																<td>'.getSubject($row['subj_id']).'</td>
																<td align="center">'.getSubjectType($row['subj_id']).'</td>
																<td align="center">                      
																	<div class="icheck-primary">
																		<input type="checkbox" name="subjects[]" value="'.$row['subj_id'].'" id="check'.++$counter2.'"' .getRegSubject($uid, $row['subj_id']).'/>
																		<label for="check'.++$counter1.'"></label>
																	</div>
																</td>
															</tr>';
															}
														echo '
														</tbody>
													</table>
													<div style="margin-top:10px;align:center;">
														<center>
															<input name="save_subject" title="Save" type="submit" value="SAVE" class="btn btn-primary"/>
														</center>
													</div>
												</div>
											</div>
										</form>'; ?>
									</div>
								</div>
							</div>
						</div>
						<!--h4 class="mt-4">Right Sided <small>(nav-tabs-right)</small></h4>
						<div class="row">
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-right-tabContent">
									<div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel" aria-labelledby="vert-tabs-right-home-tab">
									1
									</div>
									<div class="tab-pane fade" id="vert-tabs-right-profile" role="tabpanel" aria-labelledby="vert-tabs-right-profile-tab">
									2
									</div>
									<div class="tab-pane fade" id="vert-tabs-right-messages" role="tabpanel" aria-labelledby="vert-tabs-right-messages-tab">
									3
									</div>
									<div class="tab-pane fade" id="vert-tabs-right-settings" role="tabpanel" aria-labelledby="vert-tabs-right-settings-tab">
									4
									</div>
								</div>
							</div>
							<div class="col-5 col-sm-3">
								<div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active" id="vert-tabs-right-home-tab" data-toggle="pill" href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home" aria-selected="true">Home</a>
									<a class="nav-link" id="vert-tabs-right-profile-tab" data-toggle="pill" href="#vert-tabs-right-profile" role="tab" aria-controls="vert-tabs-right-profile" aria-selected="false">Profile</a>
									<a class="nav-link" id="vert-tabs-right-messages-tab" data-toggle="pill" href="#vert-tabs-right-messages" role="tab" aria-controls="vert-tabs-right-messages" aria-selected="false">Messages</a>
									<a class="nav-link" id="vert-tabs-right-settings-tab" data-toggle="pill" href="#vert-tabs-right-settings" role="tab" aria-controls="vert-tabs-right-settings" aria-selected="false">Settings</a>
								</div>
							</div>
						</div-->
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/upload_passport.php');?>
<?php include ('include/ajax/process_lga.php');?>
<?php $user_id=$uid; include ('include/charts/acad_performance.php');?>
</html>
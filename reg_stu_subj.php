<?php $page_title = "Student Subject Registration"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['cid']) && isset($_GET['did']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['sesid'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['did']);
    $subj_id = decrypt($_GET['sid']);//Subject
    $term_id = decrypt($_GET['tid']);
    $session_id = decrypt($_GET['sesid']);
} else {
	header("Location:enter_class_score");
}

if (isset($_POST['save_student'])) {
    // Get selected subjects from the form
    if (isset($_POST["student"]) && is_array($_POST["student"])) {
        $selectedStudents = $_POST["student"];

        // Insert selected subjects into the database
        foreach ($selectedStudents as $student) {
			$result = mysqli_query($conn,"SELECT * FROM registered_subject WHERE user_id='$student' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subj_id'");
			if (mysqli_num_rows($result) === 0){
				$reg_subj = mysqli_query($conn,"INSERT INTO registered_subject (user_id, sch_id, class_id, cat_id, subj_id) VALUES ('$student', $sch_id, $class_id, $cat_id, '$subj_id')");

				if ($reg_subj == TRUE) {
					$msg = "Registration successful!";
		            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				} else {
					$msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				}
			} else {
				$msg = "Registration successful!";//$msg = "Record already exist";
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			}
        }
		
		// Delete unchecked students from the previous list (if any)
        $previousStudents = mysqli_query($conn, "SELECT user_id FROM registered_subject WHERE class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subj_id'");
        $previousStudentsArray = mysqli_fetch_all($previousStudents, MYSQLI_ASSOC);
        $uncheckedStudents = array_diff(array_column($previousStudentsArray, 'user_id'), $selectedStudents);

        // Perform deletion logic here (e.g., remove from the database)
        foreach ($uncheckedStudents as $uncheckedStudent) {
            mysqli_query($conn, "DELETE FROM registered_subject WHERE user_id='$uncheckedStudent' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subj_id'");
        }
    } else {
        $msg = "Please select at least one Student.";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    }
} else if (isset($_POST['rem'])){
	$student_id = decrypt($_POST['stdnt']);
	$result = mysqli_query($conn,"DELETE FROM registered_subject WHERE user_id='$student_id' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subj_id'");
	if ($result){
		$msg = "Record removed successfully.";
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		$msg = "Unable to remove student from list";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
} else if (isset($_POST['add'])) {
	$student_id = decrypt($_POST['stdnt']);
	$result = mysqli_query($conn,"INSERT INTO registered_subject (user_id, sch_id, class_id, cat_id, subj_id) VALUES ('$student_id', $sch_id, $class_id, $cat_id, '$subj_id')");
	if ($result){
		$msg = "Record added successfully.";
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		$msg = "Unable to add student to list";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles2.php');?>
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content"><?php if (isset($msg)) { echo $msg_toastr; }?>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<?php include ("include/regstu_menu.php"); ?>
						</div>
						<div class="col-md-10">	
							<div class="container-fluid">
								<div class="row">
									<div class="col-12"> 
										<div class="card">
											<div class="card-header">
												<h3 class="card-title">Student Subject Registration</h3>
												<div style="float:right;">
													<table border="0" align="center" cellspacing="5px" style="width:100%;;">
														<tr>
															<td><b>CLASS : <?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?>&nbsp;&nbsp;</td>
															<td><b>SUBJECT : <?php echo strtoupper(getSubject($subj_id));?>&nbsp;&nbsp;</td>
														</tr>
													</table>
												</div>
											</div>
											<?php 
											if (getSubjectType($subj_id)!='Elective'){
												echo '<center style="font-size:15px;color:red;">Subject Registration is not available for this subject type</center>';
											} else {
												echo '<form action="" method="POST">
												<div class="card-body">
													<table id="example1" class="table table-bordered table-striped">
														<thead>
															<th align="center">S/N</th>
															<th align="center">
																<div class="icheck-primary">
																	<input type="checkbox" name="" value="" id="check"/>
																	<label for="check"></label>
																</div>
															</th>
															<th align="left">STUDENT NAME</th>
															<th align="center">STUDENT ID</th>
															<th align="center">SUBJECT</th>
															<th align="center">CLASS</th>
															<th align="center">ACTION</th>
														</thead>
														<tbody>';
															if (getSubjectType($subj_id)=='Elective'){
																$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND sch_users.priv_id = '3' AND stdnt_info.sch_id= '$sch_id' AND stdnt_info.class_id = '$class_id' AND stdnt_info.cat_id = '$cat_id' AND stdnt_info.user_id ORDER BY sch_users.last_name,sch_users.first_name ASC");
																while ($row = mysqli_fetch_array($result)){
																echo '	
																<tr>			
																	<td align="center" width="3px">'.++$counter.'</td>
																	<td align="center">
																		<div class="icheck-primary">
																			<input type="checkbox" name="student[]" value="'.$row['user_id'].'" id="check'.(++$counter2 + 2).'" '.getRegSubject($row["user_id"], $subj_id).'/>
																			<label for="check'.(++$counter1 + 2).'"></label>
																		</div>
																	</td>
																	<td>'.strtoupper(getLastname($row["user_id"]).' '.getFirstname($row["user_id"])).'</td>
																	<td align="center">'.getUsername($row["user_id"]).'</td>
																	<td align="center">'.getSubject($subj_id).'</td>
																	<td align="center">'.getClass($class_id).'</td>	
																	<td align="center">
																		<form action="" method="POST">
																			<input name="stdnt" type="hidden" value="'.encrypt($row["user_id"]).'"/>';
																			if (getRegSubject($row["user_id"], $subj_id)){
																				echo '<input name="rem" title="Remove Student" type="submit" value="Remove" class="btn btn-danger"/>';
																			} else {
																				echo '<input name="add" title="Add Student" type="submit" value="Add" class="btn btn-primary"/>';
																			}
																			echo '
																		</form>
																	</td>
																</tr>';
																}
															} else {
																echo '';
															}
															echo
														'</tbody>				
													</table>
													<div style="margin-top:10px;align:center;">
														<center>
														<input name="save_student" title="Save" type="submit" value="SAVE ALL" class="btn btn-primary"/></center>
													</div>
												</div>
											</form>';
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
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
								<li style="color:red">Do not enter zero (0) score for any student even if they are absent.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkAll = document.getElementById("check");
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="student[]"]');
        
        checkAll.addEventListener("change", function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
            });
        });
    });
</script>

</html>
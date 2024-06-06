<?php $page_title = "Check Ward Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_parent.php');?>
<?php
if (isset($_GET['uid'])) {
	$uid = decrypt($_GET['uid']);
} else {
	
}	

$showdata = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE user_id = '$uid' ");
$row = mysqli_fetch_array($showdata) ;
$cat_id = $row['cat_id'];

if (isset($_POST['submit1'])) {
	$pin = $_POST['pin_no'];
	$exam_no = getUsername($uid);
    $class_id = $_POST['class_id'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
	if (empty($pin)){
		$msg = '<span class="badge bg-danger">'.'Enter Pin Number!'.'</span>';
	} else if (empty($class_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Class!'.'</span>';
    } else if (empty($term_id)) {
        $msg = '<span class="badge bg-danger">'.'Select term!'.'</span>';
    } else if (empty($session_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Session!'.'</span>';
    } else { 
        // Verifying whether the PIN NUMBER is valid
        $sql999 = "SELECT * FROM pin_info WHERE pin_code = '$pin'";
		$result419 = mysqli_query($conn,$sql999);
        if (mysqli_num_rows($result419) == true) {
            // Verifying the student
			$result = mysqli_query($conn,"SELECT * FROM sch_users WHERE username = '$exam_no'");
            mysqli_fetch_array($result);
            if (mysqli_num_rows($result) == true) {
                // Checking whether the student has the exam record
				$result = mysqli_query($conn,"SELECT score_id FROM score_info WHERE user_id='$uid' AND class_id='$class_id' AND term_id='$term_id' AND sid='$session_id' AND status='1' AND sch_id='$sch_id'");
                if (mysqli_num_rows($result) == true) {
                    // Verifying whether the PIN NUMBER has been used by another student
					$result = mysqli_query($conn,"SELECT * FROM pin_details WHERE pin_no='$pin' LIMIT 1");
                    $row = mysqli_fetch_array($result);
                    $code = $row['pin_no'];
                    $status = $row['status'];
                    // Verifying whether the PIN NUMBER match with the user
                    if ($code == $pin && $row['user_id'] == $uid) {
                        if ($status >= 5) {
                            // Checking if the PIN has been used more than 5 times
                            $msg = '<span class="badge bg-danger">'.'PIN cannot be used more than 5 times!'.'</span>';
                        } else {
                            $stat = $row['status'] + 1;
                            // Update the PIN record
                            $update = "UPDATE pin_details SET status='$stat' WHERE user_id='$uid' AND pin_no='$pin' LIMIT 1";
							mysqli_query($conn,$update);
                            // redirecting to print the result
                            header("location: student_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) ."&tid=" . encrypt($term_id) . "&sid=" . encrypt($session_id) ."");
                        }
                    } else if ($code == $pin && $row['user_id'] != $uid) {
                        $msg = '<span class="badge bg-danger">'.'PIN has Already been Used!'.'</span>';
                    } else {
                        // Keep record if the PIN is valid but not exist`
                        $insert = "INSERT INTO pin_details (user_id,pin_no,date) VALUES('$uid','$pin',$date)";
						mysqli_query($conn,$insert);
                        // Set session ID
                        //$_SESSION['username'] = $exam_no;
                        // redirecting to print the result
                        header("location: student_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) ."&tid=" . encrypt($term_id) . "&sid=" . encrypt($session_id) ."");
                    }
                } else if (mysqli_num_rows($result) == false) {
                    $msg = '<span class="badge bg-danger">'.getClass($class_id).'&nbsp;'.getTerm($term_id).'&nbsp;'.'Result'.'&nbsp;'.'for'.'&nbsp;'.getSession($session_id).'&nbsp;'.'Academic Session'.'&nbsp;'.'is not Yet Ready!'.'</span>';
                }
            } else if (mysqli_num_rows($result) == false) {
                $msg = '<span class="badge bg-danger">'.'The Username entered does not exist!'.'</span>';
            }
        } else if (mysqli_num_rows($result419) == false) {
            $msg = '<span class="badge bg-danger">'.'The PIN entered does not exist!'.'</span>';
        }
    }
} else if (isset($_POST['submit2'])) { //Cumulative Result
	$pin = $_POST['pin_no'];
	$exam_no = getUsername($uid);
    $class_id = $_POST['class_id'];
    $session_id = $_POST['session_id'];
	if (empty($pin)){
		$msg = '<span class="badge bg-danger">'.'Enter Pin Number!'.'</span>';
	} else if (empty($class_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Class!'.'</span>';
    } else if (empty($session_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Session!'.'</span>';
    } else { 
        // Verifying whether the PIN NUMBER is valid
        $sql999 = "SELECT * FROM pin_info WHERE pin_code = '$pin'";
		$result419 = mysqli_query($conn,$sql999);
        if (mysqli_num_rows($result419) == true) {
            // Verifying the student
            $sql1 = "SELECT * FROM sch_users WHERE username = '$exam_no'";
			$result = mysqli_query($conn,$sql1);
            mysqli_fetch_array($result);
            if (mysqli_num_rows($result) == true) {
                // Checking whether the student has the exam record
                $sql2 = "SELECT score_id FROM cum_result WHERE user_id='$uid' AND class_id='$class_id' AND sid='$session_id' AND status='1' AND sch_id='$sch_id'";
				$result = mysqli_query($conn,$sql2);
                if (mysqli_num_rows($result) == true) {
                    // Verifying whether the PIN NUMBER has been used by another student
					$result = mysqli_query($conn,"SELECT * FROM pin_details WHERE pin_no='$pin' LIMIT 1");
                    $row = mysqli_fetch_array($result);
                    $code = $row['pin_no'];
                    $status = $row['status'];
                    // Verifying whether the PIN NUMBER match with the user
                    if ($code == $pin && $row['user_id'] == $uid) {
                        if ($status >= 5) {
                            // Checking if the PIN has been used more than 5 times
                            $msg = '<span class="badge bg-danger">'.'PIN cannot be used more than 5 times!'.'</span>';
                        } else {
                            $stat = $row['status'] + 1;
                            // Update the PIN record
							mysqli_query($conn,"UPDATE pin_details SET status='$stat' WHERE user_id='$uid' AND pin_no='$pin' LIMIT 1");
                            // redirecting to print the result
                            header("location: student_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) ."&sid=" . encrypt($session_id) ."");
                        }
                    } else if ($code == $pin && $row['user_id'] != $uid) {
                        $msg = '<span class="badge bg-danger">'.'PIN has Already been Used!'.'</span>';
                    } else {
                        // Keep record if the PIN is valid but not exist
                        $insert = "INSERT INTO pin_details (user_id,pin_no,date) VALUES('$uid','$pin',$date)";
						mysqli_query($conn,$insert);
                        // redirecting to print the result
                        header("location: student_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) . "&sid=" . encrypt($session_id) ."");
                    }
                } else if (mysqli_num_rows($result) == false) {
                    $msg = '<span class="badge bg-danger">'.getClass($class_id).'&nbsp;'.'Cumulative'.'&nbsp;'.'Result'.'&nbsp;'.'for'.'&nbsp;'.getSession($session_id).'&nbsp;'.'Academic Session'.'&nbsp;'.'is not Yet Ready!'.'</span>';
                }
            } else if (mysqli_num_rows($result) == false) {
                $msg = '<span class="badge bg-danger">'.'The Username entered does not exist!'.'</span>';
            }
        } else if (mysqli_num_rows($result419) == false) {
            $msg = '<span class="badge bg-danger">'.'The PIN entered does not exist!'.'</span>';
        }
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
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i>&nbsp; Check Ward Result | <?php echo getLastName($uid).'&nbsp;'.getFirstName($uid);?> </h3>
						<?php if (isset($msg)) { echo '<p style="color:red;text-align:center;" class="error">'. $msg.'</p>';} ?>
					</div>
					<div class="card-body">
						<h4><!--Left Sided--></h4>
						<div class="row">
							<div class="col-5 col-sm-3">
								<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Terminal</a>
								<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Cumulative</a>
								</div>
							</div>
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-tabContent">
									<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
										<text style="margin-left:350px;text-align:center;font-weight:bold;">Terminal Result</text>
										<form action="" method="post">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:70%;">
												<tr>
													<td align="left"><div class="col-md-12">
														<input name="pin_no" type="text" placeholder="Enter Pin" maxlength="12" class="form-control"></div>
													</td>
												</tr>
												<tr>
													<td align="left"><div class="col-md-12">
														<input name="ser_no" type="text" placeholder="Enter Pin Serial number" maxlength="13" class="form-control"></div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">    
															<select name="class_id" id="sel_class" class="form-control">
																<?php
																echo '<option value="">'.'Select Class'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
																} ?>
															</select>
														</div>  
													</td>
												</tr>	
												<tr>
													<td>
														<div class="col-md-12">      
															<select name="term_id" id="sel_term" class="form-control">
																<?php
																echo '<option value="">Select Term</option>';
																$result = mysqli_query($conn,"SELECT * FROM term_info");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
																} ?>
															</select>
														</div>  
												   </td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">      
															<select name="session_id" id="sel_session" class="form-control">
																<?php
																echo '<option value="">Select Session</option>';
																$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
																} ?>
															</select>
														</div>  
												   </td>
												</tr>
												<tr>
													<td align="right">
														<div class="col-md-12">&nbsp;
															<input name="submit1" type="submit" value="Check Terminal Result" class="btn btn-primary">
														</div>
													</td>
												</tr>
											</table>
										</form>
									</div>
									<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
										<text style="margin-left:350px;text-align:center;font-weight:bold;">Cumulative Result</text>
										<form action="" method="post">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:70%;">
												<tr>
													<td align="left">
														<div class="col-md-12">
															<input name="pin_no" type="text" placeholder="Enter Pin" maxlength="12" class="form-control">
														</div>
													</td>
												</tr>
												<tr>
													<td align="left">
														<div class="col-md-12">
															<input name="ser_no" type="text" placeholder="Enter Pin Serial number" maxlength="13" class="form-control">
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">    
															<select name="class_id" id="sel_class" class="form-control">
																<?php
																echo '<option value="">'.'Select Class'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
																} ?>
															</select>
														</div>  
													</td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">      
															<select name="session_id" id="sel_session" class="form-control">
																<?php
																echo '<option value="">Select Session</option>';
																$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
																} ?>
															</select>
														</div>  
													</td>
												</tr>
												<tr>
													<td align="right">
														<div class="col-md-12">&nbsp;
															<input name="submit2" type="submit" value="Check Cumulative Result" class="btn btn-primary">
														</div>
													</td>
												</tr>
											</table>	
										</form>
									</div>
								</div>
							</div>
						</div>
					</div> 
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
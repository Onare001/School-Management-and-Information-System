<?php $page_title = "View Cumulative Result"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit1'])) {
    $class_id = $_POST['class_id'];
    $cat_id = $_POST['cat_id'];
    $session_id = $_POST['session_id'];
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    } else { //
        $sql = "SELECT score_id FROM cum_result WHERE sch_id='$sch_id' AND class_id='$class_id' AND cat_id='$cat_id' AND sid='$session_id'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
			$msg = 'Processing Cumulative Result';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			$url = "load_cumulative_result?cid=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&ses_id=" . encrypt($session_id) . "";
            //header("location: $url");
			// JavaScript code to open the URL in a new window
			echo '<script type="text/javascript"> window.open("' . $url . '", "_blank", "width=1200,height=600");</script>';
        } else {
            $msg = 'No Cumulative Result for this Class Check your Entries';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_no_cum_result.mp3" type="audio/mpeg">
			</audio>';
        }
    }
} else if (isset($_POST['submit'])) {
	$username = $_POST['student_id'];
    $uid = getUserid($username);
    $class_id = $_POST['class_id'];
    $cat_id = $_POST['cat_id'];
    $session_id = $_POST['session_id'];
	if (empty($username)) {
		$msg = 'Enter Student ID!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_enter_student_id.mp3" type="audio/mpeg">
			</audio>';
	} else if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    } else { //
        $sql = "SELECT score_id FROM cum_result WHERE sch_id='$sch_id' AND user_id='$uid' AND class_id='$class_id' AND cat_id='$cat_id' AND sid='$session_id'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
			$url = "load_cumulative_result?uid=". encrypt($uid) ."&cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) . "&sid=" . encrypt($session_id) . "";
			// header("location: $url");
			echo '<script type="text/javascript"> window.open("' . $url . '", "_blank", "width=1200,height=600");</script>';
        } else {
            $msg = 'No Cumulative Result Found for this Student';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_no_cum_result_student.mp3" type="audio/mpeg">
			</audio>';
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
						<h3 class="card-title"><i class="fas fa-folder-plus"></i> Cumulative Result </h3>
						<!--center style="margin-bottom:10px;"--><?php if (isset($msg)) { echo $msg_toastr;} ?><!--/center-->
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-5 col-sm-3">
								<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Class</a>
									<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Student</a>
								</div>
							</div>
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-tabContent">
									<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
										<form action="" method="post">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;float:left;">
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="class_id" id="sel_class" class="form-control">
																<?php
																echo '<option value="">'.'Select Class'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
															</select>
														</div>
													</td>
												</tr> 
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="cat_id" id="sel_cat" style="width:100%;" class="form-control">
																<?php
																echo '<option value="">Class Category</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_cat");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["cat_id"].'">'.getCategory($row["cat_id"]).'</option>';
																} ?>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">      
															<select name="session_id" id="session_id" class="form-control">
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
															<input name="submit1" type="submit" value="View Cumulative Result" class="btn btn-primary"/>
														</div>
													</td>
												</tr>
											</table>
										</form>
									</div>
									<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
										<form action="" method="post">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
												<tr>
													<td align="left">
														<div class="col-md-12">
															<input name="student_id" type="text" value="<?php if (isset($_POST['student_id'])) echo $_POST['student_id']; ?>" placeholder="Enter Student ID" maxlength="15" class="form-control"/>
														</div>
													</td>
												</tr>				
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="class_id" id="sel_class" class="form-control">
																<?php
																echo '<option value="">'.'Select Class'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="cat_id" id="sel_cat" class="form-control">
																<?php
																echo '<option value="">'.'Select Category'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM class_cat");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="col-md-12">      
															<select name="session_id" id="session_id" class="form-control">
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
															<input name="submit" type="submit" value="View Cumulative Result" class="btn btn-primary"/>
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
<?php include('include/footer.php');?>
<?php include('include/page_scripts/general_script.php');?>
<?php include('include/page_scripts/options.php');?>
</html>
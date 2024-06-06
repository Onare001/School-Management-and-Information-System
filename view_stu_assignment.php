<?php $page_title = "View Assignments"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
    $cat_id = $_POST['cat_id'];
    $subj_id = $_POST['subj_id'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
    if (empty($class_id)) {
        $msg = 'Please select a Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)) {
        $msg = 'please select a Class Category!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($subj_id)) {
        $msg = 'Please select a Subject!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_subj.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($term_id)) {
        $msg = 'Please select a Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_term.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($session_id)) {
        $msg = 'Please select an Academic session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    }  else {
		$sql = "SELECT user_id FROM staff_info WHERE sch_id='$sch_id' AND user_id='$user_id' AND class_id='$class_id' AND cat_id='$cat_id' AND subj_id='$subj_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            header("location: stu_assignment?cid=" . encrypt($class_id) . "&did=" . encrypt($cat_id) . "&sid=" . encrypt($subj_id) . "&tid=" . encrypt($term_id) . "&sesid=" . encrypt($session_id));
        } else {
            $msg = '<span class="badge bg-danger">'.'Access Denied'.'</span>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_access_denied.mp3" type="audio/mpeg">
			</audio>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
<!--Information-->
<?php include('include/information.php');?>
       
<div class="card card-primary" id="selectbox">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-file"></i> View Students Assignment</h3>
					</div>
					<div class="card-body">
						<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
						<form action="" method="post">		   
							<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
								<tr>
									<td align="left">
										<div class="col-md-12"> 
											<select name="class_id" id="sel_class" style="width:100%;" class="form-control">
												<option value="">Select Class</option>
												<?php
												$result = mysqli_query($conn,"SELECT DISTINCT class_id FROM staff_info WHERE user_id='$user_id' AND class_id !=0 ORDER BY class_id ASC");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
												} ?>
											</select>
										</div>
									</td>		
								</tr>
								<tr>
									<td align="left">
										<div class="col-md-12"> 
											<select name="cat_id" id="sel_cat" style="width:100%;" class="form-control">
												<option value="">Class Category</option>
												<?php
												$result = mysqli_query($conn,"SELECT DISTINCT cat_id FROM staff_info WHERE user_id='$user_id' AND cat_id !=0 ORDER BY cat_id ASC");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row["cat_id"].'">'.getCategory($row["cat_id"]).'</option>';
												} ?>
										</select>
										</div>
									</td>
								</tr> 
								<tr>
									<td align="left">
										<div class="col-md-12"> 
											<select name="subj_id" id="sel_subj" class="form-control">
												<option value="">Select Subject</option>
												<?php
												$result = mysqli_query($conn,"SELECT DISTINCT subj_id FROM staff_info WHERE user_id='$user_id' AND subj_id !=0 ORDER BY subj_id ASC");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['subj_id'].'">'.getSubject($row['subj_id']).'</option>';
												} ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-12">    
											<select name="term_id" id="sel_term" class="form-control">
												<option value="">Select Term</option>
												<?php
												$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
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
												<option value="">Select Session</option>
												<?php
												$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
												} ?>
											</select>
										</div>  
									</td>  
								</tr>
							</table>
							<div class="modal-footer">
								<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
								<input name="submit" type="submit" value="Continue" class="btn btn-primary"/>
							</div>
						</form>    
					</div>
				</div>

<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
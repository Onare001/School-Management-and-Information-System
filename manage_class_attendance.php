<?php $page_title = "Manage Class Attendance"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit'])) {
	$class_id  = $_POST['class_id'];
	$cat_id = $_POST['cat_id'];
	$date = $_POST['date'];
    $term_id = $_POST['term_id'];
    $session_id = $_POST['session_id'];
	if (empty($class_id)){
		$msg = 'Please select a Class!'.'</span>';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($cat_id)){
		$msg = 'Please select a Class Category!'.'</span>';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($date)) {
        $msg = 'Please select a Date!'.'</span>';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Please select a Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = 'Select a Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
		/*$sql = "SELECT user_id FROM ft_list WHERE sch_id='$sch_id' AND user_id='$user_id' AND class_id='$class_id' AND cat_id='$subj_id'";
        $result = mysqli_query($conn, $sql);
		
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);*/
            header("location: attendance_panel?cd=" . encrypt($class_id) . "&ad=" . encrypt($cat_id) . "&dt=" . encrypt($date) . "&td=" . encrypt($term_id) . "&sd=" . encrypt($session_id));
        /*} else {
            $msg = 'Access Denied';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_access_denied.mp3" type="audio/mpeg">
			</audio>';
        }*/
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
       
				<div class="card card-primary" id="selectbox">
					<div class="card-header"><h3 class="card-title"><i class="fa fa-clock"></i> Manage Class Attendance</h3></div>
					<div class="card-body">
					<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
						<form action="" method="post">		   
							<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
								<tr>
									<td align="left">
										<div class="col-md-12"> 
											<input type="date" name="date" value="<?php echo date("Y-m-d");?>" class="form-control"/>
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
												echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
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
											<select name="term_id" id="sel_term" class="form-control">
												<option value="">Select Term</option>
												<?php
												$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status='1'");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
												} ?>
											</select>
										</div>  
									</td>
								</tr>
								<tr>
									<td align="left">
										<div class="col-md-12"> 
											<select name="session_id" id="sel_session" style="width:100%;" class="form-control">
												<option value="">Select Session</option>
												<?php
												$result = mysqli_query($conn,"SELECT sid FROM session_info WHERE done='1' AND status='1'");
												while ($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['sid'].'">'.getSession($row['sid']).'</option>';
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
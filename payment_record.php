<?php $page_title = "Select Class"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_POST['submit'])) {
	$payment_type = addslashes($_POST['payment_type']);
    $class_id = addslashes($_POST['class_id']);
    $cat_id = addslashes($_POST['cat_id']);
	if (empty($payment_type)){
		$msg = 'Select purpose of payment';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($class_id)) {
        $msg = 'Select Class';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($cat_id)){
		$msg = 'Select Class Category';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
        header("location: class_payment_record?class=" . encrypt($class_id) . "&category=" . encrypt($cat_id) . "&pt=" . encrypt($payment_type) . "");
    }
}
?>
<!DOCTYPE html>
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php if (isset($msg)) { echo $msg_toastr; }?>
			<div class="card card-primary" id="selectbox">
				<div class="card-header">
					<h3 class="card-title">Select Class & Category | ACCOUNT UNIT</h3>
				</div>
				<form action="" method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="">Purpose of Payment</label>
							<select name="payment_type" id="sel_type" class="form-control">
								<?php
								echo '<option value="">'.'Purpose of Payment'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id'");
								while ($row = mysqli_fetch_array($result)){	
								echo '<option value="'.$row["payment_id"].'">'.$row["payment_type"].'</option>'; } ?><br/>
							</select>
						</div>	
						<div class="form-group">
							<label for="">Class</label>
							<select name="class_id" id="sel_class" style="width:100%;" class="form-control">
								<?php
								echo '<option value="">'.'Select Class'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
							</select>
						</div>
						<div class="form-group">
							<label for="">Category</label>
							<select name="cat_id" id="sel_cat" style="width:100%;" class="form-control">
								<?php
								echo '<option value="">'.'Select Category'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM class_cat");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
						<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-"></i>Proceed</button>
					</div>
				</form>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
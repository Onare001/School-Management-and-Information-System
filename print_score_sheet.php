<?php $page_title = "Print Score Sheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit'])) {
    $class_id = addslashes($_POST['class_id']);
    $cat_id = addslashes($_POST['cat_id']);
    if (empty($class_id)) {
        $msg = ' Select Class';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)){
		$msg = ' Select Class Category';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
	} else {
		$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id='$class_id' AND cat_id='$cat_id'");
		if (mysqli_num_rows($result)==true){
			header("location: view_score_sheet?cid=" . encrypt($class_id) . "&cat=" . encrypt($cat_id) . "&sid=" . encrypt('0') . "");
		} else {
			$msg = 'No student in the selected class and category';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
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

			<div class="card card-primary" id="selectbox">
				<div class="card-header"><h3 class="card-title">Select Class & Category | Print Score Sheet</h3></div>
				<form action="" method="post">
					<div class="card-body">
						<?php if (isset($msg)){ echo $msg_toastr; } ?>
						<div class="form-group">
							<label>Class</label>
							<select name="class_id" id="sel_class" class="form-control">
								<?php
								echo '<option value="">'.'Select Class'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
							</select>
						  </div>
						<div class="form-group">
							<label>Category</label>
							<select name="cat_id" id="sel_cat" class="form-control">
								<?php
								echo '<option value="">'.'Select Category'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM class_cat");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
						<button type="submit" name="submit" class="btn btn-primary">Proceed</button>         
					</div>
				</form>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
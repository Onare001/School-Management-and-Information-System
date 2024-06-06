<?php $page_title = "Edit Profile"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
       		<?php
		//Just to ensure that the form is filled
		$result = mysqli_query($conn,"SELECT * FROM staff_info WHERE user_id='$user_id'");
		$info = mysqli_fetch_array($result);
		if (empty($info['phone_no']) || empty($info['file_no']) || empty($info['acc_no']) || empty($info['dob']) || empty($info['state_id']) || empty($info['lga']) || empty($info['status_id']) || empty($info['discipline']) || empty($info['address']) || empty($info['sex_id']) || empty($info['qual_id']) || empty($info['type_id']) || empty($info['doa']) || empty($info['dept_id']) || empty($info['rel_id']) || empty($info['post_id'])){
			echo '<div style="width:900px;background-color:red;color:white;padding:10px;margin:0px auto;margin-bottom:5px;">You are expected to complete this form else you won\'t be able to proceed.<p/>All data must be inputted, the disappearance of this info means you can continue until a failed verification occurs</p>Ensure that all the data provided are correct else record will be rejected on verification.</div>';
		}
		?>
    <div class="card card-success" style="width:900px;margin:0px auto;">
		<div class="card-header">
			<h3 class="card-title">Edit Staff Details</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<?php $uid = $user_id;?>
			<?php include('include/edit_staff_data.php');?>
			<?php if (isset($msg)) { echo $msg_toastr; } ?>
        </div>
    </div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/ajax/process_lga.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
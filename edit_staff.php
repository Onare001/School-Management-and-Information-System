<?php $page_title = "Edit Staff Profile"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$uid = $msg_toastr = "";
if (isset($_GET['uid'])) {
    $uid = decrypt($_GET['uid']);
	$staff_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$uid'");
	$sinfo = mysqli_fetch_array($staff_info);
} else {
	header("location:register_staff");
}

if (isset($_POST['submit1'])){
	$maxsize = 200000; // 200KB#  
	$file_name = $_FILES['file_name']['name'];
	$target_dir = "passport/";
	$target_file = $target_dir . $_FILES["file_name"]["name"];

	// Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");

	// Check extension
	if (in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if (($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			$msg = '<span class="badge bg-danger">'.'Photo file too Large. Must be less than 200KB.'.'</span>';
		} else {// Upload   
		if (move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
		// Update record					
		$query = "UPDATE `sch_users` SET `passport` = '$file_name' WHERE `sch_users`.`user_id` = '$uid'";				
		mysqli_query($conn,$query);
		$msg = '<span class="badge bg-success">'.'Passport Uploaded Successfully.'.'</span>';
			}
		}
	} else {
		$msg = '<span class="badge bg-danger">'.'Invalid Photo File.'.'</span>';
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

	<div class="card card-success" style="width:900px;margin:0px auto;">
		<div class="card-header">
			<h3 class="card-title">Edit Staff Details</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<table align="center" border="0" class="table" style="width:100%;">
				<tr>
					<td>
						<img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="width:100%; max-width:120px; max-height:150px;" class="img-circle">
					</td>
					<td>
						<form role="form" action="" method="post" enctype="multipart/form-data">
							<label>Select Passport</label>
							<div class="row">
								<div class="col-6">
									<input type="file" name="file_name" accept="image/*" class="form-control">
								</div>
								<div class="col-6">
									<input name="submit1" type="submit" value="Upload Passport" class="btn btn-primary">
								</div>
							</div> 
						</form>
					</td>
				</tr>
			</table>
			<?php include('include/edit_staff_data.php');?>
			<?php if (isset($msg)){ echo $msg_toastr; }?>
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
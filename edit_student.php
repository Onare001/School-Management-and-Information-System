<?php $page_title = "Edit Student Profile"; ?>
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
}	
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>
<?php include('include/page_title.php');?>  

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<div class="card card-<?php echo $sch_color;?> card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img id="preview" class="profile-user-img img-fluid img-circle" src="<?php echo getPassport($uid);?>" alt="Student-passport"/>
									</div>
									<h3 class="profile-username text-center"><?php echo getFirstname($uid).'&nbsp'.getLastname($uid);?></h3>
									<center><a class="float-center"><?php echo getUsername($uid);?></a></center>
									<p class="text-muted text-center">
										<form action="" method="post" enctype="multipart/form-data">
											<div class="form-group" style="margin:auto; max-width:400px; margin-top:20px; margin-bottom:20px;">
												<div class="input-group">
													<div class="custom-file">
														<input type="file" name="passport" accept="image/*" size="50" class="custom-file-input" id="imageUpload" onchange="previewImage(event)">
														<label class="custom-file-label" for="exampleInputFile">Select a Passport</label>
													</div>
													<div class="input-group-append">
														<input type="submit" name="submit_passport" value="Upload" class="input-group-text"> 
													</div>
												</div>
											</div>	
										</form>
									</p>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item"><b>Class</b> <a class="float-right"><?php echo getClass($class_id);?></a></li>
										<li class="list-group-item"><b>Arm</b> <a class="float-right"><?php echo getCategory($cat_id);?></a></li>
										<li class="list-group-item"><b>House</b> <a class="float-right"><?php echo getHouse($sthouse);?></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="card card-<?php echo $sch_color;?>" style="margin:0px auto;">
								<div class="card-header">
									<h3 class="card-title"> Edit Student Details</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<?php include('include/edit_stdnt_data.php');?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/upload_passport.php');?>
<?php include ('include/ajax/process_lga.php');?>
</html>
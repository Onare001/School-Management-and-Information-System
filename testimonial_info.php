<?php $page_title = "Testimonial Form"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
$result = mysqli_query($conn,"SELECT * FROM testimonial JOIN stdnt_info ON testimonial.user_id=stdnt_info.user_id WHERE testimonial.user_id='$user_id' AND stdnt_info.user_id='$user_id'");
$data = mysqli_fetch_array($result);
	$class_id = $data["class_id"];
	$cat_id = $data["cat_id"];

if (isset($_POST['submit'])) {
	$year_of_admn = addslashes($_POST['adm_year']);
	$office_held = addslashes($_POST["office_held"]);
	$award = addslashes($_POST["award"]);
	$hobbies = addslashes($_POST["hobbies"]);
	
	$result = mysqli_query($conn,"SELECT * FROM testimonial WHERE user_id='$user_id'");
	if(mysqli_num_rows($result) == false){
		$result = mysqli_query($conn,"INSERT INTO testimonial (user_id, year_of_admn, office_held, award, hobbies) VALUES ('$user_id', '$year_of_admn', '$office_held', '$award', '$hobbies')");
		if($result){
			$msg = 'Record Submitted for Processing';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Failed to execute query: ' . mysqli_error($conn);
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	} else {
		$result = mysqli_query($conn,"UPDATE `testimonial` SET  `year_of_admn`='$year_of_admn',`office_held`='$office_held',`award`='$award',`hobbies`='$hobbies' WHERE `testimonial`.`user_id` = '$user_id'");
		if($result){
			$msg = 'Record Updated';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'Failed to execute query: ' . mysqli_error($conn);
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}
} else if (isset($_POST['submit1'])) {
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
        $destination_dir = "passport/";

        // Generate a unique name for the passport photo
        $passport_name = getLastName($user_id).uniqid().'.'.$file_extension;

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
        $result = mysqli_query($conn, "UPDATE sch_users SET passport = '$passport_name' WHERE user_id = '$user_id'");
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

			<div class="card card-default" style="margin-left:100px;margin-right:100px;">
				<div class="card-header">
					<h3 class="card-title" style="color:red">You are expected to Complete this Form as data Provided will be Displayed on Testimonial</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
				<center><?php if (isset($msg) && (isset($msg_toastr))){ echo $msg.$msg_toastr; } ?></center>
				<table align="center" border="0" class="table" style="width:100%;">
					<tr>
						<td>
							<img src="<?php echo getPassport($user_id);?>" alt="<?php echo getLastname($user_id);?>" style="width:100%; max-width:120px; max-height:150px;" class="img-circle">
						</td>
						<td>
							<form role="form" action="" method="post" enctype="multipart/form-data">
							<label>Select Passport</label>
							<div class="row">
							  <div class="col-6"><input type="file" name="passport" accept="image/*" class="form-control"></div>

							  <div class="col-6"><input name="submit1" type="submit" value="Upload Passport" class="btn btn-secondary"></div>
							</div> 
							</form>
						</td>
					</tr>
				</table>
				<div class="card-body">
					<form action="" method="post">
						<fieldset>
							<legend><i class="fa fa-graduation-cap"></i>&nbsp;Testimonial Information</legend>
							<table align="center" border="0" class="table table-striped" style="width:100%;">
								<tr>
									<td>
										<label>First Name</label>
										<input name="first_name" type="text" placeholder="First Name" value="<?php echo getFirstname($user_id);
										?>" class="form-control" disabled />
									</td>
									<td>
										<label>Last Name</label>
										<input name="last_name" type="text" placeholder="Last Name" value="<?php echo getLastname($user_id);
										?>" class="form-control" disabled /> 
									</td>
									<td>
										<label>Admission no.</label>
										<input name="admn_no" type="text" placeholder="Admission no." value="<?php echo $data['admn_no'];?>" class="form-control"/> 
									</td>
								</tr>
								<tr>
									<td>
										<label>Gender</label>
										<select name="sex_id" class="form-control">
											<option value="<?php echo $data["sex_id"];?>"><?php if (empty($data["sex_id"])){echo 'Select Gender';} else {echo getGender($data["sex_id"]);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM gender_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["sex_id"];?>"><?php echo $row["gender"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>Date of Birth</label>
										<input name="dob" type="date" placeholder="DD/MM/YYYY" value="<?php echo $data['dob']; ?>" class="form-control"/>
									</td>
									<td>
										<label>Year of Admission</label>
										<input type="text" name="adm_year" value="<?php echo $data['year_of_admn']; ?>" style="width:100%;" class="form-control"/>
									</td>
								</tr>
								<tr>
									<td>
										<label>Office Held</label>
										<select name="office_held" class="form-control">	
											<option value="<?php echo 'Head Boy';?>"><?php echo 'Head Boy';?></option>
											<option value="<?php echo 'Asst. Head Boy';?>"><?php echo 'Asst. Head Boy';?></option>
											<option value="<?php echo 'Head Girl';?>"><?php echo 'Head Girl';?></option>
											<option value="<?php echo 'Asst. Head Girl';?>"><?php echo 'Asst. Head Girl';?></option>
											<option value="<?php echo 'Class Captain';?>"><?php echo 'Class Captain';?></option>
											<option value="<?php echo 'Asst. Class Captain';?>"><?php echo 'Asst. Class Captain';?></option>
											<option value="<?php echo 'Social Prefect';?>"><?php echo 'Social Prefect';?></option>
											<option value="<?php echo 'Assembly Prefect';?>"><?php echo 'Assembly Prefect';?></option>
											<option value="<?php echo 'House Prefect';?>"><?php echo 'House Prefect';?></option>
											<option value="<?php echo 'Utility Prefect';?>"><?php echo 'Utility Prefect';?></option>
											<option value="<?php echo 'Time Keeper';?>"><?php echo 'Time Keeper';?></option>
										</select> 
									</td>
									<td>
										<label>Award</label>
										<input type="text" name="award" value="<?php echo $data['award']; ?>" class="form-control"/>
									</td>
									<td>
										<label>Hobbies</label>
										<input type="text" name="hobbies" value="<?php echo $data['hobbies']; ?>" class="form-control"/>
										<!--select class="form-control" name="hobbies" id="state-dropdown" style="width:100%;">
											<option value="<?php echo $data['hobbies'];?>"><?php echo getState($data['hobbies']); ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM state_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php //echo $row["state_id"];?>"><?php echo $row["state_name"];?></option><?php } ?><br/>
										</select-->
									</td>
								</tr>
							</table>
						</fieldset>
						<table align="center" border="0"  class="table">
							<tr>
								<td align="right">
									<div class="col-md-12">&nbsp;
										<input name="submit" type="submit" value="Save" class="btn btn-primary"/>
									</div>
								</td>
							</tr> 
						</table>
					</form>  
				</div>
			</div>             
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
<?php		
include 'include/connection.php';
/*if (isset($_POST['submit'])){
	$maxsize = 200000; // 200KB#  
	$file_name = $_FILES['file_name']['name'];
	$target_dir = "passport/";
	$target_file = $target_dir . $_FILES["file_name"]["name"];

	// Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");

	// Check extension
	if( in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			$msg = '<span class="badge bg-danger">'.'File too large. File must be less than 200KB.'.'</span>';
		} else {
			// Upload
			if(move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
				// Insert record
			$query = "UPDATE sch_users SET passport = '$file_name' WHERE user_id = '$user_id]'";
				mysqli_query($conn,$query);
				$msg = '<span class="badge bg-danger">'.'Upload Successfully.'.'</span>';
			}
		}
	} else {
		$msg = '<span class="badge bg-danger">'.'Invalid photo file extension.'.'</span.';
	}
}*/
?>
<?php
if(isset($_POST['submit'])) {
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
        $destination_dir = PreparePassportDir($user_id);

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
			<?php if (isset($msg)) { echo $msg_toastr;} ?>
			<div align="center" style="margin:auto; max-width:400px; margin-top:20px; margin-bottom:20px;" class="alert-danger disabled">Note: Image should not be more than 200kB and the type must be JPG, PNG, or GIF</div>
				<center>
					<img id="preview" src="passport/avatars/avatar_1.png" alt="Image Preview" class="img-circle" alt="User Image" style="width:20%;height:20%;">
				</center>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group" style="margin:auto; max-width:400px; margin-top:20px; margin-bottom:20px;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="passport" accept="image/*" size="50" class="custom-file-input" id="imageUpload" onchange="previewImage(event)">
								<label class="custom-file-label" for="exampleInputFile">Select a Passport</label>
							</div>
							<div class="input-group-append">
								<input type="submit" name="submit" value="Upload" class="input-group-text"> 
							</div>
						</div>
					</div>	
				</form>
				<script type="text/javascript">
				function previewImage(event) {
					var reader = new FileReader();
					reader.onload = function() {
						var preview = document.getElementById('preview');
						preview.src = reader.result;
						preview.style.display = 'block';
					}
					reader.readAsDataURL(event.target.files[0]);
				}

				if ( window.history.replaceState ) {
				  window.history.replaceState( null, null, window.location.href );
				}
				</script>
            
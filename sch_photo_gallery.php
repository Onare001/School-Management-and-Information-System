<?php $page_title = "Photo Gallery"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
//Create folder if not exist
$parentFolder = "sch_gallery";
if (!file_exists($parentFolder . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))))) {
	mkdir($parentFolder . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))), 0777, true);
}
if(isset($_POST['submit'])) {
    // Get the file name and size
   /* $passport_name = $_FILES['file_name']['name'];
    $passport_size = $_FILES['file_name']['size'];

    // Define the allowed file extensions and their respective error messages
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

    // Define the maximum file size in bytes
    $max_file_size = 20000000; // 

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
        $temp_passport_name = $_FILES['file_name']['tmp_name'];

        // Define the destination directory where the passport photo will be uploaded
        $destination_dir = ('sch_gallery' . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))).'/');

        // Generate a unique name for the passport photo
        $passport_name = getSchAcronym($sch_id).rand(0,1000).'.'.$file_extension;

        // Resize the image to 150px by 170px
        /*list($width, $height) = getimagesize($temp_passport_name);
        $new_width = 150;
        $new_height = 170;
        $image = imagecreatefromstring(file_get_contents($temp_passport_name));
        $resized_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);imagejpeg($destination_dir.$passport_name, 100);

        // Save the resized image to the destination directory
        $result = move_uploaded_file($passport_name, $destination_dir);

		// Move the uploaded file to the target directory with the new name
		

        if ($result){
            $msg = "Passport photo uploaded and saved successfully";
            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        } else {
            $msg = "Unable to upload Passport";
            $msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        }
    }  */
}
if (isset($_POST['submit'])){
	$maxsize = 200000000; // 200KB#  
	$file_name = $_FILES['file_name']['name'];
	$target_dir = ('sch_gallery' . '/' .str_replace(' ', '_', strtolower(getSchName($sch_id))).'/');
	$target_file = $target_dir . $_FILES["file_name"]["name"];

	// Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");

	// Check extension
	if( in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			$msg = 'File too large. File must be less than 200KB.';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			// Upload
			if(move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
				$msg = 'Photo Uploaded and Saved Successfully';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			}
		}
	} else {
		$msg = 'Invalid photo file extension.';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
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
					<div class="row"><?php if (isset($msg)) { echo $msg_toastr; }?>
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-camera"></i> Photo Gallery | <i>Times and Moments @ <?php echo getSchname($sch_id);?></i></h3>	
								</div>
								<div class="col-12">
									<div class="card card-primary">
										<div class="card-header">
											<h4 class="card-title">
											<button type="button" class="btn btn-danger" data-toggle="modal"  data-target="#modal-default" style="float:right;">
												<a href="#"><i class="fa fa-plus"></i>&nbsp;Add Photo</a>
											</button></h4>
										</div>
										<div class="card-body">
											<div class="row">
								<?php
								$dir_path = "sch_gallery/".str_replace(' ', '_', strtolower(getSchName($sch_id))); // Replace with your folder path
								$allowed_extensions = array("jpg", "jpeg", "png", "gif", "bmp"); // Add more extensions if needed
								// Loop through all files in the directory
								if (is_dir($dir_path)) {
									if ($dir_handle = opendir($dir_path)) {
										while (($file = readdir($dir_handle)) !== false) {
											// Check if file is an image or web page
											$extension = pathinfo($file, PATHINFO_EXTENSION);
											if (in_array(strtolower($extension), $allowed_extensions)) {
												// Display the file
												if (in_array(strtolower($extension), array("jpg", "jpeg", "png", "gif", "bmp"))) {
													echo '<div class="col-sm-2">
													<input type="checkbox" id="checkAll" onclick="checkAll()"/>
													<img src="'.$dir_path.'/'.$file.'" style="width:100px;"class="img-fluid mb-2" alt="white sample" onclick="showPopup(this.src)"/>
													<caption>'.$file.'</caption>
													</div>';		
												} else {
													echo "$file";
												}
											}
										}
										closedir($dir_handle);
									}
								}
								?>		
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="fa fa-camera"></i>&nbsp;Add Photo</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<center style="color:red;" class="error"><?php if (isset($msg)) { echo $msg; }?></center>
						<form action="" method="post" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="form-group">
									<label for="exampleInputFile">Select file</label>
									<input type="file" name="file_name" accept="image/*" class="form-control" >
								</div>
								<p><input name="caption" value="" type="text" placeholder="Caption" class="form-control"/></p>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input name="submit" type="submit" value="Save" class="btn btn-primary">
							</div>
						</form>			
					</div>
				</div>
			</div>
			<style>
				.popup {
					display: none;
					position: fixed;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background-color: rgba(0,0,0,0.8);
					z-index: 9999;
				}
				.popup img {
					display: block;
					max-width: 90%;
					max-height: 80%;
					margin: auto;
					margin-top: 10vh;
					border: 5px solid white;
					border-radius: 5px;
					box-shadow: 0 0 10px 2px rgba(0,0,0,0.8);
				}
			</style>
			<div id="popup" class="popup" onclick="hidePopup()"><img src=""></div>
			<script>
				function showPopup(src) {
					var popup = document.getElementById("popup");
					popup.style.display = "flex";
					popup.children[0].src = src;
				}
				function hidePopup() {
					var popup = document.getElementById("popup");
					popup.style.display = "none";
					popup.children[0].src = "";
				}
			</script>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
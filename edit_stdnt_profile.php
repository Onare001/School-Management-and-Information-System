<?php $page_title = "Edit Profile"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
$uid = $user_id;
$sql = "SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$user_id' AND stdnt_info.user_id='$user_id'";
$result = mysqli_query($conn,$sql);
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
	$relation = $row["relationship"];
	$parent_contact = $row["parent_contact"];
	$type_id = $row["type_id"];
	$club_id = $row["club_id"];
	$house_id = $row["house_id"];
	$sthouse = $row['house_id'];

include "include/connection.php";
if (isset($_POST['submit'])) {
	//$user_id = decrypt($_GET['uid']);
	#$last_name = addslashes($_POST['last_name']);
	#$first_name = addslashes($_POST['first_name']);
	#$username = addslashes($_POST['email']);
	#$class_id = addslashes($_POST['class_id']);
	#$cat_id = addslashes($_POST['cat_id']);
	$type_id = addslashes($_POST['type_id']);
	$rel_id = addslashes($_POST["rel_id"]);
	$sex_id = addslashes($_POST["sex_id"]);
	$state_id = addslashes($_POST["state_id"]);
	$lga = addslashes($_POST["lga"]);
	$admn_no = addslashes($_POST["admn_no"]);
	$address = addslashes($_POST["address"]);
	$bld_id = addslashes($_POST["bld_grp"]);
	$geno_id = addslashes($_POST["gtype"]);
	$dob =addslashes($_POST["dob"]);
	$p_name = addslashes($_POST["p_name"]);
	$relation = addslashes($_POST["relation"]);
	$parent_contact = addslashes($_POST["parent_contact"]);
	$type_id = addslashes($_POST["type_id"]);
$result = mysqli_query($conn,"UPDATE `stdnt_info` SET  `rel_id`='$rel_id',`sex_id`='$sex_id',`dob`='$dob',`state_id`='$state_id',`lga`='$lga',`type_id`='$type_id',`admn_no`= '$admn_no',`address`='$address',`p_name`='$p_name',`relationship`='$relation',`parent_contact`='$parent_contact',`bld_grp`='$bld_id',`gtype`='$geno_id' WHERE `stdnt_info`.`user_id` = '$user_id'");//`class_id`='$class_id',`cat_id` = '$cat_id',

if ($result){
		echo ('<script>alert("Updated Successfully")</script>');
		header("location: student_dashboard.php");
     } else {
       //echo "Error: " . $update_info . ":-" . mysqli_error($conn);
     }//mysqli_close($conn); 
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
									<h3 class="card-title">Edit Student Details</h3>
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
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/upload_passport.php');?>
<?php include ('include/ajax/process_lga.php');?>
</html>
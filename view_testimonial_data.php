<?php $page_title = "Student Testimonial Data"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
$class_id=""; $cat_id="";
if (isset($_GET['yid']) && isset($_GET['did'])) {
    $yid = decrypt($_GET['yid']);
    $did = decrypt($_GET['did']);
} else {
	header("location: testimonial_data");
}

function getTestimonialRem($user_id){
	include 'include/connection.php';
	$result = mysqli_query($conn,"SELECT remark FROM testimonial WHERE user_id = '$user_id'");
	$row = mysqli_fetch_array($result);
	
	if ($row['remark'] == '1'){
		$remark = '<font color="green">Approved</font>';
	} else {
		$remark = '<font color="red">Pending</font>';
	}
    return $remark;
}

if (isset($_POST['app'])){
	$uid = decrypt($_POST['student']);
	if (1==1){//(getStuOutstandingFee($sch_id, $uid, '1') == '0') && (getStuOutstandingFee($sch_id, $uid, '') == '0')
		$result = mysqli_query($conn, "UPDATE `testimonial` SET `remark`='1' WHERE `testimonial`.`user_id` = '$uid'");
		if ($result){
			$msg = 'Approved';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
		} else {
			$msg = 'You are not Allowed to Approve '.getLastName($uid).' '.getFirstName($uid).'. Refer to the Account Office';
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		}
	} else {
		$msg = 'You are not Allowed to Approve '.getLastName($uid).' '.getFirstName($uid).'. Refer to the Account Office';
		$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
	}
} else if (isset($_POST['den'])){
	$uid = decrypt($_POST['student']);
	$result = mysqli_query($conn, "UPDATE `testimonial` SET `remark`='0' WHERE `testimonial`.`user_id` = '$uid'");
	if ($result){
		$msg = 'Denied';
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
<?php if (isset($msg_toastr)){ echo $msg_toastr; } ?>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Student Testimonial Data | <?php echo getYear($yid).'&nbsp;'.getCategory($did);?> | Approval is subjected to the Student Payment History and Authenticity of the Pre-filled form</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Student Name</th>
												<th>Sex</th>
												<th>DOB</th>
												<th>Year of Admission</th>
												<th>Office Held</th>
												<th>Award</th>
												<th>Hobbies</th>
												<th>Remark</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id JOIN score_info ON score_info.user_id=sch_users.user_id JOIN testimonial ON testimonial.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.status_id!=3 AND stdnt_info.yid='$yid' AND stdnt_info.cat_id='$did' GROUP BY sch_users.user_id");
											while ($row = mysqli_fetch_array($result)){
											$uid = $row['user_id']; $type_id = $row["type_id"]; 
											$sex_id = $row["sex_id"]; $state_id = $row["state_id"];
											?><tr>
												<td align="center"><?php echo ++$counter; ?></td>
												<td><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
												<td><?php echo getGender($sex_id); ?></td>
												<td><?php echo date("jS M, Y", strtotime($dob = $row["dob"]));?></td>
												<td><?php echo $row["year_of_admn"];?></td>
												<td><?php echo $row["office_held"];?></td>
												<td><?php echo $row["award"];?></td>
												<td><?php echo $row["hobbies"];?></td>
												<td><?php echo getTestimonialRem($row['user_id']);?></td>
												<td>
													<form action="" method="post">
														<input type="hidden" name="student" value="<?php echo encrypt($row['user_id']);?>"/>
														<?php 
														if ($row['remark'] == '0'){
															echo '<input name="app" title="Approve" type="submit" value="Approve" class="btn btn-primary"/>';
														} else {
															echo '<input name="den" title="Deny Score" type="submit" value="Deny" class="btn btn-danger"/>';
														}
														?>
													</form>
												</td>
											</tr>
											<?php } ?>               
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
			  </div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<?php include ("include/page_scripts/reducebtn.php"); ?> 
</html>
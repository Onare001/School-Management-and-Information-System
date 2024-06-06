<?php $page_title = "Staff Profile"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content">
				<div class="card card-solid">
					<div class="card-body pb-0">
						<div class="row">
<?php
$result = mysqli_query($conn,"SELECT DISTINCT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.sch_id='$sch_id' GROUP BY staff_info.user_id ORDER BY sch_users.last_name ASC");
while ($row = mysqli_fetch_array($result)){
	$uid = $row['user_id']; $type_id = $row["type_id"]; 
	$sex_id = $row["sex_id"]; $dept_id = $row["dept_id"];
	$status_id = $row["status_id"]; $state_id = $row["state_id"]; $priv = $row["priv_id"]; $address = $row["address"]; $phone = $row["phone_no"]; $subject = $row["subj_id"];			
?>
							<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
								<div class="card bg-light d-flex flex-fill">
									<div class="card-header text-muted border-bottom-0">
										<?php echo getPriviledge($priv);?>
									</div>
									<div class="card-body pt-0">
										<div class="row">
											<div class="col-7">
												<h2 class="lead"><b><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></b></h2>
												<p class="text-muted text-sm"><b>Subject: </b> <?php if(isset($subject)){echo getSubject($subject);}?></p>
												<ul class="ml-4 mb-0 fa-ul text-muted">
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $address;?></li>
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone No.:<?php echo $phone;?></li>
												</ul>
											</div>
											<div class="col-5 text-center">
												<img src="<?php echo getPassport($uid);?>" alt="staff-passport" class="img-circle img-fluid">
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="text-right">
											<a href="admin_compose?uid=<?php echo encrypt($uid);?>" class="btn btn-sm bg-teal">
												<i class="fas fa-comments"></i>
											</a>
											<a href="edit_staff?uid=<?php echo encrypt($uid);?>" class="btn btn-sm btn-primary">
												<i class="fas fa-edit"></i> Edit Profile
											</a>
										</div>
									</div>
								</div>
							</div>
<?php } ?>
						</div>	       
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
<?php $page_title = "Birthday Wall of Honor";?>
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
					<div style="background-color:red;color:white;padding:5px;border-radius:5px;margin-bottom:5px;">Staff: Birthday Celebrants in <?php echo date('M');?></div>
						<div class="row">
						<?php
						$month = date('m'); // Get the current month in MM format
						$result = mysqli_query($conn, "SELECT DISTINCT * FROM sch_users JOIN staff_info ON sch_users.user_id = staff_info.user_id WHERE sch_users.sch_id = '$sch_id' AND MONTH(staff_info.dob) = '$month' GROUP BY staff_info.user_id ORDER BY sch_users.last_name ASC");
						while ($row = mysqli_fetch_array($result)){
						echo '
							<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
								<div class="card bg-light d-flex flex-fill">
									<div class="card-header text-muted border-bottom-0">'.$row['dob'].'</div>
									<div class="card-body pt-0">
										<div class="row">
											<div class="col-7">
												<h2 class="lead"><b>'.getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']).'</b></h2>
												<!--p class="text-muted text-sm"><b>Office(duty): </b> './*(getPriviledge($row["priv_id"])).*/'</p-->
												<ul class="ml-4 mb-0 fa-ul text-muted">
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Office: '.getPriviledge($row["priv_id"]).'</li>
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: '.$row["address"].'</li>
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone No.: '.$row["phone_no"].'</li>
												</ul>
											</div>
											<div class="col-5 text-center">
												<img src="'.getPassport($row['user_id']).'" alt="staff-passport" class="img-circle img-fluid">
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="text-right">
											<a href="admin_compose?uid='.encrypt($row['user_id']).'" class="btn btn-sm bg-teal">
												<i class="fas fa-comments"></i>
											</a>
											<a href="edit_staff?uid='.encrypt($row['user_id']).'" class="btn btn-sm btn-primary">
												<i class="fas fa-edit"></i> Edit Profile
											</a>
										</div>
									</div>
								</div>
							</div>';
						} ?>
						</div>	       
					</div>
				</div>
			</section>
			<section class="content">
				<div class="card card-solid">
					<div class="card-body pb-0">
					<div style="background-color:red;color:white;padding:5px;border-radius:5px;margin-bottom:5px;">Students: Birthday Celebrants in <?php echo date('M');?></div>
						<div class="row">
						<?php
						$result = mysqli_query($conn, "SELECT DISTINCT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id WHERE sch_users.sch_id = '$sch_id' AND MONTH(stdnt_info.dob) = '$month' AND status_id='1' GROUP BY stdnt_info.user_id ORDER BY stdnt_info.dob DESC,sch_users.last_name ASC");
						while ($row = mysqli_fetch_array($result)){
							echo '
							<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
								<div class="card bg-light d-flex flex-fill">
									<div class="card-header text-muted border-bottom-0">
										'./*getPriviledge($row["priv_id"])*/$row['dob'].'
									</div>
									<div class="card-body pt-0">
										<div class="row">
											<div class="col-7">
												<h2 class="lead"><b>'.getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']).'</b></h2>
												<p class="text-muted text-sm"><b>Class: </b> '.getClass($row["class_id"]).' '.getCategory($row['cat_id']).'</p>
												<ul class="ml-4 mb-0 fa-ul text-muted">
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: '.$row["address"].'</li>
													<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Parent Phone No.: '.$row["parent_contact"].'</li>
												</ul>
											</div>
											<div class="col-5 text-center">
												<img src="'.getPassport($row['user_id']).'" alt="staff-passport" class="img-circle img-fluid">
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="text-right">
											<a href="admin_compose?uid='.encrypt($row['user_id']).'" class="btn btn-sm bg-teal">
												<i class="fas fa-comments"></i>
											</a>
											<a href="edit_staff?uid='.encrypt($row['user_id']).'" class="btn btn-sm btn-primary">
												<i class="fas fa-edit"></i> Edit Profile
											</a>
										</div>
									</div>
								</div>
							</div>';
						} ?>
						</div>	       
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
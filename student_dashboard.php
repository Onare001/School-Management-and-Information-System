<?php $page_title = "Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
if (getStatus($user_id) == 'Active'){
	$status_color = "success";
} else if (getStatus($user_id) == 'Inactive') {
	$status_color = "danger";
} else {
	$status_color = "primary";
}

if (getPaymentstatus($user_id, $ctid, $csid) == 0){
	$paymentstatus = 'Not Paid';
	$pay_color = 'danger';
} else if (getPaymentstatus($user_id, $ctid, $csid) == 1){
	$paymentstatus = 'Outstanding';
	$pay_color = 'warning';
} else if (getPaymentstatus($user_id, $ctid, $csid) == 2){
	$paymentstatus = 'Denied';
	$pay_color = '';
} else if (getPaymentstatus($user_id, $ctid, $csid) == 3){
	$paymentstatus = 'Paid';//Approved
	$pay_color = 'success';
} else {
	$paymentstatus = 'Not Paid';
	$pay_color = 'danger';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
<?php include('include/information.php');?>

			<section class="conten">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1">
								<i class="far fa-circle"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Class</span>
									<span class="info-box-number"><?php echo getClass($datarow['class_id']);?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-<?php echo $pay_color?> elevation-1"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">School Fees</span>
									<span class="info-box-number"><?php echo $paymentstatus;?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-<?php echo $status_color;?> elevation-1"><i class="fa fa-user-graduate"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Studentship Status</span>
									<span class="info-box-number"><?php echo getStatus($user_id);?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-clock"></i></span>
								<div class="info-box-content">
									<span class="info-box-text"><?php echo $current_term;?></span>
									<span class="info-box-number"><?php echo $current_session;?><?php //echo substr(getLastlogintime($user_id),0,13);?><br><?php //echo substr(getLastlogintime($user_id),13);?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="card card-widget widget-user-2">
									<div class="widget-user-header bg-<?php echo $sch_color;?>">
										<div class="widget-user-image">
											<img class="img-circle elevation-2" src="<?php echo getPassport($user_id);?>" alt="Student-Passport">
										</div>
										<h3 class="widget-user-username"><?php echo getLastname($user_id).' '.getFirstName($user_id);?></h3>
										<h5 class="widget-user-desc"><?php echo getUsername($user_id);?></h5>
									</div>
									<div class="card-footer p-0">
										<ul class="nav flex-column">
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-chalkboard"></i> Class <span class="float-right"><?php echo getClass($datarow['class_id']).'&nbsp;'.getCategory($datarow['cat_id']).'/'.$user_id;?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-tag"></i> Admission Number <span class="float-right"><?php echo $datarow["admn_no"];?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-venus"></i> Gender <span class="float-right"><?php echo getGender($datarow['sex_id']);?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-home"></i> House <?php echo getHouse($datarow['house_id']);?><br/>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-users"></i> Club & Society <span class="float-right"><?php echo getClub($datarow['club_id']);?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-phone"></i> Phone <span class="float-right">080XX-XXX-XXX</span>
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-info">
									<div class="card-header">
										<h3 class="card-title">MY ACADEMIC PERFORMANCE</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove">
												<i class="fas fa-times"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart">
											<canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title"><i class="fa fa-clock"></i> CLASS TIME TABLE</h3>
							</div>
							<div class="card-body">
								<center>
									<?php include ("include/timetables/class_timetable.php"); ?>
								</center>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="card card-success">
									<div class="card-header">
										<h3 class="card-title">E - NOTICE BOARD</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove">
												<i class="fas fa-times"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart">
										</div>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="card card-danger">
									<div class="card-header">
										<h3 class="card-title">EXAMINATION TIME TABLE</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove">
												<i class="fas fa-times"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart">
											<!--xyx-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/charts/acad_performance.php');?>
</html>
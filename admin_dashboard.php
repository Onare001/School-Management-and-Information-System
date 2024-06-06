<?php $page_title = "Administrative Dashboard";?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php'); ?>
<?php //mysqli_query($conn,"UPDATE score_info SET status = '1' WHERE sch_id = '$sch_id'"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
      
			<section class="conten">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?php echo navigate('manage_term');?>">
								<div class="info-box bg-navy" title="<?php echo 'Current Term and Session';?>">
									<span class="info-box-icon bg-info elevation-1"><i class="fa fa-clock"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo getTerm($ctid);?></span>
										<span class="info-box-number"><?php echo getSession($csid);//$_SERVER['REMOTE_ADDR'];?><small></small></span>
									</div>
								</div>
							</a>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<a href="<?php echo navigate("register_staff");?>">
								<div class="info-box mb-3 bg-navy" title="Total Number of Staff: <?php echo getNumStaff($sch_id);?>">
									<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-tie" ></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Number of Staff</span>
										<span class="info-box-number"><?php echo getNumStaff($sch_id);?></span>
									</div>
								</div>
							</a>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3 bg-navy" title="Academics: <?php echo getNumStafftype($sch_id, 1);?>">
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-chalkboard-teacher"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Academics</span>
									<span class="info-box-number"><?php echo getNumStafftype($sch_id, 1);?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3 bg-navy" title="Non Academics: <?php echo getNumStafftype($sch_id, 2);?>">
								<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user-cog"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Non Academics</span>
									<span class="info-box-number"><?php echo getNumStafftype($sch_id, 2);?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box bg-navy" title="Male Students: <?php echo getNumMale($sch_id);?>">
							<span class="info-box-icon bg-info elevation-1"><i class="fa fa-mars"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Male Students</span>
									<span class="info-box-number"><?php echo getNumMale($sch_id);?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3 bg-navy" title="Female Students: <?php echo getNumFemale($sch_id);?>">
								<span class="info-box-icon bg-pink elevation-1"><i class="fa fa-venus"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Female Students</span>
									<span class="info-box-number"><?php echo getNumFemale($sch_id);?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3" title="Total Number of Students: <?php echo getNumStdnt($sch_id);?>">
							<div class="info-box mb-3 bg-navy" >
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Number of Students</span>
									<span class="info-box-number"><?php echo getNumStdnt($sch_id);?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3"><?php //$sch_capacity = getNumStdnt($sch_id) + getNumStaff($sch_id);?>
							<a href="<?php echo navigate('graduated_students');?>">
								<div class="info-box mb-3 bg-navy" title="Total of Number of Graduated Students: <?php echo getTotalGraduated($sch_id);?>">
									<span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-user-graduate"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Total Graduated</span>
										<span class="info-box-number"><?php echo getTotalGraduated($sch_id); echo getGradYear($sch_id) ? '(<small>since'.'&nbsp;'.getYear(getGradYear($sch_id)).'</small>)' : '';?></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php echo sch_reminder($sch_year, $sch_year2); ?>
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-barchart"></i> School Statistics </h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-5 col-sm-3">
									<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
										<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Number in class by Gender</a>
										<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Total Number in Class</a>
									</div>
								</div>
								<div class="col-7 col-sm-9">
									<div class="tab-content" id="vert-tabs-tabContent">
										<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
											<div class="card card-success">
												<div class="card-header">
													<h3 class="card-title">Number of Students in Class by Gender</h3>
													<div class="card-tools">
														<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
														<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
													</div>
												</div>
												<div class="card-body">
													<div class="chart">
														<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
											<div class="card card-success">
												<div class="card-header">
													<h3 class="card-title">Total Number of Students in Class</h3>
													<div class="card-tools">
														<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
														<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
													</div>
												</div>
												<div class="card-body">
													<div class="chart">
														<canvas id="Chart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card card-success">
								<div class="card-header">
									<h3 class="card-title">Number of Graduated Students by Year</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<canvas id="gradChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div>
							</div>
							<div class="card card-warning">
								<div class="card-header">
									<h3 class="card-title">Number of Staff by Department</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<canvas id="deptChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div>
							</div>
							<div class="card card-danger">
								<div class="card-header">
									<h3 class="card-title">Number of Student by House</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="houseChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card card-danger">
								<div class="card-header">
									<h3 class="card-title">Number of Student by Class</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
									</div>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Number of Staff by Subject</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="staffChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
										<!--font color="red">The accuracy of this graph may be affected by the allocation of subjects among the school's staff.</font-->
									</div>
								</div>
							</div>
							<div class="card card-success">
								<div class="card-header">
									<h3 class="card-title">Number of Students by Clubs and Society</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<canvas id="clubChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/charts/sch_stat.php');?>
</html>
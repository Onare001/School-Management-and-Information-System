	<?php include ("functions/navigator.php"); ?>	
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="#" class="brand-link">
				<img src="assets/img/sms3.png" alt="SMS" class="brand-image img-circle elevation-3"/>
				<span class="brand-text font-weight-light">School Mgmt. System</span>
			</a>
			<div class="sidebar">
				<div class="info brand-text" style="margin-top:5px;font-size:14.5px;">
					<div class="bg badge-success">&nbsp;
						<?php echo '<span id="timer">Loading...</span>'.'&nbsp;'.date("D jS M, Y", strtotime(date("D d M, Y"))) ;?>
					</div>
				</div>
				<div class="user-image mt-3 pb-3">
					<div class="">
						<center>
							<img src="<?php echo ($priviledge == 4) ? 'passport/'.$passport.'' : getSchlogo($sch_id);?>" class="img-size-50 img-circle mr-3" alt="School Logo"/>
						</center>
					</div>
					<div class="info brand-text" style="margin-top:5px;width:5000px;">
						<?php echo $sch_type_label;?></br>
					</div>
				</div>
				<div class="form-inline">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"/>
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>
<?php 
if ($priviledge == 1){
	include('nav_bar/admin_side_nav.php');//Administrator
} else if ($priviledge == 2){
	include('nav_bar/staff_side_nav.php');//Subject Teacher
} else if ($priviledge == 3){
	include('nav_bar/student_side_nav.php');//Student
} else if ($priviledge == 4){
	include('nav_bar/admin_nav.php');//Web Administrator
} else if ($priviledge == 5){
	include('nav_bar/staff_side_nav.php');//Form Teacher
} else if ($priviledge == 6){
	include('nav_bar/staff_side_nav.php');//Head Teacher
} else if ($priviledge == 7){
	include('nav_bar/staff_side_nav.php');//Examination Officer
} else if ($priviledge == 8){
	include('nav_bar/staff_side_nav.php');//House Master
} else if ($priviledge == 9){
	include('nav_bar/staff_side_nav.php');//Account Officer
} else if ($priviledge == 10){
	include('nav_bar/parent_side_nav.php');//Parent
} else {
	echo '';
}
?>
			</div>
		</aside>
<?php $page_title = "Generate Pin"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php
	$sql1 = "SELECT *, COUNT(pin_id) AS num_pin FROM pin_info";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_array($result1);
	$num = $row['num_pin'];//Total Result Checker Available
	
	$sql2 = "SELECT *, COUNT(pin_id) AS used_num_pin FROM pin_details";
	$result2 = mysqli_query($conn,$sql2);
	$row = mysqli_fetch_array($result2);
	$used_num = $row['used_num_pin'];//Used Result Checker
	
	$unused_num = $num - $used_num;//Unused Result Checker
	
	$sql1 = "SELECT *, COUNT(sch_pin_id) AS num_pin2 FROM sch_pin";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_array($result1);
	$num2 = $row['num_pin2'];//Total Sch_pin Available
	
	$sql1 = "SELECT *, COUNT(sch_pin_id) AS num_pin3 FROM sch_pin WHERE status='1'";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_array($result1);
	$num3 = $row['num_pin3'];//Used School Pin
	
	$sql1 = "SELECT *, COUNT(sch_pin_id) AS num_pin2 FROM sch_pin WHERE status='0'";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_array($result1);
	$num4 = $row['num_pin2'];//Unused Sch_pin Available

if (isset($_POST['submit'])){
	$pin_type = $_POST['pin_type'];
	$no_of_pin = $_POST['no_of_pin'];
	//$pin = (rand(100000000000,999999999999));
	if (empty($pin_type)){
		$msg = "Please, Select Pin Type";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($no_of_pin)){
		$msg = "Please, Select Number of pin to Generate";
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		if ($pin_type == 1){//Result Checker
			for ($i = 1;$i <= $no_of_pin; $i++) {
					$generated_pin = rand(1234,9999).rand(4321,9999).rand(2468,9999);
					$sql = "INSERT INTO pin_info (pin_code)	VALUES ('$generated_pin')";
						$result = mysqli_query($conn,$sql);
					if ($result == true){
						$msg = $no_of_pin.' Result checker generated Successfully';
						$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
					} else {
						$msg = 'Sorry! An error occured while trying to generate Result Checker';
						$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
					}
				}
			} else if ($pin_type == 2){//School Activator
			for ($i = 1;$i <= $no_of_pin; $i++) {
					$generated = base64_encode(rand(1234,9999).rand(4321,9999).(date('y')+1).rand(2468,9999).rand(39,99));
					$sql = "INSERT INTO sch_pin (pin_code)	VALUES ('$generated')";
					$result = mysqli_query($conn,$sql);
					if ($result == true){
						$msg = $no_of_pin.' School Activation Pin generated Successfully';
						$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
					} else {
						$msg = 'Sorry! An error occured while trying to generate School Activator';
						$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
					}
				}
		} else {
			$msg = "An Error Occured! Try Again";
			$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
		}
	}
}

if (isset($_POST['empty_sch_activator'])){
	$empty_sch_activator = mysqli_query($conn,"DELETE FROM `sch_pin`");
	if ($empty_sch_activator){
		$msg = 'School Activator Emptied Successfully';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		$msg = 'Unable to Empty School Activator';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
} else if (isset($_POST['empty_result_checker'])){
	$del = mysqli_query($conn,"DELETE FROM `sch_pin`");
		$empty_result_checker = mysqli_query($conn,"DELETE FROM `pin_info`");
	if ($empty_result_checker){
		$msg = 'Result Emptied Successfully';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	} else {
		$msg = 'Unable to Empty Result activator';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	}
}
?>
<?php  //$length = 5; $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length); echo $randomletter;?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fa fa-key"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">School Activator</span>
									<span class="info-box-number"><?php echo $num2;?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-check"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">No. of Used</span>
									<span class="info-box-number"><?php echo $num3;?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-times"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">No. of Unused</span>
									<span class="info-box-number"><?php echo getNumStafftype($sch_id, 1);?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fa fa-award"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Result Checker</span>
									<span class="info-box-number"><?php echo $num;?><!--small>%</small--></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-red elevation-1"><i class="fa fa-check"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">No. of Used</span>
									<span class="info-box-number"><?php echo $used_num;?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-times"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">No. of Unused</span>
									<span class="info-box-number"><?php echo $unused_num;?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-barchart"></i> Generate Pin </h3>
								</div>
								<div class="card-body">
									<!--p style="color:red;text-align:center;" class="error"><?php //if (isset($msg)) { echo ''. $msg;} ?></p-->
									<form action="" method="post">
										<table>
											<tr>
												<td>
													<select name="pin_type" class="form-control">
														<option value="">Select Pin Type</option>
														<option value="1">Result Checker</option>
														<option value="2">School Activator</option>
													</select>
												</td>
												<td>
													<select name="no_of_pin" class="form-control">
														<option value="">Select Number of Pin to Generete</option>
														<?php
															for ($i = 1;$i <= 120;$i++) {
																if ($i < 10) {
																	echo '<option value="' . '00' . $i . '">' . '00' . $i . '</option>';
																} else if ($i >= 10 && $i < 100) {
																	echo '<option value="' . '0' . $i . '">' . '0' . $i . '</option>';
																} else {
																	echo '<option value="' . $i . '">' . $i . '</option>';
																}
															}
															?>
													</select>
												</td>
												<td>
													<button type="submit" name="submit" class="btn btn-primary btn-block">Generate</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
							</div>
							<?php if (isset($msg_toastr)){ echo $msg_toastr; } //? echo $msg_toastr : '';?>
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6">
										<div class="card card-primary">
											<div class="card-header">
												<h3 class="card-title">View Pin</h3>
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
													<form action="" method="post">
														<div class="row">
															<div class="col-md-9">
																<input type="password" name="psswrd" placeholder="Enter" class="form-control"/>
															</div>
															<div class="col-md-3">
																<input type="submit" name="submit5" value="Submit" class="btn btn-primary" style="vertical-align:0px;"/>
															</div>
														</div>
													</form>
													<div style="margin-top:5px;">
													<?php 
													if (isset($_POST['submit5'])){
														$password = md5(addslashes($_POST['psswrd']));//;
														if (empty($password)){
															$msg = 'Enter the Required Input';
														} else {
															$result = mysqli_query($conn,"SELECT * FROM web_admin WHERE admin_id='$user_id' LIMIT 1");
															$row = mysqli_fetch_assoc($result);
															
															if ($password == '7c1e05af3db29eb9c6f16a042a6c2e0f'){/*$row['password']*/
																$result2 = mysqli_query($conn,"SELECT * FROM sch_pin");
																if (mysqli_num_rows($result2) != 0){
																	while($row = mysqli_fetch_array($result2)){
																		echo '<table class="table table-striped" border="1" width="100%">
																		<tr>
																			<td align="center">'.++$counter.'</td>
																			<td>'.base64_decode($row['pin_code']).'</td>
																			<td align="center">'.$row['status'].'</td>
																			<td align="center"><i class="fa fa-trash"></i></td>
																		<tr>
																		</table>';
																	}
																} else {
																	$msg = 'No Activator found';
																	$msg_toastr = '<script>toastr.warning("'.$msg.'")</script>';
																}
						
															}
														}
													}
													?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card card-danger">
											<div class="card-header">
												<h3 class="card-title">Empty Pin</h3>
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
												<form action="" method="post">
													<input type="submit" name="empty_sch_activator" value="Empty School Activator" class="btn btn-primary" style="vertical-align:0px;"/>
													<input type="submit" name="empty_result_checker" value="Empty Result Checker" class="btn btn-primary" style="vertical-align:0px;"/>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<script>
  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
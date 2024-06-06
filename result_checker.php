<?php $page_title = "Print Pin"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php 
 if (isset($_GET['no_of_pin'])){
	 $no_of_pin = base64_decode($_GET['no_of_pin']);
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
			<section class="content" id="classes">
				<div class="card">
					<div class="card-body">
						<?php
						$sql = "SELECT * FROM pin_info WHERE pin_code NOT IN (SELECT pin_no FROM pin_details) LIMIT $no_of_pin";
						$result = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($result)){
						echo '<div class="col-md-3 col-sm-6 col-12" style="float:right;">
							<div class="info-box bg-info">
								<span class="info-box-icon"><i class="fa fa-key"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Result Checker Pin</span>
									<span class="info-box-number">'.$row['pin_code'].'</span>
									<div class="progress">
									<div class="progress-bar" style="width:100%"></div>
									</div>
									<span class="">	Powered by Niel Technologies </span>
								</div>
							</div>
						</div>';
						} ?>
					</div>
				</div>
			</section>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/print.php');?>
</html>
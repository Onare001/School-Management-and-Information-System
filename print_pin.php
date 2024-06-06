<?php $page_title = "Print Pin"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php
	$sql1 = "SELECT *, COUNT(pin_id) AS num_pin FROM pin_info";
	$result1 = mysqli_query($conn,$sql1);
	$row = mysqli_fetch_array($result1);
	$num = $row['num_pin'];
	
	/*$sql2 = "SELECT *, COUNT(pin_info.pin_id) AS used_num_pin FROM pin_info WHERE pin_id IS IN (SELECT pin_id FROM pin_details)";
	$result2 = mysqli_query($conn,$sql2);
	$row = mysqli_fetch_array($result2);*/
	$used_num = "";//$row['used_num_pin'];

$pin_type = "";
	if (isset($_POST['submit'])){
		$sch_id = $_POST['sch_id'];
		$pin_type = $_POST['pin_type'];
		$no_of_pin = $_POST['no_of_pin'];
		//$pin = (rand(100000000000,999999999999));
		if (empty($sch_id)){
			$msg = "Select a demanding School";
		} else if (empty($pin_type)){
			$msg = "Select Pin Type";
		} else if (empty($no_of_pin)){
			$msg = "Select Number of pin to Print";
		} else {
			/*if ($pin_type == 1){//Result Checker
					//$sql = "SELECT * FROM pin_info LIMIT $no_of_pin";
					//$result = mysqli_query($conn,$sql);
				} else if ($pin_type == 2){//School Activator
				//Enter Arguement here
			} else {
				$msg = "An Error Occured! Try Again";
			}*/
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
			<section class="content" id="classes">
				<div class="card card-primary card-outline">
					<div class="card-header"><h3 class="card-title"><i class="fa fa-barchart"></i> Print Pin </h3></div>
					<div class="card-body">
					<p style="color:red;text-align:center;" class="error"><?php if (isset($msg)) { echo ''. $msg;} ?></p>
						<form action="" method="post">
							<table>
								<tr>
									<td>
										<select name="sch_id" id="sel_school" style="width:100%;" class="form-control">
											<option value="">Select School</option>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM sch_info WHERE status = '0'");
											while ($row = mysqli_fetch_array($result)){ ?>
											<option value="<?php echo $row["sch_id"];?>"><?php echo $row["sch_name"];?></option><?php } ?>
										</select>
									</td>
									<td>
										<select name="pin_type" class="form-control">
											<option value="">Select Pin Type</option>
											<option value="1">Result Checker</option>
											<option value="2">School Activator</option>
										</select>
									</td>
									<td>
										<select name="no_of_pin" class="form-control">
											<option value="">Select Number of Pin to Print</option>
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
										<button type="submit" name="submit" class="btn btn-primary btn-block">Print Pin</button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
				<div class="card card-primary card-outline">
					<div class="card-header"><h3 class="card-title"><i class="fa fa-barchart"></i> Print Pin </h3></div>
					<div class="card-body">
						<?php 
						if ($pin_type == 1){//Result Checker
							$sql = "SELECT * FROM pin_info LIMIT $no_of_pin";
							$result = mysqli_query($conn,$sql);
							echo '<a onclick="window.open(\'result_checker.php?no_of_pin='.base64_encode($no_of_pin).'&pin='.base64_encode($row['pin_code']). '\', \'_blank\', \'width=850,height=600\')" class="btn btn-success btn-block"><i class="fa fa-print"> </i> Click Here to Print '.$no_of_pin.' Result Checker</a>';
						} else if ($pin_type == 2 && $sch_id!=0){//School Activator
							$sql = "SELECT * FROM sch_pin WHERE status!=1 ORDER BY rand() LIMIT $no_of_pin ";
							$result = mysqli_query($conn,$sql);
							echo '<a onclick="window.open(\'school_activator.php?sch='.base64_encode($sch_id).'&pin='.base64_encode($row['pin_code']). '\', \'_blank\', \'width=850,height=600\')" class="btn btn-success btn-block"><i class="fa fa-print"> </i> Print Activator</a>';
						} ?>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/print.php');?>
</html>
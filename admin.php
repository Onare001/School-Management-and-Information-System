<?php $page_title = "Web Admin Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php 
//Database connection
include ("include/connection.php");
if (isset($_POST['login'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
	//Validate entries
    $username = validate($_POST['username']);
    //$password = (validate($_POST['password']));//md5
	//$parent_password = validate($_POST['password']);
	/*$Ldate = date('D, dS-M h:i:s A');*/
    if (empty($username)) {
		$msg = 'Username is Required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
		//Check user's credential
        $result = mysqli_query($conn,"SELECT * FROM sch_users WHERE username='$username' LIMIT 1");
		$privilege_id = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) === 1) {
			// Record int log
			$file = 'activity.txt';
			$handle = fopen($file, 'a');
			fwrite($handle, date('Y-m-d H:i:s') . ' - '.$username.' logged in by WebMaster(D.T Onare)' . PHP_EOL);
			fclose($handle);			
				if ($privilege_id['priv_id'] == 1 && $privilege_id['status'] == 1) {
					$_SESSION['username'] = $privilege_id['username'];
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: first_login"); //Administrator,admin_dashboard
				} else if (($privilege_id['priv_id'] == 2 && $privilege_id['status'] == 1) || ($privilege_id['priv_id'] > 4 && $privilege_id['priv_id'] < 9 && $privilege_id['status'] == 1)) {
					$_SESSION['username'] = $privilege_id['username'];
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: staff_dashboard");//Staff
				} else if ($privilege_id['priv_id'] == 9 && $privilege_id['status'] == 1) {
					$_SESSION['username'] = $username;
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: account_dashboard");//Account Officer	
				} else if ($privilege_id['priv_id'] == 4 && $privilege_id['status'] == 1) {
					$_SESSION['username'] = $privilege_id['username'];
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: parent");//Parent
				} else if ($privilege_id['priv_id'] == 3 && $privilege_id['status'] == 1) {
					$_SESSION['username'] = $username;
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: student_dashboard");//Student
				} else if ($privilege_id['priv_id'] > 0 && $privilege_id['status'] == 0) {
					$_SESSION['username'] = $username;
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: user_alert");#Redirects if license is expired
				} else if ($privilege_id['priv_id'] > 0 && $privilege_id['status'] == 3) { 
					$_SESSION['username'] = $username;
					$_SESSION['priv_id'] = $privilege_id['priv_id'];
					header("location: site_alert");# Redirect if Site is being Maintained 
				} else {
					$_SESSION['username'] = '';
					$_SESSION['priv_id'] = '';
				}
			} else {
				$_SESSION['username'] = '';
				$_SESSION['password'] = '';
				$msg = "Invalid Username/Password!";
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}	
    } else if(isset($_POST['activate'])){
		$sch_id = decrypt($_POST['sid']);
		$formattedDate = strtotime($_POST['sch_year']);
		$sch_year = base64_encode(convertDateToYYYYMM(date("Y-F", $formattedDate)));//Next
		
		$formattedDate2 = strtotime(date('Y'.'m'.'d'));
		$sch_year2 = base64_encode(date("Y-F", $formattedDate2));//Current
		
		$entered_actv_key = md5($_POST['actv_key']);
		$actv_key = 'b289109188c279d2524c387547cc5e40';
		if (empty($sch_year)){
			$msg = "Please enter date of Expiration";
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else if (empty($entered_actv_key)) {
			$msg = "Please enter activation key";
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else {
			if ($entered_actv_key == $actv_key){
				$result = mysqli_query($conn,"UPDATE `sch_info` SET `sch_year` = '$sch_year',`status` = '1',`sch_year2` = '$sch_year2' WHERE `sch_info`.`sch_id` = $sch_id");
				$result = mysqli_query($conn,"UPDATE `sch_users` SET `status` = '1' WHERE `sch_users`.`sch_id` = $sch_id");
				if ($result == 'true'){
					$msg = "School Activated Successfully";
					$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				} else {
					$msg = "Unable to activate School";
					$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
				}
			} else {
				$msg = "Invalid activation key";
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>         
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
						<i class="fa fa-history">&nbsp;&nbsp;</i> Registered School | <?php echo 'SCHOOL MANAGEMENT SYSTEM';?></h3>
						<?php if (isset($msg)){echo $msg_toastr;}?>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append">
									<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<?php
						function generateSchoolActivator($expiryYear, $expiryMonth) {
							// Define a character set
							$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

							// Encode the expiry year and month as a 4-character string
							$expiryEncoded = str_pad($expiryYear, 2, '0', STR_PAD_LEFT) . str_pad($expiryMonth, 2, '0', STR_PAD_LEFT);

							// Generate additional 12 random characters
							$randomPart = '';

							for ($i = 0; $i < 12; $i++) {
								$randomPart .= $characters[rand(0, strlen($characters) - 1)];
							}

							// Combine the encoded expiry and the random part
							$activator = $expiryEncoded . $randomPart;

							return $activator;
						}
					?>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<tr align="center">
								  <th>#SN</th>
								  <th>Sch Code</th>
								  <th>Date of Last Sub</th>
								  <th>Subscription Expires</th>
								  <th>Status</th>
								  <th>Profile</th>
								  <th>Subscribe</th>
								  <th>Login</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$result = mysqli_query($conn,"SELECT DISTINCT *,COUNT(sch_users.user_id) AS number_of_users FROM sch_info JOIN sch_users ON sch_info.sch_id=sch_users.sch_id GROUP BY sch_users.sch_id");
								while ($row = mysqli_fetch_array($result)){
									$sch_id = $row["sch_id"];
									$sch_admin = $row['user_id'];
									
									$modal_id = "myModal".$sch_id; $modal_id2 = "sub".$sch_id; // Generate unique ID for modal
									
									$expires_on = base64_decode($row['sch_year']);
									$month = substr($expires_on,4);
									$year = substr($expires_on,0,4);
									$schyear = $year.'-'.$month;
									
									$last_sub_date = base64_decode($row['sch_year2']);
									$month2 = substr($last_sub_date,4);
									$year2 = substr($last_sub_date,0,4);
									$schyear2 = $year2.'-'.$month2;
									
									$status = $row['status'];
								echo '			
								<tr align="center">
									<td>'. ++$counter.'</td>
									<td>'.getSchAcronym($sch_id).'/'.$sch_id.'</td>
									<td>'.date('Y-F', strtotime($schyear2)).'</td>
									<td>'.date('Y-F', strtotime($schyear)).'</td>
									<td>';
									if ($status == 1) {
										echo '<a title="activated" style="text-decoration:none;" href="deactivate.php?sch_id='.encrypt($sch_id).'"><img src="assets/img/tick.png" alt="img"></a>';
									} else if ($status == 0) {
										echo '<a title="deactivated" style="text-decoration:none;" href="activate.php?sch_id='.encrypt($sch_id).'"><img src="assets/img/drop.png" alt="img"></a>';
									}
									echo '
									</td>
									<td align="center"><button title="View Profile" class="btn btn-info view-btn" data-toggle="modal" data-target="#'.$modal_id.'"><i class="fa fa-eye"></i></button></td>
									<td align="center"><button title="View Profile" class="btn btn-info view-btn" data-toggle="modal" data-target="#'.$modal_id2.'"><i class="fa fa-dollar"></i></button></td>
									<form action="" method="post">
										<input type="hidden" name="username" value="'. $row['email'].'"/>
										<td><button type="submit" name="login" class="btn btn-primary btn-block">LOGIN</button></td>
									</form>
								</tr>
								<div class="modal fade" id="'.$modal_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$modal_id.'Label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="'.$modal_id.' Label">School Profile</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p><center><img src="'.getSchLogo($sch_id).'" alt="" style="max-width:60px;" class="img-circle"/>  
												<h4>'.strtoupper(getSchName($sch_id)).'('.$sch_id.')'.'</h4></center></p>
												<p>'.getSchAddress($sch_id).'</p>
												<p><b>Name/Phone of School Admin:</b> '.getLastname($sch_admin).' '.getFirstname($sch_admin).', '.$row["phone"].'</p>
												<p><b>School Email Address:</b> '.$row["email"].'</p>
												<p><b>Number of Registered Users:</b> '.$row["number_of_users"].'</p>	
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="'.$modal_id2.'" tabindex="-1" role="dialog" aria-labelledby="'.$modal_id2.' Label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="'.$modal_id.' Label">Subscribe</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p><center><img src="'.getSchLogo($sch_id).'" alt="" style="max-width:60px;" class="img-circle"/>  
												<h5>'.strtoupper(getSchName($sch_id)).'('.$sch_id.')'.'</h5></center></p>
												<form action="" method="post">
													<div class="modal-body">
														<input type="hidden" name="sid" value="'.encrypt($row['sch_id']).'"/>
														<div class="form-group">
															<label>Expires On</label>
															<input type="date" name="sch_year" id="" class="form-control">
														</div></p>
														<div class="form-group">
															<label>Activation Key</label>
															<input type="password" name="actv_key" placeholder="Activation Key" id="" class="form-control">
														</div></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" name="activate" class="btn btn-primary">Activate</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>';
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
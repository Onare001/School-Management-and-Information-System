<?php $page_title = "Account Settings"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
if ($_SESSION['phone']){

} else {
	//header("location: acc_settings");
}

if (isset($_POST['submit1'])) {
	$payment_type = addslashes($_POST["payment_type"]);
	$amount = addslashes($_POST["amount"]);
	if (empty($payment_type)) {
		$msg = 'Please enter Payment type';
	} else if (empty($amount)) {
		$msg = 'Enter an Amount to be Paid';
	} else {
		//Check if Payment already exist
		$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id' AND payment_type='$payment_type'");
		if (mysqli_num_rows($result) == true) {
			$msg = 'This Entry already Exist';
		} else {
			//Insert Payment Type
			$result = mysqli_query($conn,"INSERT INTO payment_type (sch_id, payment_type, amount) VALUES ('$sch_id', '$payment_type', '$amount')");
			//Fedback if Successfully Submitted			
			if ($result == true) {
				$msg = "Purpose of Payment Submitted Successfully";
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Something went wrong";
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			}
		}
	}
} else if (isset($_POST['submit2'])) {
	$payment_type = addslashes($_POST["payment_id"]);
	$acc_no = addslashes($_POST["acc_no"]);
	$acc_name = addslashes($_POST["acc_name"]);
	$bank_id = addslashes($_POST["bank_id"]);
	if (empty($payment_type)) {
		$msg = 'Please Select Payment type';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($acc_no)) {
		$msg = 'Please Enter Account Number';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($acc_name)) {
		$msg = 'Please Enter Account Name';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else if (empty($bank_id)){
		$msg = 'Please Select a Bank';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
	} else {
		//Check if Payment already exist
		$sql0 = "SELECT * FROM account_details WHERE sch_id='$sch_id' AND payment_id='$payment_type'";
		$result = mysqli_query($conn,$sql0);

		if (mysqli_num_rows($result) == true) {
			$msg = 'This Entry already Exist';
		} else {
			//Insert Payment Info
			$pay_info = "INSERT INTO account_details (sch_id, acc_no, acc_name, bank_id, payment_id) VALUES ('$sch_id', '$acc_no', '$acc_name', '$bank_id', '$payment_type')";
			$result = mysqli_query($conn,$pay_info);

		//Fedback if Successfully Submitted			
			if ($result == true) {
				$msg = 'Payment Type Added Successfully';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else {
				$msg = "Error: " . $pay_info . ":-" . mysqli_error($conn);
				$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			}
		}
	}
} else if (isset($_POST['submit3'])){
	$set_payment_channel = $_POST['payment_channel'];
	if (mysqli_query($conn,"UPDATE `sch_info` SET `payment_channel` = '$set_payment_channel' WHERE `sch_info`.`sch_id` = $sch_id")){
		$msg = 'Position Setting Saved';
		$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
	}	
} else if (isset($_GET['fuid'])){//Delete Form Teacher
	$fuid = decrypt($_GET['fuid']);
	$sql = "DELETE FROM `form_teacher_info` WHERE `form_teacher_info`.`user_id` = '$fuid' AND sch_id = '$sch_id'";
	mysqli_query($conn,$sql);
	$sql2 = "UPDATE `sch_users` SET `priv_id` = '2' WHERE `sch_users`.`user_id` = $fuid";
	mysqli_query($conn,$sql2);
	header('location: acc_settings');
} 
$online = ""; $offline = "";
$show_pstn = "SELECT payment_channel FROM sch_info WHERE sch_id = '$sch_id'";
$result = mysqli_query($conn,$show_pstn);
$row = mysqli_fetch_array($result);
$postn = $row['payment_channel'];
	if($postn == 1){
		$online = "checked";
	} else if ($postn == 0){
		$offline = "checked";
	}		
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

		<link rel="stylesheet" href="assets/css/tab_style.css">
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<div class="row" style="width:auto;margin:0px auto;">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title"><i class="fa fa-credit-card"></i> <i class="fa fa-cog"></i> Account Settings
							<?php if (isset($msg)) { echo $msg_toastr;}?></h5>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<div class="btn-group">
									<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"><i class="fas fa-wrench"></i></button>
									<div class="dropdown-menu dropdown-menu-right" role="menu">
										<a href="#" class="dropdown-item">Action</a>
										<a href="#" class="dropdown-item">Another action</a>
										<a href="#" class="dropdown-item">Something else here</a>
										<a class="dropdown-divider"></a>
										<a href="#" class="dropdown-item">Separated link</a>
									</div>
								</div>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<ul class="accordion-tabs-minimal">
									<li class="tab-header-and-content">
										<a href="#sch_logo" class="tab-link is-active">Purpose of Payment/Fee</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary">
													<div class="card-header with-border"><h3 class="card-title"><i class="fa fa-info-circle">&nbsp;&nbsp;</i>Purpose of Payments</h3></div>
														<div style="padding:20px;">
															<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
															<div class="card-header with-border">
															<form action="" method="post">
																<table border="0" align="center" style="border-collapse:collapse; width:95%;margin-left:30px;">
																	<tr>
																		<td><input name="payment_type" type="text" placeholder="Payment Type" class="form-control" required></td>  
																		<td><input name="amount" type="text" placeholder="Amount E.g  25000 Without Comma, Unit or Spaces" class="form-control" required></td>  
																		<td><input name="submit1" type="submit" value="Add" class="btn btn-primary"></td>
																	</tr>
																</table>
															</form>
															</div>
														</div>
														<div class="col-12">
															<div class="card">
																<div class="card-header">
																	<h3 class="card-title"></h3>
																	<div class="card-tools">
																		<div class="input-group input-group-sm" style="width:150px;">
																			<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
																			<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
																		</div>
																	</div>
																</div>
																<div class="card-body table-responsive p-0">
																	<table class="table table-hover">
																		<thead>
																			<th>#SN</th>
																			<th>Payment Type</th>
																			<th>Amount</th>
																			<th>Edit</th>
																			<th>Status</th>
																			<th align="center">Action</th>
																		</thead>			
																	<?php
																	$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id = '$sch_id'");
																	while ($row = mysqli_fetch_array($result)){
																	$payment_id = $row["payment_id"];
																	?>		
																	<tr>
																		<td><?php echo ++$counter;?></td>
																		<td><?php echo getPaymenttype($payment_id);?></td>
																		<td><?php echo '&#8358;'.number_format(getAmount($payment_id));?></td>
																		<td><a href="#"><img src="assets/img/edit.png"/><a></td>
																		<td><a style="text-decoration:none;" href="#"><?php if ($row["status"]=='1') echo "Active"; else echo "Inactive"; ?><a></td>
																		<td><a style="text-decoration:none;" <?php if ($row["status"]=='1') echo "<a href=deactivate.php?pid=".$row['payment_id']."><img src=assets/img/tick.png alt=active></a>"; 
																		else echo "<a href=activate.php?pid=".$row['payment_id']."><img src=assets/img/drop.png alt=active></a>"; ?></td>
																	</tr>
																	<?php } ?>					
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</p>
										</div>
									</li>
									<!--tab 2-->
									<li class="tab-header-and-content">
										<a href="#class_setup" class="tab-link"> Account Details </a>
										<div class="tab-content">
											<p>
											<div class="card card-primary">
												<div class="card-header with-border"><h3 class="card-title"><i class="fa fa-info-circle">&nbsp;&nbsp;</i>School Account Details</h3></div>
												<div style="padding:20px;">
												<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
													<div class="card-header with-border">
														<form action="" method="post">
															<table border="0" align="center" style="border-collapse:collapse; width:100%;">
																<tr>
																	<td>
																		<select name="payment_id"  id="payment-dropdown" class="form-control" required>
																			<option value=""> Select Payment Type</option>
																			<?php
																			$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id = '$sch_id'");
																			while ($row = mysqli_fetch_array($result)){ ?>
																			<option value="<?php echo $row["payment_id"];?>"><?php echo $row["payment_type"];?></option>
																			<?php } ?>
																		</select>
																	</td>
																	<td><select name="amount" id="amount-dropdown" class="form-control" disabled></select></td> 
																	<td><input name="acc_no" type="text" placeholder="Account Number" maxlength="10" class="form-control" required/></td>
																	<td><input name="acc_name" type="text" placeholder="Account Name" class="form-control" required></td>
																	<td>
																		<select name="bank_id"  placeholder="Bank" class="form-control" required>
																			<option value="">Bank</option>
																			<?php
																			$result = mysqli_query($conn,"SELECT * FROM bank_info");
																			while ($row = mysqli_fetch_array($result)){ ?>
																			<option value="<?php echo $row["bank_id"];?>"><?php echo $row["bank"];?></option>
																			<?php } ?>
																		</select>
																	</td>
																	<td><input name="submit2" type="submit" value="Add" class="btn btn-primary" style="vertical-align:top; height:34px;"/></td>
																</tr>
															</table>
														</form><p>
													</div>
												</div>
												<div class="col-12">
													<div class="card">
														<div class="card-header">
														<h3 class="card-title"></h3>
															<div class="card-tools">
																<div class="input-group input-group-sm" style="width: 150px;">
																	<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
																	<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
																</div>
															</div>
														</div>
														<div class="card-body table-responsive p-0">
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th>#SN</th>
																		<th>Payment Type</th>
																		<th>Amount</th>
																		<th>Account Number</th>
																		<th>Account Name</th>
																		<th>Bank</th>
																		<th>Edit</th>
																		<th>Status</th>
																	</tr>
																</thead>	
																<?php
																$sql = "SELECT * FROM account_details JOIN payment_type ON account_details.payment_id = payment_type.payment_id WHERE account_details.sch_id = '$sch_id'";
																$result = mysqli_query($conn,$sql);
																while ($row = mysqli_fetch_array($result)){
																$payment_id = $row["payment_id"];
																$acc_no = $row["acc_no"];
																$acc_name = $row["acc_name"];
																$bank_id = $row["bank_id"];
																?>
																<tbody>
																	<tr>
																	  <td><?php echo ++$counter1;?></td>
																	  <td><?php echo getPaymenttype($payment_id);?></td>
																	  <td><?php echo '&#8358;'.number_format(getAmount($payment_id));?></td>
																	  <td><?php echo $acc_no;?></td>
																	  <td><?php echo $acc_name;?></td>
																	  <td><?php echo getBank($bank_id);?></td>
																	  <td><a href="#"><img src="assets/img/edit.png"/><a></td>
																	  <td align="center"><?php if ($row["status"]== 1) {
																			echo '<img src="assets/img/tick.png" alt="active"/>';
																		  } 
																		else { 
																			echo '<img src="assets/img/drop.png" alt="inactive">';
																	} ?></td>
																	</tr>
																</tbody>
																<?php } ?>					
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
											</p>    
										</div>
									</li>
									<!--tab 3-->
									<li class="tab-header-and-content">
										<a href="#class_category" class="tab-link">Mode of Payment</a>
										<div class="tab-content">
											<p>
											<div class="card card-primary" id="selectbox">
												<div class="card-header with-border"><h3 class="card-title">Mode of Payment</h3></div>
												<div class="card-body">
													<form action="" method="post">
														<table border="0" align="center" border="0" class="table" style="width:100%;">
															<tr>
																<td>
																	<div class="col-md-12"><b>Channel for Receiving Payment</b></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">  
																		<input name="payment_channel" type="radio" value="1" <?php echo $online;?>> Pay Online (Paystack Payment gateway)
																		<p><input name="payment_channel" type="radio" value="0" <?php echo $offline;?>> Pay in School (Record Only)
																	</div>  
																</td>
															</tr>
														</table>
														<div class="modal-footer">
															<input name="submit3" type="submit" value="Save Settiing" class="btn btn-success">       
														</div>
													</form>
												</div>
											</div>
											</p>
										</div>
									</li>
									<!-- tab 3 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link">Bursars</a>
										<div class="tab-content">
											<p>
												<div class="card">
													
													<div class="card-body">
														<table id="example1" class="table table-bordered table-striped">
															<thead>
																<th style="width:10px;">S/N</th>
																<th style="width:20px;">Passport</th>
																<th>Full Name</th>
																<th>Email Address</th>
																<th>Privilege</th>
																<th>Class</th>
																<th>Edit</th>
																<th>Relief</th>
															</thead>
															<tbody>				
					<?php
					$result = mysqli_query($conn,"SELECT * FROM form_teacher_info JOIN sch_users ON form_teacher_info.user_id = sch_users.user_id AND form_teacher_info.sch_id = sch_users.sch_id WHERE (sch_users.priv_id=6 OR sch_users.priv_id=9) AND form_teacher_info.sch_id = '$sch_id' ORDER BY form_teacher_info.class_id,cat_id,sch_users.priv_id ASC");
						while ($row = mysqli_fetch_array($result)){ ?>
																<tr>
																	<td><?php echo ++$counter2;?></td>
																	<td align="center">
																		<img src="<?php echo getPassport($row["user_id"]);?>" alt="<?php echo getFirstname($row["user_id"]);?>" style="max-width:40px;" class="img-circle"/>
																	</td>	
																	<td><?php echo getLastname($row["user_id"]); echo '&nbsp;'.getFirstname($row["user_id"]);?></td>		
																	<td><?php echo getUsername($row["user_id"]);?></td>
																	<td><?php echo getPriviledge($row['priv_id']);?></td>	
																	<td><?php 
																		if ($row['priv_id']==5){
																			echo getClass($row["class_id"]).'&nbsp;'.getCategory($row["cat_id"]);
																		} else {
																			echo 'Universal';
																		}?></td>
																	<td class="border" align="center" width="5%"><a title="Privilege" href="edit_privilege?uid=<?php echo encrypt($row["user_id"]); ?>"><img src="assets/img/dev.png" width="16" height="16" alt="img"></a></td>
																	<td class="border" align="center" width="5%"><a onclick="return confirm('Are you sure you want to remove <?php echo getFirstname($row['user_id']);?> from being a <?php echo getPriviledge($row['priv_id']);?>');" href="?fuid=<?php echo encrypt($row['user_id']); ?>" ><img src="assets/img/trash.png" width="16" height="16" alt="img"></a></td>
																</tr>
					<?php } ?>									
															</tbody>					
														</table>
													</div>
												</div>
											</p> 	
										</div>
									</li>
									<!-- tab 3 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link">WebHook</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary">
													<div class="card-header with-border"><h3 class="card-title"><i class="fa fa-card">&nbsp;&nbsp;</i>WebHook</h3></div>
													<div style="padding:20px;">
														<div class="col-12">
															<div class="card">
																<div class="card-body table-responsive p-0">
																	<input type="text" name="pk" placeholder="Public Key" value="<?php echo getSchPublicKey($sch_id);?>" class="form-control" disabled><br/>
																	<input type="text" name="sk" placeholder="Secret Key" value="<?php echo getSchSecretKey($sch_id);?>" class="form-control" disabled/>
																</div>
															</div>
														</div>
													</div>
												</div>
											</p>   
										</div>
									</li>
									<!-- tab 4 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link">Term/Session</a>
										<div class="tab-content">
											<p>
												Settings 3
											</p>    
										</div>
									</li>
								</ul>
								<script src="assets/js/jquery.min.js"></script>
								<script src="assets/js/index.js"></script>
								<script type="text/javascript" src="include/jquery/jquery-1.3.2.js"></script>
								<script type="text/javascript">	 
									$(document).ready( function(){
										$('.tablerow:even').addClass('alt1');
										$('.tablerow:odd').addClass('alt2');
										}
									);	 	
									// target function
									$( function(){
									$("#target .tablerow").hover(
									function(){$(this).toggleClass("highlight");},
									function(){$(this).toggleClass("highlight");}	
										);
									});
								</script>
								<style type="text/css" >
									.tablerow {
										background-color:#FFF;
									}
									.alt1 {
										 background-color:#FFF;
									 }
									.alt2 {
										 background-color: #f1f1f1;
									 }	 
									.highlight{
										border: 0px solid  #428bca;
										color:;	
									}	 
								</style>
							</div>
						</div>
					</div>
				</div>
			</div>
			
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/ajax/process_amount.php');?>
<?php include('include/page_scripts/options.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
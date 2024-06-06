<?php $page_title = "Account Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
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
								<span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Number of Students</span>
									<span class="info-box-number"><?php	echo getNumStdnt($sch_id);?></span>
								</div>
							</div>
						</div>
						<div title="School Fees" class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Paid (School Fee)</span>
									<span class="info-box-number"><?php $schfee = 1; echo getNumPaid($sch_id,$schfee,$csid,$ctid); echo '('. round((getNumPaid($sch_id,$schfee,$csid,$ctid)/getNumStdnt($sch_id) *100),0) .'%)';?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div title="School Fees" class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-times"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Not Paid (School Fee)</span>
									<span class="info-box-number"><?php echo getUNNumPaid($sch_id,$schfee,$csid,$ctid); echo '('. round((getUNNumPaid($sch_id,$schfee,$csid,$ctid)/getNumStdnt($sch_id) *100),0) .'%)';?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-clock"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Ouststanding (School Fee)</span>
									<span class="info-box-number"><?php echo getNumHPaid($sch_id,$schfee,$csid,$ctid); echo '('. round((getNumHPaid($sch_id,$schfee,$csid,$ctid)/getNumStdnt($sch_id) *100),0) .'%)';?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box" title="Expected Revenue: <?php echo number_format(getNumStdnt($sch_id) * str_replace(',', '', getSchfee($sch_id)));?>">
							<span class="info-box-icon bg-info elevation-1"><i class="fa fa-dollar"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Expected Revenue </span>
									<span class="info-box-number"><?php echo '₦'.number_format(getNumStdnt($sch_id) * str_replace(',', '', getSchfee($sch_id)));?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3" title="Generated Revenue: <?php echo number_format(getNumPaid($sch_id,$schfee,$csid,$ctid) * str_replace(',', '', getSchfee($sch_id)));?>">
								<span class="info-box-icon bg-pink elevation-1"><i class="fa fa-cog"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Generated Revenue</span>
									<span class="info-box-number"><?php echo '₦'.number_format(getTotalPaid($sch_id, $schfee, $ctid, $csid));?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3" title="Outstanding Revenue: <?php echo '₦'.number_format(getOutstandingFee($sch_id, $schfee, $ctid, $csid));?>">
							<div class="info-box mb-3" >
								<span class="info-box-icon bg-success elevation-1"><i class="fa fa-book-open"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Outstanding Revenue</span>
									<span class="info-box-number"><?php echo '₦'.number_format(getOutstandingFee($sch_id, $schfee, $ctid, $csid));?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3" title="Current Term and Session">
								<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-clock"></i></span>
								<div class="info-box-content">
									<span class="info-box-text"><?php echo $current_session;?></span>
									<span class="info-box-number"><?php echo $current_term;?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12"><h4>Manage Payments</h4></div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-tabs">
								<div class="card-header p-0 pt-1">
									<ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true">
											<i class="fa fa-clock">&nbsp;&nbsp;</i>Outstanding Payments</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">
											<i class="fa fa-?">&nbsp;&nbsp;</i>Pending Transactions(Online Only)</a>
										</li>
										<!--li class="nav-item">
											<a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">
											<i class="fa fa-check">&nbsp;&nbsp;</i>
											Completely Paid</a>
										</li-->
									</ul>
								</div>
								<div class="card-body">
									<div class="tab-content" id="custom-tabs-five-tabContent">
										<div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
											<div class="overlay-wrapper">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th style="width:5px;">S/N</th>
														<th style="width:30px;">Full Name</th>
														<th style="width:20px;">Class</th>
														<th style="width:15px;">Payment Type</th>
														<th style="width:5px;">Teller NO.</th>
														<th style="width:10px;">Amount Paid</th>
														<th style="width:10px;">Balance</th>
														<th style="width:5px;">Pay</th>
														<th style="width:10px;">Term</th>
														<th style="width:10px;">Session</th>
														<th style="width:5px;">Status</th>
													</thead>
													<tbody>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN ledger_info ON stdnt_info.user_id = ledger_info.user_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND ledger_info.payment_status = '1' ORDER BY ledger_info.class_id,ledger_info.cat_id");
														while ($row = mysqli_fetch_array($result)){
														?>
														
														<tr>
															<td align="center"><?php echo ++$counter; ?></td>
															<td><?php echo getLastname($row["user_id"]).' '.getFirstname($row["user_id"]);?></td>
															<td><?php echo getClass($row["class_id"]).' '.getCategory($row["cat_id"]);?></td>
															<td><?php echo getPaymenttype($row["payment_type"]);?></td>
															<td><?php echo $row["receipt_no"];?></td>
															<td>
																<?php if(empty(getAmountPaid($row["user_id"], $row["term_id"], $row["sid"], $row["payment_type"]))){
																	echo '';
																} else {
																	echo '&#8358;'.getAmountPaid($row["user_id"], $row["term_id"], $row["sid"], $row["payment_type"]);
																}
																?>
															</td>
															<td>
																<?php if(getBalance($row["user_id"], $row["term_id"], $row["sid"], $row["payment_type"]) == 0){
																	echo 'Not Owing';
																} else {
																	echo '&#8358;'.getBalance($row["user_id"], $row["term_id"], $row["sid"], $row["payment_type"]);
																}
																?>
															</td>
															<td class="border" align="center">
																<a title="Pay" href="pay_sch_fee2?uid=<?php echo encrypt($row["user_id"]); ?>&pt=<?php echo encrypt($row["payment_type"]); ?>"><img src="assets/img/pay.png" width="16" height="16" alt="img"></a>
															</td>
															<td><?php echo getTerm($row["term_id"]);?></td>
															<td><?php echo getSession($row["sid"]);?></td>
															<td class="border" align="center"><?php
																if ($row['payment_status'] == 1){
																	echo '<span class="badge bg-warning">Outstanding</span>';
																	$receipt = "";
																	$view = "";
																} else if ($row['payment_status'] == 2){
																	echo '<span class="badge bg-danger">Denied</span>';
																	$receipt = "repay?pid=";
																	$view = "repay";
																} else if ($row['payment_status'] == 3){
																	echo '<span class="badge bg-success">Paid</span>';
																	$receipt = 'view_receipt?pid=';
																	$view = "view";
																} else {
																	echo '<span class="badge bg-danger">Not paid</span>';
																	$receipt = "";
																	$view = "";
																} ?>
															</td>
														</tr>
<?php } ?>
													</tbody>					
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
										<font color="red">You are expected to click on Requery if Payer(parent) complains about being debited and payment was not recorded in the school</font>
											<div class="overlay-wrapper">
												<table id="example1a" class="table table-bordered table-striped">
													<thead>
														<th style="width:5px;align:center">S/N</th>
														<th style="width:20px;">Student Name</th>
														<th style="width:30px;">Reference</th>
														<th style="width:20px;">Amount</th>
														<th style="width:10px;">Payment Type</th>
														<th style="width:10px;">Status</th>
														<th style="width:5px;">Action</th>
													</thead>
													<tbody>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM attempted_payment WHERE sch_id='$sch_id' AND online_status!='2' ORDER BY trial_id DESC");
															while ($row = mysqli_fetch_array($result)){
															$uid = $row["user_id"];
														
														if ($row['online_status'] == 1){
															$paymentstatus = '<span class="badge bg-danger">Pending</span>';
														} else if ($row['online_status']  == 2){
															$paymentstatus = '<span class="badge bg-warning">Successful</span>';
														} else if ($row['online_status']  == 3){
															$paymentstatus = '<span class="badge bg-warning">Abandoned</span>';
														} else {
															$paymentstatus = '<span class="badge bg-danger">Undefined</span>';
														}
														?>  
														<tr>
															<td width="5%" align="center"><?php echo ++$counter1; ?></td>
															<td width="20%"><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
															<td width="15%"><?php echo $row['reference'];?></td>
															<td width="5%"><?php echo '&#8358;'. number_format($row['amount']);?></td>
															<td width="15%"><?php echo getPaymentType($row['payment_type']);?></td>
															<td width="5%"><?php echo $paymentstatus;?></td>
															<td class="border" align="center" width="12%">
																<a title="Requery" href="verify_payment?reference=<?php echo $row['reference'];?>&uid=<?php echo encrypt($uid); ?>&pt=<?php echo encrypt($row['payment_type']);?>"><button id="buttonn" class="btn btn-primary"><i class="fa fa-reload"></i> Requery </button></a>
															</td>
														</tr>
													<?php } ?>	
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="custom-tabs-five-normal" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
											<!--table id="example1b" class="table table-bordered table-striped">
												<thead>
													<th style="width:5%;">S/N</th>
													<th style="width:20px;">Passport</th>
													<th style="width:30px;">Full Name</th>
													<th style="width:20px;">Student ID</th>
													<th style="width:20px;">Payment Type</th>
													<th style="width:10px;">Class</th>
													<th style="width:5px;">Info</th>
													<th style="width:5px;">Status</th>
												</thead>
												<tbody>
												<?php
												/*$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN ledger_info ON stdnt_info.user_id = ledger_info.user_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND ledger_info.payment_status = '3'");
												while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"];
												$class_id = $row["class_id"];$cat_id = $row["cat_id"];
												$payment_status = $row["payment_status"]; $payment_id = $row["payment_type"];*
												?>		

													<tr>
														<td align="center"><?php echo ++$counter2; ?></td>
														<td><center><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($user_id);?>" style="max-width:40px;" class="img-circle"/></center></td>
														<td><?php echo getLastname($uid); echo "&nbsp;"; echo getFirstname($uid);?></td>
														<td><?php echo getUsername($uid);?></td>
														<td><?php echo getPaymenttype($payment_id);?></td>
														<td><?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></td>
														<td class="border" align="center">
														<a title="Info" href="stu_payment_history.php?uid=<?php echo encrypt($row["user_id"]); ?>"><img src="assets/img/record.png" width="16" height="16" alt="img"></a></td>
														<td class="border" align="center"><?php
															if ($payment_status == 1){
																echo '<span class="badge bg-warning">Outstanding</span>';
																$receipt = "";
																$view = "";
															} else if ($payment_status == 2){
																echo '<span class="badge bg-danger">Denied</span>';
																$receipt = "repay.php?pid=";
																$view = "repay";
															} else if ($payment_status == 3){
																echo '<span class="badge bg-success">Paid</span>';
																$receipt = 'view_receipt.php?pid=';
																$view = "view";
															} else {
																echo '<span class="badge bg-danger">Not paid</span>';
																$receipt = "";
																$view = "";
															} ?>
														</td>
													</tr>
			<?php }*/ ?>
												</tbody>					
											</table-->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/multiple_table.php');?>

</html>
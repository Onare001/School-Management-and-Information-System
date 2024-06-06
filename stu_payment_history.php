<?php $page_title = "Student Payment History"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$uid="";
if(isset($_GET['uid'])){
	$uid = decrypt($_GET['uid']);
	$pt = "";
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<div class="card box-primary box-solid" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header with-border">
					<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
					<button onclick="location.href='pay_sch_fee2?uid=<?php echo encrypt($uid);?>&pt=<?php echo encrypt($pt);?>'"id="buttonn" class="btn btn-primary"><i class="fa fa-credit-card">&nbsp;&nbsp;</i> Pay Fees  </button>
					<button onclick="location.href='stu_payment_history?<?php echo 'uid='.encrypt($uid);?>'"id="buttonn" class="btn btn-success"><i class="fa fa-clock"></i> Payment History </button>
					<button onclick="location.href='stu_payment_log?uid=<?php echo encrypt($uid);?>'"id="buttonn" class="btn btn-primary"><i class="fa fa-server"></i> Payment Log </button>
					<button onclick="location.href='attempted_tranx?uid=<?php echo encrypt($uid);?>'"id="buttonn" class="btn btn-danger"><i class="fa fa-cancel"></i> Attempted Transaction </button>
				</div>
			</div>  
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-history">&nbsp;&nbsp;</i>Student Payment History | <?php echo getLastname($uid).'&nbsp'.getFirstname($uid);?></h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search"/>
								<div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<th>#SN</th> 
								<th>Reason</th>
								<th>Receipt No.</th>
								<th>Balance</th>
								<th>Term</th>
								<th>Session<br>(class)</th>
								<th>Time/Date</th>
								<th>Status</th>
								<th>Receipt</th>
							</thead>				
							<?php
							//$result = mysqli_query($conn,"SELECT * FROM ledger_info JOIN stdnt_info ON ledger_info.user_id=stdnt_info.user_id WHERE ledger_info.user_id='$uid' AND stdnt_info.user_id='$uid'");
							$result = mysqli_query($conn,"SELECT * FROM ledger_info WHERE ledger_info.user_id='$uid'");
							while ($row = mysqli_fetch_array($result)){
							?>					
							<tr>
								<td><?php echo ++$counter;?></td>
								<td><?php echo getPaymenttype($row["payment_type"]);?></td>
								<td><?php echo $row["receipt_no"];?></td>
								<td><?php echo '&#8358;'.$row["balance"];?></td>
								<td><?php echo getTerm($row["term_id"]);?></td>
								<td><?php echo getSession($row["sid"]).'<br>'.getClass($row["class_id"]);?></td>
								<td><?php echo $row["date_paid"];?></td> 
								<td><?php
										if ($row["payment_status"] == 1){
											echo '<span class="badge bg-warning">Outstanding</span>';
											$receipt = '';
											$view = '';
										} else if ($row["payment_status"] == 2){
											echo '<span class="badge bg-danger">Denied</span>';
											$receipt = 'repay?pid=';
											$view = 'repay';
										} else if ($row["payment_status"] == 3){
											echo '<span class="badge bg-success">Paid</span>';
											$receipt = 'view_receipt?pid=';
											$view = 'view';
										} else {
											echo '<span class="badge bg-danger">Not paid</span>';
											$receipt = '';
											$view = '';
										}
										?></td>
								<td><a href="<?php echo $receipt; echo encrypt($row["payment_id"]);?>"><?php echo $view; ?></a></td>
							</tr>
			<?php } ?>					
						</table>
					</div>
				</div>
				<div class="card" id="custom" style="padding:10px;">
					<table>
						<tr align="center">
							<td>Number of Terms Spent in School:</td>
							<td>Total Outstanding Payment: (Sch fee)</td>
							<td>Total Outstanding Payment: (Other Charges)</td>
						</tr>
						<tr align="center">
							<td><?php echo getNoTermSpent($sch_id, $uid);?></td>
							<td><?php echo '₦'.number_format(getStuOutstandingFee($sch_id, $uid, '1'));?></td>
							<td><?php echo '₦'.number_format(getStuOutstandingFee($sch_id, $uid, ''));?></td>
						</tr>
					</table>
				</div>
			</div>
			
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
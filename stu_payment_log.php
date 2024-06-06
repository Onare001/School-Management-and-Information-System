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
						<h3 class="card-title"><i class="fa fa-server">&nbsp;&nbsp;</i>Student Payment Log | <?php echo getLastname($uid).'&nbsp'.getFirstname($uid);?></h3>
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
								<th>Reference</th>
								<th>Amount</th>
								<th>Term</th>
								<th>Session<br>(class)</th>
								<th>Time/Date</th>
								<th>Status</th>
							</thead>				
							<?php
							$result = mysqli_query($conn,"SELECT * FROM payment_log JOIN stdnt_info ON payment_log.user_id=stdnt_info.user_id WHERE payment_log.user_id='$uid' AND stdnt_info.user_id='$uid'");
							while ($row = mysqli_fetch_array($result)){
								$date = $row["date_paid"];
								$term_id = $row["term_id"];
								$sid = $row["sid"];
								$teller_no = $row["receipt_no"];
								$class_id = $row["class_id"];
								$cat_id = $row["cat_id"];
								$payment_status = $row["payment_status"];
								$payment_type = $row["payment_type"];
								$payment_id = $row["payment_id"];
								$tranx_id = $row["transaction_id"];
								$amount = $row["amount_paid"];
							?>					
							<tr>
								<td><?php echo ++$counter;?></td>
								<td><?php echo getPaymenttype($payment_type);?></td>
								<td><?php echo $tranx_id;?></td> 
								<td><?php echo '&#8358;'.$amount;?></td>
								<td><?php echo getTerm($term_id);?></td>
								<td><?php echo getSession($sid).'<br>'.getClass($class_id);?></td>
								<td><?php echo $date;?></td> 
								<td><a title="Requery" href="verify_payment?reference=<?php echo $row["transaction_id"];?>&uid=<?php echo encrypt($uid); ?>&pt=<?php echo encrypt($row['payment_type']);?>"><button id="buttonn" class="btn btn-primary"><i class="fa fa-reload"></i> Requery </button></a></td>
							</tr>
			<?php } ?>					
						</table>
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
<?php $page_title = "Payment Master Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php 
if ($priviledge == 9){

}else{
	 header("Location: logout.php");
     exit();
}

$cid=""; $tid=""; $sid=""; $pt=""; $ps=""; $sql="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$term_id = $_POST['term_id'];
	$session_id = $_POST['sid']; 
	$paymenttype = $_POST['payment_type'];
	$paystatus = $_POST['paystatus'];
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($term_id)) {
        $msg = 'Select Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id)) {
        $msg = 'Select Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($paymenttype)) {
        $msg = 'Select Purpose of Payment!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($paystatus)) {
        $msg = 'Select Payment Status!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
	$cid = $class_id;
	$tid = $term_id;
	$sid = $session_id;
	$pt = $paymenttype;
	$ps = $paystatus;
		if ($ps == 2){//Paid
			$sql = "SELECT * FROM stdnt_info JOIN ledger_info JOIN sch_users ON stdnt_info.user_id = ledger_info.user_id AND sch_users.user_id = stdnt_info.user_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND stdnt_info.class_id='$cid' AND ledger_info.term_id='$tid' AND ledger_info.sid='$sid' AND payment_type= '$pt' AND payment_status = '3' ORDER BY stdnt_info.cat_id,sch_users.last_name ASC";
		} else if ($ps == 3) {//Unpaid
			$sql = "SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.class_id='$cid' AND stdnt_info.user_id NOT IN (SELECT user_id FROM ledger_info WHERE ledger_info.term_id='$tid' AND ledger_info.class_id='$cid' AND payment_type= '$pt'  AND ledger_info.sid='$sid') ORDER BY stdnt_info.cat_id,sch_users.last_name ASC";// OR LIMIT 1,200  AND ledger_info.payment_status != '3'
		} else if ($ps == 1) {//All
			$sql = "SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.class_id='$cid' ORDER BY stdnt_info.cat_id,sch_users.last_name ASC";
		} //else{
		 $result = mysqli_query($conn, $sql);
		 //}
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
        } else {
            $msg = 'No Payment Record Found for this Query';
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
<?php if (isset($msg)) { echo $msg_toastr; } ?>
			
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-credit-card"></i> Master Payment Record <p></h3>
									<form action="" method="post">
										<table border="0" align="center" style="border-collapse:collapse; width:100%;">
											<tr>
												<td>
													<select name="class_id" id="sel_class" class="form-control">
														<?php
															echo '<option value="">'.'Select Class'.'</option>';
															$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
															while ($row = mysqli_fetch_array($result)){
															echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
													</select>
												</td>
												<td>
													<select name="term_id" id="sel_term" class="form-control">
														<?php
														echo '<option value="">Select Term</option>';
														$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
														while ($row = mysqli_fetch_array($result)){
														echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
														} ?>
													</select>
												</td>
												<td>
													<select name="sid" id="sel_session" class="form-control">
														<?php
														echo '<option value="">Select Session</option>';
														$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
														while ($row = mysqli_fetch_array($result)){
														echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
														} ?>
													</select>
												</td>
												<td>
													<select name="payment_type" id="sel_type" class="form-control">
														<?php
														echo '<option value="">Reason for Payment</option>';
														$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id'");
														while ($row = mysqli_fetch_array($result)){
														echo '<option value="'.$row["payment_id"].'">'.$row["payment_type"].'</option>';
														} ?>
													</select>
												</td> 
												<td>
													<select name="paystatus" id="paystatus" class="form-control">
														<option value="">Payment Status</option>
														<option value="1">All</option>
														<option value="2">Paid</option>
														<option value="3">Unpaid</option>
													</select>
												</td>
												<td width="50">
													<input name="submit" type="submit" value="Submit" class="btn btn-primary" style="vertical-align:top; height:34px;">
												</td>
											</tr>
										</table> 
									</form> 
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:5px;">S/N</th>
											<th style="width:5px;">Passport</th>
											<th style="width:20px;">Full Name</th>
											<th style="width:5px;">Class</th>
											<th style="width:15px;">Payment Type</th>
											<th style="width:10px;">Amount Paid</th>
											<th style="width:10px;">Balance</th>
											<th style="width:5px;">Teller NO.</th>
											<th style="width:5px;">Status</th>
										</thead>
										<tbody>	
											<?php
											$uid=""; $cat_id="";
											if (!empty($sql)) {
												$result = mysqli_query($conn,$sql);
											}
												while ($row = mysqli_fetch_array($result)){
												
											if (getMPaymentstatus($uid, $tid, $sid, $pt) == 0){
												$paymentstatus = '<span class="badge bg-danger">Not Paid</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 1){
												$paymentstatus = '<span class="badge bg-warning">Outstanding</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 2){
												$paymentstatus = '<span class="badge bg-danger">Denied</span>';
											} else if (getMPaymentstatus($uid, $tid, $sid, $pt) == 3){
												$paymentstatus = '<span class="badge bg-success">Paid</span>';//Approved
											} else {
												$paymentstatus = '<span class="badge bg-danger">Not Paid</span>';
											}
											?>  
											  
											<tr>
												<td width="5%" align="center"><?php echo ++$counter; ?></td>
												<td width="5px" align="center"><img src="<?php echo getPassport($row["user_id"]);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></td>
												<td><?php echo getLastname($row["user_id"]).' '.getFirstname($row["user_id"]);?></td>
												<td><?php echo getClass($row["class_id"]).' '.getCategory($row["cat_id"]);?></td>
												<td><?php echo getPaymenttype($pt);?></td>
												<td><?php echo '₦'.getAmountPaid($row["user_id"], $tid, $sid, $pt);?></td>
												<td><?php echo '₦'.getBalance($row["user_id"], $tid, $sid, $pt);?></td>
												<td><?php echo getTellerno($row["user_id"], $tid, $sid, $pt);?></td>
												<td class="border" align="center"><?php echo $paymentstatus;?></td>
											</tr>
									<?php } ?>
										</tbody>					
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
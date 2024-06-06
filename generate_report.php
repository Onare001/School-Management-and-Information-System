<?php $page_title = "Generate Report"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php 
if ($priviledge == 9){

} else {
	 header("Location: logout");
     exit();
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
									<h3 class="card-title"><i class="fa fa-bar-chart"></i> Generate Report <p></h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:5px;">S/N</th>
											<th style="width:5px;">Session</th>
											<th style="width:300px;">Term</th>
											<th style="width:300px;">Purpose</th>
											<th style="width:5px;">Generated<br>Revenue</th>
											<th style="width:10px;">Outstanding<br>Revenue</th>
											<th style="width:10px;">Paid</th>
											<th style="width:10px;">Not Paid</th>
											<th style="width:10px;">Outstanding</th>
											<th style="width:10px;">Students</th>
										</thead>
										<tbody>	
											<?php
												$result = mysqli_query($conn,"SELECT DISTINCT sid, term_id, payment_type FROM ledger_info GROUP BY sid,term_id,payment_type");
												while ($row = mysqli_fetch_array($result)){
											?>
											<tr>
												<td width="5%" align="center"><?php echo ++$counter; ?></td>
												<td align="center"><?php echo getSession($row["sid"]);?></td>
												<td><?php echo getTerm($row['term_id']);?></td>
												<td><?php echo getPaymenttype($row['payment_type']);?></td>
												<td><?php echo '₦'.number_format(getTotalPaid($sch_id, $row['payment_type'], $row['term_id'], $row["sid"]));?></td>
												<td align="center"><?php echo '₦'.number_format(getOutstandingFee($sch_id, $row['payment_type'], $row['term_id'], $row["sid"]));?></td>
												<td align="center"><?php echo getNumPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']);?></td>
												<td align="center"><?php echo getUNNumPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']);?></td>
												<td align="center"><?php echo getNumHPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']);?></td>
												<td align="center"><?php echo getNumPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']) + getUNNumPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']) + getNumHPaid($sch_id, $row['payment_type'], $row["sid"], $row['term_id']);?></td>
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
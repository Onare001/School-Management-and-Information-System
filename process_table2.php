<?php include ('functions/functions.php'); include ('include/lock_staff.php'); ?>
<?php
//Populate Table
	include ("include/connection.php");
    $yid = $_POST["yid"];
?>
	<div style="display:block;position:relative;">
		<form>
			<div id="loader" style="background-color:##efefef; top:0px; left:0px; width:100%; height:100%; display:none; position:absolute; text-align:center; valign:middle; opacity:0.8; filter:alpha(opacity=80);">
				<br>
				<h1>Please Wait</h1><br>
				<img src="assets/img/loading.gif" alt="" border="0">
			</div>
		</form>
	</div>
    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">   
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"> Graduated Students in <?php echo getYear($yid);?></h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<th style="width:10px;">S/N</th>
									<th style="width:20px;">Passport</th>
									<th>Full Name</th>
									<th>Student ID</th>
									<th>Class</th>
									<th>Status</th>
									<th>View<br>Payment<br> History</th>
									<th>Pay</th>
								</thead>
								<tbody>	
									<?php
									$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id AND sch_users.sch_id=stdnt_info.sch_id WHERE stdnt_info.yid='$yid' AND sch_users.priv_id='3' AND sch_users.sch_id='$sch_id' AND stdnt_info.class_id > 3 ORDER BY sch_users.last_name,sch_users.first_name ASC");
									while ($row = mysqli_fetch_array($result)){
									?>			
									<tr>
										<td align="center"><?php echo ++$counter; ?></td>
										<td><center><img src="<?php echo getPassport($row["user_id"]);?>" alt="<?php echo getLastname($row["user_id"]);?>" style="max-width:40px;" class="img-circle"/></center></td>
										<td><?php echo strtoupper(getLastname($row["user_id"])).' '.strtoupper(getFirstname($row["user_id"]));?></td>
										<td><?php echo getUsername($row["user_id"]);?></td>
										<td align="center"><?php echo '('.getCategory($row["cat_id"]).')';?></td>
										<td align="center"><?php if ($row['status_id'] == 2) { echo 'Grad'.'/'.getYear($yid);} else {echo '';} ?></td>
										<td class="border" align="center">
											<a title="View payment history" href="stu_payment_history?uid=<?php echo encrypt($row["user_id"]); ?>">
											<img src="assets/img/record.png" width="16" height="16" alt="img">
											</a>
										</td>
										<td class="border" align="center">
											<a title="Pay" href="pay_sch_fee2?uid=<?php echo encrypt($row["user_id"]);?>&pt=<?php echo encrypt('0');?>">
											<img src="assets/img/pay.png" width="16" height="16" alt="img">
											</a>
										</td>
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
<?php include ('include/page_scripts/datatables.php');?>
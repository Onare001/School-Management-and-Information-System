<?php $page_title = "Parent Record";?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['download_csv'])){
// Execute query and get result set
$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact!=0 AND status_id!=0 AND class_id < $class_limit GROUP BY parent_contact ORDER BY p_name ASC");

// Open CSV file for writing
$file = fopen('php://temp', 'w+');

// Write headers to CSV file
$headers = array('SN', 'PARENT NAME', 'PHONE NO', 'EMAIL ADDRESS');
fputcsv($file, $headers);

$counter = '0';

// Loop through result set and write data to CSV file
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data = array(++$counter, $row['p_name'], $row['parent_contact'], $row['parent_email']);
    fputcsv($file, $data);
}

// Set file pointer to beginning
rewind($file);

// Set headers for file download
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.'Parent_contact_'.getSchName($sch_id).'.csv";');

// Send CSV file as download attachment
fpassthru($file);

// Close CSV file
fclose($file);

// Close MySQL database connection
mysqli_close($conn);

exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>	
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3 col-6">
							<div class="small-box bg-info">
								<div class="inner">
									<?php
									include 'include/connection.php';
									$result = mysqli_query($conn, "SELECT COUNT(*) AS num_parent FROM (SELECT DISTINCT parent_contact FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact != 0 AND status_id!=0 AND class_id < $class_limit) AS unique_parents");
									$row = mysqli_fetch_assoc($result);
									$num_parent = $row['num_parent'];
									echo '<h3>'.$num_parent.'</h3>
									<p>Total no. of Parents</p>';
									?>
								</div>
								<div class="icon">
									<i class="fa fa-info-circle"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-success">
								<div class="inner">
									<?php
									include 'include/connection.php';
									$result = mysqli_query($conn,"SELECT stdnt_id, COUNT(stdnt_id) AS num_ward FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact != 0 AND status_id!=0 AND class_id < $class_limit");
									$row = mysqli_fetch_array($result);
									$num_linked = $row['num_ward'];
									echo '<h3>'.$num_linked.'<sup style="font-size: 20px"></sup></h3>
									<p>Students Linked</p>';				
									?>
								</div>
								<div class="icon">
									<i class="fa fa-check"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-warning">
								<div class="inner">
									<?php
									include 'include/connection.php';
									$result = mysqli_query($conn,"SELECT stdnt_id, COUNT(stdnt_id) AS num_ward FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact = 0 AND status_id!=0 AND class_id < $class_limit");
									$row = mysqli_fetch_array($result);
									$num_not_linked = $row['num_ward'];
									echo '<h3>'.$num_not_linked.'</h3>
									<p>Students Not-linked</p>';
									?>
								</div>
								<div class="icon">
									<i class="fa fa-cancel"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-danger">
								<div class="inner">
									<h3><?php echo getNumStdnt($sch_id);?></h3>
									<p>Total No. of Active Student</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<section class="col-lg-9 connectedSortable">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										<i class="fas fa-chart-pie mr-1"></i> Parent/Guardian Record
									</h3>
									<div class="card-tools">
										<ul class="nav nav-pills ml-auto">
											<li class="nav-item">
												<a class="nav-link active" href="<?php echo Navigate('bulk_msg');?>" data-toggle="tab">Send Bulk SMS</a>
											</li>
											<li class="nav-item">
												<form action="" method="post">
													<button type="submit" name="download_csv" id="buttonn" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</button>
												</form>
											</li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<div class="tab-content p-0">
										<table id="example1" class="table table-bordered table-striped">
											<thead class="custom">
											  <tr>
												<th style="width:5%;">S/N</th>
												<th style="width:10%;">Passport</th>
												<th style="width:10%;">No. of Ward</th>
												<th style="width:30%;">Parent Name</th>
												<th style="width:30%;">Relationship</th>
												<th style="width:20%;">Phone No.</th>
												<th>View</th>
											  </tr>
											</thead>
											<tbody>
												<?php
												$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact!='' AND status_id!='0' AND class_id < $class_limit GROUP BY parent_contact ORDER BY p_name ASC"); 
												while ($row = mysqli_fetch_array($result)){
												$parent_contact = $row['parent_contact'];  
												$modal_id = "myModal".$row["user_id"]; 
												echo '<tr>
													<td align="center">'.++$counter.'</td>
													<td align="center">
														<img src="'.getPassport('').'" alt="" style="max-width:40px;" class="img-circle"/>
													</td>
													<td align="center">'.CountWard($sch_id,$row['parent_contact']).'</td>
													<td>'./*parent_title($row['relationship']).*/ strtoupper($row['p_name']).'</td>
													<td>'.$row['relationship'].'</td>
													<td>'.$row['parent_contact'].'</td>
													<td align="center"> 
														<button title="View Profile" class="btn btn-info view-btn" data-toggle="modal" data-target="#'.$modal_id.'"><i class="fa fa-eye"></i></button>
													</td>
												</tr>
												<div class="modal fade" id="'.$modal_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$modal_id.'Label" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="'.$modal_id.'Label">'.$row['p_name'].'\'s' .' Profile'.'</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<ul class="list-inline">'; 
																$result090 = mysqli_query($conn, "SELECT * FROM stdnt_info WHERE sch_id = '$sch_id' AND parent_contact = '$parent_contact' AND class_id < $class_limit ORDER BY class_id");
																// Check if any rows are returned
																if (mysqli_num_rows($result090) > 0) {
																	while ($ward = mysqli_fetch_assoc($result090)) {
																		$wid = $ward['user_id'];
																	echo '<li class="list-inline-item" style="border:1px #ccc solid;padding:5px;width:110px;">
																	  <img alt="'.getLastname($wid).'" class="img-circle table-avatar" src="'.getPassport($wid).'" style="max-width:40px;"/>
																	  '.getClass($ward['class_id']).getCategory($ward['cat_id']).'
																	  <p><small>'.getFirstName($wid).'</small>
																	  <text style="font-size:12px;">'.getUsername($wid).'</text>
																  </li>';
																	}
																} else {
																	echo "No records found.";  // Adjust this message based on your requirement
																}
															echo '</ul>
																<hr>
																<p><b>Parent Name/Contact:</b> '.$row['p_name'].', '.$row['parent_contact'].'</p>
																<p><b>Address:</b> '.$row['address'].'</p>    
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>';
												} ?>               
											</tbody>
											<tfoot>
												<tr>
													<th style="width:5%;">S/N</th>
													<th style="width:10%;">Passport</th>
													<th style="width:10%;">No. of Ward</th>
													<th style="width:30%;">Parent Name</th>
													<th style="width:30%;">Relationship</th>
													<th style="width:20%;">Phone No.</th>
													<th>View</th>
												</tr>
											</tfoot>
										</table>
										<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
											<canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section class="col-lg-3 connectedSortable">
							<div class="card bg-gradient-primary">
								<div class="card-header border-0">
									<h3 class="card-title">
										<i class="fas fa-envelope mr-1"></i>Send Message
									</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
											<i class="far fa-calendar-alt"></i>
										</button>
										<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!--div class="card-body">
									<textarea id="myTextarea" placeholder="Enter your text here..." rows="10" cols="25"></textarea>
									<input type="submit" value="Send" name="" class="btn btn-secondary">
								</div-->	
							</div>
							<div class="card bg-gradient-info">
								<div class="card-header border-0">
									<h3 class="card-title">
										<i class="fas fa-th mr-1"></i> Sent Messages
									</h3>
									<div class="card-tools">
										<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
										<button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
								<!--div class="card-body">
									<canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div-->
							</div>
							<div class="card bg-gradient-success">
								<div class="card-header border-0">
									<h3 class="card-title">
										<i class="far fa-calendar-alt"></i> Calendar
									</h3>
									<div class="card-tools">
										<div class="btn-group">
											<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
												<i class="fas fa-bars"></i>
											</button>
											<div class="dropdown-menu" role="menu">
												<a href="#" class="dropdown-item">Add new event</a>
												<a href="#" class="dropdown-item">Clear events</a>
												<div class="dropdown-divider"></div>
												<a href="#" class="dropdown-item">View calendar</a>
											</div>
										</div>
										<button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
										<button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
								<div class="card-body pt-0">
									<div id="calendar" style="width: 100%"></div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
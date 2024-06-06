<?php $page_title = "Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_parent.php');?>
<?php
	//$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE parent_contact='$username' LIMIT 1");
	//$p_info = mysqli_fetch_assoc($result);
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

				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="card card-widget widget-user-2">
									<div class="widget-user-header bg-<?php echo $sch_color;?>">
										<div class="widget-user-image">
											<img class="img-circle elevation-2" src="<?php echo getPassport("");?>" alt="Passport">
										</div>
										<h3 class="widget-user-username"><?php echo ($p_info['p_name']) ? $p_info['p_name'] : 'Parent Name';?></h3>
										<h5 class="widget-user-desc"><?php //echo getUsername($user_id);?></h5>
									</div>
									<div class="card-footer p-0">
										<ul class="nav flex-column">
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-phone"></i> Phone No. <span class="float-right"><?php echo $p_info['parent_contact'];?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-envelope"></i> Email <span class="float-right"><?php echo $p_info['parent_email'];?></span>
												</span>
											</li>
											<li class="nav-item">
												<span class="nav-link">
													<i class="fa fa-home"></i> Address <span class="float-right"><?php echo $p_info['address'];?></span>
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-info">
									<div class="card-header">
										<h3 class="card-title">NOTICE BOARD</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove">
												<i class="fas fa-times"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart" style="height:162px;">
											<ul class="nav flex-column">
											<?php 
												if (1==0){
													echo 
													'<li class="nav-item">
														<span class="nav-link">
															1. <span class="">Please Ensure you pay your ward fees before week 4</span>
														</span>
													</li>';
												} else {
													echo '<center style="font-weight:bold">'.'NO INFORMATION TO DISPLAY'.'</center>';
												} 
											?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">My Ward List</h3>
									</div>
									<div class="card-body">
										<table id="example1" class="table table-bordered table-striped" style="margin-bottom:400px;">
											<thead>
												<th style="width:5px;" align="center">S/N</th>
												<th style="width:20px;">Passport</th>
												<th style="width:30px;">Ward Name</th>
												<th style="width:20px;">Student ID</th>
												<th style="width:20px;">Class</th>
												<th style="width:20px;">School Fee</th>
												<th style="width:10px;">Status</th>
												<th style="width:10px;">Action(s)</th>
											</thead>
											<tbody>
												<?php
												$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE parent_contact='$username'");
													while ($row = mysqli_fetch_array($result)){
													$uid = $row["user_id"];
													//$payment_status = $row["payment_status"];
													$pt = '1';
												$tid = $ctid; $sid = $csid; //Getting Payment Record for Current Term And Session
												

												?>  
												<tr>
													<td align="center"><?php echo ++$counter; ?></td>
													<td><center><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></center></td>
													<td><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
													<td><?php echo getUsername($uid);?></td>
													<td><?php echo getClass($row['class_id']).getCategory($row['cat_id']);?></td>
													<td class="border" align="center"><?php echo getCPaymentStatus($uid, $ctid, $csid, '1');?></td>
													<td class="border" align="center"><?php echo getStatus($uid)?></td>
													<td class="border" align="center">
														<div class="btn-group">
															<button type="button" class="btn btn-danger">Action</button>
															<button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
																<span class="sr-only">Toggle Dropdown</span>
															</button>
															<div class="dropdown-menu" role="menu">
																<a class="dropdown-item" href="pay_sch_fee2?uid=<?php echo encrypt($uid); ?>&pt=<?php echo encrypt($pt); ?>">Pay School Charges</a>
																<a class="dropdown-item" href="stu_payment_history?uid=<?php echo encrypt($row["user_id"]); ?>">Payment History</a>
																<a class="dropdown-item" href="check_ward_result?uid=<?php echo encrypt($row["user_id"]); ?>">Check Result</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="edit_ward?uid=<?php echo encrypt($row["user_id"]); ?>">Edit Bio Data</a>
															</div>
														</div>
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
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
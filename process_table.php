<?php include ('functions/functions.php'); include ('include/lock_admin.php'); ?>
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
									<tr>
										<th style="width:10px;">S/N</th>
										<th style="width:10px;">Passport</th>
										<th>Student Name</th>
										<th>Student ID</th>
										<th>Class</th>
										<th>Year</th>
										<th>Edit</th>
										<th>Cert.</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody>	
									<?php
									$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id AND sch_users.sch_id=stdnt_info.sch_id WHERE stdnt_info.yid='$yid' AND sch_users.priv_id='3' AND sch_users.sch_id='$sch_id' AND stdnt_info.class_id > 3 ORDER BY sch_users.last_name,sch_users.first_name ASC");
									while ($row = mysqli_fetch_array($result)){
										$uid = $row["user_id"]; $class_id = $row["class_id"]; $cat_id = $row["cat_id"]; $status = $row['status_id'];?>			
									<tr>
										<td align="center"><?php echo ++$counter; ?></td>
										<td><center><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></center></td>
										<td><?php echo strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid));?></td>
										<td><?php echo getUsername($uid);?></td>
										<td align="center"><?php echo '('.getCategory($cat_id).')';?></td>
										<td align="center"><?php if ($status == 2) { echo 'Grad'.'/'.getYear($yid);} else {echo '';} ?></td>
										<td align="center">
											<a title="Edit" href="edit_student.php?uid=<?php echo encrypt($row["user_id"]); ?>">
												<img src="assets/img/edit.png" width="16" height="16" alt="img"/>
											</a>
										</td>
										<td align="center">
											<a title="Testimonial" href="testimonial?uid=<?php echo encrypt($row["user_id"]);?>&yid=<?php echo encrypt($row['yid']);?>">
												<i class="fa fa-graduation-cap"></i>
											</a>
										</td>
										<td align="center">	</td>
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
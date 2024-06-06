<?php $page_title = "Attendance"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
 $class=""; $category="";
	$formM = "SELECT * FROM form_teacher_info WHERE user_id='$user_id'";
	$result = mysqli_query($conn,$formM);
	$row = mysqli_fetch_array($result);
	$class = $row['class_id'];
	$category = $row['cat_id'];
	$no_of_days_sch_open = getNoofDaysSchOpen($sch_id, $ctid, $csid);
	
	//Updating Student Comment
	if (isset($_POST['submit'])){
		$uid = $_POST['student'];
		$present = $_POST['present'];
		if (empty($present)){
			$msg = '<span class="badge bg-danger">'.'Please Select a Comment for'.'&nbsp;'.getLastname($uid).'&nbsp;'.getFirstname($uid).'</span>';
		} else if ($present > $no_of_days_sch_open){
			$msg = '<span class="badge bg-danger">This value exceeds the number of times school open</span>';
		} else {
			/*new method*/
			$check = mysqli_query($conn, "SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid'");
			if (mysqli_num_rows($check) == false){
				$result = mysqli_query($conn,"INSERT INTO stdnt_com (user_id, attnd_present, sch_id, class_id, cat_id, term_id, session_id) VALUES ('$uid','$present','$sch_id','$class','$category','$ctid','$csid')");
			} else {
				$result = mysqli_query($conn,"UPDATE `stdnt_com` SET `attnd_present` = '$present' WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid'");
			}
			/*old method*/
			//$result = mysqli_query($conn,"UPDATE `stdnt_info` SET `com_id` = '$com_id' WHERE user_id='$uid'");
			if ($result == true){
				$msg = '<span class="badge bg-success">'.'Attendance Record Added for'.'&nbsp;'.getLastname($uid).'&nbsp;'.getFirstname($uid).'</span>';
			} else{
				//error
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles2.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?> 
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Attendance | <?php echo getClass($class).getCategory($category);?> | <b>Term:</b> <?php echo getTerm($ctid);?> <b>Session:</b> <?php echo getSession($csid);?></h3>
									<div style="float:right;">
										<a href="record_attendance" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Record Attendance </div></a>
										<a href="#" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
									</div>
								</div>
								<div class="card-body">
									<center style="color:red;"><?php if (isset($msg)) { ?><p class="error"><?php echo $msg;?></p><?php } ?></center>
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										  <tr>
											<th width="2%">S/N</th>
											<th width="5px">Passport</th>
											<th width="20px">Full Name</th>
											<th width="10px">No. of Days Sch. Open</th>
											<th width="100px">No. of Days Present</th>
											<th width="100px">No. of Days Absent</th>
											<th width="5px">Remark</th>
											<th width="5px">Action</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											$rtyu = array();
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.class_id = '$class' AND stdnt_info.cat_id = '$category' AND sch_users.sch_id = '$sch_id' AND stdnt_info.status_id='1' ORDER BY sch_users.last_name ASC");
											while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"]; 
												$check = mysqli_query($conn, "SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid'");
												$pre = mysqli_fetch_assoc($check);?>
											<tr align="center">
												<td align="center" width="2%"><?php echo ++$counter; ?></td>
												<td><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></td>
												<td align="left"><?php echo strtoupper(getLastname($uid)).'&nbsp;'. strtoupper(getFirstname($uid));?></td>
												<td align="center" width="120px"><?php echo $no_of_days_sch_open; ?></td>
												<form action="" method="post">	
													<td>
														<input type="number" name="present" value="<?php echo $pre['attnd_present'];?>" class="form-control">
													</td>
													<td><?php echo $no_of_days_sch_open - $pre['attnd_present'];?></td>
													<td><?php echo CalcAttendance($pre['attnd_present'], $no_of_days_sch_open);?></td>
													<td align="center">
														<input name="student" type="hidden" value="<?php echo $uid;?>">
														<input name="submit" type="submit" value="Submit" class="btn btn-primary">
													</td>
												</form>	
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
<?php include ('include/page_scripts/datatables.php');?>
</html>
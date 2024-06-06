<?php $page_title = "Attendance"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
 $class=""; $category="";
	$result = mysqli_query($conn,"SELECT * FROM form_teacher_info WHERE user_id='$user_id'");
	$row = mysqli_fetch_array($result);
	$class = $row['class_id'];
	$category = $row['cat_id'];
	$date = date("Y-m-d");
	
	//Updating Student Attendance
	if (isset($_POST['submit'])){
		$uid = $_POST['student'];
		$term_id = $ctid;
		$session_id = $csid;
		$attedance_status = $_POST['attendance'];
		$date = date("Y-m-d");
		if (empty($attedance_status)){
			$msg = '<span class="badge bg-danger">'.'Mark Attendance for'.'&nbsp;'.getLastname($uid).'&nbsp;'.getFirstname($uid).'</span>';
		} else {
			$check_attd = mysqli_query($conn,"SELECT * FROM attendance WHERE sch_id='$sch_id' AND user_id='$uid' AND class_id='$class' AND cat_id='$category' AND term_id='$term_id' AND session_id='$session_id' AND date='$date'");
			if (mysqli_num_rows($check_attd) == false){
				$result = mysqli_query($conn,"INSERT INTO attendance (sch_id, user_id, attendance, class_id, cat_id, term_id, session_id, date) VALUES ('$sch_id', '$uid', '$attedance_status', '$class', '$category', '$term_id', '$session_id', '$date')");
				
			} else {
				$result = mysqli_query($conn,"UPDATE `attendance` SET `attendance`='$attedance_status' WHERE sch_id='$sch_id' AND user_id='$uid' AND class_id='$class' AND cat_id='$category' AND term_id='$term_id' AND session_id='$session_id' AND date='$date'");	
			}
			if ($result == true){
				$msg = '<span class="badge bg-success">'.'Attendance Marked for'.'&nbsp;'.getLastname($uid).'&nbsp;'.getFirstname($uid).'</span>';
			}
		}
	} 
?>
<?php
$check = mysqli_query($conn,"SELECT * FROM attendance WHERE class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid' AND date='$date'");
$row = mysqli_fetch_assoc($check);

?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles2.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?> 
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Attendance | <?php echo getClass($class).getCategory($category);?></h3>
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
											<th width="10px">Date</th>
											<th width="100px">Attendance</th>
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
												/*$rty = array(
													'id' => $row['user_id'],
													'name' => getClass($row['class_id']),
													'email' => $row['cat_id']
												); array_push($rtyu, $rty); print_r($rty)*/?>
												
											<tr align="center">
												<td align="center" width="2%"><?php echo ++$counter; ?></td>
												<td><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></td>
												<td align="left"><?php echo strtoupper(getLastname($uid)).'&nbsp;'. strtoupper(getFirstname($uid));?></td>
												<td align="center" width="120px"><?php echo date("D, jS F Y", strtotime('today')); ?></td>
												<form action="" method="post">	
													<td>		
														<input type="radio" name="attendance" value="present"> <span class="badge bg-success">Present</span> <input type="radio" name="attendance" value="absent"> <span class="badge bg-danger">Absent</span>
													</td>
													<td><?php echo getAttendanceRem($sch_id, $uid, $class, $category, $ctid, $csid, $date);?></td>
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
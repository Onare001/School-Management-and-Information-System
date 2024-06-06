<?php $page_title = "Attendance Panel"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_GET['cd']) && isset($_GET['ad']) && isset($_GET['dt']) && isset($_GET['td']) && isset($_GET['sd'])){
	$class  = decrypt($_GET['cd']);
	$category = decrypt($_GET['ad']);
	$date = decrypt($_GET['dt']);
    $term_id = decrypt($_GET['td']);
    $session_id = decrypt($_GET['sd']);
} else {
	//header("location: manage_class_attendance");
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
									<h3 class="card-title">Attendance | <?php echo getClass($class).getCategory($category);?> | Form Teacher: <?php echo getFormteacher($sch_id, $class, $category);?> | <?php echo getTerm($term_id).' '.getSession($session_id);?></h3>
									<div style="float:right;">
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
											<th width="500px">Full Name</th>
											<th width="10px">#Present</th>
											<th width="10px">#Absent</th>
											<th width="5px">Remark</th>
											<th width="5px">Action</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											$rtyu = array();
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.class_id = '$class' AND stdnt_info.cat_id = '$category' AND sch_users.sch_id = '$sch_id' AND stdnt_info.status_id='1' ORDER BY sch_users.last_name ASC");
											while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"]; ?>
												
											<tr align="center">
												<td align="center" width="2%"><?php echo ++$counter; ?></td>
												<td><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></td>
												<td align="left" width="120px"><?php echo strtoupper(getLastname($uid)).' '. strtoupper(getFirstname($uid));?></td>
												<td align="center"><?php echo CountPresent($sch_id, $uid, $class, $category, $term_id, $session_id); ?></td>
												<td align="center" width="120px"><?php echo CountAbsent($sch_id, $uid, $class, $category, $term_id, $session_id); ?></td>
												<!--form action="" method="post">	
													<td>		
														<input type="radio" name="attendance" value="present"> <span class="badge bg-success">Present</span> <input type="radio" name="attendance" value="absent"> <span class="badge bg-danger">Absent</span>
													</td>
													<td><?php //echo getAttendanceRem($sch_id, $uid, $class, $category, $ctid, $csid, $date);?></td>
													<td align="center">
														<input name="student" type="hidden" value="<?php //echo $uid;?>">
														<input name="submit" type="submit" value="Submit" class="btn btn-primary">
													</td>
												</form-->
												<td align="center" width="120px"><?php echo ''; ?></td>
												<td align="center" width="120px"><?php echo ''; ?></td>
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
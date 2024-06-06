<?php $page_title = "Inactive Students"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id=""; $cat_id="";
if (isset($_GET['cid']) && isset($_GET['cat'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['cat']);
} else {
	header("location: select_class");
}

$result1 = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id='$class_id' LIMIT 1");
while($row = mysqli_fetch_array($result1)){
	$cid = $row['class_id'];
}

$result2 = mysqli_query($conn,"SELECT * FROM class_cat WHERE cat_id='$cat_id' LIMIT 1");
while($row=mysqli_fetch_array($result2)){
	$did = $row['cat_id'];
}

if (($class_id==$cid) && ($cat_id==$did)){
	
} else {
	header("location: select_class");
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
						<div class="col-md-2">
							<?php include ("include/regstu_menu.php"); ?> 
						</div>
						<div class="col-md-10">
							<div class="card" style="padding:10px;">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									  <tr>
										<th style="width:5px;">S/N</th>
										<th style="width:20px;">Passport</th>
										<th>Full Name</th>
										<th>Student ID</th>
										<th>Gender</th>
										<th>Class</th>
										<th>Status</th>
										<th>Edit</th>
										<th>Activate</th>
									  </tr>
									</thead>
									<tbody>	
										<?php
										$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id = '$class_id' AND cat_id = '$cat_id' AND sch_id = '$sch_id' AND status_id = '0'");
											while ($row = mysqli_fetch_array($result)){
											$uid = $row["user_id"]; $status = $row['status_id'];
										?>		
										<tr>
											<td><?php echo ++$counter; ?></td>
											<td><center><img src="<?php echo getPassport($uid);?>" alt="<?php echo getLastname($uid);?>" style="max-width:40px;" class="img-circle"/></center></td>
											<td><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
											<td><?php echo getUsername($uid);?></td>
											<td><?php echo getGender($row['sex_id']);?></td>
											<td><?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></td>
											<td id="status-<?php echo $row['user_id']; ?>" style="text-decoration:none;color:#007bff;"><?php echo ($row["status_id"]=='1') ? 'Active' : 'Inactive';?></td>
											<td class="border" align="center">
												<a title="Edit" href="edit_student?uid=<?php echo encrypt($row["user_id"]); ?>">
												<img src="assets/img/edit.png" width="16" height="16" alt="img">
												</a><br/>
											</td>
											<td align="center" width="5px">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch<?php echo $uid; ?>" <?php echo ($row['status_id'] == '1') ? 'checked' : ''; ?> data-tid="<?php echo  $uid; ?>" data-state="<?php echo ($row['status_id'] == '1') ? '1' : '0'; ?>" data-table="stdnt_info">
													<label class="custom-control-label" for="customSwitch<?php echo $uid; ?>"></label>
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
			</section>			
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<?php include ("include/page_scripts/reducebtn.php"); ?> 
<?php include ('include/ajax/switcher.php');?>
</html>
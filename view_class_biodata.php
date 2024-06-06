<?php $page_title = "Student Biodata Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id=""; $cat_id="";
if (isset($_GET['cid']) && isset($_GET['cat'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['cat']);
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

			<?php //include ("include/regstu_menu.php"); ?> 
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Student Biodata Record | <?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Student Name</th>
												<th>Sex</th>
												<th>DOB</th>
												<th>State</th>
												<th>LGA</th>
												<th>Parent<br>Name</th>
												<th>Relation</th>
												<th>Parent<br>Contact</th>
												<th>Address</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id = '$class_id' AND cat_id = '$cat_id' AND sch_id = '$sch_id' AND status_id = '1'");
											while ($row = mysqli_fetch_array($result)){
											$uid = $row['user_id']; $type_id = $row["type_id"]; 
											$sex_id = $row["sex_id"]; $state_id = $row["state_id"];
											?><tr>
												<td align="center"><?php echo ++$counter; ?></td>
												<td><?php echo getLastname($uid).'&nbsp;'.getFirstname($uid);?></td>
												<td><?php echo getGender($sex_id); ?></td>
												<td><?php echo date("jS M, Y", strtotime($dob = $row["dob"]));?></td>
												<td><?php echo getState($state_id);?></td>
												<td><?php echo getLGA($row["lga"]);?></td>
												<td><?php echo $row["p_name"];?></td>
												<td><?php echo $row["relationship"];?></td>
												<td><?php echo $row["parent_contact"];?></td>
												<td><?php echo $row["address"]; ?></td>
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
<?php include ("include/page_scripts/reducebtn.php"); ?> 
</html>
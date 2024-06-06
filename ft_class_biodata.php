<?php $page_title = "Class Biodata Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
 $class=""; $category="";
	$formM = "SELECT * FROM form_teacher_info WHERE user_id='$user_id'";
	$result = mysqli_query($conn,$formM);
	$row = mysqli_fetch_array($result);
	$class = $row['class_id'];
	$category = $row['cat_id'];
?>
 <!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>
<?php include('include/page_title.php');?>

<?php include('include/information.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Class Biodata Record | <?php echo getClass($class).getCategory($category);?></h3>
									<div style="float:right;">
										&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
									</div>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Student Name</th>
												<th>Gender</th>
												<th>DOB</th>
												<th>House</th>
												<th>Club & Society</th>
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
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON sch_users.user_id=stdnt_info.user_id AND sch_users.sch_id=stdnt_info.sch_id WHERE stdnt_info.class_id = '$class' AND stdnt_info.cat_id = '$category' AND sch_users.sch_id = '$sch_id' AND stdnt_info.status_id = '1' ORDER BY sch_users.last_name");
											while ($row = mysqli_fetch_array($result)){ 
											echo '
											<tr>
												<td align="center">'.++$counter.'</td>
												<td>'.getLastname($row['user_id']).' '.getFirstname($row['user_id']).'</td>
												<td align="center">'.getGender($row["sex_id"]).'</td>
												<td align="center">'.$row["dob"].'</td>
												<td align="center">'.getHouse($row["house_id"]).'</td>
												<td align="center">'.getClub($row["club_id"]).'</td>
												<td align="center">'.getState($row["state_id"]).'</td>
												<td align="center">'.getLGA($row["lga"]).'</td>
												<td align="center">'.$row["p_name"].'</td>
												<td align="center">'.$row["relationship"].'</td>
												<td align="center">'.$row["parent_contact"].'</td>
												<td align="center">'.$row["address"].'</td>	
											</tr>';
											} ?>               
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
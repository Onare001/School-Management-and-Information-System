<?php $page_title = "Class Biodata Record"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_GET['clid'])){
	$club_id = decrypt($_GET['clid']);
}
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
<!--Information-->
<?php include('include/information.php');?>
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								<h3 class="card-title"><?php echo getClub($club_id);?> Student List </h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SN</th>
												<th>Passport</th>
												<th>Student Name</th>
												<th>Gender</th>
												<th>Class</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON sch_users.user_id=stdnt_info.user_id AND sch_users.sch_id=stdnt_info.sch_id WHERE stdnt_info.club_id = '$club_id' AND sch_users.sch_id = '$sch_id' AND stdnt_info.status_id = '1' ORDER BY sch_users.last_name, stdnt_info.class_id");
											while ($row = mysqli_fetch_array($result)){
												echo '
											<tr>
												<td align="center">'.++$counter.'</td>
												<td align="center"><img src="'.getPassport($row['user_id']).'" style="max-width:40px;" class="img-circle"/></td>
												<td>'.getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']).'</td>
												<td align="center">'.getGender($row["sex_id"]).'</td>
												<td align="center">'.getClass($row["class_id"]).getCategory($row["cat_id"]).'</td>
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
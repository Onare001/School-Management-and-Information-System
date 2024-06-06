<?php $page_title = "Class List"; ?>
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
									<h3 class="card-title">Class List | <?php echo getClass($class).getCategory($category);?></h3>
									<div style="float:right;">
									&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
									<a href="ft_class_biodata" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-eye">&nbsp;&nbsp;</i> View Student' Biodata </div></a>
									</div>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:5px;">S/N</th>
											<th style="width:10px;">Passport</th>
											<th style="width:20px;">Full Name</th>
											<th style="width:10px;">Student ID</th>
											<th style="width:5px;">Gender</th>
											<th style="width:5px;">Class</th>
											<th style="width:5px;">Mail</th>
											<th style="width:5px;">Status</th>
											<th style="width:5px;"></th>
										</thead>	
										<tbody>	
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.class_id = '$class' AND stdnt_info.cat_id = '$category' AND sch_users.sch_id = '$sch_id' ORDER BY sch_users.last_name ASC");
											while ($row = mysqli_fetch_array($result)){
											echo '		
											<tr>
												<td align="center">'.++$counter.'</td>
												<td><center><img src="'.getPassport($row["user_id"]).'" alt="'.getLastname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/></center></td>
												<td><a href="fm_edit_student?uid='.encrypt($row["user_id"]).'">'.strtoupper(getLastname($row["user_id"])).'&nbsp;'.strtoupper(getFirstname($row["user_id"])).'</a></td>
												<td>'.getUsername($row["user_id"]).'</td>
												<td>'.getGender($row['sex_id']).'</td>
												<td>'.getClass($row["class_id"]).' '.getCategory($row["cat_id"]).'</td>
												<td align="center"><a title="Send Message" href="staff_compose?uid='.encrypt($row["user_id"]).'"><img src="assets/img/email.png" width="16" height="12" alt="img"></a></td>
												
												<td align="center" id="status-'.$row['user_id'].'" style="text-decoration:none;color:#007bff;">'; echo ($row["status_id"]=='1') ? 'Active' : 'Inactive'; echo '</td>'
												/*<!--td align="center">
												if ($row['status_id'] == 1) {
													echo '<a title="activated" style="text-decoration:none;" href="deactivate?suid='.encrypt($uid).'"><img src="assets/img/tick.png" alt="img"></a>';
												} else if ($row['status_id'] == 0) {
													echo '<a title="deactivated" style="text-decoration:none;" href="activate?suid='.encrypt($uid).'"><img src="assets/img/drop.png" alt="img"></a>';
												}</td-->*/
												.'<td align="center" width="5px">
													<div class="custom-control custom-switch">';
												echo '<input type="checkbox" class="custom-control-input" id="customSwitch'.$row["user_id"].'"';
												echo ($row['status_id'] == '1') ? ' checked' : '';
												echo ' data-tid="'.$row["user_id"].'" data-state="';
												echo ($row['status_id'] == '1') ? '1' : '0';
												echo '" data-table="stdnt_info">';
												echo '<label class="custom-control-label" for="customSwitch'.$row["user_id"].'"></label>';
												echo '</div>
												</td>
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
<?php include ('include/ajax/switcher.php');?>
</html>
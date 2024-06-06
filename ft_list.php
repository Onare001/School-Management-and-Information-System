<?php $page_title = "Form Teachers List"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
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
							<div class="sticky-top mb-3">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b>Staff List</b></h3>
									</div>
									<div class="card-body">
										<style> .btn-block{font-size:12px;}</style>	
										<button type="button" onclick="location.href='register_staff'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-user-plus"></i> Register Staff</button>
										<button type="button" onclick="location.href='staff_task_list'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-chalkboard-teacher"></i> Staff Class List </button>
										<button type="button" onclick="location.href='ft_list'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-users"></i> Form Teachers List </button>
										<button type="button" onclick="location.href='staff_record'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-users"></i> Staff Record </button>
										<button type="button" onclick="location.href='staff_profile'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-eye"></i> View Staff Profile </button>
										<button type="button" title="back" onclick="goBack()" class="btn btn-secondary btn-block btn-sm"><i class="fa fa-arrow-left"></i> Back </button>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><b></b></h3>
									</div>
									<div class="card-body">
										<div id="external-events" style="font-size:12px;">
										<?php
											echo '<div class="external-event bg-danger"><i class="fa fa-users"></i> Total No. of Saff: '. getNumStaff($sch_id).'</div>
											<div class="external-event bg-pink"><i class="fa fa-user-tie"></i> Academic Staff: '.  getNumStafftype($sch_id, 1).'</div>
											<div class="external-event bg-primary"><i class="fa fa-users"></i> Non Acad Staff: '. getNumStafftype($sch_id, 2).'</div>';?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-10">
							<div class="card content">
								<div class="card-header">
									<h3 class="card-title">Office Holder/Form Teacher's List</h3>
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th style="width:10px;">S/N</th>
											<th style="width:20px;">Passport</th>
											<th>Full Name</th>
											<th>Email Address</th>
											<th>Privilege</th>
											<th>Class</th>
											<th>Edit</th>
											<th>Relief</th>
										</thead>
										<tbody>				
										<?php
										$result = mysqli_query($conn,"SELECT * FROM form_teacher_info JOIN sch_users ON form_teacher_info.user_id = sch_users.user_id AND form_teacher_info.sch_id = sch_users.sch_id WHERE sch_users.priv_id!=9 AND sch_users.priv_id!=6 AND form_teacher_info.sch_id = '$sch_id' ORDER BY form_teacher_info.class_id,cat_id,sch_users.priv_id ASC");
										while ($row = mysqli_fetch_array($result)){
		                                 echo '
											<tr>
												<td align="center">'.++$counter.'</td>
												<td align="center">
													<img src="'.getPassport($row["user_id"]).'" alt="'.getFirstname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/>
												</td>	
												<td>'.getLastname($row["user_id"]).' '.getFirstname($row["user_id"]).'</td>		
												<td>'.getUsername($row["user_id"]).'</td>
												<td>'.getPriviledge($row['priv_id']).'</td>	
												<td>';
													if ($row['priv_id']==5){
														echo '<a href="'.'register_student?cid='.encrypt($row["class_id"]).'&cat='.encrypt($row["cat_id"]).'">'. getClass($row["class_id"]).' '.getCategory($row["cat_id"]).' ['.getNumStuClass($sch_id, $row["class_id"], $row["cat_id"]).']'.'</a>';
													} else {
														echo 'Universal';
													}echo '</td>
												<td class="border" align="center" width="5%"><a title="Privilege" href="edit_privilege?uid='.encrypt($row["user_id"]).'"><img src="assets/img/dev.png" width="16" height="16" alt="img"></a></td>
												<td class="border" align="center" width="5%"><a onclick="return confirm(\'Are you sure you want to remove '.getFirstname($row['user_id']).' from being a '.getPriviledge($row['priv_id']).'\');" href="confirm_delete?fuid='.encrypt($row['user_id']).'" ><img src="assets/img/trash.png" width="16" height="16" alt="img"></a></td>
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
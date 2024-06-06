<?php $page_title = "Form Teacher's Comment"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
 $class=""; $category="";
	$formM = "SELECT * FROM form_teacher_info WHERE user_id='$user_id'";
	$result = mysqli_query($conn,$formM);
	$row = mysqli_fetch_array($result);
	$class = $row['class_id'];
	$category = $row['cat_id'];
	
	//Updating Student Comment
	if (isset($_POST['submit'])){
		$uid = decrypt($_POST['student']);
		$com_id = $_POST['com_id'];
		if (empty($com_id)){
			$msg = 'Please Select a Comment for '.getLastname($uid).' '.getFirstname($uid);
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		} else {
			/*new method*/
			$check = mysqli_query($conn, "SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid'");
			if (mysqli_num_rows($check) == false){
				$result = mysqli_query($conn,"INSERT INTO stdnt_com (user_id, com_id, sch_id, class_id, cat_id, term_id, session_id) VALUES ('$uid','$com_id','$sch_id','$class','$category','$ctid','$csid')");
			} else {
				$result = mysqli_query($conn,"UPDATE `stdnt_com` SET `com_id` = '$com_id' WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$class' AND cat_id='$category' AND term_id='$ctid' AND session_id='$csid'");
			}
			/*new method*/
			//$result = mysqli_query($conn,"UPDATE `stdnt_info` SET `com_id` = '$com_id' WHERE user_id='$uid'");
			if ($result == true){
				$msg = 'Comment Added for '.getLastname($uid).' '.getFirstname($uid);
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
			} else{
				//error
			}
		}
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
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Comment on Student Behaviour | <?php echo getClass($class).getCategory($category);?></h3>
									<div style="float:right;">
										<a href="#" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
									</div>
								</div>
								<div class="card-body">
									<?php if (isset($msg)) { echo $msg_toastr; }?>
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										  <tr>
											<th width="5px">S/N</th>
											<th width="10px">Passport</th>
											<th width="30%x">Full Name</th>
											<th width="10px">Student ID</th>
											<th width="450px">Comment</th>
											<th width="5px">Action</th>
										  </tr>
										</thead>
										<tbody>	
											<?php
											$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id = '$class' AND cat_id = '$category' AND sch_id = '$sch_id' AND status_id='1'");
											while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"];	
												
											$getComment = mysqli_query($conn,"SELECT * FROM stdnt_com WHERE user_id='$uid' AND class_id = '$class' AND cat_id = '$category' AND sch_id = '$sch_id' AND term_id='$ctid' AND session_id='$csid'");
											if ($getComment){
												$comm = mysqli_fetch_assoc($getComment);
												$comment = $comm['com_id'];
											} else {
												mysqli_error($conn);
											}
											$comment1 = mysqli_query($conn,"SELECT * FROM teachers_com");
												
											echo '
											<tr align="center">
												<td align="center">'.++$counter.'</td>
												<td><img src="'.getPassport($row["user_id"]).'" alt="'.getLastname($row["user_id"]).'" style="max-width:40px;" class="img-circle"/></td>
												<td>'.strtoupper(getLastname($row["user_id"])).'&nbsp;'. strtoupper(getFirstname($row["user_id"])).'</td>
												<td>'.getUsername($row["user_id"]).'</td>
												<form action="" method="post">	
													<td>		
														<select name="com_id" class="form-control">
															<option value="">'; if (empty($comment)){ echo 'Select a Comment for this Student';} else { echo getCom($comment);};echo '</option><br/>';
															while ($row = mysqli_fetch_array($comment1)){
															echo '<option value="'.$row['com_id'].'">'.$row['comment'].'</option>';
															}; echo '<br/>
														</select> 
													</td>
													<td align="center">
														<input name="student" type="hidden" value="'.encrypt($uid).'">
														<input name="submit" type="submit" value="Submit" class="btn btn-primary">
													</td>
												</form>	
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
<?php $page_title = "Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (!isset($_SESSION['reloaded'])) {
    echo "<script>window.location.reload();</script>";
    $_SESSION['reloaded'] = true; // set the session variable to true after first reload
}

$staff_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN staff_info ON sch_users.user_id=staff_info.user_id WHERE sch_users.user_id='$user_id'");
if ($staff_info){
	$sinfo = mysqli_fetch_array($staff_info);
	$uid = $user_id;
} else {
	$msg = mysqli_error($conn);
	$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
}

//Just to ensure that the form is filled
$result = mysqli_query($conn,"SELECT * FROM staff_info WHERE user_id='$user_id'");
$info = mysqli_fetch_array($result);
if (empty($info['phone_no']) || empty($info['file_no']) || empty($info['acc_no']) || empty($info['dob']) || empty($info['state_id']) || empty($info['lga']) || empty($info['status_id']) || empty($info['discipline']) || empty($info['address']) || empty($info['sex_id']) || empty($info['qual_id']) || empty($info['type_id']) || empty($info['doa']) || empty($info['dept_id']) || empty($info['rel_id']) || empty($info['post_id'])){
	$msg = 'It is imperative that you fulfill the requirement of completing your record before proceeding further. Failure to do so will result in the restriction of your ability to perform any subsequent tasks.';
	$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
}
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
						<div class="col-md-3">
							<div class="card card-<?php echo $sch_color;?> card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?php echo getPassport($user_id);?>" alt="Staff-passport"/>
									</div>
									<h3 class="profile-username text-center"><?php echo getFirstname($user_id).'&nbsp'.getLastname($user_id);?></h3>
									<p class="text-muted text-center"><?php echo getPriviledge($sinfo['priv_id']);?></p>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item"><b>Category</b> <a class="float-right"><?php echo getStafftype($sinfo["type_id"]);?></a></li>
										<li class="list-group-item"><b>Department</b> <a class="float-right"><?php echo getDept($sinfo["dept_id"]);?></a></li>
										<li class="list-group-item"><b>Email</b> <a class="float-right" style="font-size:11px;"><?php echo getUsername($user_id);?></a></li>
										<li class="list-group-item"><b>Phone Number</b><a class="float-right"><?php echo $sinfo["phone_no"];?></a></li>
									</ul>
<?php /*<!--label for="quantity">Enter a number:</label>
<input type="number" id="quantity" name="quantity" placeholder="1ST CA" max="100" oninput="validity.valid||(value='');" class="form-control"-->*/?>
									<a href="staff_messages" class="btn btn-primary btn-block"><b><i class="fa fa-envelope"></i>&nbsp;Message</b></a>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">About</h3>
								</div>
								<div class="card-body">
									<strong><i class="fas fa-book mr-1"></i> Qualification</strong>
									<p class="text-muted"><?php echo getQualification($sinfo["qual_id"]); if(!empty($sinfo["discipline"])){echo ' in '.$sinfo["discipline"];}?></p>
									<hr>
									<strong><i class="fas fa-map-marker-alt mr-1"></i>Address</strong>
									<p class="text-muted"><?php echo $sinfo["address"];?></p>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Task Information</a></li>
										<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Edit Profile</a></li>
										<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Timetable</a></li>
										
										<li class="nav-item"><a class="nav-link active bg-danger" href="#term" data-toggle="tab"><?php echo getTerm($ctid);?></a></li>
										<li class="nav-item"><a class="nav-link active bg-success" href="#session" data-toggle="tab"><?php echo getSession($csid).' Academic Session';?></a></li>
									</ul>
								</div>
								<div class="card-body">
									<div class="tab-content">
										<div class="active tab-pane" id="activity">
											<table border="0" align="center" class="table table-striped" style="border-collapse:collapse; width:85%;">
												<thead style="background-color:darkblue;color:white;">
													<th class="border" align="center" width="5px">S/N</th>
													<th class="border" align="center" width="20%">CLASS</th>
													<th class="border" align="center" width="5px">ARM</th>
													<th class="border" align="left" width="60%">SUBJECT</th>
													<th class="border" align="center" width="5px">TYPE</th>
													<th class="border" align="center" width="10px">PROGRESS</th>
												</thead>
												<tbody>
													<?php
													$result = mysqli_query($conn,"SELECT * FROM staff_info JOIN subj_info ON staff_info.subj_id=subj_info.subj_id WHERE staff_info.user_id = '$user_id' AND staff_info.subj_id != '0' AND staff_info.sch_id = '$sch_id' AND staff_info.class_id !=0 ORDER BY staff_info.class_id,staff_info.cat_id,subj_info.subj_title ASC");
													if(mysqli_num_rows($result) == 0) {
														echo "<tr><td colspan='6' align='center' ><font color='red'>We regret to inform you that there are currently no tasks assigned to you. Please kindly report to the admin with your full name and a list of the classes, categories, and subjects that you are responsible for. This will enable the admin to investigate and provide you with the necessary tasks and responsibilities to fulfill your role effectively. Thank you for your cooperation.</font></td></tr>";
													} else {
														while ($row = mysqli_fetch_array($result)){
													echo '		  
													<tr>
														<td class="border" align="center">'.++$counter.'</td>
														<td class="border" align="center"><a title="Click to Enter Score" href="enter_score?cid='.encrypt($row["class_id"]).'&did='.encrypt($row["cat_id"]).'&sid=' . encrypt($row["subj_id"]) . '&tid=' . encrypt($ctid) . '&sesid=' . encrypt($csid).'">'.getClass($row["class_id"]).'</a></td>
														<td class="border" align="center">'.getCategory($row["cat_id"]).'['.getTotalNumStuPerSubj($sch_id, $row["class_id"], $row["cat_id"], $row["subj_id"]).']'.'</td>
														<td class="border" align="left">'.getSubject($row["subj_id"]).'</td>
														<td class="border" align="left">'.getSubjectType($row["subj_id"]).'</td>
														<td class="border" align="left"><a title="Click to Enter Score" href="enter_score?cid='.encrypt($row["class_id"]).'&did='.encrypt($row["cat_id"]).'&sid=' . encrypt($row["subj_id"]) . '&tid=' . encrypt($ctid) . '&sesid=' . encrypt($csid).'">'.getEntryProgress($row["subj_id"], getTotalNumStuPerSubj($sch_id, $row["class_id"], $row["cat_id"], $row["subj_id"]), getNumScore($sch_id, $row["class_id"], $row["cat_id"], $row["subj_id"], $ctid, $csid), $sch_id, $row["class_id"], $row["cat_id"]).'</a></td>
													</tr>';
														}
													}
													?>
												</tbody>
											</table>        
										</div>
										<div class="tab-pane" id="timeline">
											<div class="">
												<div class="form-group row">
													<div class="card card-success" style="width:900px;margin-left:20px;">
														<div class="card-header">
															<h3 class="card-title">Edit Staff Details</h3>
															<div class="card-tools">
																<button type="button" class="btn btn-tool" data-card-widget="collapse">
																	<i class="fas fa-minus"></i>
																</button>
																<button type="button" class="btn btn-tool" data-card-widget="remove">
																	<i class="fas fa-times"></i>
																</button>
															</div>
														</div>
														<div class="card-body">
															<?php include('include/edit_staff_data.php');?>
															<?php if (isset($msg)) { echo $msg_toastr; } ?>
														</div>	
													</div>
												</div>				  					  
											</div>
										</div>
										<div class="tab-pane" id="settings">
											<div class="">
												<div class="form-group row">
													<?php include('include/timetables/staff_class_timetable.php');?> 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/ajax/process_lga.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script>
// Get the fragment identifier from the URL
var hash = window.location.hash;

// Do something based on the fragment identifier
if (hash === '#setting') {
  // Scroll to a specific element
  var element = document.getElementById('setting-section');
  if (element) {
    element.scrollIntoView();
  }

  // Show/hide an accordion
  var accordion = document.getElementById('setting-accordion');
  if (accordion) {
    accordion.classList.add('active');
    // You would need to define a CSS class to show the accordion
  }
}
</script>
<script>
    // JavaScript code to capture the keyboard event
    document.addEventListener('keydown', function(event) {
      // Check if Ctrl key and period key were pressed simultaneously
      if (event.ctrlKey && event.keyCode === 190) {
        // Perform logout action here, e.g., redirect to logout script
        window.location.href = 'logout.php';
      } else if(event.ctrlKey && event.keyCode === 191){
		  window.location.href = 'enter_class_score';
	  } else if(event.keyCode === 191){
		   window.location.href = 'enter_class_score';
	  }
    });
  </script>
</html>
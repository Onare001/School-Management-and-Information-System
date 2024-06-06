<?php $page_title = "View Testimonial"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
/* if (isset($_GET['msg'])) {
    $msg = ($_GET['msg']);//Class
	} */	
?>
<?php
if (isset($_POST['submit1'])) {
    $year_id = $_POST['year_id'];
    $cat_id = $_POST['cat_id'];
    if (empty($year_id)) {
        $msg = 'Select Year of Graduation!';
		$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
		$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
	} else { //
		 $result = mysqli_query($conn,"SELECT stdnt_id FROM stdnt_info WHERE sch_id='$sch_id' AND yid='$year_id' AND cat_id='$cat_id'");
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: testimonial?yid=" . encrypt($year_id) . "&did=" . encrypt($cat_id) ."");
        } else {
            $msg = 'No graduated students in this Year';
			$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_no_result.mp3" type="audio/mpeg">
			</audio>';
        }
    }
} else if (isset($_POST['submit'])) {
	$username = $_POST['student_id'];
    $uid = getUserid($username);
    $year_id = $_POST['year_id'];
	if (empty($username)) {
		$msg = 'Enter Student ID!';
		$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_enter_student_id.mp3" type="audio/mpeg">
			</audio>';
	} else if (empty($year_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else { //
        $sql = "SELECT stdnt_id FROM stdnt_info WHERE user_id='$uid' AND sch_id='$sch_id' AND yid='$year_id'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: testimonial?uid=". encrypt($uid) ."&yid=" . encrypt($year_id) . "");
        } else {
            $msg = 'No Testimonial Found for this Student';
			$msg_toastr = '<script>toastr.error("' . $msg . '")</script>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_student_result.mp3" type="audio/mpeg">
			</audio>';
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

			<section class="content" id="classes">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-certificate"></i> Testimonial </h3>
						<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-5 col-sm-3">
								<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Year of Graduation</a>
									<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Student</a>
								</div>
							</div>
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-tabContent">
									<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
										<form action="" method="post">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;float:left;">
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="year_id" id="sel_year" class="form-control">
																<?php
																echo '<option value="">'.'Select Year of Graduation'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM year_info WHERE year_title < '$yearlim' OR year_title = '$yearlim'");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["year_id"].'">'.$row["year_title"].'</option>'; } ?><br/>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="cat_id" id="sel_cat" style="width:100%;" class="form-control">
																<option value="">Class Category</option>
																<?php
																$result = mysqli_query($conn,"SELECT * FROM class_cat");
																while ($row = mysqli_fetch_array($result)){	?><option value="<?php echo $row["cat_id"];?>"><?php echo $row["category"];?></option>
																<?php } ?><br/>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right">
														<div class="col-md-12">&nbsp;
															<input name="submit1" type="submit" value="Submit" class="btn btn-primary"/>
														</div>
													</td>
												</tr>
											</table>
										</form>
									</div>
									<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
										<form action="" method="post" autocomplete="off">
											<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
												<tr>
													<td align="left">
														<div class="col-md-12">
															<input name="student_id" type="text" value="<?php if (isset($_POST['student_id'])) echo $_POST['student_id']; ?>" placeholder="Enter Student ID" maxlength="15" class="form-control">
														</div>
													</td>
												</tr>				
												<tr>
													<td align="left">
														<div class="col-md-12"> 
															<select name="year_id" id="sel_year" class="form-control">
																<?php
																echo '<option value="">'.'Select Year of Graduation'.'</option>';
																$result = mysqli_query($conn,"SELECT * FROM year_info WHERE year_title < '$yearlim' OR year_title = '$yearlim'");
																while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["year_id"].'">'.$row["year_title"].'</option>'; } ?><br/>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right">
														<div class="col-md-12">&nbsp;
															<input name="submit" type="submit" value="Submit" class="btn btn-primary"/>
														</div>
													</td>
												</tr>
											</table>	
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>   
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
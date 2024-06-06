<?php $page_title = "Timetables"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
if (isset($_POST['submit1'])) {
    $class_id = $_POST['class_id'];
    $cat_id = $_POST['cat_id'];
    $subj_id = $_POST['subj_id'];
    $day = $_POST['day'];
	$time_id = $_POST['time_id'];
    if (empty($class_id)) {
        $msg = 'Select Class!';
    } else if (empty($cat_id)) {
        $msg = 'Select Class Category!';
    } else if (empty($subj_id)) {
        $msg = 'Select a Subject!';
    } else if (empty($day)) {
        $msg = 'Select Day!';
    } else if (empty($time_id)){
		$msg = 'Select Time!';
	} else { //
        $sql = "INSERT INTO `class_timetable` (`sch_id`, `class_id`, `cat_id`, `subj_id`, `day`, `time_id`) VALUES ('$sch_id','$class_id','$cat_id','$subj_id','$day','$time_id')";
		 $result = mysqli_query($conn, $sql);
        if ($result) {
			$msg = 'Subject has been added to the Timetable';
        } else {
            $msg = 'Something went wrong. Please, try again';
        }
    }
}
?>
<?php
if (isset($_POST['submit'])) {
    $session_id = $_POST['session_id'];
    $term_id = $_POST['term_id'];
    $subj_id = $_POST['subj_id'];
    $date = $_POST['date'];
	$time = $_POST['time'];
	if (empty($session_id)) {
		$msg = 'Select Session!';
	} else if (empty($term_id)) {
        $msg = 'Select Term!';
    } else if (empty($subj_id)) {
        $msg = 'Select Subject!';
    } else if (empty($date)) {
        $msg = 'Select Date Of Examination!';
    } else if (empty($time)) {
        $msg = 'Select Time of Examination!';
    } else { //
       $sql = "INSERT INTO `exam_timetable` (`sch_id`, `sid`, `term_id`, `subj_id`, `date`, `time`) VALUES ('$sch_id','$session_id','$term_id','$subj_id','$date','$time')";
		 $result = mysqli_query($conn, $sql);
        if ($result) {
			$msg = 'Subject has been added to the Timetable';
        } else {
            $msg = 'Something went wrong. Please, try again';
        }
    }
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

<section class="content" id="classes">
<div class="card card-primary card-outline">
	  <div class="card-header">
		<h3 class="card-title">
		  <i class="fas fa-clock"></i>
		  Time Tables
		</h3>
	  </div>
          <div class="card-body">
            <h4><!--Left Sided--></h4>
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Class timetable</a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Examination timetable</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
				  
				  <?php if (isset($msg)) { echo '<p style="color:red;text-align:center;" class="error">'. $msg.'</p>';} ?>
                     <table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;float:left;">
						<form action="" method="post">
						  <tr>
							<td align="left">
								<div class="col-md-12"> 
									<select name="class_id" id="sel_class" class="form-control">
										<?php
										echo '<option value="">'.'Select Class'.'</option>';
										$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
										while ($row = mysqli_fetch_array($result)){
										echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
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
											while ($row = mysqli_fetch_array($result)){	?>
											<option value="<?php echo $row["cat_id"];?>"><?php echo $row["category"];?></option>
										<?php }	?>
									</select>
								</div>
						  </td>
						  </tr>
						  
						  <tr>
							<td>
								<div class="col-md-12">    
									<select name="subj_id" id="sel_subj" class="form-control">
										<option value=""> Select Subject</option>
										<?php
										$result = mysqli_query($conn,"SELECT * FROM subj_info");
										while ($row = mysqli_fetch_array($result)){ ?>
										<option value="<?php echo $row["subj_id"];?>"><?php echo $row["subj_title"];?></option>
										<?php } ?>
									</select>
								</div>  
							</td>
						  </tr>
						  
						  <tr>
							<td>
							<div class="col-md-12">      
								<select name="day" id="sel_day" class="form-control">
									<option value="">Select Day</option>
									<option value="monday">Monday</option>
									<option value="tuesday">Tuesday</option>
									<option value="wednesday">Wednesday</option>
									<option value="thursday">Thursday</option>
									<option value="friday">Friday</option>
								</select>
							</div> 
						   </td>  
						  </tr>
						  
						    <tr>
							<td>
							<div class="col-md-12">      
								<select name="time_id" id="time_id" class="form-control">
									<option value="">Select Time</option>
									<option value="1">8:00 - 8:40AM</option>
									<option value="2">8:40 - 9:20AM</option>
									<option value="3">9:20 - 10:00AM</option>
									<option value="4">10:30 - 11:10AM</option>
									<option value="5">11:10 - 11:50AM</option>
									<option value="6">11:50 - 12:30PM</option>
									<option value="7">12:40 - 1:20PM</option>
									<option value="8">1:20 - 2:00PM</option>
								</select>
							</div> 
						   </td>  
						  </tr>
						  
						  <tr>
							<td align="right">
								<div class="col-md-12">&nbsp;
									<input name="submit1" type="submit" value="Submit" class="btn btn-primary">
								</div>
							</td>
						  </tr>
						  </form>
						</table>
						</div>

<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
	<?php if (isset($msg)) { echo '<p style="color:red;text-align:center;" class="error">'. $msg.'</p>';} ?>
		<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
			<form action="" method="post">
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<select name="session_id" id="sel_session" class="form-control">
								<?php
								echo '<option value="">'.'Select Session'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status='1'");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["sid"].'">'.$row["session"].'</option>'; } ?><br/>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<select name="term_id" id="sel_term" class="form-control">
								<?php
								echo '<option value="">'.'Select Term'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status='1'");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>'; } ?><br/>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<select name="subj_id" id="sel_subj" class="form-control">
								<!--Option Content-->
								<?php
								echo '<option value="">'.'Select Subject'.'</option>';
								$result = mysqli_query($conn,"SELECT * FROM subj_info");
								while ($row = mysqli_fetch_array($result)){
								echo '<option value="'.$row["subj_id"].'">'.$row["subj_title"].'</option>'; } ?><br/>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<input type="date" name="date" class="form-control"/>
						</div>
					</td>
				</tr>
				<tr>
					<td align="left">
						<div class="col-md-12"> 
							<select name="time" id="sel_time" class="form-control">
								<?php
								echo '<option value="">'.'Select Time'.'</option>';
								echo '<option value="Morning">Morning</option>
								<option value="Mid Morning">Mid Morning</option>
								<option value="Afternoon">Afternoon</option>';
								?><br/>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td align="right">
						<div class="col-md-12">&nbsp;
							<input name="submit" type="submit" value="Submit" class="btn btn-primary">
						</div>
					</td>
				</tr>
			</form>
		</table>
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
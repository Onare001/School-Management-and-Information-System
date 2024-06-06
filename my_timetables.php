<?php $page_title = "My Timetables"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$user_id' AND stdnt_info.user_id='$user_id'");
while ($row = mysqli_fetch_array($result)){
	$class_id = $row["class_id"];
	$cat_id = $row["cat_id"];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
       
			<div class="card box-primary" style="margin-left:10px;margin-right:10px;height:60px">
				<div class="card-header">
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="student_dashboard" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
					<a href="my_timetables" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-clock">&nbsp;&nbsp;</i>My Class Timetable</div></a>
					<a href="exam_timetable" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-table">&nbsp;&nbsp;</i>Examination Timetable</div></a>
				</div>
			</div>
			<div class="card card-primary" style="width:950px;margin-left:20px;margin:0 auto;">
				<div class="card-header">
					<h3 class="card-title">&nbsp;&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;My Class Timetable</h3>
				</div>
				<center><?php include("include/timetables/class_timetable.php");?></center> 
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
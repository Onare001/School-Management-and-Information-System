<?php $page_title = "Examination Timetable"; ?>
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
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="student_dashboard.php" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a>
					<a href="my_timetables" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-clock">&nbsp;&nbsp;</i>My Class Timetable</div></a>
					<a href="exam_timetable" style="font-size:16px; font-weight:bold;">  <div class="btn btn-primary"><i class="fa fa-table">&nbsp;&nbsp;</i>Examination Timetable</div></a>
				</div>
			</div>
            <div class="card card-primary" style="width:950px;margin-left:20px;margin:0 auto;">
              <div class="card-header">
                <h3 class="card-title">&nbsp;&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;Examination Timetable</h3>
              </div>
			<center>	
				<table border="1" cellspacing="3" cellpadding="3" class="table" style="width:80%;margin-bottom:20px;">
					<thead style="background-color:<?php echo $theme;?>;">
						<tr colspan="4">
							<?php echo strtoupper($current_term).'&nbsp;'.'EXAMINATION TIME-TABLE'.'&nbsp;'.$current_session.'&nbsp;'.'ACADEMIC SESSION';?>
						</tr>
						<tr align="center">
							<th>Date/Day</th>
							<th>Morning<br>8:00 AM</th>
							<th>Mid Morning<br>10:30 AM</th>
							<th>Afternoon<br>12:30PM</th>
						</tr>
					</thead>
					<?php
					$result1 = mysqli_query($conn,"SELECT DISTINCT (date) as date FROM exam_timetable WHERE term_id='$ctid' AND sid='$csid'");
					while($t = mysqli_fetch_assoc($result1)){
						$date = $t['date'];
					$result2 = mysqli_query($conn,"SELECT * FROM exam_timetable WHERE date = '$date'");
					?>
					<tbody>
						<tr align="center">
							<td><?php echo date("D, jS F Y", strtotime($t['date']));?></td>
							<?php
							$exam_time = array('Morning','Mid Morning','Afternoon');
							$classes = array();
							while($row = mysqli_fetch_assoc($result2)) {
								$classes[$row['time']] = $row;
							}
							foreach ($exam_time as $time) {
							
							if (array_key_exists($time, $classes)) { 
								$row = $classes[$time];
								echo '<td>'.getSubject($row['subj_id']).'</td>';
								} else {
								echo '<td>'.''.'</td>';
								} 
							} ?>
						</tr>
					 <?php } ?>
					</tbody>
				</table>
			</center> 
		</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
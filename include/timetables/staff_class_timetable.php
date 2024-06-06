<?php
 function getTimeTable($sch_id, $day, $time, $user_id){
	include ("include/connection.php");
	$result = mysqli_query($conn,"SELECT * FROM class_timetable JOIN staff_info ON class_timetable.class_id=staff_info.class_id AND class_timetable.cat_id=staff_info.cat_id AND class_timetable.subj_id=staff_info.subj_id AND class_timetable.sch_id=staff_info.sch_id WHERE staff_info.sch_id='$sch_id' AND class_timetable.day='$day' AND class_timetable.time_id='$time' AND staff_info.user_id='$user_id'");
	if ($result){
		$row = mysqli_fetch_assoc($result);
		$subject = strtoupper(getSubjectAbbr($row['subj_id'])).'<br/>'.getClass($row['class_id']).getCategory($row['cat_id']).'<!--i class="fa fa-star text-danger"></i-->';
	} else {
		$msg = mysqli_error($conn);
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		$subject = 'N/A';
	}
	return $subject;
 }

function setCurrentSubject($day, $time){
	//getting current day and time...
	$current_day = substr(date("D, jS F Y", strtotime(date('d'.'m'.'y'))),0,3);
	 if ($current_day == 'Mon'){
			$today = "Monday";
		} else if ($current_day == 'Tue'){
			$today = "Tuesday";
		} else if ($current_day == 'Wed'){
			$today = "Wednesday";
		} else if ($current_day == 'Thu'){
			$today = "Thursday";
		} else if ($current_day == 'Fri'){
			$today = "Friday";
		} else if ($current_day == 'Sat'){
			$today = "Saturday";
		} else {
			$today = "Sunday";
		}
		
		// Getting Current time...
		date_default_timezone_set('Africa/Lagos');
		$current_time = date("H:i");

		if ($current_time >= '08:00' && $current_time <= '08:39') {
			$ctime = "1";
		} else if ($current_time >= '08:40' && $current_time <= '09:19') {
			$ctime = "2";
		} else if ($current_time >= '09:20' && $current_time <= '09:59') {
			$ctime = "3";
		} else if ($current_time >= '10:30' && $current_time <= '11:09') {
			$ctime = "4";
		} else if ($current_time >= '11:10' && $current_time <= '11:49') {
			$ctime = "5";
		} else if ($current_time >= '11:50' && $current_time <= '12:29') {
			$ctime = "6";
		} else if ($current_time >= '12:40' && $current_time <= '13:19') {
			$ctime = "7";
		} else if ($current_time >= '13:20' && $current_time <= '14:00') {
			$ctime = "8";
		} else {
			$ctime = "";
		}

		if (($day == $today)&&($time == $ctime)){
			$active_subject = 'active_subject';
		} else {
			$active_subject = '';
		}
		return $active_subject;
	 }
	 
	function setBreakTime($time){
		// Getting Current time...
		date_default_timezone_set('Africa/Lagos');
		$current_time = date("H:i");
		
		if ($current_time >= '10:00' && $current_time <= '10:29'){
			$ctime = '20';
		} else if ($current_time >= '12:30' && $current_time <= '12:39') {
			$ctime = '30';
		} else {
			$ctime = '';
		}
		
		if ($ctime == $time){
			$active_subject = 'active_subject';//Long break
		} else {
			$active_subject = '';
		}
		return $active_subject;
	 }
 ?>
<style>
													.break {
														font-size:20px;
														-ms-transform: rotate(-90deg); /* IE 9 */
														transform: rotate(-90deg);
													}
													.active_subject {
														background-color:red;
														color:white;
													}
												</style>
												<table border="1" cellpadding="3" cellspacing="3" class="table-striped" style="width:900px;margin-bottom:20px;margin-top:20px;">
													<thead>
														<th colspan="11" style="text-align:center"><b>CLASS TIME-TABLE</th>
														<tr style="background-color:darkblue;color:white;">
															<th style="width:5%;text-align:center"><b>DAY/TIME</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>8:00AM<br>- 8:40AM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>8:40AM<br>- 9:20AM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>9:20AM<br>- 10:00AM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>10:00AM<br>- 10:30AM</th>
															<!--------------------------After Long Break------------------------>
															<th style="width:5%;font-size:12px;text-align:center;"><b>10:30AM<br>- 11:10AM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>11:10AM<br>- 11:50AM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>11:50AM<br>- 12:30PM</th>
															<!--------------------------!After Long Break--------------------->
															<th style="width:5%;font-size:12px;text-align:center;"><b>12:30PM<br>- 12:40PM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>12:40PM<br>- 1:20PM</th>
															<th style="width:5%;font-size:12px;text-align:center;"><b>1:20PM<br>- 2:00PM</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td style="width:5%;text-align:center;background-color:darkblue;color:white;"><b>Monday</td>
															<td class="<?php echo setCurrentSubject('Monday', '1');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '1', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Monday', '2');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '2', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Monday', '3');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '3', $user_id);?></td>
															<!--------------------------------Before Long Break----------------------------------------->
															<td class="<?php echo setBreakTime('20');?> break" rowspan="5"><b>LONG BREAK</b></td>
															<!--------------------------------!After Long Break----------------------------------------->
															<td class="<?php echo setCurrentSubject('Monday', '4');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '4', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Monday', '5');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '5', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Monday', '6');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '6', $user_id);?></td>
															<!--------------------------!Before Short Break--------------------->
															<td rowspan="5" class="<?php echo setBreakTime('30');?> break"><b>SHORT BREAK</b></td>
															<!--------------------------!After Short Break------------------------->
															<td class="<?php echo setCurrentSubject('Monday', '7');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '7', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Monday', '8');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Monday', '8', $user_id);?></td>
														</tr>
														<tr>
															<td class="" style="width:5%;text-align:center;background-color:darkblue;color:white;"><b>Tuesday</td>
															<td class="<?php echo setCurrentSubject('Tuesday', '1');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '1', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Tuesday', '2');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '2', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Tuesday', '3');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '3', $user_id);?></td>
															<!--------------------------After Long Break--------------------------------->
															<td class="<?php echo setCurrentSubject('Tuesday', '4');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '4', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Tuesday', '5');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '5', $user_id);?></td>
															<!--------------------------!After Long Break-------------------------------->
															<td class="<?php echo setCurrentSubject('Tuesday', '6');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '6', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Tuesday', '7');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '7', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Tuesday', '8');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Tuesday', '8', $user_id);?></td>
														</tr>
														<tr>
															<td style="width:5%;text-align:center;background-color:darkblue;color:white;"><b>Wednesday</td>
															<td class="<?php echo setCurrentSubject('Wednesday', '1');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '1', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Wednesday', '2');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '2', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Wednesday', '3');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '3', $user_id);?></td>
															<!--------------------------After Long Break--------------------------------->
															<td class="<?php echo setCurrentSubject('Wednesday', '4');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '4', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Wednesday', '5');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '5', $user_id);?></td>
															<!--------------------------!After Long Break-------------------------------->
															<td class="<?php echo setCurrentSubject('Wednesday', '6');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '6', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Wednesday', '7');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '7', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Wednesday', '8');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Wednesday', '8', $user_id);?></td>
														</tr>
														<tr>
															<td style="width:5%;text-align:center;background-color:darkblue;color:white;"><b>Thursday</td>
															<td class="<?php echo setCurrentSubject('Thursday', '1');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '1', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Thursday', '2');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '2', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Thursday', '3');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '3', $user_id);?></td>
															<!--------------------------After Long Break--------------------------------->
															<td class="<?php echo setCurrentSubject('Thursday', '4');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '4', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Thursday', '5');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '5', $user_id);?></td>
															<!--------------------------!After Long Break-------------------------------->
															<td class="<?php echo setCurrentSubject('Thursday', '6');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '6', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Thursday', '7');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '7', $user_id);?></td>
															<td class="<?php echo setCurrentSubject('Thursday', '8');?>" style="width:5%;font-size:12px;text-align:center;"><b><?php echo getTimeTable($sch_id, 'Thursday', '8', $user_id);?></td>
														</tr>
														<tr>
															<td style="width:5%;text-align:center;background-color:darkblue;color:white;"><b>Friday</td>
															<td class="<?php echo setCurrentSubject('Friday', '1');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<td class="<?php echo setCurrentSubject('Friday', '2');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<td class="<?php echo setCurrentSubject('Friday', '3');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<!--------------------------After Long Break--------------------------------->
															<td class="<?php echo setCurrentSubject('Friday', '4');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<td class="<?php echo setCurrentSubject('Friday', '5');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<!--------------------------!After Long Break-------------------------------->
															<td class="<?php echo setCurrentSubject('Friday', '6');?>"style="width:5%;font-size:12px;text-align:center;"><b></td>
															<td class="<?php echo setCurrentSubject('Friday', '7');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
															<td class="<?php echo setCurrentSubject('Friday', '8');?>" style="width:5%;font-size:12px;text-align:center;"><b></td>
														</tr>
													</tbody>
												</table>
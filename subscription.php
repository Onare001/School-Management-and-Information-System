<?php include ('include/connection.php'); include ('functions/functions.php'); /*include ('include/lock_admin.php');*/ $sch_id='1';$uid='32';$cid='1';$tid='1';$did='1';$sid='1';$subj_sno='0';?>
<style>

</style>
<html>
<?php
	echo '<div class="" style="border:2px solid black;height:1000px;width:700px;margin:0 auto;padding:10px;">
		<div class="" style="text-align:center;">
			<h2>'.strtoupper(getSchName($sch_id)).'</h2>
			<img src="'.getSchlogo($sch_id).'" class="" style="max-width:100px;"/>
			<h3>MOCK RESULT</h3>';
			echo (getClass(1)=='JS 1') ? 'BASIC EDUCATION CERTIFICATE EXAMINATION (BECE)' : 'WEST AFRICA SENIOR SECONDARY CERTIFICATE EXAMINATION (WASSCE)';
			echo '<div class="" style="border:1px solid black;padding:5px;width:100px;margin:0 auto;">JUN/JUL'.date('Y').'</div>
		</div>
		<div class="" style="display:flex;gap:70px;margin-top:15px;">
			<div>'
				.strtoupper(getLastName($uid).' '.getFirstName($uid)).'<br>
				<text class="" style="font-size:11px;">Full Name
			</div>
			<div>'
				.getUserName($uid).'<br>
				<text class="" style="font-size:11px;">Student ID
			</div>
			<div>'
				.getExamNumber($uid, $cid, $sch_id).'<br>
				<text class="" style="font-size:11px;">Exam No
			</div>
		</div>
		<hr style="color:black;">';
		echo '
		<div class="result">
			<img src="'./*getSchlogo($sch_id).*/'" alt="img" class="water_mark"/>
			<table border="1" align="left" cellpadding="1" cellspacing="3" style="width:700px;">
			<thead class="custom">
				<tr align="center">
					<th style="width:5%;text-align:center;"><b>S/N</th>
					<th style="width:50%;"><b>REGISTERED SUBJECT(s) </th>
					<th style="width:10%;"><b>TYPE </th>
					<th style="width:5%;font-size:12px;text-align:center;"><b>TOTAL<br>(100%)</th>
					<th style="width:5%;font-size:12px;text-align:center;"><b>GRADE</th>
					<th style="width:15%;font-size:12px;text-align:center;"><b>REMARK</th>
				</tr>
			</thead>
			<!--------------------POPULATES THE SCORE TABLE---------------------->
			<tbody>'; 
				$result1 = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id = '$uid' AND class_id='$cid' AND cat_id = '$did' AND term_id = '$tid' AND sid = '$sid' AND sch_id = '$sch_id' ORDER BY subj_id ASC");
				while ($row = mysqli_fetch_array($result1)){ 
			echo '<tr>
					<td style="width:5%;text-align:center;">'.++$subj_sno.'</td>
					<td style="text-align:left;">'.getSubject($row['subj_id']).'</td>
					<td style="text-align:center;">'.getSubjectType($row['subj_id']).'</td>
					<td style="text-align:center;font-weight:bold;">'.(($row['total'] < 40) ? '<font style="color:red">'.$row['total'].'</font>' : $row['total']).'</td>
					<td style="text-align:center;">'.getMockgrade($row['total']).'</td>
					<td style="text-align:center;">'.getMockRemark($row['total']).'</td>
				</tr>'; }
	echo '</tbody>
		</table>
		</div>
		<div style="border:1px solid black;width:100px;padding:10px;margin-top:450px;margin-bottom:5px;margin-left:550px;">
			<img src="'.getSchLogo($sch_id).'" style="max-width:100px;margin:0 auto;"/>
		</div>
		<div class="footer"style="border:1px solid black;padding:5px;text-align:center;">
			Copyright &#169 '.date('Y').'. All Right Reserved Powered by Niel Technologies 
		</div>
	<div>';
?>
</html>
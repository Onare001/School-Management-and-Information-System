<?php
	// counting the number of student in class
	$result = mysqli_query($conn,"SELECT score_id, COUNT(DISTINCT user_id) AS num FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND sid='$sid'");
	$row = mysqli_fetch_array($result);
	$allcount = $num_class = $row['num']; $subj_sno = '0';

	// Computing the individual aggregates
	$result567 = mysqli_query($conn,"SELECT total, SUM(total) AS aggregate FROM score_info WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
	$row = mysqli_fetch_array($result567);
	$aggregate = $row['aggregate'];
	
	// Updating the individual aggregate
	$result444 = mysqli_query($conn,"UPDATE score_info SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
	
	// Computing the total subject offered by student
	$result213 = mysqli_query($conn,"SELECT DISTINCT score_id, COUNT(score_id) AS total_subj FROM score_info WHERE user_id='$uid'  AND score_info.sch_id='$sch_id' AND score_info.class_id='$cid' AND cat_id='$did' AND score_info.term_id='$tid' AND score_info.sid='$sid'");
	$row = mysqli_fetch_array($result213);
	$total_subj = $row['total_subj'];
	
	require_once('assets/lib/phpqrcode/qrlib.php');// Include the QR code library
	$data = '('.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).') '.getUsername($uid).', '.getTerm($tid).' '.getSession($sid).' Result. '.'Aggregate: '. $aggregate.', Average: '.round($aggregate / $total_subj, 2);
	ob_start();
	QRcode::png($data, null, QR_ECLEVEL_Q);
	$qr_code = ob_get_contents();
	ob_end_clean();
?>
<!--===============================BODY OF RESULT==================================-->
	<?php
	echo '
	<body>
	<div class="" style="">
		<div class="rcontent" style="text-align:center;">
			<h2>'.strtoupper(getSchName($sch_id)).'</h2>
			<img src="'.getSchlogo($sch_id).'" class="" style="max-width:100px;"/>
			<h3>MOCK EXAMINATION RESULT</h3>';
			echo (getClass(1)=='JS 1') ? 'BASIC EDUCATION CERTIFICATE EXAMINATION (BECE)' : 'WEST AFRICA SENIOR SECONDARY CERTIFICATE EXAMINATION (WASSCE)';
			echo '<div class="" style="font-weight:bold;border:1px solid black;padding:5px;width:150px;margin:0 auto;">'.strtoupper(date("F").' '.date('Y')).'</div>
			<div style="padding:10px;">
			<div class="" style="display:flex;gap:100px;margin-top:15px;">
				<div>'
					.'<b>'.strtoupper(getLastName($uid).' '.getFirstName($uid)).'</b><br>
					<text class="subtext">Full Name</text>
				</div>
				<div>'
					.'<b>'.getUserName($uid).'</b><br>
					<text class="subtext">Student ID</text>
				</div>
				<div>'
					.'<b>'.examNoFormat(getExamNumber($uid, $cid, $sch_id)).'</b><br>
					<text class="subtext">Exam No</text>
				</div>
				<div>'
					.'<b>'.date(" jS F Y", strtotime(getDOB($uid))).'</b><br>
					<text class="subtext">Date of Birth</text>
				</div>
			</div>
			<hr class="thick-hr">
		</div>';
		echo '
		<div class="result fixed-height">
			<img src="'.getSchlogo($sch_id).'" alt="img" class="water_mark"/>
			<table border="1" class="table table-striped" cellpadding="1" cellspacing="1" style="width:1065px;zoom:80%;">
			<thead class="">
				<tr>
					<th style="width:5%;text-align:center;"><b>S/N</b></th>
					<th align="left" style="width:50%;"><b>REGISTERED SUBJECT(s)</b></th>
					<th style="width:10%;text-align:center;"><b>TYPE</b></th>
					<th style="width:5%;font-size:14px;text-align:center;"><b>TOTAL<br>(100%)</b></th>
					<th style="width:5%;font-size:14px;text-align:center;"><b>GRADE</b></th>
					<th style="width:15%;font-size:14px;text-align:center;"><b>REMARK</b></th>
				</tr>
			</thead>
			<!--------------------POPULATES THE SCORE TABLE---------------------->
			<tbody>'; 
				$result1 = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id = '$uid' AND class_id='$cid' AND cat_id = '$did' AND term_id = '$tid' AND sid = '$sid' AND sch_id = '$sch_id' ORDER BY subj_id ASC");
				while ($row = mysqli_fetch_array($result1)){ 
			echo '<tr>
					<td style="width:5%;text-align:center;">'.++$subj_sno.'</td>
					<td style="text-align:left;">'.getSubject($row['subj_id']).'</td>
					<td align="center">'.getSubjectType($row['subj_id']).'</td>
					<td style="text-align:center;font-weight:bold;">'.(($row['total'] < 40) ? '<font style="color:red">'.$row['total'].'</font>' : $row['total']).'</td>
					<td style="text-align:center;">'.getMockgrade($row['total']).'</td>
					<td style="text-align:center;">'.getMockRemark($row['total']).'</td>
				</tr>'; }
	echo '</tbody>
		</table>
		</div>
		<table border="1" cellpadding="3" cellspacing="3" class="" style="border:1px solid black;width:870px;">
			<tr>
				<td>
					<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
					  <tr class="custom">
						<td class="pad" align="center" colspan="9" >INTERPRETATION OF GRADES ('; echo (getClass(3)=='JS 3') ? 'BECE' : 'WASSCE'; echo ' STANDARD )</td>
					  </tr>
					  <tr>
						<td align="center">&nbsp;75 - 100%&nbsp;</td> 
						<td>&nbsp;<b>(A1)</b>&nbsp;</td> 
						<td>&nbsp;Excellent&nbsp;</td>

						<td align="center">&nbsp;70 - 74%&nbsp;</td>
						<td>&nbsp;<b>(B2)</b>&nbsp;</td> 
						<td>&nbsp;Very Good&nbsp;</td>

						<td align="center">&nbsp;65 - 69%&nbsp;</td>
						<td>&nbsp;<b>(B3)</b>&nbsp;</td>
						<td>&nbsp;Good&nbsp;</td>
					  </tr>
					  <tr>
						<td align="center">&nbsp;60 - 64%&nbsp;</td>
						<td>&nbsp;<b>(C4)</b>&nbsp;</td>
						<td>&nbsp;Credit&nbsp;</td>

						<td align="center">55 - 59%</td>
						<td>&nbsp;<b>(C5)</b>&nbsp;</td>
						<td>&nbsp;Credit&nbsp;</td>

						<td align="center">50 - 54%</td>
						<td>&nbsp;<b>(C6)</b>&nbsp;</td>
						<td>&nbsp;Credit&nbsp;</td>
					  </tr>
					  <tr>
						<td align="center">&nbsp;45 - 49%&nbsp;</td>
						<td>&nbsp;<b>(D7)</b>&nbsp;</td>
						<td>&nbsp;Pass&nbsp;</td>

						<td align="center">40 - 44%</td>
						<td>&nbsp;<b>(E8)</b>&nbsp;</td>
						<td>&nbsp;Pass&nbsp;</td>

						<td align="center">0 - 39%</td>
						<td>&nbsp;<b>(F9)</b>&nbsp;</td>
						<td>&nbsp;Fail&nbsp;</td>
					  </tr>
					</table>
					<table border="1" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
						<tr>
							<td class="pad" align="center" colspan="3">SUMMARY</td>
						</tr>
						<tr>
							<td><b>&nbsp;Total Subject Registered: </b>'.$total_subj.'</td>
							<td><b>&nbsp;Number of Pass:</b> <?php //echo getStuPass($sch_id, $uid, $cid, $did, $sid);?></td>
							<td><b>&nbsp;Number of Fail:</b> <?php //echo  getStuFail($sch_id, $uid, $cid, $did, $sid);?></td>
						<tr>
					</table>
				</td>
				<td style="width:100px;height:120px;"><img src="'.'data:image/png;base64,' . base64_encode($qr_code).'" style="max-width:100px;max-height:100px;"/>'.
					  '<center style="font-size:10px;">'. getSchAcronym($sch_id). '/' . $uid . '/' .$tid.'-22'.'/'. processNo(++$counter).'</center></td>
			</tr>
		</table><p>
		<div class="footer" style="border:1px solid black;padding:5px;text-align:center;">
			Copyright &#169 '.date('Y').'. All Right Reserved Powered by Niel Technologies 
		</div>
		</div>
		
	<div>
</body><p/>';
?>
	<!--br><br><br><br><br><br><br><br><br><br-->
<!--===============================!BODY OF RESULT==================================-->
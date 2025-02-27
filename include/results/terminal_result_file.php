<?php
	// Process student behaviour
	include ("behaviour.php");

	// counting the number of student in class
	$result = mysqli_query($conn,"SELECT score_id, COUNT(DISTINCT user_id) AS num FROM score_info WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND sid='$sid'");
	$row = mysqli_fetch_array($result);
	$allcount = $num_class = $row['num']; $subj_sno = 0;

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
	
	$score_record = mysqli_query($conn,"SELECT * FROM score_info WHERE user_id = '$uid' AND class_id='$cid' AND cat_id = '$did' AND term_id = '$tid' AND sid = '$sid' AND sch_id = '$sch_id' ORDER BY subj_id ASC");
	
	// Getting the comment
	$result498 = mysqli_query($conn,"SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND session_id='$sid'");
	if ($result498){
		$row = mysqli_fetch_array($result498);
		$com = $row['com_id'];    
	} else {
		echo mysqli_error($conn);
	}

	//Show Position on Result
	$result = mysqli_query($conn,"SELECT show_pstn FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$postn = $row['show_pstn'];
	if($postn == 1){
		$position = ' '.Ordinal(getStudentPos($aggregate, $sch_id, $cid, $did, $tid, $sid)).' ';
	} else {
		$position = '***';
	}
	
	require_once('assets/lib/phpqrcode/qrlib.php');// Include the QR code library
	$data = '('.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).') '.getUsername($uid).', '.getTerm($tid).' '.getSession($sid).' Result. '.'Aggregate: '. $aggregate.', Average: '.round($aggregate / $total_subj, 2).', Position:'.$position;
	ob_start();
	QRcode::png($data, null, QR_ECLEVEL_Q);
	$qr_code = ob_get_contents();
	ob_end_clean();

if (getResultStyle($sch_id) == '1'){//getClass(1) == 'JS 1' || getClass(1) == 'SS 1'
/*<!--===============================BODY OF RESULT==================================-->*/
echo'
<body>
	<div class="region">
		<span class="left-note">Note: any alteration renders this result invalid</span>
		<div class="rcontent">
			<!--++++++++++++++++++++++++SCHOOL INFORMATION++++++++++++++++++++-->
			<table border="1" cellpadding="3" cellspacing="3" class="sch_info">
				<tr align="center">
					<td>
						<img src="'.getPassport($uid).'" alt="Passport" style="max-width:100px;max-height:120px;"/>
						<div class="passport" style="width:100px;"><b>'.getSchAcronym($sch_id).'&nbsp;'.date("Y").'</b></div>
					</td>
					<td>
					<img src="'.getSchlogo($sch_id).'" alt="School Logo" style="max-width:100px;max-height:100px;"/></td>
					<td style="margin-right:0px;" class="custom">
						<table border="0" cellpadding="3" cellspacing="3" style="width:600px;height:50px;">
							<tr align="center">
								<td>'.'<h3 style="margin-top:0px;">'.strtoupper(getSchname($sch_id)).' - TERMINAL RESULT'.'</h3>'.'<p style="margin-top:0px;margin-bottom:0px;">'.getSchAddress($sch_id).'</p>'.'<p style="margin-top:0px;"><i>'.'Motto:'.'&nbsp;'.getSchmotto($sch_id).'</i>'.'<br>'.'Phone No.:&nbsp;'.getSchphone($sch_id).'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!--+++++++++++++++++++++STUDENT INFORMATION++++++++++++++++++++++-->
			<fieldset class="student_info">
				<legend class="field_title"><i class="fa fa-user-graduate"></i> Student\' Result Information</legend>
				<table border="1" cellpadding="3" cellspacing="3" style="width:985px;">
					<!------------------------Row 1------------------------------>
					<tr>
						<td><b>&nbsp;'. strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid)).'</b></td>
						<td><b>&nbsp;ADM. NO:</b>&nbsp;'. getAdmissionNo($uid).'</td>
						<td><b>&nbsp;CLASS:</b>&nbsp;'. getClass($cid).'&nbsp;'.getCategory($did).'</td>
						<td><b>&nbsp;AGE:</b>&nbsp;'. getAge($uid).'</td>
					</tr>
					<!------------------------Row 2--------------------------------->
					<tr>
						<td><b>&nbsp;STUDENT ID.&nbsp;:&nbsp;</b>'. getUsername($uid).'</td>
						<td><b>&nbsp;NO. IN CLASS:</b>&nbsp;'. $num_class.'</td>
						<td><b>&nbsp;TERM:</b>&nbsp;'. strtoupper(getTerm($tid)).'</td>
						<td><b>&nbsp;SESSION:</b>&nbsp;'. getSession($ses_id).'</td>
					</tr>
				</table>
			</fieldset>
			<!--++++++++++++++++++++++++SCORES BY SUBJECTS++++++++++++++++++++++++-->
			<div class="result fixed-height-div">
				<img src="'. getSchlogo($sch_id).'" alt="img" class="water_mark"/>
				<table border="2" cellpadding="3" cellspacing="3" class="score_info">
					<thead class="custom">
						<tr>
							<th style="width:5%;text-align:center;"><b>S/N</th>
							<th style="width:25%;"><b>SUBJECT(s) OFFERED</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>1ST.CA<br>(10%)</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>2ND.CA<br>(10%)</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>3RD.CA<br>(10%)</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>EXAM<br>(70%)</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>TOTAL<br>(100%)</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>AVG</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>HGST</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>LWST</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>POSTN</th>
							<th style="width:5%;font-size:12px;text-align:center;"><b>GRADE</th>
							<th style="width:10%;font-size:12px;text-align:center;"><b>REMARK</th>
						</tr>
					</thead>
					<tbody>';
					/*<!--------------------POPULATES THE SCORE TABLE---------------------->*/
				if ($score_record){
					while ($row = mysqli_fetch_array($score_record)){ 	
					echo '
						<tr>
							<td style="width:5%;text-align:center;">'.++$subj_sno.'</td>
							<td style="text-align:left;">'.getSubject($row['subj_id']).'</td>
							<td style="text-align:center;">'.$row['first_ca'].'</td>
							<td style="text-align:center;">'.$row['second_ca'].'</td>
							<td style="text-align:center;">'.$row['third_ca'].'</td>
							<td style="text-align:center;">'.$row['exam'].'</td>
							<td style="text-align:center;font-weight:bold;">'.(($row['total'] < 40) ? '<font style="color:red">'.$row['total'].'</font>' : $row['total']).'</td>
							<td style="text-align:center;">'.round(getAVG($sch_id, $cid, $did, $row['subj_id'], $tid, $sid),1).'</td>
							<td style="text-align:center;">'.getHGST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
							<td style="text-align:center;">'.getLWST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
							<td style="text-align:center;">'.Ordinal(getSubjPos($row['total'], $sch_id, $cid, $did, $row['subj_id'], $tid, $sid)).'</td>
							<td style="text-align:center;">'.getGrade($row['total']).'</td>
							<td style="text-align:center;">'.getRemark($row['total']).'</td>
						</tr>'; 
					}
				} else {
					echo '';
				}	
			echo'</tbody>
				</table>
			</div>
			<!--+++++++++++++++++++++++++AGGREGATE++++++++++++++++++++++++++++-->
			<div class="acc">
				<table border="1" cellpadding="1" cellspacing="3" class="report">
					<tr class="custom">
						<td><b>&nbsp;&nbsp;NO. OF TIMES SCH. OPEN: '.getNoofDaysSchOpen($sch_id, $tid, $sid).'&nbsp;</td>
						<td><b>&nbsp;&nbsp;NO. OF TIMES PRESENT: '.getAttendence($uid, $sch_id, $cid, $did, $tid, $sid)./*CountPresent($sch_id, $uid, $cid, $did, $tid, $sid).*/'</td>
						<td><b>&nbsp;&nbsp;AGGREGATE SCORE:&nbsp;'.aggregate($aggregate).'&nbsp;</td>
						<td><b>&nbsp;&nbsp;AVERAGE:&nbsp;'. round($aggregate / $total_subj, 2).'&nbsp;</td>
						<td><b>&nbsp;&nbsp;POSITION:&nbsp;'. $position.'&nbsp;</td>
					</tr>
					<!--tr align="center">
						<td><b>&nbsp;&nbsp;</b>&nbsp;'.'000'.'&nbsp;</td>
						<td><b>&nbsp;&nbsp;</b>&nbsp;'.'000'.'&nbsp;</td>
						<td><b>&nbsp;&nbsp;</b>&nbsp;'.aggregate($aggregate).'&nbsp;</td>
						<td><b>&nbsp;&nbsp;</b>&nbsp;'. round($aggregate / $total_subj, 2).'&nbsp;</td>
						<td><b>&nbsp;&nbsp</b>&nbsp;'. $position.'&nbsp;</td>
					</tr-->
				 </table>
				<!--++++++++++++++++++++++++++++COMMENTS+++++++++++++++++++++++++++-->
				<div class="comments">
					<div class="xcom">
						<div class="custom">&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<b>Form Teacher\'s Comment</b></div>
						<div class="scom">
							<div class="comholder">&nbsp;&nbsp;'. getCom($com).'</div>
							<div class="nholder">&nbsp;&nbsp;<b>Name:</b> '. getFormTeacher($sch_id, $cid, $did).'</div>
						</div>
					</div>
					<div class="ycom">
						<div class="custom">&nbsp;&nbsp;<i class="fa fa-pen"></i>&nbsp;<b>Principal\'s Remark</b></div>
						<div class="cholder">&nbsp;&nbsp;'. getComment($sch_id, $aggregate, $total_subj).'</div>
					</div>
				</div>
				<!--+++++++++++++++++++++++NEXT TERM INFO+++++++++++++++++++++++-->
				<table border="1" cellpadding="1" cellspacing="5" class="account" style="border:1px solid black;">
					<tr>
						<td style="max-width:45%;">&nbsp;<b><i class="fa fa-calendar"></i>&nbsp;Next Term Begins:</b>&nbsp;'. date("D, jS F Y", strtotime(getResumptionDate($sch_id, $tid, $sid))).'</td> 
						<td style="max-width:40%;">&nbsp;<i class="fa fa-credit-card"><b></i>&nbsp;Next Term School Fee:</b>&nbsp;'. '&#8358;'.getSchfee($sch_id).'</td>
						<td style="max-width:50%;">&nbsp;<i class="fa fa-info-circle"><b></i>&nbsp;Term Payment Status:</b>&nbsp;'. getPaymentStatusValue(getPaymentstatus($uid, $tid, $sid)).'</td> 
					</tr>
				</table>
			</div>
			<!--+++++++++++++++++++++FOOTER/SIGNATURE++++++++++++++++++++++++++++-->
			<table border="1" cellpadding="3" cellspacing="3" class="performance">
				<tr>
				<td style="width:80px;height:120px;">
					<img src="assets/img/ntt.png" style="max-width:80px;max-height:80px;"/>
					<!--center style="font-size:10px;">Copyright © 2023</center-->
				</td>
					<td>		
						<!-------------------Behaviour------------------------->
						<table border="5" style="width:100%; min-width:500px; border-collapse:collapse; font-size:14px; border:1px solid #ccc;">
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Affective Domain<br>(Values, Attitude, Interests, Characters)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Behaviours</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Punctuality</td>
										'. $a.'
									</tr>
									<tr>
										<td>&nbsp;Attendance</td>
										'. $b.'
									</tr>
									<tr>
										<td>&nbsp;Assignment</td> 
										'. $c.'
									</tr>
									<tr>
										<td>&nbsp;Neatness</td>
										'. $d.'
									</tr>
									<tr>
										<td>&nbsp;Politeness</td>
										'. $e.'
									</tr>
								</table>
							</td>
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Affective Domain contd.<br/>(Values, Attitude, Interests, Characters)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Behaviour</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Honesty</td>
										'. $f.'
									</tr>
									<tr>
										<td>&nbsp;Self Control</td> 
										'. $g.'
									</tr>
									<tr>
										<td>&nbsp;Responsibility</td>
										'. $h.'
									</tr>
									<tr>
										<td>&nbsp;Participation</td>
										'. $i.'
									</tr>
									<tr>	
										<td>&nbsp;Phy. Health</td> 
										'. $j.'
									</tr>
								</table>
							</td>
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Psychomotor Domain<br>(Manual and Physical Skills)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Activities</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Games</td>
										'. $i.'
									</tr>
									<tr>
										<td>&nbsp;Sport</td> 
										'. $g.'
									</tr>
									<tr>
										<td>&nbsp;Handwritting</td>
										'. $e.'
									</tr>
									<tr>
										<td>&nbsp;Communication</td>
										'. $c.'
									</tr>
									<tr>
										<td>&nbsp;Crafts</td> 
										'. $a.'
									</tr>
								</table>	
							</td>
						</table>
					</td>
					<!-----------------------Signature-------------------------->
					<td style="width:200px;height:100px;text-align:center;">
						<b style="font-size:13px;">Principal\'s Signature/Stamp</b>
						<div class="signature-container">
							<img src="'. getPSignature($sch_id).'" alt="Signature" class="signature" style="width:200px;max-height:200px;"/><br/>
							<div class="date-overlay">
								<p><b>'. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d".'/'."m".'/'."Y").'</b></p>
							</div>
							<i style="color:black;width:500px;font-size:12px;font-weight:bold">'. getHeadTeacher($sch_id).'</i>							
						</div>
					</td>
					<td style="width:100px;height:120px;">
						<img src="'.'data:image/png;base64,' . base64_encode($qr_code).'" style="max-width:100px;max-height:100px;"/>'.
					  '<center style="font-size:10px;">'. getSchAcronym($sch_id). '/' . $uid . '/' .$tid.'-22'.'/'. processNo(++$counter).'</center>
					</td>
				</tr>
			</table>
			<!--+++++++++++++++++++++++++GRADINGS++++++++++++++++++++++++++++++-->
			<table border="1" cellpadding="3" cellspacing="3" class="grading" style="margin-bottom:2px;">
				<tr>
					<td align="center">
						<div class="custom" style="font-size:14px;font-style:italic;">INTERPRETATION OF GRADES</div>
						<table border="1" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
							<tr>
								<td align="center">&nbsp;70 - 100%&nbsp;</td> 
								<td>&nbsp;<b>(A)</b>&nbsp;</td> 
								<td>&nbsp;Excellent&nbsp;</td>
								<td align="center">&nbsp;60 - 69%&nbsp;</td>
								<td>&nbsp;<b>(B)</b>&nbsp;</td> 
								<td>&nbsp;V-good&nbsp;</td>
								<td align="center">&nbsp;50 - 59%&nbsp;</td>
								<td>&nbsp;<b>(C)</b>&nbsp;</td>
								<td>&nbsp;Credit&nbsp;</td>
							</tr>
							<tr>
								<td align="center">&nbsp;45 - 49%&nbsp;</td>
								<td>&nbsp;<b>(D)</b>&nbsp;</td>
								<td>&nbsp;Fair&nbsp;</td>
								<td align="center">40 - 44%</td>
								<td>&nbsp;<b>(E)</b>&nbsp;</td>
								<td>&nbsp;Pass&nbsp;</td>
								<td align="center">0 - 39%</td>
								<td>&nbsp;<b>(F)</b>&nbsp;</td>
								<td>&nbsp;Fail&nbsp;</td>
							</tr>
						</table>
					</td>
					<td align="center">
						<div class="custom" style="font-size:14px;font-style:italic;">Key to Ratings (Affective & Psychomotor Domains)</div>
						<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
							<tr>
								<td align="center"><b>5</b></td> <td> Excellent</td>
								<td align="center"><b>4</b></td> <td> V-good</td>
								<td align="center"><b>3</b></td> <td> Good</td>
							</tr>
							<tr>
								<td align="center"><b>2</b></td> <td> Fair</td>
								<td align="center"><b>1</b></td> <td> Poor</td>
								<td align="center"><b>0</b></td> <td> V-poor</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!--+++++++++++++++++++++++!COPYRIGHT FOOTER++++++++++++++++++++-->
			<!--table border="0" cellpadding="5" cellspacing="0" class="footer">
				<tr>
					<td align="center"-->
						<div class="footer" style="font-size:12px;">Copyright © 2022 SMS. Powered by Niel Technologies <i class="fa fa-wifi"></i> <b>+2348145162722.</b> All Rights Reserved.</div>
					<!--/td>
				</tr>
			</table-->	
		</div>
		<span class="right-note">output best with color printer</span>
	</div>
	<!--===============================BODY OF RESULT==================================-->
</body><p/>';
} else if (getResultStyle($sch_id) == '2') {
	echo '
	<body>
		<div class="region">
		<span class="left-note">Note: any alteration renders this result invalid</span>
		<div class="rcontent">
			<div class="result_head">
				<div class="logo">
					<img src="'.getSchlogo($sch_id).'" style="width:100px;height:100px;">
				</div>
				<div style="width:800px;padding-left:50px;">
					<h5>'.strtoupper(getSchname($sch_id)).' - TERMINAL RESULT'.'</h5>
					Motto: '.getSchmotto($sch_id).'<br>
					Address: '.getSchAddress($sch_id).'<br>
				</div>
			</div>
			<div class="student_info2">
				<div class="info1">
					<div class="cell">
						<b>Name: </b>&nbsp;'. strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid)).'<br>
					</div>
					<div class="cell">
						<b>Student ID:</b> '. getUsername($uid).'<br>
					</div>
					<div class="cell">
						<b>Admission No.:</b>'. getAdmissionNo($uid).'<br>
					</div>
					<div class="cell">
						<b>Gender:</b> '. getGender(getStudentGender($uid)).'<br>
					</div>
					<div class="cell lastcell">
						<b>Age:</b>&nbsp;'. getAge($uid).'<br>
					</div>
				</div>
				<div class="info1">
					<div class="cell2">
						<b>Class:</b>'. getClass($cid).'&nbsp;'.getCategory($did).'<br>
					</div>
					<div class="cell2">
						<b>No of Student in Class:</b>&nbsp;'.$num_class.'<br>
					</div>
					<div class="cell2">
						<b>Aggregate:</b>&nbsp;'.aggregate($aggregate).'/'.($total_subj * 100).'&nbsp;<br>
					</div>
					<div class="cell2">
						<b>Average Score:</b> &nbsp;'. round($aggregate / $total_subj, 2).'<br>
					</div>
					<div class="cell2 lastcell">
						<b>Position:</b>&nbsp;'. $position.' <br>
					</div>
				</div>
				<div class="info1">
					<div class="cell3">
						<b>Term:</b>'.getTerm($tid).'<br>
					</div>
					<div class="cell3">
						<b>Session:</b>&nbsp;'. getSession($ses_id).'<br>
					</div>
					<div class="cell3">
						<b>Year:</b> '.date('Y').'<br>
					</div>
					<div class="cell3">
						<b>No. of Time(s) Sch Opened: </b>'.getNoofDaysSchOpen($sch_id, $tid, $sid).'&nbsp;<br>
					</div>
					<div class="cell3 lastcell">
						<b>No. of Time(s) Present:</b>'.getAttendence($uid, $sch_id, $cid, $did, $tid, $sid).'<br>
					</div>
				</div>
				<div class="student_passport">
					<img src="'.getPassport($uid).'" style="width:100px;height:120px;">
					<div class="passport" style="text-align:center;width:100px;">
						<b>'.getSchAcronym($sch_id).'&nbsp;'.date("Y").'</b>
					</div>
				</div>
			</div>
			<div class="score_record">
				<div style="background-color:red;color:white;width:1022px;text-align:center;">TERMINAL REPORT</div>
				<div class="fixed-height-div">
					<img src="'.getSchLogo($sch_id).'" alt="img" class="water_mark"/>
					<table border="2" cellpadding="3" cellspacing="3" class="score_info score_size">
						<thead class="custom">
							<tr>
								<th style="width:5%;text-align:center;"><b>S/N</th>
								<th style="width:25%;"><b>SUBJECT(s) OFFERED</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>1ST.CA<br>(10%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>2ND.CA<br>(10%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>3RD.CA<br>(10%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>EXAM<br>(70%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>TOTAL<br>(100%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>AVG</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>HGST</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>LWST</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>POSTN</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>GRADE</th>
								<th style="width:10%;font-size:12px;text-align:center;"><b>REMARK</th>
							</tr>
						</thead>
						<tbody>';
						/*<!--------------------POPULATES THE SCORE TABLE---------------------->*/
					if ($score_record){
						while ($row = mysqli_fetch_array($score_record)){ 	
						echo '
							<tr>
								<td style="width:5%;text-align:center;">'.++$subj_sno.'</td>
								<td style="text-align:left;">'.getSubject($row['subj_id']).'</td>
								<td style="text-align:center;">'.$row['first_ca'].'</td>
								<td style="text-align:center;">'.$row['second_ca'].'</td>
								<td style="text-align:center;">'.$row['third_ca'].'</td>
								<td style="text-align:center;">'.$row['exam'].'</td>
								<td style="text-align:center;font-weight:bold;">'.(($row['total'] < 40) ? '<font style="color:red">'.$row['total'].'</font>' : $row['total']).'</td>
								<td style="text-align:center;">'.round(getAVG($sch_id, $cid, $did, $row['subj_id'], $tid, $sid),1).'</td>
								<td style="text-align:center;">'.getHGST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
								<td style="text-align:center;">'.getLWST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
								<td style="text-align:center;">'.Ordinal(getSubjPos($row['total'], $sch_id, $cid, $did, $row['subj_id'], $tid, $sid)).'</td>
								<td style="text-align:center;">'.getGrade($row['total']).'</td>
								<td style="text-align:center;">'.getRemark($row['total']).'</td>
							</tr>'; 
						}
					} else {
						echo '';
					}	
				echo'</tbody>
				</table>
			</div>
			<!--++++++++++++++++++++++++++++COMMENTS+++++++++++++++++++++++++++-->
			<div class="acc">
				<div class="comments">
					<div class="xcom">
						<div class="custom">&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<b>Form Teacher\'s Comment</b></div>
						<div class="scom">
							<div class="comholder">&nbsp;&nbsp;'. getCom($com).'</div>
							<div class="nholder">&nbsp;&nbsp;<b>Name:</b> '. getFormTeacher($sch_id, $cid, $did).'</div>
						</div>
					</div>
					<div class="ycom">
						<div class="custom">&nbsp;&nbsp;<i class="fa fa-pen"></i>&nbsp;<b>Principal\'s Remark</b></div>
						<div class="cholder">&nbsp;&nbsp;'. getComment($sch_id, $aggregate, $total_subj).'</div>
					</div>
				</div>
				<!--+++++++++++++++++++++++NEXT TERM INFO+++++++++++++++++++++++-->
				<table border="1" cellpadding="1" cellspacing="5" class="account" style="border:1px solid black;">
					<tr>
						<td style="max-width:45%;">&nbsp;<b><i class="fa fa-calendar"></i>&nbsp;Next Term Begins:</b>&nbsp;'. date("D, jS F Y", strtotime(getResumptionDate($sch_id, $tid, $sid))).'</td> 
						<td style="max-width:40%;">&nbsp;<i class="fa fa-credit-card"><b></i>&nbsp;Next Term School Fee:</b>&nbsp;'. '&#8358;'.getSchfee($sch_id).'</td>
						<td style="max-width:50%;">&nbsp;<i class="fa fa-info-circle"><b></i>&nbsp;Term Payment Status:</b>&nbsp;'. getPaymentStatusValue(getPaymentstatus($uid, $tid, $sid)).'</td> 
					</tr>
				</table>
			</div>
			<!--+++++++++++++++++++++FOOTER/SIGNATURE++++++++++++++++++++++++++++-->
			<table border="1" cellpadding="3" cellspacing="3" class="performance">
				<tr>
					<td><span class="left-note">'.getUsername($uid).'</span></td>
					<td>		
						<!-------------------Behaviour------------------------->
						<table border="5" style="width:100%; min-width:500px; border-collapse:collapse; font-size:14px; border:1px solid #ccc;">
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Affective Domain<br>(Values, Attitude, Interests, Characters)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Behaviours</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Punctuality</td>
										'.$a.'
									</tr>
									<tr>
										<td>&nbsp;Attendance</td>
										'.$b.'
									</tr>
									<tr>
										<td>&nbsp;Assignment</td> 
										'.$c.'
									</tr>
									<tr>
										<td>&nbsp;Neatness</td>
										'.$d.'
									</tr>
									<tr>
										<td>&nbsp;Politeness</td>
										'.$e.'
									</tr>
								</table>
							</td>
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Affective Domain contd.<br/>(Values, Attitude, Interests, Characters)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Behaviour</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Honesty</td>
										'. $f.'
									</tr>
									<tr>
										<td>&nbsp;Self Control</td> 
										'. $g.'
									</tr>
									<tr>
										<td>&nbsp;Responsibility</td>
										'. $h.'
									</tr>
									<tr>
										<td>&nbsp;Participation</td>
										'. $i.'
									</tr>
									<tr>	
										<td>&nbsp;Phy. Health</td> 
										'. $j.'
									</tr>
								</table>
							</td>
							<td class="pad" align="center" colspan="3">
								<b style="font-size:13px;">Psychomotor Domain<br>(Manual and Physical Skills)</b>
								<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
									<tr>
										<td >&nbsp;Activities</td>
										<td width="2px" align="center">1</td>
										<td width="2px" align="center">2</td>
										<td width="2px" align="center">3</td>
										<td width="2px" align="center">4</td>
										<td width="2px" align="center">5</td>
									</tr>
									<tr>
										<td>&nbsp;Games</td>
										'. $i.'
									</tr>
									<tr>
										<td>&nbsp;Sport</td> 
										'. $g.'
									</tr>
									<tr>
										<td>&nbsp;Handwritting</td>
										'. $e.'
									</tr>
									<tr>
										<td>&nbsp;Communication</td>
										'. $c.'
									</tr>
									<tr>
										<td>&nbsp;Crafts</td> 
										'. $a.'
									</tr>
								</table>	
							</td>
						</table>
					</td>
					<!-----------------------Signature-------------------------->
					<td style="width:200px;height:100px;text-align:center;">
						<b style="font-size:13px;">Principal\'s Signature/Stamp</b>
						<div class="signature-container">
							<img src="'.getPSignature($sch_id).'" alt="Signature" class="signature" style="width:200px;max-height:200px;"/><br/>
							<div class="date-overlay">
								<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d".'/'."m".'/'."Y").'</b></p>

							</div>	
							<i style="color:black;width:500px;font-size:12px;font-weight:bold">'.getHeadTeacher($sch_id).'</i>
						</div>
					</td>
					<td style="width:100px;height:120px;">
						<img src="'.'data:image/png;base64,' . base64_encode($qr_code).'" style="max-width:150px;max-height:150px;"/>'.
					  '<center style="font-size:10px;">'. getSchAcronym($sch_id). '/' . $uid . '/' .$tid.'-22'.'/'. processNo(++$counter).'</center>
					</td>
					<!--td style="width:80px;height:120px;">
						<img src="assets/ntt.png" style="max-width:80px;max-height:80px;"/>
						<center style="font-size:10px;">Copyright © 2022</center>
					</td-->
				</tr>
			</table>
			<!--+++++++++++++++++++++++++GRADINGS++++++++++++++++++++++++++++++-->
			<table border="1" cellpadding="3" cellspacing="3" class="grading" style="margin-bottom:2px;">
				<tr>
					<td align="center">
						<div class="custom"><i style="font-size:14px;">INTERPRETATION OF GRADES</i></div>
						<table border="1" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
							<tr>
								<td align="center">&nbsp;70 - 100%&nbsp;</td> 
								<td>&nbsp;<b>(A)</b>&nbsp;</td> 
								<td>&nbsp;Excellent&nbsp;</td>
								<td align="center">&nbsp;60 - 69%&nbsp;</td>
								<td>&nbsp;<b>(B)</b>&nbsp;</td> 
								<td>&nbsp;V-good&nbsp;</td>
								<td align="center">&nbsp;50 - 59%&nbsp;</td>
								<td>&nbsp;<b>(C)</b>&nbsp;</td>
								<td>&nbsp;Credit&nbsp;</td>
							</tr>
							<tr>
								<td align="center">&nbsp;45 - 49%&nbsp;</td>
								<td>&nbsp;<b>(D)</b>&nbsp;</td>
								<td>&nbsp;Fair&nbsp;</td>
								<td align="center">40 - 44%</td>
								<td>&nbsp;<b>(E)</b>&nbsp;</td>
								<td>&nbsp;Pass&nbsp;</td>
								<td align="center">0 - 39%</td>
								<td>&nbsp;<b>(F)</b>&nbsp;</td>
								<td>&nbsp;Fail&nbsp;</td>
							</tr>
						</table>
					</td>
					<td align="center">
						<div class="custom"><i style="font-size:14px;">Key to Ratings (Affective & Psychomotor Domains)</i></div>
						<table border="0" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
							<tr>
								<td align="center"><b>5</b></td> <td> Excellent</td>
								<td align="center"><b>4</b></td> <td> V-good</td>
								<td align="center"><b>3</b></td> <td> Good</td>
							</tr>
							<tr>
								<td align="center"><b>2</b></td> <td> Fair</td>
								<td align="center"><b>1</b></td> <td> Poor</td>
								<td align="center"><b>0</b></td> <td> V-poor</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!--+++++++++++++++++++++++!COPYRIGHT FOOTER++++++++++++++++++++-->
			<div style="text-align:center;border:1px solid black;padding:5px;font-size:14px;">Copyright © 2023 SMS. Powered by Niel Technologies <i class="fa fa-wifi"></i> <b>+2348145162722.</b> All Rights Reserved.</div>
			</div>
		</div>
		<span class="right-note">output best with color printer</span>
	</div>
	</body><p>';
} else {
	echo '
	<body>
		<div class="region">
			<span class="left-note">Note: any alteration renders this result invalid</span>
			<div class="rconten">
				<div class="score_record">
					<div class="result_head">
						<div class="logo">
							<img src="'.getSchlogo($sch_id).'" style="width:70px;height:70px;">
						</div>
						<div style="width:800px;padding-left:50px;">
							<h5>'.strtoupper(getSchname($sch_id)).' - TERMINAL RESULT'.'</h5>
							Motto: '.getSchmotto($sch_id).'<br>
							Address: '.getSchAddress($sch_id).'<br>
						</div>
					</div>
					<div class="student_info">
						<div class="info1">
							<div class="cell">
								<b>Name: </b>&nbsp;'. strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid)).'<br>
							</div>
							<div class="cell">
								<b>Student ID:</b> '. getUsername($uid).'<br>
							</div>
							<div class="cell">
								<b>Admission No.:</b>'. getAdmissionNo($uid).'<br>
							</div>
							<div class="cell">
								<b>Gender:</b> '.getGender(getStudentGender($uid)).'<br>
							</div>
							<div class="cell lastcell">
								<b>Age:</b>&nbsp;'. getAge($uid).'<br>
							</div>
						</div>
						<div class="info1">
							<div class="cell2">
								<b>Class:</b>'. getClass($cid).'&nbsp;'.getCategory($did).'<br>
							</div>
							<div class="cell2">
								<b>No of Student in Class:</b>&nbsp;'.$num_class.'<br>
							</div>
							<div class="cell2">
								<b>Aggregate:</b>&nbsp;'.aggregate($aggregate).'/'.($total_subj * 100).'&nbsp;<br>
							</div>
							<div class="cell2">
								<b>Average Score:</b> &nbsp;'. round($aggregate / $total_subj, 2).'<br>
							</div>
							<div class="cell2 lastcell">
								<b>Position:</b>&nbsp;'. $position.' <br>
							</div>
						</div>
						<div class="info1">
							<div class="cell3">
								<b>Term:</b>'.getTerm($tid).'<br>
							</div>
							<div class="cell3">
								<b>Session:</b>&nbsp;'. getSession($ses_id).'<br>
							</div>
							<div class="cell3">
								<b>Year:</b> '.date('Y').'<br>
							</div>
							<div class="cell3">
								<b>No. of Time(s) Sch Opened: </b>'.getNoofDaysSchOpen($sch_id, $tid, $sid).'&nbsp;<br>
							</div>
							<div class="cell3 lastcell">
								<b>No. of Time(s) Present:</b>'.getAttendence($uid, $sch_id, $cid, $did, $tid, $sid).'<br>
							</div>
						</div>
						<div class="student_passport">
							<img src="'.getPassport($uid).'" style="width:100px;height:120px;">
							<div class="passport" style="text-align:center;width:100px;">
								<b>'.getSchAcronym($sch_id).'&nbsp;'.date("Y").'</b>
							</div>
						</div>
					</div>
					<div class="" style="border:1px solid black;margin-bottom:5px;">
					<table border="0" cellpadding="3" cellspacing="3" class="rep">
						<tr>
							<td>
								<div class="fixed-height-div">
									<div style="background-color:red;color:white;width:100%;text-align:center;">TERMINAL REPORT</div>
									<img src="'.getSchLogo($sch_id).'" alt="img" class="water_mark"/>
									<table border="1" cellpadding="3" cellspacing="3" style="width:100%;" class="score_info">
										<thead class="custom">
											<tr>
												<th style="width:5%;text-align:center;"><b>S/N</th>
												<th style="width:25%;"><b>SUBJECT(s) OFFERED</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>1ST.CA<br>(10%)</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>2ND.CA<br>(10%)</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>3RD.CA<br>(10%)</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>EXAM<br>(70%)</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>TOTAL<br>(100%)</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>AVG</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>HGST</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>LWST</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>POSTN</th>
												<th style="width:5%;font-size:12px;text-align:center;"><b>GRADE</th>
												<th style="width:10%;font-size:12px;text-align:center;"><b>REMARK</th>
											</tr>
										</thead>
										<tbody>';
										/*<!--------------------POPULATES THE SCORE TABLE---------------------->*/
									if ($score_record){
										while ($row = mysqli_fetch_array($score_record)){ 	
										echo '
											<tr>
												<td style="width:5%;text-align:center;">'.++$subj_sno.'</td>
												<td style="text-align:left;">'.getRSubject($row['subj_id']).'</td>
												<td style="text-align:center;">'.$row['first_ca'].'</td>
												<td style="text-align:center;">'.$row['second_ca'].'</td>
												<td style="text-align:center;">'.$row['third_ca'].'</td>
												<td style="text-align:center;">'.$row['exam'].'</td>
												<td style="text-align:center;font-weight:bold;">'.(($row['total'] < 40) ? '<font style="color:red">'.$row['total'].'</font>' : $row['total']).'</td>
												<td style="text-align:center;">'.round(getAVG($sch_id, $cid, $did, $row['subj_id'], $tid, $sid),1).'</td>
												<td style="text-align:center;">'.getHGST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
												<td style="text-align:center;">'.getLWST($sch_id, $cid, $did, $row['subj_id'], $tid, $sid).'</td>
												<td style="text-align:center;">'.Ordinal(getSubjPos($row['total'], $sch_id, $cid, $did, $row['subj_id'], $tid, $sid)).'</td>
												<td style="text-align:center;">'.getGrade($row['total']).'</td>
												<td style="text-align:center;">'.getRemark($row['total']).'</td>
											</tr>'; 
										}
									} else {
										echo '';
									}	
									echo'</tbody>
									</table>
								</div>
							</td>	
							<td>
								<div class="fixed-height-div2">
									<div class="custom" style="text-align:center;">
										<b style="font-size:12px;">Affective Domain
										<br>(Values, Attitude, <br>Interests, Characters)</b>
									</div>
									<table border="0" style="width:100%; border-collapse:collapse; font-size:13px; border:0px solid #ccc;">
										<tr>
											<td >&nbsp;Behaviours</td>
											<td width="2px" align="center">1</td>
											<td width="2px" align="center">2</td>
											<td width="2px" align="center">3</td>
											<td width="2px" align="center">4</td>
											<td width="2px" align="center">5</td>
										</tr>
										<tr>
											<td>&nbsp;Punctuality</td>
											'. $a.'
										</tr>
										<tr>
											<td>&nbsp;Attendance</td>
											'.$b.'
										</tr>
										<tr>
											<td>&nbsp;Assignment</td> 
											'.$c.'
										</tr>
										<tr>
											<td>&nbsp;Neatness</td>
											'.$d.'
										</tr>
										<tr>
											<td>&nbsp;Politeness</td>
											'.$e.'
										</tr>
										<tr>
											<td>&nbsp;Honesty</td>
											'.$f.'
										</tr>
										<tr>
											<td>&nbsp;Self Control</td> 
											'.$g.'
										</tr>
										<tr>
											<td>&nbsp;Responsibility</td>
											'.$h.'
										</tr>
										<tr>
											<td>&nbsp;Participation</td>
											'.$i.'
										</tr>
										<tr>	
											<td>&nbsp;Phy. Health</td> 
											'.$j.'
										</tr>
									</table>
									<div class="custom" style="padding:3px;text-align:center;">
										<b style="font-size:12px;">Psychomotor Domain<br>(Manual and Physical Skills)</b>
									</div>
									<table border="0" style="width:100%; border-collapse:collapse; font-size:13px; border:0px solid #ccc;">
										<tr>
											<td >&nbsp;Activities</td>
											<td width="2px" align="center">1</td>
											<td width="2px" align="center">2</td>
											<td width="2px" align="center">3</td>
											<td width="2px" align="center">4</td>
											<td width="2px" align="center">5</td>
										</tr>
										<tr>
											<td>&nbsp;Games</td>
											'.$i.'
										</tr>
										<tr>
											<td>&nbsp;Sport</td> 
											'.$g.'
										</tr>
										<tr>
											<td>&nbsp;Handwritting</td>
											'.$e.'
										</tr>
										<tr>
											<td>&nbsp;Communication</td>
											'.$c.'
										</tr>
										<tr>
											<td>&nbsp;Crafts</td> 
											'.$a.'
										</tr>
									</table>
									<div class="custom" style="padding:5px;text-align:center;">
										<i style="font-size:14px;">Key to Ratings (Affective & Psychomotor Domains)</i>
									</div>
									<table border="0" style="width:100%; border-collapse:collapse; font-size:12px; border:0px solid #ccc;">
										<tr>
											<td align="center"><b>5</b></td> <td> Excellent</td>
											<td align="center"><b>4</b></td> <td> V-good</td>
											<td align="center"><b>3</b></td> <td> Good</td>
										</tr>
										<tr>
											<td align="center"><b>2</b></td> <td> Fair</td>
											<td align="center"><b>1</b></td> <td> Poor</td>
											<td align="center"><b>0</b></td> <td> V-poor</td>
										</tr>
									</table>
									<div style="padding:10px;border:0px solid black;margin-top:10px;height:50px;text-align:center;">
										<table border="1" style="width:100%; border-collapse:collapse; font-size:12px; border:1px solid black;">
											<tr>
												<td><img src="assets/img/ntt.png" style="max-width:150px;"/></td>
											</tr>
										</table>
									</div>
								</div>
							</td>
						</tr>
					</table>
					</div>
					<!--++++++++++++++++++++++++++++COMMENTS+++++++++++++++++++++++++++-->
					<div class="" style="border:1px solid black;padding:10px;margin-bottom:5px;;">
						<div class="comments">
							<div class="xcom">
								<div class="custom">&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<b>Form Teacher\'s Comment</b></div>
								<div class="scom">
									<div class="comholder">&nbsp;&nbsp;'. getCom($com).'</div>
									<div class="nholder">&nbsp;&nbsp;<b>Name:</b> '. getFormTeacher($sch_id, $cid, $did).'</div>
								</div>
							</div>
							<div class="ycom">
								<div class="custom">&nbsp;&nbsp;<i class="fa fa-pen"></i>&nbsp;<b>Principal\'s Remark</b></div>
								<div class="cholder">&nbsp;&nbsp;'. getComment($sch_id, $aggregate, $total_subj).'</div>
							</div>
						</div>
						<!--+++++++++++++++++++++++NEXT TERM INFO+++++++++++++++++++++++-->
						<table border="1" cellpadding="1" cellspacing="5" class="account" style="border:1px solid black;">
							<tr>
								<td style="max-width:45%;">&nbsp;<b><i class="fa fa-calendar"></i>&nbsp;Next Term Begins:</b>&nbsp;'. date("D, jS F Y", strtotime(getResumptionDate($sch_id, $tid, $sid))).'</td> 
								<td style="max-width:40%;">&nbsp;<i class="fa fa-credit-card"><b></i>&nbsp;Next Term School Fee:</b>&nbsp;'. '&#8358;'.getSchfee($sch_id).'</td>
								<td style="max-width:50%;">&nbsp;<i class="fa fa-info-circle"><b></i>&nbsp;Term Payment Status:</b>&nbsp;'. getPaymentStatusValue(getPaymentstatus($uid, $tid, $sid)).'</td> 
							</tr>
						</table>
					</div>
					<!--+++++++++++++++++++++FOOTER/SIGNATURE++++++++++++++++++++++++++++-->
					<div class="" style="border:1px solid black;padding:10px;">
						<table border="1" cellpadding="1" cellspacing="1" class="footer">
							<tr>	
								<td style="width:100px;height:120px;">
									<img src="'.'data:image/png;base64,' . base64_encode($qr_code).'" style="max-width:100px;max-height:100px;"/>'.
								  '<center style="font-size:10px;">'. getSchAcronym($sch_id). '/' . $uid . '/' .$tid.'-22'.'/'. processNo(++$counter).'</center>
								</td>
								<td>		
									<!--+++++++++++++++++++++++++GRADINGS++++++++++++++++++++++++++++++-->
									<div style="color:red;text-align:center;">Note: Any alteration renders this result invalid</div>
									<table border="1" cellpadding="3" cellspacing="3" class="gradin" style="width:100%;position:inline;margin-bottom:2px;border:0px solid black;">
										<tr>
											<td align="center">
												<div class="custom"><i style="font-size:14px;">INTERPRETATION OF GRADES</i></div>
												<table border="0" cellspacing="3" cellpadding="3" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
													<tr>
														<td align="center">&nbsp;70 - 100%&nbsp;</td> 
														<td>&nbsp;<b>(A)</b>&nbsp;</td> 
														<td>&nbsp;Excellent&nbsp;</td>
														<td align="center">&nbsp;60 - 69%&nbsp;</td>
														<td>&nbsp;<b>(B)</b>&nbsp;</td> 
														<td>&nbsp;V-good&nbsp;</td>
														<td align="center">&nbsp;50 - 59%&nbsp;</td>
														<td>&nbsp;<b>(C)</b>&nbsp;</td>
														<td>&nbsp;Credit&nbsp;</td>
													</tr>
													<tr>
														<td align="center">&nbsp;45 - 49%&nbsp;</td>
														<td>&nbsp;<b>(D)</b>&nbsp;</td>
														<td>&nbsp;Fair&nbsp;</td>
														<td align="center">40 - 44%</td>
														<td>&nbsp;<b>(E)</b>&nbsp;</td>
														<td>&nbsp;Pass&nbsp;</td>
														<td align="center">0 - 39%</td>
														<td style="color:red">&nbsp;<b>(F)</b>&nbsp;</td>
														<td style="color:red">&nbsp;Fail&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!--+++++++++++++++++++++++!COPYRIGHT FOOTER++++++++++++++++++++-->
									<div style="text-align:center;border:1px solid black;padding:5px;font-size:14px;">
										Copyright © 2024 SMS. Powered by Niel Technologies <i class="fa fa-wifi"></i> <b>+2348145162722.</b> All Rights Reserved.
									</div>
								</td>
								<!-----------------------Signature-------------------------->
								<td style="width:200px;height:100px;text-align:center;">
									<b style="font-size:13px;">Principal\'s Signature/Stamp</b>
									<div class="signature-container">
										<img src="'.getPSignature($sch_id).'" alt="Signature" class="signature" style="width:200px;max-height:200px;"/><br/>
										<div class="date-overlay">
											<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d".'/'."m".'/'."Y").'</b></p>
											<i style="color:black;width:500px;font-size:14px;font-weight:bold"><?php //echo getHeadTeacher($sch_id);?></i>
										</div>
										<div style="font-size:12px">'.getHeadTeacher($sch_id).'</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<span class="right-note">output best with color printer</span>
		</div>
	</body><p/>';
} 
?>

<!--===============================PAGINATION P/N==================================-->
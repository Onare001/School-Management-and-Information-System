<?php
$subj_sno = 0;

//Counting the number of Students in class
	$result = mysqli_query($conn,"SELECT score_id, COUNT(DISTINCT user_id) AS num FROM cum_result WHERE sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND sid='$sid'");
	$row = mysqli_fetch_array($result);
	$num_class = $row['num'];
	$allcount = $num_class;

// Collating the individual aggregates
	$result567 = mysqli_query($conn,"SELECT average, SUM(average) AS aggregate FROM cum_result WHERE user_id='$uid' AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
	$row = mysqli_fetch_array($result567);
	$aggregate = $row['aggregate'];
		
// Updating the individual aggregate
	$result444 = mysqli_query($conn,"UPDATE cum_result SET aggregate_score = '$aggregate' WHERE user_id='$uid' AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
		
// Computing the total subject offered by student
	$result213 = mysqli_query($conn,"SELECT DISTINCT score_id, COUNT(score_id) AS total_subj FROM cum_result WHERE user_id='$uid'  AND cum_result.sch_id='$sch_id' AND cum_result.class_id='$cid' AND cat_id='$did' AND cum_result.sid='$sid'");
	$row = mysqli_fetch_array($result213);
	$total_subj = $row['total_subj'];
        
// Getting the comment
	$result498 = mysqli_query($conn,"SELECT * FROM stdnt_com WHERE user_id='$uid' AND sch_id='$sch_id' AND class_id='$cid' AND cat_id='$did' AND term_id='$tid' AND session_id='$sid'");
	$row = mysqli_fetch_array($result498);
	$com = $row['com_id'];
	
//Show Position on Result
	$result = mysqli_query($conn,"SELECT show_pstn FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$postn = $row['show_pstn'];
	if($postn == 1){
		$position = '&nbsp;'.Ordinal(getStudentcumPos($aggregate, $sch_id, $cid, $did, $sid)).'&nbsp;';
	} else {
		$position = '***No Position***';
	}
	
	require_once('assets/lib/phpqrcode/qrlib.php');// Include the QR code library
	$data = '('.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).') '.getUsername($uid).', '.getTerm($tid).' '.getSession($sid).' Result. '.'Aggregate: '. $aggregate.', Average: '.round($aggregate / $total_subj, 2).', Position:'.$position;
	ob_start();
	QRcode::png($data, null, QR_ECLEVEL_Q);
	$qr_code = ob_get_contents();
	ob_end_clean();
?>

<!--===============================BODY OF RESULT==================================-->
	<body>
		<div class="region">
			<span class="left-note">Note: any alteration renders this result invalid</span>
			<div class="rcontent">
				<!--+++++++++++++++++++SCHOOL INFORMATION+++++++++++++++++++++++++-->
				<table border="1" cellpadding="3" cellspacing="3" class="sch_info">
					<tr align="center">
						<td>
							<img src="<?php echo getPassport($uid);?>" alt="Passport" style="max-width:100px;max-height:120px;"/><div style="background-color:darkblue;color:white;width:100px;"><b> <?php echo getSchAcronym($sch_id).'&nbsp;'.date("Y");?></b></div>
						</td>
						<td>
							<img src="<?php echo getSchlogo($sch_id);?>" alt="School Logo" style="max-width:100px;max-height:100px;"/>
						</td>
						<td style="margin-right:0px;background-color:azure;color:auto;">
							<table border="0" cellpadding="3" cellspacing="3" style="width:600px;height:50px;">
								<tr align="center">
									<td>
										<?php echo '<h3 style="margin-top:0px;">'.strtoupper(getSchname($sch_id)).' - CUMULATIVE  RESULT'.'</h3>'.'<p style="margin-top:0px;margin-bottom:0px;">'.getSchAddress($sch_id).'</p>'.'<p style="margin-top:0px;"><i>'.'Motto:'.'&nbsp;'.getSchmotto($sch_id).'</i>'.'<br>'.'Phone No.:&nbsp;'.getSchphone($sch_id);?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!--+++++++++++++++++++++++++++++END SCHOOL INFORMATION++++++++++++++++++++++-->
 
				<!--++++++++++++++++++++++++++++++STUDENT INFORMATION++++++++++++++++++++++++-->
				<fieldset class="student_info">
					<legend class="field_title"><i class="fa fa-user-graduate"></i>&nbsp;Student' Result Information</legend>
					<table border="2" cellpadding="3" cellspacing="3" style="width:970px;">
					<!------------------------Row 1----------------------------------------->
						<tr>
							<td><b>&nbsp;&nbsp;<?php echo strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid));?></b></td>
							<td><b>&nbsp;ADM. NO:</b>&nbsp;<?php echo getAdmissionNo($uid);?></td>
							<td><b>&nbsp;&nbsp;CLASS:</b>&nbsp;<?php echo getClass($cid);?><?php echo getCategory($did);?></td>
							<td><b>&nbsp;&nbsp;NO. IN CLASS:</b>&nbsp;<?php echo $num_class;?></td>
						</tr>
						<!------------------------Row2----------------------------------->
						<tr>
							<td><b>&nbsp;&nbsp;STUDENT ID.&nbsp;:&nbsp;</b><?php echo getUsername($uid);?></td>
							<td>
							  <b>&nbsp;AGGREGATE SCORE:</b>&nbsp;
							  <?php if ($aggregate < 100) {
								  echo '00'.$aggregate;
							  } else if ($aggregate < 1000) {
								  echo '0'.$aggregate;
							  } else if ($aggregate >= 1000) {
								  echo $aggregate;
							  }
							  ?>
							</td>
							<td><b>&nbsp;&nbsp;POSITION:</b>&nbsp;<?php echo $position;?></td>
							<td><b>&nbsp;&nbsp;SESSION:</b>&nbsp;<?php echo getSession($ses_id);?></td>
						</tr>
					</table>
				</fieldset><p>
				<!--+++++++++++++++++++++END STUDENT INFORMATION++++++++++++++++++++-->

				<!--++++++++++++++++++++++SCORES BY SUBJECTS+++++++++++++++++++++-->
				<div class="result">
					<img src="<?php echo getSchlogo($sch_id);?>" alt="img" class="water_mark"/>
					<table border="2" cellpadding="3" cellspacing="3" class="score_info">
						<thead class="custom">
							<tr><td class="pad" align="center" colspan="12"><b>ANNUAL SUMMARY</b></td></tr>
							<tr>
								<th style="width:5%;text-align:center;"><b>S/N</th>
								<th style="width:25%;"><b>SUBJECT(s) OFFERED</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>1ST.TERM<br>(100%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>2ND.TERM<br>(100%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>3RD.TERM<br>(100%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>TOTAL<br>(300%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>AVG <br>(100%)</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>HGST</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>LWST</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>POSTN</th>
								<th style="width:5%;font-size:12px;text-align:center;"><b>GRADE</th>
								<th style="width:10%;font-size:12px;text-align:center;"><b>REMARK</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$result1 = mysqli_query($conn,"SELECT * FROM cum_result WHERE user_id = '$uid' AND cat_id = '$did' AND sch_id = '$sch_id' AND sid = '$sid'  ORDER BY subj_id ASC");
						while ($row = mysqli_fetch_array($result1)){ 
							$subj = $row['subj_id'];
							$first_term_total = $row['first_term_total'];
							$second_term_total = $row['second_term_total'];
							$third_term_total = $row['third_term_total'];
							$total = $row['total'];
							$average = $row['average'];
						?>
						<!--------------------POPULATES THE SCORE TABLE---------------------->
							<tr>
								<td style="width:5%;text-align:center;"><?php echo ++$subj_sno;?></td>
								<td style="text-align:left;"><?php echo getSubject($subj);?></td>
								<td style="text-align:center;"><?php echo $first_term_total;?></td>
								<td style="text-align:center;"><?php echo $second_term_total;?></td>
								<td style="text-align:center;"><?php echo $third_term_total;?></td>
								<td style="text-align:center;"><?php echo $total;?></td>
								<td style="text-align:center;"><b><?php if($average < 40){
										echo '<font style="color:red">'.$average.'</font>';
										} else {
										echo $average;
										}?></td>
								<td style="text-align:center;"><?php echo getCUMHGST($sch_id, $cid, $did, $subj, $sid);?></td>
								<td style="text-align:center;"><?php echo getCUMLWST($sch_id, $cid, $did, $subj, $sid);?></td>
								<td style="text-align:center;"><?php echo Ordinal(getCumSubjPos($average, $sch_id, $cid, $did, $subj, $sid));?></td>
								<td style="text-align:center;"><?php echo getGrade($average);?></td>
								<td style="text-align:center;"><?php echo getRemark($average);?></td>
							</tr>
						</tbody>
						<?php } ?>
					<!-----------------!POPULATES THE SCORE TABLE-------------------->
					</table><p>
				</div>
				<!--+++++++++++++++++++++!SCORES BY SUBJECTS++++++++++++++++++++++-->

				<!--++++++++++++++++++++++++++++COMMENTS+++++++++++++++++++++++++++++++-->
				<table border="0" cellpadding="1" cellspacing="5" class="comments" style="border:1px solid #ccc;">
					<tr>
						<td style="width:100%;">
							<table border="1" cellpadding="1" cellspacing="0" class="comments" style="border:1px solid #ccc;width:100%;">
								<tr>
									<td style="width:50%;">&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<b>Form Teacher's Comment</b></td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getCom($com);?></td>
								</tr>
								<tr>
									<td style="width:50%;">&nbsp;&nbsp;<i class="fa fa-edit"></i>&nbsp;<b>Head Teacher's Remark</b></td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getComment($sch_id, $aggregate, $total_subj);?></td>
								</tr>	
								<tr>
									<td>&nbsp;&nbsp;<b><i class="fa fa-arrow-up"></i>&nbsp;Promotion Status</b>&nbsp;</td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getPromStatus($sch_id, $uid, $cid, $did, $sid, $aggregate, $total_subj);?></td>
								</tr>
							</table>
						</td>
						<td style="width:100%;">
							<table border="1" cellpadding="1" cellspacing="0" class="commen" style="border:1px solid #ccc;width:50%;">
								<tr>
									<td style="width:50%;">&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<b>No. of Times Sch. Opened</b></td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getCom($com);?></td>
								</tr>
								<tr>
									<td style="width:45%;">&nbsp;&nbsp;<i class="fa fa-edit"></i>&nbsp;<b>No. of Times Present</b></td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getComment($sch_id, $aggregate, $total_subj);?></td>
								</tr>	
								<tr>
									<td>&nbsp;&nbsp;<b><i class="fa fa-arrow-up"></i>&nbsp;Promotion Status</b>&nbsp;</td>
									<td style="width:100%;">&nbsp;&nbsp;<?php echo getPromStatus($sch_id, $uid, $cid, $did, $sid, $aggregate, $total_subj);?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!--++++++++++++++++++++++++++++!COMMENTS+++++++++++++++++++++++++++++++-->

				<!--++++++++++++++++++++++++++++NEXT TERM INFO+++++++++++++++++++++++++++++++-->
				<table border="1" cellpadding="1" cellspacing="5" class="account" style="border:1px solid #ccc;">
					<tr>
						<td style="width:35%;">&nbsp;&nbsp;<b><i class="fa fa-calendar"></i>&nbsp;Next Term Begins:</b>&nbsp;<?php echo date("D jS F Y", strtotime(getResumptionDate($sch_id, $tid, $sid)));?></td> 
						<td style="width:30%;">&nbsp;&nbsp;<i class="fa fa-credit-card"><b></i>&nbsp;Next Term School Fee:</b>&nbsp;<?php echo '&#8358;'.getSchfee($sch_id);?></td>
						<td style="max-width:50%;">&nbsp;<i class="fa fa-info-circle"><b></i>&nbsp;Term Payment Status:</b>&nbsp;<?php echo getPaymentStatusValue(getPaymentstatus($uid, $tid, $sid))?></td> 
					</tr>
				</table><p>
				<!--++++++++++++++++++++++++++++!NEXT TERM INFO+++++++++++++++++++++++++++++++-->

				<!--++++++++++++++++++++++++++++FOOTER/SIGNATURE+++++++++++++++++++++++++++++++-->
				<table border="1" cellpadding="3" cellspacing="3" class="performance">
					<tr>
						<td>
							<table border="1" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
								<tr>
									<td class="pad custom" align="center" colspan="9">INTERPRETATION OF GRADES</td>
								</tr>
								<tr>
									<td align="center">&nbsp;70 - 100%&nbsp;</td> 
									<td>&nbsp;<b>(A)</b>&nbsp;</td> 
									<td>&nbsp;Excellent&nbsp;</td>

									<td align="center">&nbsp;60 - 69%&nbsp;</td>
									<td>&nbsp;<b>(B)</b>&nbsp;</td> 
									<td>&nbsp;V-good&nbsp;</td>

									<td align="center">&nbsp;50 - 59%&nbsp;</td>
									<td>&nbsp;<b>(C)</b>&nbsp;</td>
									<td>&nbsp;Good&nbsp;</td>
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
							<table border="1" style="width:100%; border-collapse:collapse; font-size:14px; border:0px solid #ccc;">
								<tr>
									<td class="pad custom" align="center" colspan="3">SUMMARY</td>
								</tr>
								<tr>
									<td><b>&nbsp;Total Subject Registered:</b> <?php echo $total_subj;?></td>
									<td><b>&nbsp;Number of Pass:</b> <?php echo getStuPass($sch_id, $uid, $cid, $did, $sid);?></td>
									<td><b>&nbsp;Number of Fail:</b> <?php echo  getStuFail($sch_id, $uid, $cid, $did, $sid);?></td>
								<tr>
							</table>
						</td>
						<td style="width:200px;height:100px;text-align:center;">
						<b style="font-size:13px;">Principal's Signature/Stamp</b>
						<div class="signature-container">
							<img src="<?php echo getPSignature($sch_id);?>" alt="Signature" class="signature" style="width:200px;max-height:200px;"/><br/>
							<div class="date-overlay">
								<p><b><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d".'/'."m".'/'."Y");?></b></p>
							</div>
						</div>
						<i style="color:black;width:500px;font-size:12px;font-weight:bold"><?php echo getHeadTeacher($sch_id);?></i>
					</td>
						<td style="width:100px;height:120px;">
							<img src="<?php echo 'data:image/png;base64,' . base64_encode($qr_code);?>" style="max-width:100px;max-height:100px;"/>
					        <center style="font-size:10px;"><?php echo getSchAcronym($sch_id). '/' . $uid . '/' .$tid.'-22'.'/'. processNo(++$counter);?></center>
						</td>
					</tr>
				</table>
				<!--++++++++++++++++++++++++++++!FOOTER/SIGNATURE+++++++++++++++++++++++++++++++-->

				<!--++++++++++++++++++++++++++++COPYRIGHT FOOTER+++++++++++++++++++++++++++++++-->
				<table border="1" cellpadding="5" cellspacing="0" class="footer" >
					<tr>
						<td align="center">
							<div style="font-size:14px;">Copyright © 2023 SMS. Powered by Niel Technologies +2348145162722. All Rights Reserved.</div>
						</td>
					</tr>
				</table>
				<!--++++++++++++++++++++++++++++!COPYRIGHT FOOTER+++++++++++++++++++++++++++++++-->
			</div>
			<span class="right-note">output best with color printer</span>
		</div></p>
	</body>
<!--===============================!BODY OF RESULT==================================-->
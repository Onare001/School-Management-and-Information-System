<?php $page_title = "Score Sheet"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
 $class_id = $cat_id = $subj_id = "";
if (isset($_GET['cid']) && isset($_GET['cat']) || (isset($_GET['sid']))) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['cat']);
	
	$subj_id = decrypt($_GET['sid']);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>
<?php include('include/page_title.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<?php include ("include/regstu_menu.php"); ?>
						</div>
						<div class="col-md-10">
						<?php 
							if ($priviledge == '1') {
								echo '
								<div class="card" style="padding:5px;">
									<div class="card-header">
										<h3 class="card-title"></h3>';
										if (isset($msg)) { echo $msg_toastr; }
								echo '
										<form action="" method="post" autocomplete="off">
											<table border="0" align="center" style="border-collapse:collapse; width:100%;">
												<tr>
													<td>                                          
														<select name="subj_id" id="sel_subj" style="width:100%;" class="form-control">
															<option value="">Select Subject (optional)</option>';
															$result = mysqli_query($conn, "SELECT * FROM subj_info ORDER BY subj_title ASC");
															while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row['subj_id'].'">'.getSubject($row['subj_id']).'</option>';
															}
								echo '                  </select>
													</td>
													<td>
														<select name="teacher" id="teacher" class="form-control">
															<option value="">Select Subject Teacher(optional)</option>';
															$result = mysqli_query($conn, "SELECT * FROM staff_info JOIN sch_users ON staff_info.user_id=sch_users.user_id WHERE sch_users.priv_id='2' GROUP BY sch_users.user_id");
															while ($row = mysqli_fetch_array($result)){
																echo '<option value="'.$row["user_id"].'">'.getLastname($row["user_id"]).'&nbsp'.getFirstname($row["user_id"]).'</option>'; 
															}
								echo '                  </select>
													</td>
													<td>
														<button type="reset" name="reset" class="btn btn-danger" onclick=""><i class="fa fa-refresh"></i> RESET </button>
													</td>
													<td>
														<a href="javascript:void(0);" class="btn btn-primary" onclick="printPageArea(\'printableArea\')"><i class="fa fa-print"></i> PRINT </a>
													</td>
												</tr>   
											</table>
										</form>
									</div>
								</div>';
							}
							?>
							<div class="card" style="padding:10px;">
								<div class="card card-primary card-outline">
									<div id="printableArea" style="margin:0px auto;padding:5px;">
										<style>
											tr {
												height: 35px;
											}
											.water_mark {
												position: absolute;
												width: 700px;
												height: 700px;
												top: 50%;
												left: 50%;
												opacity:0.1;
												transform: translate(-50%, -50%);
												background-color: rgba(255, 255, 255, 0.1);
												padding: 0px;
												display: list-item;
												list-style-position: inside;
												pointer-events: none;
											}
											.water_mark::before {
												content: "";
												position: absolute;
												top: 0;
												right: 0;
												bottom: 0;
												left: 0;
												background-color: transparent;
												pointer-events: auto;
											}
											.table-bordered {
											  border: 1px solid #000000;
											}

											.table-bordered th,
											.table-bordered td {
											 border: 2px solid #ccc;
											}

											.table-bordered thead th,
											.table-bordered thead td {
											  border-bottom-width: 2px;
											}
											<?php if($theme){
											 echo '<style>'.' 
											#selectbox {
												width:450px;
												/*margin-left:0px auto;
												margin-right:0px auto;*/
												margin: 0 auto;
												zoom: 90%;
												}
											#custom, #selectbox, thead, tfoot{
												background-color:'.$theme.';
												'.'color:white;
												}
										'.'</style>';
										} ?>
										</style>
										<div style="border: 1px #000000 solid;padding:5px;">
										<table align="center" style="width:100%;margin:0 auto;">
											<tr>
												<td>
													<img src="<?php echo getSchlogo($sch_id);?>" alt="School Logo" style="max-width:100px;max-height:100px;"/>&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
												<td>
													<h3 style="font-weight:bold; font-size:25px;text-align:center;"><?php echo strtoupper(getSchname($sch_id)).'<br>  SCORE ENTRY SHEET';?></h3>
													<h2 style="font-size:14px;text-align:center;"><?php echo getSchAddress($sch_id).'<br>'.getSchPhone($sch_id);?></h2>
												</td>
											</tr>
										</table>
										
										<table border="1" align="center" style="border-collapse:collapse; border-radius:10px;width:100%;">
											<tr>
												<td align="center"><b style="font-size:16px;">TERM</b></td>
												<td align="center"><b>SESSION</b></td>
												<td align="center"><b style="font-size:16px;">YEAR</b></td>
												<td align="center"><b style="font-size:16px;">CLASS</b></td>
												<td align="center"><b style="font-size:16px;">SUBJECT</b></td>
												<td align="center"><b style="font-size:16px;">TEACHER's NAME</b></td>
											</tr>
											<tr>
												<td align="center"><?php echo getTerm($ctid);?></td>
												<td align="center"><?php echo getSession($csid);?></td>
												<td align="center"><b style="font-size:16px;"><?php echo date("Y");?> </td>
												<td align="center"></b><b style="font-size:16px;"><?php echo strtoupper(getClass($class_id)); echo getCategory($cat_id); ?></b></td>	
												<td align="center"><?php echo ($priviledge != '1')? getSubject($subj_id) : '';?><div id="selectedSubject"></div></td>
												<td align="center"><?php echo ($priviledge != '1')? getFirstname($user_id).' '.getLastname($user_id) : '';?><div id="selectedTeacher"></div></td>
											</tr>
											<tr>
												<td colspan="6" align="center"><i style="color:red;">Ensure this is kept clean and safe | Do not create the total column, total, average, highest and lowest score will be computed by the software | Submit this document to the officer in charge for endorsement after entry into the software</i></td>
											</tr>
										</table><p/>
										<img src="<?php echo getSchlogo($sch_id);?>" alt="img" class="water_mark"/>
										<table cellspacing="3" cellpadding="3" class="table-bordered table-striped">
											<thead>
												<tr align="center">
													<th align="center">SN</th>
													<th align="center"><input name="" type="checkbox" id="check-all"></th>
													<th align="left"> STUDENT NAME </th>
													<th align="center">1ST.CA<br>(10%)</th>
													<th align="center">2ND.CA<br>(10%)</th>
													<th align="center">3RD.CA<br>(10%)</th>
													<!--th align="center">5TH.CA<br>(10)</th-->
													<!--th align="center">6TH.CA<br>(10)</th-->
													<!--th align="center">7TH.CA<br>(10)</th-->
													<th align="center">EXAM<br>(70%)</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if (getSubjectType($subj_id)=='Elective'){
													$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN registered_subject ON sch_users.user_id = registered_subject.user_id WHERE sch_users.sch_id = '$sch_id' AND sch_users.priv_id = 3 AND registered_subject.sch_id= '$sch_id' AND registered_subject.class_id = '$class_id' AND registered_subject.cat_id = '$cat_id' AND registered_subject.subj_id = '$subj_id' AND registered_subject.user_id");
												} else {
													$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id AND sch_users.sch_id=stdnt_info.sch_id WHERE sch_users.sch_id='$sch_id' AND sch_users.priv_id='3' AND stdnt_info.status_id!='0' AND stdnt_info.class_id='$class_id' AND stdnt_info.cat_id='$cat_id' ORDER BY sch_users.last_name,sch_users.first_name ASC");
												}
												while ($row = mysqli_fetch_array($result)){
													$uid = $row["user_id"];
												?>		
												<tr>
													<td align="center" width="5%"><?php echo ++$counter; ?></td>
													<td align="center" width="5%"><input type="checkbox" class="checkbox" name="checkbox[]" value=""/></td>
													<td align="left" width="auto"> <?php echo strtoupper(getLastname($uid)).'&nbsp;'.strtoupper(getFirstname($uid));?></td>
													<td align="center" width="5%"> </td>
													<td align="center" width="5%"> </td>
													<td align="center" width="5%"> </td>
													<!--td align="center" width="5%"> </td-->
													<!--td align="center" width="5%"> </td-->
													<!--td align="center" width="5%"> </td-->
													<td align="center" width="5%"> </td>
												</tr>
										<?php } ?>		
											</tbody>
										</table>
										</div>
										<br/>
										<div style="text-align: center;">
											<small style="margin: 0 auto;">Copyright &#169; 2023 SMS. Powered by Niel Technologies +2348145162722. All Rights Reserved.</small>
										</div>
									</div> 
									<div class="button-container">
										<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
										<a href="javascript:void(0);" class="btn btn-primary" onclick="printPageArea('printableArea')"><i class="fa fa-print"></i> PRINT </a>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</section>		
			
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/check_all.php');?>
<?php include ('include/page_scripts/print.php');?>
<script>
    var selectElementSubj = document.getElementById('sel_subj');
    var selectElementTeacher = document.getElementById('teacher');
    
    var selectedSubjectElement = document.getElementById('selectedSubject');
    var selectedTeacherElement = document.getElementById('selectedTeacher');
    
    selectElementSubj.addEventListener('change', function () {
        var selectedOptionText = selectElementSubj.options[selectElementSubj.selectedIndex].text;
        selectedSubjectElement.textContent = selectedOptionText;
    });

    selectElementTeacher.addEventListener('change', function () {
        var selectedOptionText = selectElementTeacher.options[selectElementTeacher.selectedIndex].text;
        selectedTeacherElement.textContent = selectedOptionText;
    });
</script>
</html>
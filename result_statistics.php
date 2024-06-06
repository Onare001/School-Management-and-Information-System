<?php $page_title = "Result Statistics"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$tid="";$cid="";$id="";$sid="";$result="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$term_id = $_POST['term_id'];
	$sid = $_POST['sid']; 
    if (empty($class_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Class!'.'</span>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($term_id)) {
        $msg = '<span class="badge bg-danger">'.'Select Term!'.'</span>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_term.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($sid)) {
        $msg = '<span class="badge bg-danger">'.'Select Session!'.'</span>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_session.mp3" type="audio/mpeg">
			</audio>';
    } else { //
        $sql = "SELECT score_id FROM score_info WHERE sch_id='$sch_id' AND class_id='$class_id' AND term_id='$term_id' AND sid='$sid'";
		 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
            header("location: result_statistics?cid=" . encrypt($class_id) . "&tid=" . encrypt($term_id) ."&sid=" . encrypt($sid));
        } else {
            $msg = '<span class="badge bg-danger">'.'No Score Record from this Class in'.' '.getTerm($term_id).'&nbsp'.getSession($sid).'&nbsp;'.'Academic Session'.'</span>';
			echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_no_result.mp3" type="audio/mpeg">
			</audio>';
        }
    }
}

if (isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['tid'])) {
    $cid = decrypt($_GET['cid']);//Class
	$tid = decrypt($_GET['tid']);//Term
    $sid = decrypt($_GET['sid']);//Session    
	}	
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<div class="card" style="margin-left:10px;margin-right:10px;">
				<!--center style="margin-bottom:10px;"><?php if (isset($msg)) { echo '<text>'.$msg.'</text>';} ?></center-->
				<form action="" method="post">
					<table border="0" align="center" style="border-collapse:collapse; width:100%;">
						<tr>
							<td>
								<select name="class_id" id="sel_class" class="form-control">
									<?php
									echo '<option value="">'.'Select Class'.'</option>';
									$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
									while ($row = mysqli_fetch_array($result)){
									echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
								</select>
							</td> 
							<td>
								<select name="term_id" id="term_id" class="form-control">
									<option value="">Select Term</option>
									<?php
									$result = mysqli_query($conn,"SELECT * FROM term_info");
									while ($row = mysqli_fetch_array($result)){ ?><option value="<?php echo $row["term_id"];?>"><?php echo $row["term_title"];?></option>
									<?php } ?><br/>
								</select>
							</td>  
							<td>
								<select name="sid" id="sel_session" class="form-control">
									<option value="">Select Session</option>
									<?php
									$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
									while ($row = mysqli_fetch_array($result)){ ?><option value="<?php echo $row["sid"];?>"><?php echo $row["session"];?></option>
									<?php } ?><br/>
								</select>
							</td> 
							<td width="50">
								<input name="submit" type="submit" value="Submit" class="btn btn-primary" style="vertical-align:top; height:34px;"/>
							</td>
							<td width="50">    
								<input title="Print" type="submit" class="btn btn-primary" name="print" value="PRINT" '+' onClick="javascript:window.print()" style="vertical-align:top; height:34px;"/>
							</td>
						</tr> 
					</table> 
				</form>
			</div>   


			
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">
						Result Statistics | <?php if (isset($_GET['sid'])){ echo getClass($cid).'&nbsp;'.getTerm($tid).'&nbsp;'.getSession($sid).'&nbsp;'.'Academic Session';}?><br/>
					</h3>
				</div>
				<div class="card-body">
				<?php 
				if (!empty($cid)){
					echo '
					<table class="table table-bordered table-striped">
						<thead style="background-color:darkblue;color:white;">
							<tr>
								<th style="width: 10px">#</th>
								<th>Subject</th>
								<th>No. of<br> Students</th>
								<th style="width:30px">No. of As</th>
								<th style="width:30px">No. of Bs</th>
								<th style="width:30px">No. of Cs</th>
								<th style="width:30px">No. of Ds</th>
								<th style="width:30px">No. of Es</th>
								<th style="width:30px">No. of Fs</th>
								<th>%<br>Pass</th>
								<th>%<br>Fail</th>
								<th>Best Students/Class</th>
								<th>Hgst</th>
								<th>Lwst</th>
								<th>Avg</th>
							</tr>
						</thead>
						<tbody>'; 
						$result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(user_id) AS numstudent FROM score_info WHERE sch_id = '$sch_id' AND class_id = '$cid' AND term_id = '$tid' AND sid = '$sid' GROUP BY subj_id ORDER BY subj_id");
						
						//$result = mysqli_query($conn,"SELECT subj_id FROM subj_info WHERE subj_id<9");
						while($row = mysqli_fetch_array($result)){	
							$pass = $row['numstudent'] - getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'F');
						echo ' 
							<tr>
								<td align="center">'.++$counter.'</td>
								<td align="left">'.getSubject($row['subj_id']).'</td>
								<td align="center">'.$row['numstudent'].'</td>                     
								<td align="center">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'A').'</td>
								<td align="center">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'B').'</td>
								<td align="center">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'C').'</td>
								<td align="center">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'D').'</td>
								<td align="center">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'E').'</td>
								<td align="center" style="color:red;">'.getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'F').'</td>
								<td align="center"><span class="badge bg-success">'.round((($pass/$row['numstudent'])*100),1).'%</span></td>
								<td align="center"><span class="badge bg-danger">'.round(((getNumGrade($sch_id, $cid, $row['subj_id'], $tid, $sid, 'F')/$row['numstudent'])*100),1).'%</span></td>
								<td align="left">';
									$bestStudents = getBestStudent($sch_id, $cid, $row['subj_id'], $tid, $sid, getGHGST($sch_id, $cid, $row['subj_id'], $tid, $sid));
									foreach ($bestStudents as $studentInfo) {
										echo $studentInfo['name'] . ' (' . $studentInfo['class'] . $studentInfo['category'] . ')<br>';
									}
								echo '</td>
								<td align="center">'.getGHGST($sch_id, $cid, $row['subj_id'], $tid, $sid).'</td>
								<td align="center">'.getGLWST($sch_id, $cid, $row['subj_id'], $tid, $sid).'</td>
								<td align="center">'.round(getGAVG($sch_id, $cid, $row['subj_id'], $tid, $sid),1).'</td>
							</tr>';
							} 
						echo '
						</tbody>
					</table>';
					} ?> 
				</div>
			</div>
		</div>
	</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
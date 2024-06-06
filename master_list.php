<?php $page_title = "Master Payment List"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php 
if ($priviledge == 9){

} else {
	 header("Location: logout");
     exit();
}
?>
<?php
$cid=""; $pt=""; $sid1=""; $sid2=""; $sid3="";
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
	$session_id1 = $_POST['sid1'];
	$session_id2 = $_POST['sid2'];
	$session_id3 = $_POST['sid3'];	
	$paymenttype = $_POST['payment_type'];
    if (empty($class_id)) {
        $msg = 'Select Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id1)) {
        $msg = 'Select Class First Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id2)) {
        $msg = 'Select Class Second Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($session_id3)) {
        $msg = 'Select Class Third Session!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($paymenttype)) {
        $msg = 'Select Payment Type!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
	$cid = $class_id;
	$sid1 = $session_id1;
	$sid2 = $session_id2;
	$sid3 = $session_id3;
	$pt = $paymenttype;
		 $result = mysqli_query($conn, "SELECT * FROM stdnt_info JOIN ledger_info ON stdnt_info.user_id = ledger_info.user_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.status_id = '1' AND stdnt_info.class_id='$cid'");
        if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_assoc($result);
        } else {
            //$msg = 'No Records for this Query';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>              
<?php if (isset($msg)) { echo $msg_toastr; } ?>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"></h3>
									<table border="0" align="center" style="border-collapse:collapse; width:100%;">
										<form action="" method="post">
											<tr> 
												<td>
													<select name="class_id" id="sel_class" class="form-control">
														<option value="">Select Class</option>
															<?php
															$result = mysqli_query($conn,"SELECT * FROM class_info");
															while ($row = mysqli_fetch_array($result)){ ?> <option value="<?php echo $row["class_id"];?>"><?php echo $row["class_name"];?></option><?php } ?>			
													</select>
												</td>
												<td>
													<select name="sid1" id="sel_session1" class="form-control">
														<option value="0">Select First Session</option>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
														while ($row = mysqli_fetch_array($result)){ ?> <option value="<?php echo $row["sid"];?>"><?php echo $row["session"];?></option><?php } ?>		
													</select>
												</td>
												<td>
													<select name="sid2" id="sel_session2" class="form-control">
														<option value="0">Select Second Session</option>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
														while ($row = mysqli_fetch_array($result)){ ?><option value="<?php echo $row["sid"];?>"><?php echo $row["session"];?></option><?php } ?>
													</select>
												</td>
												<td>
													<select name="sid3" id="sel_session3" class="form-control">
														<option value="0">Select Third Session</option>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done=1");
														while ($row = mysqli_fetch_array($result)){ ?><option value="<?php echo $row["sid"];?>"><?php echo $row["session"];?></option><?php } ?>
													</select>
												</td>
												<td>
													<select name="payment_type" id="sel_type" class="form-control">
														<option value="0">Purpose of Payment</option>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM payment_type WHERE sch_id='$sch_id'");
														while ($row = mysqli_fetch_array($result)){?><option value="<?php echo $row["payment_id"];?>"><?php echo $row["payment_type"];?></option><?php } ?>
													</select>
												</td> 
												<td width="50"><input name="submit" type="submit" value="Submit" class="btn btn-primary" style="vertical-align:top;height:34px;"></td>
												<td width="50"><a href="javascript:void(0);" class="btn btn-primary" onclick="printPageArea('printableArea')" style="vertical-align:top;height:34px;">PRINT</a></td>
											</tr>
										</form>
									</table> 
								</div>
								<div class="card-body" id="printableArea" style="margin-left:5px;margin-right:10px;margin-bottom:100px;">
									<div id="3D" style="width:95%; margin-left:10px;margin-bottom:0px;">
										<table border="5px" cellpadding="5px" cellspacing="2px" width="100%">
											<tr class="custom" colspan="6">Payment Master list <?php echo '|&nbsp;'.getClass($cid).'&nbsp;&nbsp;'.getPaymenttype($pt);?> </tr>
											<tr height="3" style="3D">
												<thead class="custom">
													<th><b>#SN</b></th>
													<th style="width:500px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;STUDENT' ID / NAME &nbsp;&nbsp;&nbsp;&nbsp;</b></th>
													<th colspan="3"><b style="text-align:center;"><center><?php echo getSession($sid1);?></center></b></th>
													<th colspan="3"><b style="text-align:center;"><center><?php echo getSession($sid2);?></center></b></th>
													<th colspan="3"><b style="text-align:center;"><center><?php echo getSession($sid3);?></center></b></th>
													<th><b>COMMENT </b></th>
												</thead>
											</tr>
											<?php
											if (($sid1) != ($sid2) && ($sid3) != ($sid1) && ($sid3) != ($sid2)) {
											$showclasslist = "SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id AND stdnt_info.sch_id=sch_users.sch_id WHERE stdnt_info.sch_id = '$sch_id' AND stdnt_info.class_id='$cid' ORDER BY sch_users.last_name ASC ";//AND stdnt_info.cat_id='1';LIMIT 20
											$result = mysqli_query($conn,$showclasslist);
											} else {
												echo '<script>toastr.warning("You can not select same Academics Session more than once")</script>';
											}
												while ($row = mysqli_fetch_array($result)){
												$uid = $row["user_id"];
												$class_id = $row["class_id"];$cat_id = $row["cat_id"];
												include ("functions/master_payment_function.php");
											?>
											
											<tr class="pad">
												<th class="pad">&nbsp;</th>
												<th class="pad" style="width:500px;">&nbsp;<?php echo getUsername($uid);?></th>&nbsp;&nbsp;&nbsp;
												<!--================SESSION 1====================-->
												<th class="pad" style="3D"><b>1ST</b></th>
												<th class="pad" style="3D"><b>2ND</b></th>
												<th class="pad" style="3D"><b>3RD</b></th>&nbsp;&nbsp;&nbsp;
												<!--================SESSION 2====================-->
												<th class="pad" style="3D"><b>1ST</b></th>
												<th class="pad" style="3D"><b>2ND</b></th>
												<th class="pad" style="3D"><b>3RD</b></th>
												<!--================SESSION 3====================-->
												<th class="pad" style="3D"><b>1ST</b></th>
												<th class="pad" style="3D"><b>2ND</b></th>
												<th class="pad" style="3D"><b>3RD</b></th>
												<!--================SESSION 4====================-->
												<!--th class="pad" style="3D"><b>1ST</b></th>
												<th class="pad" style="3D"><b>2ND</b></th>
												<th class="pad" style="3D"><b>3RD</b></th-->
												<!--================COMMENT====================-->
												<th class="pad" style="3D">&nbsp;</th>
											</tr>
											<tbody>
												 <!--================CONTENT====================-->
												 <tr height=3D20 style="3D"'height:15.0pt'>
													 <!--================SERIAL NUMBER && NAME====================-->
													  <td class="pad" style="3D">&nbsp;<?php echo ++$counter;?>&nbsp;</td>
													  <td class="3Dxl6511766" style="width:500px;"><?php echo getLastname($uid).'&nbsp'.getFirstname($uid);?>&nbsp;</td>
													  <!--================SESSION 1====================-->
													  <td class="pad" style="3D"><?php echo $paymentstatus11;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus12;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus13;?></td>
													  <!--================SESSION 2====================-->
													  <td class="pad" style="3D"><?php echo $paymentstatus21;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus22;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus23;?></td>
													  <!--================SESSION 3====================-->
													  <td class="pad" style="3D"><?php echo $paymentstatus31;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus32;?></td>
													  <td class="pad" style="3D"><?php echo $paymentstatus33;?></td>
													  <!--================SESSION 4====================-->
													  <!--td class="pad" style="3D">&nbsp;</td>
													  <td class="pad" style="3D">&nbsp;</td>
													  <td class="pad" style="3D">&nbsp;</td-->
													  <!--================COMMENT====================-->
													  <td class="pad" style="3D">&nbsp;</td>
												 </tr>
											</tbody>
							<?php } ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/print.php');?>
</html>
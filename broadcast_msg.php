<?php $page_title = "Broadcast Message"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit'])) {
    $information = $_POST['information'];
	$audience = $_POST['audience'];
    if (empty($information)) {
        $msg = 'Enter the Information you want to Broadcast';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($audience)) {
        $msg = 'Select Audience Group!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else { //
		 $result = mysqli_query($conn,"INSERT INTO `broadcast_msg`(`information`, `audience`, `sch_id`) VALUES ('$information','$audience','$sch_id')");
        if ($result) {
			$msg = 'Broadcast information has been sent';
			$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
        } else {
            $msg = 'Something went Wrong, please try again';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
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
				
			<div style="margin-left:10px;margin-right:10px;">
<?php if (isset($msg)) { echo $msg_toastr; } ?>
				<table border="0" align="center" style="border-collapse:collapse; width:100%;">
					<form action="" method="post" autocomplete="off">
						<tr>
							<td><input name="information" type="text" placeholder="Enter the Information you want to Broadcast" class="form-control"/></td>
							<td width="20%">
								<select name="audience" id="" class="form-control">
									<option value="">Select Audience</option>
									<option value="1">Staff</option>
									<option value="3">Students</option>
								</select>
							</td>
							<td width="50">
								<input name="submit" type="submit" value="POST" class="btn btn-primary" style="vertical-align:top;height:34px;"/>
							</td>
						</tr>	
					</form>
				</table><p> 
			</div>
			<div class="card" style="margin-left:10px;margin-right:10px;">
				<div class="card-header">
					<h3 class="card-title"><i class="fa fa-wifi"></i> Broadcast Message</h3>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SN</th>
								<th width="100%">Information</th>
								<th width="5%">Audience</th>
								<th width="5%">Status</th>
								<th width="5%">Delete</th>
							</tr>
						</thead>
						<tbody>
<?php
$result = mysqli_query($conn,"SELECT * FROM broadcast_msg WHERE sch_id='$sch_id'");
	while ($row = mysqli_fetch_array($result)){
?>
							<tr>
								<td align="center"><?php echo ++$counter;?></td>
								<td><?php echo $row['information'];?></td>
								<td align="center"><?php if ($row['audience'] == 1) {
									echo 'Staff';
								} else if ($row['audience'] == 3) {
									echo 'Students';
								};?></td>
								<td><center><a style="text-decoration:none;" <?php if ($row["status"]=='1') { echo "<a href=deactivate?msg_id=".encrypt($row['msg_id'])."><img src=assets/img/tick.png alt=active></a>"; } 
								else { echo "<a href=activate?msg_id=".encrypt($row['msg_id'])."><img src=assets/img/drop.png alt=active></a>";} ?></center></td>
								<td><center><a title="Delete" onclick="return confirm('Are you sure you want to delete this Information?');" href="confirm_delete?msg_id=<?php echo encrypt($row['msg_id']);?>"><img src="assets/img/trash.png" width="16" height="16" alt="img"></a></center></td>
							</tr>
<?php } ?>
						</tbody>
					</table><p>		
				</div>
			</div>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
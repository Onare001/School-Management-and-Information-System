<?php $page_title = "Site Maintenance"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<?php
if (isset($_POST['submit29'])){
	$set_site = $_POST['set_site'];
	//Insert data
	$query3 = "UPDATE `sch_users` SET `status` = '$set_site'";
	if (mysqli_query($conn, $query3)){
		echo ('<script>alert("Updated")</script>');
	}	
}	
?>
<?php
$onsite="";$offsite="";
$result = mysqli_query($conn,"SELECT status FROM sch_users");
$row = mysqli_fetch_array($result);
$sitestate = $row['status'];
	if($sitestate == 1){
		$onsite = "checked";
	} else if ($sitestate == 3){
		$offsite = "checked";
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
            
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
						<i class="fa fa-history">&nbsp;&nbsp;</i>
						Maintenance | <?php echo 'SCHOOL MANAGEMENT SYSTEM';?></h3>
						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
								<div class="input-group-append">
									<button type="submit" class="btn btn-default">
										<i class="fas fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<form action="" method="post">
							<table>                 
								<tr>
									<td style="background:#FFF;">
										<div class="col-md-12">  
											<input name="set_site" type="radio" value="3" <?php echo $offsite;?>/> Deactivate Site for Maintenance 

											<p><input name="set_site" type="radio" value="1" <?php echo $onsite;?>/> Publish site
										</div>  
									</td>
								</tr>
								<tr>
									<td style="background:#FFF;" align="right">
										<div class="col-md-12">&nbsp;
											<input name="submit29" type="submit" value="Submit" class="btn btn-primary">
										</div>
									</td>
								</tr> 
							</table></br>
						</form> 
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
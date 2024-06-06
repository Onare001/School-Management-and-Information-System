<?php $page_title = "Graduated Students"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-graduation-cap"></i> Select Year Of Graduation</h3>
									<div style="float:right;">
										<a href="select_class" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a><p>
									</div>
									<form action="" method="post">
										<table border="0" align="center" style="border-collapse:collapse; width:100%;">
											<tr>
												<td width="100%">
													<select name="yid" id="select_year" class="form-control">
														<?php
														echo '<option value="">Select Year of Graduation</option>';
														$result = mysqli_query($conn,"SELECT * FROM year_info WHERE year_title < '$yearlim' OR year_title = '$yearlim'");
														while ($row = mysqli_fetch_array($result)){ 
														echo '<option value="'.$row["year_id"].'">'.$row["year_title"].'</option>';
														} ?><br/>
													</select>
												</td>  
												<td width="20%">
													<button type="reset" class="btn btn-danger">RESET</button>
												</td>
											</tr>
										</table>
									</form> 
								</div> 
								<div id="loader"></div>
								<table id="graduated_students">           
													
								</table>
							</div>
						</div>
					</div>
				</div>	
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<?php include ('include/ajax/process_table.php');?>
</html>
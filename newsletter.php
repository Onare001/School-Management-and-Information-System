<?php $page_title = "Dashboard"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_parent.php');?>
<?php
	$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE parent_contact='$username' LIMIT 1");
	$p_info = mysqli_fetch_assoc($result);
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
									<div class="col-12">
										<div class="card">
											<div class="card-header"><h3 class="card-title">Newsletter</h3></div>
											<div class="card-body">
												<div class="sch_address">
													<?php echo getSchName($sch_id);?></p>
													<?php echo getSchAddress($sch_id);?></p>
													<?php echo getSchPhone($sch_id);?></p>
												</div><br><br><br><br><br>
												<div class="parent_address">
													Mr. <?php echo $p_info['p_name'];?></p>
													<?php echo $p_info['address'];?>
												</div>
												<div class="letter">
													<br><br
													<p>&nbsp;&nbsp;&nbsp;&nbsp;Dear Parent,</p>
													<img src="<?php echo getSchlogo($sch_id);?>" alt="img" class="water_mark"/>
													<p class="heading"><u>NEWSLETTER FOR <?php echo getSession($ctid);?></p>
													<p style="font-size:20px;">Composed letter stays here</p>
												</div>
												<div class="sign">
													<b style="font-size:13px;">Principal's Signature/Stamp</b>
													<div class="signature-container">
														<img src="<?php echo getPSignature($sch_id);?>" alt="Signature" class="signature" style="width:200px;max-height:200px;"/><br/>
														<div class="date-overlay">
															<p><b><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d".'/'."m".'/'."Y");?></b></p>
															<i style="color:black;width:500px;font-size:14px;font-weight:bold"><?php echo getHeadTeacher($sch_id);?></i>
														</div>
													</div>
												</div>
											</div>
											<div class="button-container">
												<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>		
												<button align="center" type="submit" value="PRINT" onClick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</section>
						<style>
							.sch_address{
								float:right;
								width:400px;
							}
							p{
								margin:0px;
							}
							.parent-address{
								float:left;
								margin-top:500px;
								width:40px;
							}
							.heading{
								font-weight:bold;
								text-align:center;
							}
							.sign{
								float:right;
							}
							.water_mark{
								position:absolute; 
								width:500px;
								height:500px;
								margin-top:90px;
								margin-left:250px;
								opacity:0.2;
								padding:0px;
								display: list-item;
								list-style-image: url(images/<?php echo getSchlogo($sch_id);?>);
								list-style-position: inside;
							}
							.signature-container {
							  position: relative;
							  width: 100%;
							  height: auto;
							}
							.signature{
								 transform: rotate(-20deg);
							}
							.date-overlay {
							  position: absolute;
							  margin-top: -85px;
							  margin-left: 19%;
							  transform: translate(-45%, -50%);
							  color: black;
							  text-align: center;
							  padding: 20px;
							  transform: rotate(-10deg);
							  transform-origin: center;
							  font-size:13px;
							  font-style:italic;
							}

							.date-overlay p {
							  margin-bottom: 0;
							}
							 @page {
								size: A4 portrait;
								margin-top:10px;
								size: auto;   /* auto is the initial value */
								margin-bottom: 0;  /* this affects the margin in the printer settings */
							}
						</style>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
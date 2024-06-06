<?php $page_title = "Student ID Card"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id=""; $cat_id=""; $did="";$cid="";
if (isset($_GET['cid']) && isset($_GET['cat'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['cat']);
} else {
	header("location: select_class");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
			<div class="card" id="printableArea" style="margin-left:10px;margin-right:10px;width:auto;">
				<style>
				.id-card-holder {
					width: 250px;
					padding: 4px;
					margin: 0 auto;
					background-color: #1f1f1f;
					border-radius: 5px;
					position: relative;
					float: left;
					margin-right:10px;
					margin-top:80px;
					margin-bottom:10px;
				}
				.id-card {
					background-color: #fff;
					padding: 5px;
					border-radius: 10px;
					text-align: center;
					box-shadow: 0 0 1.5px 0px #b9b9b9;
					height:400px;
				}
				.id-card img {
					margin: 0 auto;
				}
				.photo img {
					width: 80px;
					margin-top: 5px;
				}
				h3 , h2 {
					font-size: 15px;
					margin: 2.5px 0;
					
				}
				.qr-code img {
					width: 50px;
				}
				.bg-success {
					background-color: green;
					color: white;
				}
				.water_mark {
					position: absolute;
					width: 200px;
					height: 200px;
					top: 70%;
					left: 50%;
					opacity:0.08;
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
				</style>
				<div style="margin-left:20px; margin-top:20px;">
					<?php
					$result = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE class_id = '$class_id' AND cat_id = '$cat_id' AND sch_id = '$sch_id' AND status_id = '1'");
					while ($row = mysqli_fetch_array($result)){
						$uid = $row["user_id"];
						$cid = $row["class_id"]; $did = $row["cat_id"]; $admn_no = $row["admn_no"];
					?>	
					<div class="id-card-holder">
						<div class="id-card">
							<div style="background-color:<?php echo $theme;?>;color:white;padding:5px;border-radius:30px;">
								<div class="header">
									<img src="<?php echo getSchLogo($sch_id);?>" style="width:20%;height:20%;" class="logo"/>
								</div>
								<text style="font-weight:bold;font-size:12px;font-family:Imprint MT Shadow;"><?php echo strtoupper(getSchname($sch_id));?></text>
							</div>
							<hr style="margin-top:0px;"></hr>
								<text style="font-size:14px;margin-top:0px;">
									<div class="badge bg-success" style="width:200px;">
										-------------- Student ID --------------
									</div>
								</text>
								<img src="<?php echo getSchLogo($sch_id);?>" alt="img" class="water_mark"/>
								<div class="photo">
									<img src="<?php echo getPassport($uid);?>" style="width:80px;height:90px;border:3px solid <?php echo $theme;?>"/>
								</div>
								<h2><?php echo getLastname($uid). '&nbsp;'. getFirstname($uid);?></h2>
								<h3><b><?php echo getUsername($uid);?></b></h3>
								<h3>Class: <?php echo getClass($cid).' '.getCategory($did)?></h3>
								<h3>Admn no: <?php echo $admn_no;?></h3>
								<!--hr-->
							<div class="qr-code">
								<img src="<?php
								// Include the QR code library
								require_once('assets/lib/phpqrcode/qrlib.php');
								// Get the username for the QR code
								$data = '('.strtoupper(getLastname($uid)).' '.strtoupper(getFirstname($uid)).') '.getUsername($uid). ' Class: '.getClass($cid).getCategory($did).'Year of admission: ????';
								// Generate the QR code and get the image data
								ob_start();
								QRcode::png($data, null, QR_ECLEVEL_Q);
								$qr_code = ob_get_contents();
								ob_end_clean();
								// Output the base64-encoded image data
								echo 'data:image/png;base64,' . base64_encode($qr_code);
							  ?>" style="max-width:50px;max-height:50px;"/>
							</div>
						</div>
					</div>
<?php } ?>
				</div>
			</div>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ("include/page_scripts/reducebtn.php"); ?> 
<?php include ('include/page_scripts/print.php');?>
</html>
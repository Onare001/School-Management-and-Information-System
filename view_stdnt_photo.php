<?php $page_title = "Student Photo Album"; ?>
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

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<style>
			div.gallery {
			  margin: 5px;
			  border: 1px solid #ccc;
			  float: left;
			  width: 140px;
			}

			div.gallery:hover {
			  border: 1px solid #777;
			}

			div.gallery img {
				width: 100%;
				height: 170px;
				margin-left: 15px;
				margin-right: 15px;
			}

			div.desc {
			  padding: 1px;
			  text-align: center;
			  font-size:9px;
			}
			</style>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<?php include ("include/regstu_menu.php"); ?> 
						</div>
						<div class="col-md-10">
							<div class="card" id="printableArea" style="margin-left:10px;margin-right:10px;width:auto;style="padding:10px;"">
								<div class="custom" style="background-color:darkblue;color:white;text-align:center;">Photo Album of Students in <?php echo getClass($class_id).''.getCategory($cat_id);?></div>
								<div style="margin:25px; margin-top:20px;">
									<?php
									$result = mysqli_query($conn,"SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id = sch_users.user_id WHERE stdnt_info.class_id = '$class_id' AND stdnt_info.cat_id = '$cat_id' AND sch_users.sch_id = '$sch_id' AND status_id = '1' ORDER BY sch_users.last_name ASC");
									while ($row = mysqli_fetch_array($result)){			
									 echo '<div class="gallery">
										<b>&nbsp;&nbsp;<i class="fa fa-camera" style="color:blue;font-size:15px;">&nbsp;</i>'.++$counter.'</b>
										<a target="_blank" href="edit_student?uid='.encrypt($row["user_id"]).'">
											<img src="'.getPassport($row["user_id"]).'" alt="'.getLastname($row["user_id"]).'" style="max-width:120px;max-height:140px;"/>
										</a>
										<div class="desc">
											'.strtoupper(getLastname($row["user_id"])).'&nbsp;'.strtoupper(getFirstname($row["user_id"])).'<br>
											'.getUsername($row["user_id"]).'<br/>
										</div>
									</div>';
								 } ?>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</section>			
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ("include/page_scripts/reducebtn.php"); ?> 
</html>
<?php $page_title = "Class Timetable"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<?php
$class_id=""; $cat_id=""; $did="";$cid="";
if (isset($_GET['cid']) && isset($_GET['cat'])) {
    $class_id = decrypt($_GET['cid']);
    $cat_id = decrypt($_GET['cat']);
} else {
	header("location: view_class_timetable");
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?> 
		  
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Class Timetable | <?php echo getClass($class_id).'&nbsp;'.getCategory($cat_id);?></h3>
						</div>
						<div class="card-body" style="margin:0px auto;">
							<?php include("include/timetables/class_timetable.php");?>
						</div>
						<div class="button-container">
							<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</button>		
							<button type="submit" name="print" value="PRINT" '+' onClick="javascript:window.print()" id="buttonn" class="btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
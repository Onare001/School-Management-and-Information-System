<?php $page_title = "Site Maintenance"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_web.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
            
			<section class="content" id="classes">	
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
							<i class="fa fa-history">&nbsp;&nbsp;</i>
							Activity Log | <?php echo 'SCHOOL MANAGEMENT SYSTEM';?></h3>
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
						<div style="margin-left:10px;" class="card-body table-responsive p-0">
							<text style="font-size:14px;width:2px;">
								<?php  echo html_entity_decode(file_get_contents('activity.txt'));?>
							</text>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
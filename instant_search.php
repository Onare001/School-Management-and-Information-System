<?php $page_title = "Search"; ?>
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
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div style="width:50%;margin:0px auto">
										<div class="input-group">
											<input type="text" name="" id="search" placeholder="Search by Name or Student ID" class="form-control form-control-lg" placeholder="Type your keywords here"/>
											<div class="input-group-append">
												<button type="submit" class="btn btn-lg btn-default">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div id="search_results"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>		
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<script type="text/javascript" src="include/jquery/jquery.js"></script>
<script type="text/javascript" src="include/jquery/search.js"></script>
</html>
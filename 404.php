<?php $page_title = "404"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>

<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>  
			<section class="content">
				<div class="error-page">
					<h2 class="headline text-warning"> 404</h2>
					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
						<p>We could not find the page you were looking for.
						Meanwhile, you may <a href="#">return to dashboard</a> or try using the search form.</p>
						<form class="search-form">
							<div class="input-group" data-widget="sidebar-search">
								<input type="text" name="search" class="form-control form-control-sidebar" placeholder="Search">
								<div class="input-group-append">
									<button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>	
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
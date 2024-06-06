<?php $page_title = "Subscription History"; ?>
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
									<h3 class="card-title">Subscription History</h3>
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="width: 10px">#</th>
												<th>Reference</th>
												<th>Subscription</th>
												<th>Duration</th>
												<th>Starts</th>
												<th>Expires</th>
												<th style="width: 40px">Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1.</td>
												<td>TRN67346</td>
												<td>Complete Service of SMS</td>
												<td>1 year  
												<div class="progress progress-xs">
												<div class="progress-bar progress-bar-danger" style="width: 55%"></div>
												</div>
												</td>
												<td>April 2023</td>
												<td>April 2024</td>
												<td><span class="badge bg-success">active</span></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="card-footer clearfix">
									<ul class="pagination pagination-sm m-0 float-right">
										<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
										<li class="page-item"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
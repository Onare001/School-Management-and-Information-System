<?php $page_title = "Ward Activity"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_parent.php');?>
<?php
if(isset($_GET['uid'])){
	$uid = decrypt($_GET['uid']);
} else {
	//header('location: index');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

				<section class="content">
					<div class="card card-solid">
						<div class="card-body pb-0">
							<div class="row">
								<?php
								$result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info  WHERE parent_contact='$username'");
								while ($row = mysqli_fetch_array($result)){	
								?>
								<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
									<div class="card bg-light d-flex flex-fill">
										<div class="card-header text-muted border-bottom-0"><?php echo getUsername($row['user_id']);?></div>
										<div class="card-body pt-0">
											<div class="row">
												<div class="col-7">
													<h2 class="lead"><b><?php echo getFirstName($row['user_id']);?></b></h2>
													<p class="text-muted text-sm"><b>Class: </b> <?php echo getClass($row['class_id']).getCategory($row['cat_id']);?></p>
													<p class="text-muted text-sm"><b>Status: </b> <?php echo getStatus($row['user_id'])?></p>
								<p class="text-muted text-sm"><b>Term Payment Status: </b> <?php echo getCPaymentStatus($row['user_id'], $ctid, $csid, '1');?></p>
												</div>
												<div class="col-5 text-center"><img src="<?php echo getPassport($row['user_id']);?>" alt="user-avatar" class="img-circle img-fluid"></div>
											</div>
										</div>
										<div class="card-footer">
											<div class="text-right">
												<a href="edit_ward?uid=<?php echo encrypt($row["user_id"]); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
												<a href="pay_sch_fee2?uid=<?php echo encrypt($row['user_id']); ?>&pt=<?php echo encrypt($pt=""); ?>" class="btn btn-sm btn-primary"><i class="fas fa-credit-card"></i> Pay fees</a>
												<a href="check_ward_result?uid=<?php echo encrypt($row["user_id"]); ?>" class="btn btn-sm btn-primary"><i class="fas fa-percent"></i> View Result</a>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>	       
						</div>
					</div>
				</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
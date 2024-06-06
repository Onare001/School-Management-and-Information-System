<?php $page_title = "Select Class"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit'])) {
    $class_id = addslashes($_POST['class_id']);
    $cat_id = addslashes($_POST['cat_id']);
    if (empty($class_id)) {
        $msg = 'Select a Class';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($cat_id)){
		$msg = 'Select Class Category';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class_cat.mp3" type="audio/mpeg">
			</audio>';
	} else {
        header("location: register_student?cid=".encrypt($class_id)."&cat=".encrypt($cat_id)."");
    }
}
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
							<div class="col-md-3">
								<div class="sticky-top mb-3">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Class List | Shortcut</h4>
										</div>
										<div class="card-body">
											<div id="external-events">
											  <?php
												$color_list = array('0','bg-success','bg-warning','bg-primary','bg-danger','bg-success','bg-warning','bg-primary','bg-danger','bg-info');
												$result = mysqli_query($conn,"SELECT DISTINCT class_id, cat_id FROM stdnt_info WHERE class_id<$class_limit GROUP BY class_id,cat_id");
													while($class = mysqli_fetch_array($result)){
														echo '<a href="'.navigate('register_student').'?cid='.encrypt($class['class_id']).'&cat='.encrypt($class['cat_id']).'"><div class="external-event '.$color_list[$class['class_id']].'">'.getClass($class['class_id']).getCategory($class['cat_id']).'---('.getTotal_in_class($sch_id,$class['class_id'],$class['cat_id']).')'.'</div></a>';
													}
												?>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">..........</h3>
										</div>
										<div class="card-body">
											<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
												<ul class="fc-color-picker" id="color-chooser">
													<li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
												</ul>
											</div>
											<div class="input-group">
												<input id="new-event" type="text" class="form-control" placeholder="Placeholder">
												<div class="input-group-append">
													<button id="add-new-event" type="button" class="btn btn-primary" disabled>Add</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<div class="card card-primary">
									<div class="card-body p-0">
										<div class="card card-primary" id="selectbox" style="margin-top:50px;margin-bottom:50px;">
											<div class="card-header"><h3 class="card-title">Select Class & Category | View Class List</h3></div>
											<form action="" method="post">
												<div class="card-body">
													<?php if (isset($msg)){ echo $msg_toastr; } ?>
													<div class="form-group">
														<label>Class</label>
														<select name="class_id" id="sel_class" class="form-control">
															<?php
															echo '<option value="">'.'Select Class'.'</option>';
															$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
															while ($row = mysqli_fetch_array($result)){
															echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
														</select>
													</div>
													<div class="form-group">
														<label>Category</label>
														<select name="cat_id" id="sel_cat" class="form-control">
															<?php
															echo '<option value="">'.'Select Category'.'</option>';
															$result = mysqli_query($conn,"SELECT * FROM class_cat");
															while ($row = mysqli_fetch_array($result)){
															echo '<option value="'.$row["cat_id"].'">'.$row["category"].'</option>'; } ?><br/>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button onclick="goBack()" id="buttonn" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back </button>
													<button type="submit" name="submit" class="btn btn-primary">Proceed</button>         
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>	
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
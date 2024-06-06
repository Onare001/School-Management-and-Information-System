<?php $page_title = "Lession Note"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
if (isset($_POST['submit'])) {
    $class_id = $_POST['class_id'];
    //$cat_id = $_POST['cat_id'];
    //$subj_id = $_POST['subj_id'];
    $term_id = $_POST['term_id'];
    //$session_id = $_POST['session_id'];
    if (empty($class_id)) {
        $msg = 'Please select a Class!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_class.mp3" type="audio/mpeg">
			</audio>';
    } else if (empty($term_id)) {
        $msg = 'Please select a Term!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		echo '<audio controls'.$autoplay.'hidden>
				<source src="audio/msg_select_term.mp3" type="audio/mpeg">
			</audio>';
    } else {
            header("location: subject_lession_note?cid=" . encrypt($class_id)."&tid=" . encrypt($term_id));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
       
			<div class="card card-primary" id="selectbox">
				<div class="card-header">
					<h3 class="card-title">Lesson Note</h3>
				</div>
				<div class="card-body">
					<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo $msg_toastr;} ?></center>
					<form action="" method="post">		   
						<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
							<tr>
								<td align="left">
									<div class="col-md-12"> 
										<select name="class_id" id="sel_class" style="width:100%;" class="form-control">
											<?php
											echo '<option value="">Select Class</option>';
											$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
											} ?>
										</select>
									</div>
								</td>		
							</tr>
							<tr>
								<td>
									<div class="col-md-12">    
										<select name="term_id" id="sel_term" class="form-control">	
											<?php
											echo '<option value="">Select Term</option>';
											$result = mysqli_query($conn,"SELECT * FROM term_info");
											while ($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
											} ?>
										</select>
									</div>  
								</td>
							</tr>
						</table>
						<div class="modal-footer">
							<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
							<input name="submit" type="submit" value="Continue" class="btn btn-primary"/>
						</div>
					</form>    
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<?php include ('include/page_scripts/options.php');?>
</html>
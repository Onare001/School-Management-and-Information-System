<?php $page_title = "Lession Note"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id = $term_id="";
if (isset($_GET['cid']) && isset($_GET['tid'])) {
    $class_id = decrypt($_GET['cid']);
    $term_id = decrypt($_GET['tid']);
} else {
	header("location: sch_lession_note");
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
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo '<text>'.$msg.'</text>';} ?></center>
									<h3 class="card-title"></h3>	
									Lession Note
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead class="custom">
											<tr>
												<th align="center" style="width:5%;">S/N</th>
												<th align="center" style="width:60%;">Subject</th>
												<th align="center">Class</th>
												<th align="center" style="width:20%;">Term</th>
												<th align="center">#Notes</th>
												<th align="center"style="width:20%;">View</th>
											</tr>
										</thead>
										<tbody>	
												<?php
												$result = mysqli_query($conn,"SELECT * FROM subj_info");
												while ($row = mysqli_fetch_array($result)){
												?>
												<tr>
													<td align="center"><?php echo ++$counter;?></td>
													<td align="left" class="pad"><?php echo getSubject($row['subj_id']);?></td>
													<td align="center" class="pad"><?php echo getClass($class_id);?></td>
													<td align="center" class="pad"><?php echo getTerm($term_id);?></td>
													<td align="center" class="pad"><?php echo CountLessonNote($row['subj_id'], $class_id);?></td>
													<td align="center" class="pad"><?php echo '<a onclick="window.open(\'preview_notes.php?sid='.encrypt($row['subj_id']).'&cid='.encrypt($class_id).'&tid='.encrypt($term_id). '\', \'_blank\', \'width=800,height=600\')" class="btn btn-primary btn-block"> Open</a>';?></td>
												</tr>
						<?php } ?>
											</tbody>			
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<style>
			tr {
			  height: 5px;
			}
			</style>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
</html>
<?php $page_title = "Lesson Note"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php
$class_id = $term_id="";
if (isset($_GET['sid']) && ($_GET['cid']) && isset($_GET['tid'])) {
    $subj_id = decrypt($_GET['sid']);
	$class_id = decrypt($_GET['cid']);
    $term_id = decrypt($_GET['tid']);
} else {
	header("location: sch_lession_note");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>
	<style>
		.footer{
			background: darkblue;
			text-align:center;
			color:white;
			padding:10px;
		}
	</style>
	<body style="margin:50px;">
		<div style="background-color:darkblue;display:flex;padding:10px;margin:10px;">
			<div style="float:left"><img src="<?php echo getSchLogo($sch_id);?>" width="90px" height="90px" class="img-circle"/></div>
			<th class="text-center"><h2 style="font-family:Imprint MT Shadow; color:white;margin:0px auto;"><span><?php echo getSchName($sch_id);?></span></h2></th>
		</div>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<center style="margin-bottom:10px;"><?php if (isset($msg)) { echo '<text>'.$msg.'</text>';} ?></center>
								<h3 class="card-title"></h3>	
								Lesson Note | <?php echo getSubject($subj_id).'   '.getClass($class_id).'    '.getTerm($term_id);?>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead class="custom">
										<tr>
											<th align="center" style="width:5%;">WEEK(s)</th>
											<th align="center" style="width:60%;">TOPIC(s)</th>
											<th align="center"style="width:10%;">VIEW</th>
										</tr>
									</thead>
									<tbody>	
											<?php
											$result = mysqli_query($conn,"SELECT * FROM lesson_notes WHERE subj_id='$subj_id' AND class_id='$class_id' AND term_id='$term_id'");
											while ($row = mysqli_fetch_array($result)){
											?>
											<tr>
												<td class="pad"><botton class="btn btn-success btn-block"><?php echo 'Week '.$row['week'];?></td>
												<td align="left" class="pad"><?php echo $row['topic'];?></td>
												<td align="center" class="pad"><?php
													if(!empty(getLessonNote($subj_id, $class_id, $term_id, $row['week']))){
														echo '<a onclick="window.open(\'display_lesson_note.php?url='.base64_encode('lesson_notes/'.getLessonNote($subj_id, $class_id, $term_id, $row['week'])).'&topic='.base64_encode($row['topic']). '\', \'_blank\', \'width=800,height=600\')" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a>';
													} else {
														echo '<a link.href="#" class="btn btn-danger btn-block"><i class="fa fa-download"></i> Download</a>';
													}
													?></td>
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
		<div class="footer">
			<div class="layout-footer-body">
				<small class="copyright">Copyright © 2023 SMS. Powered by Niel Technologies +2348145162722. All Rights Reserved.</a></small>
			</div>
		</div>
	</body>
<?php include ('include/page_scripts/datatables.php');?>
</html>
<?php $page_title = "Graduated Students"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-graduation-cap"></i> Select Year Of Graduation</h3>
									<div style="float:right;">
										<a href="select_class.php" style="font-size:16px; font-weight:bold;"><div class="btn btn-primary"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i> Back </div></a><p>
									</div>
									<form action="" method="post">
										<table border="0" align="center" style="border-collapse:collapse; width:100%;">
											<tr>
												<td>
													<select name="yid" id="select_year" class="form-control">
														<option value="">Select Year of Graduation</option>
														<?php
														$result = mysqli_query($conn,"SELECT * FROM year_info WHERE year_title < '$yearlim' OR year_title = '$yearlim'");
														while ($row = mysqli_fetch_array($result)){	?>
														<option value="<?php echo $row["year_id"];?>"><?php echo $row["year_title"];?></option>
														<?php } ?>
													</select>
												</td>  
											</tr> 
										</table>
									</form> 
								</div> 
								<!--div id="loader"> </div-->
								<div id="graduated_students"> </div>
							</div>
						</div>
					</div>	
			</section>
<?php include('include/footer.php');?>
<?php include ('include/page_scripts/datatables.php');?>
<script>
$(document).ready(function() {    
    $('#select_year').on('change', function() {
		$("#loader").show();
            var yid = this.value;
            $.ajax({
                url: "process_table2.php",
                type: "POST",
                data: {
                    yid: yid
                },
                cache: false,
                success: function(result){
					$("#loader").hide();
					$("#graduated_students").show();
                    $("#graduated_students").html(result);
                }
            });
		});
	});
</script>
</html>
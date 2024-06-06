<?php
if ($priviledge == 1){
	$url = 'admin_read_message2.php?mid=';
} else if ($priviledge == 2 || $priviledge > 4){
	$url = 'staff_read_message2.php?mid=';
}else if ($priviledge == 3){
	$url = 'stdnt_read_message2.php?mid=';
}
?> 
<?php
$rowperpage = 10;
$roww = 0;

// Previous Button
if(isset($_POST['but_prev'])){
	$roww = $_POST['row'];
	$roww -= $rowperpage;
	if( $roww < 0 ){
		$roww = 0;
	}
}

// Next Button
if(isset($_POST['but_next'])){
	$roww = $_POST['row'];
	$allcount = $_POST['allcount'];

	$val = $roww + $rowperpage;
	if( $val < $allcount ){
		$roww = $val;
	}
}
//Counting the number of Sentbox
	$allcount = getNumsentbox($user_id);
?> 
					<div class="col-md-9">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">Sentbox (<?php echo getNumsentbox($user_id);?>)</h3>
								<div class="card-tools">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control" placeholder="Search Mail"/>
										<div class="input-group-append">
											<div class="btn btn-primary">
												<i class="fas fa-search"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body p-0">
								<div class="mailbox-controls">
									<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
									<div class="btn-group">
									  <button type="button" class="btn btn-default btn-sm">
										<i class="far fa-trash-alt"></i>
									  </button>
									  <button type="button" class="btn btn-default btn-sm">
										<i class="fas fa-reply"></i>
									  </button>
									  <button type="button" class="btn btn-default btn-sm">
										<i class="fas fa-share"></i>
									  </button>
									</div>
									<button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
									<div class="float-right">
										<div class="pull-right">  
											<form method="post" action="">
												<div id="div_pagination" class="btn-group">
													<input type="hidden" name="row" value="<?php echo $roww; ?>">
													<input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
													<input type="submit" class="button" name="but_prev" value="Previous">
													<input type="submit" class="button" name="but_next" value="Next">
												</div>
											</form>
										</div>
									</div>
									<div class="table-responsive mailbox-messages">
										<table class="table table-hover table-striped">
											<tbody>
												<?php
												$inbox = "SELECT * FROM messages WHERE sch_id = '$sch_id' AND sender = '$user_id' ORDER BY message_id DESC LIMIT $roww,".$rowperpage;
												$result = mysqli_query($conn,$inbox);
												while ($row = mysqli_fetch_array($result)){
													$receiver = $row['receiver'];
													$sender = $row['sender'];
													$message_id = $row['message_id'];
													$subject = $row['subject'];
												?>
													<tr>
														<td><input type="checkbox" /></td>
														<td class="mailbox-star">
														<a href="#"><!--i class="fa fa-star text-yellow"></i--><img src="<?php echo getPassport($receiver);?>" alt="<?php echo getLastname($user_id);?>" style="max-width:40px;" class="img-circle"/>
														</a></td>
														<td class="mailbox-name" style="width:5%;"><a href="<?php echo $url; echo base64_encode($row["message_id"]); ?>">
														<?php  echo getUsername($receiver); ?>
														</a></td>
														<td class="mailbox-subject"><b>Subject</b> - <?php echo $subject;?>...</td>
														<td class="mailbox-attachment"></td>
														<td class="mailbox-date"><?php echo getMTime($message_id);?></td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer p-0">
									<div class="mailbox-controls">
										<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-sm">
												<i class="far fa-trash-alt"></i>
											</button>
											<button type="button" class="btn btn-default btn-sm">
												<i class="fas fa-reply"></i>
											</button>
											<button type="button" class="btn btn-default btn-sm">
												<i class="fas fa-share"></i>
											</button>
										</div>
										<button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
										<div class="float-right">
											<form method="post" action="">
												<div id="div_pagination" class="btn-group">
													<input type="hidden" name="row" value="<?php echo $roww; ?>"/>
													<input type="hidden" name="allcount" value="<?php echo $allcount; ?>"/>
													<input type="submit" class="button" name="but_prev" value="Previous"/>
													<input type="submit" class="button" name="but_next" value="Next"/>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<script>
  $(function () {
	//Enable check and uncheck all functionality
	$('.checkbox-toggle').click(function () {
	  var clicks = $(this).data('clicks')
	  if (clicks) {
		//Uncheck all checkboxes
		$('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
		$('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
	  } else {
		//Check all checkboxes
		$('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
		$('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
	  }
	  $(this).data('clicks', !clicks)
	})

	//Handle starring for font awesome
	$('.mailbox-star').click(function (e) {
	  e.preventDefault()
	  //detect type
	  var $this = $(this).find('a > i')
	  var fa    = $this.hasClass('fa')

	  //Switch states
	  if (fa) {
		$this.toggleClass('fa-star')
		$this.toggleClass('fa-star-o')
	  }
	})
  })
</script>

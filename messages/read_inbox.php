<?php
if(isset($_GET['mid'])){
$mid = base64_decode($_GET['mid']);
$inbox = "SELECT * FROM messages WHERE sch_id = '$sch_id' AND receiver = '$user_id' AND message_id = '$mid'";
		$result = mysqli_query($conn,$inbox);
		mysqli_query($conn,"UPDATE `messages` SET `message_status` = '0' WHERE `messages`.`message_id` = $mid");
		while ($row = mysqli_fetch_array($result)){
			$receiver = $row['receiver'];
			$sender = $row['sender'];
			$message_id = $row['message_id'];
			$subject = $row['subject'];
			$datetime = $row['datetime'];
			$content = $row['content'];
			$attachment = $row['attachment'];
		}
}
?>				<!-- Read Message -->
					<div class="col-md-9">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">Read Mail(Inbox)</h3>
								<div class="card-tools">
									<a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
									<a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
							<div class="card-body p-0">
								<div class="mailbox-read-info">
									<h5><?php echo $subject;?></h5>
									<h6>From: <?php echo getUsername($sender);?><p>
									Name: <?php echo getLastname($sender).'&nbsp;'.getFirstname($sender);?>
									<span class="mailbox-read-time float-right"><?php echo $datetime;?><p></span></h6>
								</div>
								<div class="mailbox-controls with-border text-center">
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
											<i class="far fa-trash-alt"></i>
										</button>
										<button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
											<i class="fas fa-reply"></i>
										</button>
										<button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
											<i class="fas fa-share"></i>
										</button>
									</div>
									<button type="button" class="btn btn-default btn-sm" title="Print">
										<i class="fas fa-print"></i>
									</button>
								</div>
								<div class="mailbox-read-message">
									<?php echo $content;?>
								</div>
							</div>
							<div class="card-footer bg-white">
								<ul class="mailbox-attachments d-flex align-items-stretch clearfix">
									  <?php
									  $attach = substr($attachment,-3);
										if ($attach == "pdf") {//
										echo '<li>
										  <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
										  <div class="mailbox-attachment-info">
											<a href="messages/attachment/'.$attachment.'" target="_blank" class="mailbox-attachment-name">
											<i class="fas fa-paperclip"></i>'.$attachment.'</a>
												<span class="mailbox-attachment-size clearfix mt-1">
												  <span>unknown file size</span>
												  <a href="messages/attachment/'.$attachment.'" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
												</span>
										  </div>
										</li>';
										} else if ($attach == "docx"){
											echo '<li>
										  <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>
										  <div class="mailbox-attachment-info">
											<a href="messages/attachment/'.$attachment.'" target="_blank" class="mailbox-attachment-name">
											<i class="fas fa-paperclip"></i>'.$attachment.'</a>
												<span class="mailbox-attachment-size clearfix mt-1">
												  <span>unknown file size</span>
												  <a href="messages/attachment/'.$attachment.'" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
												</span>
										  </div>
										</li>';
										} else if($attach == "JPG" || $attach == "PNG"){
											echo '<li>
										  <span class="mailbox-attachment-icon has-img"><img src="messages/attachment/'.$attachment.'" alt="attachment"></span>
										  <div class="mailbox-attachment-info">
											<a href="messages/attachment/'.$attachment.'" target="_blank" class="mailbox-attachment-name">
											<i class="fas fa-paperclip"></i>'.$attachment.'</a>
												<span class="mailbox-attachment-size clearfix mt-1">
												  <span>unknown file size</span>
												  <a href="messages/attachment/'.$attachment.'" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
												</span>
										  </div>
										</li>';
										} else if(empty($attachment)){
											echo '';
										} else {
											echo '<li>
										  <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
										  <div class="mailbox-attachment-info">
											<a href="messages/attachment/'.$attachment.'" target="_blank" class="mailbox-attachment-name">
											<i class="fas fa-paperclip"></i>'.$attachment.'</a>
												<span class="mailbox-attachment-size clearfix mt-1">
												  <span>unknown file size</span>
												  <a href="messages/attachment/'.$attachment.'" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
												</span>
										  </div>
										</li>';
										}
									  ?>
								</ul>
							</div>
							<div class="card-footer">
								<div class="float-right">
									<button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
									<button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
								</div>
									<button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
									<button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php //include 'upload_attachment.php';?>
<?php	    
if (isset($_POST['submit'])){
	$sender = addslashes($_POST['user_id']);
	$receiver = addslashes($_POST['receiver']);
	
	$recrid = getUserid($receiver);
	
	$subject = addslashes($_POST['subject']);
	$content = addslashes($_POST['content']);
	
	$validate_username = mysqli_query($conn,"SELECT * FROM sch_users");
	$row = mysqli_fetch_assoc($validate_username);
	$real_addr = $row['username'];
	
	$maxsize = 320000000; // 200KB#  
	$file_name = $_FILES['file_name']['name'];
	$target_dir = "messages/attachment/";
	$target_file = $target_dir . $_FILES["file_name"]["name"];
	 // Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("pdf","jpg","png","docx");

	// Check extension
	if ( in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			echo '<span class="badge bg-danger">'.'file too large. file must be less than 200KB.'.'</span>';
		} else {
			//Send message with Attachment
			$message = "INSERT INTO `messages`(sch_id, sender, receiver, subject, content, attachment) VALUES ('$sch_id','$sender','$recrid','$subject','$content','$file_name')";
			$result = mysqli_query($conn,$message);
				if ($result){ echo ('<script>alert("Message Sent")</script>'); }
				// Upload
			if (move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
				$msg = '<span class="badge bg-success">'.'Message Sent with Attachment Successfully.'.'</span>';				
			} else {
				
			}	
		}
	} else if ($receiver != ($real_addr)) {
		$msg = '<span class="badge bg-danger">'.'Invalid Reciever\'s Address'.'</span>';
	} else {
	   $msg = '<span class="badge bg-danger">'.'Invalid File'.'</span>';
	   //Send message without Attachment
		$message2 = "INSERT INTO `messages`(sch_id, sender, receiver, subject, content) VALUES ('$sch_id','$sender','$recrid','$subject','$content')";
			$result2 = mysqli_query($conn,$message2);
		if ($result2){ echo ('<script>alert("Message Sent")</script>'); }
	}
}
$muid="";
if (isset($_GET['uid'])){
	$muid = decrypt($_GET['uid']);
}
?>	  
					<!-- Main content -->
					<div class="col-md-9">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">Compose New Message</h3>
							</div>
							<center><?php if (isset($msg)){ echo $msg; } ?></center>
							<div class="card-body">
								<div class="form-group">
									<form role="form" action="" method="post" enctype="multipart/form-data"/>
										<input name="user_id" type="hidden" value="<?php echo $user_id;?>"/>	
										<input class="form-control" name="receiver" value="<?php echo getUsername($muid);?>" placeholder="To: username@sms.com" required/>
								</div>
								<div class="form-group">
									<input class="form-control" name="subject" placeholder="Subject:" required/>
								</div>
								<div class="form-group">
									<textarea id="compose-textarea" placeholder="Type your Message here" name="content" class="form-control" style="height:300px;">
									</textarea>
								</div>
								<div class="form-group">
									<div class="btn btn-default btn-file">
										<i class="fas fa-paperclip"></i> Attachment
										<input type="file" name="file_name">
									</div>
									<p class="help-block">Max. 32MB</p>
								</div>
							</div>
							<div class="card-footer">
								<div class="float-right">
									<button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
									<button type="submit" name="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
									</form>
								</div>
								<button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
							</div>
						</div>
					</div>
				</div>
			</section>

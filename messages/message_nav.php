<?php
if (($_SERVER['PHP_SELF']) == ("/superschool/admin_messages.php") || ($_SERVER['PHP_SELF']) == ("/superschool/staff_messages.php") || ($_SERVER['PHP_SELF']) == ("/superschool/stdnt_messages.php")){
	$inbox = 'active';
} else if (($_SERVER['PHP_SELF']) == ("/superschool/admin_sent_messages.php") || ($_SERVER['PHP_SELF']) == ("/superschool/staff_sent_messages.php") || ($_SERVER['PHP_SELF']) == ("/superschool/stdnt_sent_messages.php")){
	$sentbox = 'active';
	$inbox = 'active';
} else {
	$inbox = 'active';
}
?>
<?php
if ($priviledge == 1){
	$url1 = 'admin_compose';//compose
	$url2 = 'admin_messages';//inbox
	$url3 = 'admin_sent_messages';//sentbox
} else if ($priviledge == 2 OR $priviledge > 4){
	$url1 = 'staff_compose';//compose
	$url2 = 'staff_messages';//inbox
	$url3 = 'staff_sent_messages';//sentbox
}else if ($priviledge == 3){
	$url1 = 'stdnt_compose.php';//compose
	$url2 = 'stdnt_messages.php';//inbox
	$url3 = 'stdnt_sent_messages.php';//sentbox
}
?>		
			<section class="content">
				<div class="row">
					<div class="col-md-3">
						<a href="<?php echo $url1;?>" class="btn btn-primary btn-block mb-3">Compose</a>
						<div class="card">
							<div class="card-header">
							  <h3 class="card-title">Folders</h3>
								<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
								</button>
								</div>
							</div>
							<div class="card-body p-0">
								<ul class="nav nav-pills flex-column">
									<li class="nav-item <?php echo $inbox;?>">
										<a href="<?php echo $url2;?>" class="nav-link">
											<i class="fas fa-inbox"></i> Inbox
											<span class="badge bg-primary float-right"><?php if (getNuminbox($user_id)>0){
											echo getNuminbox($user_id);	} else { echo '0';}	?></span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo $url3;?>" class="nav-link">
											<i class="far fa-envelope"></i> Sent
											<span class="badge bg-primary float-right"><?php echo getNumsentbox($user_id);?></span>
										</a>
									</li>
									<!--li class="nav-item">
										<a href="#" class="nav-link">
											<i class="far fa-file-alt"></i> Drafts
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="fas fa-filter"></i> Junk
											<span class="badge bg-warning float-right">65</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="far fa-trash-alt"></i> Trash
										</a>
									</li-->
								</ul>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Labels</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body p-0">
								<!--ul class="nav nav-pills flex-column">
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="far fa-circle text-danger"></i> Important
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="far fa-circle text-warning"></i> Promotions
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="far fa-circle text-primary"></i> Social
										</a>
									</li>
								</ul-->
							</div>
						</div>
					</div>
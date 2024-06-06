<?php
if ($priviledge == 1){
	$url = 'edit_staff?uid='.encrypt($user_id);//'lock_screen'.'?u='.$user_id;//Lock Admin
	$url1 = 'admin_messages';//Admin Messages
	$url2 = 'admin_read_messages';//Read Admin Messages-inbox
} else if($priviledge == 2 || $priviledge > 4){
	$url = 'edit_staff_profile';//Edit Staff
	$url1 = 'staff_messages';//Staff Messages
	$url2 = 'staff_read_messages';//Read Staff Messages-inbox
} else if($priviledge == 3){
	$url = 'edit_stdnt_profile';//Edit Student
	$url1 = 'stdnt_messages';//Student Messages
	$url2 = 'stdnt_read_messages';//Read Student Messages-inbox
}

// Latest Messages
function getLatestMessage($user_id, $sch_id){
    include "include/connection.php";
    $result = mysqli_query($conn,"SELECT * FROM messages WHERE receiver='$user_id' AND sch_id='$sch_id' AND message_status='0'");
    while ($row = mysqli_fetch_array($result)){
    $subject = $row['subject']; $id = $row['sender'];
    return $subject;
	}
}

if ($priviledge < '4'){
	$displayName = getFirstname($user_id).'&nbsp;'.getLastname($user_id);
} else if ($priviledge == '4'){
	$displayName = 'DANIEL TAYO ONARE';
} else if ($priviledge > '4' && $priviledge < '10'){
	$displayName = getFirstname($user_id).'&nbsp;'.getLastname($user_id);
} else if ($priviledge == '10'){
	$displayName = $p_info['p_name'];
} else {
	$displayName = '';
}
?>
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link"><marquee><?php echo strtoupper(getSchname($sch_id));?></marquee></a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				<li class="nav-item">
					<a class="nav-link" data-widget="navbar-search" href="#" role="button">
						<i class="fas fa-search"></i>
					</a>
					<div class="navbar-search-block">
						<form class="form-inline">
							<div class="input-group input-group-sm">
								<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
								<div class="input-group-append">
									<button class="btn btn-navbar" type="submit">
										<i class="fas fa-search"></i>
									</button>
									<button class="btn btn-navbar" type="button" data-widget="navbar-search">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="user_guide?utyp=<?php echo getPriviledge($priviledge);?>" role="button">
						<i class="fas fa-question-circle" title="help"></i>
					</a>
				</li>
				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="fa fa-envelope"></i>
						<span class="badge badge-danger navbar-badge"><?php if (getNumUinbox($user_id)>0){
							echo getNumUinbox($user_id);
							} else {
							echo '0';}
							?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="<?php echo getPassport($user_id);?>" alt="User Avatar" class="img-size-50 mr-3 img-circle"/>
								<div class="media-body">
									<h3 class="dropdown-item-title">
										<span class="float-right text-sm text-danger">
											<i class="fas fa-star"></i>
										</span>
									</h3>
									<p class="text-sm"><?php echo getLatestMessage($user_id, $sch_id);?>...</p>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 0 Hours Ago</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="<?php echo $url1;?>" class="dropdown-item dropdown-footer">See All Messages</a>
					</div>
				</li>
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">0</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">0 Notification</span>
						<div class="dropdown-divider"></div>
						<a href="<?php echo $url1;?>" class="dropdown-item"><i class="fas fa-envelope mr-2"></i><?php if (getNumUinbox($user_id)==1){
								echo 'You have'.'&nbsp;'. getNumUinbox($user_id).'&nbsp;'.'Unread message';
								} else if (getNumUinbox($user_id)>1){
								echo 'You have'.'&nbsp;'. getNumUinbox($user_id).'&nbsp;'.'Unread messages';
								}else {
								echo 'You do not have any new message';
								} ?></a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-users mr-2"></i> Notification
							<span class="float-right text-muted text-sm">12 hours</span>
						</a>
					</div>
				</li>
				<li class="nav-item dropdown user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo ($priviledge == 4) ? 'passport/'.$passport.'' : getPassport($user_id);?>" class="user-image img-circle elevation-2" alt="User Image"/>
						<span class="d-none d-md-inline"><?php echo $displayName;?></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<!-- User image -->
						<li class="user-header bg-<?php echo $sch_color;?>" style="height:50%;">
							<img src="<?php echo ($priviledge == 4) ? 'passport/'.$passport.'' : getPassport($user_id);?>" class="img-circle elevation-2" alt="User Image"/>
							<p style="font-size:25px;"><?php echo getPriviledge($priviledge);?></p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<a href="<?php echo $url;?>" class="btn btn-success btn-flat"><i class="fa fa-user"></i> Profile </a>
							<a href="./logout?lt=<?php echo base64_encode($user_id);?>" class="btn btn-danger btn-flat float-right"><i class="fa fa-flask"></i> Sign out</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>
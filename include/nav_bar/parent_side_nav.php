					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="<?php echo Navigate('parent_dashboard');?>" class="nav-link">
									<i class="nav-icon fa fa-home text-warning"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo Navigate('ward_action');?>" class="nav-link">
									<i class="nav-icon fa fa-user text-warning"></i>
									<p>My Ward(s) <i class="right fas fa-angle-left"></i></p>
								</a>
								<?php $ward = mysqli_query($conn,"SELECT user_id FROM stdnt_info WHERE parent_contact='$username'");
									while($row = mysqli_fetch_assoc($ward)){
									echo '<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="'.Navigate('ward_action').'?uid='.encrypt($row['user_id']).'" class="nav-link">
											<i class="fa fa-plus nav-icon"></i>
											<p>'.getFirstName($row['user_id']).'</p>
										</a>
									</li>
								</ul>';
								} ?>	
							</li>
							<li class="nav-item">
								<a href="<?php echo Navigate('newsletter');?>" class="nav-link">
									<i class="nav-icon fa fa-bullhorn text-warning"></i>
									<p>News Letter</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fa fas fa-key text-warning"></i>
									<p>Reset Password</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo Navigate('logout');?>" class="nav-link">
									<i class="nav-icon fa fa-circle text-warning"></i>
									<p>Logout</p>
								</a>
							</li>
						</ul>
					</nav>
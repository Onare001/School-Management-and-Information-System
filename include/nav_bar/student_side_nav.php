				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo Navigate('student_dashboard')?>" class="nav-link">
								<i class="nav-icon fa fa-home text-warning"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('edit_stdnt_profile')?>" class="nav-link">
								<i class="nav-icon fa fa-edit text-warning"></i>
								<p>Edit Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('my_timetables')?>" class="nav-link">
								<i class="nav-icon fa fa-clock text-warning"></i>
								<p>My Class Timetable</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('my_assignment')?>" class="nav-link">
								<i class="nav-icon fa fa-percent text-warning"></i>
								<p>My Assignments</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('check_result')?>" class="nav-link">
								<i class="nav-icon fa fa-file text-warning"></i>
								<p>Check Result</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('pay_sch_fee2')?>" class="nav-link">
								<i class="nav-icon fa fa-credit-card text-warning"></i>
								<p>Pay School Fees</p>
							</a>
						</li>
						<?php
						if ($datarow['class_id'] == '3' || $datarow['class_id'] == '4') {
							echo '<li class="nav-item">
								<a href="'.Navigate('testimonial_info').'" class="nav-link">
									<i class="nav-icon fa fa-graduation-cap text-warning"></i>
									<p>Testimonial</p>
								</a>
							</li>';		
							}
						?>
						<li class="nav-item">
							<a href="<?php echo Navigate('stdnt_messages')?>" class="nav-link">
								<i class="nav-icon fa fa-envelope text-warning"></i>
								<p>Messages</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('change_stu_passport')?>" class="nav-link">
								<i class="nav-icon fa fa-user text-warning"></i>
								<p>Profile Picture</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('reset_stdnt_password')?>" class="nav-link">
								<i class="nav-icon fa fas fa-key text-warning"></i>
								<p>Reset Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('logout')?>" class="nav-link">
								<i class="nav-icon fa fa-circle text-warning"></i>
								<p>Logout</p>
							</a>
						</li>
					</ul>
				</nav>
				
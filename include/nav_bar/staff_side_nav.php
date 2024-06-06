				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<?php 
						if (($priviledge == 2)||($priviledge == 5)||($priviledge < 9)){
							echo '<li class="nav-item">
							<a href="'.Navigate('staff_dashboard').'" class="nav-link">
								<i class="nav-icon fa fa-home text-warning"></i>
								<p>Dashboard</p>
							</a>
						</li>';
						} else if (($priviledge == 9)){
							echo '<li class="nav-item">
							<a href="'.Navigate('account_dashboard').'" class="nav-link">
								<i class="nav-icon fa fa-home text-warning"></i>
								<p>Dashboard</p>
							</a>
						</li>';
						} ?>     
						<!--li class="nav-item">
							<a href="#edit_staff_profile" class="nav-link">
								<i class="nav-icon fa fa-edit text-warning"></i>
								<p>Edit Profile</p>
							</a>
						</li-->
						<?php
						//For All Subject Teachers
						if (($priviledge == 2)||($priviledge == 5)||($priviledge < 9)) {
						echo '<li class="nav-item">
							<a href="'.Navigate('enter_class_score').'" class="nav-link">
								<i class="nav-icon fa fa-percent text-warning"></i>
								<p>Enter Score</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('create_exam_ques').'" class="nav-link">
								<i class="nav-icon fa fa-question text-warning"></i>
								<p>Examination Question</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('view_stu_assignment').'" class="nav-link">
								<i class="nav-icon fa fa-book text-warning"></i>
								<p>Student Assignments</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('view_lesson_notes').'" class="nav-link">
								<i class="nav-icon fa fa-calendar text-warning"></i>
								<p>My Lesson Plan</p>
							</a>
						</li>';	
						} 
						//Account Office
						if ($priviledge == 9) {
						echo '<li class="nav-item">
							<a href="'.Navigate('staff_dashboard').'" class="nav-link">
								<i class="nav-icon fa fa-user text-warning"></i>
								<p>My Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-pie-chart text-warning"></i>
								<p>Track Payment Record <i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="'.Navigate('payment_record').'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>By Class</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="'.Navigate('stu_payment_record').'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>By Student</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('master_record').'" class="nav-link">
								<i class="nav-icon fa fa-file text-warning"></i>
								<p>Master Record</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('generate_report').'" class="nav-link">
								<i class="nav-icon fa fa-bar-chart text-warning"></i>
								<p>Generate Report</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('master_list').'" class="nav-link">
								<i class="nav-icon fa fa-table text-warning"></i>
								<p>Payment Broadsheet</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('acc_graduated_student').'" class="nav-link">
								<i class="nav-icon fa fa-graduation-cap text-warning"></i>
								<p>Graduated Students</p>
							</a>
						</li>
						<!--li class="nav-item">
							<a href="'.Navigate('payment_type').'" class="nav-link">
								<i class="nav-icon fa fa-edit text-warning"></i>
								<p>Purpose of Payment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('account_details2').'" class="nav-link">
								<i class="nav-icon fa fa-info-circle text-warning"></i>
								<p>School Account Details</p>
							</a>
						</li-->
						<li class="nav-item">
							<a href="'.Navigate('staff_acc_details').'" class="nav-link">
								<i class="nav-icon fa fa-info-circle text-warning"></i>
								<p>Staff Account Details</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('acc_settings').'" class="nav-link">
								<i class="nav-icon fa fa-cog text-warning"></i>
								<p>Account Settings</p>
							</a>
						</li>';
						} ?>
						<?php
						//Head Teacher
						if ($priviledge == 6) {
						echo '<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-credit-card text-warning"></i>
								<p>Make a Payment<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="'.Navigate('payment_record').'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Class</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="'.Navigate('stu_payment_record').'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Student</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="'.Navigate('account_details2').'" class="nav-link">
								<i class="nav-icon fa fa-info-circle text-warning"></i>
								<p>Account Details</p>
							</a>
						</li>'; } ?>	  
						<?php
						if ($priviledge == 5) {
						echo '<li class="nav-item">
							<a href="'.Navigate('view_class_list').'" class="nav-link">
								<i class="nav-icon fa fa-users text-warning"></i>
								<p>My Class List</p>
							</a>
						</li>';
						echo '<li class="nav-item">
							<a href="'.Navigate('attendance').'" class="nav-link">
								<i class="nav-icon fa fa-clock text-warning"></i>
								<p>Attendance</p>
							</a>
						</li>';
						echo '<li class="nav-item">
							<a href="'.Navigate('teachers_comment').'" class="nav-link">
								<i class="nav-icon fa fa-comment text-warning"></i>
								<p>Result Comment</p>
							</a>
						</li>';
						} ?>
						<?php
						$result = mysqli_query($conn, "SELECT staff_in_charge FROM club_info WHERE staff_in_charge='$user_id'");
						$club = mysqli_fetch_assoc($result);
						if ($club['staff_in_charge'] == $user_id){
						echo '<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-book-open text-warning"></i>
								<p>Clubs and Societies <i class="right fas fa-angle-left"></i></p>
							</a>';
							$ward = mysqli_query($conn,"SELECT club_id,club_name FROM club_info WHERE staff_in_charge='$user_id'");
								while($row = mysqli_fetch_assoc($ward)){
								echo '<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="'.Navigate('stu_club_soc').'?clid='.encrypt($row['club_id']).'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>'.$row['club_name'].'</p>
									</a>
								</li>
							</ul>';
							}'	
						</li>';
						}
						?>
						<?php
						//Examination Officer
						if ($priviledge == 7){
							echo '<li class="nav-item">
								<a href="'.Navigate('e-exam').'" class="nav-link">
									<i class="nav-icon fa fa-laptop text-warning"></i>
									<p>E-Examination</p>
								</a>
							</li>
							<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-clock text-warning"></i>
								<p>Time-Tables <i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="'.Navigate('timetables').'" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Create Timetable</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_class_timetable" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>View Timetable</p>
									</a>
								</li>
							</ul>
						</li>';
						echo '<li class="nav-item">
							<a href="'.Navigate('testimonial_data').'" class="nav-link">
								<i class="nav-icon fa fa-certificate text-warning"></i>
								<p>Testimonial Processing</p>
							</a>
						</li>';
							} ?>				
						<li class="nav-item">
							<a href="<?php echo Navigate('staff_messages');?>" class="nav-link">
								<i class="nav-icon fa fa-envelope text-warning"></i>
								<p>Messages</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('change_staff_passport');?>" class="nav-link">
								<i class="nav-icon fa fa-user text-warning"></i>
								<p>Profile Picture</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('reset_staff_psswd');?>" class="nav-link">
								<i class="nav-icon fa fas fa-key text-warning"></i>
								<p>Reset Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('report');?>" class="nav-link">
								<i class="nav-icon fa fas fa-file text-warning"></i>
								<p>Report a Bug</p>
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

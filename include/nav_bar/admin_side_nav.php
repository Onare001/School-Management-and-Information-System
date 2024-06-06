
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo Navigate('admin_dashboard');?>" class="nav-link">
								<i class="nav-icon fa fa-home text-warning"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('adm_application');?>" class="nav-link">
								<i class="nav-icon fa fa-file text-warning"></i>
								<p>Admission Processor</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-user-plus text-warning"></i>
								<p>Register Staff/Student <i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo Navigate('register_staff');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Staff</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('select_class');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Student</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('staff_record');?>" class="nav-link">
								<i class="nav-icon fa fa-users text-warning"></i>
								<p>Staff Record</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('parent_record');?>" class="nav-link">
								<i class="nav-icon fa fa-users text-warning"></i>
								<p>Parent Record</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('instant_search');?>" class="nav-link">
								<i class="nav-icon fa fa-search text-warning"></i>
								<p>Search for Student</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('admin_messages');?>" class="nav-link">
								<i class="nav-icon fa fa-envelope text-warning"></i>
								<p>Messages</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('broadcast_msg');?>" class="nav-link">
								<i class="nav-icon fa fa-bullhorn text-warning"></i>
								<p>Broadcast Message</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('bulk_msg');?>" class="nav-link">
								<i class="nav-icon fa fa-bullhorn text-warning"></i>
								<p>Bulk SMS</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('sch_lession_note');?>" class="nav-link">
								<i class="nav-icon fa fa-book text-warning"></i>
								<p>Lesson Note <span class="right badge badge-danger">New</span></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('view_class_timetable');?>" class="nav-link">
								<i class="nav-icon fa fa-table text-warning"></i>
								<p>Class Timetable <span class="right badge badge-danger">New</span></p>
							</a>
						</li>	
						<li class="nav-item">
							<a href="<?php echo Navigate('manage_class_attendance');?>" class="nav-link">
								<i class="nav-icon fa fa-clock text-warning"></i>
								<p>Manage Attendance <span class="right badge badge-danger">New</span></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('class_question');?>" class="nav-link">
								<i class="nav-icon fa fa-question text-warning"></i>
								<p>Examination Questions</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-award text-warning"></i>
								<p>Assessment Record <i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo Navigate('print_score_sheet');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Print Score Sheet</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('admin_class_score');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Scores By Subjects</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('view_cbt_result');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>View CBT Result</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('view_prom_score');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Promotion Scores</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('track_entered_score');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Track Entered Score</p>
									</a>
								</li> 
								<li class="nav-item">
									<a href="<?php echo Navigate('terminal_broadsheet');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Terminal Broadsheet</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo Navigate('cumulative_broadsheet');?>" class="nav-link">
										<i class="fa fa-plus nav-icon"></i>
										<p>Cumulative Broadsheet</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('view_terminal_result');?>" class="nav-link">
								<i class="nav-icon fa fa-folder text-warning"></i>
								<p>Terminal Result</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('view_cumulative_result');?>" class="nav-link">
								<i class="nav-icon fa fa-folder-plus text-warning"></i>
								<p>Cumulative Result</p>
							</a>
						</li>
						<?php if (getClass(1)=='JS 1' || getClass(1)=='SS 1'){
							echo '<li class="nav-item">
							<a href="'.Navigate('view_mock_result').'" class="nav-link">
								<i class="nav-icon fa fa-user-graduate text-warning"></i>
								<p>'.getClass(3).' Mock Result</p>
							</a>
						</li>';
						}?>
						<li class="nav-item">
							<a href="<?php echo Navigate('result_statistics');?>" class="nav-link">
								<i class="nav-icon fa fas fa-chart-bar text-warning"></i>
								<p>Result Statistics</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('graduated_students');?>" class="nav-link">
								<i class="nav-icon fa fa-graduation-cap text-warning"></i>
								<p>Graduated Students</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('generate_testimonial');?>" class="nav-link">
								<i class="nav-icon fa fa-certificate text-warning"></i>
								<p>Graduate Testimonial <span class="right badge badge-danger">New</span></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('sch_photo_gallery');?>" class="nav-link">
								<i class="nav-icon fa fa-camera text-warning"></i>
								<p>School Photo Gallery <span class="right badge badge-danger">New</span></p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('manage_term');?>" class="nav-link">
								<i class="nav-icon fa fa-cog text-warning"></i>
								<p>Basic Settings</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('gen_settings');?>" class="nav-link">
								<i class="nav-icon fa fa-cog text-warning"></i>
								<p>School Settings</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo Navigate('update');?>" class="nav-link">
								<i class="nav-icon fa fa-download text-warning"></i>
								<p>Update</p>
							</a>
						</li>
					</ul>
				</nav>

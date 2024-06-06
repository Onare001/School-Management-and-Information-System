<?php 
function Navigate($page){
	//file extension
	$extension = '';#Do not show the file extension in URL
	$ext = '.php';
	if (file_exists($page.$ext)){
		//Administrative Links
		if ($page == 'admin_dashboard'){
			$page_link = $page;
		} else if ($page == 'adm_application'){
			$page_link = $page;
		} else if ($page == 'register_staff'){
			$page_link = $page;
		} else if ($page == 'select_class'){
			$page_link = $page;
		} else if ($page == 'register_student'){
			$page_link = $page;
		} else if ($page == 'staff_record'){
			$page_link = $page;
		} else if ($page == 'parent_record'){
			$page_link = $page;
		} else if ($page == 'instant_search'){
			$page_link = $page;
		} else if ($page == 'admin_messages'){
			$page_link = $page;
		} else if ($page == 'broadcast_msg'){
			$page_link = $page;
		} else if ($page == 'bulk_msg'){
			$page_link = $page;
		} else if ($page == 'sch_lession_note'){
			$page_link = $page;
		} else if ($page == 'view_class_timetable'){
			$page_link = $page;
		} else if ($page == 'manage_class_attendance'){
			$page_link = $page;
		} else if ($page == 'class_question'){
			$page_link = $page;
		} else if ($page == 'print_score_sheet'){
			$page_link = $page;
		} else if ($page == 'admin_class_score'){
			$page_link = $page;
		} else if ($page == 'view_prom_score'){
			$page_link = $page;
		} else if ($page == 'track_entered_score'){
			$page_link = $page;
		} else if ($page == 'terminal_broadsheet'){
			$page_link = $page;
		} else if ($page == 'cumulative_broadsheet'){
			$page_link = $page;
		} else if ($page == 'view_terminal_result'){
			$page_link = $page;
		} else if ($page == 'view_cumulative_result'){
			$page_link = $page;
		} else if ($page == 'view_mock_result'){
			$page_link = $page;
		} else if ($page == 'result_statistics'){
			$page_link = $page;
		} else if ($page == 'graduated_students'){
			$page_link = $page;
		} else if ($page == 'generate_testimonial'){
			$page_link = $page;
		} else if ($page == 'sch_photo_gallery'){
			$page_link = $page;
		} else if ($page == 'manage_term'){
			$page_link = $page;
		} else if ($page == 'gen_settings'){
			$page_link = $page;
		} else if ($page == 'update'){
			$page_link = $page;
		//Staff Links
		} else if ($page == 'staff_dashboard'){
			$page_link = $page;
		} else if ($page == 'account_dashboard'){
			$page_link = $page;
		} else if ($page == 'enter_class_score'){
			$page_link = $page;
		} else if ($page == 'create_exam_ques'){
			$page_link = $page;
		} else if ($page == 'view_stu_assignment'){
			$page_link = $page;
		} else if ($page == 'view_lesson_notes'){
			$page_link = $page;
		} else if ($page == 'payment_record'){
			$page_link = $page;
		} else if ($page == 'stu_payment_record'){
			$page_link = $page;
		} else if ($page == 'master_record'){
			$page_link = $page;
		} else if ($page == 'master_list'){
			$page_link = $page;
		} else if ($page == 'acc_graduated_student'){
			$page_link = $page;
		} else if ($page == 'payment_type'){
			$page_link = $page;
		} else if ($page == 'account_details2'){
			$page_link = $page;
		} else if ($page == 'staff_acc_details'){
			$page_link = $page;
		} else if ($page == 'acc_settings'){
			$page_link = $page;
		} else if ($page == 'generate_report'){
			$page_link = $page;
		} else if ($page == 'payment_record'){
			$page_link = $page;
		} else if ($page == 'stu_record'){
			$page_link = $page;
		} else if ($page == 'account_details2'){
			$page_link = $page;
		} else if ($page == 'view_class_list'){
			$page_link = $page;
		} else if ($page == 'stu_club_soc'){
			$page_link = $page;
		} else if ($page == 'attendance'){
			$page_link = $page;
		} else if ($page == 'teachers_comment'){
			$page_link = $page;
		} else if ($page == 'e-exam'){
			$page_link = $page;
		} else if ($page == 'timetables'){
			$page_link = $page;
		} else if ($page == 'view_class_timetable'){
			$page_link = $page;
		} else if ($page == 'view_cbt_result'){
			$page_link = $page;
		} else if ($page == 'testimonial_data'){
			$page_link = $page;
		} else if ($page == 'staff_messages'){
			$page_link = $page;
		} else if ($page == 'change_staff_passport'){
			$page_link = $page;
		} else if ($page == 'reset_staff_psswd'){
			$page_link = $page;
		} else if ($page == 'report'){
			$page_link = $page;
		} else if ($page == 'logout'){
			$page_link = $page;
		//Parent Links
		} else if ($page == 'parent_dashboard'){
			$page_link = $page;
		} else if ($page == 'ward_action'){
			$page_link = $page;
		} else if ($page == 'newsletter'){
			$page_link = $page;
		//Student Links
		} else if ($page == 'student_dashboard'){
			$page_link = $page;
		} else if ($page == 'edit_stdnt_profile'){
			$page_link = $page;
		} else if ($page == 'my_timetables'){
			$page_link = $page;
		} else if ($page == 'my_assignment'){
			$page_link = $page;
		} else if ($page == 'check_result'){
			$page_link = $page;
		} else if ($page == 'pay_sch_fee2'){
			$page_link = $page;
		} else if ($page == 'testimonial_info'){
			$page_link = $page;
		} else if ($page == 'stdnt_messages'){
			$page_link = $page;
		} else if ($page == 'change_stu_passport'){
			$page_link = $page;
		} else if ($page == 'reset_stdnt_password'){
			$page_link = $page;
		//Gold Administrator... WebMaster
		} else if ($page == 'admin'){
			$page_link = $page;
		} else if ($page == 'generate_pin'){
			$page_link = $page;
		} else if ($page == 'print_pin'){
			$page_link = $page;
		} else if ($page == 'check_sys_health'){
			$page_link = $page;
		} else if ($page == 'logs'){
			$page_link = $page;
		} else if ($page == 'maintenance'){
			$page_link = $page;
		} else if ($page == 'report_log'){
			$page_link = $page;
		} else if ($page == ''){
			$page_link = $page;
		} else if ($page == ''){
			$page_link = $page;
		} else {
			$page_link = '#';
		}
	} else if (!file_exists($page.$extension)){
		$page_link = '404';
	}
	return $page_link.$extension;
}
?>
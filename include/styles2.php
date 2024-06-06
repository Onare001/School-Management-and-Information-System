<head>
	<meta charset="UTF-8">
	<title> School Management System | <?php echo $page_title;?> </title>
	<meta name="keywords" content="School Management System"/>
	<meta name="description" content="Niel Technologies">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="<?php echo getSchname($sch_id);?>">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<link rel="shortcut icon"  href="assets/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
	<link rel="icon" type="image/x-icon" sizes="16x16" href="assets/img/favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/sms.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=0.29">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Summernote -->
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
	<!-- BS Stepper -->
	<link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- Drop drop menu -->
	<script src="assets/jquery/select/select_drop_down.js"></script>
	<!-- Toastr -->
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<script src="plugins/toastr/toastr.min.js"></script>
</head>
<?php 
	if($theme){
	echo '<style>'.' 
	#custom, #selectbox, thead, tfoot{
		background-color:'.$theme.';
		'.'color:white;
		}
'.'</style>';
} else {
	echo '<style>'.'
	#custom, #selectbox, thead, tfoot{
		background-color:darkblue;'
		.'color:white;
		}
'.'</style>';} ?>

<script>
	function goBack() {
	window.history.back();
	}
</script>		
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed layout-fixed"><!--text-sm-->
	<div class="wrapper">
	<?php
		if (1==0){
		echo '<div class="preloader flex-column justify-content-center align-items-center">
			<div class="loader">
				<img class="" src="'.getschLogo($sch_id).'" alt="SMSLogo" height="60" width="60"/><br>
			</div>
		</div>';
		}
	?>
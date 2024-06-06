<?php
if (1==1){
echo '<head>
	<meta charset="UTF-8">
	<title> School Management System | '.$page_title.'</title>
	<meta name="keywords" content="School Management System, Niel Technologies"/>
	<meta name="description" content="School Management System">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="'.getSchname($sch_id).', School Management System">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/result_style.min.css">
	<!--b8d419290b8edd97a79170e51f22230b1456a4623fff769657eaa85511f01ef7621bcba3daaca1e30c051-->
	<link rel="stylesheet" href="assets/css/result.css">
	<!--link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /-->
</head>';
} else {
	echo '<head>
	<meta charset="UTF-8">
	<title> School Management System | '.$page_title.'</title>
	<meta name="keywords" content="School Management System, Niel Technologies"/>
	<meta name="description" content="School Management System">
	<meta name="author" content="Daniel Tayo Onare">
	<meta name="keyword" content="'.getSchname($sch_id).', School Management System">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=0.33">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/result_style.min.css">
	<!--b8d419290b8edd97a79170e51f22230b1456a4623fff769657eaa85511f01ef7621bcba3daaca1e30c051-->
	<link rel="stylesheet" href="assets/css/result2.css">
	<!--link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /-->
</head>';
}
?>
<script>
	function goBack() {
	window.history.back();
	}
</script>
<style>
	.custom, .passport{
		background-color:<?php echo getSchtheme($sch_id);?>;
		color:white;
	}
</style>
<?php include ("functions/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> School Management System | Welcome</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<meta name="keywords" content="School Management System"/>
	<meta name="description" content="Niel Technologies">
	<meta name="author" content="Daniel Tayo Onare">
	<link rel="shortcut icon"  href="assets/img/sms3.png">
	<link rel="stylesheet" href="assets/css/index_style.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link href='https://fonts.googleapis.com/css?family=Prompt' rel='stylesheet'>
</head>
<body>
	<div class="card">
		<div class="w_mark">
			<img src="assets/img/<?php echo 'sms3.png';?>" alt="img" class="water_mark"/>
		</div>
		<div class="logo">
			<img src="<?php echo getSchLogo(1);?>" width="150px" height="150px" class="img-circle"/>
		</div>	
		<div class="school-name" align="center">
			<h2 style="font-family:Imprint MT Shadow; color:darkblue;margin:0px auto;"><?php echo strtoupper(getSchName(1));?></h2><br/>
		</div>
		<hr><h3 align="center" style="color:red;"><?php echo getSchSection(1);?> | Web Portal</h3><hr>
		<h4 align="center">What do you want to do?</h4>
		<div class="rows">
			<div>
				<a onclick="location.href='user_login'">
				<i class="sms fa fa-laptop" style="font-size:100px;"></i>
				<p>SCHOOL MANAGEMENT SYSTEM</p></a>
			</div>
			<div>
				<a onclick="location.href='cbt'">
				<i class="cbt fa fa-desktop" style="font-size:100px;"></i>
				<p>COMPUTER BASED EXAMINATION</p></a>
			</div>
			<div>
				<a onclick="location.href='apply'">
				<i class="adm fa fa-graduation-cap" style="font-size:100px;"></i>
				<p>APPLY FOR ADMISSION</p></a>
			</div>
		</div>
		<hr><br/>
		<div class="rows">
			<div>
				<a onclick="location.href='check_result2'">
				<i class="chr fa fa-chalkboard" style="font-size:100px;"></i>
				<p>CHECK RESULT</p></a>
			</div>
			<div>
				<a onclick="location.href='eLearning'">
				<i class="elearning fa fa-book" style="font-size:100px;"></i>
				<p>E-LEARNING</p></a>
			</div>
			<div>
				<a onclick="location.href='index'">
				<i class="back fa fa-home" style="font-size:100px;"></i>
				<p>SELECT SCHOOL</p></a>
			</div>
		</div>
		<div style="color:red;"><a href="./assets/appstore/sms_nieltech.apk">Click here to download our mobile app</a></div>
		<hr>
		<div class="footer">
			<small>Copyright © 2024 SMS.&nbsp;<a href="https://api.whatsapp.com/send?phone=2348145162722" target="blank">Powered by Niel Technologies <i class="fa fa-wifi"></i> +2348145162722</a>. All Rights Reserved.</small> <b>Version</b> 1.23.0
		</div>
	</div>
</body>
</html>
<?php
/* if (1==0){
//Table structure for table `account_details`
$create_table = "CREATE TABLE IF NOT EXISTS `account_details` (
  `acc_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `acc_no` varchar(10) NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `admission`
$create_table = "CREATE TABLE IF NOT EXISTS `admission` (
  `appl_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `sex_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `appl_no` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `assgn_questions`
$create_table = "CREATE TABLE IF NOT EXISTS `assgn_questions` (
  `aques_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `assgn_question` varchar(200) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `attempted_payment`
$create_table = "CREATE TABLE IF NOT EXISTS `attempted_payment` (
  `trial_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `reference` varchar(200) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `online_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `attendance`
$create_table = "CREATE TABLE IF NOT EXISTS `attendance` (
  `attd_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `attendance` varchar(20) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `bank_info`
$create_table = "CREATE TABLE IF NOT EXISTS `bank_info` (
  `bank_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `bank_info`
$insert_data = "INSERT INTO `bank_info` (`bank_id`, `bank`) VALUES
(1, 'Access Bank'),
(2, 'Ecobank Nigeria'),
(3, 'Fidelity Bank Nigeria'),
(4, 'First City Monument Bank'),
(5, 'Guaranty Trust Bank'),
(6, 'Keystone Bank Limited'),
(7, 'Polaris Bank'),
(8, 'Stanbic IBTC Bank'),
(9, 'Sterling Bank'),
(10, 'Union Bank of Nigeria'),
(11, 'United Bank for Africa'),
(12, 'Unity Bank plc'),
(13, 'Wema Bank'),
(14, 'Zenith Bank')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `blood_info`
$create_table = "CREATE TABLE IF NOT EXISTS `blood_info` (
  `bld_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `group` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `blood_info`
$insert_data = "INSERT INTO `blood_info` (`bld_id`, `group`) VALUES
(1, 'A+'),
(2, 'B+'),
(3, 'AB+'),
(4, 'O+')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `broadcast_msg`
$create_table = "CREATE TABLE IF NOT EXISTS `broadcast_msg` (
  `msg_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `information` text NOT NULL,
  `audience` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `cand_questions`
$create_table = "CREATE TABLE IF NOT EXISTS `cand_questions` (
  `cand_ques_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sn_qno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `cand_answer` text NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `cbt_score`
$create_table = "CREATE TABLE IF NOT EXISTS `cbt_score` (
  `score_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `class_cat`
$create_table = "CREATE TABLE IF NOT EXISTS `class_cat` (
  `cat_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `class_info`
$create_table = "CREATE TABLE IF NOT EXISTS `class_info` (
  `class_id` int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `class_info`
if($_SESSION['selected_database'] == 'senior'){
	$insert_data = "INSERT INTO `class_info` (`class_id`, `sch_id`, `class_name`) VALUES
	(1, 0, 'SS 1'),
	(2, 0, 'SS 2'),
	(3, 0, 'SS 3'),
	(4, 0, 'Graduated')";
} else if ($_SESSION['selected_database'] == 'junior'){
	$insert_data = "INSERT INTO `class_info` (`class_id`, `sch_id`, `class_name`) VALUES
	(1, 0, 'JS 1'),
	(2, 0, 'JS 2'),
	(3, 0, 'JS 3'),
	(4, 0, 'Graduated')";
} else if ($_SESSION['selected_database'] == 'primary'){
	$insert_data = "INSERT INTO `class_info` (`class_id`, `sch_id`, `class_name`) VALUES
	(1, 0, 'Nursery 1'),
	(2, 0, 'Nursery 2'),
	(3, 0, 'Primary 1'),
	(4, 0, 'Primary 2'),
	(5, 0, 'Primary 3'),
	(6, 0, 'Primary 4'),
	(7, 0, 'Primary 5'),
	(8, 0, 'Primary 6'),
	(9, 0, 'Graduated')";
} else {
	//something
}

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `class_timetable`
$create_table = "CREATE TABLE IF NOT EXISTS `class_timetable` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `club_info`
$create_table = "CREATE TABLE IF NOT EXISTS `club_info` (
  `club_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `club_name` varchar(20) NOT NULL,
  `club_abbr` varchar(20) NOT NULL,
  `staff_in_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `club_info`
$insert_data = "INSERT INTO `club_info` (`club_id`, `sch_id`, `club_name`, `club_abbr`, `staff_in_charge`) VALUES
(1, 1, 'JETS Club', 'JETS', 0),
(2, 1, 'PRESS Club', 'PRESS', 5)";

mysqli_query($conn,$create_table);  
mysqli_query($conn,$insert_data);

//Table structure for table `cum_result`
$create_table = "CREATE TABLE IF NOT EXISTS `cum_result` (
  `score_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_term_total` decimal(10,0) NOT NULL,
  `second_term_total` decimal(10,0) NOT NULL,
  `third_term_total` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `average` decimal(10,0) NOT NULL,
  `aggregate_score` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `department`
$create_table = "CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `department`
$insert_data = "INSERT INTO `department` (`dept_id`, `department`) VALUES
(1, 'Art'),
(2, 'Business'),
(3, 'Science'),
(4, 'Mathematics'),
(5, 'Languages'),
(6, 'Social Science'),
(7, 'Vocational'),
(8, 'Administration')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `examination_question`
$create_table = "CREATE TABLE IF NOT EXISTS `examination_question` (
  `question_id` int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `optionA` varchar(255) NOT NULL,
  `optionB` varchar(255) NOT NULL,
  `optionC` varchar(255) NOT NULL,
  `optionD` varchar(255) NOT NULL,
  `correct_answer` varchar(225) NOT NULL,
  `question_type` int(11) NOT NULL,
  `img` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `exam_timetable`
$create_table = "CREATE TABLE IF NOT EXISTS `exam_timetable` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `e_exam`
$create_table = "CREATE TABLE IF NOT EXISTS `e_exam` (
  `exam_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `no_of_question` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `form_teacher_info`
$create_table = "CREATE TABLE IF NOT EXISTS `form_teacher_info` (
  `ft_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `gender_info`
$create_table = "CREATE TABLE IF NOT EXISTS `gender_info` (
  `sex_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `gender_info`
$insert_data = "INSERT INTO `gender_info` (`sex_id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Others')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `genotype_info`
$create_table = "CREATE TABLE IF NOT EXISTS `genotype_info` (
  `geno_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `gtype` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `genotype_info`
$insert_data = "INSERT INTO `genotype_info` (`geno_id`, `gtype`) VALUES
(1, 'AA'),
(2, 'AS'),
(3, 'SS')";

mysqli_query($conn,$create_table);  
mysqli_query($conn,$insert_data);

//Table structure for table `house_info`
$create_table = "CREATE TABLE IF NOT EXISTS `house_info` (
  `house_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `house` varchar(20) NOT NULL,
  `house_color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `ledger_info`
$create_table = "CREATE TABLE IF NOT EXISTS `ledger_info` (
  `payment_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `amount` varchar(10) NOT NULL DEFAULT '0000.00',
  `amount_paid` varchar(20) NOT NULL DEFAULT '0000.00',
  `receipt_no` varchar(10) NOT NULL DEFAULT '00000',
  `date_paid` varchar(25) NOT NULL,
  `balance` varchar(10) NOT NULL DEFAULT '0000.00',
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `lesson_notes`
$create_table = "CREATE TABLE IF NOT EXISTS `lesson_notes` (
  `lesson_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `week` int(11) NOT NULL,
  `topic` text NOT NULL,
  `lesson_note` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);   

//Table structure for table `local_governments`
$create_table = "CREATE TABLE IF NOT EXISTS `local_governments` (
  `lg_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `state_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='Local governments in Nigeria.'";

# Dumping data for table `local_governments`
$insert_data = "INSERT INTO `local_governments` (`lg_id`, `state_id`, `name`) VALUES
(1, 1, 'Aba North'),
(2, 1, 'Aba South'),
(3, 1, 'Arochukwu'),
(4, 1, 'Bende'),
(5, 1, 'Ikwuano'),
(6, 1, 'Isiala Ngwa North'),
(7, 1, 'Isiala Ngwa South'),
(8, 1, 'Isuikwuato'),
(9, 1, 'Obi Ngwa'),
(10, 1, 'Ohafia'),
(11, 1, 'Osisioma'),
(12, 1, 'Ugwunagbo'),
(13, 1, 'Ukwa East'),
(14, 1, 'Ukwa West'),
(15, 1, 'Umuahia North'),
(16, 1, 'Umuahia South'),
(17, 1, 'Umu Nneochi'),
(18, 2, 'Demsa'),
(19, 2, 'Fufure'),
(20, 2, 'Ganye'),
(21, 2, 'Gayuk'),
(22, 2, 'Gombi'),
(23, 2, 'Grie'),
(24, 2, 'Hong'),
(25, 2, 'Jada'),
(26, 2, 'Larmurde'),
(27, 2, 'Madagali'),
(28, 2, 'Maiha'),
(29, 2, 'Mayo Belwa'),
(30, 2, 'Michika'),
(31, 2, 'Mubi North'),
(32, 2, 'Mubi South'),
(33, 2, 'Numan'),
(34, 2, 'Shelleng'),
(35, 2, 'Song'),
(36, 2, 'Toungo'),
(37, 2, 'Yola North'),
(38, 2, 'Yola South'),
(39, 3, 'Abak'),
(40, 3, 'Eastern Obolo'),
(41, 3, 'Eket'),
(42, 3, 'Esit Eket'),
(43, 3, 'Essien Udim'),
(44, 3, 'Etim Ekpo'),
(45, 3, 'Etinan'),
(46, 3, 'Ibeno'),
(47, 3, 'Ibesikpo Asutan'),
(48, 3, 'Ibiono-Ibom'),
(49, 3, 'Ika'),
(50, 3, 'Ikono'),
(51, 3, 'Ikot Abasi'),
(52, 3, 'Ikot Ekpene'),
(53, 3, 'Ini'),
(54, 3, 'Itu'),
(55, 3, 'Mbo'),
(56, 3, 'Mkpat-Enin'),
(57, 3, 'Nsit-Atai'),
(58, 3, 'Nsit-Ibom'),
(59, 3, 'Nsit-Ubium'),
(60, 3, 'Obot Akara'),
(61, 3, 'Okobo'),
(62, 3, 'Onna'),
(63, 3, 'Oron'),
(64, 3, 'Oruk Anam'),
(65, 3, 'Udung-Uko'),
(66, 3, 'Ukanafun'),
(67, 3, 'Uruan'),
(68, 3, 'Urue-Offong/Oruko'),
(69, 3, 'Uyo'),
(70, 4, 'Aguata'),
(71, 4, 'Anambra East'),
(72, 4, 'Anambra West'),
(73, 4, 'Anaocha'),
(74, 4, 'Awka North'),
(75, 4, 'Awka South'),
(76, 4, 'Ayamelum'),
(77, 4, 'Dunukofia'),
(78, 4, 'Ekwusigo'),
(79, 4, 'Idemili North'),
(80, 4, 'Idemili South'),
(81, 4, 'Ihiala'),
(82, 4, 'Njikoka'),
(83, 4, 'Nnewi North'),
(84, 4, 'Nnewi South'),
(85, 4, 'Ogbaru'),
(86, 4, 'Onitsha North'),
(87, 4, 'Onitsha South'),
(88, 4, 'Orumba North'),
(89, 4, 'Orumba South'),
(90, 4, 'Oyi'),
(91, 5, 'Alkaleri'),
(92, 5, 'Bauchi'),
(93, 5, 'Bogoro'),
(94, 5, 'Damban'),
(95, 5, 'Darazo'),
(96, 5, 'Dass'),
(97, 5, 'Gamawa'),
(98, 5, 'Ganjuwa'),
(99, 5, 'Giade'),
(100, 5, 'Itas/Gadau'),
(101, 5, 'Jama\'are'),
(102, 5, 'Katagum'),
(103, 5, 'Kirfi'),
(104, 5, 'Misau'),
(105, 5, 'Ningi'),
(106, 5, 'Shira'),
(107, 5, 'Tafawa Balewa'),
(108, 5, 'Toro'),
(109, 5, 'Warji'),
(110, 5, 'Zaki'),
(111, 6, 'Brass'),
(112, 6, 'Ekeremor'),
(113, 6, 'Kolokuma/Opokuma'),
(114, 6, 'Nembe'),
(115, 6, 'Ogbia'),
(116, 6, 'Sagbama'),
(117, 6, 'Southern Ijaw'),
(118, 6, 'Yenagoa'),
(119, 7, 'Agatu'),
(120, 7, 'Apa'),
(121, 7, 'Ado'),
(122, 7, 'Buruku'),
(123, 7, 'Gboko'),
(124, 7, 'Guma'),
(125, 7, 'Gwer East'),
(126, 7, 'Gwer West'),
(127, 7, 'Katsina-Ala'),
(128, 7, 'Konshisha'),
(129, 7, 'Kwande'),
(130, 7, 'Logo'),
(131, 7, 'Makurdi'),
(132, 7, 'Obi'),
(133, 7, 'Ogbadibo'),
(134, 7, 'Ohimini'),
(135, 7, 'Oju'),
(136, 7, 'Okpokwu'),
(137, 7, 'Oturkpo'),
(138, 7, 'Tarka'),
(139, 7, 'Ukum'),
(140, 7, 'Ushongo'),
(141, 7, 'Vandeikya'),
(142, 8, 'Abadam'),
(143, 8, 'Askira/Uba'),
(144, 8, 'Bama'),
(145, 8, 'Bayo'),
(146, 8, 'Biu'),
(147, 8, 'Chibok'),
(148, 8, 'Damboa'),
(149, 8, 'Dikwa'),
(150, 8, 'Gubio'),
(151, 8, 'Guzamala'),
(152, 8, 'Gwoza'),
(153, 8, 'Hawul'),
(154, 8, 'Jere'),
(155, 8, 'Kaga'),
(156, 8, 'Kala/Balge'),
(157, 8, 'Konduga'),
(158, 8, 'Kukawa'),
(159, 8, 'Kwaya Kusar'),
(160, 8, 'Mafa'),
(161, 8, 'Magumeri'),
(162, 8, 'Maiduguri'),
(163, 8, 'Marte'),
(164, 8, 'Mobbar'),
(165, 8, 'Monguno'),
(166, 8, 'Ngala'),
(167, 8, 'Nganzai'),
(168, 8, 'Shani'),
(169, 9, 'Abi'),
(170, 9, 'Akamkpa'),
(171, 9, 'Akpabuyo'),
(172, 9, 'Bakassi'),
(173, 9, 'Bekwarra'),
(174, 9, 'Biase'),
(175, 9, 'Boki'),
(176, 9, 'Calabar Municipal'),
(177, 9, 'Calabar South'),
(178, 9, 'Etung'),
(179, 9, 'Ikom'),
(180, 9, 'Obanliku'),
(181, 9, 'Obubra'),
(182, 9, 'Obudu'),
(183, 9, 'Odukpani'),
(184, 9, 'Ogoja'),
(185, 9, 'Yakuur'),
(186, 9, 'Yala'),
(187, 10, 'Aniocha North'),
(188, 10, 'Aniocha South'),
(189, 10, 'Bomadi'),
(190, 10, 'Burutu'),
(191, 10, 'Ethiope East'),
(192, 10, 'Ethiope West'),
(193, 10, 'Ika North East'),
(194, 10, 'Ika South'),
(195, 10, 'Isoko North'),
(196, 10, 'Isoko South'),
(197, 10, 'Ndokwa East'),
(198, 10, 'Ndokwa West'),
(199, 10, 'Okpe'),
(200, 10, 'Oshimili North'),
(201, 10, 'Oshimili South'),
(202, 10, 'Patani'),
(203, 10, 'Sapele, Delta'),
(204, 10, 'Udu'),
(205, 10, 'Ughelli North'),
(206, 10, 'Ughelli South'),
(207, 10, 'Ukwuani'),
(208, 10, 'Uvwie'),
(209, 10, 'Warri North'),
(210, 10, 'Warri South'),
(211, 10, 'Warri South West'),
(212, 11, 'Abakaliki'),
(213, 11, 'Afikpo North'),
(214, 11, 'Afikpo South'),
(215, 11, 'Ebonyi'),
(216, 11, 'Ezza North'),
(217, 11, 'Ezza South'),
(218, 11, 'Ikwo'),
(219, 11, 'Ishielu'),
(220, 11, 'Ivo'),
(221, 11, 'Izzi'),
(222, 11, 'Ohaozara'),
(223, 11, 'Ohaukwu'),
(224, 11, 'Onicha'),
(225, 12, 'Akoko-Edo'),
(226, 12, 'Egor'),
(227, 12, 'Esan Central'),
(228, 12, 'Esan North-East'),
(229, 12, 'Esan South-East'),
(230, 12, 'Esan West'),
(231, 12, 'Etsako Central'),
(232, 12, 'Etsako East'),
(233, 12, 'Etsako West'),
(234, 12, 'Igueben'),
(235, 12, 'Ikpoba Okha'),
(236, 12, 'Orhionmwon'),
(237, 12, 'Oredo'),
(238, 12, 'Ovia North-East'),
(239, 12, 'Ovia South-West'),
(240, 12, 'Owan East'),
(241, 12, 'Owan West'),
(242, 12, 'Uhunmwonde'),
(243, 13, 'Ado Ekiti'),
(244, 13, 'Efon'),
(245, 13, 'Ekiti East'),
(246, 13, 'Ekiti South-West'),
(247, 13, 'Ekiti West'),
(248, 13, 'Emure'),
(249, 13, 'Gbonyin'),
(250, 13, 'Ido Osi'),
(251, 13, 'Ijero'),
(252, 13, 'Ikere'),
(253, 13, 'Ikole'),
(254, 13, 'Ilejemeje'),
(255, 13, 'Irepodun/Ifelodun'),
(256, 13, 'Ise/Orun'),
(257, 13, 'Moba'),
(258, 13, 'Oye'),
(259, 14, 'Aninri'),
(260, 14, 'Awgu'),
(261, 14, 'Enugu East'),
(262, 14, 'Enugu North'),
(263, 14, 'Enugu South'),
(264, 14, 'Ezeagu'),
(265, 14, 'Igbo Etiti'),
(266, 14, 'Igbo Eze North'),
(267, 14, 'Igbo Eze South'),
(268, 14, 'Isi Uzo'),
(269, 14, 'Nkanu East'),
(270, 14, 'Nkanu West'),
(271, 14, 'Nsukka'),
(272, 14, 'Oji River'),
(273, 14, 'Udenu'),
(274, 14, 'Udi'),
(275, 14, 'Uzo Uwani'),
(276, 15, 'Abaji'),
(277, 15, 'Bwari'),
(278, 15, 'Gwagwalada'),
(279, 15, 'Kuje'),
(280, 15, 'Kwali'),
(281, 15, 'Municipal Area Council'),
(282, 16, 'Akko'),
(283, 16, 'Balanga'),
(284, 16, 'Billiri'),
(285, 16, 'Dukku'),
(286, 16, 'Funakaye'),
(287, 16, 'Gombe'),
(288, 16, 'Kaltungo'),
(289, 16, 'Kwami'),
(290, 16, 'Nafada'),
(291, 16, 'Shongom'),
(292, 16, 'Yamaltu/Deba'),
(293, 17, 'Aboh Mbaise'),
(294, 17, 'Ahiazu Mbaise'),
(295, 17, 'Ehime Mbano'),
(296, 17, 'Ezinihitte'),
(297, 17, 'Ideato North'),
(298, 17, 'Ideato South'),
(299, 17, 'Ihitte/Uboma'),
(300, 17, 'Ikeduru'),
(301, 17, 'Isiala Mbano'),
(302, 17, 'Isu'),
(303, 17, 'Mbaitoli'),
(304, 17, 'Ngor Okpala'),
(305, 17, 'Njaba'),
(306, 17, 'Nkwerre'),
(307, 17, 'Nwangele'),
(308, 17, 'Obowo'),
(309, 17, 'Oguta'),
(310, 17, 'Ohaji/Egbema'),
(311, 17, 'Okigwe'),
(312, 17, 'Orlu'),
(313, 17, 'Orsu'),
(314, 17, 'Oru East'),
(315, 17, 'Oru West'),
(316, 17, 'Owerri Municipal'),
(317, 17, 'Owerri North'),
(318, 17, 'Owerri West'),
(319, 17, 'Unuimo'),
(320, 18, 'Auyo'),
(321, 18, 'Babura'),
(322, 18, 'Biriniwa'),
(323, 18, 'Birnin Kudu'),
(324, 18, 'Buji'),
(325, 18, 'Dutse'),
(326, 18, 'Gagarawa'),
(327, 18, 'Garki'),
(328, 18, 'Gumel'),
(329, 18, 'Guri'),
(330, 18, 'Gwaram'),
(331, 18, 'Gwiwa'),
(332, 18, 'Hadejia'),
(333, 18, 'Jahun'),
(334, 18, 'Kafin Hausa'),
(335, 18, 'Kazaure'),
(336, 18, 'Kiri Kasama'),
(337, 18, 'Kiyawa'),
(338, 18, 'Kaugama'),
(339, 18, 'Maigatari'),
(340, 18, 'Malam Madori'),
(341, 18, 'Miga'),
(342, 18, 'Ringim'),
(343, 18, 'Roni'),
(344, 18, 'Sule Tankarkar'),
(345, 18, 'Taura'),
(346, 18, 'Yankwashi'),
(347, 19, 'Birnin Gwari'),
(348, 19, 'Chikun'),
(349, 19, 'Giwa'),
(350, 19, 'Igabi'),
(351, 19, 'Ikara'),
(352, 19, 'Jaba'),
(353, 19, 'Jema\'a'),
(354, 19, 'Kachia'),
(355, 19, 'Kaduna North'),
(356, 19, 'Kaduna South'),
(357, 19, 'Kagarko'),
(358, 19, 'Kajuru'),
(359, 19, 'Kaura'),
(360, 19, 'Kauru'),
(361, 19, 'Kubau'),
(362, 19, 'Kudan'),
(363, 19, 'Lere'),
(364, 19, 'Makarfi'),
(365, 19, 'Sabon Gari'),
(366, 19, 'Sanga'),
(367, 19, 'Soba'),
(368, 19, 'Zangon Kataf'),
(369, 19, 'Zaria'),
(370, 20, 'Ajingi'),
(371, 20, 'Albasu'),
(372, 20, 'Bagwai'),
(373, 20, 'Bebeji'),
(374, 20, 'Bichi'),
(375, 20, 'Bunkure'),
(376, 20, 'Dala'),
(377, 20, 'Dambatta'),
(378, 20, 'Dawakin Kudu'),
(379, 20, 'Dawakin Tofa'),
(380, 20, 'Doguwa'),
(381, 20, 'Fagge'),
(382, 20, 'Gabasawa'),
(383, 20, 'Garko'),
(384, 20, 'Garun Mallam'),
(385, 20, 'Gaya'),
(386, 20, 'Gezawa'),
(387, 20, 'Gwale'),
(388, 20, 'Gwarzo'),
(389, 20, 'Kabo'),
(390, 20, 'Kano Municipal'),
(391, 20, 'Karaye'),
(392, 20, 'Kibiya'),
(393, 20, 'Kiru'),
(394, 20, 'Kumbotso'),
(395, 20, 'Kunchi'),
(396, 20, 'Kura'),
(397, 20, 'Madobi'),
(398, 20, 'Makoda'),
(399, 20, 'Minjibir'),
(400, 20, 'Nasarawa'),
(401, 20, 'Rano'),
(402, 20, 'Rimin Gado'),
(403, 20, 'Rogo'),
(404, 20, 'Shanono'),
(405, 20, 'Sumaila'),
(406, 20, 'Takai'),
(407, 20, 'Tarauni'),
(408, 20, 'Tofa'),
(409, 20, 'Tsanyawa'),
(410, 20, 'Tudun Wada'),
(411, 20, 'Ungogo'),
(412, 20, 'Warawa'),
(413, 20, 'Wudil'),
(414, 21, 'Bakori'),
(415, 21, 'Batagarawa'),
(416, 21, 'Batsari'),
(417, 21, 'Baure'),
(418, 21, 'Bindawa'),
(419, 21, 'Charanchi'),
(420, 21, 'Dandume'),
(421, 21, 'Danja'),
(422, 21, 'Dan Musa'),
(423, 21, 'Daura'),
(424, 21, 'Dutsi'),
(425, 21, 'Dutsin Ma'),
(426, 21, 'Faskari'),
(427, 21, 'Funtua'),
(428, 21, 'Ingawa'),
(429, 21, 'Jibia'),
(430, 21, 'Kafur'),
(431, 21, 'Kaita'),
(432, 21, 'Kankara'),
(433, 21, 'Kankia'),
(434, 21, 'Katsina'),
(435, 21, 'Kurfi'),
(436, 21, 'Kusada'),
(437, 21, 'Mai\'Adua'),
(438, 21, 'Malumfashi'),
(439, 21, 'Mani'),
(440, 21, 'Mashi'),
(441, 21, 'Matazu'),
(442, 21, 'Musawa'),
(443, 21, 'Rimi'),
(444, 21, 'Sabuwa'),
(445, 21, 'Safana'),
(446, 21, 'Sandamu'),
(447, 21, 'Zango'),
(448, 22, 'Aleiro'),
(449, 22, 'Arewa Dandi'),
(450, 22, 'Argungu'),
(451, 22, 'Augie'),
(452, 22, 'Bagudo'),
(453, 22, 'Birnin Kebbi'),
(454, 22, 'Bunza'),
(455, 22, 'Dandi'),
(456, 22, 'Fakai'),
(457, 22, 'Gwandu'),
(458, 22, 'Jega'),
(459, 22, 'Kalgo'),
(460, 22, 'Koko/Besse'),
(461, 22, 'Maiyama'),
(462, 22, 'Ngaski'),
(463, 22, 'Sakaba'),
(464, 22, 'Shanga'),
(465, 22, 'Suru'),
(466, 22, 'Wasagu/Danko'),
(467, 22, 'Yauri'),
(468, 22, 'Zuru'),
(469, 23, 'Adavi'),
(470, 23, 'Ajaokuta'),
(471, 23, 'Ankpa'),
(472, 23, 'Bassa'),
(473, 23, 'Dekina'),
(474, 23, 'Ibaji'),
(475, 23, 'Idah'),
(476, 23, 'Igalamela Odolu'),
(477, 23, 'Ijumu'),
(478, 23, 'Kabba/Bunu'),
(479, 23, 'Kogi'),
(480, 23, 'Lokoja'),
(481, 23, 'Mopa Muro'),
(482, 23, 'Ofu'),
(483, 23, 'Ogori/Magongo'),
(484, 23, 'Okehi'),
(485, 23, 'Okene'),
(486, 23, 'Olamaboro'),
(487, 23, 'Omala'),
(488, 23, 'Yagba East'),
(489, 23, 'Yagba West'),
(490, 24, 'Asa'),
(491, 24, 'Baruten'),
(492, 24, 'Edu'),
(493, 24, 'Ekiti, Kwara State'),
(494, 24, 'Ifelodun'),
(495, 24, 'Ilorin East'),
(496, 24, 'Ilorin South'),
(497, 24, 'Ilorin West'),
(498, 24, 'Irepodun'),
(499, 24, 'Isin'),
(500, 24, 'Kaiama'),
(501, 24, 'Moro'),
(502, 24, 'Offa'),
(503, 24, 'Oke Ero'),
(504, 24, 'Oyun'),
(505, 24, 'Pategi'),
(506, 25, 'Agege'),
(507, 25, 'Ajeromi-Ifelodun'),
(508, 25, 'Alimosho'),
(509, 25, 'Amuwo-Odofin'),
(510, 25, 'Apapa'),
(511, 25, 'Badagry'),
(512, 25, 'Epe'),
(513, 25, 'Eti Osa'),
(514, 25, 'Ibeju-Lekki'),
(515, 25, 'Ifako-Ijaiye'),
(516, 25, 'Ikeja'),
(517, 25, 'Ikorodu'),
(518, 25, 'Kosofe'),
(519, 25, 'Lagos Island'),
(520, 25, 'Lagos Mainland'),
(521, 25, 'Mushin'),
(522, 25, 'Ojo'),
(523, 25, 'Oshodi-Isolo'),
(524, 25, 'Shomolu'),
(525, 25, 'Surulere, Lagos State'),
(526, 26, 'Akwanga'),
(527, 26, 'Awe'),
(528, 26, 'Doma'),
(529, 26, 'Karu'),
(530, 26, 'Keana'),
(531, 26, 'Keffi'),
(532, 26, 'Kokona'),
(533, 26, 'Lafia'),
(534, 26, 'Nasarawa'),
(535, 26, 'Nasarawa Egon'),
(536, 26, 'Obi'),
(537, 26, 'Toto'),
(538, 26, 'Wamba'),
(539, 27, 'Agaie'),
(540, 27, 'Agwara'),
(541, 27, 'Bida'),
(542, 27, 'Borgu'),
(543, 27, 'Bosso'),
(544, 27, 'Chanchaga'),
(545, 27, 'Edati'),
(546, 27, 'Gbako'),
(547, 27, 'Gurara'),
(548, 27, 'Katcha'),
(549, 27, 'Kontagora'),
(550, 27, 'Lapai'),
(551, 27, 'Lavun'),
(552, 27, 'Magama'),
(553, 27, 'Mariga'),
(554, 27, 'Mashegu'),
(555, 27, 'Mokwa'),
(556, 27, 'Moya'),
(557, 27, 'Paikoro'),
(558, 27, 'Rafi'),
(559, 27, 'Rijau'),
(560, 27, 'Shiroro'),
(561, 27, 'Suleja'),
(562, 27, 'Tafa'),
(563, 27, 'Wushishi'),
(564, 28, 'Abeokuta North'),
(565, 28, 'Abeokuta South'),
(566, 28, 'Ado-Odo/Ota'),
(567, 28, 'Egbado North'),
(568, 28, 'Egbado South'),
(569, 28, 'Ewekoro'),
(570, 28, 'Ifo'),
(571, 28, 'Ijebu East'),
(572, 28, 'Ijebu North'),
(573, 28, 'Ijebu North East'),
(574, 28, 'Ijebu Ode'),
(575, 28, 'Ikenne'),
(576, 28, 'Imeko Afon'),
(577, 28, 'Ipokia'),
(578, 28, 'Obafemi Owode'),
(579, 28, 'Odeda'),
(580, 28, 'Odogbolu'),
(581, 28, 'Ogun Waterside'),
(582, 28, 'Remo North'),
(583, 28, 'Shagamu'),
(584, 29, 'Akoko North-East'),
(585, 29, 'Akoko North-West'),
(586, 29, 'Akoko South-West'),
(587, 29, 'Akoko South-East'),
(588, 29, 'Akure North'),
(589, 29, 'Akure South'),
(590, 29, 'Ese Odo'),
(591, 29, 'Idanre'),
(592, 29, 'Ifedore'),
(593, 29, 'Ilaje'),
(594, 29, 'Ile Oluji/Okeigbo'),
(595, 29, 'Irele'),
(596, 29, 'Odigbo'),
(597, 29, 'Okitipupa'),
(598, 29, 'Ondo East'),
(599, 29, 'Ondo West'),
(600, 29, 'Ose'),
(601, 29, 'Owo'),
(602, 30, 'Atakunmosa East'),
(603, 30, 'Atakunmosa West'),
(604, 30, 'Aiyedaade'),
(605, 30, 'Aiyedire'),
(606, 30, 'Boluwaduro'),
(607, 30, 'Boripe'),
(608, 30, 'Ede North'),
(609, 30, 'Ede South'),
(610, 30, 'Ife Central'),
(611, 30, 'Ife East'),
(612, 30, 'Ife North'),
(613, 30, 'Ife South'),
(614, 30, 'Egbedore'),
(615, 30, 'Ejigbo'),
(616, 30, 'Ifedayo'),
(617, 30, 'Ifelodun'),
(618, 30, 'Ila'),
(619, 30, 'Ilesa East'),
(620, 30, 'Ilesa West'),
(621, 30, 'Irepodun'),
(622, 30, 'Irewole'),
(623, 30, 'Isokan'),
(624, 30, 'Iwo'),
(625, 30, 'Obokun'),
(626, 30, 'Odo Otin'),
(627, 30, 'Ola Oluwa'),
(628, 30, 'Olorunda'),
(629, 30, 'Oriade'),
(630, 30, 'Orolu'),
(631, 30, 'Osogbo'),
(632, 31, 'Afijio'),
(633, 31, 'Akinyele'),
(634, 31, 'Atiba'),
(635, 31, 'Atisbo'),
(636, 31, 'Egbeda'),
(637, 31, 'Ibadan North'),
(638, 31, 'Ibadan North-East'),
(639, 31, 'Ibadan North-West'),
(640, 31, 'Ibadan South-East'),
(641, 31, 'Ibadan South-West'),
(642, 31, 'Ibarapa Central'),
(643, 31, 'Ibarapa East'),
(644, 31, 'Ibarapa North'),
(645, 31, 'Ido'),
(646, 31, 'Irepo'),
(647, 31, 'Iseyin'),
(648, 31, 'Itesiwaju'),
(649, 31, 'Iwajowa'),
(650, 31, 'Kajola'),
(651, 31, 'Lagelu'),
(652, 31, 'Ogbomosho North'),
(653, 31, 'Ogbomosho South'),
(654, 31, 'Ogo Oluwa'),
(655, 31, 'Olorunsogo'),
(656, 31, 'Oluyole'),
(657, 31, 'Ona Ara'),
(658, 31, 'Orelope'),
(659, 31, 'Ori Ire'),
(660, 31, 'Oyo'),
(661, 31, 'Oyo East'),
(662, 31, 'Saki East'),
(663, 31, 'Saki West'),
(664, 31, 'Surulere, Oyo State'),
(665, 32, 'Bokkos'),
(666, 32, 'Barkin Ladi'),
(667, 32, 'Bassa'),
(668, 32, 'Jos East'),
(669, 32, 'Jos North'),
(670, 32, 'Jos South'),
(671, 32, 'Kanam'),
(672, 32, 'Kanke'),
(673, 32, 'Langtang South'),
(674, 32, 'Langtang North'),
(675, 32, 'Mangu'),
(676, 32, 'Mikang'),
(677, 32, 'Pankshin'),
(678, 32, 'Qua\'an Pan'),
(679, 32, 'Riyom'),
(680, 32, 'Shendam'),
(681, 32, 'Wase'),
(682, 33, 'Abua/Odual'),
(683, 33, 'Ahoada East'),
(684, 33, 'Ahoada West'),
(685, 33, 'Akuku-Toru'),
(686, 33, 'Andoni'),
(687, 33, 'Asari-Toru'),
(688, 33, 'Bonny'),
(689, 33, 'Degema'),
(690, 33, 'Eleme'),
(691, 33, 'Emuoha'),
(692, 33, 'Etche'),
(693, 33, 'Gokana'),
(694, 33, 'Ikwerre'),
(695, 33, 'Khana'),
(696, 33, 'Obio/Akpor'),
(697, 33, 'Ogba/Egbema/Ndoni'),
(698, 33, 'Ogu/Bolo'),
(699, 33, 'Okrika'),
(700, 33, 'Omuma'),
(701, 33, 'Opobo/Nkoro'),
(702, 33, 'Oyigbo'),
(703, 33, 'Port Harcourt'),
(704, 33, 'Tai'),
(705, 34, 'Binji'),
(706, 34, 'Bodinga'),
(707, 34, 'Dange Shuni'),
(708, 34, 'Gada'),
(709, 34, 'Goronyo'),
(710, 34, 'Gudu'),
(711, 34, 'Gwadabawa'),
(712, 34, 'Illela'),
(713, 34, 'Isa'),
(714, 34, 'Kebbe'),
(715, 34, 'Kware'),
(716, 34, 'Rabah'),
(717, 34, 'Sabon Birni'),
(718, 34, 'Shagari'),
(719, 34, 'Silame'),
(720, 34, 'Sokoto North'),
(721, 34, 'Sokoto South'),
(722, 34, 'Tambuwal'),
(723, 34, 'Tangaza'),
(724, 34, 'Tureta'),
(725, 34, 'Wamako'),
(726, 34, 'Wurno'),
(727, 34, 'Yabo'),
(728, 35, 'Ardo Kola'),
(729, 35, 'Bali'),
(730, 35, 'Donga'),
(731, 35, 'Gashaka'),
(732, 35, 'Gassol'),
(733, 35, 'Ibi'),
(734, 35, 'Jalingo'),
(735, 35, 'Karim Lamido'),
(736, 35, 'Kumi'),
(737, 35, 'Lau'),
(738, 35, 'Sardauna'),
(739, 35, 'Takum'),
(740, 35, 'Ussa'),
(741, 35, 'Wukari'),
(742, 35, 'Yorro'),
(743, 35, 'Zing'),
(744, 36, 'Bade'),
(745, 36, 'Bursari'),
(746, 36, 'Damaturu'),
(747, 36, 'Fika'),
(748, 36, 'Fune'),
(749, 36, 'Geidam'),
(750, 36, 'Gujba'),
(751, 36, 'Gulani'),
(752, 36, 'Jakusko'),
(753, 36, 'Karasuwa'),
(754, 36, 'Machina'),
(755, 36, 'Nangere'),
(756, 36, 'Nguru'),
(757, 36, 'Potiskum'),
(758, 36, 'Tarmuwa'),
(759, 36, 'Yunusari'),
(760, 36, 'Yusufari'),
(761, 37, 'Anka'),
(762, 37, 'Bakura'),
(763, 37, 'Birnin Magaji/Kiyaw'),
(764, 37, 'Bukkuyum'),
(765, 37, 'Bungudu'),
(766, 37, 'Gummi'),
(767, 37, 'Gusau'),
(768, 37, 'Kaura Namoda'),
(769, 37, 'Maradun'),
(770, 37, 'Maru'),
(771, 37, 'Shinkafi'),
(772, 37, 'Talata Mafara'),
(773, 37, 'Chafe'),
(774, 37, 'Zurmi')";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `messages`
$create_table = "CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `message_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `m_status_info`
$create_table = "CREATE TABLE IF NOT EXISTS `m_status_info` (
  `status_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `m_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `m_status_info`
$insert_data = "INSERT INTO `m_status_info` (`status_id`, `m_status`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Divorced'),
(4, 'Widow')";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `parent_info`
$create_table = "CREATE TABLE IF NOT EXISTS `parent_info` (
  `parent_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(200) NOT NULL,
  `password` varchar(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `payment_log`
$create_table = "CREATE TABLE IF NOT EXISTS `payment_log` (
  `payment_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `transaction_id` varchar(22) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `Amount` varchar(10) NOT NULL DEFAULT '0000.00',
  `amount_paid` varchar(20) NOT NULL DEFAULT '0000.00',
  `receipt_no` varchar(10) NOT NULL DEFAULT '00000',
  `bank_id` int(11) NOT NULL,
  `date_paid` varchar(25) NOT NULL,
  `balance` varchar(10) NOT NULL DEFAULT '0000.00',
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `payment_type`
$create_table = "CREATE TABLE IF NOT EXISTS `payment_type` (
  `payment_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `pin_details`
$create_table = "CREATE TABLE IF NOT EXISTS `pin_details` (
  `pin_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `pin_info`
$create_table = "CREATE TABLE IF NOT EXISTS `pin_info` (
  `pin_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `pin_code` varchar(20) NOT NULL,
  `date_generated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `post_info`
$create_table = "CREATE TABLE IF NOT EXISTS `post_info` (
  `post_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `post_info`
$insert_data = "INSERT INTO `post_info` (`post_id`, `position`) VALUES
(1, 'Principal'),
(2, 'V.P.Admin'),
(3, 'V.P.Acadmics'),
(4, 'Head Master/Mistress'),
(5, 'Teacher')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `privileges`
$create_table = "CREATE TABLE IF NOT EXISTS `privileges` (
  `privilege_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `privilege` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `privileges`
$insert_data = "INSERT INTO `privileges` (`privilege_id`, `privilege`) VALUES
(1, 'Administrator'),
(2, 'Subject Teacher'),
(3, 'Student'),
(4, 'Web Master'),
(5, 'Form Teacher'),
(6, 'Head Teacher'),
(7, 'Exam Officer'),
(8, 'House Master'),
(9, 'Account Officer'),
(10, 'Parent')";

mysqli_query($conn,$create_table);  
mysqli_query($conn,$insert_data);

//Table structure for table `qual_info`
$create_table = "CREATE TABLE IF NOT EXISTS `qual_info` (
  `qual_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `qualification` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `qual_info`
$insert_data = "INSERT INTO `qual_info` (`qual_id`, `qualification`) VALUES
(1, 'FSLC'),
(2, 'SSCE'),
(3, 'NCE'),
(4, 'ND'),
(5, 'HND'),
(6, 'B.Sc.'),
(7, 'B.Sc.Ed'),
(8, 'B.Tech'),
(9, 'B.Ed'),
(10, 'M.Sc.'),
(11, 'M.Ed.'),
(12, 'PGDE'),
(13, 'Ph.D')";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `rank_info`
$create_table = "CREATE TABLE IF NOT EXISTS `rank_info` (
  `rank_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `rank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `registered_subject`
$create_table = "CREATE TABLE IF NOT EXISTS `registered_subject` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `religion_info`
$create_table = "CREATE TABLE IF NOT EXISTS `religion_info` (
  `rel_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `religion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `religion_info`
$insert_data = "INSERT INTO `religion_info` (`rel_id`, `religion`) VALUES
(1, 'Christianity'),
(2, 'Islam'),
(3, 'Others')";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `report_log`
$create_table = "CREATE TABLE IF NOT EXISTS `report_log` (
  `report_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `result_publishing`
$create_table = "CREATE TABLE IF NOT EXISTS `result_publishing` (
  `rid` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `signature` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `publish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `resumption_date`
$create_table = "CREATE TABLE IF NOT EXISTS `resumption_date` (
  `date_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `next_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


mysqli_query($conn,$create_table);

//Table structure for table `sch_gallery`
$create_table = "CREATE TABLE IF NOT EXISTS `sch_gallery` (
  `img_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `image_name` varchar(45) NOT NULL,
  `caption` text NOT NULL,
  `date_created` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `sch_info`
$create_table = "CREATE TABLE IF NOT EXISTS `sch_info` (
  `sch_id` int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `other_phone` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT 0,
  `theme_code` varchar(10) NOT NULL DEFAULT '#0085B2',
  `sch_name` text NOT NULL,
  `sch_motto` varchar(30) NOT NULL,
  `sch_address` text NOT NULL,
  `sch_pmb` varchar(10) NOT NULL,
  `sch_logo` varchar(225) DEFAULT NULL,
  `public_key` text NOT NULL,
  `secret_key` text NOT NULL,
  `terms_condition` varchar(10) NOT NULL DEFAULT 'not agreed',
  `sch_year` varchar(11) NOT NULL,
  `sch_year2` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `show_pstn` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);   

//Table structure for table `sch_pin`
$create_table = "CREATE TABLE IF NOT EXISTS `sch_pin` (
  `sch_pin_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `pin_code` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);   

//Table structure for table `sch_theme`
$create_table = "CREATE TABLE IF NOT EXISTS `sch_theme` (
  `theme_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `theme_code` varchar(10) NOT NULL DEFAULT '#0085B2',
  `theme_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `sch_users`
$create_table = "CREATE TABLE IF NOT EXISTS `sch_users` (
  `user_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `priv_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(41) NOT NULL,
  `passport` varchar(225) NOT NULL DEFAULT '0',
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `score_info`
$create_table = "CREATE TABLE IF NOT EXISTS `score_info` (
  `score_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `first_ca` varchar(5) NOT NULL,
  `second_ca` varchar(5) NOT NULL,
  `third_ca` varchar(5) NOT NULL,
  `exam` varchar(5) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `aggregate_score` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `session_info`
$create_table = "CREATE TABLE IF NOT EXISTS `session_info` (
  `sid` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `session` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `done` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `session_info`
$insert_data = "INSERT INTO `session_info` (`sid`, `session`, `status`, `done`) VALUES
(1, '2022/2023', 1, 1),
(2, '2023/2024', 0, 1),
(3, '2024/2025', 0, 1),
(4, '2025/2026', 0, 0),
(5, '2026/2027', 0, 0),
(6, '2027/2028', 0, 0),
(7, '2028/2029', 0, 0),
(8, '2029/2030', 0, 0),
(9, '2030/2031', 0, 0),
(10, '2031/2032', 0, 0),
(11, '2032/2033', 0, 0),
(12, '2033/2034', 0, 0),
(13, '2034/2035', 0, 0),
(14, '2035/2036', 0, 0),
(15, '2036/2037', 0, 0),
(16, '2037/2038', 0, 0),
(17, '2038/2039', 0, 0),
(18, '2039/2040', 0, 0),
(19, '2040/2041', 0, 0),
(20, '2041/2042', 0, 0),
(21, '2042/2043', 0, 0),
(22, '2043/2044', 0, 0),
(23, '2044/2045', 0, 0),
(24, '2045/2046', 0, 0),
(25, '2046/2047', 0, 0),
(26, '2047/2048', 0, 0),
(27, '2048/2049', 0, 0),
(28, '2049/2050', 0, 0),
(29, '2050/2051', 0, 0),
(30, '2051/2052', 0, 0),
(31, '2052/2053', 0, 0),
(32, '2053/2054', 0, 0),
(33, '2054/2055', 0, 0),
(34, '2055/2056', 0, 0),
(35, '2056/2057', 0, 0),
(36, '2057/2058', 0, 0),
(37, '2058/2059', 0, 0),
(38, '2059/2060', 0, 0),
(39, '2060/2061', 0, 0),
(40, '2061/2062', 0, 0),
(41, '2062/2063', 0, 0),
(42, '2063/2064', 0, 0),
(43, '2064/2065', 0, 0),
(44, '2065/2066', 0, 0),
(45, '2066/2067', 0, 0),
(46, '2067/2068', 0, 0),
(47, '2068/2069', 0, 0),
(48, '2069/2070', 0, 0),
(49, '2070/2071', 0, 0),
(50, '2071/2072', 0, 0),
(51, '2072/2073', 0, 0),
(52, '2073/2074', 0, 0),
(53, '2074/2075', 0, 0),
(54, '2075/2076', 0, 0),
(55, '2076/2077', 0, 0),
(56, '2077/2078', 0, 0),
(57, '2078/2079', 0, 0),
(58, '2079/2080', 0, 0)";

mysqli_query($conn,$create_table);  
mysqli_query($conn,$insert_data);

//Table structure for table `settings`
$create_table = "CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `setting_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `settings`
$insert_data = "INSERT INTO `settings` (`setting_id`, `sch_id`, `setting_type`, `status`) VALUES
(1, 1, 'Show Position', 1)";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `staff_by_subject`
$create_table = "CREATE TABLE IF NOT EXISTS `staff_by_subject` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `staff_info`
$create_table = "CREATE TABLE IF NOT EXISTS `staff_info` (
  `staff_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 0,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `sex_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `state_id` int(11) NOT NULL,
  `lga` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `doa` varchar(10) NOT NULL,
  `qual_id` varchar(20) NOT NULL,
  `discipline` varchar(30) NOT NULL,
  `file_no` varchar(15) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `acc_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `staff_type_info`
$create_table = "CREATE TABLE IF NOT EXISTS `staff_type_info` (
  `type_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `staff_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `staff_type_info`
$insert_data = "INSERT INTO `staff_type_info` (`type_id`, `staff_type`) VALUES
(1, 'Academic'),
(2, 'Non academic')";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `state_info`
$create_table = "CREATE TABLE IF NOT EXISTS `state_info` (
  `state_id` int(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `state_name` varchar(27) NOT NULL,
  `state_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `state_info`
$insert_data = "INSERT INTO `state_info` (`state_id`, `state_name`, `state_code`) VALUES
(1, 'Abia', 'ABI\r'),
(2, 'Adamawa', 'ADA\r'),
(3, 'Akwa Ibom', 'AKW\r'),
(4, 'Anambra', 'ANA\r'),
(5, 'Bauchi', 'BAU\r'),
(6, 'Bayelsa', 'BAY\r'),
(7, 'Benue', 'BEN\r'),
(8, 'Borno', 'BOR\r'),
(9, 'Cross-River', 'CRO\r'),
(10, 'Delta', 'DEL\r'),
(11, 'Ebonyi', 'EBO\r'),
(12, 'Edo', 'EDO\r'),
(13, 'Ekiti', 'EKI\r'),
(14, 'Enugu', 'ENU\r'),
(15, 'FCT', 'FCT\r'),
(16, 'Gombe', 'GOM\r'),
(17, 'Imo', 'IMO\r'),
(18, 'Jigawa', 'JIG\r'),
(19, 'Kaduna', 'KAD\r'),
(20, 'Kano', 'KAN\r'),
(21, 'Katsina', 'KAT\r'),
(22, 'Kebbi', 'KEB\r'),
(23, 'Kogi', 'KOG\r'),
(24, 'Kwara', 'KWA\r'),
(25, 'Lagos', 'LAG\r'),
(26, 'Nasarawa', 'NAS\r'),
(27, 'Niger', 'NIG\r'),
(28, 'Ogun', 'OGU\r'),
(29, 'Ondo', 'OND\r'),
(30, 'Osun', 'OSU\r'),
(31, 'Oyo', 'OYO\r'),
(32, 'Plateau', 'PLA\r'),
(33, 'Rivers', 'RIV\r'),
(34, 'Sokoto', 'SOK\r'),
(35, 'Taraba', 'TAR\r'),
(36, 'Yobe', 'YOB\r'),
(37, 'Zamfara', 'ZAM\r')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `stdnt_com`
$create_table = "CREATE TABLE IF NOT EXISTS `stdnt_com` (
  `scom_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `stdnt_info`
$create_table = "CREATE TABLE IF NOT EXISTS `stdnt_info` (
  `stdnt_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `admn_no` varchar(15) NOT NULL,
  `sex_id` int(11) NOT NULL DEFAULT 0,
  `dob` varchar(10) NOT NULL DEFAULT '',
  `bld_grp` varchar(5) NOT NULL DEFAULT '0',
  `gtype` varchar(5) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT 0,
  `state_id` int(11) NOT NULL DEFAULT 0,
  `lga` varchar(30) NOT NULL DEFAULT '',
  `rel_id` int(11) NOT NULL DEFAULT 0,
  `p_name` varchar(50) NOT NULL DEFAULT '',
  `relationship` varchar(20) NOT NULL,
  `parent_contact` varchar(20) NOT NULL DEFAULT '',
  `parent_email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `yid` int(11) NOT NULL DEFAULT 0,
  `com_id` int(11) NOT NULL DEFAULT 0,
  `club_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `student_type`
$create_table = "CREATE TABLE IF NOT EXISTS `student_type` (
  `type_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `student_type`
$insert_data = "INSERT INTO `student_type` (`type_id`, `student_type`) VALUES
(1, 'Day Student'),
(2, 'Boarding Student')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `stu_assignment`
$create_table = "CREATE TABLE IF NOT EXISTS `stu_assignment` (
  `assgn_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date_of_subm` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `assign_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `subj_info`
$create_table = "CREATE TABLE IF NOT EXISTS `subj_info` (
  `subj_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `subj_title` varchar(30) NOT NULL,
  `subj_abr` varchar(10) NOT NULL,
  `subj_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `subj_info`
$insert_data = "INSERT INTO `subj_info` (`subj_id`, `subj_title`, `subj_abr`, `subj_type`) VALUES
(1, 'English Studies', 'Eng', 'Core'),
(2, 'Mathematics', 'Maths', 'Core'),
(3, 'Basic Science', 'B. SCI', 'Core'),
(4, 'Basic Technology', 'B. Tech', 'Core'),
(5, 'Social Studies', 'Soc. Stu', 'Core'),
(6, 'Computer Science', 'Comp', 'Core'),
(7, 'Agricultural Science', 'Agric', 'Core'),
(8, 'French', 'French', 'Core'),
(9, 'Civic Education', 'C. Edu', 'Core'),
(10, 'Physical & Health Education', 'P.H.E', 'Core'),
(11, 'Home Economics', 'H. Econ', 'Core'),
(12, 'Business Studies', 'Bus Stu', 'Core'),
(13, 'C.R.S', 'C.R.S', 'Elective'),
(14, 'I.R.S', 'I.R.S', 'Elective'),
(15, 'Cultural & Creative Art', 'C.C.A', 'Core'),
(16, 'Security Education', 'Secu. Edu', 'Core'),
(17, 'History', 'Hist.', 'Core'),
(18, 'Hausa Language', 'Hausa', 'Elective'),
(19, 'Igbo Language', 'Igbo', 'Elective'),
(20, 'Yoruba Language', 'Yoruba', 'Elective')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `teachers_com`
$create_table = "CREATE TABLE IF NOT EXISTS `teachers_com` (
  `com_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `teachers_com`
$insert_data = "INSERT INTO `teachers_com` (`com_id`, `comment`) VALUES
(1, 'Exhibits a positive outlook and attitude in the classroom.'),
(2, 'Shows enthusiasm for classroom activities.'),
(3, 'Strives to reach their full potential.'),
(4, 'Cooperates consistently with the teacher and other students.'),
(5, 'Courteous and shows good manners in the classroom.'),
(6, 'Responds appropriately when corrected.'),
(7, 'Resists the urge to be distracted by other students.'),
(8, 'Sets an example of excellence in behavior and cooperation.'),
(9, 'Shows respect for teachers and peers.'),
(10, 'Treats school property and the belongings of others with care and respect.'),
(11, 'Honest and trustworthy in dealings with others.'),
(12, 'Expresses ideas clearly, both verbally and through writing.'),
(13, 'Welcomes leadership roles in groups.'),
(14, 'Provides background knowledge about topics of particular interest'),
(15, 'Has a flair for dramatic reading and acting.'),
(16, 'Makes friends quickly in the classroom.'),
(17, 'Well-liked by classmates.'),
(18, 'Tackles classroom assignments, tasks, and group work in an organized manner.'),
(19, 'Completes assignments in the time allotted.'),
(20, 'A conscientious, hard-working student.'),
(21, 'A self-motivated student.'),
(22, 'Readily grasps new concepts and ideas.'),
(23, 'Uses free minutes of class time constructively.')";

mysqli_query($conn,$create_table);   
mysqli_query($conn,$insert_data);

//Table structure for table `term_info`
$create_table = "CREATE TABLE IF NOT EXISTS `term_info` (
  `term_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `term_title` enum('First Term','Second Term','Third Term') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `term_info`
$insert_data = "INSERT INTO `term_info` (`term_id`, `term_title`, `status`) VALUES
(1, 'First Term', 1),
(2, 'Second Term', 0),
(3, 'Third Term', 0)";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `testimonial`
$create_table = "CREATE TABLE IF NOT EXISTS `testimonial` (
  `cert_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `cert_passport` varchar(20) NOT NULL,
  `year_of_admn` int(11) NOT NULL,
  `year_of_grad` int(11) NOT NULL,
  `office_held` varchar(20) NOT NULL,
  `award` text NOT NULL,
  `hobbies` varchar(45) NOT NULL,
  `remark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

mysqli_query($conn,$create_table);

//Table structure for table `web_admin`
$create_table = "CREATE TABLE IF NOT EXISTS `web_admin` (
  `admin_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(20) NOT NULL,
  `password` varchar(41) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `web_admin`
$insert_data = "INSERT INTO `web_admin` (`admin_id`, `username`, `password`, `passport`, `priv_id`, `status`) VALUES
(1, 'onaretayo@gmail.com', '908316b9a0f612ff3cdc28129e6cbb4e', 'onaretayo.jpg', 4, 1)";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert_data);

//Table structure for table `year_info`
$create_table = "CREATE TABLE IF NOT EXISTS `year_info` (
  `year_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `year_title` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

# Dumping data for table `year_info`
$insert_data = "INSERT INTO `year_info` (`year_id`, `year_title`, `status`) VALUES
(1, '2022', 0),
(2, '2023', 0),
(3, '2024', 0),
(4, '2025', 0),
(5, '2026', 0),
(6, '2027', 0),
(7, '2028', 0),
(8, '2029', 0),
(9, '2030', 0),
(10, '2031', 0),
(11, '2032', 0),
(12, '2033', 0),
(13, '2034', 0),
(14, '2035', 0),
(15, '2036', 0),
(16, '2037', 0),
(17, '2038', 0),
(18, '2039', 0),
(19, '2040', 0),
(20, '2041', 0),
(21, '2042', 0),
(22, '2043', 0),
(23, '2044', 0),
(24, '2045', 0),
(25, '2046', 0),
(26, '2047', 0),
(27, '2048', 0),
(28, '2049', 0),
(29, '2050', 0),
(30, '2051', 0),
(31, '2052', 0),
(32, '2053', 0),
(33, '2054', 0),
(34, '2055', 0),
(35, '2056', 0),
(36, '2057', 0),
(37, '2058', 0),
(38, '2059', 0),
(39, '2060', 0),
(40, '2061', 0),
(41, '2062', 0),
(42, '2063', 0),
(43, '2064', 0),
(44, '2065', 0),
(45, '2066', 0),
(46, '2067', 0),
(47, '2068', 0),
(48, '2069', 0),
(49, '2070', 0),
(50, '2071', 0),
(51, '2072', 0),
(52, '2073', 0),
(53, '2074', 0),
(54, '2075', 0),
(55, '2076', 0),
(56, '2077', 0),
(57, '2078', 0),
(58, '2079', 0),
(59, '2080', 0),
(60, '2081', 0),
(61, '2082', 0),
(62, '2083', 0),
(63, '2084', 0),
(64, '2085', 0),
(65, '2086', 0),
(66, '2087', 0),
(67, '2088', 0),
(68, '2089', 0),
(69, '2090', 0),
(70, '2091', 0),
(71, '2092', 0),
(72, '2093', 0),
(73, '2094', 0),
(74, '2095', 0),
(75, '2096', 0),
(76, '2097', 0),
(77, '2098', 0),
(78, '2099', 0),
(79, '2100', 0),
(80, '2101', 0),
(81, '2102', 0),
(82, '2103', 0),
(83, '2104', 0),
(84, '2105', 0),
(85, '2106', 0),
(86, '2107', 0),
(87, '2108', 0),
(88, '2109', 0),
(89, '2110', 0),
(90, '2111', 0),
(91, '2112', 0),
(92, '2113', 0),
(93, '2114', 0),
(94, '2115', 0),
(95, '2116', 0),
(96, '2117', 0),
(97, '2118', 0),
(98, '2119', 0),
(99, '2120', 0),
(100, '2121', 0),
(101, '2122', 0),
(102, '2123', 0),
(103, '2124', 0),
(104, '2125', 0),
(105, '2126', 0),
(106, '2127', 0),
(107, '2128', 0),
(108, '2129', 0),
(109, '2130', 0),
(110, '2131', 0),
(111, '2132', 0),
(112, '2133', 0),
(113, '2134', 0),
(114, '2135', 0),
(115, '2136', 0),
(116, '2137', 0),
(117, '2138', 0),
(118, '2139', 0),
(119, '2140', 0),
(120, '2141', 0),
(121, '2142', 0),
(122, '2143', 0),
(123, '2144', 0),
(124, '2145', 0),
(125, '2146', 0),
(126, '2147', 0),
(127, '2148', 0),
(128, '2149', 0),
(129, '2150', 0),
(130, '2151', 0),
(131, '2152', 0),
(132, '2153', 0),
(133, '2154', 0),
(134, '2155', 0),
(135, '2156', 0),
(136, '2157', 0),
(137, '2158', 0),
(138, '2159', 0),
(139, '2160', 0),
(140, '2161', 0),
(141, '2162', 0),
(142, '2163', 0),
(143, '2164', 0),
(144, '2165', 0),
(145, '2166', 0),
(146, '2167', 0),
(147, '2168', 0),
(148, '2169', 0),
(149, '2170', 0),
(150, '2171', 0),
(151, '2172', 0),
(152, '2173', 0),
(153, '2174', 0),
(154, '2175', 0),
(155, '2176', 0),
(156, '2177', 0),
(157, '2178', 0),
(158, '2179', 0),
(159, '2180', 0),
(160, '2181', 0),
(161, '2182', 0),
(162, '2183', 0),
(163, '2184', 0),
(164, '2185', 0),
(165, '2186', 0),
(166, '2187', 0),
(167, '2188', 0),
(168, '2189', 0),
(169, '2190', 0),
(170, '2191', 0),
(171, '2192', 0),
(172, '2193', 0),
(173, '2194', 0),
(174, '2195', 0),
(175, '2196', 0),
(176, '2197', 0),
(177, '2198', 0),
(178, '2199', 0),
(179, '2200', 0),
(180, '2201', 0),
(181, '2202', 0),
(182, '2203', 0),
(183, '2204', 0),
(184, '2205', 0),
(185, '2206', 0),
(186, '2207', 0),
(187, '2208', 0),
(188, '2209', 0),
(189, '2210', 0),
(190, '2211', 0),
(191, '2212', 0),
(192, '2213', 0),
(193, '2214', 0),
(194, '2215', 0),
(195, '2216', 0),
(196, '2217', 0),
(197, '2218', 0),
(198, '2219', 0),
(199, '2220', 0),
(200, '2221', 0),
(201, '2222', 0)";

mysqli_query($conn,$create_table);
mysqli_query($conn,$insert);
} */
?>
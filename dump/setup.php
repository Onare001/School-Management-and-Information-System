<?php
// Create connection
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$dbname = addslashes($_POST['dbname']);
	$result = mysqli_query($conn,"SHOW DATABASES LIKE '$dbname'");
	if (empty($dbname)){
		$msg = 'Enter Database Name';
	} else if (mysqli_num_rows($result) === 1) {	
		$msg = 'Database Name Already exist';
	} else {
		// Create database
		if (mysqli_query($conn,"CREATE DATABASE $dbname")) {
			$msg = 'Database created successfully';
			
		// Create tables
		$result = mysqli_query($conn,"SHOW DATABASES LIKE '$dbname'");
		if (mysqli_num_rows($result) === 1) {
			// Create tables
			mysqli_select_db($conn, $dbname);

			//-- Table structure for table `account_details`
			$sql = "CREATE TABLE `account_details` (
			  `acc_id` int(11) NOT NULL,
			  `sch_id` int(11) NOT NULL,
			  `acc_no` varchar(10) NOT NULL,
			  `acc_name` varchar(150) NOT NULL,
			  `bank_id` int(11) NOT NULL,
			  `payment_id` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			if (mysqli_query($conn, $sql)) {
				echo "Table 'account_details' created successfully";
			} else {
				echo "Error creating table 'users': " . mysqli_error($conn);
			}

			// -- Table structure for table `admission`
			$sql = "CREATE TABLE `admission` (
				  `appl_id` int(11) NOT NULL,
				  `last_name` varchar(255) NOT NULL,
				  `first_name` varchar(255) NOT NULL,
				  `middle_name` varchar(255) NOT NULL,
				  `sch_id` int(11) NOT NULL,
				  `class_id` int(11) NOT NULL,
				  `appl_no` varchar(25) NOT NULL,
				  `dob` date NOT NULL,
				  `session_id` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			if (mysqli_query($conn, $sql)) {
				echo "Table 'admmission' created successfully";
			} else {
				echo "Error creating table 'admission': " . mysqli_error($conn);
			}
			//header('location: sign_up');
		} else {
			$ms = 'Unable to create database';
			$msg = '<span class="bg bg-danger">&nbsp;'.$ms.'&nbsp;</span>';
		} 
		} else {
			$msg = 'Error creating database: ' . mysqli_error($conn);
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Database and Tables</title>
</head>
<body>

	<h1>Create Database and Tables</h1>
	<?php echo (isset($msg)) ? $msg : ''?>
	<form method="post">
		<label for="dbname">Database Name:</label>
		<input type="text" id="dbname" name="dbname" required><br><br>
		<input type="submit" value="Create Database">
	</form>

</body>
</html>
<!--

--
-- Table structure for table `assgn_questions`
--

CREATE TABLE `assgn_questions` (
  `aques_id` int(11) NOT NULL,
  `assgn_question` varchar(200) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attempted_payment`
--

CREATE TABLE `attempted_payment` (
  `trial_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attd_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance` varchar(20) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `bank_id` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_info`
--

CREATE TABLE `blood_info` (
  `bld_id` int(11) NOT NULL,
  `group` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `broadcast_msg`
--

CREATE TABLE `broadcast_msg` (
  `msg_id` int(11) NOT NULL,
  `information` text NOT NULL,
  `audience` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cand_questions`
--

CREATE TABLE `cand_questions` (
  `cand_ques_id` int(11) NOT NULL,
  `sn_qno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `cand_answer` text NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_score`
--

CREATE TABLE `cbt_score` (
  `score_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_cat`
--

CREATE TABLE `class_cat` (
  `cat_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_info`
--

CREATE TABLE `class_info` (
  `class_id` int(10) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_timetable`
--

CREATE TABLE `class_timetable` (
  `id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_info`
--

CREATE TABLE `club_info` (
  `club_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `club_name` varchar(20) NOT NULL,
  `club_abbr` varchar(20) NOT NULL,
  `staff_in_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cum_result`
--

CREATE TABLE `cum_result` (
  `score_id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examination_question`
--

CREATE TABLE `examination_question` (
  `question_id` int(255) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_timetable`
--

CREATE TABLE `exam_timetable` (
  `id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_exam`
--

CREATE TABLE `e_exam` (
  `exam_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `no_of_question` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_teacher_info`
--

CREATE TABLE `form_teacher_info` (
  `ft_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gender_info`
--

CREATE TABLE `gender_info` (
  `sex_id` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genotype_info`
--

CREATE TABLE `genotype_info` (
  `geno_id` int(11) NOT NULL,
  `gtype` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_info`
--

CREATE TABLE `house_info` (
  `house_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `house` varchar(20) NOT NULL,
  `house_color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_info`
--

CREATE TABLE `ledger_info` (
  `payment_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_notes`
--

CREATE TABLE `lesson_notes` (
  `lesson_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `topic` text NOT NULL,
  `lesson_note` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `local_governments`
--

CREATE TABLE `local_governments` (
  `lg_id` int(11) NOT NULL,
  `state_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='Local governments in Nigeria.';

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `message_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_status_info`
--

CREATE TABLE `m_status_info` (
  `status_id` int(11) NOT NULL,
  `m_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent_info`
--

CREATE TABLE `parent_info` (
  `parent_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE `payment_log` (
  `payment_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pin_details`
--

CREATE TABLE `pin_details` (
  `pin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pin_info`
--

CREATE TABLE `pin_info` (
  `pin_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `date_generated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_info`
--

CREATE TABLE `post_info` (
  `post_id` int(11) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `privilege_id` int(11) NOT NULL,
  `privilege` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qual_info`
--

CREATE TABLE `qual_info` (
  `qual_id` int(11) NOT NULL,
  `qualification` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rank_info`
--

CREATE TABLE `rank_info` (
  `rank_id` int(11) NOT NULL,
  `rank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_subject`
--

CREATE TABLE `registered_subject` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `religion_info`
--

CREATE TABLE `religion_info` (
  `rel_id` int(11) NOT NULL,
  `religion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_log`
--

CREATE TABLE `report_log` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result_publishing`
--

CREATE TABLE `result_publishing` (
  `rid` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `signature` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `publish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-->

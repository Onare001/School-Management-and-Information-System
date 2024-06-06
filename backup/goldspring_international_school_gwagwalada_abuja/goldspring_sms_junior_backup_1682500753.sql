

CREATE TABLE `account_details` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `acc_no` varchar(10) NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO account_details VALUES("1","1","0077262755","Goldspring International School","1","1");



CREATE TABLE `assgn_questions` (
  `aques_id` int(11) NOT NULL AUTO_INCREMENT,
  `assgn_question` varchar(200) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`aques_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO assgn_questions VALUES("9","Social Studies-1-1.png","5","1","1","1");
INSERT INTO assgn_questions VALUES("10","Civic Education-1-2022/2023.png","9","1","1","1");
INSERT INTO assgn_questions VALUES("11","Civic Education-1-.jpg","9","1","1","1");
INSERT INTO assgn_questions VALUES("12","Civic Education-2-.","9","1","2","0");



CREATE TABLE `attempted_payment` (
  `trial_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `online_status` int(11) NOT NULL,
  PRIMARY KEY (`trial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO attempted_payment VALUES("9","SMS-638-244-336","60000000","1","13","1","1","1","1","1","0000-00-00","4");
INSERT INTO attempted_payment VALUES("10","SMS-259-425-786","5000","1","13","1","1","1","1","2","0000-00-00","4");



CREATE TABLE `attendance` (
  `attd_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attendance` varchar(20) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`attd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO attendance VALUES("1","13","present","1","1","1","1","1","0000-00-00");
INSERT INTO attendance VALUES("2","16","absent","1","1","1","1","1","2023-04-19");



CREATE TABLE `bank_info` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(50) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO bank_info VALUES("1","Access Bank");
INSERT INTO bank_info VALUES("2","Ecobank Nigeria");
INSERT INTO bank_info VALUES("3","Fidelity Bank Nigeria");
INSERT INTO bank_info VALUES("4","First City Monument Bank");
INSERT INTO bank_info VALUES("5","Guaranty Trust Bank");
INSERT INTO bank_info VALUES("6","Keystone Bank Limited");
INSERT INTO bank_info VALUES("7","Polaris Bank");
INSERT INTO bank_info VALUES("8","Stanbic IBTC Bank");
INSERT INTO bank_info VALUES("9","Sterling Bank");
INSERT INTO bank_info VALUES("10","Union Bank of Nigeria");
INSERT INTO bank_info VALUES("11","United Bank for Africa");
INSERT INTO bank_info VALUES("12","Unity Bank plc");
INSERT INTO bank_info VALUES("13","Wema Bank");
INSERT INTO bank_info VALUES("14","Zenith Bank");



CREATE TABLE `blood_info` (
  `bld_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(5) NOT NULL,
  PRIMARY KEY (`bld_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO blood_info VALUES("1","A+");
INSERT INTO blood_info VALUES("2","B+");
INSERT INTO blood_info VALUES("3","AB+");
INSERT INTO blood_info VALUES("4","O+");



CREATE TABLE `broadcast_msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `information` text NOT NULL,
  `audience` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO broadcast_msg VALUES("1","All Form Teachers are to complete their student Biodata Record before 31th October","1","1","0","0");



CREATE TABLE `cand_questions` (
  `cand_ques_id` int(11) NOT NULL AUTO_INCREMENT,
  `sn_qno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `cand_answer` text NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`cand_ques_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

INSERT INTO cand_questions VALUES("1","1","16","9","1","Daniel","1","1");
INSERT INTO cand_questions VALUES("2","2","16","9","2","Democracy","1","1");
INSERT INTO cand_questions VALUES("3","3","16","9","8","DVD","1","1");
INSERT INTO cand_questions VALUES("4","4","16","9","3","1st january 1914","1","1");
INSERT INTO cand_questions VALUES("5","5","16","9","4","fff","1","1");
INSERT INTO cand_questions VALUES("6","6","16","9","6","KWANKWASO","1","1");
INSERT INTO cand_questions VALUES("7","7","16","9","5","yyy","1","1");
INSERT INTO cand_questions VALUES("8","8","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("9","9","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("10","10","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("11","11","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("12","12","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("13","13","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("14","14","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("15","15","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("16","16","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("17","17","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("18","18","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("19","19","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("20","20","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("21","21","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("22","22","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("23","23","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("24","24","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("25","25","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("26","26","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("27","27","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("28","28","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("29","29","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("30","30","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("31","31","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("32","32","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("33","33","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("34","34","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("35","35","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("36","36","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("37","37","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("38","38","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("39","39","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("40","40","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("41","41","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("42","42","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("43","43","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("44","44","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("45","45","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("46","46","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("47","47","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("48","48","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("49","49","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("50","50","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("51","51","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("52","52","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("53","53","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("54","54","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("55","55","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("56","56","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("57","57","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("58","58","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("59","59","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("60","60","16","9","0","","1","1");
INSERT INTO cand_questions VALUES("61","1","13","9","8","","1","1");
INSERT INTO cand_questions VALUES("62","2","13","9","1","Buhari","1","1");
INSERT INTO cand_questions VALUES("63","3","13","9","6","","1","1");
INSERT INTO cand_questions VALUES("64","4","13","9","3","","1","1");
INSERT INTO cand_questions VALUES("65","5","13","9","5","","1","1");
INSERT INTO cand_questions VALUES("66","6","13","9","2","Democracy","1","1");
INSERT INTO cand_questions VALUES("67","7","13","9","4","","1","1");
INSERT INTO cand_questions VALUES("68","8","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("69","9","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("70","10","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("71","11","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("72","12","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("73","13","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("74","14","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("75","15","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("76","16","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("77","17","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("78","18","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("79","19","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("80","20","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("81","21","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("82","22","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("83","23","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("84","24","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("85","25","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("86","26","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("87","27","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("88","28","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("89","29","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("90","30","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("91","31","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("92","32","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("93","33","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("94","34","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("95","35","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("96","36","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("97","37","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("98","38","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("99","39","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("100","40","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("101","41","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("102","42","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("103","43","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("104","44","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("105","45","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("106","46","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("107","47","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("108","48","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("109","49","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("110","50","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("111","51","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("112","52","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("113","53","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("114","54","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("115","55","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("116","56","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("117","57","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("118","58","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("119","59","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("120","60","13","9","0","","1","1");
INSERT INTO cand_questions VALUES("121","1","14","9","2","","1","1");
INSERT INTO cand_questions VALUES("122","2","14","9","1","","1","1");
INSERT INTO cand_questions VALUES("123","3","14","9","8","","1","1");
INSERT INTO cand_questions VALUES("124","4","14","9","5","","1","1");
INSERT INTO cand_questions VALUES("125","5","14","9","4","","1","1");
INSERT INTO cand_questions VALUES("126","6","14","9","3","","1","1");
INSERT INTO cand_questions VALUES("127","7","14","9","6","","1","1");
INSERT INTO cand_questions VALUES("128","8","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("129","9","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("130","10","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("131","11","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("132","12","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("133","13","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("134","14","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("135","15","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("136","16","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("137","17","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("138","18","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("139","19","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("140","20","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("141","21","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("142","22","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("143","23","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("144","24","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("145","25","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("146","26","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("147","27","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("148","28","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("149","29","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("150","30","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("151","31","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("152","32","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("153","33","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("154","34","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("155","35","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("156","36","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("157","37","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("158","38","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("159","39","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("160","40","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("161","41","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("162","42","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("163","43","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("164","44","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("165","45","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("166","46","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("167","47","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("168","48","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("169","49","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("170","50","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("171","51","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("172","52","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("173","53","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("174","54","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("175","55","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("176","56","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("177","57","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("178","58","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("179","59","14","9","0","","1","1");
INSERT INTO cand_questions VALUES("180","60","14","9","0","","1","1");



CREATE TABLE `cbt_score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO cbt_score VALUES("2","16","1","1","9","1","1","2");
INSERT INTO cbt_score VALUES("3","14","1","2","9","1","1","0");



CREATE TABLE `class_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO class_cat VALUES("1","1","A");
INSERT INTO class_cat VALUES("2","1","B");



CREATE TABLE `class_info` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO class_info VALUES("1","0","JS 1");
INSERT INTO class_info VALUES("2","0","JS 2");
INSERT INTO class_info VALUES("3","0","JS 3");
INSERT INTO class_info VALUES("4","0","Graduated");



CREATE TABLE `class_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO class_timetable VALUES("1","1","1","1","2","Monday","1");
INSERT INTO class_timetable VALUES("2","1","1","1","1","Tuesday","2");
INSERT INTO class_timetable VALUES("3","1","1","1","3","wednesday","3");
INSERT INTO class_timetable VALUES("4","1","1","1","9","wednesday","4");
INSERT INTO class_timetable VALUES("5","1","1","1","9","wednesday","4");
INSERT INTO class_timetable VALUES("6","1","2","1","9","monday","1");
INSERT INTO class_timetable VALUES("7","1","1","1","6","monday","6");
INSERT INTO class_timetable VALUES("8","1","3","1","9","wednesday","4");
INSERT INTO class_timetable VALUES("9","1","3","1","9","thursday","4");
INSERT INTO class_timetable VALUES("10","1","1","1","13","wednesday","3");
INSERT INTO class_timetable VALUES("11","1","2","1","13","monday","5");
INSERT INTO class_timetable VALUES("12","1","3","1","13","tuesday","4");



CREATE TABLE `club_info` (
  `club_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `club_name` varchar(20) NOT NULL,
  `club_abbr` varchar(20) NOT NULL,
  `staff_in_charge` int(11) NOT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO club_info VALUES("1","1","JETS Club","JETS","0");
INSERT INTO club_info VALUES("2","1","PRESS Club","PRESS","5");



CREATE TABLE `cum_result` (
  `score_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `sid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

INSERT INTO cum_result VALUES("1","1","9","1","1","13","73","52","0","125","24","94","1","1");
INSERT INTO cum_result VALUES("36","1","9","1","1","36","71","0","0","71","24","94","1","1");
INSERT INTO cum_result VALUES("37","1","9","1","1","32","93","0","0","93","31","58","1","1");
INSERT INTO cum_result VALUES("38","1","9","1","1","14","42","0","0","42","14","38","1","1");
INSERT INTO cum_result VALUES("39","1","9","1","1","15","40","0","0","40","13","35","1","1");
INSERT INTO cum_result VALUES("40","1","9","1","1","51","45","0","0","45","15","40","1","1");
INSERT INTO cum_result VALUES("42","1","9","1","1","16","65","95","100","260","87","424","1","1");
INSERT INTO cum_result VALUES("43","1","9","1","1","33","70","0","0","70","23","52","1","1");
INSERT INTO cum_result VALUES("44","1","9","1","1","28","36","0","0","36","12","31","1","1");
INSERT INTO cum_result VALUES("45","1","9","1","1","35","92","0","0","92","31","31","1","1");
INSERT INTO cum_result VALUES("46","1","9","1","1","18","42","0","0","42","14","14","1","1");
INSERT INTO cum_result VALUES("47","1","9","1","1","37","29","0","0","29","10","10","1","1");
INSERT INTO cum_result VALUES("48","1","9","1","1","47","88","0","0","88","29","29","1","1");
INSERT INTO cum_result VALUES("49","1","9","1","1","39","40","0","0","40","13","13","1","1");
INSERT INTO cum_result VALUES("50","1","9","1","1","17","57","0","0","57","19","19","1","1");
INSERT INTO cum_result VALUES("51","1","9","1","1","48","72","0","0","72","24","24","1","1");
INSERT INTO cum_result VALUES("52","1","9","1","1","49","71","0","0","71","24","24","1","1");
INSERT INTO cum_result VALUES("53","1","9","1","1","24","90","0","0","90","30","30","1","1");
INSERT INTO cum_result VALUES("54","1","5","1","1","16","100","0","0","100","33","424","1","1");
INSERT INTO cum_result VALUES("55","1","9","1","1","44","61","0","0","61","20","20","1","1");
INSERT INTO cum_result VALUES("56","1","9","1","1","42","60","0","0","60","20","20","1","1");
INSERT INTO cum_result VALUES("57","1","9","1","1","20","60","0","0","60","20","20","1","1");
INSERT INTO cum_result VALUES("58","1","15","1","1","16","96","0","0","96","32","424","1","1");
INSERT INTO cum_result VALUES("59","1","1","1","1","16","95","0","0","95","32","424","1","1");
INSERT INTO cum_result VALUES("60","1","7","1","1","16","96","0","0","96","32","424","1","1");
INSERT INTO cum_result VALUES("61","1","3","1","1","16","86","0","0","86","29","424","1","1");
INSERT INTO cum_result VALUES("62","1","10","1","1","16","40","0","0","40","13","424","1","1");
INSERT INTO cum_result VALUES("63","1","14","1","1","16","86","0","0","86","29","424","1","1");
INSERT INTO cum_result VALUES("64","1","11","1","1","16","31","0","0","31","10","424","1","1");
INSERT INTO cum_result VALUES("65","1","16","1","1","16","36","0","0","36","12","424","1","1");
INSERT INTO cum_result VALUES("66","1","2","1","1","16","33","0","0","33","11","424","1","1");
INSERT INTO cum_result VALUES("67","1","6","1","1","16","50","0","0","50","17","424","1","1");
INSERT INTO cum_result VALUES("68","1","4","1","1","16","42","0","0","42","14","424","1","1");
INSERT INTO cum_result VALUES("69","1","8","1","1","16","45","0","0","45","15","424","1","1");
INSERT INTO cum_result VALUES("70","1","9","1","1","27","62","0","0","62","21","21","1","1");
INSERT INTO cum_result VALUES("71","1","9","1","1","25","60","0","0","60","20","20","1","1");
INSERT INTO cum_result VALUES("72","1","9","1","1","23","40","0","0","40","13","13","1","1");
INSERT INTO cum_result VALUES("73","1","9","1","1","30","43","0","0","43","14","14","1","1");
INSERT INTO cum_result VALUES("74","1","9","1","1","40","93","0","0","93","31","31","1","1");
INSERT INTO cum_result VALUES("75","1","9","1","1","19","93","0","0","93","31","31","1","1");
INSERT INTO cum_result VALUES("76","1","9","1","1","31","41","0","0","41","14","14","1","1");
INSERT INTO cum_result VALUES("77","1","9","1","1","46","42","0","0","42","14","14","1","1");
INSERT INTO cum_result VALUES("78","1","9","1","1","45","62","0","0","62","21","21","1","1");
INSERT INTO cum_result VALUES("79","1","9","1","1","41","60","0","0","98","13","13","1","1");
INSERT INTO cum_result VALUES("80","1","9","1","1","26","33","0","0","69","12","12","1","1");
INSERT INTO cum_result VALUES("81","1","9","1","1","21","51","0","0","90","13","13","1","1");
INSERT INTO cum_result VALUES("82","1","8","1","1","13","40","0","0","40","13","94","1","1");
INSERT INTO cum_result VALUES("83","1","9","1","1","22","51","0","0","88","12","12","1","1");
INSERT INTO cum_result VALUES("84","1","9","1","1","29","39","0","0","39","13","13","1","1");
INSERT INTO cum_result VALUES("85","1","9","1","1","43","40","0","0","40","13","13","1","1");
INSERT INTO cum_result VALUES("86","1","9","1","1","38","77","0","0","77","26","26","1","1");
INSERT INTO cum_result VALUES("87","1","9","1","1","34","78","0","0","78","26","26","1","1");
INSERT INTO cum_result VALUES("88","1","9","1","1","50","38","0","0","38","13","37","1","1");
INSERT INTO cum_result VALUES("89","1","5","1","1","13","55","0","0","55","18","94","1","1");
INSERT INTO cum_result VALUES("90","1","8","1","1","36","64","0","0","64","21","94","1","1");
INSERT INTO cum_result VALUES("91","1","15","1","1","36","84","0","0","84","28","94","1","1");
INSERT INTO cum_result VALUES("92","1","15","1","1","13","67","0","0","67","22","94","1","1");
INSERT INTO cum_result VALUES("93","1","1","2","1","52","95","0","0","95","0","0","0","1");
INSERT INTO cum_result VALUES("94","1","5","3","1","94","55","0","0","55","0","0","0","1");
INSERT INTO cum_result VALUES("95","1","9","1","1","96","39","0","0","39","13","13","1","1");
INSERT INTO cum_result VALUES("96","1","12","1","1","16","90","0","0","90","30","424","0","1");
INSERT INTO cum_result VALUES("97","1","21","1","1","16","85","0","0","85","28","424","0","1");
INSERT INTO cum_result VALUES("98","1","5","1","1","50","71","0","0","71","24","37","0","1");
INSERT INTO cum_result VALUES("99","1","15","1","1","32","46","0","0","46","15","58","0","1");
INSERT INTO cum_result VALUES("100","1","15","1","1","14","73","0","0","73","24","38","0","1");
INSERT INTO cum_result VALUES("101","1","5","1","1","33","86","0","0","86","29","52","0","1");
INSERT INTO cum_result VALUES("102","1","8","3","1","94","82","0","0","82","0","0","0","1");
INSERT INTO cum_result VALUES("103","1","8","3","1","87","41","0","0","41","0","0","0","1");
INSERT INTO cum_result VALUES("104","1","8","3","1","83","35","0","0","35","0","0","0","1");
INSERT INTO cum_result VALUES("105","1","8","3","1","81","40","0","0","40","0","0","0","1");
INSERT INTO cum_result VALUES("106","1","8","3","1","88","93","0","0","93","0","0","0","1");
INSERT INTO cum_result VALUES("107","1","8","3","1","89","42","0","0","42","0","0","0","1");
INSERT INTO cum_result VALUES("108","1","8","3","1","92","44","0","0","44","0","0","0","1");
INSERT INTO cum_result VALUES("109","1","8","3","1","84","42","0","0","42","0","0","0","1");
INSERT INTO cum_result VALUES("110","1","8","3","1","95","39","0","0","39","0","0","0","1");
INSERT INTO cum_result VALUES("111","1","8","3","1","90","97","0","0","97","0","0","0","1");
INSERT INTO cum_result VALUES("112","1","8","3","1","85","43","0","0","43","0","0","0","1");
INSERT INTO cum_result VALUES("113","1","8","3","1","91","88","0","0","88","0","0","0","1");
INSERT INTO cum_result VALUES("114","1","8","3","1","86","32","0","0","32","0","0","0","1");
INSERT INTO cum_result VALUES("115","1","8","3","1","82","45","0","0","45","0","0","0","1");
INSERT INTO cum_result VALUES("116","1","8","3","1","93","81","0","0","81","0","0","0","1");
INSERT INTO cum_result VALUES("117","1","15","1","1","15","66","0","0","66","22","35","0","1");
INSERT INTO cum_result VALUES("118","1","2","1","1","13","51","8","0","59","17","94","0","1");
INSERT INTO cum_result VALUES("119","1","2","1","1","36","62","42","0","104","21","94","0","1");
INSERT INTO cum_result VALUES("120","1","2","1","1","32","37","42","0","79","12","58","0","1");
INSERT INTO cum_result VALUES("121","1","2","1","1","51","76","0","0","76","25","40","0","1");
INSERT INTO cum_result VALUES("122","1","2","1","1","28","57","72","0","129","19","31","0","1");
INSERT INTO cum_result VALUES("123","1","9","2","1","52","55","0","0","55","0","0","0","1");
INSERT INTO cum_result VALUES("124","1","2","1","1","50","0","40","0","40","0","0","0","1");
INSERT INTO cum_result VALUES("125","1","15","2","1","52","44","0","0","44","0","0","0","1");
INSERT INTO cum_result VALUES("126","1","5","2","1","52","60","0","0","60","0","0","0","1");
INSERT INTO cum_result VALUES("127","1","2","1","1","18","76","0","0","76","0","0","0","1");
INSERT INTO cum_result VALUES("128","1","2","1","1","37","76","0","0","76","0","0","0","1");



CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("1","Art");
INSERT INTO department VALUES("2","Business");
INSERT INTO department VALUES("3","Science");
INSERT INTO department VALUES("4","Mathematics");
INSERT INTO department VALUES("5","Languages");
INSERT INTO department VALUES("6","Social Science");
INSERT INTO department VALUES("7","Vocational");
INSERT INTO department VALUES("8","Administration");



CREATE TABLE `e_exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `no_of_question` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO e_exam VALUES("1","1","1","9","1","1","exam","30","60","1");



CREATE TABLE `exam_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO exam_timetable VALUES("1","1","1","1","10","2022","Morning");
INSERT INTO exam_timetable VALUES("2","1","1","1","6","2022-11-06","Mid Morning");
INSERT INTO exam_timetable VALUES("3","1","1","1","12","2022-11-06","Afternoon");
INSERT INTO exam_timetable VALUES("4","1","1","1","2","2022-11-05","Mid Morning");
INSERT INTO exam_timetable VALUES("5","1","1","1","7","2022-11-07","Afternoon");
INSERT INTO exam_timetable VALUES("6","1","1","1","6","2022-11-25","Morning");
INSERT INTO exam_timetable VALUES("7","1","1","1","18","2022-12-01","Mid Morning");
INSERT INTO exam_timetable VALUES("8","1","1","1","16","2023-04-20","Morning");
INSERT INTO exam_timetable VALUES("9","1","1","1","4","2023-04-20","Morning");



CREATE TABLE `examination_question` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO examination_question VALUES("1","1","1","9","1","1","                                            Who is the current president of Nigeria                                        ","Daniel","Buhari","Ngozi","Esther","Buhari","1","0");
INSERT INTO examination_question VALUES("2","1","1","9","1","1","--------------------------- is the government of the people by the people and for the people                     ","Technocracy","Democracy","Autocracy","Monarchy","Democracy","1","0");
INSERT INTO examination_question VALUES("3","1","1","9","1","1","Nigeria was amagamated in what date month and year","1st january 1914","1st october 1960","25th december 2030","11th november 2012","0","1","0");
INSERT INTO examination_question VALUES("4","1","1","9","1","1","<font color="#000000"><span style="background-color: rgb(255, 255, 0);">dddddddddddd</span></font>","rrr","fff","hhh","ggg","0","1","0");
INSERT INTO examination_question VALUES("5","1","1","9","1","1","<span style="font-family: Tahoma;">?fbgfcghfyjhgjfghygfiygfjy</span>","rrr","ttt","yyy","iii","0","1","0");
INSERT INTO examination_question VALUES("6","1","1","9","1","1","who is the presidential candidate of NNPP","SOWARE","PETER OBI","KWANKWASO","TUNUBU","kwankwaso","1","0");
INSERT INTO examination_question VALUES("7","1","1","13","1","1","Who is the Mother of Jesus","Mary","Dorcas","Esther","Elizabeth","0","1","0");
INSERT INTO examination_question VALUES("8","1","1","9","1","1","Which of the following is not a network device","Router","Hub","DVD","Switch","0","1","0");
INSERT INTO examination_question VALUES("9","1","1","9","1","1","List 5 types of power?","","","","","0","2","0");
INSERT INTO examination_question VALUES("10","1","1","9","1","1","What is Democracy?","Hence, List and explain one arm of government","List the 3 tiers of government in Nigeria","Mention the types of Democracy you know","Explain Drug Abuse","0","2","0");
INSERT INTO examination_question VALUES("11","1","1","13","1","1","tyhgtf<hr>","tyry","tyy","tyyf","ghfgh","0","1","0");



CREATE TABLE `form_teacher_info` (
  `ft_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO form_teacher_info VALUES("1","2","1","1","1");
INSERT INTO form_teacher_info VALUES("6","12","1","1","1");
INSERT INTO form_teacher_info VALUES("7","6","1","1","1");
INSERT INTO form_teacher_info VALUES("9","10","1","1","1");



CREATE TABLE `gender_info` (
  `sex_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`sex_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO gender_info VALUES("1","Male");
INSERT INTO gender_info VALUES("2","Female");
INSERT INTO gender_info VALUES("3","Others");



CREATE TABLE `genotype_info` (
  `geno_id` int(11) NOT NULL AUTO_INCREMENT,
  `gtype` varchar(5) NOT NULL,
  PRIMARY KEY (`geno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO genotype_info VALUES("1","AA");
INSERT INTO genotype_info VALUES("2","AS");
INSERT INTO genotype_info VALUES("3","SS");



CREATE TABLE `house_info` (
  `house_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `house` varchar(20) NOT NULL,
  `house_color` varchar(20) NOT NULL,
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO house_info VALUES("1","1","England","yellow");
INSERT INTO house_info VALUES("2","1","Africa","#b62b2b");
INSERT INTO house_info VALUES("3","1","Europe","#3a9d39");



CREATE TABLE `ledger_info` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `payment_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO ledger_info VALUES("2","1","1","22500","22500","00001","2023-04-16T00:48:12.000Z","0","13","1","1","1","1","3");
INSERT INTO ledger_info VALUES("3","1","1","22500","10000","00002","2023-04-16T00:56:01.000Z","-5000","81","3","1","1","1","3");
INSERT INTO ledger_info VALUES("4","1","2","5000","10000","00001","2023-04-16T00:57:50.000Z","-5000","81","3","1","1","1","1");
INSERT INTO ledger_info VALUES("5","1","2","5000","5000","00002","2023-04-16T01:11:24.000Z","0","13","1","1","1","1","3");
INSERT INTO ledger_info VALUES("6","1","1","22500","22500","00003","2023-04-16T14:10:14.000Z","0","16","1","1","1","1","3");
INSERT INTO ledger_info VALUES("7","0","1","22500","12000","00001","2023-04-17T18:36:35.000Z","10500","15","2","2","1","1","1");



CREATE TABLE `lesson_notes` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` int(11) NOT NULL,
  `topic` text NOT NULL,
  `lesson_note` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_created` int(11) NOT NULL,
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO lesson_notes VALUES("1","1","The Birth of Jesus Christ","JS 1-First Term_C.R.S-lessson_note.pdf","13","1","1","2023");
INSERT INTO lesson_notes VALUES("2","2","The Resurrection of Jesus Christ","JS 1-First Term_C.R.S-lessson_note.pdf","13","1","1","2023");
INSERT INTO lesson_notes VALUES("3","1","Set Thereom 2","JS 1-First Term_Mathematics-lessson_note-4.jpg","2","1","1","2023");
INSERT INTO lesson_notes VALUES("4","2","Set Thereom 2","JS 1-First Term_Mathematics-lessson_note-4.jpg","2","1","1","2023");
INSERT INTO lesson_notes VALUES("5","3","Set Thereom 2","JS 1-First Term_Mathematics-lessson_note-4.jpg","2","1","1","2023");
INSERT INTO lesson_notes VALUES("7","4","circle Theorem 1","JS 1-First Term_Mathematics-lessson_note-4.jpg","2","1","1","2023");



CREATE TABLE `local_governments` (
  `lg_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`lg_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=775 DEFAULT CHARSET=utf32 COMMENT='Local governments in Nigeria.';

INSERT INTO local_governments VALUES("1","1","Aba North");
INSERT INTO local_governments VALUES("2","1","Aba South");
INSERT INTO local_governments VALUES("3","1","Arochukwu");
INSERT INTO local_governments VALUES("4","1","Bende");
INSERT INTO local_governments VALUES("5","1","Ikwuano");
INSERT INTO local_governments VALUES("6","1","Isiala Ngwa North");
INSERT INTO local_governments VALUES("7","1","Isiala Ngwa South");
INSERT INTO local_governments VALUES("8","1","Isuikwuato");
INSERT INTO local_governments VALUES("9","1","Obi Ngwa");
INSERT INTO local_governments VALUES("10","1","Ohafia");
INSERT INTO local_governments VALUES("11","1","Osisioma");
INSERT INTO local_governments VALUES("12","1","Ugwunagbo");
INSERT INTO local_governments VALUES("13","1","Ukwa East");
INSERT INTO local_governments VALUES("14","1","Ukwa West");
INSERT INTO local_governments VALUES("15","1","Umuahia North");
INSERT INTO local_governments VALUES("16","1","Umuahia South");
INSERT INTO local_governments VALUES("17","1","Umu Nneochi");
INSERT INTO local_governments VALUES("18","2","Demsa");
INSERT INTO local_governments VALUES("19","2","Fufure");
INSERT INTO local_governments VALUES("20","2","Ganye");
INSERT INTO local_governments VALUES("21","2","Gayuk");
INSERT INTO local_governments VALUES("22","2","Gombi");
INSERT INTO local_governments VALUES("23","2","Grie");
INSERT INTO local_governments VALUES("24","2","Hong");
INSERT INTO local_governments VALUES("25","2","Jada");
INSERT INTO local_governments VALUES("26","2","Larmurde");
INSERT INTO local_governments VALUES("27","2","Madagali");
INSERT INTO local_governments VALUES("28","2","Maiha");
INSERT INTO local_governments VALUES("29","2","Mayo Belwa");
INSERT INTO local_governments VALUES("30","2","Michika");
INSERT INTO local_governments VALUES("31","2","Mubi North");
INSERT INTO local_governments VALUES("32","2","Mubi South");
INSERT INTO local_governments VALUES("33","2","Numan");
INSERT INTO local_governments VALUES("34","2","Shelleng");
INSERT INTO local_governments VALUES("35","2","Song");
INSERT INTO local_governments VALUES("36","2","Toungo");
INSERT INTO local_governments VALUES("37","2","Yola North");
INSERT INTO local_governments VALUES("38","2","Yola South");
INSERT INTO local_governments VALUES("39","3","Abak");
INSERT INTO local_governments VALUES("40","3","Eastern Obolo");
INSERT INTO local_governments VALUES("41","3","Eket");
INSERT INTO local_governments VALUES("42","3","Esit Eket");
INSERT INTO local_governments VALUES("43","3","Essien Udim");
INSERT INTO local_governments VALUES("44","3","Etim Ekpo");
INSERT INTO local_governments VALUES("45","3","Etinan");
INSERT INTO local_governments VALUES("46","3","Ibeno");
INSERT INTO local_governments VALUES("47","3","Ibesikpo Asutan");
INSERT INTO local_governments VALUES("48","3","Ibiono-Ibom");
INSERT INTO local_governments VALUES("49","3","Ika");
INSERT INTO local_governments VALUES("50","3","Ikono");
INSERT INTO local_governments VALUES("51","3","Ikot Abasi");
INSERT INTO local_governments VALUES("52","3","Ikot Ekpene");
INSERT INTO local_governments VALUES("53","3","Ini");
INSERT INTO local_governments VALUES("54","3","Itu");
INSERT INTO local_governments VALUES("55","3","Mbo");
INSERT INTO local_governments VALUES("56","3","Mkpat-Enin");
INSERT INTO local_governments VALUES("57","3","Nsit-Atai");
INSERT INTO local_governments VALUES("58","3","Nsit-Ibom");
INSERT INTO local_governments VALUES("59","3","Nsit-Ubium");
INSERT INTO local_governments VALUES("60","3","Obot Akara");
INSERT INTO local_governments VALUES("61","3","Okobo");
INSERT INTO local_governments VALUES("62","3","Onna");
INSERT INTO local_governments VALUES("63","3","Oron");
INSERT INTO local_governments VALUES("64","3","Oruk Anam");
INSERT INTO local_governments VALUES("65","3","Udung-Uko");
INSERT INTO local_governments VALUES("66","3","Ukanafun");
INSERT INTO local_governments VALUES("67","3","Uruan");
INSERT INTO local_governments VALUES("68","3","Urue-Offong/Oruko");
INSERT INTO local_governments VALUES("69","3","Uyo");
INSERT INTO local_governments VALUES("70","4","Aguata");
INSERT INTO local_governments VALUES("71","4","Anambra East");
INSERT INTO local_governments VALUES("72","4","Anambra West");
INSERT INTO local_governments VALUES("73","4","Anaocha");
INSERT INTO local_governments VALUES("74","4","Awka North");
INSERT INTO local_governments VALUES("75","4","Awka South");
INSERT INTO local_governments VALUES("76","4","Ayamelum");
INSERT INTO local_governments VALUES("77","4","Dunukofia");
INSERT INTO local_governments VALUES("78","4","Ekwusigo");
INSERT INTO local_governments VALUES("79","4","Idemili North");
INSERT INTO local_governments VALUES("80","4","Idemili South");
INSERT INTO local_governments VALUES("81","4","Ihiala");
INSERT INTO local_governments VALUES("82","4","Njikoka");
INSERT INTO local_governments VALUES("83","4","Nnewi North");
INSERT INTO local_governments VALUES("84","4","Nnewi South");
INSERT INTO local_governments VALUES("85","4","Ogbaru");
INSERT INTO local_governments VALUES("86","4","Onitsha North");
INSERT INTO local_governments VALUES("87","4","Onitsha South");
INSERT INTO local_governments VALUES("88","4","Orumba North");
INSERT INTO local_governments VALUES("89","4","Orumba South");
INSERT INTO local_governments VALUES("90","4","Oyi");
INSERT INTO local_governments VALUES("91","5","Alkaleri");
INSERT INTO local_governments VALUES("92","5","Bauchi");
INSERT INTO local_governments VALUES("93","5","Bogoro");
INSERT INTO local_governments VALUES("94","5","Damban");
INSERT INTO local_governments VALUES("95","5","Darazo");
INSERT INTO local_governments VALUES("96","5","Dass");
INSERT INTO local_governments VALUES("97","5","Gamawa");
INSERT INTO local_governments VALUES("98","5","Ganjuwa");
INSERT INTO local_governments VALUES("99","5","Giade");
INSERT INTO local_governments VALUES("100","5","Itas/Gadau");
INSERT INTO local_governments VALUES("101","5","Jama'are");
INSERT INTO local_governments VALUES("102","5","Katagum");
INSERT INTO local_governments VALUES("103","5","Kirfi");
INSERT INTO local_governments VALUES("104","5","Misau");
INSERT INTO local_governments VALUES("105","5","Ningi");
INSERT INTO local_governments VALUES("106","5","Shira");
INSERT INTO local_governments VALUES("107","5","Tafawa Balewa");
INSERT INTO local_governments VALUES("108","5","Toro");
INSERT INTO local_governments VALUES("109","5","Warji");
INSERT INTO local_governments VALUES("110","5","Zaki");
INSERT INTO local_governments VALUES("111","6","Brass");
INSERT INTO local_governments VALUES("112","6","Ekeremor");
INSERT INTO local_governments VALUES("113","6","Kolokuma/Opokuma");
INSERT INTO local_governments VALUES("114","6","Nembe");
INSERT INTO local_governments VALUES("115","6","Ogbia");
INSERT INTO local_governments VALUES("116","6","Sagbama");
INSERT INTO local_governments VALUES("117","6","Southern Ijaw");
INSERT INTO local_governments VALUES("118","6","Yenagoa");
INSERT INTO local_governments VALUES("119","7","Agatu");
INSERT INTO local_governments VALUES("120","7","Apa");
INSERT INTO local_governments VALUES("121","7","Ado");
INSERT INTO local_governments VALUES("122","7","Buruku");
INSERT INTO local_governments VALUES("123","7","Gboko");
INSERT INTO local_governments VALUES("124","7","Guma");
INSERT INTO local_governments VALUES("125","7","Gwer East");
INSERT INTO local_governments VALUES("126","7","Gwer West");
INSERT INTO local_governments VALUES("127","7","Katsina-Ala");
INSERT INTO local_governments VALUES("128","7","Konshisha");
INSERT INTO local_governments VALUES("129","7","Kwande");
INSERT INTO local_governments VALUES("130","7","Logo");
INSERT INTO local_governments VALUES("131","7","Makurdi");
INSERT INTO local_governments VALUES("132","7","Obi");
INSERT INTO local_governments VALUES("133","7","Ogbadibo");
INSERT INTO local_governments VALUES("134","7","Ohimini");
INSERT INTO local_governments VALUES("135","7","Oju");
INSERT INTO local_governments VALUES("136","7","Okpokwu");
INSERT INTO local_governments VALUES("137","7","Oturkpo");
INSERT INTO local_governments VALUES("138","7","Tarka");
INSERT INTO local_governments VALUES("139","7","Ukum");
INSERT INTO local_governments VALUES("140","7","Ushongo");
INSERT INTO local_governments VALUES("141","7","Vandeikya");
INSERT INTO local_governments VALUES("142","8","Abadam");
INSERT INTO local_governments VALUES("143","8","Askira/Uba");
INSERT INTO local_governments VALUES("144","8","Bama");
INSERT INTO local_governments VALUES("145","8","Bayo");
INSERT INTO local_governments VALUES("146","8","Biu");
INSERT INTO local_governments VALUES("147","8","Chibok");
INSERT INTO local_governments VALUES("148","8","Damboa");
INSERT INTO local_governments VALUES("149","8","Dikwa");
INSERT INTO local_governments VALUES("150","8","Gubio");
INSERT INTO local_governments VALUES("151","8","Guzamala");
INSERT INTO local_governments VALUES("152","8","Gwoza");
INSERT INTO local_governments VALUES("153","8","Hawul");
INSERT INTO local_governments VALUES("154","8","Jere");
INSERT INTO local_governments VALUES("155","8","Kaga");
INSERT INTO local_governments VALUES("156","8","Kala/Balge");
INSERT INTO local_governments VALUES("157","8","Konduga");
INSERT INTO local_governments VALUES("158","8","Kukawa");
INSERT INTO local_governments VALUES("159","8","Kwaya Kusar");
INSERT INTO local_governments VALUES("160","8","Mafa");
INSERT INTO local_governments VALUES("161","8","Magumeri");
INSERT INTO local_governments VALUES("162","8","Maiduguri");
INSERT INTO local_governments VALUES("163","8","Marte");
INSERT INTO local_governments VALUES("164","8","Mobbar");
INSERT INTO local_governments VALUES("165","8","Monguno");
INSERT INTO local_governments VALUES("166","8","Ngala");
INSERT INTO local_governments VALUES("167","8","Nganzai");
INSERT INTO local_governments VALUES("168","8","Shani");
INSERT INTO local_governments VALUES("169","9","Abi");
INSERT INTO local_governments VALUES("170","9","Akamkpa");
INSERT INTO local_governments VALUES("171","9","Akpabuyo");
INSERT INTO local_governments VALUES("172","9","Bakassi");
INSERT INTO local_governments VALUES("173","9","Bekwarra");
INSERT INTO local_governments VALUES("174","9","Biase");
INSERT INTO local_governments VALUES("175","9","Boki");
INSERT INTO local_governments VALUES("176","9","Calabar Municipal");
INSERT INTO local_governments VALUES("177","9","Calabar South");
INSERT INTO local_governments VALUES("178","9","Etung");
INSERT INTO local_governments VALUES("179","9","Ikom");
INSERT INTO local_governments VALUES("180","9","Obanliku");
INSERT INTO local_governments VALUES("181","9","Obubra");
INSERT INTO local_governments VALUES("182","9","Obudu");
INSERT INTO local_governments VALUES("183","9","Odukpani");
INSERT INTO local_governments VALUES("184","9","Ogoja");
INSERT INTO local_governments VALUES("185","9","Yakuur");
INSERT INTO local_governments VALUES("186","9","Yala");
INSERT INTO local_governments VALUES("187","10","Aniocha North");
INSERT INTO local_governments VALUES("188","10","Aniocha South");
INSERT INTO local_governments VALUES("189","10","Bomadi");
INSERT INTO local_governments VALUES("190","10","Burutu");
INSERT INTO local_governments VALUES("191","10","Ethiope East");
INSERT INTO local_governments VALUES("192","10","Ethiope West");
INSERT INTO local_governments VALUES("193","10","Ika North East");
INSERT INTO local_governments VALUES("194","10","Ika South");
INSERT INTO local_governments VALUES("195","10","Isoko North");
INSERT INTO local_governments VALUES("196","10","Isoko South");
INSERT INTO local_governments VALUES("197","10","Ndokwa East");
INSERT INTO local_governments VALUES("198","10","Ndokwa West");
INSERT INTO local_governments VALUES("199","10","Okpe");
INSERT INTO local_governments VALUES("200","10","Oshimili North");
INSERT INTO local_governments VALUES("201","10","Oshimili South");
INSERT INTO local_governments VALUES("202","10","Patani");
INSERT INTO local_governments VALUES("203","10","Sapele, Delta");
INSERT INTO local_governments VALUES("204","10","Udu");
INSERT INTO local_governments VALUES("205","10","Ughelli North");
INSERT INTO local_governments VALUES("206","10","Ughelli South");
INSERT INTO local_governments VALUES("207","10","Ukwuani");
INSERT INTO local_governments VALUES("208","10","Uvwie");
INSERT INTO local_governments VALUES("209","10","Warri North");
INSERT INTO local_governments VALUES("210","10","Warri South");
INSERT INTO local_governments VALUES("211","10","Warri South West");
INSERT INTO local_governments VALUES("212","11","Abakaliki");
INSERT INTO local_governments VALUES("213","11","Afikpo North");
INSERT INTO local_governments VALUES("214","11","Afikpo South");
INSERT INTO local_governments VALUES("215","11","Ebonyi");
INSERT INTO local_governments VALUES("216","11","Ezza North");
INSERT INTO local_governments VALUES("217","11","Ezza South");
INSERT INTO local_governments VALUES("218","11","Ikwo");
INSERT INTO local_governments VALUES("219","11","Ishielu");
INSERT INTO local_governments VALUES("220","11","Ivo");
INSERT INTO local_governments VALUES("221","11","Izzi");
INSERT INTO local_governments VALUES("222","11","Ohaozara");
INSERT INTO local_governments VALUES("223","11","Ohaukwu");
INSERT INTO local_governments VALUES("224","11","Onicha");
INSERT INTO local_governments VALUES("225","12","Akoko-Edo");
INSERT INTO local_governments VALUES("226","12","Egor");
INSERT INTO local_governments VALUES("227","12","Esan Central");
INSERT INTO local_governments VALUES("228","12","Esan North-East");
INSERT INTO local_governments VALUES("229","12","Esan South-East");
INSERT INTO local_governments VALUES("230","12","Esan West");
INSERT INTO local_governments VALUES("231","12","Etsako Central");
INSERT INTO local_governments VALUES("232","12","Etsako East");
INSERT INTO local_governments VALUES("233","12","Etsako West");
INSERT INTO local_governments VALUES("234","12","Igueben");
INSERT INTO local_governments VALUES("235","12","Ikpoba Okha");
INSERT INTO local_governments VALUES("236","12","Orhionmwon");
INSERT INTO local_governments VALUES("237","12","Oredo");
INSERT INTO local_governments VALUES("238","12","Ovia North-East");
INSERT INTO local_governments VALUES("239","12","Ovia South-West");
INSERT INTO local_governments VALUES("240","12","Owan East");
INSERT INTO local_governments VALUES("241","12","Owan West");
INSERT INTO local_governments VALUES("242","12","Uhunmwonde");
INSERT INTO local_governments VALUES("243","13","Ado Ekiti");
INSERT INTO local_governments VALUES("244","13","Efon");
INSERT INTO local_governments VALUES("245","13","Ekiti East");
INSERT INTO local_governments VALUES("246","13","Ekiti South-West");
INSERT INTO local_governments VALUES("247","13","Ekiti West");
INSERT INTO local_governments VALUES("248","13","Emure");
INSERT INTO local_governments VALUES("249","13","Gbonyin");
INSERT INTO local_governments VALUES("250","13","Ido Osi");
INSERT INTO local_governments VALUES("251","13","Ijero");
INSERT INTO local_governments VALUES("252","13","Ikere");
INSERT INTO local_governments VALUES("253","13","Ikole");
INSERT INTO local_governments VALUES("254","13","Ilejemeje");
INSERT INTO local_governments VALUES("255","13","Irepodun/Ifelodun");
INSERT INTO local_governments VALUES("256","13","Ise/Orun");
INSERT INTO local_governments VALUES("257","13","Moba");
INSERT INTO local_governments VALUES("258","13","Oye");
INSERT INTO local_governments VALUES("259","14","Aninri");
INSERT INTO local_governments VALUES("260","14","Awgu");
INSERT INTO local_governments VALUES("261","14","Enugu East");
INSERT INTO local_governments VALUES("262","14","Enugu North");
INSERT INTO local_governments VALUES("263","14","Enugu South");
INSERT INTO local_governments VALUES("264","14","Ezeagu");
INSERT INTO local_governments VALUES("265","14","Igbo Etiti");
INSERT INTO local_governments VALUES("266","14","Igbo Eze North");
INSERT INTO local_governments VALUES("267","14","Igbo Eze South");
INSERT INTO local_governments VALUES("268","14","Isi Uzo");
INSERT INTO local_governments VALUES("269","14","Nkanu East");
INSERT INTO local_governments VALUES("270","14","Nkanu West");
INSERT INTO local_governments VALUES("271","14","Nsukka");
INSERT INTO local_governments VALUES("272","14","Oji River");
INSERT INTO local_governments VALUES("273","14","Udenu");
INSERT INTO local_governments VALUES("274","14","Udi");
INSERT INTO local_governments VALUES("275","14","Uzo Uwani");
INSERT INTO local_governments VALUES("276","15","Abaji");
INSERT INTO local_governments VALUES("277","15","Bwari");
INSERT INTO local_governments VALUES("278","15","Gwagwalada");
INSERT INTO local_governments VALUES("279","15","Kuje");
INSERT INTO local_governments VALUES("280","15","Kwali");
INSERT INTO local_governments VALUES("281","15","Municipal Area Council");
INSERT INTO local_governments VALUES("282","16","Akko");
INSERT INTO local_governments VALUES("283","16","Balanga");
INSERT INTO local_governments VALUES("284","16","Billiri");
INSERT INTO local_governments VALUES("285","16","Dukku");
INSERT INTO local_governments VALUES("286","16","Funakaye");
INSERT INTO local_governments VALUES("287","16","Gombe");
INSERT INTO local_governments VALUES("288","16","Kaltungo");
INSERT INTO local_governments VALUES("289","16","Kwami");
INSERT INTO local_governments VALUES("290","16","Nafada");
INSERT INTO local_governments VALUES("291","16","Shongom");
INSERT INTO local_governments VALUES("292","16","Yamaltu/Deba");
INSERT INTO local_governments VALUES("293","17","Aboh Mbaise");
INSERT INTO local_governments VALUES("294","17","Ahiazu Mbaise");
INSERT INTO local_governments VALUES("295","17","Ehime Mbano");
INSERT INTO local_governments VALUES("296","17","Ezinihitte");
INSERT INTO local_governments VALUES("297","17","Ideato North");
INSERT INTO local_governments VALUES("298","17","Ideato South");
INSERT INTO local_governments VALUES("299","17","Ihitte/Uboma");
INSERT INTO local_governments VALUES("300","17","Ikeduru");
INSERT INTO local_governments VALUES("301","17","Isiala Mbano");
INSERT INTO local_governments VALUES("302","17","Isu");
INSERT INTO local_governments VALUES("303","17","Mbaitoli");
INSERT INTO local_governments VALUES("304","17","Ngor Okpala");
INSERT INTO local_governments VALUES("305","17","Njaba");
INSERT INTO local_governments VALUES("306","17","Nkwerre");
INSERT INTO local_governments VALUES("307","17","Nwangele");
INSERT INTO local_governments VALUES("308","17","Obowo");
INSERT INTO local_governments VALUES("309","17","Oguta");
INSERT INTO local_governments VALUES("310","17","Ohaji/Egbema");
INSERT INTO local_governments VALUES("311","17","Okigwe");
INSERT INTO local_governments VALUES("312","17","Orlu");
INSERT INTO local_governments VALUES("313","17","Orsu");
INSERT INTO local_governments VALUES("314","17","Oru East");
INSERT INTO local_governments VALUES("315","17","Oru West");
INSERT INTO local_governments VALUES("316","17","Owerri Municipal");
INSERT INTO local_governments VALUES("317","17","Owerri North");
INSERT INTO local_governments VALUES("318","17","Owerri West");
INSERT INTO local_governments VALUES("319","17","Unuimo");
INSERT INTO local_governments VALUES("320","18","Auyo");
INSERT INTO local_governments VALUES("321","18","Babura");
INSERT INTO local_governments VALUES("322","18","Biriniwa");
INSERT INTO local_governments VALUES("323","18","Birnin Kudu");
INSERT INTO local_governments VALUES("324","18","Buji");
INSERT INTO local_governments VALUES("325","18","Dutse");
INSERT INTO local_governments VALUES("326","18","Gagarawa");
INSERT INTO local_governments VALUES("327","18","Garki");
INSERT INTO local_governments VALUES("328","18","Gumel");
INSERT INTO local_governments VALUES("329","18","Guri");
INSERT INTO local_governments VALUES("330","18","Gwaram");
INSERT INTO local_governments VALUES("331","18","Gwiwa");
INSERT INTO local_governments VALUES("332","18","Hadejia");
INSERT INTO local_governments VALUES("333","18","Jahun");
INSERT INTO local_governments VALUES("334","18","Kafin Hausa");
INSERT INTO local_governments VALUES("335","18","Kazaure");
INSERT INTO local_governments VALUES("336","18","Kiri Kasama");
INSERT INTO local_governments VALUES("337","18","Kiyawa");
INSERT INTO local_governments VALUES("338","18","Kaugama");
INSERT INTO local_governments VALUES("339","18","Maigatari");
INSERT INTO local_governments VALUES("340","18","Malam Madori");
INSERT INTO local_governments VALUES("341","18","Miga");
INSERT INTO local_governments VALUES("342","18","Ringim");
INSERT INTO local_governments VALUES("343","18","Roni");
INSERT INTO local_governments VALUES("344","18","Sule Tankarkar");
INSERT INTO local_governments VALUES("345","18","Taura");
INSERT INTO local_governments VALUES("346","18","Yankwashi");
INSERT INTO local_governments VALUES("347","19","Birnin Gwari");
INSERT INTO local_governments VALUES("348","19","Chikun");
INSERT INTO local_governments VALUES("349","19","Giwa");
INSERT INTO local_governments VALUES("350","19","Igabi");
INSERT INTO local_governments VALUES("351","19","Ikara");
INSERT INTO local_governments VALUES("352","19","Jaba");
INSERT INTO local_governments VALUES("353","19","Jema'a");
INSERT INTO local_governments VALUES("354","19","Kachia");
INSERT INTO local_governments VALUES("355","19","Kaduna North");
INSERT INTO local_governments VALUES("356","19","Kaduna South");
INSERT INTO local_governments VALUES("357","19","Kagarko");
INSERT INTO local_governments VALUES("358","19","Kajuru");
INSERT INTO local_governments VALUES("359","19","Kaura");
INSERT INTO local_governments VALUES("360","19","Kauru");
INSERT INTO local_governments VALUES("361","19","Kubau");
INSERT INTO local_governments VALUES("362","19","Kudan");
INSERT INTO local_governments VALUES("363","19","Lere");
INSERT INTO local_governments VALUES("364","19","Makarfi");
INSERT INTO local_governments VALUES("365","19","Sabon Gari");
INSERT INTO local_governments VALUES("366","19","Sanga");
INSERT INTO local_governments VALUES("367","19","Soba");
INSERT INTO local_governments VALUES("368","19","Zangon Kataf");
INSERT INTO local_governments VALUES("369","19","Zaria");
INSERT INTO local_governments VALUES("370","20","Ajingi");
INSERT INTO local_governments VALUES("371","20","Albasu");
INSERT INTO local_governments VALUES("372","20","Bagwai");
INSERT INTO local_governments VALUES("373","20","Bebeji");
INSERT INTO local_governments VALUES("374","20","Bichi");
INSERT INTO local_governments VALUES("375","20","Bunkure");
INSERT INTO local_governments VALUES("376","20","Dala");
INSERT INTO local_governments VALUES("377","20","Dambatta");
INSERT INTO local_governments VALUES("378","20","Dawakin Kudu");
INSERT INTO local_governments VALUES("379","20","Dawakin Tofa");
INSERT INTO local_governments VALUES("380","20","Doguwa");
INSERT INTO local_governments VALUES("381","20","Fagge");
INSERT INTO local_governments VALUES("382","20","Gabasawa");
INSERT INTO local_governments VALUES("383","20","Garko");
INSERT INTO local_governments VALUES("384","20","Garun Mallam");
INSERT INTO local_governments VALUES("385","20","Gaya");
INSERT INTO local_governments VALUES("386","20","Gezawa");
INSERT INTO local_governments VALUES("387","20","Gwale");
INSERT INTO local_governments VALUES("388","20","Gwarzo");
INSERT INTO local_governments VALUES("389","20","Kabo");
INSERT INTO local_governments VALUES("390","20","Kano Municipal");
INSERT INTO local_governments VALUES("391","20","Karaye");
INSERT INTO local_governments VALUES("392","20","Kibiya");
INSERT INTO local_governments VALUES("393","20","Kiru");
INSERT INTO local_governments VALUES("394","20","Kumbotso");
INSERT INTO local_governments VALUES("395","20","Kunchi");
INSERT INTO local_governments VALUES("396","20","Kura");
INSERT INTO local_governments VALUES("397","20","Madobi");
INSERT INTO local_governments VALUES("398","20","Makoda");
INSERT INTO local_governments VALUES("399","20","Minjibir");
INSERT INTO local_governments VALUES("400","20","Nasarawa");
INSERT INTO local_governments VALUES("401","20","Rano");
INSERT INTO local_governments VALUES("402","20","Rimin Gado");
INSERT INTO local_governments VALUES("403","20","Rogo");
INSERT INTO local_governments VALUES("404","20","Shanono");
INSERT INTO local_governments VALUES("405","20","Sumaila");
INSERT INTO local_governments VALUES("406","20","Takai");
INSERT INTO local_governments VALUES("407","20","Tarauni");
INSERT INTO local_governments VALUES("408","20","Tofa");
INSERT INTO local_governments VALUES("409","20","Tsanyawa");
INSERT INTO local_governments VALUES("410","20","Tudun Wada");
INSERT INTO local_governments VALUES("411","20","Ungogo");
INSERT INTO local_governments VALUES("412","20","Warawa");
INSERT INTO local_governments VALUES("413","20","Wudil");
INSERT INTO local_governments VALUES("414","21","Bakori");
INSERT INTO local_governments VALUES("415","21","Batagarawa");
INSERT INTO local_governments VALUES("416","21","Batsari");
INSERT INTO local_governments VALUES("417","21","Baure");
INSERT INTO local_governments VALUES("418","21","Bindawa");
INSERT INTO local_governments VALUES("419","21","Charanchi");
INSERT INTO local_governments VALUES("420","21","Dandume");
INSERT INTO local_governments VALUES("421","21","Danja");
INSERT INTO local_governments VALUES("422","21","Dan Musa");
INSERT INTO local_governments VALUES("423","21","Daura");
INSERT INTO local_governments VALUES("424","21","Dutsi");
INSERT INTO local_governments VALUES("425","21","Dutsin Ma");
INSERT INTO local_governments VALUES("426","21","Faskari");
INSERT INTO local_governments VALUES("427","21","Funtua");
INSERT INTO local_governments VALUES("428","21","Ingawa");
INSERT INTO local_governments VALUES("429","21","Jibia");
INSERT INTO local_governments VALUES("430","21","Kafur");
INSERT INTO local_governments VALUES("431","21","Kaita");
INSERT INTO local_governments VALUES("432","21","Kankara");
INSERT INTO local_governments VALUES("433","21","Kankia");
INSERT INTO local_governments VALUES("434","21","Katsina");
INSERT INTO local_governments VALUES("435","21","Kurfi");
INSERT INTO local_governments VALUES("436","21","Kusada");
INSERT INTO local_governments VALUES("437","21","Mai'Adua");
INSERT INTO local_governments VALUES("438","21","Malumfashi");
INSERT INTO local_governments VALUES("439","21","Mani");
INSERT INTO local_governments VALUES("440","21","Mashi");
INSERT INTO local_governments VALUES("441","21","Matazu");
INSERT INTO local_governments VALUES("442","21","Musawa");
INSERT INTO local_governments VALUES("443","21","Rimi");
INSERT INTO local_governments VALUES("444","21","Sabuwa");
INSERT INTO local_governments VALUES("445","21","Safana");
INSERT INTO local_governments VALUES("446","21","Sandamu");
INSERT INTO local_governments VALUES("447","21","Zango");
INSERT INTO local_governments VALUES("448","22","Aleiro");
INSERT INTO local_governments VALUES("449","22","Arewa Dandi");
INSERT INTO local_governments VALUES("450","22","Argungu");
INSERT INTO local_governments VALUES("451","22","Augie");
INSERT INTO local_governments VALUES("452","22","Bagudo");
INSERT INTO local_governments VALUES("453","22","Birnin Kebbi");
INSERT INTO local_governments VALUES("454","22","Bunza");
INSERT INTO local_governments VALUES("455","22","Dandi");
INSERT INTO local_governments VALUES("456","22","Fakai");
INSERT INTO local_governments VALUES("457","22","Gwandu");
INSERT INTO local_governments VALUES("458","22","Jega");
INSERT INTO local_governments VALUES("459","22","Kalgo");
INSERT INTO local_governments VALUES("460","22","Koko/Besse");
INSERT INTO local_governments VALUES("461","22","Maiyama");
INSERT INTO local_governments VALUES("462","22","Ngaski");
INSERT INTO local_governments VALUES("463","22","Sakaba");
INSERT INTO local_governments VALUES("464","22","Shanga");
INSERT INTO local_governments VALUES("465","22","Suru");
INSERT INTO local_governments VALUES("466","22","Wasagu/Danko");
INSERT INTO local_governments VALUES("467","22","Yauri");
INSERT INTO local_governments VALUES("468","22","Zuru");
INSERT INTO local_governments VALUES("469","23","Adavi");
INSERT INTO local_governments VALUES("470","23","Ajaokuta");
INSERT INTO local_governments VALUES("471","23","Ankpa");
INSERT INTO local_governments VALUES("472","23","Bassa");
INSERT INTO local_governments VALUES("473","23","Dekina");
INSERT INTO local_governments VALUES("474","23","Ibaji");
INSERT INTO local_governments VALUES("475","23","Idah");
INSERT INTO local_governments VALUES("476","23","Igalamela Odolu");
INSERT INTO local_governments VALUES("477","23","Ijumu");
INSERT INTO local_governments VALUES("478","23","Kabba/Bunu");
INSERT INTO local_governments VALUES("479","23","Kogi");
INSERT INTO local_governments VALUES("480","23","Lokoja");
INSERT INTO local_governments VALUES("481","23","Mopa Muro");
INSERT INTO local_governments VALUES("482","23","Ofu");
INSERT INTO local_governments VALUES("483","23","Ogori/Magongo");
INSERT INTO local_governments VALUES("484","23","Okehi");
INSERT INTO local_governments VALUES("485","23","Okene");
INSERT INTO local_governments VALUES("486","23","Olamaboro");
INSERT INTO local_governments VALUES("487","23","Omala");
INSERT INTO local_governments VALUES("488","23","Yagba East");
INSERT INTO local_governments VALUES("489","23","Yagba West");
INSERT INTO local_governments VALUES("490","24","Asa");
INSERT INTO local_governments VALUES("491","24","Baruten");
INSERT INTO local_governments VALUES("492","24","Edu");
INSERT INTO local_governments VALUES("493","24","Ekiti, Kwara State");
INSERT INTO local_governments VALUES("494","24","Ifelodun");
INSERT INTO local_governments VALUES("495","24","Ilorin East");
INSERT INTO local_governments VALUES("496","24","Ilorin South");
INSERT INTO local_governments VALUES("497","24","Ilorin West");
INSERT INTO local_governments VALUES("498","24","Irepodun");
INSERT INTO local_governments VALUES("499","24","Isin");
INSERT INTO local_governments VALUES("500","24","Kaiama");
INSERT INTO local_governments VALUES("501","24","Moro");
INSERT INTO local_governments VALUES("502","24","Offa");
INSERT INTO local_governments VALUES("503","24","Oke Ero");
INSERT INTO local_governments VALUES("504","24","Oyun");
INSERT INTO local_governments VALUES("505","24","Pategi");
INSERT INTO local_governments VALUES("506","25","Agege");
INSERT INTO local_governments VALUES("507","25","Ajeromi-Ifelodun");
INSERT INTO local_governments VALUES("508","25","Alimosho");
INSERT INTO local_governments VALUES("509","25","Amuwo-Odofin");
INSERT INTO local_governments VALUES("510","25","Apapa");
INSERT INTO local_governments VALUES("511","25","Badagry");
INSERT INTO local_governments VALUES("512","25","Epe");
INSERT INTO local_governments VALUES("513","25","Eti Osa");
INSERT INTO local_governments VALUES("514","25","Ibeju-Lekki");
INSERT INTO local_governments VALUES("515","25","Ifako-Ijaiye");
INSERT INTO local_governments VALUES("516","25","Ikeja");
INSERT INTO local_governments VALUES("517","25","Ikorodu");
INSERT INTO local_governments VALUES("518","25","Kosofe");
INSERT INTO local_governments VALUES("519","25","Lagos Island");
INSERT INTO local_governments VALUES("520","25","Lagos Mainland");
INSERT INTO local_governments VALUES("521","25","Mushin");
INSERT INTO local_governments VALUES("522","25","Ojo");
INSERT INTO local_governments VALUES("523","25","Oshodi-Isolo");
INSERT INTO local_governments VALUES("524","25","Shomolu");
INSERT INTO local_governments VALUES("525","25","Surulere, Lagos State");
INSERT INTO local_governments VALUES("526","26","Akwanga");
INSERT INTO local_governments VALUES("527","26","Awe");
INSERT INTO local_governments VALUES("528","26","Doma");
INSERT INTO local_governments VALUES("529","26","Karu");
INSERT INTO local_governments VALUES("530","26","Keana");
INSERT INTO local_governments VALUES("531","26","Keffi");
INSERT INTO local_governments VALUES("532","26","Kokona");
INSERT INTO local_governments VALUES("533","26","Lafia");
INSERT INTO local_governments VALUES("534","26","Nasarawa");
INSERT INTO local_governments VALUES("535","26","Nasarawa Egon");
INSERT INTO local_governments VALUES("536","26","Obi");
INSERT INTO local_governments VALUES("537","26","Toto");
INSERT INTO local_governments VALUES("538","26","Wamba");
INSERT INTO local_governments VALUES("539","27","Agaie");
INSERT INTO local_governments VALUES("540","27","Agwara");
INSERT INTO local_governments VALUES("541","27","Bida");
INSERT INTO local_governments VALUES("542","27","Borgu");
INSERT INTO local_governments VALUES("543","27","Bosso");
INSERT INTO local_governments VALUES("544","27","Chanchaga");
INSERT INTO local_governments VALUES("545","27","Edati");
INSERT INTO local_governments VALUES("546","27","Gbako");
INSERT INTO local_governments VALUES("547","27","Gurara");
INSERT INTO local_governments VALUES("548","27","Katcha");
INSERT INTO local_governments VALUES("549","27","Kontagora");
INSERT INTO local_governments VALUES("550","27","Lapai");
INSERT INTO local_governments VALUES("551","27","Lavun");
INSERT INTO local_governments VALUES("552","27","Magama");
INSERT INTO local_governments VALUES("553","27","Mariga");
INSERT INTO local_governments VALUES("554","27","Mashegu");
INSERT INTO local_governments VALUES("555","27","Mokwa");
INSERT INTO local_governments VALUES("556","27","Moya");
INSERT INTO local_governments VALUES("557","27","Paikoro");
INSERT INTO local_governments VALUES("558","27","Rafi");
INSERT INTO local_governments VALUES("559","27","Rijau");
INSERT INTO local_governments VALUES("560","27","Shiroro");
INSERT INTO local_governments VALUES("561","27","Suleja");
INSERT INTO local_governments VALUES("562","27","Tafa");
INSERT INTO local_governments VALUES("563","27","Wushishi");
INSERT INTO local_governments VALUES("564","28","Abeokuta North");
INSERT INTO local_governments VALUES("565","28","Abeokuta South");
INSERT INTO local_governments VALUES("566","28","Ado-Odo/Ota");
INSERT INTO local_governments VALUES("567","28","Egbado North");
INSERT INTO local_governments VALUES("568","28","Egbado South");
INSERT INTO local_governments VALUES("569","28","Ewekoro");
INSERT INTO local_governments VALUES("570","28","Ifo");
INSERT INTO local_governments VALUES("571","28","Ijebu East");
INSERT INTO local_governments VALUES("572","28","Ijebu North");
INSERT INTO local_governments VALUES("573","28","Ijebu North East");
INSERT INTO local_governments VALUES("574","28","Ijebu Ode");
INSERT INTO local_governments VALUES("575","28","Ikenne");
INSERT INTO local_governments VALUES("576","28","Imeko Afon");
INSERT INTO local_governments VALUES("577","28","Ipokia");
INSERT INTO local_governments VALUES("578","28","Obafemi Owode");
INSERT INTO local_governments VALUES("579","28","Odeda");
INSERT INTO local_governments VALUES("580","28","Odogbolu");
INSERT INTO local_governments VALUES("581","28","Ogun Waterside");
INSERT INTO local_governments VALUES("582","28","Remo North");
INSERT INTO local_governments VALUES("583","28","Shagamu");
INSERT INTO local_governments VALUES("584","29","Akoko North-East");
INSERT INTO local_governments VALUES("585","29","Akoko North-West");
INSERT INTO local_governments VALUES("586","29","Akoko South-West");
INSERT INTO local_governments VALUES("587","29","Akoko South-East");
INSERT INTO local_governments VALUES("588","29","Akure North");
INSERT INTO local_governments VALUES("589","29","Akure South");
INSERT INTO local_governments VALUES("590","29","Ese Odo");
INSERT INTO local_governments VALUES("591","29","Idanre");
INSERT INTO local_governments VALUES("592","29","Ifedore");
INSERT INTO local_governments VALUES("593","29","Ilaje");
INSERT INTO local_governments VALUES("594","29","Ile Oluji/Okeigbo");
INSERT INTO local_governments VALUES("595","29","Irele");
INSERT INTO local_governments VALUES("596","29","Odigbo");
INSERT INTO local_governments VALUES("597","29","Okitipupa");
INSERT INTO local_governments VALUES("598","29","Ondo East");
INSERT INTO local_governments VALUES("599","29","Ondo West");
INSERT INTO local_governments VALUES("600","29","Ose");
INSERT INTO local_governments VALUES("601","29","Owo");
INSERT INTO local_governments VALUES("602","30","Atakunmosa East");
INSERT INTO local_governments VALUES("603","30","Atakunmosa West");
INSERT INTO local_governments VALUES("604","30","Aiyedaade");
INSERT INTO local_governments VALUES("605","30","Aiyedire");
INSERT INTO local_governments VALUES("606","30","Boluwaduro");
INSERT INTO local_governments VALUES("607","30","Boripe");
INSERT INTO local_governments VALUES("608","30","Ede North");
INSERT INTO local_governments VALUES("609","30","Ede South");
INSERT INTO local_governments VALUES("610","30","Ife Central");
INSERT INTO local_governments VALUES("611","30","Ife East");
INSERT INTO local_governments VALUES("612","30","Ife North");
INSERT INTO local_governments VALUES("613","30","Ife South");
INSERT INTO local_governments VALUES("614","30","Egbedore");
INSERT INTO local_governments VALUES("615","30","Ejigbo");
INSERT INTO local_governments VALUES("616","30","Ifedayo");
INSERT INTO local_governments VALUES("617","30","Ifelodun");
INSERT INTO local_governments VALUES("618","30","Ila");
INSERT INTO local_governments VALUES("619","30","Ilesa East");
INSERT INTO local_governments VALUES("620","30","Ilesa West");
INSERT INTO local_governments VALUES("621","30","Irepodun");
INSERT INTO local_governments VALUES("622","30","Irewole");
INSERT INTO local_governments VALUES("623","30","Isokan");
INSERT INTO local_governments VALUES("624","30","Iwo");
INSERT INTO local_governments VALUES("625","30","Obokun");
INSERT INTO local_governments VALUES("626","30","Odo Otin");
INSERT INTO local_governments VALUES("627","30","Ola Oluwa");
INSERT INTO local_governments VALUES("628","30","Olorunda");
INSERT INTO local_governments VALUES("629","30","Oriade");
INSERT INTO local_governments VALUES("630","30","Orolu");
INSERT INTO local_governments VALUES("631","30","Osogbo");
INSERT INTO local_governments VALUES("632","31","Afijio");
INSERT INTO local_governments VALUES("633","31","Akinyele");
INSERT INTO local_governments VALUES("634","31","Atiba");
INSERT INTO local_governments VALUES("635","31","Atisbo");
INSERT INTO local_governments VALUES("636","31","Egbeda");
INSERT INTO local_governments VALUES("637","31","Ibadan North");
INSERT INTO local_governments VALUES("638","31","Ibadan North-East");
INSERT INTO local_governments VALUES("639","31","Ibadan North-West");
INSERT INTO local_governments VALUES("640","31","Ibadan South-East");
INSERT INTO local_governments VALUES("641","31","Ibadan South-West");
INSERT INTO local_governments VALUES("642","31","Ibarapa Central");
INSERT INTO local_governments VALUES("643","31","Ibarapa East");
INSERT INTO local_governments VALUES("644","31","Ibarapa North");
INSERT INTO local_governments VALUES("645","31","Ido");
INSERT INTO local_governments VALUES("646","31","Irepo");
INSERT INTO local_governments VALUES("647","31","Iseyin");
INSERT INTO local_governments VALUES("648","31","Itesiwaju");
INSERT INTO local_governments VALUES("649","31","Iwajowa");
INSERT INTO local_governments VALUES("650","31","Kajola");
INSERT INTO local_governments VALUES("651","31","Lagelu");
INSERT INTO local_governments VALUES("652","31","Ogbomosho North");
INSERT INTO local_governments VALUES("653","31","Ogbomosho South");
INSERT INTO local_governments VALUES("654","31","Ogo Oluwa");
INSERT INTO local_governments VALUES("655","31","Olorunsogo");
INSERT INTO local_governments VALUES("656","31","Oluyole");
INSERT INTO local_governments VALUES("657","31","Ona Ara");
INSERT INTO local_governments VALUES("658","31","Orelope");
INSERT INTO local_governments VALUES("659","31","Ori Ire");
INSERT INTO local_governments VALUES("660","31","Oyo");
INSERT INTO local_governments VALUES("661","31","Oyo East");
INSERT INTO local_governments VALUES("662","31","Saki East");
INSERT INTO local_governments VALUES("663","31","Saki West");
INSERT INTO local_governments VALUES("664","31","Surulere, Oyo State");
INSERT INTO local_governments VALUES("665","32","Bokkos");
INSERT INTO local_governments VALUES("666","32","Barkin Ladi");
INSERT INTO local_governments VALUES("667","32","Bassa");
INSERT INTO local_governments VALUES("668","32","Jos East");
INSERT INTO local_governments VALUES("669","32","Jos North");
INSERT INTO local_governments VALUES("670","32","Jos South");
INSERT INTO local_governments VALUES("671","32","Kanam");
INSERT INTO local_governments VALUES("672","32","Kanke");
INSERT INTO local_governments VALUES("673","32","Langtang South");
INSERT INTO local_governments VALUES("674","32","Langtang North");
INSERT INTO local_governments VALUES("675","32","Mangu");
INSERT INTO local_governments VALUES("676","32","Mikang");
INSERT INTO local_governments VALUES("677","32","Pankshin");
INSERT INTO local_governments VALUES("678","32","Qua'an Pan");
INSERT INTO local_governments VALUES("679","32","Riyom");
INSERT INTO local_governments VALUES("680","32","Shendam");
INSERT INTO local_governments VALUES("681","32","Wase");
INSERT INTO local_governments VALUES("682","33","Abua/Odual");
INSERT INTO local_governments VALUES("683","33","Ahoada East");
INSERT INTO local_governments VALUES("684","33","Ahoada West");
INSERT INTO local_governments VALUES("685","33","Akuku-Toru");
INSERT INTO local_governments VALUES("686","33","Andoni");
INSERT INTO local_governments VALUES("687","33","Asari-Toru");
INSERT INTO local_governments VALUES("688","33","Bonny");
INSERT INTO local_governments VALUES("689","33","Degema");
INSERT INTO local_governments VALUES("690","33","Eleme");
INSERT INTO local_governments VALUES("691","33","Emuoha");
INSERT INTO local_governments VALUES("692","33","Etche");
INSERT INTO local_governments VALUES("693","33","Gokana");
INSERT INTO local_governments VALUES("694","33","Ikwerre");
INSERT INTO local_governments VALUES("695","33","Khana");
INSERT INTO local_governments VALUES("696","33","Obio/Akpor");
INSERT INTO local_governments VALUES("697","33","Ogba/Egbema/Ndoni");
INSERT INTO local_governments VALUES("698","33","Ogu/Bolo");
INSERT INTO local_governments VALUES("699","33","Okrika");
INSERT INTO local_governments VALUES("700","33","Omuma");
INSERT INTO local_governments VALUES("701","33","Opobo/Nkoro");
INSERT INTO local_governments VALUES("702","33","Oyigbo");
INSERT INTO local_governments VALUES("703","33","Port Harcourt");
INSERT INTO local_governments VALUES("704","33","Tai");
INSERT INTO local_governments VALUES("705","34","Binji");
INSERT INTO local_governments VALUES("706","34","Bodinga");
INSERT INTO local_governments VALUES("707","34","Dange Shuni");
INSERT INTO local_governments VALUES("708","34","Gada");
INSERT INTO local_governments VALUES("709","34","Goronyo");
INSERT INTO local_governments VALUES("710","34","Gudu");
INSERT INTO local_governments VALUES("711","34","Gwadabawa");
INSERT INTO local_governments VALUES("712","34","Illela");
INSERT INTO local_governments VALUES("713","34","Isa");
INSERT INTO local_governments VALUES("714","34","Kebbe");
INSERT INTO local_governments VALUES("715","34","Kware");
INSERT INTO local_governments VALUES("716","34","Rabah");
INSERT INTO local_governments VALUES("717","34","Sabon Birni");
INSERT INTO local_governments VALUES("718","34","Shagari");
INSERT INTO local_governments VALUES("719","34","Silame");
INSERT INTO local_governments VALUES("720","34","Sokoto North");
INSERT INTO local_governments VALUES("721","34","Sokoto South");
INSERT INTO local_governments VALUES("722","34","Tambuwal");
INSERT INTO local_governments VALUES("723","34","Tangaza");
INSERT INTO local_governments VALUES("724","34","Tureta");
INSERT INTO local_governments VALUES("725","34","Wamako");
INSERT INTO local_governments VALUES("726","34","Wurno");
INSERT INTO local_governments VALUES("727","34","Yabo");
INSERT INTO local_governments VALUES("728","35","Ardo Kola");
INSERT INTO local_governments VALUES("729","35","Bali");
INSERT INTO local_governments VALUES("730","35","Donga");
INSERT INTO local_governments VALUES("731","35","Gashaka");
INSERT INTO local_governments VALUES("732","35","Gassol");
INSERT INTO local_governments VALUES("733","35","Ibi");
INSERT INTO local_governments VALUES("734","35","Jalingo");
INSERT INTO local_governments VALUES("735","35","Karim Lamido");
INSERT INTO local_governments VALUES("736","35","Kumi");
INSERT INTO local_governments VALUES("737","35","Lau");
INSERT INTO local_governments VALUES("738","35","Sardauna");
INSERT INTO local_governments VALUES("739","35","Takum");
INSERT INTO local_governments VALUES("740","35","Ussa");
INSERT INTO local_governments VALUES("741","35","Wukari");
INSERT INTO local_governments VALUES("742","35","Yorro");
INSERT INTO local_governments VALUES("743","35","Zing");
INSERT INTO local_governments VALUES("744","36","Bade");
INSERT INTO local_governments VALUES("745","36","Bursari");
INSERT INTO local_governments VALUES("746","36","Damaturu");
INSERT INTO local_governments VALUES("747","36","Fika");
INSERT INTO local_governments VALUES("748","36","Fune");
INSERT INTO local_governments VALUES("749","36","Geidam");
INSERT INTO local_governments VALUES("750","36","Gujba");
INSERT INTO local_governments VALUES("751","36","Gulani");
INSERT INTO local_governments VALUES("752","36","Jakusko");
INSERT INTO local_governments VALUES("753","36","Karasuwa");
INSERT INTO local_governments VALUES("754","36","Machina");
INSERT INTO local_governments VALUES("755","36","Nangere");
INSERT INTO local_governments VALUES("756","36","Nguru");
INSERT INTO local_governments VALUES("757","36","Potiskum");
INSERT INTO local_governments VALUES("758","36","Tarmuwa");
INSERT INTO local_governments VALUES("759","36","Yunusari");
INSERT INTO local_governments VALUES("760","36","Yusufari");
INSERT INTO local_governments VALUES("761","37","Anka");
INSERT INTO local_governments VALUES("762","37","Bakura");
INSERT INTO local_governments VALUES("763","37","Birnin Magaji/Kiyaw");
INSERT INTO local_governments VALUES("764","37","Bukkuyum");
INSERT INTO local_governments VALUES("765","37","Bungudu");
INSERT INTO local_governments VALUES("766","37","Gummi");
INSERT INTO local_governments VALUES("767","37","Gusau");
INSERT INTO local_governments VALUES("768","37","Kaura Namoda");
INSERT INTO local_governments VALUES("769","37","Maradun");
INSERT INTO local_governments VALUES("770","37","Maru");
INSERT INTO local_governments VALUES("771","37","Shinkafi");
INSERT INTO local_governments VALUES("772","37","Talata Mafara");
INSERT INTO local_governments VALUES("773","37","Chafe");
INSERT INTO local_governments VALUES("774","37","Zurmi");



CREATE TABLE `m_status_info` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_status` varchar(10) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO m_status_info VALUES("1","Single");
INSERT INTO m_status_info VALUES("2","Married");
INSERT INTO m_status_info VALUES("3","Divorced");
INSERT INTO m_status_info VALUES("4","Widow");



CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `message_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO messages VALUES("1","1","10","1","Test","kgkgkgk","","2022-10-26","0");
INSERT INTO messages VALUES("2","1","1","","ccf","bfhg","","2022-11-16","1");
INSERT INTO messages VALUES("3","1","1","","Programming","									","","2022-11-16","1");
INSERT INTO messages VALUES("4","1","1","10","Daniel Onare from NMT Minna","									","IMG_20201009_122047_796.JPG","2022-11-16","0");



CREATE TABLE `parent_info` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `payment_log` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `payment_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO payment_log VALUES("2","SMS-346-214-276","1","1","22500","10000","00001","0","2023-04-16T00:48:12.000Z","12500","13","1","1","1","0","1","0");
INSERT INTO payment_log VALUES("3","SMS-928-589-806","1","1","22500","12500","00002","0","2023-04-16T00:50:26.000Z","10000","13","1","1","1","0","1","0");
INSERT INTO payment_log VALUES("4","SMS-710-766-821","1","1","22500","22500","00002","0","2023-04-16T00:56:01.000Z","0","81","3","1","1","0","1","0");
INSERT INTO payment_log VALUES("5","SMS-108-250-142","1","2","5000","5000","00001","0","2023-04-16T00:57:50.000Z","0","81","3","1","1","0","1","0");
INSERT INTO payment_log VALUES("6","SMS-748-448-224","1","2","5000","5000","00002","0","2023-04-16T01:02:19.000Z","0","81","3","1","1","0","1","0");
INSERT INTO payment_log VALUES("7","SMS-407-930-850","1","2","5000","5000","00000","0","2023-04-16T01:11:24.000Z","0","13","1","1","1","0","1","0");
INSERT INTO payment_log VALUES("8","SMS-163-849-736","1","1","22500","22500","00000","0","2023-04-16T14:10:14.000Z","0","16","1","1","1","0","1","0");
INSERT INTO payment_log VALUES("9","SMS-606-233-619","0","1","22500","12000","00000","0","2023-04-17T18:36:35.000Z","10500","15","2","2","1","0","1","0");



CREATE TABLE `payment_type` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO payment_type VALUES("1","1","School Fees (Junior Secondary)","22500","1");
INSERT INTO payment_type VALUES("2","1","Web Access Fee","5000","1");



CREATE TABLE `pin_details` (
  `pin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`pin_id`),
  UNIQUE KEY `pin_no` (`pin_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO pin_details VALUES("1","45","1297137239","1","8112022");
INSERT INTO pin_details VALUES("2","13","1408751416","1","9112022");
INSERT INTO pin_details VALUES("3","13","1100363909","1","21032023");



CREATE TABLE `pin_info` (
  `pin_id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `pin_code` varchar(20) NOT NULL,
  `date_generated` varchar(20) NOT NULL,
  PRIMARY KEY (`pin_id`),
  UNIQUE KEY `pin_code` (`pin_code`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

INSERT INTO pin_info VALUES("00000000001","1229872023","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000002","1036512024","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000003","1098198951","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000004","1100363909","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000005","1099275173","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000006","1384261121","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000007","1404496587","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000008","1297137239","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000009","1147279656","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000010","1106495868","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000011","1191004282","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000012","1015767895","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000013","1156039598","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000014","1061795135","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000015","1367554659","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000016","1012313975","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000017","1112740455","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000018","1083569848","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000019","1408751416","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000020","1017670054","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000021","1209600388","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000022","1210263640","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000023","1404296360","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000024","1377828820","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000025","1023739443","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000026","1275287440","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000027","1238858595","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000028","1003554033","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000029","1157441189","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000030","1317084878","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000031","1002139928","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000032","1060969197","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000033","1187825674","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000034","1169066884","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000035","1398940281","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000036","1280968888","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000037","1307111058","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000038","1279742496","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000039","1288765237","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000040","1189414978","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000041","1092417390","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000042","1072457236","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000043","1376414715","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000044","1337332859","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000045","1146028236","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000046","1405785550","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000047","1341525117","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000048","1250584403","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000049","1045063645","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000050","1293007551","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000051","1068765546","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000052","1070129594","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000053","1391807185","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000054","1182632280","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000055","1057903217","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000056","1141961120","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000057","1353313496","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000058","1318136071","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000059","1193607236","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000060","1196973557","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000061","1121800739","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000062","1327897150","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000063","1155514002","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000064","1171094185","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000065","1094519776","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000066","1045326443","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000067","1238358026","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000068","1205282988","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000069","1053623360","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000070","1328998400","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000071","1121775710","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000072","1235467246","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000073","1396362355","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000074","1192193131","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000075","1100501565","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000076","1402606942","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000077","1084758697","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000078","1083419678","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000079","1264237398","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000080","1232563950","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000081","1336194066","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000082","1246154375","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000083","1087586907","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000084","1276363661","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000085","1112690399","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000086","1308775447","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000087","1070317307","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000088","1059867947","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000089","1221563966","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000090","1104693823","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000091","1097097702","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000092","1134102200","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000093","1034902112","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000094","1082418541","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000095","1257629899","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000096","1024928292","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000097","1360021109","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000098","1075360531","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000099","1026517596","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000100","1283371615","2016-11-06 20:42:57");
INSERT INTO pin_info VALUES("00000000101","626697669422","");
INSERT INTO pin_info VALUES("00000000102","749678468316","");



CREATE TABLE `post_info` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(30) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO post_info VALUES("1","Principal");
INSERT INTO post_info VALUES("2","V.P.Admin");
INSERT INTO post_info VALUES("3","V.P.Acadmics");
INSERT INTO post_info VALUES("4","Head Master/Mistress");
INSERT INTO post_info VALUES("5","Teacher");



CREATE TABLE `privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` varchar(20) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO privileges VALUES("1","Administrator");
INSERT INTO privileges VALUES("2","Subject Teacher");
INSERT INTO privileges VALUES("3","Student");
INSERT INTO privileges VALUES("4","Web Master");
INSERT INTO privileges VALUES("5","Form Teacher");
INSERT INTO privileges VALUES("6","Head Teacher");
INSERT INTO privileges VALUES("7","Exam Officer");
INSERT INTO privileges VALUES("8","House Master");
INSERT INTO privileges VALUES("9","Account Officer");
INSERT INTO privileges VALUES("10","Parent");



CREATE TABLE `qual_info` (
  `qual_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(20) NOT NULL,
  PRIMARY KEY (`qual_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO qual_info VALUES("1","FSLC");
INSERT INTO qual_info VALUES("2","SSCE");
INSERT INTO qual_info VALUES("3","NCE");
INSERT INTO qual_info VALUES("4","ND");
INSERT INTO qual_info VALUES("5","HND");
INSERT INTO qual_info VALUES("6","B.Sc.");
INSERT INTO qual_info VALUES("7","B.Sc.Ed");
INSERT INTO qual_info VALUES("8","B.Tech");
INSERT INTO qual_info VALUES("9","B.Ed");
INSERT INTO qual_info VALUES("10","M.Sc.");
INSERT INTO qual_info VALUES("11","M.Ed.");
INSERT INTO qual_info VALUES("12","PGDE");
INSERT INTO qual_info VALUES("13","Ph.D");



CREATE TABLE `rank_info` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(50) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `registered_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `religion_info` (
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `religion` varchar(20) NOT NULL,
  PRIMARY KEY (`rel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO religion_info VALUES("1","Christianity");
INSERT INTO religion_info VALUES("2","Islam");
INSERT INTO religion_info VALUES("3","Others");



CREATE TABLE `report_log` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `resumption_date` (
  `date_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `next_date` varchar(20) NOT NULL,
  PRIMARY KEY (`date_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO resumption_date VALUES("1","1","1","1","2022-11-08");



CREATE TABLE `sch_gallery` (
  `img_id` int(11) NOT NULL,
  `image_name` varchar(45) NOT NULL,
  `caption` text NOT NULL,
  `date_created` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `sch_info` (
  `sch_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO sch_info VALUES("1","goldspringschool@gmail.com","08165171841","08027299789, 08036033234","15","#00008B","Goldspring International School Gwagwalada Abuja","Dream, Explore & Discover","Zion Extension, Beside RCCG Madam Mercy Road Dagiri, Gwagwalada Abuja","45","goldspring_logo-removebg-preview.png","pk_live_e17edf10f93cb9fb983e7f1aae578321fa57910e","sk_live_4b8e7e246bc59fb4bc19a43ecf060366d31db944","agreed","MjAyMzEx","MjAyMjEx","1","1","2023-04-14 08:28:10");
INSERT INTO sch_info VALUES("2","onaretayo@gmail.com","08145162722","08145162722","15","#db811a","Niel Media Technology Minna","Creating Technical Solutions","Opposite Assemblies of God Church, Goldspring Street Dagiri - Gwagwalada FCT","45","logo.jpg","","","agreed","MjAyMzEx","MjAyMjEx","1","1","2023-03-17 21:52:20");



CREATE TABLE `sch_pin` (
  `sch_pin_id` int(11) NOT NULL AUTO_INCREMENT,
  `pin_code` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  PRIMARY KEY (`sch_pin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO sch_pin VALUES("1","OTM0NjgzNjAyMzMzMDg1Ng==","1","1");
INSERT INTO sch_pin VALUES("2","ODkwODUyNDAyMzUzMzE3Mg==","1","1");
INSERT INTO sch_pin VALUES("3","ODI0ODgzNTYyMzkzODA0NQ==","1","2");



CREATE TABLE `sch_theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_code` varchar(10) NOT NULL DEFAULT '#0085B2',
  `theme_name` varchar(20) NOT NULL,
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `theme_code` (`theme_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `sch_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `priv_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(41) NOT NULL,
  `passport` varchar(225) NOT NULL DEFAULT '0',
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

INSERT INTO sch_users VALUES("1","1","1","Grace","Ejiofor","goldspringschool@gmail.com","e10adc3949ba59abbe56e057f20f883e","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("2","9","1","Grace","Ejiofor","Grace@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","onare 007.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("3","2","1","Nnamdi","Aguwa","Nnamdi@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("4","2","1","Abubakar","Mohammed","Abubakar@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("5","2","1","Bukky","Abba","Bukky@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("6","6","1","Rebecca","Boniface","Rebecca@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-04-02 21:44:02","","1");
INSERT INTO sch_users VALUES("7","2","1","Aliyu","Abdulazeez","Aliyu@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("8","2","1","Modestus","Mr","Modestus@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("9","2","1","Michael","Mr","Michael@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("10","5","1","Ganiyat","Miss","Ganiyat@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-04-11 01:03:48","","1");
INSERT INTO sch_users VALUES("11","2","1","Oguzie","Mrs","Oguzie@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("12","7","1","Samuel","Mr","Samuel@goldspringschool.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("13","3","1","Desmond Obiunchi","Abraham","SMS1/JS951A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("14","3","1","E. Oluwadamilare","Ajewole","SMS1/JS800A/002","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("15","3","1","Janet","Akpemiya","SMS1/JS924A/003","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("16","3","1","Shagillo Stella","Danlami","SMS1/JS780A/004","81dc9bdb52d04dc20036dbd8313ed055","onaretayo.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("17","3","1","Mahjeedat","Durodola","SMS1/JS695A/005","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("18","3","1","Ezimeke Munachimsa","David","SMS1/JS350A/006","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("19","3","1","O. Glory","Ijegbai","SMS1/JS305A/007","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("20","3","1","Hirat","Haruna","SMS1/JS672A/008","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("21","3","1","A. Abdulwahab","Mohammed","SMS1/JS875A/009","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("22","3","1","Chisom David","Nnamezie","SMS1/JS885A/010","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("23","3","1","Uchechukwu Victor","Idika","SMS1/JS211A/011","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("24","3","1","Chiwendu Victory","Emmanuel","SMS1/JS889A/012","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("25","3","1","Orukpe Solomon","Godwin","SMS1/JS548A/013","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("26","3","1","Ogugwa Esther","Mba","SMS1/JS579A/014","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("27","3","1","Oche David","Fortunate","SMS1/JS936A/015","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("28","3","1","Chibuike Emmanuel","Aruma","SMS1/JS597A/016","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("29","3","1","Ebere Raphel","Nweze","SMS1/JS836A/017","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("30","3","1","Enemona Collins","Idoko","SMS1/JS174A/018","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("31","3","1","Williams P. E","Inegbedion","SMS1/JS504A/019","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("32","3","1","Sarah","Ahuchi","SMS1/JS529A/020","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("33","3","1","Abdullahi Taofiq","Usman","SMS1/JS959A/021","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("34","3","1","Miracle","Okpoto","SMS1/JS139A/022","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("35","3","1","Carlton","Emmanuel","SMS1/JS577A/023","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("36","3","1","Rahmat","Adeboye","SMS1/JS652A/024","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("37","3","1","Jindendu","David","SMS1/JS894A/025","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("38","3","1","Deborah","Ojelade","SMS1/JS129A/026","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("39","3","1","Divine","Dominic","SMS1/JS917A/027","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("40","3","1","Lucky","Ifa","SMS1/JS504A/028","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("41","3","1","Rachael","Lukman","SMS1/JS921A/029","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("42","3","1","Treasure","Fidelis","SMS1/JS423A/030","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("43","3","1","Esther","Nwoye","SMS1/JS544A/031","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("44","3","1","Victory","Emmanuel","SMS1/JS148A/032","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("45","3","1","Divine","Lilus","SMS1/JS151A/033","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("46","3","1","Celestine","Isaac","SMS1/JS320A/034","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("47","3","1","Wisdom","Otoabasi","SMS1/JS513A/035","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("48","3","1","Monday","Elijah","SMS1/JS747A/036","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("49","3","1","Divine Grace","Orji","SMS1/JS973A/037","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("50","3","1","Joan","Zungwe","SMS1/JS104A/038","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("51","3","1","Deborah","Anyebe","SMS1/JS702A/039","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("52","3","1","Mariam","Abu","SMS1/JS260A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("53","3","1","Mary","Agiliga","SMS1/JS955A/002","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("54","3","1","Emmanuel","Anthony","SMS1/JS719A/003","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("55","3","1","Junior","Chikezie","SMS1/JS883A/004","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("56","3","1","Divine","Chukwudi","SMS1/JS659A/005","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("57","3","1","Winner","Chukwu","SMS1/JS674A/006","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("58","3","1","Divine","Egbelu","SMS1/JS413A/007","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("59","3","1","Jeremiah","Ejiofor","SMS1/JS623A/008","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("60","3","1","Mercy","Ezeme","SMS1/JS488A/009","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("61","3","1","Victor","Godwin","SMS1/JS111A/010","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("62","3","1","Chiamand Sophia","Ibe","SMS1/JS545A/011","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("63","3","1","Chinaza","Ifeanyi","SMS1/JS422A/012","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("64","3","1","Ebube","Isahson","SMS1/JS932A/013","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("65","3","1","Cindy","Joseph","SMS1/JS625A/014","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("66","3","1","Maxwell","Kwa","SMS1/JS546A/015","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("67","3","1","Gift","Monday","SMS1/JS486A/016","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("68","3","1","Precious","Micheal","SMS1/JS460A/017","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("69","3","1","Perfecter","Nnalue","SMS1/JS696A/018","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("70","3","1","Micheal","Nnamezie","SMS1/JS452A/019","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("71","3","1","Janet","Obijiofor","SMS1/JS289A/020","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("72","3","1","Chidera","Omechuragu","SMS1/JS940A/021","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("73","3","1","Praise","Oluwasegun","SMS1/JS748A/022","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("74","3","1","Destiny","Ogbonna","SMS1/JS961A/023","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("75","3","1","Mercy Ometere","Peter","SMS1/JS166A/024","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("76","3","1","Israel","Samuel","SMS1/JS410A/025","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("77","3","1","Zubeiru Aisha","Salihu","SMS1/JS149A/026","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("78","3","1","Fidausi","Sadiq","SMS1/JS724A/027","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("79","3","1","Munira","Umar","SMS1/JS927A/028","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("80","3","1","Khadijat","Yakubu","SMS1/JS283A/029","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("81","3","1","Gabriel","Amber","SMS1/JS529A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("82","3","1","Enyo Divine","Odinna","SMS1/JS134A/002","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("83","3","1","Omotola","Oloruntoba","SMS1/JS688A/003","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("84","3","1","Excel","Emmanuel","SMS1/JS535A/004","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("85","3","1","Precious","Jacob","SMS1/JS560A/005","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("86","3","1","Deborah","Nicholas","SMS1/JS247A/006","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("87","3","1","Zulfa","Adebayo","SMS1/JS260A/007","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("88","3","1","Rita","Dominic","SMS1/JS461A/008","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("89","3","1","Gabriel","Dominic","SMS1/JS320A/009","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("90","3","1","Miracle","Ignatius","SMS1/JS272A/010","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("91","3","1","Michael","Jidendu","SMS1/JS255A/011","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("92","3","1","Beningna","Eleobomhe","SMS1/JS207A/012","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("93","3","1","Stephen","Ogbo","SMS1/JS481A/013","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("94","3","1","Victor","Abba","SMS1/JS322A/014","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("95","3","1","Oliver Dickson","Goodluck","SMS1/JS733A/015","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("97","1","2","Daniel","Onare","onaretayo@gmail.com","9e179240cbab1eaeaebbde78098139a1","avatar.jpg","2023-04-01 17:21:30","","1");
INSERT INTO sch_users VALUES("109","2","1","DANIEL","ONARE TAYO","daniel.M1801635@st.futminna.edu.ng","415185ea244ea2b2bedeb0449b926802","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("113","3","1","Dorcas","Onare","SMS1/JS533B/004","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("114","3","1","ty","Onare","SMS1/JS903B/005","81dc9bdb52d04dc20036dbd8313ed055","avatar.jpg","2023-03-21 22:30:16","","1");
INSERT INTO sch_users VALUES("119","3","2","DANIEL","ONARE","SMS2/JS916A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-04-01 17:25:44","","1");
INSERT INTO sch_users VALUES("124","2","1","DANIEL","ONARE","onaretayo0@gmail.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-04-02 18:26:16","","1");



CREATE TABLE `score_info` (
  `score_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `sid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

INSERT INTO score_info VALUES("1","1","9","1","1","13","1","0","05","09","09","50","73","219","1","1");
INSERT INTO score_info VALUES("49","1","9","1","1","36","1","0","09","09","05","48","71","197","1","1");
INSERT INTO score_info VALUES("50","1","9","1","1","32","1","0","09","07","07","70","93","130","1","1");
INSERT INTO score_info VALUES("51","1","9","1","1","14","1","0","10","09","08","15","42","42","1","1");
INSERT INTO score_info VALUES("52","1","9","1","1","15","1","0","07","09","08","16","40","40","1","1");
INSERT INTO score_info VALUES("53","1","9","1","1","51","1","0","10","09","08","18","45","121","1","1");
INSERT INTO score_info VALUES("55","1","9","1","1","16","1","0","10","10","10","35","65","885","1","1");
INSERT INTO score_info VALUES("57","1","9","1","1","28","1","0","10","07","09","10","36","93","1","1");
INSERT INTO score_info VALUES("58","1","9","1","1","35","1","0","10","08","05","69","92","92","1","1");
INSERT INTO score_info VALUES("59","1","9","1","1","18","1","0","10","10","10","12","42","118","1","1");
INSERT INTO score_info VALUES("60","1","9","1","1","37","1","0","07","06","06","10","29","105","1","1");
INSERT INTO score_info VALUES("62","1","9","1","1","39","1","0","10","06","06","18","40","40","1","1");
INSERT INTO score_info VALUES("63","1","9","1","1","17","1","0","10","06","06","35","57","57","1","1");
INSERT INTO score_info VALUES("64","1","9","1","1","48","1","0","08","08","05","51","72","72","1","1");
INSERT INTO score_info VALUES("66","1","9","1","1","24","1","0","08","07","07","68","90","90","1","1");
INSERT INTO score_info VALUES("67","1","5","1","1","16","1","0","10","10","10","70","100","885","1","1");
INSERT INTO score_info VALUES("68","1","9","1","1","44","1","0","07","06","08","40","61","61","1","1");
INSERT INTO score_info VALUES("69","1","9","1","1","42","1","0","09","07","07","37","60","60","1","1");
INSERT INTO score_info VALUES("70","1","9","1","1","20","1","0","06","07","07","40","60","60","1","1");
INSERT INTO score_info VALUES("73","1","7","1","1","16","1","0","10","08","08","70","96","885","1","1");
INSERT INTO score_info VALUES("74","1","3","1","1","16","1","0","09","08","08","61","86","885","1","1");
INSERT INTO score_info VALUES("75","1","10","1","1","16","1","0","10","09","06","15","40","885","1","1");
INSERT INTO score_info VALUES("76","1","14","1","1","16","1","0","09","08","08","61","86","885","1","1");
INSERT INTO score_info VALUES("77","1","11","1","1","16","1","0","08","07","07","09","31","885","1","1");
INSERT INTO score_info VALUES("78","1","16","1","1","16","1","0","06","06","09","15","36","885","1","1");
INSERT INTO score_info VALUES("79","1","2","1","1","16","1","0","07","02","09","15","33","885","1","1");
INSERT INTO score_info VALUES("80","1","6","1","1","16","1","0","10","10","10","20","50","885","1","1");
INSERT INTO score_info VALUES("81","1","4","1","1","16","1","0","09","08","09","16","42","885","1","1");
INSERT INTO score_info VALUES("82","1","8","1","1","16","1","0","10","10","10","15","45","885","1","1");
INSERT INTO score_info VALUES("83","1","9","1","1","27","1","0","09","10","08","35","62","62","1","1");
INSERT INTO score_info VALUES("84","1","9","1","1","25","1","0","10","10","07","33","60","60","1","1");
INSERT INTO score_info VALUES("85","1","9","1","1","23","1","0","09","08","07","16","40","40","1","1");
INSERT INTO score_info VALUES("86","1","9","1","1","30","1","0","09","09","09","16","43","43","1","1");
INSERT INTO score_info VALUES("87","1","9","1","1","40","1","0","09","09","07","68","93","93","1","1");
INSERT INTO score_info VALUES("89","1","9","1","1","31","1","0","08","08","08","17","41","41","1","1");
INSERT INTO score_info VALUES("90","1","9","1","1","46","1","0","09","09","08","16","42","42","1","1");
INSERT INTO score_info VALUES("91","1","9","1","1","45","1","0","08","09","09","36","62","62","1","1");
INSERT INTO score_info VALUES("95","1","8","1","1","13","1","0","07","07","08","18","40","219","1","1");
INSERT INTO score_info VALUES("98","1","9","1","1","43","1","0","09","08","08","15","40","40","1","1");
INSERT INTO score_info VALUES("99","1","9","1","1","38","1","0","08","06","07","56","77","77","1","1");
INSERT INTO score_info VALUES("100","1","9","1","1","34","1","0","09","08","08","53","78","78","1","1");
INSERT INTO score_info VALUES("102","1","5","1","1","13","1","0","09","07","09","30","55","219","1","1");
INSERT INTO score_info VALUES("103","1","8","1","1","36","1","0","00","05","08","51","64","197","1","1");
INSERT INTO score_info VALUES("106","1","1","2","1","52","1","0","10","08","09","68","95","95","0","1");
INSERT INTO score_info VALUES("107","1","5","3","1","94","1","0","09","04","07","35","55","137","0","1");
INSERT INTO score_info VALUES("108","1","9","1","1","96","1","0","10","09","06","14","39","39","1","1");
INSERT INTO score_info VALUES("109","1","12","1","1","16","1","0","09","09","09","63","90","885","1","1");
INSERT INTO score_info VALUES("110","1","21","1","1","16","1","0","08","08","09","60","85","885","1","1");
INSERT INTO score_info VALUES("111","1","5","1","1","50","1","0","08","08","05","50","71","71","1","1");
INSERT INTO score_info VALUES("113","1","9","1","1","16","2","0","10","10","10","65","95","0","1","1");
INSERT INTO score_info VALUES("114","1","9","1","1","16","3","0","10","10","10","70","100","0","0","1");
INSERT INTO score_info VALUES("116","1","5","1","1","33","1","0","08","08","06","64","86","86","1","1");
INSERT INTO score_info VALUES("117","1","8","3","1","94","1","0","05","07","10","60","82","137","0","1");
INSERT INTO score_info VALUES("118","1","8","3","1","87","1","0","09","09","08","15","41","41","0","1");
INSERT INTO score_info VALUES("119","1","8","3","1","83","1","0","09","05","07","14","35","35","0","1");
INSERT INTO score_info VALUES("120","1","8","3","1","81","1","0","08","08","07","17","40","40","0","1");
INSERT INTO score_info VALUES("121","1","8","3","1","88","1","0","08","09","08","68","93","93","0","1");
INSERT INTO score_info VALUES("122","1","8","3","1","89","1","0","08","09","09","16","42","42","0","1");
INSERT INTO score_info VALUES("123","1","8","3","1","92","1","0","09","10","09","16","44","44","0","1");
INSERT INTO score_info VALUES("124","1","8","3","1","84","1","0","09","09","09","15","42","42","0","1");
INSERT INTO score_info VALUES("125","1","8","3","1","95","1","0","06","09","09","15","39","39","0","1");
INSERT INTO score_info VALUES("126","1","8","3","1","90","1","0","07","10","10","70","97","97","0","1");
INSERT INTO score_info VALUES("127","1","8","3","1","85","1","0","09","09","07","18","43","43","0","1");
INSERT INTO score_info VALUES("128","1","8","3","1","91","1","0","10","10","08","60","88","88","0","1");
INSERT INTO score_info VALUES("129","1","8","3","1","86","1","0","09","05","06","12","32","32","0","1");
INSERT INTO score_info VALUES("130","1","8","3","1","82","1","0","08","09","10","18","45","45","0","1");
INSERT INTO score_info VALUES("131","1","8","3","1","93","1","0","10","09","07","55","81","81","0","1");
INSERT INTO score_info VALUES("133","1","2","1","1","13","1","0","10","09","08","24","51","219","1","1");
INSERT INTO score_info VALUES("134","1","2","1","1","36","1","0","09","08","07","38","62","197","1","1");
INSERT INTO score_info VALUES("135","1","2","1","1","32","1","0","08","08","07","14","37","130","1","1");
INSERT INTO score_info VALUES("136","1","2","1","1","51","1","0","08","06","07","55","76","121","1","1");
INSERT INTO score_info VALUES("137","1","2","1","1","28","1","0","09","09","08","31","57","93","1","1");
INSERT INTO score_info VALUES("141","1","9","1","1","19","1","0","08","08","09","68","93","93","1","1");
INSERT INTO score_info VALUES("142","1","9","2","1","52","1","0","09","05","10","31","55","0","0","1");
INSERT INTO score_info VALUES("143","1","2","1","1","13","2","0","08","00","00","00","8","0","0","1");
INSERT INTO score_info VALUES("144","1","9","1","1","13","2","0","08","06","08","30","52","0","0","1");
INSERT INTO score_info VALUES("145","1","2","1","1","50","2","0","09","08","08","15","40","0","0","1");
INSERT INTO score_info VALUES("146","1","2","1","1","36","2","0","10","08","08","16","42","0","0","1");
INSERT INTO score_info VALUES("147","1","2","1","1","32","2","0","09","09","08","16","42","0","0","1");
INSERT INTO score_info VALUES("148","1","2","1","1","28","2","0","08","04","10","50","72","0","0","1");
INSERT INTO score_info VALUES("149","1","15","2","1","52","1","0","09","09","09","17","44","0","0","1");
INSERT INTO score_info VALUES("150","1","9","1","1","41","1","0","04","06","10","40","60","60","1","1");
INSERT INTO score_info VALUES("151","1","9","1","1","26","1","0","05","10","09","09","33","33","1","1");
INSERT INTO score_info VALUES("152","1","9","1","1","21","1","0","08","09","09","25","51","51","1","1");
INSERT INTO score_info VALUES("153","1","9","1","1","22","1","0","08","09","09","25","51","51","1","1");
INSERT INTO score_info VALUES("154","1","5","2","1","52","1","0","08","09","08","35","60","0","0","1");
INSERT INTO score_info VALUES("155","1","2","1","1","18","1","0","04","08","09","55","76","118","1","1");
INSERT INTO score_info VALUES("156","1","2","1","1","37","1","0","04","08","09","55","76","105","1","1");



CREATE TABLE `session_info` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `done` int(11) DEFAULT 0,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

INSERT INTO session_info VALUES("1","2022/2023","1","1");
INSERT INTO session_info VALUES("2","2023/2024","0","1");
INSERT INTO session_info VALUES("3","2024/2025","0","1");
INSERT INTO session_info VALUES("4","2025/2026","0","0");
INSERT INTO session_info VALUES("5","2026/2027","0","0");
INSERT INTO session_info VALUES("6","2027/2028","0","0");
INSERT INTO session_info VALUES("7","2028/2029","0","0");
INSERT INTO session_info VALUES("8","2029/2030","0","0");
INSERT INTO session_info VALUES("9","2030/2031","0","0");
INSERT INTO session_info VALUES("10","2031/2032","0","0");
INSERT INTO session_info VALUES("11","2032/2033","0","0");
INSERT INTO session_info VALUES("12","2033/2034","0","0");
INSERT INTO session_info VALUES("13","2034/2035","0","0");
INSERT INTO session_info VALUES("14","2035/2036","0","0");
INSERT INTO session_info VALUES("15","2036/2037","0","0");
INSERT INTO session_info VALUES("16","2037/2038","0","0");
INSERT INTO session_info VALUES("17","2038/2039","0","0");
INSERT INTO session_info VALUES("18","2039/2040","0","0");
INSERT INTO session_info VALUES("19","2040/2041","0","0");
INSERT INTO session_info VALUES("20","2041/2042","0","0");
INSERT INTO session_info VALUES("21","2042/2043","0","0");
INSERT INTO session_info VALUES("22","2043/2044","0","0");
INSERT INTO session_info VALUES("23","2044/2045","0","0");
INSERT INTO session_info VALUES("24","2045/2046","0","0");
INSERT INTO session_info VALUES("25","2046/2047","0","0");
INSERT INTO session_info VALUES("26","2047/2048","0","0");
INSERT INTO session_info VALUES("27","2048/2049","0","0");
INSERT INTO session_info VALUES("28","2049/2050","0","0");
INSERT INTO session_info VALUES("29","2050/2051","0","0");
INSERT INTO session_info VALUES("30","2051/2052","0","0");
INSERT INTO session_info VALUES("31","2052/2053","0","0");
INSERT INTO session_info VALUES("32","2053/2054","0","0");
INSERT INTO session_info VALUES("33","2054/2055","0","0");
INSERT INTO session_info VALUES("34","2055/2056","0","0");
INSERT INTO session_info VALUES("35","2056/2057","0","0");
INSERT INTO session_info VALUES("36","2057/2058","0","0");
INSERT INTO session_info VALUES("37","2058/2059","0","0");
INSERT INTO session_info VALUES("38","2059/2060","0","0");
INSERT INTO session_info VALUES("39","2060/2061","0","0");
INSERT INTO session_info VALUES("40","2061/2062","0","0");
INSERT INTO session_info VALUES("41","2062/2063","0","0");
INSERT INTO session_info VALUES("42","2063/2064","0","0");
INSERT INTO session_info VALUES("43","2064/2065","0","0");
INSERT INTO session_info VALUES("44","2065/2066","0","0");
INSERT INTO session_info VALUES("45","2066/2067","0","0");
INSERT INTO session_info VALUES("46","2067/2068","0","0");
INSERT INTO session_info VALUES("47","2068/2069","0","0");
INSERT INTO session_info VALUES("48","2069/2070","0","0");
INSERT INTO session_info VALUES("49","2070/2071","0","0");
INSERT INTO session_info VALUES("50","2071/2072","0","0");
INSERT INTO session_info VALUES("51","2072/2073","0","0");
INSERT INTO session_info VALUES("52","2073/2074","0","0");
INSERT INTO session_info VALUES("53","2074/2075","0","0");
INSERT INTO session_info VALUES("54","2075/2076","0","0");
INSERT INTO session_info VALUES("55","2076/2077","0","0");
INSERT INTO session_info VALUES("56","2077/2078","0","0");
INSERT INTO session_info VALUES("57","2078/2079","0","0");
INSERT INTO session_info VALUES("58","2079/2080","0","0");



CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `setting_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO settings VALUES("1","1","Show Position","1");



CREATE TABLE `staff_by_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `staff_info` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `file_no` varchar(20) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `acc_no` varchar(15) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

INSERT INTO staff_info VALUES("1","1","2","8","0","0","0","1","2","0000-00-00","0","","2","","","2","0","","","","","0","0","");
INSERT INTO staff_info VALUES("2","1","3","3","0","0","0","1","1","0000-00-00","16","282","0","","","1","0","","8","","","0","0","");
INSERT INTO staff_info VALUES("3","1","4","3","0","0","0","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("4","1","5","2","0","0","0","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("5","1","6","1","0","0","0","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("6","1","7","3","0","0","0","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("7","1","8","3","0","0","0","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("8","1","9","1","0","0","0","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("9","1","10","1","0","0","0","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("10","1","11","5","0","0","0","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("11","1","12","5","0","0","0","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("12","1","3","3","7","1","1","1","1","0000-00-00","16","282","0","","","1","0","","8","","","0","0","");
INSERT INTO staff_info VALUES("13","1","3","3","7","2","1","1","1","0000-00-00","16","282","0","","","1","0","","8","","","0","0","");
INSERT INTO staff_info VALUES("15","1","4","3","3","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("16","1","4","3","3","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("18","1","4","3","10","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("21","1","4","3","14","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("24","1","5","2","11","1","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("25","1","5","2","11","2","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("26","1","5","2","11","3","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("27","1","5","2","16","1","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("28","1","5","2","16","2","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("29","1","5","2","16","3","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("30","1","6","1","13","1","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("31","1","6","1","13","2","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("32","1","6","1","13","3","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("34","1","7","3","2","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("35","1","7","3","2","3","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("36","1","8","3","6","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("37","1","8","3","6","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("38","1","8","3","6","3","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("39","1","8","3","4","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("40","1","8","3","4","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("41","1","8","3","4","3","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("42","1","9","1","1","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("43","1","9","1","1","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("44","1","9","1","1","3","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("46","1","10","1","9","2","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("47","1","10","1","9","3","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("49","1","10","1","5","2","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("50","1","10","1","5","3","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("52","1","10","1","15","2","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("54","1","11","5","19","1","1","0","2","0000-00-00","0","","2","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("57","1","12","5","8","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("58","1","12","5","8","2","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("59","1","12","5","8","3","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("60","1","12","5","12","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("61","1","12","5","21","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("69","1","109","4","0","0","0","0","0","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("72","1","4","3","10","1","2","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("73","1","4","3","3","1","2","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("74","1","4","3","14","1","2","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("75","1","10","1","9","1","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("78","1","10","1","2","1","1","2","2","0000-00-00","0","","1","","","1","5","","5","Economics","","0","0","");
INSERT INTO staff_info VALUES("84","1","124","2","0","0","0","1","1","2023-04-02","23","469","1","08145162722","Opposite Assemblies of God Church Goldspring Street Dagiri Gwagwalada FCT","1","1","2023-04-02","6","Engineering","GIS/2023/124","0","1","0109309870");
INSERT INTO staff_info VALUES("85","1","7","3","2","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");
INSERT INTO staff_info VALUES("86","1","7","3","9","1","1","0","1","0000-00-00","0","","0","","","1","0","","","","","0","0","");



CREATE TABLE `staff_type_info` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_type` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO staff_type_info VALUES("1","Academic");
INSERT INTO staff_type_info VALUES("2","Non academic");



CREATE TABLE `state_info` (
  `state_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(27) NOT NULL,
  `state_code` text DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO state_info VALUES("1","Abia","ABI");
INSERT INTO state_info VALUES("2","Adamawa","ADA");
INSERT INTO state_info VALUES("3","Akwa Ibom","AKW");
INSERT INTO state_info VALUES("4","Anambra","ANA");
INSERT INTO state_info VALUES("5","Bauchi","BAU");
INSERT INTO state_info VALUES("6","Bayelsa","BAY");
INSERT INTO state_info VALUES("7","Benue","BEN");
INSERT INTO state_info VALUES("8","Borno","BOR");
INSERT INTO state_info VALUES("9","Cross-River","CRO");
INSERT INTO state_info VALUES("10","Delta","DEL");
INSERT INTO state_info VALUES("11","Ebonyi","EBO");
INSERT INTO state_info VALUES("12","Edo","EDO");
INSERT INTO state_info VALUES("13","Ekiti","EKI");
INSERT INTO state_info VALUES("14","Enugu","ENU");
INSERT INTO state_info VALUES("15","FCT","FCT");
INSERT INTO state_info VALUES("16","Gombe","GOM");
INSERT INTO state_info VALUES("17","Imo","IMO");
INSERT INTO state_info VALUES("18","Jigawa","JIG");
INSERT INTO state_info VALUES("19","Kaduna","KAD");
INSERT INTO state_info VALUES("20","Kano","KAN");
INSERT INTO state_info VALUES("21","Katsina","KAT");
INSERT INTO state_info VALUES("22","Kebbi","KEB");
INSERT INTO state_info VALUES("23","Kogi","KOG");
INSERT INTO state_info VALUES("24","Kwara","KWA");
INSERT INTO state_info VALUES("25","Lagos","LAG");
INSERT INTO state_info VALUES("26","Nasarawa","NAS");
INSERT INTO state_info VALUES("27","Niger","NIG");
INSERT INTO state_info VALUES("28","Ogun","OGU");
INSERT INTO state_info VALUES("29","Ondo","OND");
INSERT INTO state_info VALUES("30","Osun","OSU");
INSERT INTO state_info VALUES("31","Oyo","OYO");
INSERT INTO state_info VALUES("32","Plateau","PLA");
INSERT INTO state_info VALUES("33","Rivers","RIV");
INSERT INTO state_info VALUES("34","Sokoto","SOK");
INSERT INTO state_info VALUES("35","Taraba","TAR");
INSERT INTO state_info VALUES("36","Yobe","YOB");
INSERT INTO state_info VALUES("37","Zamfara","ZAM");



CREATE TABLE `stdnt_com` (
  `scom_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`scom_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `stdnt_info` (
  `stdnt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `house_id` int(11) NOT NULL,
  PRIMARY KEY (`stdnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

INSERT INTO stdnt_info VALUES("1","13","1","1","1","GIS/20/016","1","2022-11-13","1","1","1","15","278","1","Daniel","Father","08145162722","onaretayo@gmail.com","Opposite Assemblies of God Church Goldspring Street Dagiri Gwagwalada FCT","1","0","21","0","2");
INSERT INTO stdnt_info VALUES("2","14","1","1","2","","1","","0","0","0","0","","0","","","08145162722","","","1","0","1","0","0");
INSERT INTO stdnt_info VALUES("3","15","1","1","2","","2","","0","0","0","0","","0","","","07031689360","onare1@gmail.com","","1","0","18","0","0");
INSERT INTO stdnt_info VALUES("4","16","1","1","1","","2","2008-02-28","0","0","0","0","","0","","","","","","1","0","15","0","0");
INSERT INTO stdnt_info VALUES("5","17","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","18","0","0");
INSERT INTO stdnt_info VALUES("6","18","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","11","0","0");
INSERT INTO stdnt_info VALUES("7","19","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","18","0","0");
INSERT INTO stdnt_info VALUES("8","20","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","17","0","0");
INSERT INTO stdnt_info VALUES("9","21","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","16","0","0");
INSERT INTO stdnt_info VALUES("10","22","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","16","0","0");
INSERT INTO stdnt_info VALUES("11","23","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","18","0","0");
INSERT INTO stdnt_info VALUES("12","24","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("13","25","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("14","26","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("15","27","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","16","0","0");
INSERT INTO stdnt_info VALUES("16","28","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("17","29","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("18","30","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("19","31","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("20","32","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("21","33","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("22","34","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("23","35","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("24","36","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("25","37","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("26","38","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("27","39","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("28","40","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("29","41","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("30","42","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("31","43","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("32","44","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("33","45","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","2");
INSERT INTO stdnt_info VALUES("34","46","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("35","47","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("36","48","1","1","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("37","49","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("38","50","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("39","51","1","1","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("40","52","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("41","53","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("42","54","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("43","55","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("44","56","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("45","57","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("46","58","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("47","59","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("48","60","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("49","61","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("50","62","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("51","63","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("52","64","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("53","65","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("54","66","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("55","67","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("56","68","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("57","69","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("58","70","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("59","71","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("60","72","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("61","73","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("62","74","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("63","75","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("64","76","1","2","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("65","77","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("66","78","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("67","79","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("68","80","1","2","1","0","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("69","81","1","3","1","GIS/20/001","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("70","82","1","3","1","GIS/20/007","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("71","83","1","3","1","GIS/20/009","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("72","84","1","3","1","GIS/20/010","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("73","85","1","3","1","GIS/20/011","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("74","86","1","3","1","GIS/20/012","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("75","87","1","3","1","GIS/20/014","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("76","88","1","3","1","GIS/20/015","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("77","89","1","3","1","GIS/20/016","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("78","90","1","3","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("79","91","1","3","1","GIS/20/026","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("80","92","1","3","1","GIS/20/005","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("81","93","1","3","1","GIS/20/042","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("82","94","1","3","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("83","95","1","3","1","0","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("95","113","1","1","2","","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("96","114","1","1","2","","0","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("100","119","2","1","1","","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");



CREATE TABLE `stu_assignment` (
  `assgn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date_of_subm` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `assign_score` int(11) NOT NULL,
  PRIMARY KEY (`assgn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO stu_assignment VALUES("16","32","Social Studies_32-1-1.","5","2023-03-14 21:08:02","1","1","0");
INSERT INTO stu_assignment VALUES("17","13","Civic Education_13-1-1.jpg","9","2023-04-21 10:07:26","1","1","14");



CREATE TABLE `student_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_type` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO student_type VALUES("1","Day Student");
INSERT INTO student_type VALUES("2","Boarding Student");



CREATE TABLE `subj_info` (
  `subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_title` varchar(30) NOT NULL,
  `subj_abr` varchar(10) NOT NULL,
  `subj_type` varchar(10) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

INSERT INTO subj_info VALUES("1","English Studies","Eng","Core");
INSERT INTO subj_info VALUES("2","Mathematics","Maths","Core");
INSERT INTO subj_info VALUES("3","Basic Science","B. SCI","Core");
INSERT INTO subj_info VALUES("4","Basic Technology","B. Tech","Core");
INSERT INTO subj_info VALUES("5","Social Studies","Soc. Stu","Core");
INSERT INTO subj_info VALUES("6","Computer Science","Comp","Core");
INSERT INTO subj_info VALUES("7","Agricultural Science","Agric","Core");
INSERT INTO subj_info VALUES("8","French","French","Core");
INSERT INTO subj_info VALUES("9","Civic Education","C. Edu","Core");
INSERT INTO subj_info VALUES("10","Physical & Health Education","P.H.E","Core");
INSERT INTO subj_info VALUES("11","Home Economics","H. Econ","Core");
INSERT INTO subj_info VALUES("12","Business Studies","Bus Stu","Core");
INSERT INTO subj_info VALUES("13","C.R.S","C.R.S","Elective");
INSERT INTO subj_info VALUES("14","I.R.S","I.R.S","Elective");
INSERT INTO subj_info VALUES("15","Cultural & Creative Art","C.C.A","Core");
INSERT INTO subj_info VALUES("16","Security Education","Secu. Edu","Core");
INSERT INTO subj_info VALUES("17","History","Hist.","Core");
INSERT INTO subj_info VALUES("18","Hausa Language","Hausa","Elective");
INSERT INTO subj_info VALUES("19","Igbo Language","Igbo","Elective");
INSERT INTO subj_info VALUES("20","Yoruba Language","Yoruba","Elective");
INSERT INTO subj_info VALUES("21","Signals","Sig","Elective");
INSERT INTO subj_info VALUES("22","Programming","prog","Elective");
INSERT INTO subj_info VALUES("23","Programming","prog","Core");
INSERT INTO subj_info VALUES("24","Programming","prog","Core");
INSERT INTO subj_info VALUES("25","Programming","prog","Elective");
INSERT INTO subj_info VALUES("26","Programming","prog","Core");
INSERT INTO subj_info VALUES("27","English","Eng","Elective");
INSERT INTO subj_info VALUES("28","English","Eng2","Elective");
INSERT INTO subj_info VALUES("29","Signals and System","tyu","Core");



CREATE TABLE `teachers_com` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(200) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO teachers_com VALUES("1","Exhibits a positive outlook and attitude in the classroom.");
INSERT INTO teachers_com VALUES("2","Shows enthusiasm for classroom activities.");
INSERT INTO teachers_com VALUES("3","Strives to reach their full potential.");
INSERT INTO teachers_com VALUES("4","Cooperates consistently with the teacher and other students.");
INSERT INTO teachers_com VALUES("5","Courteous and shows good manners in the classroom.");
INSERT INTO teachers_com VALUES("6","Responds appropriately when corrected.");
INSERT INTO teachers_com VALUES("7","Resists the urge to be distracted by other students.");
INSERT INTO teachers_com VALUES("8","Sets an example of excellence in behavior and cooperation.");
INSERT INTO teachers_com VALUES("9","Shows respect for teachers and peers.");
INSERT INTO teachers_com VALUES("10","Treats school property and the belongings of others with care and respect.");
INSERT INTO teachers_com VALUES("11","Honest and trustworthy in dealings with others.");
INSERT INTO teachers_com VALUES("12","Expresses ideas clearly, both verbally and through writing.");
INSERT INTO teachers_com VALUES("13","Welcomes leadership roles in groups.");
INSERT INTO teachers_com VALUES("14","Provides background knowledge about topics of particular interest");
INSERT INTO teachers_com VALUES("15","Has a flair for dramatic reading and acting.");
INSERT INTO teachers_com VALUES("16","Makes friends quickly in the classroom.");
INSERT INTO teachers_com VALUES("17","Well-liked by classmates.");
INSERT INTO teachers_com VALUES("18","Tackles classroom assignments, tasks, and group work in an organized manner.");
INSERT INTO teachers_com VALUES("19","Completes assignments in the time allotted.");
INSERT INTO teachers_com VALUES("20","A conscientious, hard-working student.");
INSERT INTO teachers_com VALUES("21","A self-motivated student.");
INSERT INTO teachers_com VALUES("22","Readily grasps new concepts and ideas.");
INSERT INTO teachers_com VALUES("23","Uses free minutes of class time constructively.");



CREATE TABLE `term_info` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `term_title` enum('First Term','Second Term','Third Term') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO term_info VALUES("1","First Term","1");
INSERT INTO term_info VALUES("2","Second Term","0");
INSERT INTO term_info VALUES("3","Third Term","0");



CREATE TABLE `testimonial` (
  `cert_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cert_passport` varchar(20) NOT NULL,
  `year_of_admn` int(11) NOT NULL,
  `year_of_grad` int(11) NOT NULL,
  `office_held` varchar(20) NOT NULL,
  `award` varchar(20) NOT NULL,
  `hobbies` varchar(45) NOT NULL,
  `remark` int(11) NOT NULL,
  PRIMARY KEY (`cert_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO testimonial VALUES("1","61","","0","0","0","","0","1");
INSERT INTO testimonial VALUES("2","83","","0","0","0","","0","0");



CREATE TABLE `web_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(41) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO web_admin VALUES("1","onaretayo@gmail.com","908316b9a0f612ff3cdc28129e6cbb4e","onaretayo.jpg","4","1");



CREATE TABLE `year_info` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `year_title` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

INSERT INTO year_info VALUES("1","2022","1");
INSERT INTO year_info VALUES("2","2023","0");
INSERT INTO year_info VALUES("3","2024","0");
INSERT INTO year_info VALUES("4","2025","0");
INSERT INTO year_info VALUES("5","2026","0");
INSERT INTO year_info VALUES("6","2027","0");
INSERT INTO year_info VALUES("7","2028","0");
INSERT INTO year_info VALUES("8","2029","0");
INSERT INTO year_info VALUES("9","2030","0");
INSERT INTO year_info VALUES("10","2031","0");
INSERT INTO year_info VALUES("11","2032","0");
INSERT INTO year_info VALUES("12","2033","0");
INSERT INTO year_info VALUES("13","2034","0");
INSERT INTO year_info VALUES("14","2035","0");
INSERT INTO year_info VALUES("15","2036","0");
INSERT INTO year_info VALUES("16","2037","0");
INSERT INTO year_info VALUES("17","2038","0");
INSERT INTO year_info VALUES("18","2039","0");
INSERT INTO year_info VALUES("19","2040","0");
INSERT INTO year_info VALUES("20","2041","0");
INSERT INTO year_info VALUES("21","2042","0");
INSERT INTO year_info VALUES("22","2043","0");
INSERT INTO year_info VALUES("23","2044","0");
INSERT INTO year_info VALUES("24","2045","0");
INSERT INTO year_info VALUES("25","2046","0");
INSERT INTO year_info VALUES("26","2047","0");
INSERT INTO year_info VALUES("27","2048","0");
INSERT INTO year_info VALUES("28","2049","0");
INSERT INTO year_info VALUES("29","2050","0");
INSERT INTO year_info VALUES("30","2051","0");
INSERT INTO year_info VALUES("31","2052","0");
INSERT INTO year_info VALUES("32","2053","0");
INSERT INTO year_info VALUES("33","2054","0");
INSERT INTO year_info VALUES("34","2055","0");
INSERT INTO year_info VALUES("35","2056","0");
INSERT INTO year_info VALUES("36","2057","0");
INSERT INTO year_info VALUES("37","2058","0");
INSERT INTO year_info VALUES("38","2059","0");
INSERT INTO year_info VALUES("39","2060","0");
INSERT INTO year_info VALUES("40","2061","0");
INSERT INTO year_info VALUES("41","2062","0");
INSERT INTO year_info VALUES("42","2063","0");
INSERT INTO year_info VALUES("43","2064","0");
INSERT INTO year_info VALUES("44","2065","0");
INSERT INTO year_info VALUES("45","2066","0");
INSERT INTO year_info VALUES("46","2067","0");
INSERT INTO year_info VALUES("47","2068","0");
INSERT INTO year_info VALUES("48","2069","0");
INSERT INTO year_info VALUES("49","2070","0");
INSERT INTO year_info VALUES("50","2071","0");
INSERT INTO year_info VALUES("51","2072","0");
INSERT INTO year_info VALUES("52","2073","0");
INSERT INTO year_info VALUES("53","2074","0");
INSERT INTO year_info VALUES("54","2075","0");
INSERT INTO year_info VALUES("55","2076","0");
INSERT INTO year_info VALUES("56","2077","0");
INSERT INTO year_info VALUES("57","2078","0");
INSERT INTO year_info VALUES("58","2079","0");
INSERT INTO year_info VALUES("59","2080","0");
INSERT INTO year_info VALUES("60","2081","0");
INSERT INTO year_info VALUES("61","2082","0");
INSERT INTO year_info VALUES("62","2083","0");
INSERT INTO year_info VALUES("63","2084","0");
INSERT INTO year_info VALUES("64","2085","0");
INSERT INTO year_info VALUES("65","2086","0");
INSERT INTO year_info VALUES("66","2087","0");
INSERT INTO year_info VALUES("67","2088","0");
INSERT INTO year_info VALUES("68","2089","0");
INSERT INTO year_info VALUES("69","2090","0");
INSERT INTO year_info VALUES("70","2091","0");
INSERT INTO year_info VALUES("71","2092","0");
INSERT INTO year_info VALUES("72","2093","0");
INSERT INTO year_info VALUES("73","2094","0");
INSERT INTO year_info VALUES("74","2095","0");
INSERT INTO year_info VALUES("75","2096","0");
INSERT INTO year_info VALUES("76","2097","0");
INSERT INTO year_info VALUES("77","2098","0");
INSERT INTO year_info VALUES("78","2099","0");
INSERT INTO year_info VALUES("79","2100","0");
INSERT INTO year_info VALUES("80","2101","0");
INSERT INTO year_info VALUES("81","2102","0");
INSERT INTO year_info VALUES("82","2103","0");
INSERT INTO year_info VALUES("83","2104","0");
INSERT INTO year_info VALUES("84","2105","0");
INSERT INTO year_info VALUES("85","2106","0");
INSERT INTO year_info VALUES("86","2107","0");
INSERT INTO year_info VALUES("87","2108","0");
INSERT INTO year_info VALUES("88","2109","0");
INSERT INTO year_info VALUES("89","2110","0");
INSERT INTO year_info VALUES("90","2111","0");
INSERT INTO year_info VALUES("91","2112","0");
INSERT INTO year_info VALUES("92","2113","0");
INSERT INTO year_info VALUES("93","2114","0");
INSERT INTO year_info VALUES("94","2115","0");
INSERT INTO year_info VALUES("95","2116","0");
INSERT INTO year_info VALUES("96","2117","0");
INSERT INTO year_info VALUES("97","2118","0");
INSERT INTO year_info VALUES("98","2119","0");
INSERT INTO year_info VALUES("99","2120","0");
INSERT INTO year_info VALUES("100","2121","0");
INSERT INTO year_info VALUES("101","2122","0");
INSERT INTO year_info VALUES("102","2123","0");
INSERT INTO year_info VALUES("103","2124","0");
INSERT INTO year_info VALUES("104","2125","0");
INSERT INTO year_info VALUES("105","2126","0");
INSERT INTO year_info VALUES("106","2127","0");
INSERT INTO year_info VALUES("107","2128","0");
INSERT INTO year_info VALUES("108","2129","0");
INSERT INTO year_info VALUES("109","2130","0");
INSERT INTO year_info VALUES("110","2131","0");
INSERT INTO year_info VALUES("111","2132","0");
INSERT INTO year_info VALUES("112","2133","0");
INSERT INTO year_info VALUES("113","2134","0");
INSERT INTO year_info VALUES("114","2135","0");
INSERT INTO year_info VALUES("115","2136","0");
INSERT INTO year_info VALUES("116","2137","0");
INSERT INTO year_info VALUES("117","2138","0");
INSERT INTO year_info VALUES("118","2139","0");
INSERT INTO year_info VALUES("119","2140","0");
INSERT INTO year_info VALUES("120","2141","0");
INSERT INTO year_info VALUES("121","2142","0");
INSERT INTO year_info VALUES("122","2143","0");
INSERT INTO year_info VALUES("123","2144","0");
INSERT INTO year_info VALUES("124","2145","0");
INSERT INTO year_info VALUES("125","2146","0");
INSERT INTO year_info VALUES("126","2147","0");
INSERT INTO year_info VALUES("127","2148","0");
INSERT INTO year_info VALUES("128","2149","0");
INSERT INTO year_info VALUES("129","2150","0");
INSERT INTO year_info VALUES("130","2151","0");
INSERT INTO year_info VALUES("131","2152","0");
INSERT INTO year_info VALUES("132","2153","0");
INSERT INTO year_info VALUES("133","2154","0");
INSERT INTO year_info VALUES("134","2155","0");
INSERT INTO year_info VALUES("135","2156","0");
INSERT INTO year_info VALUES("136","2157","0");
INSERT INTO year_info VALUES("137","2158","0");
INSERT INTO year_info VALUES("138","2159","0");
INSERT INTO year_info VALUES("139","2160","0");
INSERT INTO year_info VALUES("140","2161","0");
INSERT INTO year_info VALUES("141","2162","0");
INSERT INTO year_info VALUES("142","2163","0");
INSERT INTO year_info VALUES("143","2164","0");
INSERT INTO year_info VALUES("144","2165","0");
INSERT INTO year_info VALUES("145","2166","0");
INSERT INTO year_info VALUES("146","2167","0");
INSERT INTO year_info VALUES("147","2168","0");
INSERT INTO year_info VALUES("148","2169","0");
INSERT INTO year_info VALUES("149","2170","0");
INSERT INTO year_info VALUES("150","2171","0");
INSERT INTO year_info VALUES("151","2172","0");
INSERT INTO year_info VALUES("152","2173","0");
INSERT INTO year_info VALUES("153","2174","0");
INSERT INTO year_info VALUES("154","2175","0");
INSERT INTO year_info VALUES("155","2176","0");
INSERT INTO year_info VALUES("156","2177","0");
INSERT INTO year_info VALUES("157","2178","0");
INSERT INTO year_info VALUES("158","2179","0");
INSERT INTO year_info VALUES("159","2180","0");
INSERT INTO year_info VALUES("160","2181","0");
INSERT INTO year_info VALUES("161","2182","0");
INSERT INTO year_info VALUES("162","2183","0");
INSERT INTO year_info VALUES("163","2184","0");
INSERT INTO year_info VALUES("164","2185","0");
INSERT INTO year_info VALUES("165","2186","0");
INSERT INTO year_info VALUES("166","2187","0");
INSERT INTO year_info VALUES("167","2188","0");
INSERT INTO year_info VALUES("168","2189","0");
INSERT INTO year_info VALUES("169","2190","0");
INSERT INTO year_info VALUES("170","2191","0");
INSERT INTO year_info VALUES("171","2192","0");
INSERT INTO year_info VALUES("172","2193","0");
INSERT INTO year_info VALUES("173","2194","0");
INSERT INTO year_info VALUES("174","2195","0");
INSERT INTO year_info VALUES("175","2196","0");
INSERT INTO year_info VALUES("176","2197","0");
INSERT INTO year_info VALUES("177","2198","0");
INSERT INTO year_info VALUES("178","2199","0");
INSERT INTO year_info VALUES("179","2200","0");
INSERT INTO year_info VALUES("180","2201","0");
INSERT INTO year_info VALUES("181","2202","0");
INSERT INTO year_info VALUES("182","2203","0");
INSERT INTO year_info VALUES("183","2204","0");
INSERT INTO year_info VALUES("184","2205","0");
INSERT INTO year_info VALUES("185","2206","0");
INSERT INTO year_info VALUES("186","2207","0");
INSERT INTO year_info VALUES("187","2208","0");
INSERT INTO year_info VALUES("188","2209","0");
INSERT INTO year_info VALUES("189","2210","0");
INSERT INTO year_info VALUES("190","2211","0");
INSERT INTO year_info VALUES("191","2212","0");
INSERT INTO year_info VALUES("192","2213","0");
INSERT INTO year_info VALUES("193","2214","0");
INSERT INTO year_info VALUES("194","2215","0");
INSERT INTO year_info VALUES("195","2216","0");
INSERT INTO year_info VALUES("196","2217","0");
INSERT INTO year_info VALUES("197","2218","0");
INSERT INTO year_info VALUES("198","2219","0");
INSERT INTO year_info VALUES("199","2220","0");
INSERT INTO year_info VALUES("200","2221","0");
INSERT INTO year_info VALUES("201","2222","0");


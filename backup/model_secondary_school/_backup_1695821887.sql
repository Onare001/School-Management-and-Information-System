

CREATE TABLE `account_details` (
  `acc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `acc_no` varchar(10) NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `admission` (
  `appl_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `sex_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `appl_no` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`appl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO admission VALUES("1","Tayo","Onare","Daniel","1","0","0","SMS/2023/","0000-00-00","0");



CREATE TABLE `assgn_questions` (
  `aques_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assgn_question` varchar(200) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`aques_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `attempted_payment` (
  `trial_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `attendance` (
  `attd_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attendance` varchar(20) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`attd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `bank_info` (
  `bank_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bank` varchar(50) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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
  `bld_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(5) NOT NULL,
  PRIMARY KEY (`bld_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO blood_info VALUES("1","A+");
INSERT INTO blood_info VALUES("2","B+");
INSERT INTO blood_info VALUES("3","AB+");
INSERT INTO blood_info VALUES("4","O+");



CREATE TABLE `broadcast_msg` (
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `information` text NOT NULL,
  `audience` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `cand_questions` (
  `cand_ques_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sn_qno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `cand_answer` text NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`cand_ques_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `cbt_score` (
  `score_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `class_cat` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO class_cat VALUES("1","1","A");



CREATE TABLE `class_info` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO class_info VALUES("1","0","Nursery 1");
INSERT INTO class_info VALUES("2","0","Nursery 2");
INSERT INTO class_info VALUES("3","0","Primary 1");
INSERT INTO class_info VALUES("4","0","Primary 2");
INSERT INTO class_info VALUES("5","0","Primary 3");
INSERT INTO class_info VALUES("6","0","Primary 4");
INSERT INTO class_info VALUES("7","0","Primary 5");
INSERT INTO class_info VALUES("8","0","Primary 6");
INSERT INTO class_info VALUES("9","0","Graduated");



CREATE TABLE `class_timetable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `club_info` (
  `club_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO cum_result VALUES("1","1","7","1","1","3","77","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("2","1","7","1","1","5","92","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("3","1","7","1","1","6","82","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("4","1","3","1","1","3","27","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("5","1","3","1","1","5","65","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("6","1","3","1","1","6","46","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("7","1","4","1","1","3","40","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("8","1","4","1","1","5","37","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("9","1","4","1","1","6","91","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("10","1","12","1","1","3","80","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("11","1","12","1","1","5","39","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("12","1","12","1","1","6","29","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("13","1","5","1","1","3","29","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("14","1","5","1","1","6","71","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("15","1","5","1","1","5","66","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("16","1","1","1","1","3","81","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("17","1","1","1","1","5","75","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("18","1","1","1","1","6","61","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("19","1","9","1","1","3","35","0","0","0","0","0","0","1");
INSERT INTO cum_result VALUES("20","1","9","1","1","6","31","0","0","0","0","0","0","1");



CREATE TABLE `department` (
  `dept_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `exam_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `exam_timetable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `examination_question` (
  `question_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `form_teacher_info` (
  `ft_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `gender_info` (
  `sex_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`sex_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO gender_info VALUES("1","Male");
INSERT INTO gender_info VALUES("2","Female");
INSERT INTO gender_info VALUES("3","Others");



CREATE TABLE `genotype_info` (
  `geno_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gtype` varchar(5) NOT NULL,
  PRIMARY KEY (`geno_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO genotype_info VALUES("1","AA");
INSERT INTO genotype_info VALUES("2","AS");
INSERT INTO genotype_info VALUES("3","SS");



CREATE TABLE `house_info` (
  `house_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `house` varchar(20) NOT NULL,
  `house_color` varchar(20) NOT NULL,
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `ledger_info` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `lesson_notes` (
  `lesson_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `week` int(11) NOT NULL,
  `topic` text NOT NULL,
  `lesson_note` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `year_created` int(11) NOT NULL,
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `local_governments` (
  `lg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`lg_id`)
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
  `status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `m_status` varchar(10) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO m_status_info VALUES("1","Single");
INSERT INTO m_status_info VALUES("2","Married");
INSERT INTO m_status_info VALUES("3","Divorced");
INSERT INTO m_status_info VALUES("4","Widow");



CREATE TABLE `messages` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `message_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `parent_info` (
  `parent_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `payment_log` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `payment_type` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `pin_details` (
  `pin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`pin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `pin_info` (
  `pin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pin_code` varchar(20) NOT NULL,
  `date_generated` varchar(20) NOT NULL,
  PRIMARY KEY (`pin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `post_info` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(30) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO post_info VALUES("1","Principal");
INSERT INTO post_info VALUES("2","V.P.Admin");
INSERT INTO post_info VALUES("3","V.P.Acadmics");
INSERT INTO post_info VALUES("4","Head Master/Mistress");
INSERT INTO post_info VALUES("5","Teacher");



CREATE TABLE `privileges` (
  `privilege_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `privilege` varchar(20) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
  `qual_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `rank_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rank` varchar(50) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `registered_subject` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `religion_info` (
  `rel_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `religion` varchar(20) NOT NULL,
  PRIMARY KEY (`rel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO religion_info VALUES("1","Christianity");
INSERT INTO religion_info VALUES("2","Islam");
INSERT INTO religion_info VALUES("3","Others");



CREATE TABLE `report_log` (
  `report_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `result_publishing` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `signature` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `resumption_date` (
  `date_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `next_date` varchar(20) NOT NULL,
  PRIMARY KEY (`date_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `sch_gallery` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image_name` varchar(45) NOT NULL,
  `caption` text NOT NULL,
  `date_created` int(11) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`img_id`)
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

INSERT INTO sch_info VALUES("1","onaretayo@gmail.com","08145162722","08145162722","19","#c24242","school Name International School","Creating Technical Solutions","Opposite Assemblies of God Church, Goldspring Street Dagiri - Gwagwalada FCT","10","fut_logo1.png","","","agreed","MjAyNDA1","MjAyMzA1","1","1","2023-06-03 22:50:30");
INSERT INTO sch_info VALUES("2","info@mss.com","08145162722","08145162722","27","#9531c4","Model Secondary School","Smartness","Opposite NECO Headquarters Minna Niger State","456","logo.jpg","","","agreed","MjAyNC1KYW5","MjAyMy1TZXB0ZW1iZXI=","1","1","2023-09-27 08:10:04");



CREATE TABLE `sch_pin` (
  `sch_pin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pin_code` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  PRIMARY KEY (`sch_pin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO sch_pin VALUES("1","NDYzMzU5NzYyNDc3NzQ0Ng==","1","1");



CREATE TABLE `sch_theme` (
  `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_code` varchar(10) NOT NULL DEFAULT '#0085B2',
  `theme_name` varchar(20) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `sch_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO sch_users VALUES("1","1","1","DANIEL","ONARE","onaretayo@gmail.com","e10adc3949ba59abbe56e057f20f883e","avatar.jpg","2023-05-29 13:03:08","","1");
INSERT INTO sch_users VALUES("2","2","1","Opeyemi","Onare","ope@nmt.com","e82c4b19b8151ddc25d4d93baf7b908f","avatar.jpg","2023-05-29 13:06:17","","1");
INSERT INTO sch_users VALUES("3","3","1","Chibuzor","Okoro","SMS1/NPS347A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-05-29 13:07:04","","1");
INSERT INTO sch_users VALUES("4","3","1","Chibuzor2","Okoro","SMS1/NPS853A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-05-29 13:08:31","","1");
INSERT INTO sch_users VALUES("5","3","1","DANIELLE","ONARE","SMS1/NPS731A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_female.jpg","2023-05-29 13:14:20","","1");
INSERT INTO sch_users VALUES("6","3","1","DANIEL","ONARE","SMS1/NPS374A/002","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-09-27 08:18:00","","1");
INSERT INTO sch_users VALUES("7","3","1","DANIEL","ONARETAYO","SMS1/NPS341A/001","81dc9bdb52d04dc20036dbd8313ed055","avatar_male.jpg","2023-05-31 14:41:40","","1");
INSERT INTO sch_users VALUES("8","1","2","Daniel Tayo","Onare","info@mss.com","e10adc3949ba59abbe56e057f20f883e","avatar.jpg","2023-09-27 08:09:15","","1");
INSERT INTO sch_users VALUES("9","3","2","Ayomide","Yahaya","SMS2/NPS123A/001","81dc9bdb52d04dc20036dbd8313ed055","Yahaya_Daniel Tayo.jpg","2023-09-27 08:09:15","","1");
INSERT INTO sch_users VALUES("10","3","2","David","Oluwatobi","SMS2/NPS382A/002","81dc9bdb52d04dc20036dbd8313ed055","Oluwatobi_Daniel Tayo.jpg","2023-09-27 08:09:15","","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO score_info VALUES("1","1","7","1","1","3","1","0","06","07","08","56","77","369","0","1");
INSERT INTO score_info VALUES("2","1","7","1","1","5","1","0","08","08","10","66","92","374","0","1");
INSERT INTO score_info VALUES("3","1","7","1","1","6","1","0","09","09","04","60","82","411","0","1");
INSERT INTO score_info VALUES("4","1","3","1","1","3","1","0","08","06","07","06","27","369","0","1");
INSERT INTO score_info VALUES("5","1","3","1","1","5","1","0","09","09","05","42","65","374","0","1");
INSERT INTO score_info VALUES("6","1","3","1","1","6","1","0","08","08","10","20","46","411","0","1");
INSERT INTO score_info VALUES("7","1","4","1","1","3","1","0","09","07","08","16","40","369","0","1");
INSERT INTO score_info VALUES("8","1","4","1","1","5","1","0","08","07","07","15","37","374","0","1");
INSERT INTO score_info VALUES("9","1","4","1","1","6","1","0","09","10","10","62","91","411","0","1");
INSERT INTO score_info VALUES("10","1","12","1","1","3","1","0","08","10","09","53","80","369","0","1");
INSERT INTO score_info VALUES("11","1","12","1","1","5","1","0","10","07","07","15","39","374","0","1");
INSERT INTO score_info VALUES("12","1","12","1","1","6","1","0","10","05","03","11","29","411","0","1");
INSERT INTO score_info VALUES("13","1","5","1","1","3","1","0","07","03","04","15","29","369","0","1");
INSERT INTO score_info VALUES("14","1","5","1","1","6","1","0","06","02","07","56","71","411","0","1");
INSERT INTO score_info VALUES("15","1","5","1","1","5","1","0","10","08","05","43","66","374","0","1");
INSERT INTO score_info VALUES("16","1","1","1","1","3","1","0","07","08","07","59","81","369","0","1");
INSERT INTO score_info VALUES("17","1","1","1","1","5","1","0","08","08","08","51","75","374","0","1");
INSERT INTO score_info VALUES("18","1","1","1","1","6","1","0","06","09","10","36","61","411","0","1");
INSERT INTO score_info VALUES("19","1","9","1","1","3","1","0","07","07","07","14","35","369","0","1");
INSERT INTO score_info VALUES("20","1","9","1","1","6","1","0","08","07","03","13","31","411","0","1");



CREATE TABLE `session_info` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `session` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `done` int(11) DEFAULT 0,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

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
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `setting_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO settings VALUES("1","1","Show Position","1");



CREATE TABLE `staff_by_subject` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `staff_info` (
  `staff_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `acc_no` varchar(15) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO staff_info VALUES("1","1","2","3","0","0","0","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("2","1","2","3","1","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("3","1","2","3","2","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("4","1","2","3","3","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("5","1","2","3","4","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("6","1","2","3","5","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("7","1","2","3","6","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("8","1","2","3","7","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("9","1","2","3","8","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("10","1","2","3","9","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("11","1","2","3","10","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("12","1","2","3","11","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");
INSERT INTO staff_info VALUES("13","1","2","3","12","1","1","0","0","0000-00-00","0","","0","","","1","0","","","","SNI/2023/001","0","0","");



CREATE TABLE `staff_type_info` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `scom_id` int(11) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO stdnt_info VALUES("1","3","1","1","1","","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("2","4","1","2","1","","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("3","5","1","1","1","","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("4","6","1","1","1","","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("5","7","1","8","1","","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("6","9","2","1","1","","2","","0","0","0","0","","0","","","","","","1","0","0","0","0");
INSERT INTO stdnt_info VALUES("7","10","2","1","1","","1","","0","0","0","0","","0","","","","","","1","0","0","0","0");



CREATE TABLE `stu_assignment` (
  `assgn_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `date_of_subm` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `assign_score` int(11) NOT NULL,
  PRIMARY KEY (`assgn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `student_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_type` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO student_type VALUES("1","Day Student");
INSERT INTO student_type VALUES("2","Boarding Student");



CREATE TABLE `subj_info` (
  `subj_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subj_title` varchar(30) NOT NULL,
  `subj_abr` varchar(10) NOT NULL,
  `subj_type` varchar(10) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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



CREATE TABLE `teachers_com` (
  `com_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `term_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `term_title` enum('First Term','Second Term','Third Term') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO term_info VALUES("1","First Term","1");
INSERT INTO term_info VALUES("2","Second Term","0");
INSERT INTO term_info VALUES("3","Third Term","0");



CREATE TABLE `testimonial` (
  `cert_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cert_passport` varchar(20) NOT NULL,
  `year_of_admn` int(11) NOT NULL,
  `year_of_grad` int(11) NOT NULL,
  `office_held` varchar(20) NOT NULL,
  `award` text NOT NULL,
  `hobbies` varchar(45) NOT NULL,
  `remark` int(11) NOT NULL,
  PRIMARY KEY (`cert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `web_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(41) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO web_admin VALUES("1","onaretayo@gmail.com","908316b9a0f612ff3cdc28129e6cbb4e","onaretayo.jpg","4","1");



CREATE TABLE `year_info` (
  `year_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `year_title` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



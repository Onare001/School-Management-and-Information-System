<?php $page_title = "Testimonial"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> School Management System | <?php echo $page_title;?> </title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<meta name="keyword" content="'.getSchname($sch_id).'">
		<link rel="shortcut icon"  href="assets/img/sms3.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=0.35">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/result_style.min.css">
	</head>
	<style>
body{
	width:auto;
	margin:0px auto;
	margin-left:0;
}
h3 {
  font-size: 24px;
  margin-top: 20px;
  margin-bottom: 10px;
  font-weight: normal;
  line-height: 1;
  color: #777; 
  font-family: inherit;
  font-weight: 500;
  color: inherit;
}
.rcontent {
	page-break-before:always;
	width:1000px;
	color:black;
	margin:0px auto;
	padding:40px;
	//background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Ctext x='0' y='50' font-size='15' fill='%23d3d3d3' font-family='Arial' %3E GOLDSPRING %3C/text%3E%3C/svg%3E");
    //background-repeat: repeat;
	background-color:blue;
	color:white;
	background: url(assets/img/login_bg.jpg); 
	background-size:100% 100% no-repeat;"
}
 @page {
  size: A4 portrait;
  margin: 0;
}
input[type="checkbox"] {
  transform: scale(2);
  margin: 10px;
}
.holder {
	width:80%;
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin:0px auto;
}

.logo, .passpor {
  width: auto;
  padding: 5px;
}

.passport{
	border: 1px solid white;
	padding:10px;
}

.logo img, .passport img {
  display: block;
  max-width: auto;
  height: auto;
}
.subject {
	border: 1px solid white;
	width:90%;
	height:459px;
}

.certificate {
  position: relative;
  text-align: center;
}

.certificate-number {
	font-style:italic;
	position: absolute;
	margin-top: 0%;
	margin-left: 40%;
	transform: translate(-45%, -40%);
	padding: 20px;
	transform: rotate(-15deg);
	//transform-origin: center;
	font-size: 24px;
}
.subjects{
	display: flex;
	flex-direction: row;
	justify-content: center;
}
.water-mark{
	position:absolute;
	right:7;
	width:450px;
	height:450px;
	margin-top:80px;
	margin-left:225px;
	opacity:0.2;
	padding:0px;
	display: list-item;
	list-style-image: url(images/'.getSchlogo($sch_id).');
	list-style-position: inside;
}
.signatures{
	display: flex;
	flex-direction: row;
	justify-content: center;
}
.fa{
	margin-left:70px;
	margin-right:70px;
}
.signature {
	width: 200px;
	height: 20px;
	border-top: 1px solid white;
	//border-radius: 5px;
	padding: 10px;
	font-size: 14px;
	text-align: center;
	margin-top:40px;
}
</style>
<?php
$rowperpage = 20;
$roww = 0;
// Previous Button
if(isset($_POST['but_prev'])){
	$roww = $_POST['row'];
	$roww -= $rowperpage;
	if( $roww < 0 ){
		$roww = 0;
	}
}
// Next Button
if(isset($_POST['but_next'])){
	$roww = $_POST['row'];
	$allcount = $_POST['allcount'];

	$val = $roww + $rowperpage;
	if( $val < $allcount ){
		$roww = $val;
	}
}

$yid = $did = $allcount = "";
if (isset($_GET['yid']) && isset($_GET['did'])) {
	$yid = decrypt($_GET['yid']);//Class
	$did = decrypt($_GET['did']);//Category
	$show_testimonial = "SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id JOIN score_info ON score_info.user_id=sch_users.user_id JOIN testimonial ON testimonial.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.status_id!=3 AND stdnt_info.yid='$yid' AND stdnt_info.cat_id='$did' AND testimonial.remark='1' GROUP BY sch_users.user_id LIMIT $roww," .$rowperpage;
	
	//$show_testimonial = "SELECT * FROM stdnt_info WHERE sch_users.sch_id='$sch_id' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.status_id!=3 AND stdnt_info.yid='$yid' AND stdnt_info.cat_id='$did' GROUP BY sch_users.user_id LIMIT $roww," .$rowperpage;
} else if (isset($_GET['uid']) && isset($_GET['yid'])){
	$uid = decrypt($_GET['uid']);//Category	
	$yid = decrypt($_GET['yid']);//Class
	$show_testimonial = "SELECT * FROM stdnt_info JOIN sch_users ON stdnt_info.user_id=sch_users.user_id JOIN score_info ON score_info.user_id=sch_users.user_id JOIN testimonial ON testimonial.user_id=stdnt_info.user_id WHERE sch_users.sch_id='$sch_id' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.status_id!=3 AND stdnt_info.yid='$yid' AND stdnt_info.user_id='$uid' AND testimonial.remark='1' GROUP BY sch_users.user_id";	
	
	//$show_testimonial = "SELECT * FROM stdnt_info WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.status_id!=3 AND stdnt_info.yid='$yid' AND stdnt_info.user_id='$uid'";
} else {
	header("location: generate_testimonial");
}

//Select From Score_info 
$generate_testimonial = mysqli_query($conn,$show_testimonial);
if(mysqli_num_rows($generate_testimonial) == 0){
	echo '<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<div align="center" style="width:100%; margin:auto; margin-top:50px; margin-bottom:20px; max-width:900px; border:0px solid #CCC;">
		<div class="card card-danger" style="color:; margin:auto; width:auto;">
		<div class="card-header" style="text-align:left;">Information! <i class="fa fa-warning" class="img-responsive" style="float:right;font-size:20px;"></i></div>
			<div align="left" style=" margin:auto; padding:15px;">
				<div style="width:auto; height:auto; padding:15px;">
					<h1 style="color:red;text-align:center">No testimonials found</h1>
					<p><h6>Please ensure the following have been done:</h6></p>
					<p><li>The student(s) - '.getClass(3).' have filled out the necessary information required for processing testimonials on their portal.</li></p>
					<p><li>The student(s) have graduated.</li></p>
					<p><li>The student(s) has cleared all Outstanding Charges.</li></p>
					<p><li>All information provided by the students are correct and have been verified by the examination office.</li></p>
					<center><button onclick="history.back()" class="btn btn-primary">Back</button></center>
				</div>
			</div>
		</div>
	</div>';
} else {
    while ($data = mysqli_fetch_array($generate_testimonial)){
        $uid = $data['user_id']; $yid = $data['yid']; $subj_sno = 0;
	echo '<body>
		<div class="rcontent">
			<div style="width:950px;height:auto;padding:10px;margin-top:10px;margin-bottom:10px;border:10px dotted;">
			<center>
				<h3 style="font-size:30px;font-family:Brush Script;width:600px;">'.strtoupper(getSchName($sch_id)).'</h3>
				<h5 style="font-size:15px;font-family:Brush Script;width:600px;">'.getSchMotto($sch_id).'</h5>
				<h5 style="font-size:15px;font-family:Brush Script;width:600px;">'.getSchAddress($sch_id).'</h5>
				<div class="holder">
					<div class="logo">
						<img src="'.getSchLogo($sch_id).'" style="width:150px;height:150px;"/>
					</div>
					<div class="certificate-number">'.'000'.$data['cert_id'].'</div>
					<div class="passport">
						<img src="'.getPassport($data['user_id']).'" style="width:100px;height:120px;"/>
					</div>	
				</div>';
				echo '<p style="font-size:30px;font-family:Brush Script;background-color:white;color:black;width:250px;">TESTIMONIAL</p>
				<p style="font-size:25px;font-family:Bradley Hand ITC;">This is to certify that</p>
				<p style="font-size:60px;font-family:cursive;"><u>&nbsp;&nbsp;&nbsp;'.getLastName($data['user_id']).'&nbsp;'.getFirstName($data['user_id']).'&nbsp;&nbsp;&nbsp;</u></p>
				<p style="font-size:20px;font-family:cursive;">was a student of 
				<u style="font-size:25px;font-family:cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.getSchName($sch_id).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
				<p style="font-size:20px;font-family:cursive;">from 
				<u style="font-size:25px;font-family:cursive">&nbsp;'.(getYear($yid)-3).'&nbsp;</u> to 
				<u style="font-size:25px;font-family:cursive">&nbsp;'.getYear($yid).'&nbsp;</u> Admission Number 
				<u style="font-size:25px;font-family:cursive">&nbsp;&nbsp;'; echo ($data['admn_no']) ? $data['admn_no'] : '____________';echo '&nbsp;&nbsp;</u> 
				Date of Birth <u>&nbsp;&nbsp;'; echo ($data['dob']) ? $data['dob'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; echo '&nbsp;&nbsp;</u></p>
				<img src="'.getSchlogo($sch_id).'" alt="img" class="water-mark"/>
				<div class="subject">
					<div style="font-size:30px;font-family:Brush Script;background-color:white;color:black;width:100%;">SUBJECTS OFFERED</div>
					<div class="subjects">
						<table width="100%" border="0px">';
							$subject = mysqli_query($conn,"SELECT *, COUNT(subj_id) AS total_subj FROM score_info WHERE user_id='$uid'");
							$row = mysqli_fetch_assoc($subject);
							$total_subj = 20;//$row['total_subj'];
							$a = round($total_subj / 2, 0);

							$subjectA = mysqli_query($conn,"SELECT * FROM subj_info WHERE subj_id BETWEEN 0 AND $a");
							while ($row = mysqli_fetch_array($subjectA)){
							echo '<tr>
								<td align="center">'.'('.arabicToRoman(++$subj_sno).')'.'</td>
								<td>'.getSubject($row['subj_id']).'</td>
								<td align="center"><input type="checkbox" checked/></td>
							</tr>';
							}
						echo '</table>	
						<table width="100%" border="0px">';
							$subjectB = mysqli_query($conn,"SELECT * FROM subj_info WHERE subj_id BETWEEN $a+1 AND $total_subj");
							while ($row = mysqli_fetch_array($subjectB)){
							echo '<tr>
								<td align="center">'.'('.arabicToRoman(++$subj_sno).')'.'</td>
								<td>'.getSubject($row['subj_id']).'</td>
								<td align="center"><input type="checkbox" checked/></td>';
							}
						echo '</tr>
						</table>
					</div>
				</div>
			</center>
				<div style="text-align:left;margin-left:50px;margin-top:35px;margin-bottom:30px;">
					<table class="footer" border="1" width="95%">
						<tr>
							<td width="20%">General Conduct</td>
							<td align="center">'.'SATISFACTORY'.'</td>
						</tr>
						<tr>
							<td>Awards</td>
							<td align="center">'.$data['award'].'</td>
						</tr>
						<tr>
							<td>Offices Held</td>
							<td align="center">'.$data['office_held'].'</td>
						</tr>
						<tr>
							<td>Club & Society</td>
							<td align="center">'.'JETS CLUB'.'</td>
						</tr>
						<tr>
							<td>Hobbies</td>
							<td align="center">'.$data['hobbies'].'</td>
						</tr>
					</table>
					<style>
						footer {
							border: 1px solid black;
							border-collapse: collapse;
							background-color: #f2f2f2;
							font-family: Arial, sans-serif;
							font-size: 14px;
						}
					</style>
				</div>
				<div class="signatures">
					<div class="signature">Student Signature</div>
					<i class="fa fa-certificate" style="font-size:100px;color:red;"></i>
					<div class="signature">Principal Signature</div>
				</div>
			</div>
		</div>
	</body><p/>';
	} 
} ?>
</html>
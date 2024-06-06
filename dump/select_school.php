<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$selected_database = $_POST['database'];
	
	$_SESSION['selected_database'] = $selected_database;
	
	header('location: user_login');
}
?>
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
	<link rel="stylesheet" href="styles.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link href='https://fonts.googleapis.com/css?family=Prompt' rel='stylesheet'>
</head>
<body>
	<div class="card">
		<div class="logo">
			<img src="assets/img/<?php echo 'sms3.png';?>" width="100px" height="100px" class="img-circle"/>
		</div>	
		<div class="school-name" align="center">
			<h2 style="font-family:Imprint MT Shadow; color:darkblue;margin:0px auto;"><?php //echo strtoupper(getSchName(1));?><br/></h2>
		</div>
		<hr>
			<h3 align="center" style="color:red;">School Management System</h3>
		<hr>
		<h4 align="center">Select School Section</h4>
		<div align="center" style="width:100%;">
			<form method="post">
				<select name="database" class="form-control">      
					<option value="">---Select School Section--</option>
					<option value="goldspring_sms_junior">---Nusery & Primary School--</option>
					<option value="goldspring_school">---Junior Secondary School--</option>
					<option value="superschool_sms">---Senior Secondary School--</option>
				</select>
				<input type="submit" value="Continue" class="btn btn-primary">
			</form>
		</div>
		<div class="footer">
			Copyright © 2023 SMS. Powered by Niel Technologies +2348145162722. All Rights Reserved.
		</div>
	</div>
</body>  
</html>
<style>
html{
    zoom:80%;
}
body{
  background: darkblue;
  margin:0;
  padding:10px;
  font-family:'Prompt', sans-serif;
}
hr{
  border-color:blue;
  border-width:2px;
  border-style:solid none none;
  width:100%;
}
.logo{
  display:flex;
  justify-content:center;
}
.school-name{
	display:flex;
	justify-content:center;
}
.card{
  background:white;
  padding:30px;
  margin:30px auto;
  border-radius: 10px;
  box-shadow: 0px 16px 31px rgba(0, 0, 0, 0.20);
  font-size:14pt;
  width:70%;
}
.card a{
	text-decoration: none;
	color:inherit;
}
.levels{
    display:flex;
    align-items: stretch;
    text-align: center;
}
.levels div{
    flex:1;
}
.primary{
	color: green;
}
.junior{
	color: blue;
}
.senior{
	color: yellow;
}
.primary:hover, .junior:hover, .senior:hover{
    transform: scale(1.2);
	color: red;
}
.footer{
  text-align:center;
  color:black;
}

@media screen and (max-width:700px) {
  .levels {
    display:grid;
    justify-content:space-around;
    text-align: center;
}}
</style>
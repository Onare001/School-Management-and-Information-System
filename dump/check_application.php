<?php $page_title = "Check Application"; ?>
<?php include ('include/authenticate.php');?>
<?php include ('functions/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<title>School Management System | <?php echo $page_title;?></title>
		<meta name="keywords" content="School Management System"/>
		<meta name="description" content="Niel Technologies">
		<meta name="author" content="Daniel Tayo Onare">
		<link rel="shortcut icon"  href="assets/sms3.png">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<link rel="stylesheet" href="https://eportal.futminna.edu.ng/adms/login_files/A.bootstrap-1.css+jquery-ui.css+waeup-base.css,Mcc.BU1ctrwSz6.css.pagespeed.cf.pACb4qUQQH.css">
		<style type="text/css">.ta10{background-image:url(images/form_bg.jpg);background-repeat:repeat-x;border:1px solid #d1c7ac;width:700px;height:300px;color:#333;padding:3px;margin-right:4px;margin-bottom:8px;font-family:tahoma,arial,sans-serif}.Main{margin:0 auto;width:1011px;height:2000px;padding-top:-50px;background-color:#fff;margin-top:-21px;position:inherit;z-index:2}.style2{font-size:12px}.style7{color:red}.style9{font-size:14px;font-weight:bold;font-style:italic}.style11{font-style:italic}#jamb{text-shadow:#9f3;color:red}</style>
	</head>
	<body>
		<div class="topbar" data-scrollspy="scrollspy">
			<div class="topbar-inner">
				<div class="topBG"></div>
					<div class="container">
					<a class="brand" href="index"><span class="style2"></span> SMS </a>
					<ul class="nav">
						<li class="">

						</li>

						<li class="">

						</li>
					</ul>
					<ul class="nav secondary-nav">

					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="content"><br/>
				<h1 align="center">Check Application Status - 2022/2023<br/>---<br/></h1>
				<div>
					<form action="" method="POST" name="schoiceform" id="form" onsubmit="return validate(this); "> 
						<table border="4" id="login" class="form-table">
							<tbody>
								<tr>
									<td width="207" rowspan="5" align="center" valign="middle" class="fieldname">
										<div align="center">
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											<p><img src="images/<?php echo getSchLogo(1);?>" width="108" height="107"/></p>
										</div>
									</td>
									<td colspan="2" class="fieldname">
										<!--<p><strong>UPDATE</strong>:<br />
										Download University Admission Letter with Student ID for acceptance payment and other registrations. <br />
										Only candidates that have accepted from JAMB Website!<br />
										</p>-->
										<h4>           
											1.  Fill in  the form below<br/>
											2.  Click on submit<br/>
										</h4>
										<hr/>
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center" class="fieldname">
										<div align="center"><span class="fieldname style7"></span></div>
									</td>
								</tr>
								<tr>
									<td width="327" class="fieldname">Type Your Application Number:</td>
									<td width="280"><input name="regno" type="text" class="resizedTextbox" id="regno" size="22" maxlength="20"/></td>
								</tr>
								<tr>
									<td class="fieldname"> Type One of Your Names:</td>
									<td><input name="name" type="password" class="resizedTextbox" id="name" size="22" maxlength="30"/></td>
								</tr>
								<tr>
									<td><input class="btn primary" name="submit" value="Check" type="submit"/></td>
								</tr>
								<tr>
									<td align="center" valign="middle" class="fieldname">&nbsp;</td>
									<td colspan="2" class="fieldname style7">&nbsp;</td>
								</tr>
							</tbody>
						</table>
						<table width="200" border="1">
							<tr>
								<td>
									<span id="jamb">Note: THIS PROVISIONAL ADMISSION IS SUBJECT TO YOUR ACCEPTANCE OF JAMB ADMISSION AND PRINTING OUT OF ADMISSION LETTER FROM JAMB WEBSITE</span><br/>
									<span id="jamb">Application >> Approval(accepted/reject) >> Shortlist for Exam >> Admitted</span>
								</td>
							</tr>
						</table>
						<span class="style11"><input name="camefrom" type="hidden"></span>
						<hr/>
						<span class="style9">Powered Niel Technologies</span><br/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
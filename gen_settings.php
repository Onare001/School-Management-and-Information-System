<?php $page_title = "School Settings"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php include ("include/settings.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

		<link rel="stylesheet" href="assets/css/tab_style.css">
<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>
   
			<div class="row" style="width:auto;margin:0px auto;">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title"><i class="fa fa-school"></i> <i class="fa fa-cog"></i> School Settings<?php if (isset($msg)) { echo $msg_toastr;}?></h5>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<div class="btn-group">
									<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"><i class="fas fa-wrench"></i></button>
									<div class="dropdown-menu dropdown-menu-right" role="menu">
										<a href="#" class="dropdown-item">Action</a>
										<a href="#" class="dropdown-item">Another action</a>
										<a href="#" class="dropdown-item">Something else here</a>
										<a class="dropdown-divider"></a>
										<a href="#" class="dropdown-item">Separated link</a>
									</div>
								</div>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<ul class="accordion-tabs-minimal">
									<li class="tab-header-and-content">
										<a href="#sch_logo" class="tab-link is-active">School Logo</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary" id="selectbox">
													<div class="card-header with-border"><h3 class="card-title">Upload School Logo</h3></div>
													<form role="form" action="" method="post" enctype="multipart/form-data">
														<div class="card-body">
															<div align="center" style="margin:auto;" class="alert alert-danger">Image should not be more than 200KB & the file extension must be JPG, JPEG or PNG</div>
															<div align="center" style="background:white;">
																<img src="<?php echo getSchLogo($sch_id);?>" alt="Sch logo" style="padding:20px;max-width:150px;" class="img-circle" />
															</div>
															<div class="form-group">
																<label>Select file</label>
																<input type="file" name="file_name" accept="image/*" class="form-control" >
															</div>
														</div>
														<div class="modal-footer">
															<button name="submit1" type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>      
														</div>
													</form>
												</div>
											</p>
										</div>
									</li>
									<!--tab 2-->
									<li class="tab-header-and-content">
										<a href="#class_setup" class="tab-link"> Class Setup </a>
										<div class="tab-content">
											<p>
												<div class="card card-primary" id="selectbox">
													<div class="card-header with-border"><h3 class="card-title">Class Setup</h3></div>
													<div style="padding:20px;">
														<form action="" method="post">
															<table align="center"border="0" cellspacing="0" cellpadding="0"  style="width:100%;">
																<tr>
																	<td>
																		<div class="form-group">
																			<input name="class" type="text" placeholder="<?php echo $sch_type;?>"class="form-control" required disabled/>
																		</div>
																	</td>
																</tr>							 
															</table>
															<div class="modal-footer">
																<input name="submit2" type="submit" value="Add" class="btn btn-primary" disabled/>         
															</div>
														</form> 
														<table class="table" style="background:#fff;color:black;" border="1" style="width:100%;">
															<thead>
																<th width="5px"><input type="checkbox" class="checkbox" name="checkbox[]"/></th>
																<th align="center" width="5px"><b>S/N</b></th>
																<th align="center"><b>Class</b></th>
															</thead>
															<tbody>
																<?php
																$counter = "0";
																$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																while ($row = mysqli_fetch_array($result)){	?>
																<tr>
																	<td><input type="checkbox" class="checkbox" name="checkbox[]" checked/></td>
																	<td align="center"><?php echo ++$counter;?></td>
																	<td><?php echo $row["class_name"];?></td>
																</tr>
<?php } ?>
															</tbody>
														</table>
													</div>
												</div>  
											</p>    
										</div>
									</li>
									<!--tab 3-->
									<li class="tab-header-and-content">
										<a href="#class_category" class="tab-link">Class Category</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary">
												<div class="card-header with-border"><h3 class="card-title">Class Category</h3></div>
													<div style="padding:20px;"> 
														<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
															<form action="" method="post">
																<tr style="background:#FFF;">
																	<td>
																		<input name="category" type="text" placeholder="Type Category here... E.g. A,B,C.. Science, Art.."class="form-control" required/>
																	</td>
																	<td>
																		<select name="dept_id" id="dept_id" class="form-control">
																		<?php if (empty($row['class_dept'])){
																			echo '<option value="">Select Department</option>';
																		} else {
																			echo '<option value="'.$row['class_dept'].'">'.$row['class_dept'].'</option>';
																		} 
																			echo '<option value="">'.'Department'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM department");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["dept_id"].'">'.$row["department"].'</option>'; } ?><br/>
																		</select>
																	</td>
																	<td align="left" width="60">
																		<input name="submit3" type="submit" value="Add" class="btn btn-primary" />
																	</td>
																</tr>
															</form>  
														</table>           
														<table class="table table-striped" border="0">
															<thead align="center">
																<th class="pad"><b>S/N</b></th>
																<th class="pad"><b>Category</b></th>
																<th class="pad"><b>Department</b></th>
																<th class="pad"><b>Edit</b></th>
															</thead>
															<tbody>
															<?php
															$counter = "0";
															$fetch_dept = mysqli_query($conn,"SELECT * FROM department");
															$result = mysqli_query($conn,"SELECT * FROM class_cat");
																while ($row = mysqli_fetch_assoc($result)){ 
																$modal_id = "classcat".$row["cat_id"];
															?>
																<tr align="center"> 
																	<td class="pad"><?php echo ++$counter;?></td>
																	<td class="pad"><?php echo $row["category"];?></td>
																	<td class="pad"><?php echo getDept($row["class_dept"]);?></td>									
																	<td class="pad"><button type="submit" class="btn" data-toggle="modal" data-target="#<?php echo $modal_id; ?>"><img src="assets/img/edit.png" width="16" height="16" alt="img"></button></td>
																</tr>
																<!-- Edit Subject -->
																	<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><i class="fa fa-edit"></i> Edit | Class Category</h5>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<form action="" method="post" autocomplete="off">
																						<p><input name="category" type="text" value="<?php echo $row['category'];?>" placeholder="Class Category"class="form-control" required/></p>
																						<input type="hidden" name="cat_id" value="<?php echo $row['cat_id'];?>"/>
																						<p><select name="dept_id" id="dept_id" class="form-control">
																						<option value="1">Art</option>
																						<option value="2">Business</option>
																						<option value="3">Science</option>
																						<?php /* if (empty($row['class_dept'])){
																							echo '<option value="">Select Department</option>';
																						} else {
																							echo '<option value="'.$row['class_dept'].'">'.getDept($row['class_dept']).'</option>';
																						} 
																							echo '<option value="">'.'Department'.'</option>';
																							while ($row = mysqli_fetch_array($fetch_dept)){
																							echo '<option value="'.$row["dept_id"].'">'.$row["department"].'</option>'; } */ ?><br/>
																						</select></p>
																						<div class="modal-footer">
																							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																							<input type="submit" name="editCat"  value="Save changes" class="btn btn-primary"/>
																						</div>
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>
<?php } ?>	
															</tbody>
														</table>
													</div>
												</div>
											</p>
										</div>
									</li>
									<!-- tab 3 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link">Subject Setup</a>
										<div class="tab-content">
											<p>
											<div class="card card-primary">
												<div class="card-header with-border"><h3 class="card-title">Subject Setup</h3></div>
												<div style="padding:20px;">
													<form action="" method="post"> 
														<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
															<tr>
																<td><input name="subject" type="text" placeholder="Type Subject here... E.g Mathematics"class="form-control" required/></td>
																<td><input name="abbreviation" type="text" placeholder="Type Subject Abbreviation here... E.g Maths for mathematics..."class="form-control" required/></td>
																<td>
																	<select name="subj_type" class="form-control">
																		<option value="">Select Subject Type</option>
																		<option value="Core">Core</option>
																		<option value="Elective">Elective</option>
																	</select>
																</td>
																<td align="left" width="60"><input name="submit4" type="submit" value="Add" class="btn btn-primary" /></td>
															</tr>
														</table>  
													</form>
													<table id="example1" class="table table-striped" >
														<thead>
															<th class="pad"><b>S/N</b></th>
															<th class="pad"><b>Subject</b></th>
															<th class="pad"><b>Subject Abbreviation</b></th>
															<th class="pad"><b>Subject Type</b></th>
															<th class="pad"><b>On/Off</b></th>
															<th class="pad"><b>Edit</b></th>
														</thead>
														<tbody>
															<?php
															$counter = "0";
															$result = mysqli_query($conn,"SELECT * FROM subj_info ORDER BY `subj_info`.`subj_title`");
															while ($row = mysqli_fetch_array($result)){ $modal_id = "subject".$row["subj_id"];
															?>
															<tr> 
																<td class="pad"><?php echo ++$counter;?></td>
																<td class="pad"><?php echo $row["subj_title"];?></td>
																<td class="pad"><?php echo $row["subj_abr"];?></td>
																<td class="pad"><?php echo $row["subj_type"];?></td>
																<td align="center" width="5px">
																	<div class="custom-control custom-switch">
																		<input type="checkbox" class="custom-control-input" id="customSwitch<?php //echo $row['subj_id']; ?>" <?php //echo ($row['status'] == '1') ? 'checked' : ''; ?> data-sbid="<?php //echo $row['subj_id'] ?>" data-state="<?php //echo ($row['status'] == '1') ? '1' : '0'; ?>" data-table="subj_info">
																		<label class="custom-control-label" for="customSwitch<?php echo $row['subj_id']; ?>"></label>
																	</div>
																</td>
																<td class="pad"><button type="submit" class="btn" data-toggle="modal" data-target="#<?php echo $modal_id; ?>"><img src="assets/img/edit.png" width="16" height="16" alt="img"></button></td>
															</tr>
															<!-- Edit Subject -->
															<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="<?php echo $modal_id; ?>Label"><i class="fa fa-edit"></i> Edit | Subject</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">
																			<form action="" method="post" autocomplete="off">
																				<p><input name="subject" type="text" value="<?php echo $row['subj_title'];?>" placeholder="Type Subject here..." class="form-control" required/></p>
																				<p><input name="abbreviation" type="text" value="<?php echo $row['subj_abr'];?>" placeholder="Type Subject Abbreviation here... E.g Maths for mathematics..."class="form-control" required/></p>
																				<input type="hidden" name="subj_id" value="<?php echo $row['subj_id'];?>"/>
																				<p><select name="subject_type" class="form-control">
																				<?php if (empty($row['subj_type'])){
																					echo '<option value="">Select Subject Type</option>';
																				} else {
																					echo '<option value="'.$row['subj_type'].'">'.$row['subj_type'].'</option>';
																				} ?>
																					<option value="Core">Core</option>
																					<option value="Elective">Elective</option>
																				</select></p>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																					<input type="submit"name="submitA"  value="Save changes" class="btn btn-primary"/>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</div>														
<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											</p> 	
										</div>
									</li>
									<!-- tab 3 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link">Clubs & Societies/ Houses</a>
										<div class="tab-content">
											<p>
											<div class="card card-primary">
												<div class="card-header with-border"><h3 class="card-title"><i class="fa fa-home"></i> House Setup</h3></div>
												<div style="padding:20px;">
													<form action="" method="post"> 
														<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
															<tr>
																<td>
																	<input name="house_name" type="text" placeholder="House Name" class="form-control" required/>
																</td>
																<td>
																	<input name="house_color" type="color" class="form-control" required/>
																</td>
																<td align="left" width="60">
																	<input name="submit14" type="submit" value="Add" class="btn btn-primary"/> 
																</td>
															</tr>
														</table>
													</form>
													<table class="table table-striped table-bordered">
														<thead>
															<th class="pad"><b>S/N</b></th>
															<th class="pad"><b>House Name</b></th>
															<th class="pad"><b>Color</b></th>
															<th class="pad" align="left"><b>Edit</b></th>
														</thead>
														<?php
														$counter = "0";
														$result = mysqli_query($conn,"SELECT * FROM house_info WHERE sch_id='$sch_id' ORDER BY `house_info`.`house`");
														while ($row = mysqli_fetch_array($result)){
														?>
														<tbody>
															<tr> 
																<td><?php echo ++$counter;?></td>
																<td><?php echo $row["house"];?></td>
																<td width="5px"><div style="background-color:<?php echo $row["house_color"];?>;width:100px;">&nbsp;</div></td>
																<td class="pad" align="right"><a title="Edit" href="#"><img src="assets/img/edit.png" width="16" height="16" alt="edit"></a></td>
															</tr>
														</tbody>
														<?php } ?> 	
													</table>
												</div>
											</div>  
											<p>
											<div class="card card-success">
												<div class="card-header with-border"><h3 class="card-title"><i class="fa fa-users"></i> Clubs & Societies Setup</h3></div>
												<div style="padding:20px;">
													<form action="" method="post"> 
														<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
															<tr>
																<td><input name="club_name" type="text" placeholder="Type name of Club & Society" class="form-control" required/></td>
																<td><input name="club_abbr" type="text" placeholder="Type Club Abbreviation" class="form-control" required/></td> 
																<td><select name="teacher" class="form-control"><?php
																		echo '<option value="">'.'Assign a Teacher to monitor Club Activities'.'</option>';
																		$result = mysqli_query($conn,"SELECT * FROM staff_info JOIN sch_users ON staff_info.user_id=sch_users.user_id WHERE sch_users.priv_id='2' AND sch_user.sch_id='$sch_id' GROUP BY sch_users.user_id");
																		while ($row = mysqli_fetch_array($result)){
																	echo '<option value="'.$row["user_id"].'">'.getLastname($row["user_id"]).'&nbsp'.getFirstname($row["user_id"]).'</option>'; } ?><br/>
																	</select>
																</td>
																<td align="left" width="60"><input name="submit15" type="submit" value="Add" class="btn btn-primary" /></td>
															</tr>
														</table>
													</form>
													<table class="table table-striped">
														<thead>
															<th class="pad"><b>S/N</b></th>
															<th class="pad"><b>Clubs & Societies</b></th>
															<th class="pad"><b>Club Abbr</b></th>
															<th class="pad"><b>Staff in Charge</b></th>
															<th class="pad"><b>Edit</b></th>
														</thead>
														<tbody>
														<?php
														$counter = "0";
														$result = mysqli_query($conn,"SELECT * FROM club_info WHERE sch_id='$sch_id' ORDER BY `club_info`.`club_name`");
														while ($row = mysqli_fetch_array($result)){
														?>
															<tr>
																<td class="pad"><?php echo ++$counter;?></td>
																<td class="pad"><?php echo $row["club_name"];?></td>
																<td class="pad"><?php echo $row["club_abbr"];?></td>
																<td class="pad"><?php echo getLastname($row["staff_in_charge"]).'&nbsp;'.getFirstname($row["staff_in_charge"]);?></td>
																<td class="pad"><a title="Edit" href="#"><img src="assets/img/edit.png" width="16" height="16" alt="img"></a></td>
															</tr>
														</tbody>
													<?php } ?> 	
													</table>
												</div>
											</div>
											</p>   
										</div>
									</li>
									<!-- tab 4 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link"> Publish Result</a>
											<div class="tab-content">
												<p>
													<div class="card card-primary" id="selectbox">
													<div class="card-header with-border"><h3 class="card-title">Result Publication </h3></div>
														<div class="card-body">
															<form action="" method="post">
																<table align="center" border="0"  cellspacing="0" cellpadding="0" style="width:100%;">
																	<tr>
																		<td>
																			<div class="form-group">
																				<label>Class</label>
																				<select name="class_id" id="sel_class" class="form-control">
																					<?php
																					echo '<option value="">'.'Select Class'.'</option>';
																					$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row['class_id'].'">'.getClass($row['class_id']).'</option>';
																					} ?>
																				</select>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="form-group">
																				<label>Term</label>								
																				<select name="term_id" class="form-control">
																					<?php
																					echo '<option value="">'.'Select Term'.'</option>';
																					$result = mysqli_query($conn,"SELECT * FROM term_info");
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
																					} ?>
																				</select>
																			</div>  
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="form-group">
																				<label>Session</label>
																				<select name="session_id" class="form-control">
																					<?php
																					echo '<option value="">'.'Select Session'.'</option>';
																					$result = mysqli_query($conn,"SELECT * FROM session_info WHERE done='1'");
																					while ($row = mysqli_fetch_array($result)){
																					echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
																					} ?>
																				</select>
																			</div>  
																		</td>  
																	</tr>
																</table>
																<div class="modal-footer">
																	<input name="submit6" type="submit" value="Unpublish" class="btn btn-danger"/>
																	<input name="submit5" type="submit" value="Publish" class="btn btn-success"/>         
																</div>
															</form>
														</div>
													</div>
												</p>    
											</div>
									</li>
									<!--- tab 5 -->
									<li class="tab-header-and-content">
									<a href="#" class="tab-link"> Mass Promotion</a>
									<div class="tab-content">
									<p>
									<div class="card card-primary" id="selectbox">
										<div class="card-header with-border"><h3 class="card-title">Student Promotion</h3></div>
										<div class="card-body">
											<form action="" method="post">
												<table border="0" align="center" border="0" class="table" style="width:100%;">
													<tr>
														<td>
															<div class="col-md-12">
																<select name="promote" class="form-control">
																	<option value="">Select</option>
																	<option value="promote">Promote Classes</option>
																	<option value="demote">Demote Classes</option>
																</select>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="col-md-12">      
																<select name="year_id" class="form-control">
																	<?php
																	echo '<option value="">'.'Select Year of Graduation for the Final Year Students'.'</option>';
																	$result = mysqli_query($conn,"SELECT * FROM year_info WHERE year_title < '$yearlim' OR year_title = '$yearlim'");
																	while ($row = mysqli_fetch_array($result)){
																	echo '<option value="'.$row["year_id"].'">'.$row["year_title"].'</option>';
																	} ?>
																</select>
															</div>  
														</td>  
													</tr>
												</table>
												<div class="modal-footer">
													<input name="submit7" type="submit" value="Promote" class="btn btn-success"/>  
												</div>
											</form> 
										</div>
									</div>
									</p>    
									</div>
									</li>
									<!-- tab 6 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link"> Result Settings</a>
										<div class="tab-content">
											<p>
											<div class="card card-primary" id="selectbox">
												<div class="card-header with-border"><h3 class="card-title">Result Settings</h3></div>
												<div class="card-body">
													<form action="" method="post">
														<table border="0" align="center" border="0" class="table" style="width:100%;">
															<tr>
																<td>
																	<div class="col-md-12"><b>Show Position on Result ?</b></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">  
																		<input name="set_pstn" type="radio" value="1" <?php echo $onposition;?>> Show Position on Result (yes) 
																		<p><input name="set_pstn" type="radio" value="0" <?php echo $offposition;?>> Do not Show Position on Result (no) 
																	</div>  
																</td>
															</tr>
														</table>
														<div class="modal-footer">
															<input name="submit29" type="submit" value="Save Settiing" class="btn btn-success">       
														</div>
													</form>
												</div>
											</div>
											</p>    
										</div>
									</li>
									<!-- tab 7 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link"> Resumption Date</a>
										<div class="tab-content">
											<p>
											<div class="card card-primary" id="selectbox">
												<div class="card-header with-border"><h3 class="card-title">Resumption Date</h3></div>
													<div class="card-body">
													<form action="" method="post">
														<table border="0" align="center" border="0" class="table" style="width:100%;">
															<tr>
																<td>
																	<div class="col-md-12">Resumption Date for Next Term 
																		<input name="next_date" type="date" placeholder="YYYY/MM/DD" class="form-control" required/>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">Number of Days School Opened this Term 
																		<input name="numopen" type="text" placeholder="Number of Days School Opened this Term" class="form-control" required/>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">    
																		<select name="term_id" class="form-control">
																			<?php
																			echo '<option value="">'.'Select Current Term'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM term_info WHERE status = '1'");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["term_id"].'">'.$row["term_title"].'</option>';
																			} ?>
																		</select>
																	</div>  
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">      
																		<select name="session_id" class="form-control">
																			<?php
																			echo '<option value="">'.'Select Current Session'.'</option>';
																			$result = mysqli_query($conn,"SELECT * FROM session_info WHERE status = '1'");
																			while ($row = mysqli_fetch_array($result)){
																			echo '<option value="'.$row["sid"].'">'.getSession($row["sid"]).'</option>';
																			} ?>
																		</select>
																	</div>  
																</td>  
															</tr>
														</table>
														<div class="modal-footer">
															<input name="submit8" type="submit" value="Save Date" class="btn btn-success"/>      
														</div>
													</form> 
													<table align="center" border="0" cellspacing="0" cellpadding="0" class="table" style="width:100%;">
														<thead>
															<th>Session</th>
															<th>Term</th>
															<th>Resumption Date</th>
														</thead>
														<tbody>
														<?php 
														$result = mysqli_query($conn,"SELECT * FROM resumption_date WHERE sid='$csid'");
														while ($row = mysqli_fetch_array($result)){ ?>
														
															<tr style="background:#FFF;color:black">
																<td><?php echo getSession($row["sid"]);?></td>
																<td><?php echo getTerm($row["term_id"]);?></td>
																<td><?php echo date("D, jS F Y", strtotime($row["next_date"]));?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											</p>    
										</div>
									</li>
									<!-- tab 8 -->
									<li class="tab-header-and-content">
									<a href="#" class="tab-link">Reset User</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary" id="selectbox">
													<div class="card-header with-border"><h3 class="card-title">Reset User Password</h3></div>
													<div class="card-body">
														<form action="" method="post">
															<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
																<tr>
																	<td>
																		<div class="col-md-12">
																			<input name="username" type="text" placeholder="Enter Email for Staff or Student ID for Student"  class="form-control"/>
																		</div>
																	</td>
																</tr>
															</tr>
															</table>
															<div class="modal-footer">
																<input name="submit18" type="submit" value="Reset" class="btn btn-success"/>  
															</div>
														</form>
													</div>
												</div>
											</p>    
										</div>
									</li>
									<!-- tab 9 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link"> Change Password </a>
										<div class="tab-content">
											<p> 
											<div class="card card-primary" id="selectbox">
												<div class="card-header with-border"><h3 class="card-title">Change Password</h3></div>
												<div class="card-body">
													<form action="" method="post">
														<table border="0" width="100%">
															<input name="username" type="hidden" value="<?php echo getUsername($user_id)?>" />
															<tr>
																<td> 
																	<div class="col-md-12">Old Password <sup style="color:red">*</sup><br/>
																		<input name="old" type="password" placeholder="Old Password" class="form-control" required/>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">New Password <sup style="color:red">*</sup><br/>
																		<input name="new" type="password" placeholder="New Password" class="form-control" required/>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="col-md-12">Confirm Password <sup style="color:red">*</sup><br/>
																		<input name="confirm" type="password" placeholder="Confirm Password" class="form-control" required/>
																	</div>
																</td>
															</tr>
														</table>	
													</form>
													<div class="modal-footer">
														<input name="submit9" type="submit" value="Reset" class="btn btn-primary"/>       
													</div>
												</div>
											</div>
											</p>    
										</div>
									</li>  
									<!-- tab 10 -->
									<li class="tab-header-and-content">
										<a href="#" class="tab-link"> Backup</a>
										<div class="tab-content">
											<p>
												<div class="card card-primary">
													<div class="card-header with-border"><h3 class="card-title">Backup School Record</h3></div>
													<div class="card-body">
														<a href="db_backup.php"><div align="center" style="margin:auto; width:100%;" class="btn btn-danger">Click here to Backup School Record</div> </a><br/>
														<p align="center">
															<?php
															// List the files
$counter = 0;
$backupDir = "./backup/" . str_replace(' ', '_', strtolower(getSchName($sch_id)));
$dir = opendir($backupDir);

while (false !== ($file = readdir($dir))) {
    // Print the filenames that have .sql extension
    if (strpos($file, '.sql', 1)) {
        // Get the last modification time of the file
        $filePath = $backupDir . '/' . $file;
        $modificationTime = filemtime($filePath);

        // Convert the timestamp to a human-readable date and time
        $formattedDateTime = date("D, jS F Y g:i:s A", $modificationTime);

        // Remove the .sql extension part in the filename
        $filenameWithoutExtension = str_replace('.sql', '', $file);

        // Print the cells with the date and time
															?>
															
															<form method="post" enctype="multipart/form-data">
																<table border="1" width="100%">	
																	<thead>
																		<tr align="center">
																			<th width="5px">#SN</th>
																			<th width="45%">File Name</th>
																			<th>Date/Time Created</th>
																			<th>Upload</th>
																			<th>Download</th>
																			<th>Delete</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr align="center">
																			<input type="hidden" name="file" value="<?php echo 'backup/'.str_replace(' ', '_', strtolower(getSchName($sch_id))).'/'.$filenameWithoutExtension. '.sql';?>"/>
																			<input type="hidden" name="date_created" value="<?php echo ("&nbsp;" . date("D, jS F Y", $time) . "".' &nbsp; ' . "");?><?php echo date(' h:i:s A', $time);	?>"/>
																			<td><?php echo ("" . ++$counter . "");?></td>
																			<td><?php echo '&nbsp;'.$filenameWithoutExtension;?></td>
																			<td><?php echo $formattedDateTime;	?></td>
																			<td align="center"><?php echo ("<button type='submit' class='btn-primary' name='send_backup'><i class='fa fa-upload'></i></button>");?></td>
																			<td align="center"><?php echo ("<a href='backup/" .str_replace(' ', '_', strtolower(getSchName($sch_id))).'/'. $filenameWithoutExtension . ".sql'> <i class='fa fa-download'></i></a>" . " &nbsp; ");?></td>
																			<td><a title="Delete" onclick="return confirm('Are you sure you want to delete this File?');" href="?file=<?php echo $filenameWithoutExtension .'.sql';?>"><i class="fa fa-trash"></i></a></td>
																		</tr>
																	</tbody>
																</table>
															</form>
														</p>
														<p><?php } } ?>	</p>
													</div>
												</div>
											</p>    
										</div>
									</li>  
								</ul>
								<script src="assets/js/jquery.min.js"></script>
								<script src="assets/js/index.js"></script>
								<script type="text/javascript" src="include/jquery/jquery-1.3.2.js"></script>
								<script type="text/javascript">	 
									$(document).ready( function(){
										$('.tablerow:even').addClass('alt1');
										$('.tablerow:odd').addClass('alt2');
										}
									);	 	
									// target function
									$( function(){
									$("#target .tablerow").hover(
									function(){$(this).toggleClass("highlight");},
									function(){$(this).toggleClass("highlight");}	
										);
									});
								</script>
								<style type="text/css" >
									.tablerow {
										background-color:#FFF;
									}
									.alt1 {
										 background-color:#FFF;
									 }
									.alt2 {
										 background-color: #f1f1f1;
									 }	 
									.highlight{
										border: 0px solid  #428bca;
										color:;	
									}	 
								</style>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
<?php
//Permissions
if ($priviledge == 1){
	$disabled1 = ''; $disabled2 = ''; $disabled3 = ''; $disabled4 = '';
	$personal = 'disabled';
	//Fetch Out Profile information
	$stdnt_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid'");
	$sinfo = mysqli_fetch_array($stdnt_info);
} else if ($priviledge == 3 || $priviledge == 10){
	$disabled1 = 'disabled'; $disabled2 = 'disabled'; $disabled3 = 'disabled'; $disabled4 = 'disabled';
	$personal = '';
	//Fetch Out Profile information
	$stdnt_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$user_id'");
	$sinfo = mysqli_fetch_array($stdnt_info);
} else if ($priviledge == 5){
	$disabled1 = ''; $disabled2 = ''; $disabled3 = 'disabled'; $disabled4 = 'disabled';
	$personal = '';
	$stdnt_info = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id=stdnt_info.user_id WHERE sch_users.user_id='$uid'");
	$sinfo = mysqli_fetch_array($stdnt_info);
} else {
	$disabled = '';
}
?>
					
					<form action="" method="post" id="form">
						<fieldset>
							<legend><i class="fa fa-user"></i>&nbsp;Basic Information</legend>
							<table align="center" border="0" class="table table-striped" style="width:100%;">
								<tr>
									<td>
										<label>First Name</label>
										<input name="first_name" type="text" placeholder="First Name" value="<?php echo getFirstname($uid);
										?>" class="form-control" <?php echo $disabled1;?> />
									</td>
									<td>
										<label>Last Name</label>
										<input name="last_name" type="text" placeholder="Last Name" value="<?php echo getLastname($uid);
										?>" class="form-control" <?php echo $disabled2;?> /> 
									</td>
									<td>
										<label>Username</label>
										<input name="email" type="text" placeholder="Username" value="<?php echo getUsername($uid);?>" class="form-control" <?php echo $disabled3;?> /> 
									</td>
								</tr>
							</table>
							<table align="center" border="0" class="table table-striped" style="width:100%;">
								<tr>
									<td>
										<label>Gender</label>
										<select name="sex_id" class="form-control">
											<option value="<?php echo $sex_id ;?>"><?php if (empty($sex_id)){echo 'Select Gender';} else {echo getGender($sex_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM gender_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["sex_id"];?>"><?php echo $row["gender"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>Date of Birth</label>
										<input name="dob" type="date" placeholder="DD/MM/YYYY" value="<?php echo $dob; ?>" class="form-control"/>
									</td>
									<td>
										<label>Religion</label>
										<select name="rel_id" style="width:100%;" class="form-control">
											<option value="<?php echo $rel_id; ?>"><?php if (empty($rel_id)){echo 'Select Religion';} else {echo getReligion($rel_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM religion_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["rel_id"];?>"><?php echo $row["religion"];?></option><?php } ?><br/>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Genotype</label>
										<select name="gtype" class="form-control">
											<option value="<?php echo $geno_id;?>"><?php if (empty($geno_id)){echo 'Select Genotype';} else {echo getGenotype($geno_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM genotype_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["geno_id"];?>"><?php echo $row["gtype"];?></option><?php } ?><br/>
										</select> 
									</td>
									<td>
										<label>Blood Group</label>
										<select name="bld_grp" class="form-control">
											<option value="<?php echo $bld_id;?>"><?php if (empty($bld_id)){echo 'Select Blood Group';} else {echo getBloodgroup($bld_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM blood_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["bld_id"];?>"><?php echo $row["group"];?></option><?php } ?><br/>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>State of Origin</label>
										<select class="form-control select2bs4" name="state_id" id="state-dropdown" style="width:100%;">
											<option value="<?php echo $state_id;?>"><?php echo getState($state_id); ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM state_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["state_id"];?>"><?php echo $row["state_name"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>Local Government Area</label>
										<select class="form-control select2bs4" name="lga" id="lga-dropdown">
											<option value="<?php echo $lga ;?>"><?php if (empty($lga)){echo 'Select State First';} else {echo getLga($lga);} ?></option>
										</select> 
								   </td>
								</tr>
							</table>
						</fieldset>
						<fieldset>
							<legend><i class="fa fa-user-graduate"></i>&nbsp;Student Information</legend>
							<table align="center" border="0" class="table table-striped">
								<tr>
									<td>
										<label>Class</label> 
										<select name="class_id" style="width:100%;" class="form-control" <?php echo $disabled4;?>>
											<option value="<?php echo $class_id;?>"><?php echo getClass($class_id);?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["class_id"];?>"><?php echo $row["class_name"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>Category/Arm</label>
										<select name="cat_id" style="width:100%;" class="form-control" <?php echo $disabled4;?> required>
											<option value="<?php echo $cat_id; ?>"><?php echo getCategory($cat_id); ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM class_cat");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["cat_id"];?>"><?php echo $row["category"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>Admission no.</label>
										<input name="admn_no" type="text" placeholder="Admission no." value="<?php if (empty($admn_no)){echo '';} else {echo $admn_no;} ?>" class="form-control"/> 
									</td>
								</tr>
								<tr>
									<td>
										<label>Student Type</label>
										<select name="type_id" class="form-control">
											<option value="<?php echo $type_id;?>"><?php if (empty($type_id)){echo 'Select Student Type';} else {echo getStudenttype($type_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM student_type");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["type_id"];?>"><?php echo $row["student_type"];?></option><?php } ?><br/>
										</select>
									</td>
									<td>
										<label>House</label> 
										<select name="house" class="form-control">
											<option value="<?php echo $sthouse; ?>"><?php if (empty($sthouse)){echo 'Select House';} else { echo getHouse($sthouse);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM house_info WHERE sch_id='$sch_id'");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["house_id"];?>"><?php echo $row["house"];?></option><?php } ?><br/>	
										</select>
									</td>
									<td>
										<label>Club & Society</label> 
										<select name="club_soc" class="form-control">
											<option value="<?php echo $club_id; ?>"><?php if (empty($club_id)){echo 'Select Club & Society';} else {echo getClub($club_id);} ?></option>
											<?php 
											$result = mysqli_query($conn,"SELECT * FROM club_info");	
											while ($row = mysqli_fetch_array($result)){ ?>	
											<option value="<?php echo $row["club_id"];?>"><?php echo $row["club_name"];?></option><?php } ?><br/>	
										</select>
									</td>
								</tr>
							</table>
						</fieldset>
						
						<fieldset style="background-color:;padding:5px;margin:5px;">
							<legend><i class="fa fa-info-circle"></i>&nbsp;Parent/Guardian Information</legend>
							<div class="row">
								<div class="col-4">
									<label>Name of Parent/Guardian</label> 
									<input name="p_name" type="text" placeholder="Parent/Guardian Name" value="<?php echo $p_name; ?>" class="form-control"/>
								</div>
								<div class="col-4">
									<label>Parent/Guardian Phone no.</label> 
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-phone"></i></span>
										</div>
										<input name="parent_contact" type="text" placeholder="Parent Phone Number" maxlength="11" value="<?php echo $parent_contact; ?>" class="form-control"/>
									</div>
								</div>
								<div class="col-4">
									<label>Relationship</label> 
									<select name="relation" class="form-control">
										<option value="<?php echo $relation;?>"><?php echo $relation; ?></option>
										<option value="Father">Father</option>
										<option value="Mother">Mother</option>
										<option value="Guardian">Guardian</option>
									</select>
								</div>
							</div>
						</fieldset>
						
						<fieldset>
							<legend><i class="fa fa-map-marker-alt mr-1"></i>&nbsp;Contact Address</legend>
							<div class="row">
								<label>Contact Address</label>
								<textarea name="address" cols="2" rows="2" class="form-control" placeholder="Contact Address"><?php echo $address; ?></textarea>
							</div>
						</fieldset>
						
						<div class="modal-footer">
							<button onclick="goBack()" id="buttonn" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
							<input name="reset" type="reset" value="Reset" class="btn btn-danger"/>  
							<input name="submit" type="submit" value="Save" class="btn btn-primary"/>       
						</div>
					</form>
					<style>
						#form {
							max-width: 900px;
							margin: 0 auto;
							padding: 20px;
							border: 1px solid #ddd;
							border-radius: 5px;
							background-color: #f5f5f5;
							font-family: Arial, sans-serif;
						}
						fieldset{
							padding:5px;
							margin:5px;
						}
					</style>
<?php $page_title = "Update SMS"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>
<?php	    
if (isset($_POST['submit919'])){
	$psswd = md5($_POST['password']);
	if (empty($psswd)){
		$msg = "Enter Password";
	} else {
		$maxsize = 20000000000; //
	$file_name = $_FILES['file_name']['name'];
	$target_dir = "";
	$target_file = $target_dir . $_FILES["file_name"]["name"];
	 // Select file type
	$fileFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("php");

	// Check extension
	if( in_array($fileFileType,$extensions_arr) ){
		
		// Check file size
		if(($_FILES['file_name']['size'] >= $maxsize) || ($_FILES["file_name"]["size"] == 0)) {
			echo "file too large. file must be less than 200KB.";
		}else{
			$sql = "SELECT password FROM sch_users WHERE user_id = '$user_id' AND sch_id = '$sch_id' AND priv_id='1' LIMIT 1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			$password = $row['password'];
			if($password == $psswd){
				// Upload
			if (move_uploaded_file($_FILES['file_name']['tmp_name'],$target_file)){
				$msg = "Upload successfully.";
			}
			} else {
				$msg = "Access Denied";
			}	
		}
	} else {
	   $msg = "Invalid File";
	}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--link rel="stylesheet" href="dist/css/tab_style.css">
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
       
<!-- Main content -->   
<div class="row" style="width:98%;margin-left:10px;">
  <div class="col-md-12">
	<div class="card">
	  <div class="card-header">
		<h5 class="card-title">
		<i class="fa fa-upload"></i>
		Update</h5>
		<div class="card-tools">
		  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			<i class="fas fa-minus"></i>
		  </button>
		  <div class="btn-group">
			<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
			  <i class="fas fa-wrench"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right" role="menu">
			  <a href="#" class="dropdown-item">Action</a>
			  <a href="#" class="dropdown-item">Another action</a>
			  <a href="#" class="dropdown-item">Something else here</a>
			  <a class="dropdown-divider"></a>
			  <a href="#" class="dropdown-item">Separated link</a>
			</div>
		  </div>
		  <button type="button" class="btn btn-tool" data-card-widget="remove">
			<i class="fas fa-times"></i>
		  </button>
		</div>
	  </div>
	  <!-- /.card-header -->
	  <center><div class="card-body" style="width:700px;">
		<!-- Image Upload -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Upload an Update</h3>
		</div><!-- /.box-header -->
		   <div align="center" style="margin:auto;" class=" alert alert-primary color-palette disabled">Upload the Update Sent to you from the Developer</div>
			<center>
				<span class="badge bg-danger text-center"><?php if (isset($msg)){echo $msg;} ?></span>
			</center>                
			<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">            
				<form role="form" action="" method="post" enctype="multipart/form-data">
					<tr>
						<td style="background:#FFF;">
							<div class="col-md-12"><input name="password" type="password" placeholder="Password"  class="form-control"/></div>
						</td>
					</tr>

					<tr>
						<td>
							<div class="form-group">
								  <label for="exampleInputFile">Select Upload file</label>
								  <input type="file" name="file_name" accept="webpages/*" class="form-control" >
							</div>
						</td>
					</tr>

					<tr>
						<td style="background:#FFF;">
							<div class="col-md-12">
								<input name="submit919" type="submit" value="Update" class="btn btn-primary" style="float:right;"/>
							</div>
						</td>
					</tr>    
				</form>
			</table>                            
	  </div>
	</div></center>
   </div>
  </div>
</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
<?php $page_title = "Reset Password"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>
<?php
if (isset($_POST['submit'])) {
    $username = getUsername($user_id);
    $old = md5(stripslashes($_POST['old']));
    $new = md5(stripslashes($_POST['new']));
    $confirm = md5(stripslashes($_POST['confirm']));
    if (empty($old)) {
        $msg = '<span class="badge bg-danger">'.'Old Password Required!'.'</span>';
    } else if (empty($new)) {
        $msg = '<span class="badge bg-danger">'.'New Password Required!'.'</span>';
    } else if (empty($confirm)) {
        $msg = '<span class="badge bg-danger">'.'Confirm Password Required!'.'</span>';
    } else {
        if ($confirm != $new) {
            $msg = '<span class="badge bg-danger">'.'Password Mismatched!'.'</span>';
        } else {
            $query = "SELECT * FROM sch_users WHERE username='$username' AND password='$old' LIMIT 1";
            $result = mysqli_query($conn, $query) ;
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $username) {
                $query1 = "UPDATE sch_users SET password = '$new' WHERE username = '$username'";
                $result1 = mysqli_query($conn, $query1) ;
                header("location: logout.php");             
            } else if ($row['username'] != $username) {
                $msg = '<span class="badge bg-danger">'.'Incorrect Old Password!'.'</span>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Styles-->
<?php include('include/styles.php');?>
<!--General Header-->
<?php include('include/header.php');?>
<!--Side Navigation Bar-->
<?php include('include/side_nav.php');?>
<!--Page Title-->
<?php include('include/page_title.php');?>
<!-- information -->
<?php include 'include/information.php'?>

<div class="card card-primary" id="selectbox">
	<div class="card-header">
		<h3 class="card-title"><i class="fa fa-key"></i> Reset Password </h3>
	</div>
	<div class="card-body">
		<center style="margin-bottom:10px;">
			<?php if (isset($msg)) { echo '<text>'.$msg.'</text>';} ?>
		</center>
		<form action="" method="post">
			<table align="center" border="0"  cellspacing="0" cellpadding="0" class="table" style="width:100%;">
				<tr>
					<td> 
						<div class="col-md-12">Old Password<font color="#FF0000"> *</font><br/>
							<input name="old" type="password" placeholder="Old Password" class="form-control" required/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="col-md-12">New Password<font color="#FF0000"> *</font><br/>
							<input name="new" type="password"  placeholder="New Password" class="form-control" required/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="col-md-12">Confirm Password<font color="#FF0000"> *</font><br/>
							<input name="confirm" type="password"  placeholder="Confirm Password" class="form-control" required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align="right">
						<div class="col-md-12">
							<input name="submit" type="submit" value="RESET" class="btn btn-primary"/>
						</div>
					</td>
				</tr> 
			</table>
		</form> 
	</div>
</div>
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
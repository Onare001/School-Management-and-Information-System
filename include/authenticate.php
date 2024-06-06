<?php 
session_start();
//Database connection
include ("include/connection.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
	//Validate entries
    $username = validate($_POST['username']);
    $password = md5(validate($_POST['password']));//
	$parent_password = validate($_POST['password']);
	/*$Ldate = date('D, dS-M h:i:s A');*/
    if (empty($username)) {
		$msg = 'Username is Required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else if (empty($password)){
		$msg = 'Password is Required!';
		$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
    } else {
		// Record int log
		$file = 'activity.txt';
		$handle = fopen($file, 'a');
		fwrite($handle, date('Y-m-d H:i:s') . ' - '.$username.' tries to log in <br>' . PHP_EOL);
		fclose($handle);
		//Check user's credential
        $result = mysqli_query($conn,"SELECT * FROM sch_users WHERE username='$username' AND password='$password' LIMIT 1");
		$parent = mysqli_query($conn,"SELECT * FROM stdnt_info WHERE (parent_contact='$username' OR parent_email='$username') AND parent_contact='$parent_password' LIMIT 1");
		$privilege_id = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) === 1) {
			// Record int log
			$file = 'activity.txt';
			$handle = fopen($file, 'a');
			fwrite($handle, date('Y-m-d H:i:s') . ' - '.$username.' logged in <br>' . PHP_EOL);
			fclose($handle);
			
			if ($privilege_id['priv_id'] == 1 && $privilege_id['status'] == 1) {
				$_SESSION['username'] = $privilege_id['username'];
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: first_login"); //Administrator,admin_dashboard
			} else if (($privilege_id['priv_id'] == 2 && $privilege_id['status'] == 1) || ($privilege_id['priv_id'] > 4 && $privilege_id['priv_id'] < 9 && $privilege_id['status'] == 1)) {
				$_SESSION['username'] = $privilege_id['username'];
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: staff_dashboard");//Staff
			} else if ($privilege_id['priv_id'] == 9 && $privilege_id['status'] == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: account_dashboard");//Account Officer	
			} else if ($privilege_id['priv_id'] == 4 && $privilege_id['status'] == 1) {
				$_SESSION['username'] = $privilege_id['username'];
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: parent");//Parent
			} else if ($privilege_id['priv_id'] == 3 /*&& $privilege_id['status'] == 1*/) {
				$_SESSION['username'] = $username;
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: student_dashboard");//Student
			} else if ((($privilege_id['priv_id'] == 1) || ($privilege_id['priv_id'] == 2) || ($privilege_id['priv_id'] > 4 && $privilege_id['priv_id'] < 10 )) && $privilege_id['status'] == 0) {
				$_SESSION['username'] = $username;
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: user_alert");#Redirects if license is expired
			} else if ($privilege_id['priv_id'] > 0 && $privilege_id['status'] == 3) { 
				$_SESSION['username'] = $username;
				$_SESSION['priv_id'] = $privilege_id['priv_id'];
				header("location: site_alert");# Redirect if Site is being Maintained 
			} else {
				$_SESSION['username'] = '';
				$_SESSION['priv_id'] = '';
			}
		} else if (mysqli_num_rows($parent) === 1){
			$_SESSION['username'] = $username;
			$_SESSION['priv_id'] = '10';
			header("location: parent_dashboard"); 
		} else {
			$_SESSION['username'] = '';
			$_SESSION['password'] = '';
			$msg = "Invalid Username/Password!";
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
		}
	}	
}
?>
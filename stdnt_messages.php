<?php $page_title = "Messages | Inbox"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_student.php');?>

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

<!-- Message navigation -->
	<?php include 'messages/message_nav.php'?>
	   
<!-- Message inbox -->
	<?php include 'messages/inbox.php'?>  
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
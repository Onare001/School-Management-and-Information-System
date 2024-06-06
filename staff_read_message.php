<?php $page_title = "Message"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>

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

<!-- Read Navigation Message -->
	<?php include 'messages/message_nav.php'?>
	  
<!-- Read Message -->
	<?php include 'messages/read_inbox.php'?>
        
<?php include ('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>
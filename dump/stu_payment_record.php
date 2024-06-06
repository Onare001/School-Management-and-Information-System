<?php $page_title = ""; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_staff.php');?>
<?php
$username="";
if (isset($_GET['username'])) {
    $username = decrypt($_GET['username']);
}
echo $username.'<br>';
$suid = getUserid($username).'<br>';
echo getFirstname($suid).'<br>';
?>
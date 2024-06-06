<?php
include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');

if (empty($sch_add)) {
    header("location:complete_sch_reg");
} else if (!empty($sch_add)){
    header("location:admin_dashboard");
} else {
	header("location:admin_dashboard");
}
?>
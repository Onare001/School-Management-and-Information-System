<?php //include 'messages/read_inbox.php'; ?>
<?php
if (($_SERVER['PHP_SELF']) == ("/superschool/admin_read_message") || ($_SERVER['PHP_SELF']) == ("/superschool/staff_read_message")){
	include 'messages/read_inbox.php';
} else if (($_SERVER['PHP_SELF']) == ("/superschool/admin_read_message2") || ($_SERVER['PHP_SELF']) == ("/superschool/stdnt_read_message2")){
	include 'messages/read_sentbox.php';
}else if (($_SERVER['PHP_SELF']) == ("/superschool/admin_read_message2") || ($_SERVER['PHP_SELF']) == ("/superschool/stdnt_read_message2")){
	include 'messages/read_sentbox.php';
}
?>
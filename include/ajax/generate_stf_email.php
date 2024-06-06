<?php
function getSchname($sch_id){
	include '../connection.php';
	$result = mysqli_query($conn,"SELECT sch_name FROM sch_info WHERE sch_id = '$sch_id'");
	$row = mysqli_fetch_array($result);
	$sch_name = $row['sch_name'];
    return $sch_name;
}

function getSchAcronym($sch_id) {
  $school_name = getSchName($sch_id);
  $words = explode(" ", $school_name);
  $sch_acronym = "";
  foreach ($words as $word) {
    $sch_acronym .= strtoupper(substr($word, 0, 1));
	$sch_acronym = substr($sch_acronym, 0, 3);
  }
  return $sch_acronym;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$sch_id = $_POST['scid'];

    $email = strtolower($firstName . $lastName . '@'.getSchAcronym($sch_id).'.sms.net');

    echo $email;
}
?>

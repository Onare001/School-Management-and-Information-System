<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_admin.php');?>              
<?php
if (isset($_POST['search_term'])) {
    $search_term = htmlentities($_POST['search_term']);
    if (!empty($search_term)) {
		$result = mysqli_query($conn,"SELECT * FROM sch_users JOIN stdnt_info ON sch_users.user_id = stdnt_info.user_id AND sch_users.sch_id = stdnt_info.sch_id WHERE stdnt_info.status_id != '0' AND sch_users.sch_id = '$sch_id' AND (sch_users.first_name LIKE '%$search_term%' 
         OR sch_users.last_name LIKE '%$search_term%' OR sch_users.username LIKE '%$search_term%')
");
        if (mysqli_num_rows($result) == true) {
            $result_count = mysqli_num_rows($result);
            if ($result_count != 1) {
                echo '<p align="center" style=" padding:20px; color:#0896d8;"><b>Your search for ' . $search_term . ' returned ' . $result_count . ' results' . '</b></p>';
				$msg = 'Your search for ' . $search_term . ' returned ' . $result_count . ' results';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				echo $msg_toastr;
            } else {
                echo '<p align="center" style=" padding:20px; color:#0896d8;"><b>Your search for ' . $search_term . ' returned ' . $result_count . ' result' . '</b></p>';
				$msg = 'Your search for ' . $search_term . ' returned ' . $result_count . ' result';
				$msg_toastr = '<script>toastr.success("'.$msg.'")</script>';
				echo $msg_toastr;
            }
            echo '<center><table border="0" class="table table-striped" style="width:80%; cellspacing="5" cellpadding="5">';
			echo '<thead class="custom">
					<tr>
					<th>#SN</th>
					<th>FULL NAME</th>
					<th>USERNAME</th>
					<th>CLASS</th>
					<th>DETAIL</th>
					</tr>
				</thead>';
            $n = 1;
            while ($row = mysqli_fetch_array($result)) {
				$modal_id = "myModal".$row['user_id'];
                echo '<tr>
  <td>&nbsp;' . $n . '</td>
  <td align="left">' . $row['first_name'] . '&nbsp;' . strtoupper($row['last_name']) . '</td>
  <td align="left">' . $row['username'] . '</td>
   <td align="left">' . getClass($row['class_id']) . '&nbsp;' . getCategory($row['cat_id']) . '</td>
  <td class="border" align="center" width="5px">' . '<button type="submit" class="btn" data-toggle="modal" data-target="#'.$modal_id.'"><img src="assets/img/info.png" width="16" height="16" alt="img"></button>' . '</td>      
</tr>'.'<div class="modal fade" id="'.$modal_id.'" tabindex="-1" role="dialog" aria-labelledby="'.$modal_id.' Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="<?php echo $modal_id; ?>Label">Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><img src="'.getPassport($row['user_id']).'" alt="'. getLastname($row['user_id']).'" style="max-width:100px;" class="img-circle"/>  '.getLastname($row['user_id']).'&nbsp;'.getFirstname($row['user_id']).'</p>
					<p><b>Class:</b> '.getClass($row['class_id']).'&nbsp;'.getCategory($row['cat_id']).'</p>
					<p><b>Admission Number:</b> ' .$row['admn_no'].'</p>
					<p><b>Date of Birth:</b> '.getAge($row['user_id']).', '.$row['dob'].'</p>
					<p><b>State of Origin:</b> '.getLga($row['lga']).', '.getState($row['state_id']).'</p>
					<p><b>Home Address:</b> '.$row['address'].'</p>
					<p><b>Parent Name/Contact:</b> '.$row['p_name'].', '.$row['parent_contact'].'</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a href="edit_student?uid='.encrypt($row["user_id"]).'" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a></button>
				</div>
			</div>
		</div>
	</div>';
                $n = $n + 1;
            }
            echo '</table>';
        } else {
            echo '<p align="center" style=" padding:40px;"><b> No matched result for the entered keyword "' . $search_term . '"</b></p>';
			$msg = 'No matched result for the entered keyword '. $search_term . '';
			$msg_toastr = '<script>toastr.error("'.$msg.'")</script>';
			echo $msg_toastr;
        }
    }
}
?>
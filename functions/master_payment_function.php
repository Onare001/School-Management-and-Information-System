<!--=========================SESSION 1================================-->
<?php
		//Session 1
		//Term 1
		$tid1="1";
		if (getMPaymentstatus($uid, $tid1, $sid1, $pt) == 0){
			$paymentstatus11 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid1, $sid1, $pt) == 1){
			$paymentstatus11 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid1, $pt) == 2){
			$paymentstatus11 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid1, $pt) == 3){
			$paymentstatus11 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus11 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 1
		//Term 2
		$tid2="2";
		if (getMPaymentstatus($uid, $tid2, $sid1, $pt) == 0){
			$paymentstatus12 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid2, $sid1, $pt) == 1){
			$paymentstatus12 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid1, $pt) == 2){
			$paymentstatus12 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid1, $pt) == 3){
			$paymentstatus12 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus12 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 1
		//Term 3
		$tid3="3";
		if (getMPaymentstatus($uid, $tid3, $sid1, $pt) == 0){
			$paymentstatus13 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid3, $sid1, $pt) == 1){
			$paymentstatus13 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid1, $pt) == 2){
			$paymentstatus13 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid1, $pt) == 3){
			$paymentstatus13 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus13 = '<img src="assets/img/error-icon.png"/>';
		}
		?> 
		
<!--=========================SESSION 2================================-->		
		
		<?php
		//Session 2
		//Term 1
		$tid1="1";
		if (getMPaymentstatus($uid, $tid1, $sid2, $pt) == 0){
			$paymentstatus21 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid1, $sid2, $pt) == 1){
			$paymentstatus21 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid2, $pt) == 2){
			$paymentstatus21 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid2, $pt) == 3){
			$paymentstatus21 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus21 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 2
		//Term 2
		$tid2="2";
		if (getMPaymentstatus($uid, $tid2, $sid2, $pt) == 0){
			$paymentstatus22 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid2, $sid2, $pt) == 1){
			$paymentstatus22 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid2, $pt) == 2){
			$paymentstatus22 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid2, $pt) == 3){
			$paymentstatus22 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus22 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 2
		//Term 3
		$tid3="3";
		if (getMPaymentstatus($uid, $tid3, $sid2, $pt) == 0){
			$paymentstatus23 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid3, $sid2, $pt) == 1){
			$paymentstatus23 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid2, $pt) == 2){
			$paymentstatus23 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid2, $pt) == 3){
			$paymentstatus23 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus23 = '<img src="assets/img/error-icon.png"/>';
		}
		?> 
		
		
<!--=========================SESSION 3================================-->
<?php
		//Session 3
		//Term 1
		$tid1="1";
		if (getMPaymentstatus($uid, $tid1, $sid3, $pt) == 0){
			$paymentstatus31 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid1, $sid3, $pt) == 1){
			$paymentstatus31 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid3, $pt) == 2){
			$paymentstatus31 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid1, $sid3, $pt) == 3){
			$paymentstatus31 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus31 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 3
		//Term 2
		$tid2="2";
		if (getMPaymentstatus($uid, $tid2, $sid3, $pt) == 0){
			$paymentstatus32 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid2, $sid3, $pt) == 1){
			$paymentstatus32 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid3, $pt) == 2){
			$paymentstatus32 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid2, $sid3, $pt) == 3){
			$paymentstatus32 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus32 = '<img src="assets/img/error-icon.png"/>';
		}
		
		//Session 3
		//Term 3
		$tid3="3";
		if (getMPaymentstatus($uid, $tid3, $sid3, $pt) == 0){
			$paymentstatus33 = '<img src="assets/img/error-icon.png"/>';
		} else if (getMPaymentstatus($uid, $tid3, $sid3, $pt) == 1){
			$paymentstatus33 = '<span class="badge badge-warning">Outstanding</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid3, $pt) == 2){
			$paymentstatus33 = '<span class="badge badge-danger">Denied</span>';
		} else if (getMPaymentstatus($uid, $tid3, $sid3, $pt) == 3){
			$paymentstatus33 = '<img src="assets/img/tick.png"/>';//Approved
		} else {
			$paymentstatus33 = '<img src="assets/img/error-icon.png"/>';
		}
		?> 
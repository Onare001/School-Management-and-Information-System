			<?php
			if ($priviledge == 2 || $priviledge > 4 && $priviledge < 10) {
				$result = mysqli_query($conn,"SELECT * FROM broadcast_msg WHERE audience='1' AND sch_id='$sch_id' AND status='1'");
				$result1 = mysqli_query($conn,"SELECT * FROM broadcast_msg WHERE audience='1' AND sch_id='$sch_id' AND status='1'");
				
				$row1 = mysqli_fetch_assoc($result1);	
				if ($row1['status'] == 1 && $row1['audience'] == 1){
					
					$marquee_text = '';
					
					while($row = mysqli_fetch_array($result)) {
						$marquee_text .= '***'.$row['information'].'***'.'&nbsp;';
					}	
					echo '<marquee style="background-color:red;color:white;margin-top:0px;margin-left:10px;margin-right:10px;">'.$marquee_text.'</marquee>'.'<p>';
				} else {
					echo '';//getSchName($sch_id)
				}
			} else if ($priviledge == 3) {
				$result = mysqli_query($conn,"SELECT * FROM broadcast_msg WHERE audience='3' AND sch_id='$sch_id' AND status='1' LIMIT 1");
				$row = mysqli_fetch_assoc($result);
				if ($row['status'] == 1 && $row['audience'] == 3){
					echo '<marquee style="background-color:darkblue;color:white;margin-left:10px;margin-right:10px;">'.$row['information'].'</marquee>'.'<p>';
				} else {
					echo '';//getSchName($sch_id)
				}
			}	
			?>
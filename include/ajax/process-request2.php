<!-- Theme style -->
<!--link rel="stylesheet" href="dist/css/adminlte.min.css"-->
<?php
//Edit Priviledge
	include ("connection.php");
    $priv_id = $_POST["priv_id"];
	if ($priv_id == 5){
		echo '<tr>
		<td align="left">
				<div class="col-md-12"> 
					<select name="class_id" id="sel_class" class="form-control">';
						
						echo '<option value="">'.'Select Class'.'</option>';
						$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<4");
						while ($row = mysqli_fetch_array($result)){
						echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } '<br/>
					</select>
				</div>
		   </td>
		</tr>';
	
		echo '<tr>
		<td align="left">
				<div class="col-md-12"> 
					<select name="class_id" id="sel_class" class="form-control">';
						echo '<option value="">'.'Select Class'.'</option>';
						$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<4");
						while ($row = mysqli_fetch_array($result)){
						echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } '<br/>
					</select>
				</div>
		   </td>
		</tr>';
}?>
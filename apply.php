<?php $page_title = "New Student Admission Form"; ?>
<?php include ("include/connection.php"); ?>
<?php include ("functions/functions.php"); $priviledge = '0';$user_id="";$theme="";$sch_id="";?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
	$gender = $_POST['gender'];
    $guardianName = $_POST['guardian_name'];
    $previousSchool = $_POST['previous_school'];
    $gradeApplying = $_POST['grade_applying'];
    $medicalHistory = $_POST['medical_history'];

    // Validate and sanitize the data as needed

    //Application number
	$appl_no = 'SMS/'.date('Y').'/';
	
    // Insert data into the admission table
    $admission = mysqli_query($conn,"INSERT INTO admission (appl_no, first_name, middle_name, last_name, sex_id, session_id) VALUES ('$appl_no', '$firstName', '$middleName', '$lastName', $gender, $csid)");
//, guardian_name, previous_school, grade_applying, medical_history
//, '$guardianName', '$previousSchool', '$gradeApplying', '$medicalHistory'
    if ($admission === TRUE) {
        // Data inserted successfully
        echo "Data inserted into the admission table.";
    } else {
        // Error inserting data
        echo "Error: "  . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles2.php');?>

<body class="hold-transition login-page" style="background-color:blue;background: url(assets/img/login_bg.jpg); background-size:100% 100% no-repeat;color:white;">
    <h1>New Student Admission Form for <?php echo getSession($csid);?> Academic Session</h1>
    <form action="" id="admission-form" method="post" >
		<div class="form-section current">
            <h2>School Information</h2>
            <label>School:</label>
			<select name="school" id="sel_gender" class="form-control">
				<?php
				echo '<option value="">'.'Select School of your Choice'.'</option>';
				$result = mysqli_query($conn,"SELECT * FROM sch_info");
				while ($row = mysqli_fetch_array($result)){
				echo '<option value="'.$row["sch_id"].'">'.$row["sch_name"].'</option>'; } ?><br/>
			</select><br><br>
			
            <div class="form-navigation">
                <button type="button" onclick="nextSection()">Next</button>
            </div>
        </div>
	
        <!-- Personal Information -->
        <div class="form-section">
            <h2>Student Information</h2>
            <label>First Name:</label>
            <input type="text" name="first_name" required/></br>

            <label>Middle Name:</label>
            <input type="text" name="middle_name"><br>

            <label>Last Name(Surname):</label>
            <input type="text" name="last_name" required/></br>
			
			<label>Gender:</label>
			<select name="gender" id="sel_gender" class="form-control">
				<?php
				echo '<option value="">'.'Select Gender'.'</option>';
				$result = mysqli_query($conn,"SELECT * FROM gender_info");
				while ($row = mysqli_fetch_array($result)){
				echo '<option value="'.$row["sex_id"].'">'.$row["gender"].'</option>'; } ?><br/>
			</select><br>

			<label>State:</label>
			<select class="form-control select2bs4" name="state_id" id="state-dropdown">
				<?php
				echo '<option value="">'.'Select State of Origin'.'</option>';
				$result = mysqli_query($conn,"SELECT * FROM state_info");
				while ($row = mysqli_fetch_array($result)){
				echo '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>'; } ?><br/>
			</select></br>
			
			<label>Local Government Area:</label>
			<select class="form-control select2bs4" name="lga" id="lga-dropdown">
				
			</select><br>
			
			<div class="form-navigation">
				<button type="button" onclick="nextSection()">Next</button>
				<button type="button" onclick="previousSection()">Previous</button> 
			</div>
        </div>

        <!-- Parent/Guardian Information -->
        <div class="form-section">
            <h2>Parent/Guardian Information</h2>
            <label>Parent/Guardian Name:</label>
            <input type="text" name="guardian_name" /><br>
			
			 <label>Parent/Guardian Phone No:</label>
            <input type="text" name="guardian_phone" /><br>
			
			<label>Parent/Guardian Email Address:</label>
            <input type="email" name="guardian_email" /><br>

			<div class="form-navigation">
				<button type="button" onclick="nextSection()">Next</button>
				<button type="button" onclick="previousSection()">Previous</button> 
			</div>
        </div>

        <!-- Academic Information -->
        <div class="form-section">
            <h2>Academic Information</h2>
            <label>Previous School:</label>
            <input type="text" name="previous_school"><br>

            <label>Grade/Class Applying for:</label>
            <select name="class_id" id="sel_class" class="form-control">
				<?php
				echo '<option value="">'.'Select Class'.'</option>';
				$result = mysqli_query($conn,"SELECT * FROM class_info WHERE class_id<$class_limit");
				while ($row = mysqli_fetch_array($result)){
				echo '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>'; } ?><br/>
			</select><br>
			<div class="form-navigation">
				<button type="button" onclick="nextSection()">Next</button>
				<button type="button" onclick="previousSection()">Previous</button> 
			</div>
        </div>

        <!-- Health Information -->
        <div class="form-section">
            <h2>Health Information</h2>
            <label>Medical History:</label>
            <textarea name="medical_history"></textarea><br>

			<div class="form-navigation">
				<button type="button" onclick="nextSection()">Next</button>
				<button type="button" onclick="previousSection()">Previous</button> 
			</div>
        </div>

        <!-- Additional Documents -->
        <div class="form-section">
            <h2>Additional Documents</h2>
            <label>Upload Identification Document:</label>
            <input type="file" name="identification_document"><br>
            <label>Upload Photograph:</label>
            <input type="file" name="photo"/>
			
			<!-- Add other file upload fields here -->

			<div class="form-navigation">
				<button type="button" onclick="nextSection()">Next</button>
				<button type="button" onclick="previousSection()">Previous</button> 
			</div>
        </div>
		
		<div class="form-section">
            <h2>Application Information</h2>
            <label>Application No.:</label>
            <input type="text" name="medical_history" value="<?php echo 'SMS/'.date('Y').'/';?>" disabled /></br>

            <!-- Add other health information fields here -->
			 <div class="form-navigation">
			   <button type="submit" name="submit">Submit</button>
			   <button type="button" onclick="previousSection()">Previous</button>
            </div>
        </div>
    </form>
	<?php include ('include/ajax/process_lga.php');?>
    <script>
        // JavaScript code for form navigation

        // Get all form sections
        const formSections = document.querySelectorAll('.form-section');

        // Current section index
        let currentSectionIndex = 0;

        // Show current section and hide others
        function showCurrentSection() {
            formSections.forEach((section, index) => {
                if (index === currentSectionIndex) {
                    section.classList.add('current');
                } else {
                    section.classList.remove('current');
                }
            });
        }

        // Go to the next section
        function nextSection() {
            if (currentSectionIndex < formSections.length - 1) {
                currentSectionIndex++;
                showCurrentSection();
            }
        }

        // Go to the previous section
        function previousSection() {
            if (currentSectionIndex > 0) {
                currentSectionIndex--;
                showCurrentSection();
            }
        }
    </script>
</body>
<footer>
	<p align="center" style="padding:0px; color:white; font-size:14px; margin-top:20px; padding-bottom:30px; text-align:center;">
	<text>Copyright © 2024 SMS. All Rights Reserved. Powered by Niel Technologies <i class="fa fa-wifi"></i> | +2348145162722.&nbsp;</p></text>
</footer>
 <style>
	body {
		font-family: Arial, sans-serif;
		margin: 20px;
	}

	h1 {
		text-align: center;
	}

	form {
		max-width: 500px;
		margin: 0 auto;
		padding: 20px;
		border: 1px solid #ccc;
		border-radius: 5px;
	}

	form h2 {
		margin-top: 20px;
	}

	label {
		display: block;
		margin-bottom: 5px;
	}

	input[type="email"],
	input[type="text"],
	textarea,
	input[type="file"] {
		width: 100%;
		padding: 8px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-bottom: 10px;
	}

	textarea {
		height: 100px;
	}

	input[type="submit"] {
		background-color: #4CAF50;
		color: #fff;
		border: none;
		padding: 10px 20px;
		border-radius: 4px;
		cursor: pointer;
	}

	input[type="submit"]:hover {
		background-color: #45a049;
	}


	/* CSS styles for the form */

	.form-section {
		display: none;
	}

	.form-section.current {
		display: block;
	}

	.form-navigation {
		overflow: auto;
	}

	.form-navigation button {
		background-color: #4CAF50;
		color: #fff;
		border: none;
		padding: 10px 20px;
		border-radius: 4px;
		cursor: pointer;
		float: right;
		margin-right: 10px;
	}
</style>
</html>
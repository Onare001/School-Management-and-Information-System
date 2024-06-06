<?php $page_title = "User Guide"; ?>
<?php include ('include/connection.php'); include ('functions/functions.php'); include ('include/lock_all.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/styles.php');?>

<?php include('include/header.php');?>
<?php include('include/side_nav.php');?>

<?php include('include/page_title.php');?>

    <section class="content">
        <div class="row">
		<?php if($priviledge == '1'){ echo '
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                1. How to Register new Student
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
							<ul>
								<li>On the left side navigation bar, Click on "<b>Register Staff/Student</b>"</li>
								<li>From the dropdown list, Click on "<b>Student</b>"</li>
								<li>In the appearing page Select the Class and Category that student is to be registered in, and click "<b>Proceed</b>"</li>
								<li>The appearing page displays the list of existing students in the Selected Class and Category</li>
								<li>Fill the form on the top of the page by entering the student\' Surname and Firstname, Othername. Also, Select the student\' gender</li>
								<li>The Student ID will automatically be generated</li>
								<li>Click "<b>Register</b>" to save the student\' record</li>
							</ul>
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. How to Register a Staff
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                             <ul>
								<li>On the left side navigation bar, Click on "<b>Register Staff/Student</b>"</li>
								<li>From the dropdown list, Click on "<b>Staff</b>"</li>
								<li>The appearing page displays the list of all registered staff in the School</li>
								<li>On the Page find and Click on "<b>Add new Staff</b></li>
								<li>A form will be popped-up, fill the form by entering the staff\' Surname, Othername(s). Also, select the staff\' category and department</li>
								<li>The Staff email address will be created automatically</li>
								<li>Click "<b>Register</b>" to save the student\' record</li>
							</ul>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. How to Assign Task (Class and Subject) to a Teacher
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. How to Change the Priviledge of a Staff
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                5. How to View and Print Student\' Terminal Result
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                6. How to View and Print Student\' Cumulative Result 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                7. How to Manually Switch Term, Session and Year 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSeven" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                8. How to add new Subject
                            </h4>
                        </div>
                    </a>
                    <div id="collapseEight" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                9.  How to Promote Students
                            </h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							<ul>
								<li>On the left side navigation bar, Click on "<b>School Settings</b>"</li>
								<li>On the appearing page, select mass promotion</li>
								<li>Click select, then choose Promote</li>
								<li>Select the year of graduation for the outgoing/outgone '.getClass($class_limit-1).' students</li>
								<li>Then, Click Promote</li>
							</ul>
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                10.  Criteria, Step on How to Publish results
                            </h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
							<ul>
								<li>Publishing means making the term/session Result available to Parents and Students</li>
								<li>This should be done officially by 9am on the day School closes for the term to enable Parent view their ward Results from home (<font color="red">Online</font>)</li>
								<li>Publish and Print the Results a day before school closes for the term and to be distributed to the students (<font color="red">Offline</font>)</li>
								<li>Before Publishing, ensure that the results have been reviewed by the scritiny committe or Examination office<!-- and are free from all input errors--></li>
								<li>You can use other means such as '.'<a href="terminal_broadsheet">Broadsheet</a> to view students Scores</li>
								<li>Click '.'<a href="gen_settings">here</a>'.' to Publish Result</li>
							</ul>
                        </div>
                    </div>
                </div>
				<div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                11.  How to turn on/off the display of position on result
                            </h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
				<div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                12.  How to Set Resumption date
                            </h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                13.  How to reset User Password
							</h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
				<div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                14.  How to reset User\'s Password
							</h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
				<div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                15.  How to reset Administrative Password
							</h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
				<div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                16.  How to Create Backup
							</h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
            </div>';
		} else if($priviledge == 2 || $priviledge > 4 && $priviledge < 9){
			echo '
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                1. How to Enter Score
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
							<center><video src="videos/guide_1.mp4" controls width="400px" height="300px"/></center>
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. How to Upload CSV
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                             <ul>
									<li>On the left side navigation bar, Click on "<b>Register Staff/Student</b>"</li>
									<li>From the dropdown list, Click on "<b>Staff</b>"</li>
									<li>The appearing page displays the list of all registered staff in the School</li>
									<li>On the Page find and Click on "<b>Add new Staff</b></li>
									<li>A form will be popped-up, fill the form by entering the staff\' Surname, Othername(s). Also, select the staff\' category and department</li>
									<li>The Staff email address will be created automatically</li>
									<li>Click "<b>Register</b>" to save the student\' record</li>
								</ul>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. How to Edit Score
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. How to Delete Score
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                             To delete Score,kindly contact the administrator and provide them with the student\'s name, class & category, subject, term and academic session so that the score can be deleted and corrected.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                5. How to Create examination questions
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                6. How to Create and View student\' holiday assignnment 
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                7. How to Access my E-Lesson Plan
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSeven" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                8. How to Change my Password
                            </h4>
                        </div>
                    </a>
                    <div id="collapseEight" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
                        </div>
                    </div>
                </div>
            </div>';
		} else if ($priviledge == 3){
			echo '
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                1. How to Submit Holiday Assignment
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
							<center><video src="videos/guide_1.mp4" controls width="400px" height="300px"/></center>
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. Steps on how to Pay School Charges Online
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                             <ul>
									<li>On the left side navigation bar, Click on "<b>Register Staff/Student</b>"</li>
									<li>From the dropdown list, Click on "<b>Staff</b>"</li>
									<li>The appearing page displays the list of all registered staff in the School</li>
									<li>On the Page find and Click on "<b>Add new Staff</b></li>
									<li>A form will be popped-up, fill the form by entering the staff\' Surname, Othername(s). Also, select the staff\' category and department</li>
									<li>The Staff email address will be created automatically</li>
									<li>Click "<b>Register</b>" to save the student\' record</li>
								</ul>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. How to Check Terminal/Cumulative Result
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. How to lodge Complain concerning Results
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           This is can only be done on teacher\'s request
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                5. How to Change my Password
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                        </div>
                    </div>
                </div>
            </div>';
		} else if ($priviledge == 4){
			
		} else if ($priviledge == 5){
			
		} else if ($priviledge == 6){
			
		} else if ($priviledge == 7){
			
		} else if ($priviledge == 8){
			
		} else if ($priviledge == 9){
						echo '
            <div class="col-12" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                1. How to Track Payment record
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
							<center><video src="videos/guide_1.mp4" controls width="400px" height="300px"/></center>
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. Steps on how to Pay School Charges Online
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                             <ul>
									<li>On the left side navigation bar, Click on "<b>Register Staff/Student</b>"</li>
									<li>From the dropdown list, Click on "<b>Staff</b>"</li>
									<li>The appearing page displays the list of all registered staff in the School</li>
									<li>On the Page find and Click on "<b>Add new Staff</b></li>
									<li>A form will be popped-up, fill the form by entering the staff\' Surname, Othername(s). Also, select the staff\' category and department</li>
									<li>The Staff email address will be created automatically</li>
									<li>Click "<b>Register</b>" to save the student\' record</li>
								</ul>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. How to View Master Payment Record
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. How to Retract Payment
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                        </div>
                    </div>
                </div>
            </div>';
		} else if ($priviledge == 10){
			
		} else {
			echo '<div align="center" style="width:100%; margin:auto; margin-top:50px; margin-bottom:20px; max-width:550px; border:0px solid #CCC;">
				<div class="card card-danger" style="color:; margin:auto; width:auto;">
					<div class="card-header" style="text-align:left;">Information! <img src="assets/img/alert.png" class="img-responsive" style="float:right;"></div>
					<div align="center" style=" margin:auto; padding:15px;">
						<div style="width:auto; height:auto; padding:15px;">
							We couldn\'t determine your priviledge
						</div>
					</div>
				</div>
			</div>';
		};?>
        </div>
        <div class="row">
            <div class="col-12 mt-3 text-center">
                <p class="lead">
                    <a href="https://api.whatsapp.com/send?phone=2348145162722">Contact us</a>,
                    if you found not the right anwser or you have other question?<br />
                </p>
            </div>
        </div>
    </section>

<?php include('include/footer.php');?>
<?php include ('include/page_scripts/general_script.php');?>
</html>

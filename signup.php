


<?php

    include('connect.php');

    try
    {
        if(isset($_POST['signup']))
        {
            if(empty($_POST['email']))
            throw new Exception("Email cann't be empty.");

            if(empty($_POST['uname']))
            throw new Exception("Username cann't be empty.");

            if(empty($_POST['pass']))
            throw new Exception("Password cann't be empty.");
            
            if(empty($_POST['fname']))
            throw new Exception("First name cann't be empty.");
            
            if(empty($_POST['phone']))
            throw new Exception("Phone cann't be empty.");
            
            if(empty($_POST['type']))
            throw new Exception("type cann't be empty.");

            $target_dir = "student/images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) 
            {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else 
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }


            $result = mysqli_query($con,"insert into student(st_id,st_name,st_batch,st_sem,st_email,st_password) values('$_POST[eid]','$_POST[name]','$_POST[batch]','$_POST[semester]','$_POST[email]','$_POST[pass]')");
            $success_msg="Signup Successfully!";

        }
    }
    catch(Exception $e)
    {
        $error_msg =$e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

	<title>Online Attendance Management System</title>
	<!--<link rel="stylesheet" type="text/css" href="css/main.css">-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="css/style.css" >
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	

</head>

<body>
	<?php
		include ('includes/header.php');
	?>
	<div class="main_body container">
		<div class="col-xs-1">
		</div>
		<div class="col-xs-10" style="background: #4caf50; height: 950px">
			<div class="content">
				<div class="col-xs-12">
					<div class="login-box">
						<h1>Sign up</h1>
						<?php
                        if(isset($success_msg)) echo $success_msg;
                        if(isset($error_msg)) echo $error_msg;
                        ?>
                        


                        <form id = "form2" action="signup_script.php" method="POST">
                            
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-envelope"></i>
									<input id="form_input" type="text" class="form-control" name="email" placeholder="Email ID">
								</div>
                            </div>

                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-lock"></i>
									<input type="password" name="password" id="input1" placeholder="Password"/>
								</div> 
                            </div>
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="text" class="form-control" name="eid" placeholder="Enrolment ID / Teacher ID">
								</div> 
                            </div>
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="text" class="form-control" name="name" placeholder="Full Name">
								</div>
                            </div>
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="text" class="form-control" name="dept" placeholder="Department">
								</div>
                            </div>
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="text" class="form-control" name="batch" placeholder="Batch">
								</div>
                            </div>
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="text" class="form-control" name="semester" placeholder="Semester (for Students)">
								</div>
                            </div>
                            <!--<div class="form-group">
                                <div class="textbox">
									<i class="fas fa-user"></i>
									<input id="form_input" type="email" class="form-control" name="email" placeholder="email">
								</div>
                            </div>-->
                            <div class="form-group">
                                <div class="textbox">
									<i class="fas fa-phone"></i>
									<input id="form_input" type="text" class="form-control" name="contact" placeholder="Contact">
								</div>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-camera"></i>
                                <label for="img">Profile Picture</label>
                                <input type="file" id="img" name="<?php $_POST['uname'] ?>.jpg" accept="image/*" placeholder="Profile Picture">
							</div>
                            <!--<div class="form-group" class="radio" style="text-align:center;" >
								<div>
									<label>
										<input class="radio-inline" type="radio" name="type" id="optionsRadios1" value="Student" checked > Student
									</label>
									<label>
										<input class="radio-inline" type="radio" name="type" id="optionsRadios1" value="Teacher"> Teacher
									</label>
								</div>
							</div>-->
                            <input type="submit" type="submit" value='Submit' class="btn btn-transparent" name="Sign up" />
                        </form>






                
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-1">
		</div>
	</div>	
	<?php
		include ('includes/footer.php');
	?>
</body>
</html>
<?php
if(isset($_POST['login']))
{
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		$row=0;
		if($_POST['type']=='student')
			$result=mysqli_query($con,"select * from students where st_email='$_POST[username]' and st_password='$_POST[password]'");
		else if($_POST['type']=='teacher')
			$result=mysqli_query($con,"select * from teachers where tc_email='$_POST[username]' and tc_password='$_POST[password]'");
		else
			$result=mysqli_query($con,"select * from admininfo where email='$_POST[username]' and password='$_POST[password]'");
			

		$row=mysqli_fetch_row($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$res=mysqli_query($con,"select tc_dept from teachers where tc_email='$_POST[username]' and tc_password='$_POST[password]'");
			$r=mysqli_fetch_array($res);
			$_SESSION['email']=$_POST['username'];
			$_SESSION['dept']=$r['tc_dept'];
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$res=mysqli_query($con,"select * from students where st_email='$_POST[username]' and st_password='$_POST[password]'");
			$r=mysqli_fetch_array($res);
			$_SESSION['id']=$r['st_id'];
			$_SESSION['email']=$_POST['username'];
			$_SESSION['dept']=$r['st_dept'];
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
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
		include ('includes/header_index.php');
	?>
	<div class="main_body container">
		<div class="col-xs-1">
		</div>
		<div class="col-xs-10 banner_image">
			<div class="content">
				<div class="col-xs-12">
					<div class="login-box">
						<h1>Login</h1>
		
						<?php
						if(isset($error_msg))
						{
							echo $error_msg;
						}
						?>
		
						<form method="post">
							<div class="form-group">
								<div class="textbox">
									<i class="fas fa-user"></i>
									<input type="text" name="username" id="input1" placeholder="Username">
								</div>
							</div>
                            
							<div class="form-group">
								<div class="textbox">
									<i class="fas fa-lock"></i>
									<input type="password" name="password" id="input1" placeholder="Password"/>
								</div>
							</div>
                            <br>
							<div class="form-group" class="radio">
								<div>
									<label>
										<input class="radio-inline" type="radio" name="type" id="optionsRadios1" value="student" checked > Student
									</label>
									<label>
										<input class="radio-inline" type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
									</label>
									<label>
										<input class="radio-inline" type="radio" name="type" id="optionsRadios1" value="admin"> Admin
									</label>
								</div>
							</div>
		
							<input type="submit" class="btn btn-transparent" value="Login" name="login" />
						</form>
		
						<div>
		
							<br><br>
							<p><strong>Have forgot your password? <a href="reset.php" style="color:#4caf50">Reset here.</a></strong></p>
							<p><strong>If you don't have any account, <a href="signup.php"  style="color:#4caf50">Signup</a> here</strong></p>
						</div>
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
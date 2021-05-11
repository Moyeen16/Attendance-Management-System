<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{

  header('location: ../index.php');
}
?>


<?php

//establishing connection
include('connect.php');

try{

    //validation of empty fields
    if(isset($_POST['signup']))
	{
        if(empty($_POST['email']))
		{
          throw new Exception("Email cann't be empty.");
        }
        if(empty($_POST['uname']))
		{
            throw new Exception("Username cann't be empty.");
        }
        if(empty($_POST['pass']))
		{
           throw new Exception("Password cann't be empty.");
        }              
        if(empty($_POST['fname']))
		{
            throw new Exception("Username cann't be empty.");
        }
        if(empty($_POST['phone']))
		{
            throw new Exception("Username cann't be empty.");
        }
        if(empty($_POST['type']))
		{
            throw new Exception("Username cann't be empty.");
        }
        //insertion of data to database table admininfo
        $result = mysqli_query($con,"insert into admininfo(username,password,email,fname,phone,type) values('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')");
        $success_msg="Signup Successfully!";

  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }

?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Attendance Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Latest compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
input {
  width: 500px;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

</style>
</head>
<!-- head ended -->

<!-- body started -->
<body style="margin:50px 250px;width:1000px;height:100%;">

    <!-- Menus started-->
    <header>

      <h1>Attendance Management System</h1>
      <div class="navbar">
      <a href="signup.php">Add Admins</a>
      <a href="index.php">Add Data</a>
      <a href="../logout.php">Logout</a>

    </div>

    </header>
    <!-- Menus ended -->

<center>

<p>    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
       
     </p>

<div class="content">
	<div class="row">
			 <h1 style="margin-left:250px">Add Admin Information</h1>
	</div>

  <div class="row" style="padding:100px 300px;height:100%;border-radius:20px;border:1px solid black">
  
   
    <form method="post" >
	

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
            <input type="text" name="email" id="input1" placeholder="your email" style="width:200px;"/>
      </div>

      <div class="form-group">
          <label for="input1">Username</label>
            <input type="text" name="uname" id="input1" placeholder="choose username" style="width:200px;"/>
      </div>

      <div class="form-group">
          <label for="input1" >Password</label>
            <input type="password" name="pass" id="input1" placeholder="choose a strong password" style="width:200px;"/>
      </div>

      <div class="form-group">
          <label for="input1">Full Name</label>
            <input type="text" name="fname" id="input1" placeholder="your full name" style="width:200px;"/>
      </div>

      <div class="form-group">
          <label for="input1" >Phone Number</label>
            <input type="text" name="phone" id="input1" placeholder="your phone number" style="width:200px;"/>
      </div>


      <!--<div class="form-group" class="radio">
      <label for="input1" class="col-sm-3 control-label">Role</label>
      <div class="col-sm-7">
        <label>
          <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
        </label>
            <label>
          <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
        </label>
        <label>
          <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
        </label>
      </div>
      </div>-->

      <button type="submit" value="Signup" name="signup" style="width:80px">Sign Up</button>
    </form>
  </div>
    <br>
    <p><strong>Already have an account? <a href="../index.php">Login</a> here.</strong></p>

</div>

</center>

</body>
<!-- Body ended  -->

</html>

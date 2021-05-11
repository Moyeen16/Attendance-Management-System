<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{

  header('location: ../index.php');
}
?>

<?php

include('connect.php');

//data insertion
  try{

    //checking if the data comes from students form
    if(isset($_POST['std'])){

      //students data insertion to database table "students"
        $result = mysqli_query($con,"insert into students(st_id,st_name,st_dept,st_batch,st_sem,st_email) values('$_POST[st_id]','$_POST[st_name]','$_POST[st_dept]','$_POST[st_batch]','$_POST[st_sem]','$_POST[st_email]','$_POST[st_password]')");
        $success_msg = "Student added successfully.";

    }

        //checking if the data comes from teachers form
        if(isset($_POST['tcr'])){

          //teachers data insertion to the database table "teachers"
          $res = mysqli_query($con,"insert into teachers(tc_id,tc_name,tc_dept,tc_email,tc_course) values('$_POST[tc_id]','$_POST[tc_name]','$_POST[tc_dept]','$_POST[tc_email]','$_POST[tc_course]','$_POST[tc_password]')");
          $success_msg = "Teacher added successfully.";
    }

  }
  catch(Execption $e){
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
<style type="text/css">

  .message{
    padding: 10px;
    font-size: 15px;
    font-style: bold;
    color: black;
  }
</style>
<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
}
.column {
  flex: 50%;
  padding: 10px;
}

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
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="content">

<div class="row" style="height:100%;border-radius:20px;border:1px solid black">
  <div class="column" id="student">

      <form method="post" >
      <h4>Add Student's Information</h4>
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Reg. No.</label>
            <input type="text" name="st_id" id="input1" placeholder="Enter unique Registration No." style="width:200px"/>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Name</label>
            <input type="text" name="st_name"  class="form-control" id="input1" placeholder="Enter Student full name" style="width:200px"//>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
            <input type="text" name="st_dept"  class="form-control" id="input1" placeholder="Enter Department ex. IT" style="width:200px"//>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Batch</label>
            <input type="text" name="st_batch"  class="form-control" id="input1" placeholder="Enter Passout year" style="width:200px"//>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Semester</label>
            <input type="text" name="st_sem"  class="form-control" id="input1" placeholder="Enter Semester No." style="width:200px"//>
      </div>

      <div class="form-group">
          <label for="input1">Email</label>
            <input type="email" name="st_email" id="input1" placeholder="Enter valid email" style="width:200px"/>
      </div>
	  
	  <div class="form-group">
          <label for="input1" >Password</label>
            <input type="password" name="st_password"  id="input1" placeholder="Enter Password" style="width:200px"//>
      </div>
	  
      <button type="submit" value="Add Student" name="std" style="width:80px">Add Student</button>
    </form>

  </div>
  
  <div class="column" id="teacher">
  

       <form method="post">
        <h4>Add Teacher's Information</h4>
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Teacher ID</label>
            <input type="text" name="tc_id" id="input1" placeholder="teacher's id" style="width:200px"/>
      </div>

      <div class="form-group">
          <label for="input1" >Name</label>
            <input type="text" name="tc_name" id="input1" placeholder="teacher full name" style="width:200px"/>
      </div>

      <div class="form-group">
          <label for="input1" >Department</label>
            <input type="text" name="tc_dept" id="input1" placeholder="department ex. CSE" style="width:200px"/>
      </div>

      <div class="form-group">
          <label for="input1">Email</label>
            <input type="email" name="tc_email" id="input1" placeholder="valid email" style="width:200px"/>
      </div>

      <div class="form-group">
          <label for="input1">Subject Name</label>
            <input type="text" name="tc_course" id="input1" placeholder="subject ex. Software Engineering" style="width:200px"/>
      </div>
	  
	  <div class="form-group">
          <label for="input1" >Password</label>
            <input type="password" name="tc_password" id="input1" placeholder="Enter Password" style="width:200px"/>
      </div>

      <button type="submit" value="Add Teacher" name="tcr" style="width:80px">Add Teacher</button>
    </form>
    
  </div>
</div>

</div><br>
<!-- Contents, Tables, Forms, Images ended -->

</center>
</body>
<!-- Body ended  -->
</html>

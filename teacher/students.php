<?php
    ob_start();
    session_start();

    if($_SESSION['name']!='oasis')
    {
        header('location: ../login.php');
    }
    include('connect.php');
?>

<!DOCTYPE html>

<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main1.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
</head>

<body>
	<?php
		include ('../includes/header.php');
    ?>
    <div class="container">
        <div class="col-xs-1">
        </div>
        <div class="col-xs-10 banner_image">
            <div class="inner row">
                <div class="col-xs-3">
                    <div class="vertical_menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a style="background-color: #4caf50;" href="students.php">Students</a></li>
                                <li><a href="teachers.php">Faculties</a></li>
                                <li><a href="attendance.php">Attendance</a></li>
                                <li><a href="report.php">Report</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content3">
                            <div class="row">
                                <h2>Student List</h2>
                                <br>
                                <form method="post" action="">
                                    <label>Batch</label>
                                    <input type="text" name="sr_batch">
                                    <button type="submit" name="sr_btn" value="Search" ><i class="fa fa-search"></i></button>
                                </form>
                                <br>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="student_table table-striped" style="color : green;" overflow=presentation>
                                    
                                        <thead>
                                            <tr>
                                            <th id="tr1" scope="col">Registration No.</th>
                                            <th id="tr1" scope="col">Name</th>
                                            <th id="tr1" scope="col">Batch</th>
                                            <th id="tr1" scope="col">Semester</th>
                                            <th id="tr1" scope="col">Email</th>
                                            </tr>
                                        </thead>

                                    <?php

                                        if(isset($_POST['sr_btn']))
                                        {
                                        
                                            $srbatch = $_POST['sr_batch'];
                                            $i=0;
                                            
                                            $dept=$_SESSION['dept']; 
                                            $all_query = mysqli_query($con,"select * from students where students.st_batch = '$srbatch' and students.st_dept='$dept' order by st_id asc ");
                                            
                                            while ($data = mysqli_fetch_array($all_query)) 
                                            {
                                            $i++;
                                        
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td id="tr2"><?php echo $data['st_id']; ?></td>
                                                <td id="tr2"><?php echo $data['st_name']; ?></td>
                                                <td id="tr2"><?php echo $data['st_batch']; ?></td>
                                                <td id="tr2"><?php echo $data['st_sem']; ?></td>
                                                <td id="tr2"><?php echo $data['st_email']; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php 
                                            } 
                                        }
                                        ?>
                                        
                                    </table>
                                </div>

                                    










                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1">
        </div>
    </div>

	<?php
		include ('../includes/footer.php');
	?>
</body>

</html>

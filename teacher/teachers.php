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
                                <li><a href="students.php">Students</a></li>
                                <li><a style="background-color: #4caf50;" href="teachers.php">Faculties</a></li>
                                <li><a href="attendance.php">Attendance</a></li>
                                <li><a href="report.php">Report</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content3">
                            <div class="row">
                                <h2>Faculties List</h2>
                                <br>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="student_table table-striped" style="color : green;" overflow=presentation>
                                    
                                        <thead>
                                            <tr>
                                            <th id="tr1" scope="col">Teacher ID</th>
                                            <th id="tr1" scope="col">Name</th>
                                            <th id="tr1" scope="col">Department</th>
                                            <th id="tr1" scope="col">Course</th>
                                            <th id="tr1" scope="col">Email</th>
                                            </tr>
                                        </thead>

                                    <?php

                                        $i=0;
                                        $tcr_query = mysqli_query($con,"select * from teachers order by tc_id asc");
                                        while($tcr_data = mysqli_fetch_array($tcr_query))
                                        {
                                            $i++; 
                                        
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td id="tr2"><?php echo $tcr_data['tc_id']; ?></td>
                                                <td id="tr2"><?php echo $tcr_data['tc_name']; ?></td>
                                                <td id="tr2"><?php echo $tcr_data['tc_dept']; ?></td>
                                                <td id="tr2"><?php echo $tcr_data['tc_course']; ?></td>
                                                <td id="tr2"><?php echo $tcr_data['tc_email']; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php 
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

<?php
    ob_start();
    session_start();
    
    if($_SESSION['name']!='oasis')
    {
      header('location: ../index.php');
    }
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
                                <li><a style="background-color: #4caf50;" href="index.php">Home</a></li>
                                <li><a href="students.php">Students</a></li>
                                <li><a href="teachers.php">Faculties</a></li>
                                <li><a href="attendance.php">Attendance</a></li>
                                <li><a href="report.php">Report</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content1">
                        <h3>One step solution for your class room.</h3>
                        <br>
                        <img src="img/tcrl.png" height="200px" width="300px" />
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

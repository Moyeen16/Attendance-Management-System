<?php
    /*
    ob_start();
    session_start();
    if($_SESSION['name']!='oasis')
    {
        header('location: ../index.php');
    }*/
    include('connect.php');
?>

<!DOCTYPE html>

<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main1.css">
    <link rel="stylesheet" href="../css/style.css">
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
                                <li><a href="report.php">My Report</a></li>
                                <li><a href="account.php">My Account</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content1">
                        <!--<h3>Be attentive and be regular</h3>
                        <br>
                        <img src="../img/tcr.png" height="200px" width="300px" />-->
                        
                        <div class="table-wrapper-scroll-y my-custom-scrollbar2">
                            <?php
                                session_start();
                                $st=$_SESSION['email'];
                                $res=mysqli_query($con,"select st_id,st_dept,st_sem from students where st_email='$st'");
                                $q=mysqli_fetch_array($res);
                                $_SESSION['id']=$q['st_id'];
                                $id=$_SESSION['id'];
                                $dept=$q['st_dept'];
                                $sem=$q['st_sem'];
                                $res=mysqli_query($con,"select c_name from courses where c_dept='$dept' and c_sem='$sem'");
                                while ($data = mysqli_fetch_array($res)) 
                                {
                                    $count_pre = 0;
                                    $course=$data['c_name'];
                                    $all_query = mysqli_query($con,"select stat_id,count(*) as countP from attendance where attendance.stat_id='$id' and attendance.course = '$course' and attendance.st_status='Present'");
                                    $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.stat_id='$id' and attendance.course = '$course'");
                                    $count_tot;
                                    if ($row=mysqli_fetch_row($singleT))
                                    {
                                        $count_tot=$row[0];
                                    }
                                    $i=0;
                                    while ($data1 = mysqli_fetch_array($all_query)) 
                                    {
										$i++;
                                        if($i <= 1)
                                        {
                                            if($count_tot==0)	
                                                $perc=0;
                                            else
                                                $perc=round(($data1[1]/$count_tot)*100);

                                            echo '<div>
                                                    <p style="font-size:2rem;">'.$course.'</p>
                                                    <div class="progress-bar-success progress-bar-striped active" role="progressbar"
                                                        aria-valuenow="'.$perc.'" aria-valuemin="0" aria-valuemax="100" style="color:2px black;border:2px solid green;width:'.$perc.'%">'.$perc.'%
                                                    </div><br>
                                                </div>';
                                        }
                                    }
                                }
                            
                            ?>
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

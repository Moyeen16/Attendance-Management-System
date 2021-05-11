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
                                <li><a href="teachers.php">Faculties</a></li>
                                <li><a href="attendance.php">Attendance</a></li>
                                <li><a style="background-color: #4caf50;"  href="report.php">Report</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content3">
                            <div class="row">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar2">
                                    <h2>Individual Report</h2>
                                    <br>
                                    <form method="post" action="">

                                        <label>Select Subject</label>
                                        <select name="whichcourse">
                                        
                                            <?php
                                                $tc=$_SESSION['email'];
                                                $res=mysqli_query($con,"select tc_course from teachers where tc_email='$tc'");
                                                while ($data = mysqli_fetch_array($res)) 
                                                {
                                                $i++;
                                                    echo('<option value="'.$data['tc_course'].'">'.$data['tc_course'].'</option>');
                                                }
                                            ?>
                                            
                                        </select>

                                        <label>Student Reg. No.</label>
                                        <input type="text" name="sr_id">
                                        <input type="submit" name="sr_btn" value="Search" >

                                    </form>
                                    

                                    
                                        <table class="table " style="color : green; font-weight: bold;">

                                            <?php

                                                //checking the form for ID
                                                if(isset($_POST['sr_btn'])){

                                                //initializing ID 
                                                $sr_id = $_POST['sr_id'];
                                                $course = $_POST['whichcourse'];
                                                
                                                $i=0;
                                                $count_pre = 0;
                                                
                                                //query for searching respective ID
                                                //  $all_query = mysql_query("select * from reports where reports.st_id='$sr_id' and reports.course = '$course'");
                                                //  $count_tot = mysql_num_rows($all_query);
                                                $all_query = mysqli_query($con,"select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
                                                $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
                                                $count_tot;
                                                if ($row=mysqli_fetch_row($singleT))
                                                {
                                                $count_tot=$row[0];
                                                }

                                                while ($data = mysqli_fetch_array($all_query)) {
                                                $i++;
                                                //  if($data['st_status'] == "Present"){
                                                //     $count_pre++;
                                                //  }
                                                if($i <= 1){
                                                ?>
                                                    

                                                <tbody>
                                                    <tr>
                                                        <td>Course Name : </td>
                                                        <td><?php echo $course; ?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Total Class (Days): </td>
                                                        <td><?php echo $count_tot; ?> </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Present (Days): </td>
                                                        <td><?php echo $data[1]; ?> </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td>Absent (Days): </td>
                                                        <td><?php echo $count_tot -  $data[1]; ?> </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td> Attendance Percentage : </td>
                                                        <td><?php echo round(($data[1]/$count_tot)*100); ?>% </td>
                                                    </tr>

                                                </tbody>

                                            <?php

                                                }  
                                                }}
                                                ?>
                                        </table>
                                    








                                    
                                    <h2>Class Report</h2>

                                    <br>
                                    <form method="post" action="">

                                        <label>Select Subject</label>
                                        <select name="course">
                                        
                                        <?php
                                            $tc=$_SESSION['email'];
                                            $res=mysqli_query($con,"select tc_course from teachers where tc_email='$tc'");
                                            while ($data = mysqli_fetch_array($res)) 
                                            {
                                            $i++;
                                                echo('<option value="'.$data['tc_course'].'">'.$data['tc_course'].'</option>');
                                            }
                                        ?>
                                        </select>
                                        <label>Date ( yyyy-mm-dd )</label>
                                        <input type="text" name="date">
                                        <label>Attendance below(%):</label>
                                        <input type="number" name="perc"><br>
                                        <input type="submit" name="sr_date" value="Search" >
                                    </form>
                                
                                    <?php

                                        if(isset($_POST['sr_btn']))
                                        {

                                        $sr_id = $_POST['sr_id'];
                                        $course = $_POST['whichcourse'];

                                        $single = mysqli_query($con,"select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
                                        //$id=$single['stat_id'] ;
                                        $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
                                        //  $count_tot = mysql_num_rows($singleT);
                                        if (!$single) 
                                        {
                                            printf("Error: %s\n", mysqli_error($con));
                                            exit();
                                        }
                                        if (!$singleT) 
                                        {
                                            printf("Error: %s\n", mysqli_error($con));
                                            exit();
                                        }
                                        } 

                                        if(isset($_POST['sr_date']))
                                        {

                                        $sdate = $_POST['date'];
                                        $course = $_POST['course'];
                                        
                                        if(empty($_POST['perc']))
                                        {
                                            $all_query = mysqli_query($con,"select * from attendance where attendance.stat_date='$sdate' and attendance.course = '$course'");
                                            if (!$all_query) 
                                            {
                                                printf("Error: %s\n", mysqli_error($con));
                                                exit();
                                            }

                                    ?>
                                    <table class="table table-stripped" style="color : green;">
                                        <thead>
                                            <tr>
                                            <th scope="col">Reg. No.</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Attendance Status</th>
                                            </tr>
                                        </thead>
                                    
                                        <?php
                                            $i=0;
                                            while ($data = mysqli_fetch_array($all_query)) 
                                            {
                                                $i++;
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $data['stat_id']; ?></td>
                                                    <td><?php echo $data['stat_date']; ?></td>
                                                    <td><?php echo $data['st_status']; ?></td>
                                                </tr>
                                            </tbody>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </table>

                                    <?php
                                        if(!empty($_POST['perc']))
                                        {
                                            $thresh=$_POST['perc'];
                                            $single = mysqli_query($con,"select stat_id,st_name,count(*) as countP from attendance,students where course = '$course' and st_status='Present' and attendance.stat_id=students.st_id group by stat_id");
                                            $singleT= mysqli_query($con,"select count(distinct stat_date) as countT from attendance where course = '$course'");
                                            $tot=0;
                                            if (!$singleT) 
                                            {
                                                printf("Error: %s\n", mysqli_error($con));
                                                exit();
                                            }
                                            if ($row=mysqli_fetch_row($singleT))
                                            {
                                                $tot=$row[0];
                                            }
                                            $i=0;
                                            $studs=array();
                                            $names=array();
                                            $percs=array();
                                            while ($data = mysqli_fetch_array($single)) 
                                            {
                                                $temp=$data[0];
                                                array_push($studs,$temp);
                                                $temp=$data[1];
                                                array_push($names,$temp);
                                                if($tot!=0)
                                                    $temp=($data[2]/$tot)*100;
                                                else
                                                    $temp=0;
                                                array_push($percs,$temp);
                                                $i++;
                                            }
                                            $extra=mysqli_query($con,"select DISTINCT stat_id,st_name from attendance,students where attendance.stat_id=students.st_id and stat_id not in (select stat_id from attendance where course='$course' and st_status='Present' group by stat_id)");
                                            while ($data = mysqli_fetch_array($extra)) 
                                            {
                                                $temp=$data[0];
                                                array_push($studs,$temp);
                                                $temp=$data[1];
                                                array_push($names,$temp);
                                                array_push($percs,0);
                                                $i++;
                                            }
                                            $j=0;
                                            if($j<$i)
                                            {
                                        ?>
                                        <table class="table table-stripped" style="color : green;">
                                            <thead>
                                                <tr>
                                                <th scope="col">Reg. No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Attendance Percentage</th>
                                                <th scope="col">Total classes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            }
                                            while($j<$i)
                                            {
                                                if($percs[$j]<=$thresh)
                                                {
                                            ?>
                                                <tr>
                                                    <td><?php echo $studs[$j]; ?></td>
                                                    <td><?php echo $names[$j]; ?></td>
                                                    <td><?php echo round($percs[$j]); ?></td>
                                                    <td><?php echo $tot; ?></td>
                                                </tr>
                                            <?php
                                                }
                                                $j=$j+1;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    <?php
                                        }
                                    }	
                                    ?>


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

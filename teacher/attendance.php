<?php
    ob_start();
    session_start();

    if($_SESSION['name']!='oasis')
    {
        header('location: ../login.php');
    }
    include('connect.php');
?>

<?php
    include('connect.php');
    try{  
		if(isset($_POST['att']))
		{
			$course = $_SESSION['course'];
			foreach ($_POST['st_status'] as $i => $st_status) 
			{
				$stat_id = $_POST['stat_id'][$i];
				$dp = date('Y-m-d');
				$course = $_SESSION['course'];
				$stat = mysqli_query($con,"insert into attendance(stat_id,course,st_status,stat_date) values('$stat_id','$course','$st_status','$dp')");
				$att_msg = "Attendance Recorded.";
			}
		}
	}
    catch(Execption $e)
    {
        $error_msg = $e->$getMessage();
	    echo $error_msg;
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
                                <li><a href="index.php">Home</a></li>
                                <li><a href="students.php">Students</a></li>
                                <li><a href="teachers.php">Faculties</a></li>
                                <li><a style="background-color: #4caf50;" href="attendance.php">Attendance</a></li>
                                <li><a href="report.php">Report</a></li>
                                <li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content3">
                            <div class="row">
                                <h2>Attendance for <?php echo date('d-m-Y'); ?></h2>
                                <center><p><?php if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p></center>
                                
                                <form action="" method="post" class="form-horizontal">

                                    <div class="form-group">
                                        <label>Enter Batch</label>
                                        <input type="text" name="whichbatch" id="input2" placeholder="">
                                    
                                        <label>Select Subject</label>
                                        <select name="whichcourse" id="input1">
                                        <?php
                                        
                                        $tc=$_SESSION['email'];
                                        $res=mysqli_query($con,"select tc_course from teachers where tc_email='$tc'");
                                        while ($data = mysqli_fetch_array($res)) 
                                        {
                                        $i++;
                                            
                                        
                                            echo('<option value="'.$data['tc_course'].'">'.$data['tc_course'].'</option>');
                                            ?>
                                        <?php 
                                        }
                                        ?>
                                        </select>
                                    </div>
                                        
                                    <button type="submit" value="Show" name="batch" style="size:2.5rem;font-size:10px">Show</button>
                                    
                                </form>
                                <br>
                                <?php
                                    if(isset($_POST['batch']))
                                    {
                                ?>
                                    
                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                        <table class="student_table table-striped" style="color : green; font-size:12px;" overflow=presentation>
                                        
                                            <thead>
                                                <tr>
                                                    <th id="tr1" scope="col">Reg. No.</th>
                                                    <th id="tr1" scope="col">Name</th>
                                                    <th id="tr1" scope="col">Department</th>
                                                    <th id="tr1" scope="col">Batch</th>
                                                    <th id="tr1" scope="col">Semester</th>
                                                    
                                                    <th id="tr1" scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
                                            
                                                <?php

                                                    $i=0;
                                                    $radio = 0;
                                                    $dept=$_SESSION['dept']; 
                                                    $_SESSION['course']=$_POST['whichcourse'];
                                                    $batch = $_POST['whichbatch'];
                                                    $all_query = mysqli_query($con,"select * from students where st_batch='$batch' and st_dept='$dept' order by st_id asc");

                                                    while ($data = mysqli_fetch_array($all_query)) 
                                                    {
                                                    $i++;
                                                    
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td id="tr2" ><?php echo $data['st_id']; ?> <input type="hidden" name="stat_id[]" value="<?php echo $data['st_id']; ?>"> </td>
                                                        <td id="tr2"><?php echo $data['st_name']; ?></td>
                                                        <td id="tr2"><?php echo $data['st_dept']; ?></td>
                                                        <td id="tr2"><?php echo $data['st_batch']; ?></td>
                                                        <td id="tr2"><?php echo $data['st_sem']; ?></td>
                                                        
                                                        
                                                        <td id="tr2">
                                                            <label>Present</label>
                                                            <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present" >
                                                            <label>Absent </label>
                                                            <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" checked>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php 
                                                        $radio++;
                                                    } 
                                                ?>
                                                </table>
                                                <button type="submit" value="Save" name="att">Save</button>
                                            </form>
                                        
                                    </div>

                                    <?php
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

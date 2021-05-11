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
						<li><a href="index.php">Home</a></li>
						<li><a href="students.php">Students</a></li>
						<li><a style="background-color: #4caf50;" href="report.php">My Report</a></li>
						<li><a href="account.php">My Account</a></li>
						<li><a href = "../logout.php"><span class = "glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </div>
                </div> 
                <div class="col-xs-9">
                    <div class="content1">
						<div class="row">
							<h2>Student Report</h2>
							<br>
							<div class="inner_table row">
								<form method="post" action="" class="form-horizontal">
									<div class="form-group">
										<label  for="input1" class="col-xs-5 control-label">Select Subject</label>
										<div class="col-xs-7">
											<select name="whichcourse" id="input1">
												<?php
													$st=$_SESSION['email'];
													$res=mysqli_query($con,"select st_id,st_dept,st_sem from students where st_email='$st'");
													$q=mysqli_fetch_array($res);
													session_start();
													$_SESSION['id']=$q['st_id'];
													$dept=$q['st_dept'];
													$sem=$q['st_sem'];
													$res=mysqli_query($con,"select c_name from courses where c_dept='$dept' and c_sem='$sem'");
													while ($data = mysqli_fetch_array($res)) 
													{
														$i++;
														echo('<option value="'.$data['c_name'].'">'.$data['c_name'].'</option>');
													}
												
												?>
											</select>
											<button type="submit" value="Search" name="sr_btn" style="margin-top:10px"><i class="fa fa-search"></i></button>	
										</div>
									</div>
								</form>
							</div>
							<form method="post" action="" class="form-horizontal">
								<table class="table table-striped" style="color : green">
									<?php
										//checking the form for ID
										if(isset($_POST['sr_btn'])){

										//initializing ID 
										$sr_id = $_SESSION['id'];
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
												<td><?php 
														if($count_tot==0)	
															echo (0);
														else
															echo round(($data[1]/$count_tot)*100); ?>% </td>
											</tr>

										</tbody>

									<?php

										}  
										}}
										?>
								</table>
							</form>










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

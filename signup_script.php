<?php
    //start of try block

    try
    {
        
        //establishing connection with db and things
        require 'connect.php';
        
        //checking login info into database
        //$userid = $_POST[userid];
        $password = $_POST['password'];
        $eid = $_POST['eid'];
        $name = $_POST['name'];
        //$mname = $_POST[mname];
        //$lname = $_POST[lname];
        //$dob = $_POST[dob];
        $dept = $_POST['dept'];
        $batch = $_POST['batch'];
        $sem = $_POST['semester'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        //$role = $_POST[type];
		$role = 'student';


        if($role == 'Teacher')
        {
            $row=0;
            $result=mysqli_query($con,"SELECT * FROM user INNER JOIN teacher ON user.email = teacher.tc_email WHERE user.email='$email'");
            $rowno=mysqli_num_rows($result);
            $row=mysqli_fetch_row($result);
            if($rowno!=0)
            {
                echo "User already exists.<br/>";
                echo "<a href='index.php'>Try again.</a>";
            }
            else
            {
                if(mysqli_query($con, "INSERT INTO teacher (tc_id, tc_name, tc_dept, tc_email, tc_course, tc_password) VALUES ( '$eid' , '$fname' , '$mname' , '$lname' , '$dept' , '$email' , '$dob' , $contact , '$userid')") )
                {
                    echo "New Teacher registered successfully";
                    echo "<a href='index.php'>Login.</a>"; 
                }
                else
                {
                    echo "Error1 signing up.<br/>";
                    echo "<a href='index.php'>Try again.</a>";
                }    
            }
        }
        else
        {
            $rowno = 0;
            $result=mysqli_query($con, "SELECT * FROM students WHERE st_id='$eid'");
            $rowno=mysqli_num_rows($result);
            $row=mysqli_fetch_row($result);
            if($rowno!=0)
            {
                echo "User already exists.<br/>";
                echo "<a href='index.php'>Try again.</a>";
            }
            else
            {
                if(mysqli_query($con, "INSERT INTO students (st_id, st_name, st_dept, st_batch, st_sem, st_email, st_password) VALUES ( '$eid' , '$name' , '$dept' , $batch , $sem , '$email' , '$password')") )
                {
                    echo "New Student registered successfully";
                    echo "<a href='index.php'>Login.</a>"; 
                }
                else
                {
					echo mysqli_error($con);
					echo "1 <br/>";
                    echo "Error signing up.<br/>";
                    echo "<a href='index.php'>Try again.</a>";
                }    
            }
        }
    }

    //end of try block
    catch(Exception $e)
    {
        $error_msg=$e->getMessage();
        echo "Error signing up.<br/>";
        echo "<a href='index.php'>Try again.</a>";
    }
    //end of try-catch
    

?>
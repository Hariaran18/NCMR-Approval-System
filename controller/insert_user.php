<?php
    include ("../config/dbconnection.php");
    session_start();

    if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {
        $username = $_POST['username'];
        $password2 = $_POST['password'];
        $password = md5($password2);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $emp_id = $_POST['emp_id'];
        $access = $_POST['access'];
        $role = $_POST['role'];

        // SQL Query
        $sql = "INSERT INTO user (username,password,name,email,emp_id,access,role) 
                    VALUES ('$username','$password','$name','$email','$emp_id','$access','$role')";
            
        if (mysqli_query($conn, $sql)) {

            // Insert Query of SQL & Notify via email
            $to         =   $email;
            $subject    =   "E-NCMR System Account has been created.";
            $txt        =   "Hi, " . $name . "\n\n"
                            . "Good day. Your account has been registered successfully. Below is your account details:-  " . "\n"
                            . "\n" . "Username = " . $username . "  "
                            . "\n" . "Password = " . $password2 . "\n"
                            . "\n" . "Please visit to the E-NCMR System at http://192.168.1.235:8088/ncmr. You can change your password under Name > Profile which located at top right side of the page."
                            . "\n\n" . "Thank you.";

            $headers = "From: autonav@wenteleng.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","25");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                mail($to,$subject,$txt,$headers);

            echo "<script>alert('Successful!');</script>";
?>
            <meta http-equiv="refresh" content="0; url=../view/manage_user.php"/>
<?php
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "!');</script>" ;
?>
                <meta http-equiv="refresh" content="0; url=../view/manage_user.php"/>
<?php
            }
        } else {
            include("../email/general/access_denied.php");
        }
    }

    mysqli_close($conn); // Closing Connection with Server
?>
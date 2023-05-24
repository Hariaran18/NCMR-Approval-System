<?php
    include ("../config/dbconnection.php");
    session_start();

    if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $emp_id = $_POST['emp_id'];
        $access = $_POST['access'];
        $role = $_POST['role'];

        // SQL Query
        $sql = "UPDATE user SET 
                name = '$name',
                email = '$email',
                access = '$access',
                role = '$role'
                WHERE `emp_id`= '$emp_id'";
            
        if (mysqli_query($conn, $sql)) {
            
            echo "<script>alert('Successful!');</script>";
?>
            <meta http-equiv="refresh" content="0; url=../view/manage_user.php"/>
<?php
        } else {
            echo "Error: " . mysqli_error($conn);
?>
            <meta http-equiv="refresh" content="0; url=../view/manage_user.php"/>
<?php
        }
    } else {
        include("../email/general/access_denied.php");
    }

    mysqli_close($conn); // Closing Connection with Server
?>
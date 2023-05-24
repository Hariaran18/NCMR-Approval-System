<?php
    include ("../config/dbconnection.php");
    session_start();

    if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {

        $emp_id = $_GET['emp_id'];

        // SQL Query
        $sql = "DELETE FROM user WHERE emp_id = '$emp_id'";

        echo "<pre>";
        print_r($sql);
            
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
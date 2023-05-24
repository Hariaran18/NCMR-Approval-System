<?php
    include ("../config/dbconnection.php");
    session_start();

    $username = $_SESSION['username'];

    if ($_POST){

        $current = $_POST['current_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        $curr_sql = "SELECT * FROM `user` WHERE username = '".$username."'";
        $qry = mysqli_query($conn,$curr_sql);
        $row = mysqli_fetch_assoc($qry);
        $curr_pass = $row['password'];

        if (md5($current) == $curr_pass){
            $n_pass = md5($new);
            $c_pass = md5($confirm);

            if ($n_pass == $c_pass){
                $sql = "UPDATE user SET 
                password = '$n_pass'
                WHERE `username`= '$username'";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('You password has been changed successfully! Please login to the system again. Thank you.');</script>";
                    session_destroy();
?>
            <meta http-equiv="refresh" content="0; url=../view/login.php"/>
<?php
                } else {
                    echo "<script>alert('Error : " . mysqli_error($conn) . "');</script>";
                }

            } else {
                echo "<script>alert('New Password and Confirmation Password DOES NOT MATCH!!!');</script>";
?>
            <meta http-equiv="refresh" content="0; url=../view/profile.php"/>
<?php
            }

        } else {
            echo "<script>alert('Old Password is INCORRECT!!!');</script>";
?>
            <meta http-equiv="refresh" content="0; url=../view/profile.php"/>
<?php
        }
    }

?>

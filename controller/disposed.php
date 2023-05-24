<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $disposed_by = $_POST['disposed_by'];
        $remark4 = $_POST['remark4'];
        $witnessed_by = $_SESSION['name'];
        $witnessed_email = $_SESSION['email'];
        $disposed_date = $today;
        $witnessed_date = $today;
        $form_state = $f_finance;

        // Image rename and storing
        $target_dir = "../src/images/";

        // Image 5
        $filetoupload5 = basename($_FILES["file5"]["name"]);
        if($filetoupload5 == "") {
            $newFileName5 = "";
        } else {
            $imageFileType5 = pathinfo($filetoupload5,PATHINFO_EXTENSION);
            $newFileName5 = $ncmr_no . '_img_5.'.$imageFileType5;
            $target_file5 = $target_dir . $newFileName5;
            $file5= $_FILES["file5"]["tmp_name"];

            if (move_uploaded_file($file5, $target_file5)) {
                echo "";
            } else {
                echo "";
            }
        }
        
        $approve_sql = "UPDATE form SET 
                        witnessed_by='$witnessed_by',
                        form_state='$form_state',
                        img_5='$newFileName5',
                        disposed_by='$disposed_by',
                        disposed_date='$disposed_date',
                        witnessed_date='$witnessed_date',
                        remark4='$remark4'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $form_finance_email = $form_sql['form_finance_email'];
            $finance_name = $form_sql['finance_name'];

            //Notify via email
            $to        =   $witnessed_email;
            $subject  =   "TESTING E-NCMR Form No ".$ncmr_no." has been Approved.";
            $txt       =   "Hi, ".$witnessed_by."\n\n"
                        . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Successfully Approved."
                        . "\n" . "This form has been sent to next apporval process."
                        . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                        . "\n\n" . "Thank you.";

            $to2        =   $form_finance_email;
            $subject2  =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, ".$finance_name."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$witnessed_by."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $headers = "From: test@test.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","00");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                mail($to,$subject,$txt,$headers);
            }

            include("../email/approve/approve_success.php");

        } else {

            $error_message = mysqli_error($conn);
            echo $error_message;
            include("../email/approve/approve_fail.php");

        }

        mysqli_close($conn); // Closing Connection with Server

    } else {

        include("../email/general/access_denied.php");

    }

?>
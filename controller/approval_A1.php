<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $comments4 = $_POST['comments4'];
        $ack_name = $_SESSION['name'];
        $ack_email = $_SESSION['email'];
        $ack_date = $today;
        $form_state = $f_rev;

        $approve_sql = "UPDATE form SET 
                        ack_name='$ack_name',
                        ack_date='$ack_date',
                        comments4='$comments4',
                        form_state='$form_state'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $form_rev_email = $form_sql['form_rev_email'];
            $review_name = $form_sql['review_name'];

            //Notify via email
            $to1        =   $ack_email;
            $to2        =   $form_rev_email;
            $subject1   =   "E-NCMR Form No ".$ncmr_no." has been Approved.";
            $subject2   =   "E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt1       =   "Hi, ".$ack_name."\n\n"
                            ."Good day. The E-NCMR Form no : ".$ncmr_no." has been Successfully Approved."
                            ."\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";
            $txt2       =   "Hi, ".$review_name."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Acknowledged & Approved by ".$ack_name."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $headers    =   "From: autonav@wenteleng.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","25");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                mail($to1,$subject1,$txt1,$headers);
                mail($to2,$subject2,$txt2,$headers);
            }

            // include("../email/approve/approve_success.php");

        } else {

            $error_message = mysqli_error($conn);
            // echo $error_message;
            // include("../email/approve/approve_fail.php");

        }

        mysqli_close($conn); // Closing Connection with Server

    } else {

        include("../email/general/access_denied.php");

    }

?>
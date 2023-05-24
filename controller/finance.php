<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $finance_date = $today;
        $form_state = $f_complete;
        $finance_name = $_SESSION['name']; 
        
        $approve_sql = "UPDATE form SET 
                        finance_date='$finance_date',
                        form_state='$form_state',
                        closed_date='$today'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $form_finance_email = $form_sql['form_finance_email'];
            $form_issue_email = $form_sql['form_issue_email'];
            $issuer_name = $form_sql['issued_name'];

            //Notify via email
            $to        =   $form_finance_email;
            $subject  =   "TESTING E-NCMR Form No ".$ncmr_no." is set to 'COMPLETED' Status.";
            $txt       =   "Hi, ".$finance_name."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved."
                            . "\n" . "This form is waiting to be closed by Issuer."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $to2        =   $form_issue_email;
            $subject2  =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting to be CLOSED.";
            $txt2       =   "Hi, ".$issuer_name."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$finance_name."."
                            . "\n" . "Please CLOSE the form as soon as possible."
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
                mail($to2,$subject2,$txt2,$headers);
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
<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $comments1 = $_POST['comments1'];
        $prod_mng = $_SESSION['name'];
        $production_email = $_SESSION['email'];
        $prod_mng_date = $today;
        $form_state = $f_reject;       
        
        $reject_sql = "UPDATE form SET 
                        prod_mng_date='$prod_mng_date',
                        form_state='$form_state',
                        comments1='$comments1'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $reject_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            
            $form_issue_email = $form_sql['form_issue_email'];
            $form_notify_email = $form_sql['form_notify_email'];
            $form_notify_email2 = $form_sql['form_notify_email2'];
            $form_notify_email3 = $form_sql['form_notify_email3'];
            $form_notify_email4 = $form_sql['form_notify_email4'];
            $form_ack_email = $form_sql['form_ack_email'];
            $form_rev_email = $form_sql['form_rev_email'];
            $qa_email = $form_sql['qa_email'];

            //Notify via email
            $to = $form_issue_email . ", " .  $form_notify_email . "," . $form_ack_email . "," . $form_rev_email . "," . $qa_email . "," . $production_email . ", " .  $form_notify_email2 . ", " .  $form_notify_email3 . ", " .  $form_notify_email4;
            $subject = "TESTING E-NCMR Form No ".$ncmr_no." REJECTED!.";
            $txt =  "Hi," . "\n\n"
                    . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been REJECTED by ".$prod_mng."."
                    ."\n" . "This form status has been set to REJECTED."
                    . "\n" . "For further information, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
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

        }
            
        else {
            $error_message = mysqli_error($conn);
        }

        mysqli_close($conn); // Closing Connection with Server

    } else {

        include("../email/general/access_denied.php");

    }

?>
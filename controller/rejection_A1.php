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
        $form_state = $f_reject;
        
        
        $reject_sql = "UPDATE form SET 
                        ack_name='$ack_name',
                        ack_date='$ack_date',
                        comments4='$comments4',
                        form_state='$form_state'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";                    
            
        if (mysqli_query($conn, $reject_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);

            $form_issue_email = $form_sql['form_issue_email'];
            $form_notify_email = $form_sql['form_notify_email'];
            $form_notify_email2 = $form_sql['form_notify_email2'];
            $form_notify_email3 = $form_sql['form_notify_email3'];
            $form_notify_email4 = $form_sql['form_notify_email4'];
            // $qa_email = $form_sql['qa_email'];

            //Notify via email
            $to = $form_issue_email . ", " .  $form_notify_email . "," . $form_ack_email . "," .  $form_notify_email2 . ", " .  $form_notify_email3 . ", " .  $form_notify_email4;
            $subject = "E-NCMR Form No ".$ncmr_no." REJECTED!.";
            $txt =  "Hi," . "\n\n"
                    . "Good day. The E-NCMR Form no : ".$ncmr_no." has been REJECTED by ".$ack_name."."
                    ."\n" . "This form status has been set to REJECTED."
                    . "\n" . "For further information, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                    . "\n\n" . "Thank you.";

            $headers = "From: autonav@wenteleng.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","25");
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
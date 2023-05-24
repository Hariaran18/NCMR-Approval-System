<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $comments3 = $_POST['comments3'];
        $cc_2 = $_POST['cc_2'];
        $cc_3 = $_POST['cc_3'];
        $dgm_gm = $_SESSION['name'];
        $dgm_gm_email = $_SESSION['email'];
        $dgm_gm_date = $today;

        if (($cc_2 == 0) && ($cc_3 == 0)) {
            $form_state = $f_dispose;
        } else if (($cc_2 == 0) && ($cc_3 == 1)) {
            $form_state = $f_doe;
        } else {
            $form_state = $f_custom;
        }  
        
        $approve_sql = "UPDATE form SET 
                        dgm_gm_date='$dgm_gm_date',
                        form_state='$form_state',
                        comments3='$comments3'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $logistic_usr = $form_sql['logistic_usr'];
            $logistic_email = $form_sql['logistic_email'];
            $safety_usr = $form_sql['safety_usr'];
            $safety_email = $form_sql['safety_email'];
            $qa_email = $form_sql['qa_email'];
            $qa_mng = $form_sql['qa_mng'];
            $issued_name = $form_sql['issued_name'];
            $form_issue_email = $form_sql['form_issue_email'];

            ///Notify via email
            $to2        =   $dgm_gm_email;
            $subject2   =   "TESTING E-NCMR Form No ".$ncmr_no." has been Approved.";
            $txt2       =   "Hi, ".$dgm_gm."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Successfully Approved."
                            . "\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $to5        =   $logistic_email;
            $subject5   =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt5       =   "Hi, ".$logistic_usr."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$dgm_gm."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $to6        =   $safety_email;
            $subject6   =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt6       =   "Hi, ".$safety_usr."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$dgm_gm."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $to7        =   $form_issue_email;
            $subject7   =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt7       =   "Hi, ".$issued_name."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$dgm_gm."."
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
                
                mail($to2,$subject2,$txt2,$headers);

                if($form_state == $f_custom) {
                    mail($to5,$subject5,$txt5,$headers);
                }
                if($form_state == $f_doe) {
                    mail($to6,$subject6,$txt6,$headers);
                }
                if($form_state == $f_dispose) {
                    mail($to7,$subject7,$txt7,$headers);
                }
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
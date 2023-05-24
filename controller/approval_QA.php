<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $comments2 = $_POST['comments2'];
        $qa_mng = $_SESSION['name'];
        $qa_email = $_SESSION['email'];
        $qa_mng_date = $today;
        $form_state = $f_dgm;       
        
        $approve_sql = "UPDATE form SET 
                        qa_mng_date='$qa_mng_date',
                        form_state='$form_state',
                        comments2='$comments2'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $dgm_gm = $form_sql['dgm_gm'];
            $dgm_gm_email = $form_sql['dgm_gm_email'];

            ///Notify via email
            $to1        =   $qa_email;
            $subject1   =   "TESTING E-NCMR Form No ".$ncmr_no." has been Approved.";
            $txt1       =   "Hi, ".$qa_mng."\n\n"
                            ."Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Successfully Approved."
                            ."\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $to2        =   $dgm_gm_email;
            $subject2   =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, ".$dgm_gm."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$qa_mng."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $headers    =   "From: test@test.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","00");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                mail($to1,$subject1,$txt1,$headers);
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
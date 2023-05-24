<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $comments5 = $_POST['comments5'];
        $review_name = $_SESSION['name'];
        $review_email = $_SESSION['email'];
        $review_date = $today;
        
        $sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
        $sql1 = mysqli_fetch_assoc($sql);

        if ($sql1['disposition_chk'] == "Write Off"){
            $form_state = $f_prodmng;
            $approve_sql = "UPDATE form SET 
                        review_name='$review_name',
                        review_date='$review_date',
                        comments5='$comments5',
                        form_state='$form_state'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
        } else {
            $form_state = $f_complete;
            $approve_sql = "UPDATE form SET 
                        review_name='$review_name',
                        review_date='$review_date',
                        form_state='$form_state',
                        comments5='$comments5',
                        closed_date='$today'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
        }        
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $production_email = $form_sql['production_email'];
            $prod_mng = $form_sql['prod_mng'];
            $form_issue_email = $form_sql['form_issue_email'];
            $issued_name = $form_sql['issued_name'];
            $form_ack_email = $form_sql['form_ack_email'];

            //Notify via email
            $to1        =   $review_email;
            $subject1   =   "TESTING E-NCMR Form No ".$ncmr_no." has been Approved.";
            $txt1       =   "Hi, ".$review_name."\n\n"
                            ."Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Successfully Approved."
                            ."\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";
                            
            $to2        =   $production_email;
            $subject2   =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, ".$prod_mng."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Reviewed & Approved by ".$review_name."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            //If completed
            $to4        =   $form_issue_email;
            $subject4  =   "TESTING E-NCMR Form No ".$ncmr_no." is waiting to be CLOSED.";
            $txt4       =   "Hi, ".$issued_name."\n\n"
                            . "Good day. The TESTING NCMR Form no : ".$ncmr_no." has been Approved by ".$review_name."."
                            . "\n" . "Please CLOSE the form as soon as possible."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr_test."
                            . "\n\n" . "Thank you.";

            $headers    =   "From: test@test.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","00");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                if($form_state == $f_prodmng){
                    mail($to1,$subject1,$txt1,$headers);
                    mail($to2,$subject2,$txt2,$headers);
                }
                if($form_state == $f_complete){
                    mail($to4,$subject4,$txt4,$headers);
                }
                
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
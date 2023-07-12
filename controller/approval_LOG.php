<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();
        
    if($_SESSION['role'] == "Approver"){

        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $logistic_usr = $_SESSION['name'];
        $logistic_email = $_SESSION['email'];
        $logistic_date = $today;
        $cc_3 = $_POST['cc_3'];

        // Image rename and storing
        $target_dir = "../src/images/";

        // Image 3
        $filetoupload3 = basename($_FILES["file3"]["name"]);
        if($filetoupload3 == "") {
            $newFileName3 = "";
        } else {
            $imageFileType3 = pathinfo($filetoupload3,PATHINFO_EXTENSION);
            $newFileName3 = $ncmr_no . '_img_3.'.$imageFileType3;
            $target_file3 = $target_dir . $newFileName3;
            $file3= $_FILES["file3"]["tmp_name"];

            if (move_uploaded_file($file3, $target_file3)) {
                echo '<script>alert("Photo Uploaded Successfully!")</script>';
            } else {
                echo '<script>alert("Photo Upload Failed! Please try again.")</script>';                
            }
        }

        if ($cc_3 == 1){
            $form_state = $f_doe;
        } else {
            $form_state = $f_complete;
        }
        
        $approve_sql = "UPDATE form SET 
                        logistic_date='$logistic_date',
                        form_state='$form_state',
                        img_3='$newFileName3'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $safety_email = $form_sql['safety_email'];
            $safety_usr = $form_sql['safety_usr'];
            $form_issue_email = $form_sql['form_issue_email'];
            $issued_name = $form_sql['issued_name'];

            ///Notify via email
            $to         =   $logistic_email;
            $subject    =   "E-NCMR Form No ".$ncmr_no." has been Submitted.";
            $txt        =   "Hi, ".$logistic_usr."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Successfully Submitted."
                            . "\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $to2        =   $safety_email;
            $subject2   =   "E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, ".$safety_usr."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Approved by ".$logistic_usr."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $to3        =   $form_issue_email;
            $subject3   =   "E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt3       =   "Hi, ".$issued_name."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Approved by ".$logistic_usr."."
                            ."\n" . "This form is waiting for your Approval to proceed further."
                            . "\n" . "To check the form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $headers = "From: autonav@wenteleng.com";

            if($_POST){
                ini_set("SMTP","test-com.mail.protection.outlook.com");
                ini_set("smtp_port","25");
                ini_set("auth_username" , "test@test.com");
                ini_set("auth_password" , "test1234");
                ini_set("sendmail_from" , "test@test.com");

                mail($to,$subject,$txt,$headers);

                if($form_state == $f_doe) {
                    mail($to2,$subject2,$txt2,$headers);
                }
                if($form_state == $f_complete) {
                    mail($to3,$subject3,$txt3,$headers);
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
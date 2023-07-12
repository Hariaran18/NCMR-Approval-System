<?php
    include ("../config/dbconnection.php");
    include ("../config/config.php");
    session_start();

    if($_SESSION['role'] == "Approver"){
        
        $today = date('Y-m-d');

        $ncmr_no = $_POST['ncmr_no'];
        $safety_usr = $_SESSION['name'];
        $safety_email = $_SESSION['email'];
        $safety_date = $today;
        $form_state = $f_dispose;

        // Image rename and storing
        $target_dir = "../src/images/";

        // Image 4
        $filetoupload4 = basename($_FILES["file4"]["name"]);
        if($filetoupload4 == "") {
            $newFileName4 = "";
        } else {
            $imageFileType4 = pathinfo($filetoupload4,PATHINFO_EXTENSION);
            $newFileName4 = $ncmr_no . '_img_4.'.$imageFileType4;
            $target_file4 = $target_dir . $newFileName4;
            $file4= $_FILES["file4"]["tmp_name"];

            if (move_uploaded_file($file4, $target_file4)) {
                echo "";
            } else {
                echo "";
            }
        }
        
        $approve_sql = "UPDATE form SET 
                        safety_date='$safety_date',
                        form_state='$form_state',
                        img_4='$newFileName4'
                        
                        WHERE `ncmr_no`= '$ncmr_no'";
            
        if (mysqli_query($conn, $approve_sql)) {

            $fm_sql = mysqli_query($conn,"SELECT * FROM form WHERE ncmr_no = '$ncmr_no'");
            $form_sql = mysqli_fetch_assoc($fm_sql);
            $form_issue_email = $form_sql['form_issue_email'];
            $issued_name = $form_sql['issued_name'];

            //Notify via email
            $to         =   $safety_email;
            $subject    =   "E-NCMR Form No ".$ncmr_no." has been Submitted.";
            $txt        =   "Hi, ".$safety_usr."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Successfully Submitted."
                            . "\n" . "This form has been sent to next apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $to2        =   $form_issue_email;
            $subject2  =   "E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, ".$issued_name."\n\n"
                            . "Good day. The E-NCMR Form no : ".$ncmr_no." has been Approved by ".$safety_usr."."
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
<?php
    include ("../config/dbconnection.php");
    session_start();

    if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
        $issue_date = $_POST['issue_date'];//
        // $ncmr_no = $_POST['ncmr_no'];//
        $lot_qty = $_POST['lot_qty'];//
        $job_no = $_POST['job_no'];//
        $do_no = $_POST['do_no'];//
        $customer_ref_no = $_POST['customer_ref_no'];//
        $rejection_name = $_POST['rejection_name'];//
        $dept_name = $_POST['dept_name'];//
        $operator_no = $_POST['operator_no'];//
        $reject_class_other = $_POST['reject_class_other'];//
        $part_no = $_POST['part_no'];//
        $nc_qty = $_POST['nc_qty'];//
        $detected_at = $_POST['detected_at'];//
        $defect_desc = $_POST['defect_desc'];//
        $defect_cat = $_POST['defect_cat'];//
        $rtv_prn_no = $_POST['rtv_prn_no'];//
        $remark1 = $_POST['remark1'];//
        $sort_rework = $_POST['sort_rework'];//
        $accept_pcs = $_POST['accept_pcs'];//
        $reject_pcs = $_POST['reject_pcs'];//
        $checked_by = $_POST['checked_by'];//
        $remark2 = $_POST['remark2'];//
        $car_scar_no = $_POST['car_scar_no'];//
        $replacement_qty = $_POST['replacement_qty'];//
        $remark3 = $_POST['remark3'];//
        $issued_name = $_POST['issued_name'];//
        $issued_date = $_POST['issued_date'];//
        $ack_name = $_POST['ack_name'];//
        // $ack_date = $_POST['ack_date'];//
        $review_name = $_POST['review_name'];//
        // $review_date = $_POST['review_date'];//
        $form_state = $_POST['form_state'];//
        $corrective_sel = $_POST['corrective_sel'];//
        $replacement_sel = $_POST['replacement_sel'];//
        $rejection_chk = $_POST['reject_type_opt'];//
        $classification_chk = $_POST['classification_chk'];//
        $disposition_chk = $_POST['disposition_chk'];//
        $notify_usr = $_POST['notify_usr'];//
        $notify_usr2 = $_POST['notify_usr2'];//
        $notify_usr3 = $_POST['notify_usr3'];//
        $notify_usr4 = $_POST['notify_usr4'];//
        $ack_usr = $_POST['ack_usr'];//
        $rev_usr = $_POST['rev_usr'];//
        $erp_part_no = $_POST['erp_part_no'];//
        $erp_qty = $_POST['erp_qty'];//
        $loc_bin_code = $_POST['loc_bin_code'];//
        $unit = $_POST['unit'];//

        if (!empty($_POST['wo_type_chk'])) {
            $wo_type_chk = $_POST['wo_type_chk'];
        } else{
            $wo_type_chk = "NULL";
        }
        if (empty($_POST['wo_type_sel'])) {
            $wo_type_sel = "NULL";
        } else{
            $wo_type_sel = $_POST['wo_type_sel'];//
        }
        if (empty($_POST['cc_1'])) {
            $cc_1 = 0;
        } else{
            $cc_1 = $_POST['cc_1'];//
        }
        if (empty($_POST['cc_2'])) {
            $cc_2 = 0;
        } else{
            $cc_2 = $_POST['cc_2'];//
        }
        if (empty($_POST['cc_3'])) {
            $cc_3 = 0;
        } else{
            $cc_3 = $_POST['cc_3'];//
        }
        if (empty($_POST['cc_4'])) {
            $cc_4 = 0;
        } else{
            $cc_4 = $_POST['cc_4'];//
        }
        if (empty($_POST['wo_material'])) {
            $wo_material = "";
        } else{
            $wo_material = $_POST['wo_material'];//
        }
        $cc_4_others = $_POST['cc_4_others'];//
        $size_x = $_POST['size_x'];//
        $size_y = $_POST['size_y'];//
        $wo_thick = $_POST['wo_thick'];//
        $wo_cost = $_POST['wo_cost'];
        $prod_mng = $_POST['prod_mng'];
        $qa_mng = $_POST['qa_mng'];
        $dgm_gm = $_POST['dgm_gm'];
        
        if (empty($_POST['logistic_usr'])) {
            $logistic_usr = "";
        } else{
            $logistic_usr = $_POST['logistic_usr'];//
        }
        if (empty($_POST['safety_usr'])) {
            $safety_usr = "";
        } else{
            $safety_usr = $_POST['safety_usr'];//
        }
        
        $witnessed_by = $_SESSION['name'];
        $finance_name = $_POST['finance_name'];

        // Get NCMR No
        $zb = mysqli_query($conn,"SELECT * FROM `form` ORDER BY `ncmr_no` DESC limit 1");
        $vb = mysqli_fetch_assoc($zb);
        $rt = $vb['ncmr_no'];
        $ncmr_no= $rt+1;
        if($rt=''){
            $ncmr_no= 1;
        }

        // Get email from user table
        $ack = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$ack_usr."'");
        $ack_vb = mysqli_fetch_assoc($ack);
        $rev = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$rev_usr."'");
        $rev_vb = mysqli_fetch_assoc($rev);
        $notify = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$notify_usr."'");
        $notify_vb = mysqli_fetch_assoc($notify);
        $notify2 = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$notify_usr2."'");
        $notify_vb2 = mysqli_fetch_assoc($notify2);
        $notify3 = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$notify_usr3."'");
        $notify_vb3 = mysqli_fetch_assoc($notify3);
        $notify4 = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$notify_usr4."'");
        $notify_vb4 = mysqli_fetch_assoc($notify4);

        $prod = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$prod_mng."'");
        $prod_vb = mysqli_fetch_assoc($prod);
        $qa = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$qa_mng."'");
        $qa_vb = mysqli_fetch_assoc($qa);
        $dgm = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$dgm_gm."'");
        $dgm_vb = mysqli_fetch_assoc($dgm);
        $log = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$logistic_usr."'");
        $log_vb = mysqli_fetch_assoc($log);
        $safety = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$safety_usr."'");
        $safety_vb = mysqli_fetch_assoc($safety);
        $finance = mysqli_query($conn,"SELECT * FROM `user` WHERE `name` = '".$finance_name."'");
        $finance_vb = mysqli_fetch_assoc($finance);

        // Store email to use in sql query
        $form_issue_email = $_SESSION['email'];//
        $form_notify_email = $notify_vb['email'];//

        $form_notify_email2 = $notify_vb2['email'];//

        $form_notify_email3 = $notify_vb3['email'];//

        $form_notify_email4 = $notify_vb4['email'];//

        $form_ack_email = $ack_vb['email'];//
        $form_rev_email = $rev_vb['email'];//
        $production_email = $prod_vb['email'];
        $qa_email = $qa_vb['email'];
        $dgm_gm_email = $dgm_vb['email'];
        $logistic_email = $log_vb['email'];
        $safety_email = $safety_vb['email'];
        $form_finance_email = $finance_vb['email'];

        // Image rename and storing
        $target_dir = "../src/images/";

        // Image 1
        $filetoupload1 = basename($_FILES["file1"]["name"]);
        if($filetoupload1 == "") {
            $newFileName1 = "";
        } else {
            $imageFileType1 = pathinfo($filetoupload1,PATHINFO_EXTENSION);
            $newFileName1 = $ncmr_no . '_img_1.'.$imageFileType1;
            $target_file1 = $target_dir . $newFileName1;
            $file1= $_FILES["file1"]["tmp_name"];

            if (move_uploaded_file($file1, $target_file1)) {
                echo "";
            } else {
                echo "";
            }
        }
        // Image 2
        $filetoupload2 = basename($_FILES["file2"]["name"]);
        if($filetoupload2 == "") {
            $newFileName2 = "";
        } else {
            $imageFileType2 = pathinfo($filetoupload2,PATHINFO_EXTENSION);
            $newFileName2 = $ncmr_no . '_img_2.'.$imageFileType2;
            $target_file2 = $target_dir . $newFileName2;
            $file2= $_FILES["file2"]["tmp_name"];

            if (move_uploaded_file($file2, $target_file2)) {
                // echo "The file ". $newFileName2. " has been uploaded.";
                echo "";
            } else {
                // echo "Sorry, there was an error uploading your file.<br>";
                echo "";
            }
        }

        // SQL Query
        $sql = "INSERT INTO form (issue_date,ncmr_no,lot_qty,job_no,do_no,customer_ref_no,dept_name,operator_no,reject_class_other,part_no,nc_qty,
                    detected_at,defect_desc,rtv_prn_no,remark1,sort_rework,accept_pcs,reject_pcs,checked_by,remark2,car_scar_no,replacement_qty,
                    remark3,issued_name,issued_date,ack_name,review_name,form_state,corrective_sel,replacement_sel,rejection_chk,classification_chk,disposition_chk,
                    notify_usr,notify_usr2,notify_usr3,notify_usr4,ack_usr,rev_usr,form_issue_email,
                    form_notify_email,form_notify_email2,form_notify_email3,form_notify_email4,form_ack_email,form_rev_email,img_1,img_2,
                    defect_cat,rejection_name,erp_part_no,erp_qty,loc_bin_code,wo_type_chk,wo_type_sel,
                    cc_1,cc_2,cc_3,cc_4,cc_4_others,wo_material,size_x,size_y,wo_thick,wo_cost,prod_mng,qa_mng,
                    dgm_gm,logistic_usr,safety_usr,witnessed_by,production_email,qa_email,dgm_gm_email,logistic_email,safety_email,
                    finance_name, form_finance_email,witness_email,unit) 
                    VALUES ('$issue_date','$ncmr_no','$lot_qty','$job_no','$do_no','$customer_ref_no','$dept_name','$operator_no','$reject_class_other','$part_no','$nc_qty',
                    '$detected_at','$defect_desc','$rtv_prn_no','$remark1','$sort_rework','$accept_pcs','$reject_pcs','$checked_by','$remark2','$car_scar_no','$replacement_qty',
                    '$remark3','$issued_name','$issued_date','$ack_usr','$rev_usr','$form_state','$corrective_sel','$replacement_sel','$rejection_chk','$classification_chk',
                    '$disposition_chk','$notify_usr','$notify_usr2','$notify_usr3','$notify_usr4','$ack_usr','$rev_usr','$form_issue_email',
                    '$form_notify_email','$form_notify_email2','$form_notify_email3','$form_notify_email4','$form_ack_email','$form_rev_email','$newFileName1','$newFileName2',
                    '$defect_cat','$rejection_name','$erp_part_no','$erp_qty','$loc_bin_code','$wo_type_chk','$wo_type_sel',
                    '$cc_1','$cc_2','$cc_3','$cc_4','$cc_4_others','$wo_material','$size_x','$size_y','$wo_thick','$wo_cost','$prod_mng','$qa_mng',
                    '$dgm_gm','$logistic_usr','$safety_usr','$witnessed_by','$production_email','$qa_email','$dgm_gm_email','$logistic_email','$safety_email',
                    '$finance_name','$form_finance_email','$form_issue_email','$unit')";
            
        if (mysqli_query($conn, $sql)) {
            // Insert Query of SQL & Notify via email
            $to         =   $form_issue_email . ", " .  $form_notify_email . ", " .  $form_notify_email2 . ", " .  $form_notify_email3 . ", " .  $form_notify_email4;
            $subject    =   "New E-NCMR Form No ".$ncmr_no."  has been Created.";
            $txt        =   "Hi, " . "\n\n"
                            . "Good day. New NCMR Form no : ".$ncmr_no." has been created by " . $issued_name . "."
                            . "\n" . "This form has been sent to Apporval process."
                            . "\n" . "To check the status of this form, please visit the E-NCMR System at http://192.168.1.235:8088/ncmr."
                            . "\n\n" . "Thank you.";

            $to2        =   $form_ack_email;
            $subject2   =   "E-NCMR Form No ".$ncmr_no." is waiting for your Approval.";
            $txt2       =   "Hi, " . $ack_name . "\n\n"
                            . "Good day. The NCMR Form no : ".$ncmr_no." has been Created by " . $issued_name . "."
                            . "\n" . "This form is waiting for your Approval to proceed further."
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

            include("../email/insert/create_form_success.php");
?>
            <meta http-equiv="refresh" content="5; url=../view/list_view_pending.php"/>
<?php
        }
        else {
            include("../email/insert/create_form_fail.php");
?>
            <meta http-equiv="refresh" content="5; url=http://192.168.1.235:8088/ncmr/list_view_pending.php"/>
<?php
        }

    } else {
        include("../email/general/submit_error_message.php");
    }

    mysqli_close($conn); // Closing Connection with Server
?>

<?php
  include ("../config/dbconnection.php");
  include ("../config/config.php");
  include ("../config/navigationbar.php");

  if($_SESSION["role"] == "Approver") {

    $getid = $_GET['edit'];

    $seledittwo = "SELECT * FROM `form` WHERE ncmr_no = '".$getid."'";
    $qry = mysqli_query($conn,$seledittwo);

    $selassoc = mysqli_fetch_assoc($qry);

    $issue_date = $selassoc['issue_date'];
    $ncmr_no = $selassoc['ncmr_no'];
    $lot_qty = $selassoc['lot_qty'];
    $job_no = $selassoc['job_no'];
    $do_no = $selassoc['do_no'];
    $customer_ref_no = $selassoc['customer_ref_no'];
    $rejection_name = $selassoc['rejection_name'];
    $dept_name = $selassoc['dept_name'];
    $operator_no = $selassoc['operator_no'];
    $reject_class_other = $selassoc['reject_class_other'];
    $part_no = $selassoc['part_no'];
    $nc_qty = $selassoc['nc_qty'];
    $detected_at = $selassoc['detected_at'];
    $defect_desc = $selassoc['defect_desc'];
    $defect_cat = $selassoc['defect_cat'];
    $rtv_prn_no = $selassoc['rtv_prn_no'];
    $remark1 = $selassoc['remark1'];
    $sort_rework = $selassoc['sort_rework'];
    $accept_pcs = $selassoc['accept_pcs'];
    $reject_pcs = $selassoc['reject_pcs'];
    $checked_by = $selassoc['checked_by'];
    $remark2 = $selassoc['remark2'];
    $car_scar_no = $selassoc['car_scar_no'];
    $replacement_qty = $selassoc['replacement_qty'];
    $remark3 = $selassoc['remark3'];
    $issued_name = $selassoc['issued_name'];
    $issued_date = $selassoc['issued_date'];
    $ack_name = $selassoc['ack_name'];
    $ack_date = $selassoc['ack_date'];
    $review_name = $selassoc['review_name'];
    $review_date = $selassoc['review_date'];
    $form_state = $selassoc['form_state'];
    $corrective_sel = $selassoc['corrective_sel'];
    $replacement_sel = $selassoc['replacement_sel'];
    $rejection_chk = $selassoc['rejection_chk'];
    $classification_chk = $selassoc['classification_chk'];
    $disposition_chk = $selassoc['disposition_chk'];
    $notify_usr = $selassoc['notify_usr'];
    $ack_usr = $selassoc['ack_usr'];
    $rev_usr = $selassoc['rev_usr'];
    // $report_no = $selassoc['report_no'];
    $erp_part_no = $selassoc['erp_part_no'];
    $erp_qty = $selassoc['erp_qty'];
    $loc_bin_code = $selassoc['loc_bin_code'];
    $wo_type_chk = $selassoc['wo_type_chk'];
    $img_1 = $selassoc['img_1'];
    $img_2 = $selassoc['img_2'];
    $img_3 = $selassoc['img_3'];
    $img_4 = $selassoc['img_4'];
    $img_5 = $selassoc['img_5'];
    $img_path = "../src/images/";
    $wo_type_sel = $selassoc['wo_type_sel'];
    $cc_1 = $selassoc['cc_1'];
    $cc_2 = $selassoc['cc_2'];
    $cc_3 = $selassoc['cc_3'];
    $cc_4 = $selassoc['cc_4'];
    $cc_4_others = $selassoc['cc_4_others'];
    $wo_material = $selassoc['wo_material'];
    $size_x = $selassoc['size_x'];
    $size_y = $selassoc['size_y'];
    $wo_thick = $selassoc['wo_thick'];
    $wo_cost = $selassoc['wo_cost'];
    $prod_mng = $selassoc['prod_mng'];
    $prod_mng_date = $selassoc['prod_mng_date'];
    $qa_mng = $selassoc['qa_mng'];
    $qa_mng_date = $selassoc['qa_mng_date'];
    $dgm_gm = $selassoc['dgm_gm'];
    $dgm_gm_date = $selassoc['dgm_gm_date'];
    $logistic_usr = $selassoc['logistic_usr'];
    $logistic_date = $selassoc['logistic_date'];
    $safety_usr = $selassoc['safety_usr'];
    $safety_date = $selassoc['safety_date'];
    $disposed_by = $selassoc['disposed_by'];
    $disposed_date = $selassoc['disposed_date'];
    $comments1 = $selassoc['comments1'];
    $comments2 = $selassoc['comments2'];
    $comments3 = $selassoc['comments3'];
    $comments4 = $selassoc['comments4'];
    $comments5 = $selassoc['comments5'];
    $witnessed_by = $selassoc['witnessed_by'];
    $witnessed_date = $selassoc['witnessed_date'];
    $remark4 = $selassoc['remark4'];
    $finance_name = $selassoc['finance_name'];
    $finance_date = $selassoc['finance_date'];
    $unit = $selassoc['unit'];

    $usr = mysqli_query($conn,"SELECT `name` FROM `user` " );
?>

<html lang="en">
  <head>
    <title>E-NCMR SYSTEM - Approval</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      .image-box {
        width: 100%;
        height: 200px;
        border: 1px solid gray;
        text-align: center;
      }
      #preview1, #preview2, #preview3, #preview4, #preview5 {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: none;
      }
      .inactiveLink {
        pointer-events: none;
        cursor: default;
      }
    </style>
  </head>

  <body>
    <script src="../src/bootstrap/jquery-3.1.1.min.js"></script>
    <br>
    <div class="container">

      <?php if ($form_state == $f_ack) { ?>
          <h3 class="text-right"><span class="badge badge-primary">Pending Acknowledge</span></h3>
      <?php } else if ($form_state == $f_rev) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Review</span></h3>
      <?php } else if ($form_state == $f_prodmng) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending PM Approval</span></h3>
      <?php } else if ($form_state == $f_qamng) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending QA Approval</span></h3>
      <?php } else if ($form_state == $f_dgm) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending GM/DGM Approval</span></h3>
      <?php } else if ($form_state == $f_custom) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Logistic Approval</span></h3>
      <?php } else if ($form_state == $f_doe) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Safety Approval</span></h3>
      <?php } else if ($form_state == $f_dispose) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Disposal</span></h3>
      <?php } else if ($form_state == $f_finance) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Finance Approval</span></h3>
      <?php } else if ($form_state == $f_complete) { ?>
          <h3 class="text-right"><span class="badge badge-warning">Pending Close Form</span></h3>
      <?php } else if ($form_state == $f_close) { ?>
          <h3 class="text-right"><span class="badge badge-success">Completed</span></h3>
      <?php } else if ($form_state == $f_reject) { ?>
          <h3 class="text-right"><span class="badge badge-danger">Rejected</span></h3>
      <?php } ?>

      <div class="jumbotron">
        <div class="container col-md-6 text-center">
          <h1>E-NCMR SYSTEM</h1>
          <p >Non-Conforming Material Report</p>
        </div>
      </div>

      <hr width = 80%>
        <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="A. Non-Conforming (NC) Material Details" disabled>

        <br>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="date">Date</label>
              <input type="date" class="form-control" id="issue_date" name="issue_date" readonly value="<?php echo $issue_date; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="ncmr_no">NCMR Number</label>
              <input type="text" class="form-control" id="ncmr_no" name="ncmr_no" readonly value="<?php echo $ncmr_no; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="lot_qty">Lot Quantity</label>
              <input type="number" class="form-control" id="lot_qty" name="lot_qty" readonly value="<?php echo $lot_qty; ?>">
            </div>
          </div>
          <div class="col-md-3" style="display:none;">
            <div class="form-group">
              <label class="font-weight-bold" for="form_state">Form Status</label>
              <input type="text" class="form-control" id="form_state" name="form_state" readonly value="<?php echo $form_state; ?>">
            </div>
          </div>
        </div>

        <hr width = 80%>

        <div class="row">
          <div class="col">
            <div class="row h-100 ">
              <div class="col-12">
                <div class="h-100">
                  <label  class="font-weight-bold">Type of Rejection</label>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Internal" name="reject_type_opt" id="reject_type_opt" disabled="disabled"/>
                    <label>Internal</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Supplier" name="reject_type_opt" id="reject_type_opt" disabled="disabled"/>
                    <label>Supplier</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Customer" name="reject_type_opt" id="reject_type_opt" disabled="disabled"/>
                    <label>Customer</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="row">
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Job No</label>
                  <input type="text" class="form-control" id="job_no" name="job_no" disabled="disabled" value="<?php echo $job_no; ?>">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">DO No</label>
                  <input type="text" class="form-control" id="do_no" name="do_no" disabled="disabled" value="<?php echo $do_no; ?>">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Customer Reference No</label>
                  <input type="text" class="form-control" id="customer_ref_no" name="customer_ref_no" disabled="disabled" value="<?php echo $customer_ref_no; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="row">
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Department</label>
                  <input type="text" class="form-control" id="dept_name" name="dept_name" readonly value="<?php echo $dept_name; ?>">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Supplier/Customer Name</label>
                  <input type="text" class="form-control" id="rejection_name" name="rejection_name" disabled="disabled" value="<?php echo $rejection_name; ?>">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Operator No</label>
                  <input type="text" class="form-control" id="operator_no" name="operator_no" readonly value="<?php echo $operator_no; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="row">
          <div class="col-md-4">
            <label class="font-weight-bold">Classification of Rejection</label>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="Mass Production" name="classification_chk" disabled/>
              <label>Mass Production</label>
            </div>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="First Article" name="classification_chk" disabled/>
              <label>First Article</label>
            </div>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="Others" name="classification_chk" disabled/>
              <label>Others</label>
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <label class="font-weight-bold">Others</label>
              <input type="text" class="form-control" id="reject_class_other" name="reject_class_other" value="<?php echo $reject_class_other; ?>" readonly>
            </div>
          </div>
          <div class="col-md-4"\>
        </div>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="part_no">Part No</label>
              <input type="text" class="form-control" id="part_no" name="part_no" readonly value="<?php echo $part_no; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="nc_qty">NC Qty</label>
              <div class="input-group">
                <input type="number" class="form-control" id="nc_qty" name="nc_qty" readonly value="<?php echo $nc_qty; ?>">
                <div class="input-group-append">
                  <select class="form-control" name="unit" id="unit" disabled="true">
                    <option value="PCS" <?php if ($unit == "PCS") echo "selected"; ?>>PCS</option>
                    <option value="KG" <?php if ($unit == "KG") echo "selected"; ?>>KG</option>
                    <option value="LBS" <?php if ($unit == "LBS") echo "selected"; ?>>LBS</option>
                    <option value="L" <?php if ($unit == "L") echo "selected"; ?>>L</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="detected_at">Detected at</label>
              <input type="text" class="form-control" id="detected_at" name="detected_at" readonly value="<?php echo $detected_at; ?>">
            </div>
          </div>
        </div>
        <div class="container row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="defect_desc">Defect Description</label>
              <input type="text" class="form-control" id="defect_desc" name="defect_desc" readonly value="<?php echo $defect_desc; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="defect_cat">Defect Category</label>
              <input type="text" class="form-control" id="defect_cat" name="defect_cat" readonly value="<?php echo $defect_cat; ?>">
            </div>
          </div>
        </div>

        <div class="container row">
          <div class="col-md-4">
            <label class="font-weight-bold">Disposition</label>
            <br>
            <div class="checkbox" style="float:left;">
              <div>
                <input type="checkbox" class="disposition_opt" value="Use as Is" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>Use as Is</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Rework" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>Rework</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Write Off" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>Write Off</label>
              </div>
            </div>
            <div></div>
            <div class="checkbox" style="float:left; margin-left:20px;">
              <div>
                <input type="checkbox" class="disposition_opt" value="Exchange 1 to 1" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>Exchange 1 to 1</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Rejection from Store" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>Rejection from store</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="RTV, PRN No" id="disposition_chk" name="disposition_chk" disabled="disabled"/>
                <label>RTV, PRN No</label>
              </div>
            </div>
          </div>
          <div class="col-md-4" id="disp_others">
            <div>
              <label class="font-weight-bold">RTV/PRN No</label>
              <input type="text" class="form-control" id="rtv_prn_no" name="rtv_prn_no" readonly value="<?php echo $rtv_prn_no; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold">Remarks</label>
              <textarea class="form-control" id="remark1" name="remark1" readonly><?php echo $remark1; ?></textarea>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row">
          <table>
            <tr class="row">
              <td class="col">
                <label class="font-weight-bold">Defect Photo</label>
                <a id="preview1_img" class="inactiveLink" href="<?php echo $img_path . $img_1; ?>" target="_blank">Preview</a>
              </td>
              <td class="col">
                <?php
                  if ($img_2 == "" && $issued_name == $_SESSION["name"]) { ?>
                    
                    <form action="../controller/app_rework_photo.php" method="post" enctype="multipart/form-data">
                      <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
                      <label class="font-weight-bold">Rework Photo</label>
                      <input type="file" name="file2" id="file2" onchange="readURL2(this);"/>
                      <input class="btn btn-sm btn-primary float-right" type="submit" value="Upload">
                    </form>
                  
                  <?php } else { ?>
                    
                    <td class="col">
                      <label class="font-weight-bold">Rework Photo</label>
                      <a id="preview2_img" class="inactiveLink" href="<?php echo $img_path . $img_2; ?>" target="_blank">Preview</a>
                    </td>
                    
                <?php } ?>
              </td>
            </tr>
            <tr class="row">
              <td class="col">
                <div class="image-box">
                  <img id="preview1" style="display: none;" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                </div>
              </td>
              <td class="col">
                <div class="image-box">
                  <img id="preview2" style="display: none;" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                </div>
              </td>
            </tr>
          </table>
        </div>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="font-weight-bold">Sorting / Reworked By</label>
              <input type="text" class="form-control" id="sort_rework" name="sort_rework" readonly value="<?php echo $sort_rework; ?>">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label class="font-weight-bold">Accept</label>
              <input type="number" class="form-control" id="accept_pcs" name="accept_pcs" readonly value="<?php echo $accept_pcs; ?>">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label class="font-weight-bold">Reject</label>
              <input type="number" class="form-control" id="reject_pcs" name="reject_pcs" readonly value="<?php echo $reject_pcs; ?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="font-weight-bold">Checked By</label>
              <input type="text" class="form-control" id="checked_by" name="checked_by" readonly value="<?php echo $checked_by; ?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold">Remarks</label>
              <textarea class="form-control" id="remark2" name="remark2" readonly><?php echo $remark2; ?></textarea>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-3">
            <label class="font-weight-bold">Corrective action needed?</label>
            <input type="text" class="form-control" id="corrective_sel" name="corrective_sel" readonly value="<?php echo $corrective_sel; ?>">
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">CAR / SCAR No</label>
            <input type="text" class="form-control" id="car_scar_no" name="car_scar_no" value="<?php echo $car_scar_no; ?>" readonly>
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">Replacement needed?</label>
            <input type="text" class="form-control" id="replacement_sel" name="replacement_sel" readonly value="<?php echo $replacement_sel; ?>">
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">Quantity</label>
            <input type="number" class="form-control" id="replacement_qty" name="replacement_qty" value="<?php echo $replacement_qty; ?>" readonly>
          </div>
        </div>

        <div class="container row">
          <div class="form-group col-md-12">
            <label class="font-weight-bold">Remarks</label>
            <textarea class="form-control" id="remark3" name="remark3" readonly><?php echo $remark3; ?></textarea>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row gy-5">
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Issued By / Date</label>
            <input type="text" class="form-control" id="issued_name" name="issued_name" readonly value="<?php echo $issued_name; ?>"></input>
            <input type="date" class="form-control" id="issued_date" name="issued_date" readonly value="<?php echo $issued_date; ?>"></input>
          </div>
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Acknowledged By / Date</label>
            <input type="text" class="form-control" id="ack_name" name="ack_name" readonly value="<?php echo $ack_name; ?>"></input>
            <?php if ($ack_date != ""){ ?>
              <input type="date" class="form-control" id="ack_date" name="ack_date" value="<?php echo $ack_date; ?>" readonly></input>
            <?php } else {
              $value = "";
              if ($ack_name != "") {
                 $value = "Pending Approval";
              }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
            <?php } ?>
            <label class="font-weight-bold">Comments</label>
            <textarea class="form-control" id="comments4" name="comments4" <?php if(($_SESSION['name'] != $ack_name)||($form_state != $f_ack)){ echo "readonly";} ?>><?php echo $comments4; ?></textarea>
          </div>
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Reviewed By / Date</label>
            <input type="text" class="form-control" id="review_name" name="review_name" readonly value="<?php echo $review_name; ?>"></input>
            <?php if ($review_date != ""){ ?>
              <input type="date" class="form-control" id="review_date" name="review_date" value="<?php echo $review_date; ?>" readonly></input>
            <?php } else {
              $value = "";
              if ($review_name != "") {
                 $value = "Pending Approval";
              }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
            <?php } ?>
            <label class="font-weight-bold">Comments</label>
            <textarea class="form-control" id="comments5" name="comments5" <?php if(($_SESSION['name'] != $review_name)||($form_state != $f_rev)){ echo "readonly";} ?>><?php echo $comments5; ?></textarea>
          </div>
        </div>
        <br>
        <br>


        <!-- WRITE OFF FORM -->
        <!-- ______________________________________________________________________________________________________ -->
        <br>
        <div class="container" id="write_off_form" style="display:none;">
          <hr width = 80%>
          <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="B.	Write Off of Non-Conforming Material" disabled>
          <hr width = 80%>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold">ERP Part No</label>
                <input type="text" class="form-control" id="erp_part_no" name="erp_part_no" value="<?php echo $erp_part_no; ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold">Quantity</label>
                <input type="number" class="form-control" id="erp_qty" name="erp_qty" value="<?php echo $erp_qty; ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold">NAV Location Bin Code</label>
                <input type="text" class="form-control" id="loc_bin_code" name="loc_bin_code" value="<?php echo $loc_bin_code; ?>" readonly>
              </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label class="font-weight-bold">Report No</label>
                <input type="text" class="form-control" id="report_no" name="report_no" value="<?php echo $report_no; ?>" readonly>
              </div>
            </div> -->
          </div>
          <hr width = 80%>

          <div class="row">
            <div class="col-md-4">
              <label class="font-weight-bold">Type</label>
              <br>
              <div class="checkbox" style="float:left;">
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Indirect Material" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>Indirect Material</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Purchase Part" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>Purchase Part</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="WIP" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>WIP</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="FG" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>FG</label>
                </div>
              </div>
              <div></div>
              <div class="checkbox" style="float:left; margin-left:30px;">
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Rejection From Store" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>Rejection From Store</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Customer Rejection" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>Customer Rejection</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Supplier Rejection" id="wo_type_chk" name="wo_type_chk" disabled/>
                  <label>Supplier Rejection</label>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <label class="font-weight-bold">Purchase Part Type</label>
              <input type="text" class="form-control" id="wo_type_sel" name="wo_type_sel" value="<?php echo $wo_type_sel; ?>" readonly>
            </div>
            <div class="col-md-3">
              <label class="font-weight-bold">Compliance Clearance</label>
              <br>
              <div class="checkbox" style="float:left;">
                <div>
                  <input type="checkbox" value="1" id="cc_1" name="cc_1" disabled="disabled" $checked1/>
                  <label>Not Required</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_2" name="cc_2" disabled="disabled" $checked2/>
                  <label>Custom</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_3" name="cc_3" disabled="disabled" $checked3/>
                  <label>DOE</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_4" name="cc_4" disabled="disabled" $checked4/>
                  <label>Others</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label class="font-weight-bold">Others</label>
              <input class="form-control" type="text" id="cc_4_others" name="cc_4_others" value="<?php echo $cc_4_others; ?>" readonly/>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="col-md-4">
              <label class="font-weight-bold">Material</label>
              <input type="text" class="form-control" id="wo_material" name="wo_material" value="<?php echo $wo_material; ?>" readonly>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Size(x)</label>
                <input type="text" class="form-control" id="size_x" name="size_x" value="<?php echo $size_x; ?>" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Size(y)</label>
                <input type="text" class="form-control" id="size_y" name="size_y" value="<?php echo $size_y; ?>" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Thickness</label>
                <input type="text" class="form-control" id="wo_thick" name="wo_thick" value="<?php echo $wo_thick; ?>" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Total Cost (RM)</label>
                <input type="text" class="form-control" id="wo_cost" name="wo_cost" value="<?php echo $wo_cost; ?>" readonly>
              </div>
            </div>
          </div>

          <hr width = 80%>
          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by Production Manager</label>
              <input type="text" class="form-control" id="prod_mng" name="prod_mng" value="<?php echo $prod_mng; ?>" readonly>
              
              <?php if ($prod_mng_date != ""){ ?>
              <input type="date" class="form-control" id="prod_mng_date" name="prod_mng_date" value="<?php echo $prod_mng_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($prod_mng != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments1" name="comments1" <?php if($_SESSION['name'] != $prod_mng){ echo "readonly";} ?>><?php echo $comments1; ?></textarea>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by QA Manager</label>
              <input type="text" class="form-control" id="qa_mng" name="qa_mng" value="<?php echo $qa_mng; ?>" readonly>
              
              <?php if ($qa_mng_date != ""){ ?>
              <input type="date" class="form-control" id="qa_mng_date" name="qa_mng_date" value="<?php echo $qa_mng_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($qa_mng != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments2" name="comments2" <?php if($_SESSION['name'] != $qa_mng){ echo "readonly";} ?>><?php echo $comments2; ?></textarea>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by DGM/GM</label>
              <input type="text" class="form-control" id="dgm_gm" name="dgm_gm" value="<?php echo $dgm_gm; ?>" readonly>
              
              <?php if ($dgm_gm_date != ""){ ?>
              <input type="date" class="form-control" id="dgm_gm_date" name="dgm_gm_date" value="<?php echo $dgm_gm_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($dgm_gm != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments3" name="comments3" <?php if($_SESSION['name'] != $dgm_gm){ echo "readonly";} ?>><?php echo $comments3; ?></textarea>
            </div>
          </div>
          <hr width = 80%>
          <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="C.	 Compliance Clearance" disabled>
          <hr width = 80%>
          <div class="row">
            <table>
              <tr class="row">
                <td class="col">
                  <form class="form-group" action="../controller/approval_LOG.php" method="post" enctype="multipart/form-data" >
                    <label class="font-weight-bold">Custom Clearance</label>
                    <?php if($img_3 != ""){ ?>
                      <a id="preview3_img" class="inactiveLink" href="<?php echo $img_path . $img_3; ?>" target="_blank">Preview</a>
                    <?php } else {?>
                      <input type="file" name="file3" id="file3" onchange="readURL3(this);" <?php if (($_SESSION['name'] != $logistic_usr) || ($form_state != $f_custom)){echo "disabled";}else{echo "";} ?>/>
                      <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
                      <input type="text" id="cc_3" name="cc_3" style="display:none;" value="<?php echo $cc_3; ?>">
                      <input type="submit" value="Submit" style="display:<?php if (($_SESSION['name'] != $logistic_usr) || ($form_state != $f_custom)){echo 'none';}else{ echo 'block';} ?>;" onclick="return confirm('Are you sure want to Submit the form?')">
                      <?php } ?>
                  </form>
                </td>
                <td class="col">
                  <form class="form-group" action="../controller/approval_SAF.php" method="post" enctype="multipart/form-data" >
                    <label class="font-weight-bold">DOE Clearance</label>
                    <?php if($img_4 != ""){ ?>
                      <a id="preview4_img" class="inactiveLink" href="<?php echo $img_path . $img_4; ?>" target="_blank">Preview</a>
                    <?php } else {?>
                      <input type="file" name="file4" id="file4" onchange="readURL4(this);" <?php if (($_SESSION['name'] != $safety_usr) || ($form_state != $f_doe)){echo "disabled";}else{echo "";} ?>/>
                      <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
                      <input type="submit" value="Submit" style="display:<?php if (($_SESSION['name'] != $safety_usr) || ($form_state != $f_doe)){echo 'none';}else{ echo 'block';} ?>;" onclick="return confirm('Are you sure want to Submit the form?')">
                      <?php } ?>
                  </form>
                </td>
              </tr>
              <tr class="row">
                <td class="col">
                  <div class="image-box">
                    <img id="preview3" style="display: none;" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                  </div>
                </td>
                <td class="col">
                  <div class="image-box">
                    <img id="preview4" style="display: none;" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                  </div>
                </td>
              </tr>
            </table>
          </div>
          </br>
          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Logistic Officer</label>
              <input type="text" class="form-control" id="logistic_usr" name="logistic_usr" value="<?php echo $logistic_usr; ?>" readonly>
              
              <?php if ($logistic_date != ""){ ?>
              <input type="date" class="form-control" id="logistic_date" name="logistic_date" value="<?php echo $logistic_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($logistic_usr != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Safety Officer</label>
              <input type="text" class="form-control" id="safety_usr" name="safety_usr" value="<?php echo $safety_usr; ?>" readonly>
              
              <?php if ($safety_date != ""){ ?>
              <input type="date" class="form-control" id="safety_date" name="safety_date" value="<?php echo $safety_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($safety_usr != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

            </div>
          </div>
          <hr width = 80%>
          <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="D.	Disposal of Non-Conforming Material (Physical Part)" disabled>
          <hr width = 80%>
          
          <form class="form-group" action="../controller/disposed.php" method="post" enctype="multipart/form-data" >
            <div class="row">
              <table>
                <tr class="row">
                  <td class="col">
                    <label class="font-weight-bold">Write Off Photo</label>
                    <?php if($img_5 != ""){ ?>
                      <a id="preview5_img" class="inactiveLink" href="<?php echo $img_path . $img_5; ?>" target="_blank">Preview</a>
                    <?php } else {?>
                      <input type="file" name="file5" id="file5" onchange="readURL5(this);" <?php if (($_SESSION['name'] != $issued_name) || ($form_state != $f_dispose)){echo "disabled";}else{echo "";} ?>/>
                      <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
                      <?php } ?>
                  </td>
                </tr>
                <tr class="row">
                  <td class="col">
                    <div class="image-box">
                      <img id="preview5" style="display: none;" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            </br>
            <div class="row gy-5">
              <div class="p-3 border bg-light form-group col-md-4 card">
                <label class="font-weight-bold">Witnessed By</label>
                <input type="text" class="form-control" id="witnessed_by" name="witnessed_by" value="<?php echo $witnessed_by; ?>" readonly></input>
                <?php if ($witnessed_date != ""){ ?>
              <input type="date" class="form-control" id="witnessed_date" name="witnessed_date" value="<?php echo $witnessed_date; ?>" readonly></input>
              <?php } else { ?>
              <input type="text" class="form-control" value="" readonly>
              <?php } ?>
              </div>
              <div class="p-3 border bg-light form-group col-md-4 card">
                <label class="font-weight-bold">Disposed By</label>
                <input type="text" class="form-control" id="disposed_by" name="disposed_by" value="<?php echo $disposed_by; ?>" <?php if(($_SESSION['name'] == $issued_name) && ($form_state == $f_dispose)){echo "";}else{echo "readonly";}?>></input>
                
                <?php if ($disposed_date != ""){ ?>
                <input type="date" class="form-control" id="disposed_date" name="disposed_date" value="<?php echo $disposed_date; ?>" readonly></input>
                <?php } else {
                  $value = "";
                  if ($disposed_by != "") {
                    $value = "Pending Approval";
                  }?>
                <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
                <?php } ?>

              </div>
              <div class="p-3 border bg-light form-group col-md-4 card">
                <label class="font-weight-bold">Remarks</label>
                <textarea class="form-control" id="remark4" name="remark4" <?php if(($_SESSION['name'] != $issued_name) && ($form_state != $f_dispose)){ echo "readonly";} ?>><?php echo $remark4; ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col"></div>
              <div class="text-right"><button class="btn btn-primary btn-lg" type="submit" style="display:<?php if (($_SESSION['name'] != $issued_name) || ($form_state != $f_dispose)){echo 'none';}else{ echo 'block';} ?>;" onclick="return confirm('Are you sure want to Submit this form?')">Submit</button></div>
            </div>
          </form>
          <form class="form-group" action="../controller/finance.php" method="post" enctype="multipart/form-data" >
            <div class="row gy-5">
              <div class="p-3 border bg-light form-group col-md-4 card">
                <label class="font-weight-bold">Finance</label>
                <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
                
                <?php if ($finance_date != ""){ ?>
              <input type="date" class="form-control" id="finance_date" name="finance_date" value="<?php echo $finance_date; ?>" readonly></input>
              <?php } else {
                $value = "";
                if ($finance_name != "") {
                   $value = "Pending Approval";
                }?>
              <input type="text" class="form-control" value="<?php echo $value; ?>" readonly>
              <?php } ?>

              </div>
            </div>
            <div class="row">
              <div class="col"></div>
              <div class="text-right"><button class="btn btn-primary btn-lg" type="submit" style="display:<?php if (($_SESSION['name'] != $finance_name) || ($form_state != $f_finance)){echo 'none';}else{ echo 'block';} ?>;" onclick="return confirm('Are you sure want to Submit this form?')">Submit</button></div>
            </div>
          </form>
          <br>
          <br>
        </div>


        <div class="container row">
        <!-- APPROVAL 1 -->
          <?php if (($_SESSION['name'] == $ack_name) && ($form_state == $f_ack)) { ?>
            <div class="container" style="display:<?php if ($form_state == $f_ack){echo 'block';}else{'none';} ?>;">
              <div class="row">
                <div class="col"></div>
                <!-- REJECT -->
                <div class="col-md-auto">
                  <input type="submit" name="rej_A1" id="rej_A1" onclick="reject_A1()" class="btn btn-danger btn-lg" value="Reject">
                </div>
                <!-- APPROVE -->
                <div class="col-md-auto">
                  <input type="submit" name="app_A1" id="app_A1" onclick="approval_A1()" class="btn btn-success btn-lg" value="Approve">
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- APPROVAL 2 -->
          <?php if (($_SESSION['name'] == $review_name) && ($form_state == $f_rev)) { ?>
            <div class="container" style="display:<?php if ($form_state == $f_rev){echo 'block';}else{'none';} ?>;">
              <div class="row">
                <div class="col"></div>
                <!-- REJECT -->
                <div class="col-md-auto">
                  <input type="submit" name="rej_A2" id="rej_A2" onclick="reject_A2()" class="btn btn-danger btn-lg" value="Reject">
                </div>
                <!-- APPROVE -->
                <div class="col-md-auto">
                  <input type="submit" name="app_A2" id="app_A2" onclick="approval_A2()" class="btn btn-success btn-lg" value="Approve">
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- PRODUCTION MANAGER APPROVAL -->
          <?php if (($_SESSION['name'] == $prod_mng) && ($form_state == $f_prodmng)) { ?>
            <div class="container" style="display:<?php if ($form_state == $f_prodmng){echo 'block';}else{'none';} ?>;">
              <div class="row">
                <div class="col"></div>
                <!-- REJECT -->
                <div class="col-md-auto">
                  <input type="submit" name="rej_PM" id="rej_PM" onclick="reject_PM()" class="btn btn-danger btn-lg" value="Reject">
                </div>
                <!-- APPROVE -->
                <div class="col-md-auto">
                  <input type="submit" name="app_PM" id="app_PM" onclick="approval_PM()" class="btn btn-success btn-lg" value="Approve">
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- QA MANAGER APPROVAL -->
          <?php if (($_SESSION['name'] == $qa_mng) && ($form_state == $f_qamng)) { ?>
            <div class="container" style="display:<?php if ($form_state == $f_qamng){echo 'block';}else{'none';} ?>;">
              <div class="row">
                <div class="col"></div>
                <!-- REJECT -->
                <div class="col-md-auto">
                  <input type="submit" name="rej_QA" id="rej_QA" onclick="reject_QA()" class="btn btn-danger btn-lg" value="Reject">
                </div>
                <!-- APPROVE -->
                <div class="col-md-auto">
                  <input type="submit" name="app_QA" id="app_QA" onclick="approval_QA()" class="btn btn-success btn-lg" value="Approve">
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- GM/DGM MANAGER APPROVAL -->
          <?php if (($_SESSION['name'] == $dgm_gm) && ($form_state == $f_dgm)) { ?>
            <div class="container" style="display:<?php if ($form_state == $f_dgm){echo 'block';}else{'none';} ?>;">
              <div class="row">
                <div class="col"></div>
                <!-- REJECT -->
                <div class="col-md-auto">
                  <input type="submit" name="rej_GM" id="rej_GM" onclick="reject_GM()" class="btn btn-danger btn-lg" value="Reject">
                </div>
                <!-- APPROVE -->
                <div class="col-md-auto">
                  <input type="submit" name="app_GM" id="app_GM" onclick="approval_GM()" class="btn btn-success btn-lg" value="Approve">
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- CLOSE FORM -->
          <?php if (($_SESSION['name'] == $issued_name) && ($form_state == $f_complete)) { ?>
            <form class="form-group" action="../controller/close_form.php" method="post" enctype="multipart/form-data" >
            <input type="text" id="ncmr_no" name="ncmr_no" style="display:none;" value="<?php echo $ncmr_no; ?>">
              <div class="container">
                <div class="row">
                  <div class="col"></div>
                  <div class="text-right">
                    <button class="btn btn-primary btn-lg" type="submit" onclick="return confirm('Are you sure want to CLOSE this form?')">CLOSE</button>
                  </div>
                </div>
              </div>
            </form>
          <?php } ?>

        </div>
      <hr width = 80%>
      </br>
      </br></br>
    </div>
  </body>

  <script>

    // Rejection type checkbox
    var checkboxValue = <?php echo json_encode($rejection_chk); ?>;
    var checkboxes = document.getElementsByName("reject_type_opt");
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].value == checkboxValue) {
        checkboxes[i].checked = true;
        break;
      }
    }

    // Classification checkbox
    var checkboxValue = <?php echo json_encode($classification_chk); ?>;
    var checkboxes = document.getElementsByName("classification_chk");
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].value == checkboxValue) {
        checkboxes[i].checked = true;
        break;
      }
    }

    // Disposition checkbox
    var checkboxValue = <?php echo json_encode($disposition_chk); ?>;
    var checkboxes = document.getElementsByName("disposition_chk");
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].value == checkboxValue) {
        checkboxes[i].checked = true;
        break;
      }
    }
    if(checkboxValue == 'Write Off') {
      document.getElementById("write_off_form").style.display = "block";
    } else {
      document.getElementById("write_off_form").style.display = "none";
    }
  </script>

  <script>
    // Write Off Type checkbox
    var checkboxValue = <?php echo json_encode($wo_type_chk); ?>;
    var checkboxes = document.getElementsByName("wo_type_chk");
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].value == checkboxValue) {
        checkboxes[i].checked = true;
        break;
      }
    }
  </script>

  <script>
    var cc_1 = <?php echo $cc_1; ?>;
    var cc_2 = <?php echo $cc_2; ?>;
    var cc_3 = <?php echo $cc_3; ?>;
    var cc_4 = <?php echo $cc_4; ?>;
    if (cc_1 == 1){
      document.getElementById("cc_1").checked = true;
    }
    if (cc_2 == 1){
      document.getElementById("cc_2").checked = true;
    }
    if (cc_3 == 1){
      document.getElementById("cc_3").checked = true;
    }
    if (cc_4 == 1){
      document.getElementById("cc_4").checked = true;
    }
  </script>

  <!----------------------------- BUTTON ACTIONS ------------------------------->


  <!-- Approval 1 -->
  <script>
    function approval_A1() {

      if (confirm('Are you sure you want to Approve?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments4 = document.getElementById("comments4").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/approval_A1.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments4': comments4,
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/approve/approve_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/approve/approve_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
      
    }
  </script>
  <!-- REJECT 1 -->
  <script>
    function reject_A1() {
      if (confirm('Are you sure you want to Reject?')) {

        var comments4 = document.getElementById("comments4").value.trim();
        if (comments4 === '') {
          alert('Please state the Reason for Rejection in Comments field.');
          return false;
        }

        var ncmr_no = document.getElementById("ncmr_no").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/rejection_A1.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments4': comments4,
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/reject/reject_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/reject/reject_fail.php';
                      }
        });
      return true;
      } else {
        return false;
      }
    }
  </script>


  <!-- Approval 2 -->
  <script>
    function approval_A2() {

      if (confirm('Are you sure you want to Approve?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments5 = document.getElementById("comments5").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/approval_A2.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments5'  : comments5,
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/approve/approve_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/approve/approve_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }

    }
  </script>
  <!-- REJECT 2 -->
  <script>
    function reject_A2() {
      if (confirm('Are you sure you want to Reject?')) {

        var comments5 = document.getElementById("comments5").value.trim();
        if (comments5 === '') {
          alert('Please state the Reason for Rejection in Comments field.');
          return false;
        }
        var ncmr_no = document.getElementById("ncmr_no").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/rejection_A2.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments5'  : comments5,
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/reject/reject_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/reject/reject_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>


  <!-- Production Manager Approval -->
  <script>
    function approval_PM() {
      if (confirm('Are you sure you want to Approve?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments1 = document.getElementById("comments1").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/approval_PM.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments1' : comments1
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/approve/approve_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/approve/approve_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>
  <!-- Production Manager Rejection -->
  <script>
    function reject_PM() {
      if (confirm('Are you sure you want to Reject?')) {

        var comments1 = document.getElementById("comments1").value.trim();
        if (comments1 === '') {
          alert('Please state the Reason for Rejection in Comments field.');
          return false;
        }


        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments1 = document.getElementById("comments1").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/rejection_PM.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments1' : comments1
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/reject/reject_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/reject/reject_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>


  <!-- QA Manager Approval -->
  <script>
    function approval_QA() {
      if (confirm('Are you sure you want to Approve?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments2 = document.getElementById("comments2").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/approval_QA.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments2' : comments2
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/approve/approve_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/approve/approve_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>
  <!-- QA Manager Rejection -->
  <script>
    function reject_QA() {
      if (confirm('Are you sure you want to Reject?')) {

        var comments2 = document.getElementById("comments2").value.trim();
        if (comments2 === '') {
          alert('Please state the Reason for Rejection in Comments field.');
          return false;
        }

        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments2 = document.getElementById("comments2").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/rejection_QA.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments2' : comments2
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/reject/reject_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/reject/reject_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>


<!-- DGM/GM Approval -->
<script>
    function approval_GM() {
      if (confirm('Are you sure you want to Approve?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments3 = document.getElementById("comments3").value;
        var cc_2 = <?php echo $cc_2; ?>;
        var cc_3 = <?php echo $cc_3; ?>;

        $.ajax({
          type      : "POST",
          url       : "../controller/approval_GM.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments3': comments3,
                        'cc_2'     : cc_2,
                        'cc_3'     : cc_3
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/approve/approve_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/approve/approve_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>
  <!-- GM/DGM Rejection -->
  <script>
    function reject_GM() {

      var comments3 = document.getElementById("comments3").value.trim();
      if (comments3 === '') {
        alert('Please state the Reason for Rejection in Comments field.');
        return false;
      }

      if (confirm('Are you sure you want to Reject?')) {
        var ncmr_no = document.getElementById("ncmr_no").value;
        var comments3 = document.getElementById("comments3").value;

        $.ajax({
          type      : "POST",
          url       : "../controller/rejection_GM.php",
          data      : {
                        'ncmr_no'  : ncmr_no,
                        'comments3': comments3
                      },
          dataType  : 'html',
          success   : function(data) {
                        console.log(data);
                        window.location.href = '../email/reject/reject_success.php';
                      },
          error     : function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed: " + textStatus + " - " + errorThrown);
                        window.location.href = '../email/reject/reject_fail.php';
                      }
        });
        return true;
      } else {
        return false;
      }
    }
  </script>

  <!----------------------------- BUTTON ACTIONS ------------------------------->

  <script>
    function readURL2(input) {
      var img = document.getElementById("preview2");
      img.style.display = "block";

      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            img.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
      } else {
        img.style.display = "none";
        input.value = "";
      }
    }
  </script>

  <script>
    function readURL3(input) {
        var img = document.getElementById("preview3");
        img.style.display = "block";

        if (input.files && input.files[0]) {
          // if (input.files[0].size < 1000000) {
            var reader = new FileReader();
            reader.onload = function(e) {
              img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          // } else {
          //   img.style.display = "none";
          //   alert("File size too large. Please select an image file with size less than 1 MB");
          //   input.value = "";
          // }
        } else {
          img.style.display = "none";
          input.value = "";
        }
      }

      function readURL4(input) {
        var img = document.getElementById("preview4");
        img.style.display = "block";

        if (input.files && input.files[0]) {
          // if (input.files[0].size < 1000000) {
            var reader = new FileReader();
            reader.onload = function(e) {
              img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          // } else {
          //   img.style.display = "none";
          //   alert("File size too large. Please select an image file with size less than 1 MB");
          //   input.value = "";
          // }
        } else {
          img.style.display = "none";
          input.value = "";
        }
      }

      function readURL5(input) {
        var img = document.getElementById("preview5");
        img.style.display = "block";

        if (input.files && input.files[0]) {
          // if (input.files[0].size < 1000000) {
            var reader = new FileReader();
            reader.onload = function(e) {
              img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          // } else {
          //   img.style.display = "none";
          //   alert("File size too large. Please select an image file with size less than 1 MB");
          //   input.value = "";
          // }
        } else {
          img.style.display = "none";
          input.value = "";
        }
      }

      $('#btnDelete3').click(function() {
        $('#imgPreview3').attr('src', '#');
        $('#btnDelete3').css('display', 'none');
        $('#file3').val('');
      });
  </script>

</html>

<?php
    if ($img_1 != null) {
        echo '<script>document.getElementById("preview1").src = "'.$img_path.$img_1.'";</script>';
        echo '<script>document.getElementById("preview1").style.display = "block";</script>';
        echo '<script>document.getElementById("preview1_img").classList.remove("inactiveLink");</script>';
    }
    if ($img_2 != null) {
      echo '<script>document.getElementById("preview2").src = "'.$img_path.$img_2.'";</script>';
      echo '<script>document.getElementById("preview2").style.display = "block";</script>';
      echo '<script>document.getElementById("preview2_img").classList.remove("inactiveLink");</script>';
    }
    if ($img_3 != null) {
      echo '<script>document.getElementById("preview3").src = "'.$img_path.$img_3.'";</script>';
      echo '<script>document.getElementById("preview3").style.display = "block";</script>';
      echo '<script>document.getElementById("preview3_img").classList.remove("inactiveLink");</script>';
    }
    if ($img_4 != null) {
      echo '<script>document.getElementById("preview4").src = "'.$img_path.$img_4.'";</script>';
      echo '<script>document.getElementById("preview4").style.display = "block";</script>';
      echo '<script>document.getElementById("preview4_img").classList.remove("inactiveLink");</script>';
    }
    if ($img_5 != null) {
      echo '<script>document.getElementById("preview5").src = "'.$img_path.$img_5.'";</script>';
      echo '<script>document.getElementById("preview5").style.display = "block";</script>';
      echo '<script>document.getElementById("preview5_img").classList.remove("inactiveLink");</script>';
    }

} else {
  header("Location: ../email/general/access_denied.php");
}

?>
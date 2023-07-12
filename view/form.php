<?php
  include ("../config/dbconnection.php");
  include ("../config/config.php");
  include ("../config/navigationbar.php");

  if($_SESSION["username"]) {

    $zb = mysqli_query($conn,"SELECT * FROM `form` ORDER BY `ncmr_no` DESC limit 1");
    $vb = mysqli_fetch_assoc($zb);
    $rt = $vb['ncmr_no'];
    $ncmr_no= $rt+1;

    if($rt=''){
      $ncmr_no= 1;
    }

    $usr = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $usr2 = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $usr3 = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $usr4 = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $usr5 = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $usr6 = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $disposed = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $logistic = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $safety = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $prod_mng = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $qa_mng = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $director = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $finance = mysqli_query($conn,"SELECT `name` FROM `user` WHERE `access` = 'user' ORDER BY `name` ASC" );
    $scrap_cost = mysqli_query($conn,"SELECT * FROM `scrap_cost` " );
    $today = date("d/m/Y"); 

?>                     

<html lang="en">
  <head>
    <title>E-NCMR SYSTEM</title>
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

    </style>

  </head>

  <body>
    <script src="../src/bootstrap/jquery-3.1.1.min.js"></script>
    <br>
    <div class="container">

      <div class="jumbotron">
        <div class="container col-md-6 text-center">
          <h1>E-NCMR SYSTEM</h1>
          <p >Non-Conforming Material Report</p>
        </div>
      </div>

      

      <hr width = 80%>
      
      <form class="form-group" action="../controller/insert.php" method="post" id="myform" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
            <label class="font-weight-bold">Notify</label>
            <select class="form-control" name="notify_usr2" id="notify_usr2">
              <option></option>
              <?php while($row30 = mysqli_fetch_array($usr4)):; ?>
                <option value="<?php echo $row30['0'];?>"><?php echo $row30['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="font-weight-bold">Notify</label>
            <select class="form-control" name="notify_usr3" id="notify_usr3">
              <option></option>
              <?php while($row31 = mysqli_fetch_array($usr5)):; ?>
                <option value="<?php echo $row31['0'];?>"><?php echo $row31['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="font-weight-bold">Notify</label>
            <select class="form-control" name="notify_usr4" id="notify_usr4">
              <option></option>
              <?php while($row32 = mysqli_fetch_array($usr6)):; ?>
                <option value="<?php echo $row32['0'];?>"><?php echo $row32['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
        </div>  
        <br>
        <div class="row">
          <div class="col-md-4">
            <label class="font-weight-bold">Notify</label>
            <select class="form-control" name="notify_usr" id="notify_usr">
              <option></option>
              <?php while($row = mysqli_fetch_array($usr)):; ?>
                <option value="<?php echo $row['0'];?>"><?php echo $row['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="font-weight-bold">Acknowledge by <span style="color:red">*</span></label>
            <select class="form-control" id="ack_usr" name="ack_usr" required>
              <option></option>
              <?php while($row2 = mysqli_fetch_array($usr2)):; ?>
                <option value="<?php echo $row2['0'];?>"><?php echo $row2['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="font-weight-bold">Review by <span style="color:red">*</span></label>
            <select class="form-control" id="rev_usr" name="rev_usr" required>
              <option></option>
              <?php while($row3 = mysqli_fetch_array($usr3)):; ?>
                <option value="<?php echo $row3['0'];?>"><?php echo $row3['0'];?></option>
              <?php endwhile;?>
            </select>
          </div>
        </div>
        
        <br>
        <hr width = 80%>
        <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="A. Non-Conforming (NC) Material Details" disabled>
        <hr width = 80%>

        <div class="container row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="issue_date">Date</label>
              <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d');?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="ncmr_no">NCMR Number</label>
              <input type="text" class="form-control" id="ncmr_no" name="ncmr_no" value="<?php echo $ncmr_no; ?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="lot_qty">Lot Quantity</label>
              <input type="number" class="form-control" id="lot_qty" name="lot_qty">
            </div>
          </div>
          <div class="col-md-3" style="display:none;">
            <div class="form-group">
              <label class="font-weight-bold" for="form_state">Form Status</label>
              <input type="text" class="form-control" id="form_state" name="form_state" readonly value=<?php echo $f_ack; ?>>
            </div>
          </div>
        </div>

        <hr width = 80%>

        <div class="row">
          <div class="col">
            <div class="row h-100">
              <div class="col-12">
                <div class="h-100">
                  <label  class="font-weight-bold">Type of Rejection <span style="color:red">*</span></label>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Internal" name="reject_type_opt" id="reject_type_opt" onclick='reject_type_click(this);'/>
                    <label>Internal</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Supplier" name="reject_type_opt" id="reject_type_opt" onclick='reject_type_click(this);'/>
                    <label>Supplier</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" class="reject_type_opt" value="Customer" name="reject_type_opt" id="reject_type_opt" onclick='reject_type_click(this);'/>
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
                  <input type="text" class="form-control" id="job_no" name="job_no">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">DO No</label>
                  <input type="text" class="form-control" id="do_no" name="do_no">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Customer Reference No</label>
                  <input type="text" class="form-control" id="customer_ref_no" name="customer_ref_no">
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="row">
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Department</label>
                  <input type="text" class="form-control" id="dept_name" name="dept_name">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Supplier/Customer Name</label>
                  <input type="text" class="form-control" id="rejection_name" name="rejection_name">
                </div>
              </div>
              <div class="col-12">
                <div class="h-100">
                  <label class="font-weight-bold">Operator No</label>
                  <input type="text" class="form-control" id="operator_no" name="operator_no">
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="row">
          <div class="col-md-4">
            <label class="font-weight-bold">Classification of Rejection <span style="color:red">*</span></label>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="Mass Production" name="classification_chk" onclick='reject_class_click(this);'/>
              <label>Mass Production</label>
            </div>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="First Article" name="classification_chk" onclick='reject_class_click(this);'/>
              <label>First Article</label>
            </div>
            <div class="checkbox">
              <input type="checkbox" class="reject_class_opt" value="Others" name="classification_chk" onclick='reject_class_click(this);'/>
              <label>Others</label>
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <label class="font-weight-bold">Others</label>
              <input type="text" class="form-control" id="reject_class_other" name="reject_class_other" readonly>
            </div>
          </div>
          <div class="col-md-4"\>
        </div>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="part_no">Part No</label>
              <input type="text" class="form-control" id="part_no" name="part_no">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="nc_qty">NC Qty</label>
              <div class="input-group">
                <input type="number" class="form-control" id="nc_qty" name="nc_qty">
                <div class="input-group-append">
                  <select class="form-control" name="unit" id="unit">
                    <option value="PCS">PCS</option>
                    <option value="KG">KG</option>
                    <option value="LBS">LBS</option>
                    <option value="L">L</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="detected_at">Detected at</label>
              <input type="text" class="form-control" id="detected_at" name="detected_at">
            </div>
          </div>
        </div>

        <div class="container row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="defect_desc">Defect Description</label>
              <input type="text" class="form-control" id="defect_desc" name="defect_desc">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="defect_cat">Defect Category</label>
              <!-- <input type="text" class="form-control" id="defect_cat" name="defect_cat"> -->
              <select class="form-control" id="defect_cat" name="defect_cat">
                <option value="DAMAGE">DAMAGE</option>
                <option value="MISSING">MISSING</option>
                <option value="WRONG">WRONG</option>
                <option value="EXPIRED MATERIAL">EXPIRED MATERIAL</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="container row">
          <div class="col-md-4">
            <label class="font-weight-bold">Disposition <span style="color:red">*</span></label>
            <br>
            <div class="checkbox" style="float:left;">
              <div>
                <input type="checkbox" class="disposition_opt" value="Use As Is" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>Use As Is</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Rework" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>Rework</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Write Off" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>Write Off</label>
              </div>
            </div>
            <div></div>
            <div class="checkbox" style="float:left; margin-left:20px;">
              <div>
                <input type="checkbox" class="disposition_opt" value="Exchange 1 to 1" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>Exchange 1 to 1</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="Rejection from Store" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>Rejection from store</label>
              </div>
              <div>
                <input type="checkbox" class="disposition_opt" value="RTV, PRN No" id="disposition_chk" name="disposition_chk" onclick='disposition_click(this);'/>
                <label>RTV, PRN No</label>
              </div>
            </div>
          </div>
          <div class="col-md-4" id="disp_others">
            <div>
              <label class="font-weight-bold">RTV/PRN No</label>
              <input type="text" class="form-control" id="rtv_prn_no" name="rtv_prn_no" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold">Remarks</label>
              <textarea class="form-control" id="remark1" name="remark1"></textarea>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row">
          <table>
            <tr>
              <td>
                <label class="font-weight-bold">Defect Photo</label>
                <input type="file" name="file1" id="file1" onchange="readURL1(this);"/>
              </td>
              <td>
                <label class="font-weight-bold">Rework Photo</label>
                <input type="file" name="file2" id="file2" onchange="readURL2(this);"/>
              </td>
            </tr>
            <tr>
              <td>
                <div class="image-box" style="display: flex; align-items: center; justify-content: center;">
                  <img id="preview1" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                </div>
              </td>
              <td>
                <div class="image-box" style="display: flex; align-items: center; justify-content: center;">
                  <img id="preview2" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                </div>
              </td>
            </tr>
          </table>
        </div>
        <br>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="font-weight-bold">Sorting / Reworked By</label>
              <input type="text" class="form-control" id="sort_rework" name="sort_rework">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label class="font-weight-bold">Accept</label>
              <input type="number" class="form-control" id="accept_pcs" name="accept_pcs">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label class="font-weight-bold">Reject</label>
              <input type="number" class="form-control" id="reject_pcs" name="reject_pcs">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="font-weight-bold">Checked By</label>
              <input type="text" class="form-control" id="checked_by" name="checked_by">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="font-weight-bold">Remarks</label>
              <textarea class="form-control" id="remark2" name="remark2"></textarea>
            </div>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row">
          <div class="col-md-3">
            <label class="font-weight-bold">Corrective action needed?</label>
            <select class="form-control" id="corrective_sel" name="corrective_sel">
              <option value="Yes">Yes</option>
              <option value="No" selected>No</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">CAR / SCAR No</label>
            <input type="text" class="form-control" id="car_scar_no" name="car_scar_no" readonly>
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">Replacement needed?</label>
            <select class="form-control" id="replacement_sel" name="replacement_sel">
              <option value="Yes">Yes</option>
              <option value="No" selected>No</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="font-weight-bold">Quantity</label>
            <input type="number" class="form-control" id="replacement_qty" name="replacement_qty" readonly>
          </div>
        </div>

        <div class="container row">
          <div class="form-group col-md-12">
            <label class="font-weight-bold">Remarks</label>
            <textarea class="form-control" id="remark3" name="remark3"></textarea>
          </div>
        </div>

        <hr width = 80%>
        <div class="container row gy-5">
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Issued By / Date</label>
            <input type="text" class="form-control" id="issued_name" name="issued_name" readonly value="<?php echo $_SESSION['name']; ?>"></input>
            <input type="date" class="form-control" id="issued_date" name="issued_date" value="<?php echo date('Y-m-d');?>" readonly></input>
          </div>
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Acknowledged By / Date</label>
            <input type="text" class="form-control" id="ack_name" name="ack_name" readonly></input>
            <input type="text" class="form-control" id="ack_date" name="ack_date" readonly></input>
            <label class="font-weight-bold">Comments</label>
            <textarea class="form-control" id="comments4" name="comments4" readonly></textarea>
          </div>
          <div class="p-3 border bg-light form-group col-md-4 card">
            <label class="font-weight-bold">Reviewed By / Date</label>
            <input type="text" class="form-control" id="review_name" name="review_name" readonly></input>
            <input type="text" class="form-control" id="review_date" name="review_date" readonly></input>
            <label class="font-weight-bold">Comments</label>
            <textarea class="form-control" id="comments5" name="comments5" readonly></textarea>
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
                <input type="text" class="form-control" id="erp_part_no" name="erp_part_no">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold">Quantity</label>
                <input type="number" class="form-control" id="erp_qty" name="erp_qty">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="font-weight-bold">NAV Location Bin Code</label>
                <input type="text" class="form-control" id="loc_bin_code" name="loc_bin_code">
              </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label class="font-weight-bold">Report No</label>
                <input type="text" class="form-control" id="report_no" name="report_no">
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
                  <input type="checkbox" class="wo_type_chk" value="Indirect Material" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>Indirect Material</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Purchase Part" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>Purchase Part</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="WIP" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>WIP</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="FG" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>FG</label>
                </div>
              </div>
              <div></div>
              <div class="checkbox" style="float:left; margin-left:30px;">
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Rejection From Store" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>Rejection From Store</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Customer Rejection" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>Customer Rejection</label>
                </div>
                <div>
                  <input type="checkbox" class="wo_type_chk" value="Supplier Rejection" id="wo_type_chk" name="wo_type_chk" onclick='wo_type_click(this);'/>
                  <label>Supplier Rejection</label>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <label class="font-weight-bold">Purchase Part Type</label>
              <select class="form-control" id="wo_type_sel" name="wo_type_sel" disabled>
                <option value="" selected></option>
                <option value="Sheet Metal">Sheet Metal</option>
                <option value="Components">Components</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="font-weight-bold">Compliance Clearance <span style="color:red">*</span></label>
              <br>
              <div class="checkbox" style="float:left;">
                <div>
                  <input type="checkbox" value="1" id="cc_1" name="cc_1" onclick="toggleReadOnly2('cc_2','cc_3','cc_4', this.checked)" checked/>
                  <label>Not Required</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_2" name="cc_2" onclick="cc_2_cb(this);" disabled/>
                  <label>Custom</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_3" name="cc_3" onclick="cc_3_cb(this);" disabled/>
                  <label>DOE</label>
                </div>
                <div>
                  <input type="checkbox" value="1" id="cc_4" name="cc_4" onclick="toggleReadOnly('cc_4_others', this.checked)" disabled/>
                  <label>Others</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label class="font-weight-bold">Others</label>
              <input class="form-control" type="text" id="cc_4_others" name="cc_4_others" readonly/>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="col-md-4">
              <label class="font-weight-bold">Material</label>
              <select class="form-control" name="wo_material" id="wo_material" disabled>
                <option></option>
                <?php while($row6 = mysqli_fetch_array($scrap_cost)):; ?>
                  <option value="<?php echo $row6['material'];?>"><?php echo $row6['material'];?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Size(x)</label>
                <input type="number" class="form-control" id="size_x" name="size_x" min="0" step=".01" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Size(y)</label>
                <input type="number" class="form-control" id="size_y" name="size_y" min="0" step=".01" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Thickness</label>
                <input type="number" class="form-control" id="wo_thick" name="wo_thick" min="0" step=".01" readonly>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="font-weight-bold">Total Cost (RM)</label>
                <input type="number" class="form-control" id="wo_cost" name="wo_cost" min="0" step=".01">
              </div>
            </div>
            <div class="col-md-12 text-right">
              <input id="calc" onclick="calculateCost()" type="button" class="btn btn-danger btn-md" value="Calculate" disabled>
            </div>
          </div>

          <hr width = 80%>
          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by Production Manager <span style="color:red">*</span></label>
              <select class="form-control" name="prod_mng" id="prod_mng">
                <option></option>
                <?php while($row7 = mysqli_fetch_array($prod_mng)):; ?>
                  <option value="<?php echo $row7['0'];?>"><?php echo $row7['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="prod_mng_date" name="prod_mng_date" readonly></input>
              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments1" name="comments1" readonly></textarea>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by QA Manager <span style="color:red">*</span></label>
              <select class="form-control" name="qa_mng" id="qa_mng">
                <option></option>
                <?php while($row8 = mysqli_fetch_array($qa_mng)):; ?>
                  <option value="<?php echo $row8['0'];?>"><?php echo $row8['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="qa_mng_date" name="qa_mng_date" readonly></input>
              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments2" name="comments2" readonly></textarea>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Approved by DGM/GM <span style="color:red">*</span></label>
              <select class="form-control" name="dgm_gm" id="dgm_gm">
                <option></option>
                <?php while($row9 = mysqli_fetch_array($director)):; ?>
                  <option value="<?php echo $row9['0'];?>"><?php echo $row9['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="dgm_gm_date" name="dgm_gm_date" readonly></input>
              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments3" name="comments3" readonly></textarea>
            </div>
          </div>
          <hr width = 80%>
          <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="C.	 Compliance Clearance" disabled>
          <hr width = 80%>
          <div class="row">
            <table>
              <tr>
                <td>
                  <label class="font-weight-bold">Custom Clearance</label>
                  <input type="file" name="file3" id="file3" onchange="readURL3(this);" disabled/>
                </td>
                <td>
                  <label class="font-weight-bold">DOE Clearance</label>
                  <input type="file" name="file4" id="file4" onchange="readURL4(this);" disabled/>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="image-box" style="display: flex; align-items: center; justify-content: center;">
                    <img id="preview3" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                  </div>
                </td>
                <td>
                  <div class="image-box" style="display: flex; align-items: center; justify-content: center;">
                    <img id="preview4" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                  </div>
                </td>
              </tr>
            </table>
          </div>
          </br>
          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Logistic Officer</label>
              <select class="form-control" name="logistic_usr" id="logistic_usr" disabled>
                <option></option>
                <?php while($row4 = mysqli_fetch_array($logistic)):; ?>
                  <option value="<?php echo $row4['0'];?>"><?php echo $row4['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="logistic_date" name="logistic_date" readonly></input>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Safety Officer</label>
              <select class="form-control" name="safety_usr" id="safety_usr" disabled>
                <option></option>
                <?php while($row5 = mysqli_fetch_array($safety)):; ?>
                  <option value="<?php echo $row5['0'];?>"><?php echo $row5['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="safety_date" name="safety_date" readonly></input>
            </div>
          </div>
          
          <hr width = 80%>
          <input class="form-control bg-light" style="color :white;" id="disabledInput" type="text" placeholder="D.	Disposal of Non-Conforming Material (Physical Part)" disabled>
          <hr width = 80%>
          <div class="row">
            <table>
              <tr>
                <td>
                  <label class="font-weight-bold">Write Off Photo</label>
                  <input type="file" name="file5" id="file5" onchange="readURL5(this);" disabled/>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="image-box" style="display: flex; align-items: center; justify-content: center;">
                    <img id="preview5" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100%;" />
                  </div>
                </td>
              </tr>
            </table>
          </div>
          </br>
          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Witnessed By</label>
              <input type="text" class="form-control" name="witnessed_by" id="witnessed_by" readonly></input>
              <input type="text" class="form-control" id="witnessed_date" name="witnessed_date" readonly></input>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Disposed By</label>
              <input type="text" class="form-control" name="disposed_by" id="disposed_by" readonly></input>
              <input type="text" class="form-control" id="disposed_date" name="disposed_date" readonly></input>
            </div>
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Remarks</label>
              <textarea class="form-control" id="remark4" name="remark4" readonly></textarea>
            </div>
          </div>

          <div class="row gy-5">
            <div class="p-3 border bg-light form-group col-md-4 card">
              <label class="font-weight-bold">Finance</label>
              <select class="form-control" name="finance_name" id="finance_name">
                <option></option>
                <?php while($row21 = mysqli_fetch_array($finance)):; ?>
                  <option value="<?php echo $row21['0'];?>"><?php echo $row21['0'];?></option>
                <?php endwhile;?>
              </select>
              <input type="text" class="form-control" id="finance_date" name="finance_date" readonly></input>
              <label class="font-weight-bold">Comments</label>
              <textarea class="form-control" id="comments6" name="comments6" readonly></textarea>
            </div>
          </div>

          <br>
          <br>

        </div>
        <!-- ______________________________________________________________________________________________________ -->
        <!-- END OF WRITE OFF FORM -->

        <div class="col-md-12 text-right">
          <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Create Form" onclick="return confirm('Are you sure want to Create Form?')">
        </div>
        <br>
      </form>
    </div>

    <script>
      var form = document.getElementById('myform');
      var checkboxes = form.querySelectorAll('.reject_type_opt');
      
      form.addEventListener('submit', function(event) {
        var isChecked = false;
        
        checkboxes.forEach(function(checkbox) {
          if (checkbox.checked) {
            isChecked = true;
          }
        });
        
        if (!isChecked) {
          event.preventDefault();
          alert('Please select Type of Rejection checkbox.');
        }
      });
    </script>

    <script>
      var form = document.getElementById('myform');
      var checkboxes2 = form.querySelectorAll('.reject_class_opt');
      
      form.addEventListener('submit', function(event) {
        var isChecked = false;
        
        checkboxes2.forEach(function(checkbox) {
          if (checkbox.checked) {
            isChecked = true;
          }
        });
        
        if (!isChecked) {
          event.preventDefault();
          alert('Please select Classification of Rejection checkbox.');
        }
      });
    </script>

    <script>
      var form = document.getElementById('myform');
      var checkboxes3 = form.querySelectorAll('.disposition_opt');
      
      form.addEventListener('submit', function(event) {
        var isChecked = false;
        
        checkboxes3.forEach(function(checkbox) {
          if (checkbox.checked) {
            isChecked = true;
          }
        });
        
        if (!isChecked) {
          event.preventDefault();
          alert('Please select Disposition checkbox.');
        }
      });
    </script>
    

    <script>
      // Only can check 1 checkbox
      $('.reject_type_opt').click(function() {
        $('.reject_type_opt').not(this).prop('checked', false);
      });
      $('.reject_class_opt').click(function() {
        $('.reject_class_opt').not(this).prop('checked', false);
      });
      $('.disposition_opt').click(function() {
        $('.disposition_opt').not(this).prop('checked', false);
      });
      $('.wo_type_chk').click(function() {
        $('.wo_type_chk').not(this).prop('checked', false);
      });
    </script>

    <script>
      // Classification of Rejection visible fields
      function reject_class_click(checkbox) {
        if(checkbox.checked){
          if (checkbox.value == 'Others') {
            document.getElementById("reject_class_other").readOnly = false;
          }
          else{
            document.getElementById("reject_class_other").readOnly = true;
          }
        }
        else{
          document.getElementById("reject_class_other").readOnly = true;
        }
      }
    </script>

    <script>
      // Classification of Rejection visible fields
      function disposition_click(checkbox) {
        if(checkbox.checked){
          if(checkbox.value == 'RTV, PRN No') {
            document.getElementById("rtv_prn_no").readOnly = false;
          } else {
            document.getElementById("rtv_prn_no").readOnly = true;
          }
          if(checkbox.value == 'Write Off') {
            document.getElementById("write_off_form").style.display = "block";
            document.getElementById('prod_mng').setAttribute('required', 'required');
            document.getElementById('qa_mng').setAttribute('required', 'required');
            document.getElementById('dgm_gm').setAttribute('required', 'required');
            // document.getElementById('finance_name').setAttribute('required', 'required');
          } else {
            document.getElementById("write_off_form").style.display = "none";
            document.getElementById('prod_mng').removeAttribute('required');
            document.getElementById('qa_mng').removeAttribute('required');
            document.getElementById('dgm_gm').removeAttribute('required');
            // document.getElementById('finance_name').removeAttribute('required');
          }
        }
        else{
          document.getElementById("rtv_prn_no").readOnly = true;
          document.getElementById("write_off_form").style.display = "none";
        }
      }
    </script>

    <script>
      $(function () {
          $("#corrective_sel").change(function () {
              if ($(this).val() == 2) {
                document.getElementById("car_scar_no").readOnly = true;
              } else {
                document.getElementById("car_scar_no").readOnly = false;
              }
          });
      });
    </script>

    <script>
      $(function () {
          $("#replacement_sel").change(function () {
              if ($(this).val() == 2) {
                document.getElementById("replacement_qty").readOnly = true;
              } else {
                document.getElementById("replacement_qty").readOnly = false;
              }
          });
      });
    </script>

    <script>
      function readURL1(input) {
        var img = document.getElementById("preview1");
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

      function readURL3(input) {
        var img = document.getElementById("preview3");
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

      function readURL4(input) {
        var img = document.getElementById("preview4");
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

      function readURL5(input) {
        var img = document.getElementById("preview5");
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
      //Write Off Form
      function wo_type_click(checkbox) {
        if(checkbox.checked){
          if(checkbox.value == 'Purchase Part') {
            document.getElementById("wo_type_sel").disabled = false;
          } else {
            document.getElementById("wo_type_sel").disabled = true;
          }
        }
        else{
          document.getElementById("wo_type_sel").disabled = true;
        }
      }
    </script>

    <script>
      $(function () {
          $("#wo_type_sel").change(function () {
              if ($(this).val() == "Sheet Metal") {
                document.getElementById("size_x").readOnly = false;
                document.getElementById("size_y").readOnly = false;
                document.getElementById("wo_material").disabled = false;
                document.getElementById("wo_thick").readOnly = false;
                document.getElementById("calc").disabled = false;
              } else {
                document.getElementById("size_x").readOnly = true;
                document.getElementById("size_y").readOnly = true;
                document.getElementById("wo_material").disabled = true;
                document.getElementById("wo_thick").readOnly = true;
                document.getElementById("calc").disabled = true;
              }
          });
      });
    </script>

    <script>

      let calc = document.getElementById("calc");
      calc.addEventListener("click", calculateCost);

      function calculateCost() {          
        var size_x = document.getElementById("size_x").value;
        var size_y = document.getElementById("size_y").value;
        var material = document.getElementById("wo_material").value;
        var thickness = document.getElementById("wo_thick").value;

        $.ajax({ 
          type      : "POST", 
          url       : "../controller/calculatecost.php", 
          data      : {
                      'material'  : material,
                      'size_x'    : size_x,
                      'size_y'    : size_y,
                      'size_y'    : size_y,
                      'thickness' : thickness
          },
          dataType  : 'html',
          success   : function(data) {

            document.getElementById("wo_cost").value = data;
            console.log(data);
          }
        });
      }
    </script>

    <script>
      function toggleReadOnly(inputId, checked) {
        var input = document.getElementById(inputId);
        input.readOnly = !checked;
      }
    </script>
    <script>
      function toggleReadOnly2(inputId2, inputId3, inputId4, checked) {
        var input2 = document.getElementById(inputId2);
        var input3 = document.getElementById(inputId3);
        var input4 = document.getElementById(inputId4);
        input2.checked = false;
        input3.checked = false;
        input4.checked = false;
        input2.disabled = checked;
        input3.disabled = checked;
        input4.disabled = checked;
        document.getElementById("logistic_usr").disabled = true;
        document.getElementById("safety_usr").disabled = true;
      }
    </script>

    <script>
      //Compliance Clearance related fields
      function cc_2_cb(checkbox) {
        if(checkbox.checked) {
          document.getElementById("logistic_usr").disabled = false;
        } else {
          document.getElementById("logistic_usr").disabled = true;
        }
      }

      function cc_3_cb(checkbox) {
        if(checkbox.checked) {
          document.getElementById("safety_usr").disabled = false;
        } else {
          document.getElementById("safety_usr").disabled = true;
        }
      }
    </script>

</body>
</html>

<?php    

} else {
    header("Location: ../email/general/access_denied.php");
}

?>
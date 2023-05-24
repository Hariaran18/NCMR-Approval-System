<?php
	include("../config/dbconnection.php");
	include("SimpleXLSXGen.php");

	$ncmr = [
		[
			'No', 
			'Issue Date', 
			'Lot Qty', 
			'Rejection Type', 
			'Job No', 
			'Department',
			'Operator No',
			'DO No',
			'Customer Reference No',
			'Supplier/Customer Name',
			'Rejection Classification',
			'Other Classification',
			'Part No',
			'NC Qty',
			'Unit',
			'Detected at',
			'Defect Desc',
			'Defect Category',
			'Disposition',
			'RTV/PRN No',
			'Sorting/Reworked by',
			'Accept pcs',
			'Reject pcs',
			'Checked by',
			'Corrective action',
			'CAR/SCAR No',
			'Replacement needed',
			'Replacement Qty',
			'ERP Part No',
			'Qty',
			'NAV Location',
			'Type',
			'Purchase Part',
			'Material',
			'Size X',
			'Size Y',
			'Thickness',
			'Total Cost',
			'Close Date',
			'Status'
			]
	];
	$no = 0;

	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	echo $start_date;
	echo $end_date;
	echo $end_date;

	if (($start_date != '') && ($end_date != '')) {
		$date_format = 'd_m';
		// Format start and end dates as strings
		$start_date_str = date($date_format, strtotime($start_date));
		$end_date_str = date($date_format, strtotime($end_date));

		// Build the filename using the formatted date strings
		$filename = "ncmr-{$start_date_str}-{$end_date_str}.xlsx";

		// Query
		$query = "SELECT * FROM form WHERE issue_date BETWEEN '$start_date' AND '$end_date' ORDER BY ncmr_no DESC";
		$res = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($res) > 0) {
			foreach ($res as $row){
				$no++;
				if(($row['form_state'] == 99) || ($row['form_state'] == 98)){
					$form_state = 'CLOSE';
				}else{
					$form_state = 'OPEN';
				}
				$ncmr = array_merge($ncmr, array(
						array(
							$no,
							$row['issued_date'], 
							$row['lot_qty'], 
							$row['rejection_chk'], 
							$row['job_no'], 
							$row['dept_name'],
							$row['operator_no'],
							$row['do_no'],
							$row['customer_ref_no'],
							$row['rejection_name'],
							$row['rejection_chk'],
							$row['classification_chk'],
							$row['part_no'],
							$row['nc_qty'],
							$row['unit'],
							$row['detected_at'],
							$row['defect_desc'],
							$row['defect_cat'],
							$row['disposition_chk'],
							$row['rtv_prn_no'],
							$row['sort_rework'],
							$row['accept_pcs'],
							$row['reject_pcs'],
							$row['checked_by'],
							$row['corrective_sel'],
							$row['car_scar_no'],
							$row['replacement_sel'],
							$row['replacement_qty'],
							$row['erp_part_no'],
							$row['erp_qty'],
							$row['loc_bin_code'],
							$row['wo_type_chk'],
							$row['wo_type_sel'],
							$row['wo_material'],
							$row['size_x'],
							$row['size_y'],
							$row['wo_thick'],
							$row['wo_cost'],
							$row['closed_date'],
							$form_state
						)
					));
			}
		}

		$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $ncmr );
		$xlsx->downloadAs($filename);
		// echo "<pre>";
		// print_r($ncmr);
	} else {
		echo "<script>alert('ERROR! Invalid Date.')</script>";
?>
		<meta http-equiv="refresh" content="0; url=../view/report.php"/>
<?php
	}
	
?>
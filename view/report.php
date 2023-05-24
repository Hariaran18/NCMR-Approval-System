<?php
	include("../config/dbconnection.php");
	include("../config/navigationbar.php");

	if($_SESSION["username"]) {
?>

<html>
	<head>
		<title>E-NCMR SYSTEM - Report</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="../src/css/list_view_style.css"/>
	</head>
	<body>
		<div class="container">
			<br>
			<h1 class="text-center">E-NCMR Form List</h1>
			<h4 class="text-center">Generate NCMR Report</h4>
			<hr width = 80%>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body pb-0">
						<div class="card-actions">
							<form class="form-group" action="../controller/export.php" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-5">
										<label class="font-weight-bold">Start Date</label>
										<input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start date">
									</div>
									<div class="form-group col-md-5">
										<label class="font-weight-bold">End Date</label>
										<input type="date" class="form-control" id="end_date" name="end_date" placeholder="End date">
									</div>
								</div>
								<div class="float-right">
									<button type="submit" class="btn btn-primary" name="filter_btn" id="filter_btn">Export to Excel</button>
								</div>
								</br>
							</form>
							</br>
						</div>
					</div>
		<?php
	} else {
		header("Location: ../email/general/access_denied.php");
	}
						
?>

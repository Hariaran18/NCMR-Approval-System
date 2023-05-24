<?php
    include ("../config/dbconnection.php");
	include ("../config/config.php");
    include ("../config/navigationbar.php");

	if($_SESSION['username'] != '') {

		if($_SESSION['role'] == 'Approver') {

		$s_name = $_SESSION['name'];

		$query = "	SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form`
					WHERE (`ack_name`='$s_name' AND `form_state`=$f_ack)
					OR (`review_name`='$s_name' AND `form_state`=$f_rev)
					OR (`prod_mng`='$s_name' AND `form_state`=$f_prodmng)
					OR (`qa_mng`='$s_name' AND `form_state`=$f_qamng)
					OR (`dgm_gm`='$s_name' AND `form_state`=$f_dgm)
					OR (`logistic_usr`='$s_name' AND `form_state`=$f_custom)
					OR (`safety_usr`='$s_name' AND `form_state`=$f_doe)
					OR (`issued_name`='$s_name' AND `form_state`=$f_dispose)
					OR (`finance_name`='$s_name' AND `form_state`=$f_finance)
					OR (`issued_name`='$s_name' AND `form_state`=$f_complete)
					ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `review_name`='$s_name' AND `form_state`=1 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `prod_mng`='$s_name' AND `form_state`=2 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `qa_mng`='$s_name' AND `form_state`=3 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `dgm_gm`='$s_name' AND `form_state`=4 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `logistic_usr`='$s_name' AND `form_state`=5 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `safety_usr`='$s_name' AND `form_state`=6 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `issued_name`='$s_name' AND `form_state`=9 ORDER BY ncmr_no DESC";
		// $query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM `form` WHERE `form_state`=100 ORDER BY ncmr_no DESC";

		if ($result = $conn->query($query)) {
?>
	



<html>
	<head>
		<title>E-NCMR SYSTEM - Approval</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="../src/css/list_view_style.css"/>
		<style>
			input[type="search"] {
				width: 100%;
				padding: 10px;
				border: 2;
				border-radius: 5px;
				font-size: 14px;
				outline: none;
			}
		</style>
	</head>
	<div class="container">
		<br>
		<h1 class="text-center">E-NCMR Form List</h1>
        <h4 class="text-center">Pending Approval</h4>
      	<hr width = 80%>
		<!-- <div> -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header pb-0">
						<div class="card-actions float-right search-container">
							<input class="form-outline" id="searchInput1" type="search" onkeyup="searchFunction1()" placeholder="Search...">
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped" style="width:100%" id="table1">
							<thead>
								<tr>
									<th>NCMR No</th>
									<th>Part No</th>
									<th>Issued Date</th>
									<th>Issued By</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

<?php
        while ($row = $result->fetch_assoc()) {
?>
								<tr>
									<td><?php echo($row["ncmr_no"]);?></td>
									<td><?php echo($row["part_no"]);?></td>
									<td><?php echo($row["issued_date"]);?></td>
									<td><?php echo($row["issued_name"]);?></td>
									<td><?php if ($row["form_state"]=='0'){ echo '<span class="badge badge-primary">Pending Acknowledge</span>';}?>
										<?php if ($row["form_state"]=='1'){ echo '<span class="badge badge-warning">Pending Review</span>';}?>
										<?php if ($row["form_state"]=='2'){ echo '<span class="badge badge-warning">Pending PM Approval</span>';}?>
										<?php if ($row["form_state"]=='3'){ echo '<span class="badge badge-warning">Pending QA Approval</span>';}?>
										<?php if ($row["form_state"]=='4'){ echo '<span class="badge badge-warning">Pending GM/DGM Approval</span>';}?>
										<?php if ($row["form_state"]=='5'){ echo '<span class="badge badge-warning">Pending Logistic Approval</span>';}?>
										<?php if ($row["form_state"]=='6'){ echo '<span class="badge badge-warning">Pending Safety Approval</span>';}?>
										<?php if ($row["form_state"]=='8'){ echo '<span class="badge badge-warning">Pending Disposal</span>';}?>
										<?php if ($row["form_state"]=='9'){ echo '<span class="badge badge-warning">Pending Finance Approval</span>';}?>
										<?php if ($row["form_state"]=='97'){ echo '<span class="badge badge-warning">Pending Close Form</span>';}?>
										<?php if ($row["form_state"]=='98'){ echo '<span class="badge badge-danger">Rejected</span>';}?>
										<?php if ($row["form_state"]=='99'){ echo '<span class="badge badge-success">Completed</span>';}?>
									</td>
									<td>
										<a href="approval_view.php?edit=<?php echo $row['ncmr_no'] ?>" class="btn btn-dark btn-sm">View</a>
									</td>
								</tr>
<?php
        }
?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>

	<script>
		function searchFunction1() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("searchInput1");
			filter = input.value.toUpperCase();
			table = document.getElementById("table1");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td");
				for (j = 0; j < td.length; j++) {
					txtValue = td[j].textContent || td[j].innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
						break;
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
	
</html>

		<?php    
				/*freeresultset*/
				$result->free();
				
			}
			else {
				echo "No result found";
			}
	} else {
		header("Location: ../email/general/access_denied.php");
	}} else {
		header("Location: ../email/general/page_not_found.php");
	}
						
	?>
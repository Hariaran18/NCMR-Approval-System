<?php
    include ("../config/dbconnection.php");
    include ("../config/navigationbar.php");

	if($_SESSION["username"]) {

		$query = "SELECT ncmr_no, issue_date, part_no, issued_date, issued_name, form_state FROM form WHERE form_state NOT IN (98, 99) ORDER BY ncmr_no DESC";    

		if ($result = $conn->query($query)) {
?>
	



<html>
	<head>
		<title>E-NCMR SYSTEM - Application</title>
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
		<h4 class="text-center">Application List (Pending)</h4>
      	<hr width = 80%>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header pb-0">
						<div class="card-actions float-right search-container">
							<input class="form-outline" id="searchInput" type="search" onkeyup="searchFunction()" placeholder="Search...">
						</div>
					</div>
					
					<div class="card-body">
						<table class="table table-striped" style="width:100%" id="table">
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
										<a href="view.php?edit=<?php echo $row['ncmr_no'] ?>" class="btn btn-dark btn-sm">View</a>
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
	</div>

	<script>
		function searchFunction() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("searchInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("table");
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
        $result->free();
        
    } else {
        echo "No result found";
    }

} else {
	header("Location: ../email/general/page_not_found.php");
}

?>
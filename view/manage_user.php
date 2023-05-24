<?php
    include ("../config/dbconnection.php");
    include ("../config/navigationbar.php");

	if($_SESSION["username"]) {
		if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {

		$query = "SELECT * FROM user ORDER BY emp_id DESC";    

		if ($result = $conn->query($query)) {
?>
	



<html>
	<head>
		<title>E-NCMR SYSTEM</title>
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
		<h4 class="text-center">Manage User</h4>
      	<hr width = 80%>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header pb-0">
						<div class="card-actions float-left search-container">
							<input class="form-outline" id="searchInput" type="search" onkeyup="searchFunction()" placeholder="Search...">
						</div>
						<div class="float-right">
							<a href="create_user.php" class="btn btn-success">Create User</a>
						</div>
					</div>
					
					<div class="card-body">
						<table class="table table-striped" style="width:100%" id="table">
							<thead>
								<tr>
                                    <th>Employee ID</th>
									<th>Username</th>
									<th>Name</th>
                                    <th>Email</th>
                                    <th>Access</th>
                                    <th>Role</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>

<?php
        while ($row = $result->fetch_assoc()) {
?>
								<tr>
                                    <td><?php echo($row["emp_id"]);?></td>
									<td><?php echo($row["username"]);?></td>
									<td><?php echo($row["name"]);?></td>
                                    <td><?php echo($row["email"]);?></td>
                                    <td><?php echo($row["access"]);?></td>
                                    <td><?php echo($row["role"]);?></td>
									<td class="row">
										<div><a href="edit_user.php?emp_id=<?php echo $row['emp_id'] ?>" class="btn btn-primary btn-sm">Edit</a></div>
										<div><a href="delete_user.php?emp_id=<?php echo $row['emp_id'] ?>" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></div>
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
			echo "No user found!";
		}

	} else {
		header("Location: ../email/general/access_denied.php");
	}
} else {
	header("Location: ../email/general/page_not_found.php");
}

?>
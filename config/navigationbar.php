<?php
  include ("dbconnection.php");
  include ("config.php");
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
		/* Custom CSS to change dropdown background color on hover */
		.dropdown-menu a:hover {
			background-color: #757575;
			color: #fff;
		}
		.bubble {
			position: relative;
			display: inline-block;
			background-color: #FF0000;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 4px 8px;
			border-radius: 25%;
			top: -5px;
			margin-left: 5px;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href=".\dashboard.php">eNCMR</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <?php
	    // Check if the user is logged in
	    if (isset($_SESSION['username'])) {
	  ?>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
		  <li class="nav-item active">
            <a class="nav-link" href="../view/dashboard.php">DASHBOARD<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../view/form.php">CREATE NCMR<span class="sr-only">(current)</span></a>
          </li>
          <?php if($_SESSION['access'] == 'admin'){ ?>
            <li class="nav-item active">
              <a class="nav-link" href="../view/manage_user.php">MANAGE USER<span class="sr-only">(current)</span></a>
            </li>
          <?php } ?>
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              APPLICATIONS
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../view/list_view_pending.php">PENDING</a>
              <a class="dropdown-item" href="../view/list_view_closed.php">CLOSED</a>
            </div>
          </li>
          <?php if($_SESSION['role'] == 'Approver'){ ?>
            <li class="nav-item active">
              <a class="nav-link" href="../view/approval_list.php">APPROVAL
			
			<?php 
				$s_name = $_SESSION['name'];

				$sql = "	SELECT COUNT(*) AS count FROM `form`
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
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$count = $row['count'];
				// Display the bubble icon with the count if there are pending approvals
				if ($count > 0) {
					echo '<span class="bubble">' . $count . '</span>';
				}
			?>
			
			<span class="sr-only">(current)</span></a>
            </li>
          <?php } ?>
          <li class="nav-item active">
            <a class="nav-link" href="../view/report.php">REPORT<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <ul class="navbar-nav">
	        <li class="nav-item dropdown active">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            <?php echo $_SESSION['name']; ?>
	          </a>
	          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              	<a class="dropdown-item" href="../view/profile.php">Profile</a>
	            <a class="dropdown-item" href="../controller/logout.php" onclick="return confirm('Are you sure want to logout?');">Log Out <span class="sr-only">(current)</span></a>
	          </div>
	        </li>
	      </ul>
	    </div>
	  <?php
	    }
	  ?>
	</nav>


	<!-- Include Bootstrap JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

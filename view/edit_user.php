<?php
    include ("../config/dbconnection.php");
    include ("../config/navigationbar.php");

	if($_SESSION["username"]) {
	    if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {

    $emp_id = $_GET['emp_id'];

    $sql = "SELECT * FROM `user` WHERE emp_id = '".$emp_id."'";
    $qry = mysqli_query($conn,$sql);

    $query = mysqli_fetch_assoc($qry);

    $username = $query['username'];
    $password = $query['password'];
    $name = $query['name'];
    $email = $query['email'];
    $emp_id = $query['emp_id'];
    $access = $query['access'];
    $role = $query['role'];

?>


<!DOCTYPE html>
    <html>
        <head>
            <title>E-NCMR SYSTEM - Create User</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" type="text/css" href="../src/css/list_view_style.css"/>
        </head>
        <body>
            <div class="container">
                <br>
                <h1 class="text-center">E-NCMR SYSTEM</h1>
                <h4 class="text-center">Edit User</h4>
                <hr width="80%">
                <form class="form-group" action="../controller/modify_user.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td><label for="emp_id">Employee ID</label></td>
                            <td><input type="text" class="form-control" id="emp_id" name="emp_id" value="<?php echo $emp_id; ?>" readonly></td>
                            <td><label for="username">Username</label></td>
                            <td><input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"></td>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="access">Access level</label></td>
                            <td>
                                <select class="form-control" id="access" name="access">
                                    <option value="user" <?php echo ($access == 'user') ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo ($access == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="superuser" <?php echo ($access == 'superuser') ? 'selected' : ''; ?>>SuperUser</option>
                                </select>
                            </td>
                            <td><label for="role">Role</label></td>
                            <td>
                                <select class="form-control" id="role" name="role">
                                    <option value="">Select role</option>
                                    <option value="User" <?php echo ($role == 'User') ? 'selected' : ''; ?>>User</option>
                                    <option value="Approver" <?php echo ($role == 'Approver') ? 'selected' : ''; ?>>Approver</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
    </html>



<?php    
        } else {
            header("Location: ../email/general/access_denied.php");
        }
    } else {
        header("Location: ../email/general/page_not_found.php");
    }

?>
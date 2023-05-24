<?php
    include ("../config/dbconnection.php");
    include ("../config/navigationbar.php");

	if($_SESSION["username"]) {
	    if(($_SESSION['access'] == "admin") || ($_SESSION['access'] == "superuser")) {
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
                <h4 class="text-center">Create User</h4>
                <hr width="80%">
                <form class="form-group" action="../controller/insert_user.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td><label for="username">Username</label></td>
                            <td><input type="text" class="form-control" id="username" name="username" required></td>
                            <td><label for="password">Password</label></td>
                            <td><input type="password" class="form-control" id="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input type="text" class="form-control" id="name" name="name" required></td>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" class="form-control" id="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label for="emp_id">Employee ID</label></td>
                            <td><input type="text" class="form-control" id="emp_id" name="emp_id" required></td>
                            <td><label for="access">Access level</label></td>
                            <td>
                                <select class="form-control" id="access" name="access" required>
                                    <option value="">Select access level</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superuser">SuperUser</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="role">Role</label></td>
                            <td>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Select role</option>
                                    <option value="User">User</option>
                                    <option value="Approver">Approver</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create User</button>
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
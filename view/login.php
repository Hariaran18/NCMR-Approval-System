<!DOCTYPE html>
<html lang="en" >

  <head>
    <meta charset="UTF-8">
      <title>eNCMR System</title>
      <link rel="stylesheet" href="../src/bootstrap/css/style2.css"> 
  </head>

  <body>
    <?php
      $error='';
      //Variable to store error message;
      if(isset($_POST["submit2"])){
        if(empty($_POST['user']) || empty($_POST['pass'])){
          $error = "Username or Password is Invalid";      
        }
        else
        {
          //Define $user and $pass
          $user=$_POST['user'];
          $pass=md5($_POST['pass']);
          
          // Connection Myphpmyadmin
          include ("../config/dbconnection.php");

          //sql query to fetch information of registerd user and finds user match.
          $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `username`='$user' AND `password`='$pass'");
          $rows = mysqli_num_rows($query);
          $qry_val = mysqli_fetch_assoc($query);
          
          
          if($rows == '1'){
            //redirect to other page
            session_start();
            $_SESSION["username"] = $qry_val['username'];
            $_SESSION["name"] = $qry_val['name'];
            $_SESSION["access"] = $qry_val['access'];
            $_SESSION["email"] = $qry_val['email'];
            $_SESSION["hod"] = $qry_val['hod'];
            $_SESSION["role"] = $qry_val['role'];

            if($_SESSION["role"] == 'Approver'){
              header("location:dashboard.php");
            } else{
              header("location:dashboard.php");
            }
          }
          else
          {
            $error = "The username and password you entered did not match our records. Please try again.";
          }
          mysqli_close($conn); // Close connection
        }        
      }
    ?>

    <hgroup>
      <h1>eNCMR System Login</h1>
    </hgroup>

    <form action="" method="POST">
        <div class="group">
          <input type="text" name="user" placeholder="Username"><span class="highlight" ></span><span class="bar"></span>
        </div>
        <div class="group">
          <input type="password" name="pass" placeholder="Password"><span class="highlight"></span><span class="bar"></span>
        </div>
        <div class="group">
          <button type="submit" class="login" name="submit2">Login</button>
        </div>
        <span class="error-message"><?php echo $error;?></span>
    </form>

    <script src="/localhost/MIS/boostrap/jquery-3.2.1.slim.min.js" ></script>
    <script  src="../src/bootstrap/js/index.js"></script>

  </body>

</html>

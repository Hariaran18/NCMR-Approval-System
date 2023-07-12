<?php
  if ($_GET['error_msg']) {
    $error_msg = $_GET['error_msg'];
  } else {
    $error_msg = "";
  }
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
  <style>
    body {
      text-align: center;
      padding: 40px 0;
      background: #EBF0F5;
    }
      h1 {
        color: #cc3300;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
      }
      p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:20px;
        margin: 0;
      }
    i {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left:-15px;
    }
    .card {
      background: white;
      padding: 60px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 0 auto;
    }
  </style>
  <body>
    <div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #fce4dc; margin:0 auto;">
      <i class="checkmark">❌</i>
    </div>
      <h1>Failure</h1>
      <p><?php echo $error_msg; ?></p><br/>
      <p>The NCMR Form REJECTION FAILED!<br/>Please contact MIS Department.<br/>Thank you!<br/><br/></p>
      <p>You will be redirected in <span id="countdown">5</span> seconds.</p>
    </div>
  </body>

  <script>
    // Countdown function
    function countdown() {
      var count = document.getElementById("countdown").innerHTML;
      if (count > 0) {
        document.getElementById("countdown").innerHTML = count - 1;
      } else {
        clearInterval(counter);
        window.location.href = "http://192.168.1.235:8088/ncmr/view/approval_list.php";
      }
    }
    // Run countdown every second
    var counter = setInterval(countdown, 1000);
  </script>
  
</html>
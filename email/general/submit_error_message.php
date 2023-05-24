<!DOCTYPE html>
<html>
<head>
  <style>
    .container {
      text-align: center;
      margin-top: 50px;
    }
    h1 {
      font-size: 40px;
      color: red;
      animation: shake 0.5s ease-in-out infinite;
    }
    @keyframes shake {
      0% { transform: translate(1px, 1px) rotate(0deg); }
      10% { transform: translate(-1px, -2px) rotate(-1deg); }
      20% { transform: translate(-3px, 0px) rotate(1deg); }
      30% { transform: translate(3px, 2px) rotate(0deg); }
      40% { transform: translate(1px, -1px) rotate(1deg); }
      50% { transform: translate(-1px, 2px) rotate(-1deg); }
      60% { transform: translate(-3px, 1px) rotate(0deg); }
      70% { transform: translate(3px, 1px) rotate(-1deg); }
      80% { transform: translate(-1px, -1px) rotate(1deg); }
      90% { transform: translate(1px, 2px) rotate(0deg); }
      100% { transform: translate(1px, -2px) rotate(-1deg); }
    }
    .try-again-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
        margin: 0 auto;
        text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Error Occurred, Please Try Again!!!</h1>
    <img src="../../src/img/error.png" alt="error graphic" style="width:500px;height:400px;">
  </div>
  <div class="container">
    <a href="http://192.168.1.235:8088/ncmr_test/view/form.php" class="try-again-button">Try Again</a>
  </div>
</body>
</html>

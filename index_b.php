<?php 

error_reporting(0);

@ini_set('display_errors', 0);

 session_start();

  if(isset($_SESSION['user_email'])){

    header("location: home.php");

 }

?>

<html>

<head>

	<title>the SocialNetwork | Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="style/css.css" type="text/css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <script src="https://www.google.com/recaptcha/api.js?render=6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK"></script>

  <script>

        grecaptcha.ready(function () {

            grecaptcha.execute('6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK', { action: 'login' }).then(function (token) {

                var recaptchaResponse = document.getElementById('recaptchaResponse');

                recaptchaResponse.value = token;

            });

        });

    </script>

</head>

<style type="text/css">

  body{

   background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);

  }

</style>

<body>



	<form class="box" action="" method="post" name="login_form">

      <h1 style="color: white;">Login</h1>

      <img src="images/logo.png" alt="Smiley face" width="90">

      <input type="text" name="email" placeholder="Email">

      <input type="password" name="pass" placeholder="Password">

      <button class="btn btnindex" name="login" />Login </button>

      <div style="color: #9C9C9C; font-size: 13px;">

        <p>If you don't have a login, please <a class="login_btn" href="signup.php">register</a></p>

       <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

        <?php include("login.php"); ?>

      </div>

    </form>

</body>

</html>
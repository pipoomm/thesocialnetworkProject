<?php 
error_reporting(0);
@ini_set('display_errors', 0);
session_start();
  if(isset($_SESSION['user_email'])){
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>the SocialNetwork | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfunction/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfunction/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfunction/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginfunction/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfunction/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginfunction/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginfunction/css/main.css">
<!--===============================================================================================-->

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
<!--===============================================================================================-->
</head>
<style>
	.input100{
		border-radius: 15px;
	}
	.focus-input100 {
		border-radius: 15px;
	}
</style>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="loginfunction/images/img-02.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post" name="login_form">
					<span class="login100-form-title">
						the Social Network
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
						<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="signup.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					<?php include("login.php"); ?>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="loginfunction/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="loginfunction/vendor/bootstrap/js/popper.js"></script>
	<script src="loginfunction/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="loginfunction/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="loginfunction/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="loginfunction/js/main.js"></script>

</body>
</html>
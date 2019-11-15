<?php
session_start();
include("includes/header.php");

 if(!isset($_SESSION['user_email'])){
 	header("location: index.php");
 }
?>

<html>
<head>
	<?php 
			$email = $_SESSION['user_email'];
			$get_user = "SELECT * FROM `users` WHERE user_email='$email'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
			$user_id = $row['user_id']; 
			$user_name = $row['user_name'];
			$f_name = $row['f_name'];
		?>
	<title>Find People</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style.css">
     <script src="https://www.google.com/recaptcha/api.js?render=6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK"></script>
  <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
</head>
<style type="text/css">
.form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
body {
    background-image: linear-gradient( 109.6deg,  rgba(0,182,255,1) 11.2%, rgba(102,51,153,1) 91.1% );
}
</style>
<body>
<!--<div class="row">
	<div class="col-sm-12">
		<center><h2>Find New People</h2></center><br><br>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			<form class="search_form" action="">
			  <input type="text" placeholder="Search Friends" name="search_user">
			  <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
			</form>
			</div>
			<div class="col-sm-4">
			</div>
		</div><br><br>
		<?php //search_user();?>
	</div>
</div>-->
<div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="text" placeholder="Name of user" name="search_user">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" name="search_user_btn" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
                    <?php search_user();?>
</div>
</body>
</html>
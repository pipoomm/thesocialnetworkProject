<?php

session_start();

include("includes/header.php");



 if(!isset($_SESSION['user_email'])){

 	header("location: index.php");

 }

?>



<html>

<head>

	<title>Edit Account</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK"></script>

      <script>

            grecaptcha.ready(function () {

                grecaptcha.execute('6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK', { action: 'social' }).then(function (token) {

                    var recaptchaResponse = document.getElementById('recaptchaResponse');

                    recaptchaResponse.value = token;

                });

            });

        </script>

</head>

<style type="text/css">

body 

{

	background: -webkit-linear-gradient(top, #005aa7, #fffde4);

}

html {

  scroll-behavior: smooth;

}

.main-content{

        width: 750px;

        margin: 50px auto;

        border-radius: 0.5rem;

        background: rgba(255,255,255,.9);

        padding: 40px 50px;

        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);

    }

    .header{

        border: 0px solid #000;

        margin-bottom: 5px;

    }



</style>

<body>

    <div class="row">

  <div class="col-sm-3"></div>

  <div class="col-sm-6" id="newsfeed">

    <br><br><h1 style="font-size: 3.5rem;color: #fff;font-weight: bolder;">Account Settings</h1>

    </div>

  <div class="col-sm-3"></div>

</div>

<div class="row">

    <div class="col-sm-12">

        <div class="main-content">

            <div class="l-part">

                <form action="" method="post">

                    <div class="form-row">

                    <div class="form-group col-md-6">

                    	<label for="inputEmail4">Firstname</label>

                        <input class="form-control" type="text" name="f_name"

                        id="fname" placeholder="Name" required="required" value="<?php echo $first_name;?>"/>

                    </div>

                   <div class="form-group col-md-6">

                   	<label for="inputEmail4">Lastname</label>

                        <input class="form-control" type="text" name="l_name" id="lname" placeholder="Lastname" required="required" value="<?php echo $last_name;?>"/>

                    </div>

                </div>

                    <div class="form-group">

                    	<label for="inputEmail4">Email</label>

                       <input class="form-control" type="email" id="email" placeholder="Email" name="u_email" required="required" value="<?php echo $user_email;?>"></td>

                    </div>



                     <div class="form-group">

                     	<label for="inputEmail4">Username</label>

      <label class="sr-only" for="inlineFormInputGroup">Username</label>

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text">@</div>

        </div>

        <input type="text" class="form-control" name="u_name" id="inlineFormInputGroup" value="<?php echo $user_name;?>" placeholder="Username">

      </div>

    </div>

                    <div class="form-group">

                        <label>Current Password</label>

                        <input id="oldpassword" type="password" class="form-control" placeholder="Password" name="c_pass" required="required">

                    </div>



                    <div class="form-group">

                    	<label>New Password</label>

                        <input id="password" type="password" class="form-control" placeholder="New Password" name="u_pass" required="required">

                    </div>

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input id="password_m" type="password" class="form-control" placeholder="Confirm new password" required="required">

                    </div>



                    <div class="form-group">

                    	<label for="inputEmail4">Country</label>

                        <select class="form-control" name="u_country" required="required">

                            <option><?php echo $user_country;?></option>

                            <option>China</option>

                            <option>France</option>

                            <option>Germany</option>

                            <option>India</option>

                            <option>Japan</option>

                            <option>Malaysia</option>

                            <option>Russia</option>

                            <option>Singapore</option>

                            <option>South Korea</option>

                            <option>Thailand</option>

                            <option>United Kingdom</option>

                            <option>United States of America</option>

                        </select>

                    </div>

                    <div class="form-group">

                    	<label for="inputEmail4">Gender</label>

                        <select class="form-control input-md" name="u_gender" required="required">

                            <option><?php echo $user_gender;?></option>

                            <option>Male</option>

                            <option>Female</option>

                            <option>Others</option>

                        </select>

                    </div>

                    <div class="form-group">

                    	<label for="inputEmail4">Date of Birth</label>

                        <input type="date" name="u_birthday" class="form-control input-md" value="<?php echo $user_birthday;?>" required="required" >

                    </div>

                    <div class="form-group">

                    	<label for="inputEmail4">Info</label>

                        <input class="form-control" type="text" placeholder="Describe" name="describe_user" required="required" value="<?php echo $describe_user;?>"/>

                    </div>

                    <div class="form-group">

                    	<label for="inputEmail4">Relationship Status</label>

                        <select class="form-control" name="Relationship">

								<option><?php echo $Relationship_status;?></option>

								<option>Engaged</option>

								<option>Married</option>

								<option>Single</option>

								<option>In a Replationship</option>

								<option>It's complicated</option>

								<option>Separated</option>

								<option>Divorced</option>

								<option>Widowed</option>

							</select>

                    </div>

                   <br><br>

                   <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                    <center><input class="btn btn-info" type="submit" name="update" value="Apply Settings"/> </center>

                </form>

            </div>

        </div>

    </div>

</div>



</body>

<script src="dist/bootstrap-validate.js"></script>

<script>

bootstrapValidate(['#fname', '#lname'], 'regex:^[a-zA-Z]+$:Not contain special symbol and number|min:3:Enter at least 3 characters!');

bootstrapValidate('#email', 'email:Enter a valid E-Mail!');

bootstrapValidate('#password', 'min:9:Enter at least 9 characters!');

bootstrapValidate('#password_m', 'matches:#password:Your passwords should match');

</script>

</html>



<?php 

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['update'])) {



        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

        $recaptcha_secret = '6LfHs8IUAAAAABPW8ePUcmohMuvxRAd8BkjE9MfT';

        $recaptcha_response = $_POST['recaptcha_response'];



        // Make and decode POST request:

        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

        $recaptcha = json_decode($recaptcha);

	

        if ($recaptcha->score >= 0.5)

        {

            $c_pass = htmlentities($_POST['c_pass']);



            $select_user = "SELECT * FROM `users` WHERE user_email='$user_email' AND status='verified'";

            $query= mysqli_query($con, $select_user);

            $data = mysqli_fetch_assoc($query);



            if (password_verify($c_pass, $data['user_pass'])) {



        		$f_name = htmlentities($_POST['f_name']);

        		$l_name = htmlentities($_POST['l_name']);

        		$u_name = htmlentities($_POST['u_name']);

        		$describe_user = htmlentities($_POST['describe_user']);

        		$Relationship_status = htmlentities($_POST['Relationship']);

        		$u_pass = htmlentities($_POST['u_pass']);

        		$u_email = htmlentities($_POST['u_email']);

        		$u_country = htmlentities($_POST['u_country']);

        		$u_gender = htmlentities($_POST['u_gender']);

        		$u_birthday = htmlentities($_POST['u_birthday']);

        		$u_pass = password_hash($_POST['u_pass'], PASSWORD_DEFAULT);

        		



        		

        		$update = "UPDATE `users` SET f_name='$f_name', l_name='$l_name',user_name='$u_name',describe_user='$describe_user',Relationship='$Relationship_status', user_pass='$u_pass',user_email='$u_email',user_country='$u_country',user_gender='$u_gender',user_birthday='$u_birthday' WHERE user_id='$user_id'";



        		//$update = "UPDATE `users` SET f_name='$f_name',l_name='$l_name',user_name='$u_name',describe_user='$describe_user',Relationship='$Relationship_status',user_pass='$u_pass',user_email='$u_email',user_country='$u_country',user_gender='$u_gender',user_birthday='$u_birthday'user_id='$user_id'";

        		

        		$run = mysqli_query($con,$update); 

        		

        		if($run){

        		echo "<script>

                    Swal.fire({

                        text: 'Account information has been updated!',

                        type: 'success'

                        }).then(function() {

                         window.location = 'profile.php';

                    });

                    </script>";

        		}

            }else{

                echo "<script>

            Swal.fire({

            text: 'Password not correct!',

            type: 'error',

            confirmButtonText: 'OK'

            })</script>";

            }

	   }

       else {

        echo "<script>

            Swal.fire({

            text: 'You are robot!',

            type: 'error',

            confirmButtonText: 'OK'

            })</script>";

    }

    

	}

?>
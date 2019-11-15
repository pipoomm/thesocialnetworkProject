<?php
include("includes/connection.php");

	if(isset($_POST['sign_up']))
	{
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key

        $secret = '6Lfc3MAUAAAAAE_ul6UqLsK_xdghZ9LKIz9WgUAc';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        print_r($responseData);

        $name = !empty($_POST['name'])?$_POST['name']:'';
        $email = !empty($_POST['email'])?$_POST['email']:'';
        $message = !empty($_POST['message'])?$_POST['message']:'';
        $user_id=$_SESSION['id'];   
        if($responseData->success):
           { //contact form submission code
           $first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
		$status = "verified";
		$posts = "no";
		$newgid = sprintf('%05d', rand(0, 99999));

		$username = strtolower($last_name . "." . $first_name . "_" . $newgid);
		$check_username_query = "SELECT user_name FROM users WHERE user_email='$email'";
		$run_username = mysqli_query($con,$check_username_query);

		if(strlen($pass) <9 ){
			echo "<script>
			Swal.fire({
  			text: 'Password must be more 9 character',
  			type: 'warning',
  			confirmButtonText: 'OK'
				})</script>";
			exit();
		}

		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$check_email = "SELECT * FROM `users` WHERE user_email='$email'";
		$run_email = mysqli_query($con,$check_email);

		$check = mysqli_num_rows($run_email);
		//echo $check;
		if($check != 0){
			echo "<script>
			Swal.fire({
  			text: 'This email already exist, Please use another email address',
  			type: 'warning',
  			confirmButtonText: 'OK'
				})</script>";
			//echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		$rand = rand(1, 8); //Random number between 1 and 3

			if($rand == 1)
				$profile_pic = "cat1.png";
			else if($rand == 2)
				$profile_pic = "cat2.png";
			else if($rand == 3)
				$profile_pic = "cat3.png";
			else if($rand == 4)
				$profile_pic = "cat4.png";
			else if($rand == 5)
				$profile_pic = "cat5.png";
			else if($rand == 6)
				$profile_pic = "cat6.png";
			else if($rand == 7)
				$profile_pic = "cat7.png";
			else if($rand == 8)
				$profile_pic = "cat8.png";

		$insert = "INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `Relationship`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_cover`, `user_reg_date`, `status`, `posts`, `recovery_aaccount`) VALUES (NULL, '".$first_name."', '".$last_name."', '".$username."', 'Status not set', '...', '".$pass."', '".$email."', '".$country."', '".$gender."', '".$birthday."', '".$profile_pic."', 'default_cover.jpg', CURRENT_TIMESTAMP, '".$status."', '".$posts."', 'nowwiforgotit')";
		
		$query = mysqli_query($con, $insert);

		if($query){
			//echo "<script>alert('Welcome $first_name, your account has been created.')</script>";
			echo "<script>
			Swal.fire({
    			title: 'Account has been created',
   				 text: 'Welcome $first_name, You will redirect to login page! ',
    			type: 'success'
				}).then(function() {
   				 window.location = 'index.php';
			});
			</script>";
			//echo "<script>window.open('main.php', '_self')</script>";
		}
		else{
			echo "<script>
			Swal.fire({
    			title: 'Database Error',
   				text: 'Error to create account, Please try again.',
    			type: 'error'
				}).then(function() {
   				 window.location = 'signup.php';
			});
			</script>";
		}
           }
        else:
            echo "<script>
			Swal.fire({
    			title: 'reCAPTCHA fail',
    			text:You are not human!,
    			type: 'warning'
				}).then(function() {
   				 window.location = 'signup.php';
			});
			</script>";
        endif;
    else:
        echo "<script>
			Swal.fire({
    			title: 'reCAPTCHA not verified',
    			type: 'warning'
				}).then(function() {
   				 window.location = 'signup.php';
			});
			</script>";
    endif;

		
	}
?>
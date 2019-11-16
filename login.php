<?php // Check if form was submitted:

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['login'])) {



    // Build POST request:

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

    $recaptcha_secret = '6LfHs8IUAAAAABPW8ePUcmohMuvxRAd8BkjE9MfT';

    $recaptcha_response = $_POST['recaptcha_response'];



    // Make and decode POST request:

    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.5) {

        include "includes/connection.php";

		session_start();



		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));

		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));



		$select_user = "SELECT * FROM `users` WHERE user_email='$email' AND status='verified'";

		$query= mysqli_query($con, $select_user);

		$data = mysqli_fetch_assoc($query);



		if (password_verify($pass, $data['user_pass'])) 

		{

 			$_SESSION['user_email'] = $data['user_email'];

			$_SESSION['user_id'] = $data['user_id'];

			$_SESSION['f_name'] = $data['f_name'];

			$_SESSION['l_name'] = $data['l_name'];

			$_SESSION['user_name'] = $data['user_name'];

			$_SESSION['describe_user'] = $data['describe_user'];

			$_SESSION['Relationship'] = $data['Relationship'];

			$_SESSION['user_pass'] = $data['user_pass'];

			$_SESSION['user_country'] = $data['user_country'];

			$_SESSION['user_gender'] = $data['user_gender'];

			$_SESSION['user_birthday'] = $data['user_birthday'];

			$_SESSION['user_image'] = $data['user_image'];

			$_SESSION['user_cover'] = $data['user_cover'];

			$_SESSION['user_reg_date'] = $data['user_reg_date'];

			$_SESSION['status'] = $data['status'];

			$_SESSION['posts'] = $data['posts'];

			$_SESSION['recovery_aaccount'] = $data['recovery_aaccount'];

			echo "<script>window.open('home.php', '_self')</script>";

 		}

 		else 

 		{

    // Incorrect password

 			echo "<script>

			Swal.fire({

  			text: 'Email or Password is incorrect',

  			type: 'error',

  			confirmButtonText: 'OK'

				})
				console.log($recaptcha->score);
				</script>";

  		} 





    } else {

        echo "<script>

			Swal.fire({

  			text: 'You are robot!',

  			type: 'error',

  			confirmButtonText: 'OK'

			})</script>";

    }



}

 ?>


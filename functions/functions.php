<?php 



function insertPost()

{

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['sub'])) 

	{



    // Build POST request:

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

    $recaptcha_secret = '6LfHs8IUAAAAABPW8ePUcmohMuvxRAd8BkjE9MfT';

    $recaptcha_response = $_POST['recaptcha_response'];



    // Make and decode POST request:

    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.5) {

        	global $con;

			global $user_id;

		$content = htmlentities($_POST['content']);
		$location = htmlentities($_POST['location']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

		if(strlen($content) > 140)
		{
			echo "<script>
			Swal.fire({
  			text: 'Character limit is 140 character',
  			type: 'warning',
  			confirmButtonText: 'OK'
				})</script>";
			//echo "<script>window.open('home.php', '_self')</script>";
		}

		else

		{

			if(strlen($upload_image) >= 1 && strlen($content) >= 1 && strlen($location) >= 1)
			{
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

				$insert = "INSERT INTO `posts` (user_id, post_content, upload_image, post_date, location) VALUES('$user_id', '$content', '$upload_image.$random_number', CURRENT_TIMESTAMP, '$location')";

				echo "<script>
			Swal.fire({
  			text: '$insert',
  			type: 'warning',
  			confirmButtonText: 'OK'
				})</script>";

				$run = mysqli_query($con, $insert);
				if($run)
				{
					echo "<script>
							const Toast = Swal.mixin({
 						 	toast: true,
  							position: 'top-end',
  							showConfirmButton: false,
  							timer: 3000
							})
							Toast.fire({
  							type: 'success',
  							title: 'Post has been updated'
							}).then(function() {
   				 				//window.location = 'home.php';
							})
							</script>";
					$update = "UPDATE `users` SET posts='yes' WHERE user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}
			}
			else if(strlen($upload_image) >= 1 && strlen($content) >= 1 && strlen($location) == 0)
			{
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

				$insert = "INSERT INTO `posts` (user_id, post_content, upload_image, post_date, location) VALUES('$user_id', '$content', '$upload_image.$random_number', CURRENT_TIMESTAMP, '')";

				echo "<script>
			Swal.fire({
  			text: '$insert',
  			type: 'warning',
  			confirmButtonText: 'OK'
				})</script>";

				$run = mysqli_query($con, $insert);
				if($run)
				{
					echo "<script>
							const Toast = Swal.mixin({
 						 	toast: true,
  							position: 'top-end',
  							showConfirmButton: false,
  							timer: 3000
							})
							Toast.fire({
  							type: 'success',
  							title: 'Post has been updated'
							}).then(function() {
   				 				//window.location = 'home.php';
							})
							</script>";
					$update = "UPDATE `users` SET posts='yes' WHERE user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}
			}
			else
			{

				if($upload_image=='' && $content == '' && $location == '')
				{
					echo "<script>
					Swal.fire({
  					text: 'Error while updating data on database',
  					type: 'error',
  					confirmButtonText: 'OK'
						})
					</script>";
					//echo "<script>window.open('home.php', '_self')</script>";
				}
				else
				{
					if($content=='' && strlen($upload_image) >= 1 && strlen($location) >= 1)
					{

						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

						$insert = "INSERT INTO `posts` (user_id,post_content,upload_image,post_date,location) VALUES ('$user_id','No','$upload_image.$random_number',CURRENT_TIMESTAMP,'$location')";

						$run = mysqli_query($con, $insert);



						if($run)
						{
							echo "<script>
							const Toast = Swal.mixin({
 						 	toast: true,
  							position: 'top-end',
  							showConfirmButton: false,
  							timer: 3000
							})
							Toast.fire({
  							type: 'success',
  							title: 'Post has been updated'
							}).then(function() {
   				 				//window.location = 'home.php';
							})
							</script>";
							//echo "<script>window.open('home.php', '_self')</script>";
							$update = "UPDATE `users` SET posts='yes' WHERE user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
					else if($content=='' && strlen($location) == 0 && strlen($upload_image) >= 1)
					{

						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

						$insert = "INSERT INTO `posts` (user_id,post_content,upload_image,post_date,location) VALUES ('$user_id','No','$upload_image.$random_number',CURRENT_TIMESTAMP,'')";

						$run = mysqli_query($con, $insert);



						if($run)
						{
							echo "<script>
							const Toast = Swal.mixin({
 						 	toast: true,
  							position: 'top-end',
  							showConfirmButton: false,
  							timer: 3000
							})
							Toast.fire({
  							type: 'success',
  							title: 'Post has been updated'
							}).then(function() {
   				 				//window.location = 'home.php';
							})
							</script>";
							//echo "<script>window.open('home.php', '_self')</script>";
							$update = "UPDATE `users` SET posts='yes' WHERE user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}

					else

					{
						//content not have ric
						if($upload_image=='' && strlen($location) >= 1){
					$insert = "INSERT INTO `posts` (`user_id`, `post_content`, `upload_image`, `post_date`, `location`) VALUES ('$user_id',  '$content', '', CURRENT_TIMESTAMP,'$location')";

						$run = mysqli_query($con, $insert);
							if($run)
							{
								echo "<script>
								const Toast = Swal.mixin({
	 						 	toast: true,
	  							position: 'top-end',
	  							showConfirmButton: false,
	  							timer: 1000
								})
								Toast.fire({
	  							type: 'success',
	  							title: 'Post has been updated'
								}).then(function() {
	   				 				//window.location = 'home.php';
								})
								</script>";
								$update = "UPDATE users SET posts='yes' WHERE user_id='$user_id'";
								$run_update = mysqli_query($con, $update);
							}
						}
						else if($upload_image=='' && strlen($location) == 0){
					$insert = "INSERT INTO `posts` (`user_id`, `post_content`, `upload_image`, `post_date`, `location`) VALUES ('$user_id',  '$content', '', CURRENT_TIMESTAMP,'')";

						$run = mysqli_query($con, $insert);
							if($run)
							{
								echo "<script>
								const Toast = Swal.mixin({
	 						 	toast: true,
	  							position: 'top-end',
	  							showConfirmButton: false,
	  							timer: 1000
								})
								Toast.fire({
	  							type: 'success',
	  							title: 'Post has been updated'
								}).then(function() {
	   				 				//window.location = 'home.php';
								})
								</script>";
								$update = "UPDATE users SET posts='yes' WHERE user_id='$user_id'";
								$run_update = mysqli_query($con, $update);
							}
						}
						else if($content=='' && $upload_image=='' && strlen($location) >= 1)
						{
							$insert = "INSERT INTO `posts` (`user_id`, `post_content`, `upload_image`, `post_date`, `location`) VALUES ('$user_id',  '', 'ax', CURRENT_TIMESTAMP,'$location')";

						$run = mysqli_query($con, $insert);
							if($run)
							{
								echo "<script>
								const Toast = Swal.mixin({
	 						 	toast: true,
	  							position: 'top-end',
	  							showConfirmButton: false,
	  							timer: 1000
								})
								Toast.fire({
	  							type: 'success',
	  							title: 'Post has been updated'
								}).then(function() {
	   				 				//window.location = 'home.php';
								})
								</script>";
								$update = "UPDATE users SET posts='yes' WHERE user_id='$user_id'";
								$run_update = mysqli_query($con, $update);
							}
						}
					}
				}
			}
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

}



function get_posts()

{
	global $con;
	$per_page = 10;
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;
	}
	$start_from = ($page-1)*$per_page;
	$get_posts = "SELECT * FROM `posts` ORDER by `post_date` DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con, $get_posts);
	while($row_posts = mysqli_fetch_array($run_posts))
	{

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,140);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];
		$location = $row_posts['location'];
		$user = "SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		$get_com = "SELECT  post_id, COUNT(*)  FROM `comments` WHERE post_id='$post_id'";

		$run_com = mysqli_query($con,$get_com);
		while($row=mysqli_fetch_array($run_com)){
			$count = $row["COUNT(*)"];
	}

		//now displaying posts from database
		if($content=="No" && strlen($upload_image) >= 1 && strlen($location) >= 1){
			echo"
			<div class='row'>

				<div id='posts' class='col-md-12'>

					<div class='row'>

						<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

						</div>

						<div class='col'>

							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>

							<h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
							<h6><small style='color:#9e9e9e;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>

						</div>

					</div>

					<div class='row'>

						<div class='col-sm-12'>

							<center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

						</div>

					</div><br>

					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>

				</div>

				<div class='col-sm-3'>

				</div>

			</div><br><br>

			";

		}

		else if($content=="No" && strlen($upload_image) >= 1 && strlen($location) == 0){
			echo"
			<div class='row'>

				<div id='posts' class='col-md-12'>

					<div class='row'>

						<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

						</div>

						<div class='col'>

							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>

							<h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>

						</div>

					</div>

					<div class='row'>

						<div class='col-sm-12'>

							<center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

						</div>

					</div><br>

					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>

				</div>

				<div class='col-sm-3'>

				</div>

			</div><br><br>

			";

		}



		else if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($location) >= 1)
		{

			echo"

			<div class='row'>

				<div id='posts' class='col-md-12'>

					<div class='row'>

						<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

						</div>

						<div class='col'>

							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
							<h6><small style='color:#9e9e9e;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>


						</div>

					</div>

					<div class='row'>

						<div class='col-sm-12'>

							<h3 style='color:black;'>$content</h3><br>

							<center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

						</div>

					</div><br>

					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>

				</div>

				<div class='col-sm-3'>

				</div>

			</div><br><br>

			";

		}


		//content only 
		else if(strlen($content) >= 1)
		{
			if(strlen($location) >= 1)
			{
				echo"
				<div class='row'>
					<div id='posts' class='col-md-12'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
							</div>
							<div class='col'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
								<h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
								<h6><small style='color:#9e9e9e;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h3 style='color:black;'>$content</h3>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}
			else if(strlen($location) == 0)
			{
				echo"
				<div class='row'>
					<div id='posts' class='col-md-12'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
							</div>
							<div class='col'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
								<h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h3 style='color:black;'>$content</h3>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}
		}
		else if(strlen($content) == 0 && strlen($upload_image) == 0 && strlen($location) >= 1)
		{
			echo"
				<div class='row'>
					<div id='posts' class='col-md-12'>
						<div class='row'>
							<div class='col-sm-2'>
							<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
							</div>
							<div class='col'>
								<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
								<h5><small style='color:black;'>Updated a check-in on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
								<h5><small style='color:#9e9e9e;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h5>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h3 style='color:black;'></h3>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>$count Comment</button></a><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
		}
	}

	include("pagination.php");

}

function search_user(){



	global $con;



	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['search_user_btn'])) 

	{

		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

	    $recaptcha_secret = '6LfHs8IUAAAAABPW8ePUcmohMuvxRAd8BkjE9MfT';

	    $recaptcha_response = $_POST['recaptcha_response'];



	    // Make and decode POST request:

	    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

	    $recaptcha = json_decode($recaptcha);



	    if ($recaptcha->score >= 0.5)

	    {

		$search_query = htmlentities($_GET['search_user']);

		$get_user = "SELECT * FROM `users` WHERE f_name LIKE '%$search_query%' OR l_name LIKE '%$search_query%' OR user_name LIKE '%$search_query%' ORDER by `f_name` ASC";

		}else

		{

			echo "<script>

			Swal.fire({

  			text: 'You are robot!',

  			type: 'error',

  			confirmButtonText: 'OK'

			})</script>";

		}

	}



	else

	{

	$get_user = "SELECT * FROM `users` ORDER by `f_name` ASC";

	}



	$run_user = mysqli_query($con,$get_user);



	while($row_user=mysqli_fetch_array($run_user)){



		$user_id = $row_user['user_id'];

		$f_name = $row_user['f_name'];

		$l_name = $row_user['l_name'];

		$username = $row_user['user_name'];

		$user_image = $row_user['user_image'];



		//now displaying all at once



		echo "

		<br><br>

		<div id='posts' class='row'>

			<div class='col-sm-3'>

			</div>

			<div class='col-sm-6'>

			<div class='row' id='find_people'>

			<div class='col-sm-4'>

			<a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>

			<img class='rounded-circle' src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; margin:1px;'/>

			</a>

			</div><br><br>

			<div class='col-sm-6'>

			<a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>

			<strong><h4>$f_name $l_name</h4></strong>

			</a>

			</div>

			<div class='col-sm-3'>

			</div>



			</div>



			</div>

			<div class='col-sm-4'>

			</div>

		</div><br>

		";



	}



	}



function single_post(){

	if(isset($_GET['post_id'])){



	global $con;



	$get_id = $_GET['post_id'];



	$get_posts = "SELECT * FROM `posts` WHERE post_id='$get_id'";



	$run_posts = mysqli_query($con,$get_posts);



	$row_posts=mysqli_fetch_array($run_posts);



		$post_id = $row_posts['post_id'];

		$user_id = $row_posts['user_id'];

		$content = $row_posts['post_content'];

		$upload_image = $row_posts['upload_image'];

		$post_date = $row_posts['post_date'];



		//getting the user who has posted the thread

		$user = "SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes'";



		$run_user = mysqli_query($con,$user);

		$row_user=mysqli_fetch_array($run_user);



		$user_name = $row_user['user_name'];

		$user_image = $row_user['user_image'];



		// getting the user session

		$user_com = $_SESSION['user_email'];



		$get_com = "SELECT * FROM `users` WHERE user_email='$user_com'";

		$run_com = mysqli_query($con,$get_com);

		$row_com=mysqli_fetch_array($run_com);



		$user_com_id = $row_com['user_id'];

		$user_com_name = $row_com['user_name'];





		//now displaying all at once







		if(isset($_GET['post_id'])){

			$post_id = $_GET['post_id'];

			}

			$get_posts = "SELECT `post_id` FROM `users` WHERE post_id='$post_id'";

			$run_user = mysqli_query($con,$get_posts);



			$post_id = $_GET['post_id'];



			$post = $_GET['post_id'];

			$get_user = "SELECT * FROM `posts` WHERE post_id='$post'";

			$run_user = mysqli_query($con,$get_user);

			$row=mysqli_fetch_array($run_user);



			$p_id = $row['post_id'];



			if($p_id != $post_id){

				echo "<script>alert('ERROR')</script>";

				echo "<script>window.open('home.php','_self')</script>";

			}else{





		if($content=="No" && strlen($upload_image) >= 1){



			echo "

			<div class='row'>

				<div class='col-sm-3'>

				</div>

				<div id='posts' class='col-sm-6'>

				<div class='row'>

					<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

					</div>

					<div class='col-md-auto'>

						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>

						<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>

					</div>

				</div>

				<div class='row'>

					<div class='col-sm-12'>

						<center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

					</div>

				</div>

				<form action='' method='post'>

  <div class='form-group'>

    <label for='exampleInputEmail1'>Email address</label>

    <input type='text' class='form-control' name='comment' placeholder='Write your comment'>

  </div>

  <button class='btn btn-primary' name='reply' style='float:right;'><i class='fas fa-reply'></i> Comment</button>

</form>

				<!--<a class='first' href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>-->

				</div>

				<div class='col-sm-3'>

				</div>

			</div><br><br>

			";



		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){



			echo "

			<div class='row'>

				<div class='col-sm-3'>

				</div>

				<div id='posts' class='col-sm-6'>

				<div class='row'>

					<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

					</div>

					<div class='col-md-auto'>

						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>

						<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>

					</div>

				</div>

				<div class='row'>

					<div class='col-sm-12'>

						<h3>$content</h3><br>

						<center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

					</div>

				</div>

<form action='' method='post'>

  <div class='form-group'>

    <label for='exampleInputEmail1'>Email address</label>

    <input type='text' class='form-control' name='comment' placeholder='Write your comment'>

  </div>

  <button class='btn btn-primary' name='reply' style='float:right;'><i class='fas fa-reply'></i> Comment</button>

</form>

				<!--<a class='first' href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>-->

				</div>

				<div class='col-sm-3'>

				</div>

			</div><br><br>

			";



		}

		else{



		echo "



		<div class='row'>

			<div class='col-sm-3'>

			</div>

			<div id='posts' class='col-sm-6'>

			<div class='row'>

					<div class='col-sm-2'>

						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

					</div>

					<div class='col-md-auto'>

						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>

						<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>

					</div>

				</div>

				<div class='row'>

					<div class='col-sm-2'>

					</div>

					<div class='col-sm-6'>

						<h3><p>$content</p></h3>

					</div>

					<div class='col-sm-4'>



					</div>

				</div>

				<form action='' method='post'>

  <div class='form-group'>

    <label for='exampleInputEmail1'>Email address</label>

    <input type='text' class='form-control' name='comment' placeholder='Write your comment'>

  </div>

  <button class='btn btn-primary' name='reply' style='float:right;'><i class='fas fa-reply'></i> Comment</button>

</form>



				<!--<a class='first' href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>-->

			</div>

			<div class='col-sm-3'>

			</div>

		</div><br><br>



		";

	}

		

		include("comments.php");



		if(isset($_POST['reply'])){



			$comment = htmlentities($_POST['comment']);



			if($comment == ""){

			echo"<script>alert('Enter your comment!')</script>";

			echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";

			}else{

			$insert = "INSERT INTO `comments` (post_id,user_id,comment,comment_author,date) VALUES ('$post_id','$user_id','$comment','$user_com_name',NOW())";



			$run = mysqli_query($con,$insert);



			echo "<script>

							const Toast = Swal.mixin({

 						 	toast: true,

  							position: 'top-end',

  							showConfirmButton: false,

  							timer: 1000

							})



							Toast.fire({

  							type: 'success',

  							title: 'Comment success'

							}).then(function() {

   				 				window.location = 'single.php?post_id=$post_id';

							})

							</script>";

			//echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";

		}



		}



	}

	}

}

?>
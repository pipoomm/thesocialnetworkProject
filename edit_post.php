<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
?>
<?php
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
else { ?>

<html>
<head>
	<title>Edit Post</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style.css">
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
<style>
body 
{
background: linear-gradient(to left, #606c88, #3f4c6b); 
}
</style>

<body>
	<?php
	if(isset($_GET['post_id'])){
		$get_id = $_GET['post_id'];
		$get_post = "SELECT * FROM `posts` WHERE post_id='$get_id'";
		$run_post = mysqli_query($con,$get_post);
		$row=mysqli_fetch_array($run_post);
		$post_con = $row['post_content'];
		$upload_image = $row['upload_image'];
	}

	?>

	<!--<form action="" method="post" id="f"><br>

		<center><h2>Edit Your Post</h2></center><br>

		<textarea class="form-control" cols="83" rows="4" name="content"><?php //echo $post_con;?></textarea><br>

		<input type="submit" style="float: right;" name="update" value="Update Post" class="btn btn-success"/>

	</form>-->

		<div class="row">

  <div class="col-sm-3"></div>

  <div class="col-sm-6" >

  	<br><h2 style="font-size: 3.5rem;font-weight: bolder; color: white;">Edit Post</h2>



  </div>

  <div class="col-sm-3"></div>

</div>
<div class="row">
  <div class="col-sm-3"></div>
  <div id="posts_edit" class="col-sm-6" >
  <center>
		<form action="" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_con;?></textarea><br>
		<?php if(strlen($upload_image) >= 1)
  			{
  				echo "<img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:200px;'><br><br> ";
  			}
  		?>
		<label class="btn btn-outline-danger" style="float: left;"><i class="far fa-file-image"></i> Insert<input type="file" name="upload_image" size="30">
		</label>
		<!--<input type="submit" style="float: right;" name="update" value="Update Post" class="btn btn-success"/>-->
		<button type="submit" style="float: right;" name="update" class="btn btn-success"/><i class="far fa-edit"></i> Update Post</button> 
		<button type="submit" style="float: left;" name="update_rm" class="btn btn-outline-danger"/><i class="far fa-file-image"></i> Remove</button> 
		<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
		</form>
		</center>
  </div>
  <div class="col-sm-3"></div>
</div>
	<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response']) && isset($_POST['update'])) 
		{
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		    $recaptcha_secret = '6LfHs8IUAAAAABPW8ePUcmohMuvxRAd8BkjE9MfT';
		    $recaptcha_response = $_POST['recaptcha_response'];
		    // Make and decode POST request:

		    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

		    $recaptcha = json_decode($recaptcha);

	

	if ($recaptcha->score >= 0.5) {



		$content_bf = $content;

		$content = $_POST['content'];

		$upload_image = $_FILES['upload_image']['name'];

		$image_tmp = $_FILES['upload_image']['tmp_name'];

		$random_number = rand(1, 100);

		if(strlen($upload_image) >= 1 && strlen($content) >= 1)

			{

				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");



				$update_post = "UPDATE `posts` SET post_content='$content', post_date=CURRENT_TIMESTAMP, upload_image='$upload_image.$random_number' WHERE post_id='$get_id'";

				$run_update = mysqli_query($con,$update_post);



				if($run_update)

				{

					echo "<script>

							Swal.fire({

   				 			text: 'Post has been updated',

    						type: 'success'

							}).then(function() {

   				 			window.location = 'profile.php';

							});

							</script>";

				}

			}

		else

			{

				if($upload_image=='' && $content == '')

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

					if($content==$content_bf && strlen($upload_image) >= 1)

					{

						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

						$update_post = "UPDATE `posts` SET post_date=CURRENT_TIMESTAMP, upload_image='$upload_image.$random_number' WHERE post_id='$get_id'";

						$run_update = mysqli_query($con,$update_post);



						if($run_update)

						{

							echo "<script>

							Swal.fire({

   				 			text: 'Post has been updated',

    						type: 'success'

							}).then(function() {

   				 			window.location = 'profile.php';

							});

							</script>";

						}



					}

					else

					{

						$update_post = "UPDATE `posts` SET post_content='$content', post_date=CURRENT_TIMESTAMP WHERE post_id='$get_id'";

						$run_update = mysqli_query($con,$update_post);



						if($run_update)

						{



							echo "<script>

								Swal.fire({

   								text: 'Post is updated',

    			 				type: 'success'

								}).then(function() {

   				 				window.location = 'profile.php';

								});

								</script>";



						}

					}

				}

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





if(isset($_POST['update_rm']))

{

	if(strlen($upload_image) < 1)

	{

		echo "<script>

				Swal.fire({

   				text: 'Image not found on database',

    			type: 'warning'

				});

				</script>";

	}

	else

	{

		$update_post = "UPDATE `posts` SET post_content='$post_con', post_date=CURRENT_TIMESTAMP,upload_image='' WHERE post_id='$get_id'";

		$run_update = mysqli_query($con,$update_post);



		if($run_update)

			{



			echo "<script>

				Swal.fire({

   				text: 'Image is removed',

    			type: 'success'

				}).then(function() {

   				 window.location = 'edit_post.php?post_id=$get_id';

					});

				</script>";



			}

	}

}


	?>

</body>

</html>

<?php } ?>


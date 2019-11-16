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
			$user_image = $row['user_image'];
		?>
	<title><?php echo $user_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="style/home_style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfHs8IUAAAAAN7L_O2Cu7vvqsSHmajCJcJEJ5OK"></script>

    <script src="dist/PlacePicker.js"></script>
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
html 
{
  scroll-behavior: smooth;
}
</style>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col"></div>
	<div id="insert_post" class="col-6"><br>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
			  <div class="form-group">
			  	
			    <label style="color: #263238;"><img src='users/<?php echo $user_image; ?>' class='rounded-circle' width='35px' height='35px'><b> Create post</b></label><hr>
			    <textarea class="form-control" id="content" name="content" rows="4" placeholder="What's on your mind, <?php echo $f_name; ?>?"></textarea>
			  </div>

			  <div class="input-group mb-3">
			  	<label class="btn btn-secondary btn-sm" style="float: left; border-radius: 1.5rem;"><i class="far fa-file-image"></i> Photo<input type="file" name="upload_image" size="30">
				</label>
				<div style="width: 5%;"></div>
				  <input type="text" id="pickup_country" name="location" class="form-control" placeholder="Check-in" aria-describedby="button-addon2">
				  <div class="input-group-append">
				    <button class="btn btn-outline-success" type="button" id="button-addon2"><i class="fas fa-location-arrow"></i></button>
				  </div>
				</div>
			  
			  <button id="btn-post" name="sub" class="btn btn-primary btn-block">Post</button>
			  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
		</form>
		<script type="text/javascript">
    $(document).ready(function(){
    	$("#pickup_country").PlacePicker({
    		btnClass:"btn btn-xs btn-default",
    		key:"AIzaSyBwxehkkQo7sgKBADQzjTc8AxwgABFrPqk",
    		center: {lat: 18.7951229, lng: 98.951954},
    		success:function(data,address){
    			$("#pickup_country").val(data.formatted_address);
    		}
    	});
    });
</script>
		<?php insertPost(); ?>
		</div>
	<div class="col"></div>
	</div>
	<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6" id="newsfeed">
  	<h1 style="font-size: 3.5rem;"><strong>Feed</strong></h1>
<?php echo get_posts(); ?>
	</div>
  			<div class="col-sm-3"></div>
		</div>
	</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'Poom Somwong']);
  _gaq.push(['_setDomainName', 'localhost']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
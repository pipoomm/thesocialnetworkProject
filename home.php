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
    <link rel="stylesheet" type="text/css" href="style/home_style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
    <!-- Colorpicker Jquery -->
    <script src="dist/jquery.simplecolorpicker.js"></script>
    <link rel="stylesheet" href="dist/jquery.simplecolorpicker.css">
  	<link rel="stylesheet" href="dist/jquery.simplecolorpicker-fontawesome.css">
  	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">
	<script>
		$(document).ready(function() {

		  $('select[name="colorpicker-fontawesome"]').simplecolorpicker({theme: 'fontawesome'});
		  $('select[name="colorpicker-fontawesome"]').on('change', function() {
		  	var select_color =  $('select[name="colorpicker-fontawesome"]').val();
			var gradient = "linear-gradient(to top, "+select_color+", #ffffff)";
			console.log(gradient);
		    $(document.getElementById('insert_post')).css('background', gradient);
		    var col = $('select[name="colorpicker-fontawesome"]').val();
		    $("#colorColor").val(col);
		  });
		});
	</script>
  	<!-- Google map api -->
    <script src="dist/PlacePicker.js"></script>
    <!-- Google reCAPTCHA -->
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
html 
{
  scroll-behavior: smooth;
}
.row
{
	margin-left: 0px;
	margin-right: 0px;
}
#content,#pickup_country
{
  background-color: #F5F5F5;
}
</style>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col"></div>
	<div id="insert_post" class="col-sm-6"><br>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
			  <div class="form-group">
			  	
			    <label style="color: #263238;"><img src='users/<?php echo $user_image; ?>' class='rounded-circle' width='35px' height='35px'><b> Create post</b></label><hr>
			    <textarea class="form-control" id="content" name="content" rows="4" placeholder="What's on your mind, <?php echo $f_name; ?>?"></textarea>
			  </div>
			  <select name="colorpicker-fontawesome">
				  <option value="#f5f5f5">Default</option>
				  <option value="#FFCDD2">FFCDD2</option>
				  <option value="#F8BBD0">F8BBD0</option>
				  <option value="#E1BEE7">E1BEE7</option>
				  <option value="#D1C4E9">D1C4E9</option>
				  <option value="#C5CAE9">C5CAE9</option>
				  <option value="#BBDEFB">BBDEFB</option>
				  <option value="#B3E5FC">B3E5FC</option>
				  <option value="#B2EBF2">B2EBF2</option>
				  <option value="#B2DFDB">B2DFDB</option>
				  <option value="#C8E6C9">C8E6C9</option>
				  <option value="#DCEDC8">DCEDC8</option>
				  <option value="#F0F4C3">F0F4C3</option>
				  <option value="#FFF9C4">FFF9C4</option>
				  <option value="#FFECB3">FFECB3</option>
				  <option value="#FFE0B2">FFE0B2</option>
				  <option value="#FFCCBC">FFCCBC</option>
				  <option value="#D7CCC8">D7CCC8</option>
				  <option value="#ECEFF1">ECEFF1</option>
				  <option value="#CFD8DC">CFD8DC</option>
			</select>
			<input type="hidden" name="colorColor" id="colorColor">
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
</body>
</html>
<?php
session_start();
include("includes/header.php");

 if(!isset($_SESSION['user_email'])){
 	header("location: index.php");
 }
?>
<html>
<head>
	<?php $post_id = $_GET['post_id']; ?>
	<title>Post at <?php echo $post_id; ?></title>
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
</head>
<style>
body {
	 background: -webkit-linear-gradient(top, #005aa7, #fffde4);
}
</style>
<body>
	

	<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6" >
  	<br><h2 style="font-size: 3.5rem; font-weight: bolder; color: white;">Post</h2>
			
  </div>
  <div class="col-sm-3"></div>
</div>

<div class="row">
		<div class="col-md-12">
			<div class='col-sm-3'>
    		</div>
    		<?php single_post(); ?>
		</div>
	</div>

</body>
</html>
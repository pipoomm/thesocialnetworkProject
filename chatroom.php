<?php

session_start();

include("includes/header.php");

 if(!isset($_SESSION['user_email'])){

 	header("location: index.php");

 }

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }

?>
<?php 
if($ip_address == '::1') 
{ 
	$ip_address = 'localhost';
} 
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TalkTalk</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<!-- jQuery library -->

	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style>
body{
		padding-top: 2%;
		background: url(images/2.jpg);
}

#chatBox{
	background: url(images/2.jpg);
	display: block;
	padding: 2%;
	height: 400px;
	overflow: auto;
	margin: 0 auto;
}
.myChatForm{
	text-align: center;
}
.msgdisplay{
	border: 2px solid #56BE6F;
	border-radius: 10px 10px 10px 0px;
	margin: 5px;
	width: 100%;
	padding: 0px 10px;
	display:inline-block;
	float:left;
	clear:both;
	background-color:#DAFFE3;
}

</style>

<body>

	<?php

	if (isset($_GET['u_id'])) {

        $con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");

        

        $get_id = $_GET['u_id'];

        $get_user = "SELECT * FROM `users` WHERE user_id='$get_id'"; 

		$run_user = mysqli_query($con,$get_user);

		$row=mysqli_fetch_array($run_user);

		

		$user_id = $row['user_id']; 

		$user_name = $row['user_name'];

		$f_name = $row['f_name'];



		$user = $_SESSION['user_email'];

   		$get_user = "SELECT * FROM `users` WHERE user_email='$user'";

    	$run_user = mysqli_query($con,$get_user);

    	$row = mysqli_fetch_array($run_user);



    	$user_from_msg = $row['user_id'];

    	$user_from_name = $row['user_name'];

    }

   

    ?>

<div class="container">

  <div class="row">

    <div class="col">

      

    </div>

    <div class="col-6">

    	<h3 style="color: #50312A;font-family: Ubuntu, sans-serif;"><strong>TalkTalk</strong></h3>
    	<h6>IP: <?php echo $ip_address; ?></h6>

		<div class="well" id = "chatBox">

	<div id = "chatdisplay"></div>

	</div>



      <br>
      <form class="myChatForm">

  <div class="form-group row">

    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>

    <div class="col-sm-10">

      <input type="email" class="form-control" id="user_name" value="<?php echo"$user_name";?>" placeholder="Username">
      <input type="hidden" class="form-control" id="ip_addr" value="<?php echo"$ip_address";?>">

    </div>

  </div>

  <div class="form-group row">

    <label for="inputPassword3" class="col-sm-2 col-form-label">Message</label>

    <div class="col-sm-10">

      <input type="text" name="message" id="message" class="form-control" placeholder="Enter your message here..">

    </div>

  </div>

</form>

    </div>

    <div class="col">

      

    </div>

  </div>

</div>

<script>
	$(document).ready(function(e){
function display() {
$.ajax({
	url:'display.php',
	type:'POST',
	success: function(data){
		$("#chatdisplay").html(data);
	}
});
}
setInterval (function(){display();} ,3000);

		$("#message").keypress(function (e) {
		if (e.keyCode == 13) {
		var name = $("#user_name").val();
		var message = $("#message").val();
		var ip = $("#ip_addr").val();
		document.getElementById('message').value = '';
		$.ajax({
			url: 'php.php',
			type: 'POST',
			data:{
				uname:name,
				umessage:message,
				ip:ip,
			},
			success: function(data){
				$('#chatBox').stop().animate({
				  scrollTop: $('#chatBox')[0].scrollHeight
				}, 800);
			}
		});
		}
		});
	});
</script>

</body>

</html>
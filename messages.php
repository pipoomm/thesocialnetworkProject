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
	<title>Messenger</title>
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
body{
        background: url(images/2.jpg);
        overflow-y: hidden;
        overflow-y: hidden;
}
#select_user{
    overflow-x: hidden;
    overflow-y: scroll;
    padding-top: 2%;
    padding-bottom: 2%;
    background: #fff;
    max-height: 700px;
}
#posts{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    background: #fff;
    -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -moz-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -ms-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -o-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
</style>
<body>
<!--<div><br>
	<center><h2 style="color: #fff;">Messages function not available right now. </h2>
    <img src="images/kitty.png" alt="Smiley face" width="200"></center>

</div>-->


<!--<div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>

                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="text" placeholder="Search keywords" name="search_user">
                                    </div>

                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" name="search_user_btn" type="submit">Search</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <?php //search_user();?>
</div>-->
<div id="output"></div>
<div class="row align-items-center justify-content-center">
    <?php
    if (isset($_GET['u_id'])) {
        global $con;
        $get_id = $_GET['u_id'];
        $get_user = "SELECT * FROM `users` WHERE user_id='$get_id'";
        $run_user = mysqli_query($con,$get_user);
        $row_user = mysqli_fetch_array($run_user);

        $user_to_msg = $row_user['user_id'];
        $user_to_name = $row_user['user_name'];
    }
    $user = $_SESSION['user_email'];
    $get_user = "SELECT * FROM `users` WHERE user_email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);

    $user_from_msg = $row['user_id'];
    $user_from_name = $row['user_name'];
    ?>

    <div class="col" id="select_user">
    <?php
        $user = "SELECT * FROM `users`";
        $run_user = mysqli_query($con,$user);
        while ($row_user = mysqli_fetch_array($run_user)) {
            $user_id = $row_user['user_id'];
            $user_name = $row_user['user_name'];
            $first_name = $row_user['f_name'];
            $last_name = $row_user['l_name'];
            $user_image = $row_user['user_image'];

            echo "<div class='container-fluid'>
                    <a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='chat_box_apply.php?u_id=$user_id'>
                    <img class='rounded-circle' src='users/$user_image' width='90px' height='80px' title='$user_name' /> <strong> $first_name $last_name</strong><br><br>
                </a>
            </div>";

        }
    ?>
    </div>
    <div class="col-6">
        <?php
            if(isset($_GET['u_id'])){
                $u_id = $_GET['u_id'];
                $get_user = "SELECT * FROM `users` WHERE user_id='$u_id'";
                $run_user = mysqli_query($con,$get_user);
                $row_user = mysqli_fetch_array($run_user);

                $username = $row_user['user_name'];
                if($u_id == "new"){
                echo '<center><img src="images/kitty.png" width="200">
                <h2 style="color: #50312A;font-family: Ubuntu, sans-serif;"><strong>Pick someone to start conversation</strong></h2>
                </center>';
                }
                else{
                echo "
                <form action='' name='frmMain' id='frmMain' method='POST'>
                <p style='color: #fff;font-family: Ubuntu, sans-serif;''>Message to: $username</p>
                </center>
                    <textarea class='form-control' placeholder='Enter Your Message' name='msg_box' id='message_textarea'></textarea><br>
                    <input class='btn btn-primary' type='submit' name='send_msg' id='send_msg' style='visibility: hidden;' value='Send'>
                    <!--<button class='btn btn-primary btn-lg' name='send_msg' id='send_msg' style='float:right;'><i class='far fa-paper-plane'></i></button>-->
                </form><br><br>";
                echo "<script>
                $(document).ready(function() {

  $('.form-control').keydown(function(event) {
    if (event.keyCode == 13) {
      document.getElementById('send_msg').click();
      return false;
    }
  });

});
                </script>
                ";
                }
            }
        ?>

        <?php
            if(isset($_POST['send_msg'])){
                $msg = htmlentities($_POST['msg_box']);

                if($msg == ""){
                    echo"<h4 style='color:red;text-align:center;'>Message was unable to send!</h4>";
                }else if(strlen($msg) > 37){
                    echo"<h4 style='color:red;text-align:center;'>Message is Too long! Use only 37 characters</h4>";
                }
                else{
                $insert = "INSERT INTO `user_messages` (`user_to`,`user_from`,`msg_body`,`date`,`msg_seen`) VALUES ('$user_to_msg','$user_from_msg','$msg',CURRENT_TIMESTAMP,'no')";

                $run_insert = mysqli_query($con,$insert);
                echo "<script>  
                        window.location = 'messages.php?u_id=$u_id';
                </script>
                ";
                }
            }
        ?>
    </div>
    <div class="col">
        <?php
            if(isset($_GET['u_id'])){

            global $con;

            $get_id = $_GET['u_id'];

            $get_user = "SELECT * FROM `users` WHERE user_id='$get_id'";
            $run_user = mysqli_query($con,$get_user);
            $row=mysqli_fetch_array($run_user);

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $f_name = $row['f_name'];
            $l_name = $row['l_name'];
            $describe_user = $row['describe_user'];
            $user_country = $row['user_country'];
            $user_image = $row['user_image'];
            $register_date = $row['user_reg_date'];
            $gender = $row['user_gender'];
            }

            if($get_id == "new"){

            }else{

            echo "
                
                    
                   
                    <div class='col-md-auto' id='posts'>
                    <h2>Information about</h2>
                    <img class='rounded-circle' src='users/$user_image' width='150' height='150' />
                    <br><br>
                    <ul class='list-group'>
                      <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                      <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
                      <li class='list-group-item' title='Gender'>$gender</li>
                      <li class='list-group-item' title='Country'>$user_country</li>
                      <li class='list-group-item' title='User Registration Date'>$register_date</li>
                    </ul>
                    </div>
                
                ";
            }
        ?>
        
    </div>
</div>
</body>
</html>
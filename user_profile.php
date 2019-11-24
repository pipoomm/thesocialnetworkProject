<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
?>
<?php

if(!isset($_SESSION['user_email'])){

	header("location: index.php");

}
else{ ?>
<html>
<head>
	<title>Friend</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style>
body {
	background: linear-gradient(to left, #2980b9, #2c3e50);
}
#own_posts{
    border-radius: 0.5rem;
    padding: 30px 40px;
  -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -moz-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -ms-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -o-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
#posts_img {
    height:300px;
   	width:100%;
}
	
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
    -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -moz-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -ms-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  -o-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
.profile-img{
    text-align: center;
}
.profile-img img{
     width: 160px;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.btn.btn-light{
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
}
.btn.btn-primary
{
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
#button_profile{
	position: absolute;
	top: 21px;
	right: 20px;
	cursor: pointer;
	transform: translate(-50%, -50%);
}
</style>
</style>
<body>

	<?php
	global $con;

			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			if($u_id < 0 OR $u_id == ""){
				echo"<script>window.open('home.php','_self')</script>";
			}else{ //else hehe start

	?>

		<?php
			if(isset($_GET['u_id'])){

			global $con;

			$user_id = $_GET['u_id'];

			$select = "SELECT * FROM `users` WHERE user_id='$user_id'";
			$run = mysqli_query($con,$select);
			$row=mysqli_fetch_array($run);

			$name = $row['user_name'];
			}

		?>
			<?php
				global $con;

				if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
				}
				$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

				$run_posts = mysqli_query($con,$get_posts);

				while($row_posts=mysqli_fetch_array($run_posts)){

				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				//getting the user who has posted the thread

				$user = "select * from users where user_id='$user_id' AND posts='yes'";

				$run_user = mysqli_query($con,$user);
				$row_user=mysqli_fetch_array($run_user);

				$user_name = $row_user['user_name'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$user_image = $row_user['user_image'];

		}
		?>
<?php } //else hehe ends ?>
<?php

		if(isset($_GET['u_id'])){

				global $con;

				$user_id = $_GET['u_id'];

				$select = "SELECT * FROM `users` WHERE user_id='$user_id'";
				$run = mysqli_query($con,$select);
				$row=mysqli_fetch_array($run);

				$id = $row['user_id'];
				$image = $row['user_image'];
				$name = $row['user_name'];
				$email= $row['user_email'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				$country = $row['user_country'];
				$gender = $row['user_gender'];
				$birthdays = $row['user_birthday'];
				$register_date = $row['user_reg_date'];
				$relationship = $row['Relationship'];

			
					$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);

					$userown_id = $row['user_id'];
					$user_name = $row['user_name'];
					$user_image = $row['user_image'];

					if($user_id == $userown_id){
						
					}

				}
			?>
<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src='users/<?php echo $image; ?>' alt='Profile'>
                     </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $f_name," ";echo $l_name; ?>
                                    </h5>
                                    <h6><i class="fas fa-map-marker-alt"></i>
                                        <?php echo $country; ?>
                                    </h6>
                                    <p class="proile-rating">Join : <span><?php echo $register_date; ?></span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Posts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                    	<?php 
                        if($user_id == $userown_id)
                    	{
                    		echo "<button type='submit' class='btn btn-light' name='btnAddMore'>Edit Account</button> 
                        <script>
                            $('.btn.btn-light').on('click',function(e){
                             e.preventDefault();
                            window.location = 'edit_profile.php?u_id=$user_id';
                        }
                          )
                        </script>"  ;
						
						}
                        if($user_id != $userown_id) 
                        {
                            echo "<button type='submit' class='btn btn-primary' name='btnAddMore'>Send text</button> 
                        <script>
                            $('.btn.btn-primary').on('click',function(e){
                             e.preventDefault();
                            window.location = 'chat_box_apply.php?u_id=$user_id';
                        }
                          )
                        </script>"  ; 
                        }
                        
						?>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $name;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $f_name," ";echo $l_name; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Info</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $describe_user; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Relationship Status</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $relationship ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $gender; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $birthdays; ?></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                 <?php
				global $con;

				if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
				}
				$get_posts = "SELECT * FROM `posts` WHERE user_id='$u_id' ORDER by `post_date` DESC LIMIT 20";

				$run_posts = mysqli_query($con,$get_posts);

				while($row_posts=mysqli_fetch_array($run_posts)){

				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
                $location = $row_posts['location'];
                $bg = $row_posts['color'];
                $color = "linear-gradient(to top, $bg, #ffffff)";
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];
                $get_com = "SELECT  post_id, COUNT(*)  FROM `comments` WHERE post_id='$post_id'";

                    $run_com = mysqli_query($con,$get_com);
                    while($row=mysqli_fetch_array($run_com)){
                        $count = $row["COUNT(*)"];
                }

				//getting the user who has posted the thread

				$user = "SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes'";

				$run_user = mysqli_query($con,$user);
				$row_user=mysqli_fetch_array($run_user);

				
				$f_name = $row_user['f_name'];
				$l_name = $row_user['l_name'];
                $user_name = $f_name. ' ' .$l_name;
				$user_image = $row_user['user_image'];
               


				//now displaying all at once
                if($content=='' && strlen($upload_image) >= 1 && strlen($location) >= 1){
            echo"
            <div class='row'>

                <div id='own_posts' class='col-md-12' style='background:$color;'>

                    <div class='row'>

                        <div class='col-sm-2'>

                        <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

                        </div>

                        <div class='col'>

                            <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>

                            <h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
                            <h6><small style='color:#263238;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>

                        </div>

                    </div>

                    <div class='row'>

                        <div class='col-sm-12'>

                            <center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

                        </div>

                    </div><br>

                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>

                </div>

                <div class='col-sm-3'>

                </div>

            </div><br>

            ";

        }

        else if($content=='' && strlen($upload_image) >= 1 && strlen($location) == 0){
            echo"
            <div class='row'>

                <div id='own_posts' class='col-md-12' style='background:$color;'>

                    <div class='row'>

                        <div class='col-sm-2'>

                        <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

                        </div>

                        <div class='col'>

                            <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>

                            <h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>

                        </div>

                    </div>

                    <div class='row'>

                        <div class='col-sm-12'>

                            <center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

                        </div>

                    </div><br>

                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>

                </div>

                <div class='col-sm-3'>

                </div>

            </div><br>

            ";

        }



        else if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($location) >= 1)
        {

            echo"

            <div class='row'>

                <div id='own_posts' class='col-md-12' style='background:$color;'>

                    <div class='row'>

                        <div class='col-sm-2'>

                        <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>

                        </div>

                        <div class='col'>

                            <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
                            <h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
                            <h6><small style='color:#263238;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>


                        </div>

                    </div>

                    <div class='row'>

                        <div class='col-sm-12'>

                            <h3 style='color:black;'>$content</h3><br>

                            <center><img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:350px;'></center>

                        </div>

                    </div><br>

                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>

                </div>

                <div class='col-sm-3'>

                </div>

            </div><br>

            ";

        }


        //content only 
        else if(strlen($content) >= 1)
        {
            if(strlen($location) >= 1)
            {
                echo"
                <div class='row'>
                    <div id='own_posts' class='col-md-12' style='background:$color;'>
                        <div class='row'>
                            <div class='col-sm-2'>
                            <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col'>
                                <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
                                <h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
                                <h6><small style='color:#263238;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h6>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <h3 style='color:black;'>$content</h3>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br>
                ";
            }
            else if(strlen($location) == 0)
            {
                echo"
                <div class='row'>
                    <div id='own_posts' class='col-md-12' style='background:$color;'>
                        <div class='row'>
                            <div class='col-sm-2'>
                            <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col'>
                                <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
                                <h5><small style='color:black;'>Updated a post on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <h3 style='color:black;'>$content</h3>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br>
                ";
            }
        }
        else if(strlen($content) == 0 && strlen($upload_image) == 0 && strlen($location) >= 1)
        {
            echo"
                <div class='row'>
                    <div id='own_posts' class='col-md-12' style='background:$color;'>
                        <div class='row'>
                            <div class='col-sm-2'>
                            <p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col'>
                                <h5><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
                                <h5><small style='color:black;'>Updated a check-in on <strong>$post_date </strong><i class='fas fa-globe-asia'></i></small></h5>
                                <h5><small style='color:#263238;font-size: 69%;'><strong><i class='fas fa-location-arrow'></i> $location </strong></small></h5>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <h3 style='color:black;'></h3>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-sm btn-info'>$count Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br>
                ";
        }
    
    

				
		}
		?>
                            </div>
                        </div>
                    </div>
                </div>       
        </div>
</body>
</html>
<?php } ?>

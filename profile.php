<?php
 session_start();
  if(!isset($_SESSION['user_email'])){
    header("location: index.php");
 }
include("includes/header.php");
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
</head>
<style type="text/css">
body {
	 background-image: radial-gradient( circle farthest-corner at 0.2% 0.3%,  rgba(3,144,232,1) 0%, rgba(2,97,156,1) 89.9% );
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
    width: 70%;
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
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
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
#own_posts{
    border: 3px solid #e6e6e6;
    border-radius: 0.5rem;
    padding: 30px 40px;
}
</style>
<body>
	<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src='users/<?php echo $user_image; ?>' alt='Profile'>
                <form action='profile.php?u_id=<?php echo $user_id;?>' method='post' enctype='multipart/form-data'>
				<div class="file btn btn-lg btn-primary">Change Photo
                    <input type='file' name='u_image'/>
                </div>
                  <button id='button_profile' name='update' class='btn btn-outline-light btn-sm'>Update Profile</button>
				</form>
                 </div>
                    </div>
				<?php
		if(isset($_POST['update'])){

				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				$random_number = rand(1,100);

				if($u_image=='')
				{
					echo "<script>
						Swal.fire({
  						text: 'Please select image',
  						type: 'warning',
  						confirmButtonText: 'OK'
						})</script>";
					//exit();
				}else
				{
					move_uploaded_file($image_tmp, "users/$u_image.$random_number");
					$update = "UPDATE `users` SET user_image='$u_image.$random_number' WHERE user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run)
					{
					echo "<script>
							const Toast = Swal.mixin({
 						 	toast: true,
  							position: 'top-end',
  							showConfirmButton: false,
  							timer: 5000
							})

							Toast.fire({
  							type: 'success',
  							title: 'Your profile has been updated'
							})
							</script>";
					}
				}
			}
	?>
                    
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $first_name," ";echo $last_name; ?>
                                    </h5>
                                    <h6><i class="fas fa-map-marker-alt"></i>
                                        <?php echo $user_country; ?>
                                    </h6>
                                    <p class="proile-rating">Joined : <span><?php echo $register_date; ?></span></p>
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
                        <button type="submit" class="profile-edit-btn" name="btnAddMore">Edit Account</button> 
                        <script>
            $('.profile-edit-btn').on('click',function(e){
                e.preventDefault();
                         window.location = 'edit_profile.php?<?php echo "u_id=$user_id" ?>';
                    }
                )
                        </script>
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
                                                <p><?php echo $user_name;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $first_name," ";echo $last_name; ?></p>
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
                                                <p><?php echo $Relationship_status ?></p>
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
                                                <p><?php echo $user_gender; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user_birthday; ?></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <?php
		global $con;

		if(isset($_GET['user_id']))
		{
			$user_id = $_GET['user_id'];
		}

		$get_posts = "SELECT * FROM `posts` WHERE user_id='$user_id' ORDER by `post_date` DESC LIMIT 30";
		$run_posts = mysqli_query($con, $get_posts);

		while ($row_posts = mysqli_fetch_array($run_posts)) 
		{
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date'];

			$user = "SELECT * FROM `users` WHERE user_id='$user_id' AND posts='yes'";
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			//display post

			if($content == "No" && strlen($upload_image) >= 1)
			{
				echo "
				<div id='own_posts'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h5><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
						<p><small style='color:black;'>Updated a post on <strong>$post_date <i class='fas fa-globe-asia'></i></strong></small><p>
					</div>
					<div class='col-sm-4'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:200px;'>
					</div>
				</div><br>
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success btn-sm'>View</button></a>
                <a href='edit_post.php?post_id=$post_id' style='float:right;'><button  class='btn btn-info btn-sm'>Edit</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' class='btn btn-danger btn-sm' style='float:right;'>Delete Post</a><br>
			</div><br><br>
				";
			}
			else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo "
			<div id='own_posts'>
				<div class='row'>

				
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h5><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
						<p><small style='color:black;'>Updated a post on <strong>$post_date <i class='fas fa-globe-asia'></i></strong></small></p>
					</div>
					<div class='col-sm-4'>
						
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<label>$content</label><br>
						<img class='img-fluid' id='posts-img' src='imagepost/$upload_image' style='height:200px;'>
					</div>
				</div><br>
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success btn-sm'>View</button></a>
                <a href='edit_post.php?post_id=$post_id' style='float:right;'><button  class='btn btn-info btn-sm'>Edit</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' class='btn btn-danger btn-sm' style='float:right;'>Delete Post</a><br>
			</div><br><br>
			";
			}
			else
			{
			echo "
			<div id='own_posts'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='rounded-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h5><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h5>
						<p><small style='color:black;'>Updated a post on <strong>$post_date <i class='fas fa-globe-asia'></i></strong></small></p>
					</div>
					<div class='col-sm-4'>
						
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-6'>
						<label>$content</label>
					</div>
					<div class='col-sm-4'>
						
					</div>
				</div><br><br>
			";
			global $con;
	
			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			$get_posts = "SELECT `user_email` FROM `users` WHERE user_id='$u_id'";
			$run_user = mysqli_query($con,$get_posts);
			$row=mysqli_fetch_array($run_user);

			$user_email = $row['user_email'];

			$user = $_SESSION['user_email'];
			$get_user = "SELECT * FROM `users` WHERE user_email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['user_id'];
			$u_email = $row['user_email'];

			if($u_email != $user_email)
			{
				echo"<script>window.open('profile.php?u_id=$user_id','_self')</script>";
			}
			else
			{
			echo"
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success btn-sm'>View</button></a>
				<a href='edit_post.php?post_id=$post_id' style='float:right;'><button  class='btn btn-info btn-sm'>Edit</button></a>
				<a href='functions/delete_post.php?post_id=$post_id' class='btn btn-danger btn-sm' style='float:right;'>Delete Post</a><br>
			</div><br><br>
			";
			}
		}
	}
		?>      
                            </div>
                        </div>
                    </div>
                </div>       
        </div>
        <script>
        	$('.btn-danger').on('click',function(e){
        		e.preventDefault();
        		const href = $(this).attr('href')
        		Swal.fire({
                    title: 'Are you sure',
                    text: 'Post will delete from databasse',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                    }).then((get_posts)=>{
        			if(get_posts.value){
        				document.location.href = href;
        			}
        		})
        	})
        	
        </script>
</body>
</html>
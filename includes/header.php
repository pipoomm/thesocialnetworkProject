<?php 

	include "connection.php";

	include "functions/functions.php";

?>

<!--<nav class="navbar navbar-default">

	<div class="container-fluid">

		<div class="navbar-header">

			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">

			<span class="sr-only">Toggle navigation</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			</button>

			<a class="navbar-brand" href="home.php">ISNE259200</a>

		</div>



		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	      <ul class="nav navbar-nav">

	      	

	      	<?php 

	      	$user = $_SESSION['user_email'];

			$user_id = $_SESSION['user_id'];

			$user_name = $_SESSION['user_name'];

			$first_name = $_SESSION['f_name'];

			$last_name = $_SESSION['l_name'];

			$describe_user = $_SESSION['describe_user'];

			$Relationship_status = $_SESSION['Relationship'];

			$user_pass = $_SESSION['user_pass'];

			$user_email = $_SESSION['user_email'];

			$user_country = $_SESSION['user_country'];

			$user_gender = $_SESSION['user_gender'];

			$user_birthday = $_SESSION['user_birthday'];

			$user_image = $_SESSION['user_image'];

			$user_cover = $_SESSION['user_cover'];

			$recovery_account = $_SESSION['recovery_aaccount'];

			$register_date = $_SESSION['user_reg_date'];

					

					

			$user_posts = "SELECT * FROM `posts` WHERE user_id= '$user_id'";

			$run_posts = mysqli_query($con,$user_posts); 

			$posts = mysqli_num_rows($run_posts);

			?>



	        <li><a href="profile.php?<?php //echo "u_id=$user_id" ?>"><i class="glyphicon glyphicon-user"></i> <?php //echo "$first_name"; ?></a></li>

	       	<li><a href="home.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>

			<li><a href="members.php">Find People</a></li>

			<li><a href="messages.php?u_id=new"><i class="glyphicon glyphicon-envelope"></i> Messages</a></li>





					<?php /*

						echo"



						<li class='dropdown'>

							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>

							<ul class='dropdown-menu'>

								<li>

									<a href='my_post.php?u_id=$user_id'>My Posts <span class='badge badge-secondary'>$posts</span></a>

								</li>

								<li>

									<a href='edit_profile.php?u_id=$user_id'>Edit Account</a>

								</li>

								<li role='separator' class='divider'></li>

								<li>

									<a href='logout.php'>Logout</a>

								</li>

							</ul>

						</li>

						";*/

					?>

			</ul>

			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown">

					<form class="navbar-form navbar-left" method="get" action="results.php">

						<div class="form-group">

							<input type="text" class="form-control" name="user_query" placeholder="Search">

						</div>

						<button type="submit" class="btn btn-info" name="search">Search</button>

					</form>

				</li>

			</ul> 

		</div>

	</div>

</nav>-->



<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

  <!--<a href="home.php" class="navbar-brand">ISNE259200</a>-->

   <a class="navbar-brand" href="home.php">

          <img src="images/logo.png" alt="lab2sochallengeTT" width="30">

        ISNE269200</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

     <!-- <li class="nav-item">

        <a href="home.php" class="nav-link"><i class="fas fa-home"></i> Home</a></li>

      </li>-->

      <li class="nav-item">

        <a href="profile.php?<?php echo "u_id=$user_id" ?>" class="nav-link" ><i class="fas fa-address-card"></i> <?php echo "$first_name"; ?></a>

      </li>

      <li class="nav-item ">

        <a href="messages.php?u_id=new"  class="nav-link" ><i class="fab fa-facebook-messenger"></i> Messages</a>

      </li>

      <li class="nav-item ">

        <a href="chatroom.php?<?php echo "u_id=$user_id" ?>"  class="nav-link" ><i class="fas fa-chalkboard-teacher"></i> TalkTalk</a>

      </li>

      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i> Menu

          </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href='edit_profile.php?<?php echo "u_id=$user_id" ?>'><i class="fas fa-user-cog"></i> Settings</a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href='logout.php'><i class="fas fa-sign-in-alt"></i> Logout</a>

        </div>

      </li>

    </ul>

    <form class="form-inline my-2 my-lg-0" action="members.php">

    <input type="text" class="form-control mr-sm-2" name="search_user" placeholder="Find Friend">

      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="search_user_btn"><i class="fas fa-search"></i> Search</button>

    </form>

  </div>

</nav><br><br>
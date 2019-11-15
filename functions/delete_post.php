<?php 
	$con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");
?>
<html>
<head>
	<title>Delete Process</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>
<body>

</body>
</html>


<?php

	if (isset($_GET['post_id'])) 
	{
		$post_id = $_GET['post_id'];
		$delete_post = "DELETE FROM `posts` WHERE post_id='$post_id'";
		$run_delete = mysqli_query($con,$delete_post);

		if($run_delete)
		{
			echo "<script>
			Swal.fire({
   				text: 'Post has been deleted',
    			type: 'success'
				}).then(function() {
   				 window.location = '../profile.php';
			});
			</script>";
			//echo "<script>window.open('../home.php','_self')</script>";
		}
	}

?>
<?php
	

	$conn = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");
	$user_to_msg = '1';
	$user_from_msg = '2';
	$msg = $_POST['msg_box'];

	$sql = "INSERT INTO `user_messages` (`user_to`,`user_from`,`msg_body`,`date`,`msg_seen`) VALUES ('$user_to_msg','$user_from_msg','$msg',CURRENT_TIMESTAMP,'no')";
	$query = mysqli_query($conn,$sql);

	if($query) {
		echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
	}
	else
	{
		echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
	}

	mysqli_close($conn);
?>
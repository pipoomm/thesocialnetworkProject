<?php
$con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet") or die ("Connection Unsuccessfull");
$uname = $_POST['uname'];
$umessage = $_POST['umessage'];
if($umessage == '')
{
	return true;
}
$ip = $_POST['ip'];
$query = "INSERT INTO `chatroom` (`id`, `name`, `message`, `time`, `ipaddr`) VALUES (NULL, '$uname', '$umessage', CURRENT_TIMESTAMP, '$ip')";
$run = mysqli_query($con , $query);
?>


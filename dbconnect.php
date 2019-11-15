<?php  
$mysqli = new mysqli("localhost", "mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");  
/* check connection */  
if (mysqli_connect_errno()) {  
    printf("Connect failed: %sn", mysqli_connect_error());  
    exit();  
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %sn", $mysqli->error);  
    exit();  
}  
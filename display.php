<?php 
	$con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet") or die ("Connection Unsuccessfull");
	$query = "SELECT * FROM `chatroom` ORDER by `time` ASC";
	$run = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($run)){
	?>
	<div class="msgdisplay">
		<span style="color: #67b9b3;"><?php echo $row['name'].": ";?></span>
		<span style="color: #67b9b3; font-size: 12px;">[ <?php echo $row['ipaddr'];?> ]</span><br>
		<span style="color: black;"><?php echo $row['message'];?></span><br>
		<span style="float: #939393; font-size: 10px; float: right;"><?php echo $row['time'];?></span>
	</div>
<?php   }
?>
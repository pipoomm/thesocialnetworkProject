<?php
	//$con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");

	$get_id = $_GET['post_id'];
		
	$get_com = "SELECT * FROM `comments` WHERE post_id='$get_id' ORDER by `date` ASC";
	
	$run_com = mysqli_query($con,$get_com);
	
	while($row=mysqli_fetch_array($run_com)){

		$com = $row['comment']; 
		$com_name = $row['comment_author']; 
		$date = $row['date']; 
		echo "
		<div class='row'>
        <div class='col-sm-3'>
    	</div>
            <div class='col-sm-6'>
                <div id='posts_com' class='panel-body'>
                	<div>
					<h5><strong>$com_name</strong></h5><p style='color: #949494;' ><i> commented</i> on $date <i class='fas fa-globe-asia'></i></p>
					<h3 style='margin-left:5px;font-size:15px;color: black;'>$com</h3>
					</div> 
                </div>
            </div>
         <div class='col-sm-3'>
    	</div>
        </div>
		";
	}
?>
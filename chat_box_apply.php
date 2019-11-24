<?php
session_start();
include("includes/header.php");
 if(!isset($_SESSION['user_email'])){
 	header("location: index.php");
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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
</head>

<body>
<style type="text/css">
body{
		overflow-x: hidden;
		background: url(images/2.jpg);
}
#select_user{
    overflow-x: hidden;
    overflow-y: scroll;
    padding-top: 2%;
    padding-bottom: 2%;
    background: #fff;
    max-height: 670px;
}
#posts{
    padding-top: 5%;
    padding-bottom: 2%;
    background: #fff;
    height: 100%;
}
div#messagesDiv{
	display: block;
	padding-top: 2%;
	height: 580px;
	overflow: auto;
	width: 700px;
	margin: 5px 0px;
}
.left_box_chat{
	border: 1.2px solid #1A237E;
	border-radius: 10px 10px 10px 0px;
	margin: 5px;
	padding: 0px 10px;
	display:inline-block;
	float:left;
	clear:both;
	text-align:left;
	font-size: 20px;
	color: #283593;
	background-color:#B3E5FC;	
}
.right_box_chat{
	border: 1.2px solid #33691E;
	border-radius: 10px 10px 0px 10px;
	margin: 5px;
	padding: 0px 10px;
	display:inline-block;
	float:right;
	clear:both;
	font-size: 20px;
	text-align:right;
	color: #2E7D32;
	background-color:#e2ffc7;
}
</style>
<?php
    if (isset($_GET['u_id'])) {
        $con = mysqli_connect("localhost","mawebhostc_socialnet","Asdfghjkl0","mawebhostc_socialnet");
        
        $get_id = $_GET['u_id'];
        $get_user = "SELECT * FROM `users` WHERE user_id='$get_id'"; 
		$run_user = mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
		
		$user_id = $row['user_id']; 
		$user_name = $row['user_name'];
		$f_name = $row['f_name'];

		$user = $_SESSION['user_email'];
   		$get_user = "SELECT * FROM `users` WHERE user_email='$user'";
    	$run_user = mysqli_query($con,$get_user);
    	$row = mysqli_fetch_array($run_user);

    	$user_from_msg = $row['user_id'];
    	$user_from_name = $row['user_name'];
    }
   
    ?>
<div id="output"></div>
<div class="row">
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
<div class="container">

<div class="col-md-12" id="messagesDiv">
<!--<div class="left_box_chat">1</div>
<div class="right_box_chat">2</div>-->
</div>


<input name="userID1" type="hidden" id="userID1" value="<?=(isset($_SESSION['user_id']))?$_SESSION['user_id']:''?>">
  <input name="userID2" type="hidden" id="userID2" value="<?=(isset($_GET['u_id']))?$_GET['u_id']:0?>">
  <!--  input hidden สำหรับ เก็บ chat_id ล่าสุดที่แสดง-->
  <input name="h_maxID" type="hidden" id="h_maxID" value="0">
  <input type="text" class="form-control" name="msg" id="msg" placeholder="Enter your message here..">
  
</div>
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

            $user_posts = "SELECT * FROM `posts` WHERE user_id= '$user_id'";

			$run_posts = mysqli_query($con,$user_posts); 

			$posts = mysqli_num_rows($run_posts);
            }

            if($get_id == "new"){

            }else{

            echo "
                    <div class='col-md-auto' id='posts'>
                    <img class='rounded mx-auto d-block' src='users/$user_image' width='150' height='150' />
                    <br><br>
                    <center><ul class='list-group'>
                    <a href='user_profile.php?u_id=$user_id' class='list-group-item list-group-item-action list-group-item-primary'>$f_name $l_name
                    <span class='badge badge-primary badge-pill'>$posts</span>
                    </a>
                      <li class='list-group-item' title='Country'>$user_country</li>
                    </ul></center>
                    </div>
                
                ";
            }
        ?>
        
    </div>
</div>
<!--<form name="form2" method="post" action="chat_box_login.php">
  <input type="submit" name="btn_logout" id="btn_logout" value="Logout ลบ session">
</form>-->
<br>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>      
<script type="text/javascript">
var load_chat; // กำหนดตัวแปร สำหรับเป็นฟังก์ชั่นเรียกข้อมูลมาแสดง
var first_load=1; // กำหนดตัวแปรสำหรับโหลดข้อมูลครั้งแรกให้เท่ากับ 1
load_chat = function(userID){
	var maxID = $("#h_maxID").val(); // chat_id ล่าสุดที่แสดง
	$.post("ajax_chat.php",{
		viewData:first_load,
		userID:userID,
		maxID:maxID
	},function(data){
		if(first_load==1){ // ถ้าเป็นการโหลดครั้งแรก ให้ดึงข้อมูลทั้งหมดที่เคยบันทึกมาแสดง
			for(var k=0;k<data.length;k++){ // วนลูปแสดงข้อความ chat ที่เคยบันทึกไว้ทั้งหมด
				if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
					$("#h_maxID").val(data[k].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
					// แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
					$("#messagesDiv").append("<div class=\""+data[k].data_align+"_box_chat\">"+data[k].data_msg+"</div>"); 
					$("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight; // เลือน scroll ไปข้อความล่าสุด  	
				}
			};
		}else{ // ถ้าเป็นข้อมูลที่เพิ่งส่งไปล่าสุด
			if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
				$("#h_maxID").val(data[0].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
				// แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
				$("#messagesDiv").append("<div class=\""+data[0].data_align+"_box_chat\">"+data[0].data_msg+"</div>"); 
				$("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight;   // เลือน scroll ไปข้อความล่าสุด
			}
		}
		first_load++;// บวกค่า first_load
	});		
}
// กำหนดให้ทำงานทกๆ 2.5 วินาทีเพิ่มแสดงข้อมูลคู่สนทนา
setInterval(function(){
	var userID = $("#userID2").val(); // id user ของผู้รับ
	load_chat(userID); // เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
},3000);	
$(function(){
	

 /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
  $("#msg").keypress(function (e) { // เมื่อกดที่ ช่องข้อความ  
	if (e.keyCode == 13) { // ถ้ากดปุ่ม enter  
	  var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
	  var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
	  var msg = $("#msg").val();  // เก็บค่าข้อความ  
	  $.post("ajax_chat.php",{
		  user1:user1,
		  user2:user2,
		  msg:msg
	  },function(data){
		  	load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
	  		$("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่  		  
	  });

	}  
  });  
  
});

</script>
</body>
</html>
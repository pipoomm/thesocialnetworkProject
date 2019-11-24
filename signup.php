<!DOCTYPE html>
<html>
<head>
    <title>the SocialNetwork | Signin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<style>

@font-face {
  font-family: Poppins-Regular;
  src: url('loginfunction/fonts/poppins/Poppins-Regular.ttf'); 
}

@font-face {
  font-family: Poppins-Bold;
  src: url('loginfunction/fonts/poppins/Poppins-Bold.ttf'); 
}

@font-face {
  font-family: Poppins-Medium;
  src: url('loginfunction/fonts/poppins/Poppins-Medium.ttf'); 
}

@font-face {
  font-family: Montserrat-Bold;
  src: url('loginfunction/fonts/montserrat/Montserrat-Bold.ttf'); 
}
body{
font-family: Poppins-Regular;
overflow-x: hidden;
//background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
background: -webkit-linear-gradient(-135deg,#c850c0,#4158d0);
}
.btn-group-lg>.btn, .btn-lg {
    border-radius: 25px;
    font-family: Montserrat-Bold;
    font-size: 15px;
    line-height: 1.5;
    color: #fff;
    text-transform: uppercase;
}
.form-control{
font-size: 15px;
font-family: Poppins-Medium;
border-radius: 10px;
color: #666;
background-color: #e6e6e6;
border: none;
}
a{
text-decoration: none;
float: right;
font-size: 13px;
line-height: 1.5;color: #666;
}
a:hover {
text-decoration: none;
color: #007bff;
}

.main-content{
padding: 50px 40px 33px 40px;
background: #fff;
border-radius: 10px;
margin-top: 8%;
}
.header{
font-family: Poppins-Bold;
margin-bottom: 5px;
text-align:center;
font-size: 24px;
}
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-md-8">
                    <div class="main-content">
            <div class="header">
                <span>Account Registeration</span>
                <hr>
            </div>
                <form action="" method="post">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="First Name" id="fname" name="first_name" required="required">
                    </div>
                   <div class="form-group col-md-6">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Last Name" id="lname" name="last_name" required="required">
                    </div>
                </div>
                    <div class="form-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
                    </div>
                    <div class="form-group col-md-6">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password_m" type="password" class="form-control" placeholder="Confirm Password" required="required">
                    </div>
                </div>
                    <div class="form-group">
                        <select class="form-control" name="u_gender" required="required">
                            <option>Select your Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control input-md" placeholder="Email" name="u_birthday" required="required">
                    </div><br>
                    <div class='form-group'>
                        <center>
                            <div class="g-recaptcha" data-sitekey="6Lfc3MAUAAAAANR-aRaRhs5WS8bMo-b_z7tnylwd"></div>
                        </center>
                    </div>
                    <a data-toggle="tooltip" title="Signin" href="index.php"><i class="fas fa-long-arrow-alt-left"></i> Already have an account?</a><br><br>
                    <center><button id="signup" class="btn btn-primary btn-lg btn-block" name="sign_up">Signup</button></center>
                    <?php include("insert_user.php"); ?>
                </form>
        </div>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
<br><br>
</body>
<script src="dist/bootstrap-validate.js"></script>
<script>
bootstrapValidate(['#fname', '#lname'], 'regex:^[a-zA-Z]+$:Not contain special symbol and number|min:3:Enter at least 3 characters!');
bootstrapValidate('#email', 'email:Enter a valid E-Mail!');
bootstrapValidate('#password', 'min:9:Enter at least 9 characters!');
bootstrapValidate('#password_m', 'matches:#password:Your passwords should match');
</script>
</html>
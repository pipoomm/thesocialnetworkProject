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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>



</head>

<style>

    body{

        overflow-x: hidden;

        background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);



    }

    .main-content{

        width: 750px;

        margin: 30px auto;

        border-radius: 0.5rem;

        background: rgba(255,255,255,255);

        padding: 40px 50px;

        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);

    }

    .header{

        border: 0px solid #000;

        margin-bottom: 5px;

    }



</style>

<body>

<div class="row">

    <div class="col-sm-12">

        <div class="main-content">

            <div class="header">

                <h3 style="text-align: center;">Account Registeration</h3>

                <hr>

            </div>

            <div class="l-part">

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

                    <div class="form-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                        <input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">

                    </div>

                    <div class="form-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                        <input id="password_m" type="password" class="form-control" placeholder="Confirm Password" required="required">

                    </div>

                    <div class="form-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>

                        <select class="form-control" name="u_country" required="required">

                            <option disabled>Select your Country</option>

                            <option>Thailand</option>

                            <option>United States of America</option>

                            <option>China</option>

                            <option>Japan</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>

                        <select class="form-control input-md" name="u_gender" required="required">

                            <option disabled>Select your Gender</option>

                            <option>Male</option>

                            <option>Female</option>

                            <option>Others</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                        <input type="date" class="form-control input-md" placeholder="Email" name="u_birthday" required="required">

                    </div><br>

                    <div class='form-group'>

                        <center>

                            <div class="g-recaptcha" data-sitekey="6Lfc3MAUAAAAANR-aRaRhs5WS8bMo-b_z7tnylwd"></div>

                        </center>

                    </div>

                    <a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin" href="index.php">Already have an account?</a><br><br>



                    <center><button id="signup" class="btn btn-primary btn-lg btn-block" name="sign_up">Signup</button></center>

                    <?php include("insert_user.php"); ?>

                    

                </form>

            </div>

        </div>

    </div>

</div>

</body>

<script src="dist/bootstrap-validate.js"></script>

<script>

bootstrapValidate(['#fname', '#lname'], 'regex:^[a-zA-Z]+$:Not contain special symbol and number|min:3:Enter at least 3 characters!');

bootstrapValidate('#email', 'email:Enter a valid E-Mail!');

bootstrapValidate('#password', 'min:9:Enter at least 9 characters!');

bootstrapValidate('#password_m', 'matches:#password:Your passwords should match');

</script>

</html>
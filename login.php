<?php

require 'Libs/connect.php';
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
// Define $username and $password
        $username=trim(strip_tags($_POST['username']));
        $password=trim($_POST['password']);
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);

// SQL query to fetch information of registerd users and finds user match.
        $query = $mysqli->query("select * from user where password='$password' AND login='$username'");
        if ($query->num_rows == 1) {
            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
        }
        $mysqli->close();// Closing Connection
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Webarch - Responsive Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->
<!-- BEGIN CSS TEMPLATE -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-body no-top lazy"  data-original="assets/img/real-estate-background.jpg"  style="background-image: url('assets/img/real-estate-background.jpg'); background-size: 100% 100%;">
<div class="container">
  <div class="row login-container animated fadeInUp">  
        <div class="col-md-4 col-md-offset-4 tiles grey no-padding">
          <!--<h2 class="normal">Sign in to webarch</h2>-->
          <!--<p>Use Facebook, Twitter or your email to sign in.<br></p>-->
          <!--<p class="p-b-20">Sign up Now! for webarch accounts, it's free and always will be..</p>-->
		  <!--<button type="button" class="btn btn-primary btn-cons" id="login_toggle">Login</button> or&nbsp;&nbsp;<button type="button" class="btn btn-info btn-cons" id="register_toggle"> Create an account</button>-->
        <!--</div>-->
		<div class="tiles grey p-t-20 p-b-20 text-black">
			<form id="frm_login" class="login-form" method="post">
                <div class=" form-group col-md-4 p-l-80 p-b-20">
                <img src="assets/img/logo_3.png">
                    </div>
                    <div class="form-group col-md-11 m-l-15">
                        <input name="username" id="username" type="username"  class="form-control" placeholder="Username">
                    </div>
                <div class="form-group col-md-11 m-l-15">
                        <input name="password" id="password" type="password"  class="form-control" placeholder="Password">
                      </div>
                <div class="form-group col-md-12 text-center"><?php echo $error; ?></div>
                <div class="form-group col-md-11 m-l-15">
                        <button id="login_toggle" class="btn btn-primary btn-cons pull-right" type="submit" name="submit">Login</button>
                </div>
			  </form>
			<!--<form id="frm_register" class="animated fadeIn" style="display:none">-->
                    <!--<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">-->
                      <!--<div class="col-md-6 col-sm-6">-->
                        <!--<input name="reg_username" id="reg_username" type="text"  class="form-control" placeholder="Username">-->
                      <!--</div>-->
                      <!--<div class="col-md-6 col-sm-6">-->
                        <!--<input name="reg_pass" id="reg_pass" type="password"  class="form-control" placeholder="Password">-->
                      <!--</div>-->
                    <!--</div>	-->
                    <!--<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">-->
                      <!--<div class="col-md-12">-->
                        <!--<input name="reg_mail" id="reg_mail" type="text"  class="form-control" placeholder="Mailing Address">-->
                      <!--</div>-->
                    <!--</div>	-->
                    <!--<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">-->
                      <!--<div class="col-md-6 col-sm-6">-->
                        <!--<input name="reg_first_Name" id="reg_first_Name" type="text"  class="form-control" placeholder="First Name">-->
                      <!--</div>-->
                      <!--<div class="col-md-6 col-sm-6">-->
                        <!--<input name="reg_first_Name" id="reg_first_Name" type="password"  class="form-control" placeholder="Last Name">-->
                      <!--</div>-->
                    <!--</div>	-->
                    <!--<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">-->
                      <!--<div class="col-md-12 ">-->
                        <!--<input name="reg_email" id="reg_email" type="text"  class="form-control" placeholder="Email">-->
                      <!--</div>-->
                    <!--</div>						-->
			<!--</form>-->

        </div>
      </div>   
  </div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="assets/js/login_v2.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<!-- END CORE TEMPLATE JS -->
</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Rapid Auth" name="A secure and high performance auth system" />
		<meta content="Rapid Auth" name="bullet" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Icons css -->
        <link href="assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="css" />
        <link href="assets/libs/dripicons/webfont/webfont.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <!-- build:css -->
        <link href="assets/css/app.css" rel="stylesheet" type="text/css" />
        <!-- Toastr CSS -->
        <link href="assets/css/toastr.css" rel="stylesheet"/>
        <!-- endbuild -->
    </head>
    <body class="bg-account-pages">

        <!-- Login -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">

                                    <!-- Logo box-->
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span><img src="assets/images/logo.png" alt="" height="28"></span>
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="account-content">
                                        <form method="post">
                                            <div class="form-group mb-3">
                                                <label for="emailaddress" class="font-weight-medium">Username</label>
                                                <input name="username" class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your username">
                                            </div>

                                            <div class="form-group mb-3">
                                                <a href="auth-recoverpassword.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label for="password" class="font-weight-medium">Password</label>
                                                <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>

                                            <div class="form-group mb-3">
                                            </div>

                                            <div class="form-group row text-center">
                                                <div class="col-12">
                                                    <button name="submit" class="btn btn-block btn-success waves-effect waves-light" type="submit">Sign In</button>
                                                </div>
                                            </div>
                                        </form> <!-- end form -->

                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Don't have an account? <a href="auth-register.php" class="text-muted m-l-5"><b>Sign Up</b></a></p>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end account-content -->

                                </div> <!-- end account-box -->
                            </div>
                            <!-- end account-page-->
                        </div>
                        <!-- end wrapper-page -->

                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- END HOME -->    


        <!-- jQuery  -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        
        <!-- Toastr js -->
        <script src="assets/js/toastr.js"></script>
    </body>
</html>

<?php
    //error_reporting(0);
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    try 
    {
        $post_username = $_POST["username"];
        $post_password = $_POST["password"];
    }
    catch (Exception $e){}

    if (isset($_POST['submit']) && strlen($post_password) > 4 && strlen($post_username) > 3)
    {
        switch (false)
        {
            case (!ip_is_banned($_SERVER["HTTP_CF_CONNECTING_IP"])):
                echo '<script>toastr.error("Your IP is banned from this service, come back tomorrow", "Error")</script>';
                break;
            case (strlen($post_password) > 4 && strlen($post_username) > 3):
                echo "<script>toastr.error('Input too short', 'Error')</script>";
                break;
            case (!valid_input($post_username, $post_password)):
                    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/cookies.php';
                    update_last_ip($post_username);
                    add_cookie($post_username, $post_password, get_uid_by_username($post_username));    
                    echo '<script>window.location.href = "dashboard.php";</script>';
                break;
            default:
                add_fail($_SERVER["HTTP_CF_CONNECTING_IP"]);
                echo "<script>toastr.error('Wrong Username / Password', 'Error')</script>";
                break;
        }
    }

?>

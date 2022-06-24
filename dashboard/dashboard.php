<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Rapid Auth" name="A secure and high performance auth system" />
		<meta content="Rapid Auth" name="bullet" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

        <!-- Icons css -->
        <link href="assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dripicons/webfont/webfont.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <!-- build:css -->
        <link href="assets/css/app.css" rel="stylesheet" type="text/css" />
        <!-- endbuild -->

    </head>

    <body>

        <!-- Navigation Bar-->
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/navbar.php';
            echo $nav_bar;
        ?>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page title box -->
                <div class="page-title-alt-bg"></div>
                <div class="page-title-box">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <!-- End page title box -->
                
                <div class="row">

                <div class="col-xl-4">

                <div class="card-box">
                    <h1>Message of the day</h1>
                    <p id="message_of_the_day">asd</p>
                </div> <!-- end card-box-->

                </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title">Totals Users</h4>
                            <div class="mb-3 mt-4">
                                <h2 id="total_users_id" class="font-weight-light">500</h2>
                            </div>
                            <div class="chartjs-chart dash-sales-chart">
                                <canvas id="user-chart"></canvas>
                            </div>
                        </div><!-- end card-box-->

                    </div> <!-- end col -->


                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title">Totals Keys</h4>
                            <div class="mb-3 mt-4">
                                <h2 id="total_keys_id" class="font-weight-light">400</h2>
                            </div>
                            <div class="chartjs-chart dash-sales-chart">
                                <canvas id="key-chart"></canvas>
                            </div>
                        </div><!-- end card-box-->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        2022 © bullet - rapid-auth.com
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- Right Sidebar -->
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/right_sidebar.php';
            echo $right_bar;
        ?>
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/js_include.php';
            echo $js;
        ?>
        <script>
            $(document).ready(function() {
                // Default Datatable
                $('#datatable').DataTable({
                    "pageLength": 5,
                    "searching": false,
                    "lengthChange": false
                });
            } );
        </script>

    </body>
</html>

<?php
    //error_reporting(0);
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    //This Part should be on every dashboard site expect login and sign up 
    /*
    if (!check_cookie())
        echo '<script>window.location.href = "auth-login.php";</script>';
*/
    $dashboard_username = get_cookie_information()[0];
    $dashboard_profile_picture_url = get_profile_picture_url_by_uid(get_cookie_information()[2]);
    
    echo '<script>document.getElementById("dashboard_username").innerHTML = "' . $dashboard_username . '";</script>';

    echo '<script>document.getElementById("dashboard_username_1").innerHTML = "' . $dashboard_username . '";</script>';

    echo '<script>document.getElementById("dashboard_rank").innerHTML = "' . get_rank_by_uid(get_cookie_information()[2]) . '";</script>';

    echo '<script>document.getElementById("dashboard_profile_picture").src = "' . $dashboard_profile_picture_url . '";</script>';

    echo '<script>document.getElementById("dashboard_profile_picture_1").src = "' . $dashboard_profile_picture_url . '";</script>';

    //This is the end of the part for every website

    $statement = $pdo->prepare("SELECT message_of_the_day FROM `dashboard_settings` WHERE id=1 ");
    $statement->execute(array(0));   
    
    while($row = $statement->fetch()) {
        $message_of_the_day = $row["message_of_the_day"];    
    }
    

    $message_of_the_day = str_replace("{username}", $dashboard_username,  $message_of_the_day);

    echo "\n<script>document.getElementById('message_of_the_day').innerHTML = `$message_of_the_day`;</script>\n";



    echo '<script>document.getElementById("total_users_id").innerHTML = "' . get_total_users_last_record() . '";</script>';

    echo '<script>document.getElementById("total_keys_id").innerHTML = "' . get_total_keys_last_record() . '";</script>';

    echo get_js();

    

    
        
        

?>
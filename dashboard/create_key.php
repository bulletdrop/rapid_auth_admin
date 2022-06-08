<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Create a key</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
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

        <!-- Select 2 css -->
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet">
        <link href="assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

    </head>

    <body>

        <!-- Navigation Bar-->
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/navbar.php';
            echo $nav_bar;
        ?>


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
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create a key</h4>
                            <form class="form-horizontal" method="post">

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"></label>
                                    <div class="col-md-10">
                                    <button type="button" onclick="generate_key()" class="btn btn-primary w-md">Generate</button>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Key Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="key_name" name="key_name" type="text" required="" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Days<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="days_left" type="number" required="" class="form-control" value="1" min="1" max="1000000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Lifetime</label>
                                    <div class="col-sm-10">
                                        <input name="lifetime" type="checkbox" data-plugin="switchery" data-color="#039cfd"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Freezed</label>
                                    <div class="col-sm-10">
                                        <input name="freezed" type="checkbox" data-plugin="switchery" data-color="#039cfd"/>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Select a product<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="product" class="form-control">
                                            <?php
                                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/cookies.php';
                                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/get_group_info.php';
                                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/products.php';
                                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/users/get_user_info.php';
                                                
                
                                                if (!uid_in_group(get_cookie_information()[2]))
                                                {
                                                    echo '<script>error_msg("You\'re not in a group")</script>';   
                                                    
                                                }
                                                else
                                                {
                                                    $gid = get_gid_by_uid(get_cookie_information()[2]);
                                                    foreach (get_products_by_gid($gid) as $product)
                                                    {
                                                        echo '<option>' . $product . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>        
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                </div>                        
                            </form>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create multiple Keys</h4>
                            <form class="form-horizontal" method="post">

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"></label>
                                    <div class="col-md-10">
                                    <button type="button" onclick="generate_key_mass()" class="btn btn-primary w-md">Generate</button>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="amount" name="amount" type="number" required="" class="form-control" value="1" min="2" max="1000">
                                    </div>
                                </div>      

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Separator<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="seperator" id="seperator" type="text" required="" class="form-control" value=",">
                                    </div>
                                </div>                        

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Keys<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea id="key_name_mass" name="key_name_mass" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Days<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="days_left_mass" type="number" required="" class="form-control" value="1" min="1" max="1000000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Lifetime</label>
                                    <div class="col-sm-10">
                                        <input name="lifetime_mass" type="checkbox" data-plugin="switchery" data-color="#039cfd"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Freezed</label>
                                    <div class="col-sm-10">
                                        <input name="freezed_mass" type="checkbox" data-plugin="switchery" data-color="#039cfd"/>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Select a product<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="product_mass" class="form-control">
                                            <?php
                                                include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
                                                
                
                                                if (!uid_in_group(get_cookie_information()[2]))
                                                {
                                                    echo '<script>error_msg("You\'re not in a group")</script>';   
                                                    
                                                }
                                                else
                                                {
                                                    $gid = get_gid_by_uid(get_cookie_information()[2]);
                                                    foreach (get_products_by_gid($gid) as $product)
                                                    {
                                                        echo '<option>' . $product . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>        
                                <div>
                                    <button type="submit" name="submit_mass" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                </div>                        
                            </form>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
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
        <!-- /Right-bar -->


        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/js_include.php';
            echo $js;
        ?>

        <script>
            function generate_key_mass()
            {
                let amount = document.getElementById("amount").value;
                var seperator = document.getElementById("seperator").value;
                var keys = "";

                for (var i = 0; i < amount; i++) {
                    if (i == amount -1)
                    {
                        keys += generate_key_string();
                        break;
                    }
                    
                    keys += generate_key_string() + seperator;
                }

                document.getElementById("key_name_mass").value = keys;
            }

            function generate_key()
            {
                document.getElementById("key_name").value = generate_key_string();
            }

            function generate_key_string()
            {
                return `${random_string(5)}-${random_string(5)}-${random_string(5)}-${random_string(5)}-${random_string(5)}-${random_string(5)}`;
            }
            function random_string(length) {
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var charactersLength = characters.length;
                for ( var i = 0; i < length; i++ ) 
                {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }
        </script>

    </body>
</html>

<?php
    // error_reporting(0);
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    //This Part should be on every dashboard site expect login and sign up 
    if (!check_cookie())
        echo '<script>window.location.href = "auth-login.php";</script>';

    $dashboard_username = get_cookie_information()[0];
    $dashboard_profile_picture_url = get_profile_picture_url_by_uid(get_cookie_information()[2]);
    
    echo '<script>document.getElementById("dashboard_username").innerHTML = "' . $dashboard_username . '";</script>';

    echo '<script>document.getElementById("dashboard_username_1").innerHTML = "' . $dashboard_username . '";</script>';

    echo '<script>document.getElementById("dashboard_rank").innerHTML = "' . get_rank_by_uid(get_cookie_information()[2]) . '";</script>';

    echo '<script>document.getElementById("dashboard_profile_picture").src = "' . $dashboard_profile_picture_url . '";</script>';

    echo '<script>document.getElementById("dashboard_profile_picture_1").src = "' . $dashboard_profile_picture_url . '";</script>';

    //This is the end of the part for every website

    if (check_cookie() && uid_in_group(get_cookie_information()[2]) && isset($_POST["submit"]))
    {
        $gid = get_gid_by_uid(get_cookie_information()[2]);
        $product_name = $_POST["product"];
        $product_id = get_product_index_by_name($gid, $product_name);
        $freezed = 0;
        $lifetime = 0;
        $days_left = $_POST["days_left"];
        $key_name = $_POST["key_name"];

        if ($_POST["freezed"] == "on")
            $freezed = 1;

        if ($_POST["lifetime"] == "on")
            $lifetime = 1;

        if ($product_id != "-1")
        {
            insert_key_in_db($gid, $key_name, $product_id, $lifetime, $freezed, $days_left);
            write_log("User: " . $dashboard_username . " created key: " . $key_name . " for product: " . $product_name);
            echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/key_manager.php";</script>';
        }
    }

    if (check_cookie() && uid_in_group(get_cookie_information()[2]) && isset($_POST["submit_mass"]))
    {
        $gid = get_gid_by_uid(get_cookie_information()[2]);
        $product_name = $_POST["product_mass"];
        $product_id = get_product_index_by_name($gid, $product_name);
        $freezed = 0;
        $lifetime = 0;
        $days_left = $_POST["days_left_mass"];
        $key_name = $_POST["key_name_mass"];
        $seperator = $_POST["seperator"];

        if ($_POST["freezed_mass"] == "on")
            $freezed = 1;

        if ($_POST["lifetime_mass"] == "on")
            $lifetime = 1;

        if ($product_id != "-1")
        {
            foreach (explode($seperator, $key_name) as $key)
            {
                insert_key_in_db($gid, $key, $product_id, $lifetime, $freezed, $days_left);
                write_log("User: " . $dashboard_username . " created key: " . $key_name . " for product: " . $product_name);
            }
                
            echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/key_manager.php";</script>';
        }
    }
    

?>
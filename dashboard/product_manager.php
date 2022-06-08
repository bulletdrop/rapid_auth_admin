<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Product Manager</title>
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
        <!-- End Navigation Bar-->

        <!-- Error Modal -->
        <div class="modal fade error_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Error :(</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="error_msg">
                        Wrong Username / Password
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Leave group Modal -->
        <div class="modal fade leave_group_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Are you sure that you want to leave the group?
                        
                    </div>
                    <button onclick="leave_group()" type="button" class="btn btn-success w-md">Yes</button>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Add Product Modal -->
        <div class="modal fade add_product_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Add a new product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    <form method="post">
                    <label>Product name</label>
                    <input name="new_product_name" type="text" required="" class="form-control">
                    <input style="margin-top: 1em;" type="submit" name="submit" value="Add" class="btn btn-success w-md">
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Remove Product Modal -->
        <div class="modal fade remove_product_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Are you sure ?
                        
                    </div>
                    <button id="kick_button" onclick="leave_group()" type="button" class="btn btn-success w-md">Yes</button>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Compensate Time for Product Modal -->
        <div class="modal fade compensate_time_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Compensate Time</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="add_time_form" action="../backend/groups/compensate_time_for_product.php">
                        <div class="modal-body">
                            <label>Days to compensate</label>
                            <input name="days_to_add" type="number" min="1" max="9999" required="" class="form-control">
                        </div>
                        <button type="submit" name="submit" name="product_id" id="add_time" type="button" class="btn btn-success w-md">Compensate</button>
                    </form>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Freeze keys for product Modal -->
        <div class="modal fade freeze_product" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Are you sure ?
                        
                    </div>
                    <a id="freeze_keys"><button type="button" class="btn btn-success w-md">Yes</button></a>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

         <!-- Unfreeze keys for product Modal -->
         <div class="modal fade unfreeze_product" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        Are you sure ?
                        
                    </div>
                    <a id="unfreeze_keys"><button type="button" class="btn btn-success w-md">Yes</button></a>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



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
                            <h4 class="m-t-0 header-title">Manage your products</h4>
                            <?php
                                include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
                                

                                if (!uid_in_group(get_cookie_information()[2]))
                                {
                                    echo '<script>error_msg("You\'re not in a group")</script>';   
                                    
                                }
                                else
                                {
                                    echo '<button onclick="add_product_modal()" type="button" class="btn btn-primary w-md">Add</button>';
                                    $gid = get_gid_by_uid(get_cookie_information()[2]);
                                    echo '
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead><tbody>';
                                    $i = 0;    
                                    foreach (get_products_by_gid($gid) as $product)
                                    {
                                        echo '<tr>
                                        <th>' . $i .'</th>
                                        <td>' . $product . '</td>
                                        <td><button onclick="confirm_remove(' .$i . ')" type="button" class="btn btn-danger w-md">Remove</button>
                                        <button onclick="compensate_time(' . $i . ')" type="button" class="btn btn-primary w-md">Compensate Time</button>
                                        <button onclick="freeze_keys_modal(' . $i . ')" type="button" class="btn btn-primary w-md">Freeze</button>
                                        <button onclick="unfreeze_keys_modal(' . $i . ')" type="button" class="btn btn-success w-md">Unfreeze</button></td>
                                        </tr>';
                                        $i++;
                                    }
                                    echo '</tbody></table>';   
                                }
                            ?>
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
            function error_msg(msg)
            {
                document.getElementById("error_msg").innerHTML = msg;
                $(".error_modal").modal();
            }

            function leave_group()
            {
                window.location.href = "../backend/groups/leave_group.php?confirmed=yes";
            }

            function confirm_leave_group()
            {
                $(".leave_group_modal").modal();
            }

            function add_product_modal()
            {
                $(".add_product_modal").modal();
            }

            function confirm_remove(id)
            {
                
            }

            function freeze_keys_modal(id)
            {
                document.getElementById("freeze_keys").href = "../backend/groups/freeze_product_keys.php?product_id=" + id;
                $(".freeze_product").modal();
            }

            function unfreeze_keys_modal(id)
            {
                document.getElementById("unfreeze_keys").href = "../backend/groups/unfreeze_product_keys.php?product_id=" + id;
                $(".unfreeze_product").modal();
            }

            function compensate_time(id)
            {
                document.getElementById("add_time").value = id;
                document.getElementById("add_time_form").action = "../backend/groups/compensate_time_for_product.php?product_id=" + id;
                $(".compensate_time_modal").modal();
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

    $products = get_products_by_gid($gid);
    if (!uid_in_group(get_cookie_information()[2]))
    {
        echo '<script>error_msg("You\'re not in a group")</script>';   
    }
    else
    {
        if (isset($_POST["submit"]) && strlen($_POST["new_product_name"]) > 1)
        {
            if (!product_name_exist($gid, $_POST["new_product_name"]))
            {
                $gid = get_gid_by_uid(get_cookie_information()[2]);
                add_product($gid, $_POST["new_product_name"]);
                write_log("User: " . $dashboard_username . " created a new product: " . $_POST["new_product_name"]);
                unset($_REQUEST);
                echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/product_manager.php";</script>';
            }
            
        }
    }
    
    
?>
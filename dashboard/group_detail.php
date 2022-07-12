<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Group details</title>
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

        <!-- Add Memeber Modal -->
        <div class="modal fade add_member_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    <?php
                        echo '<form method="post" action="../backend/admin/groups/add_to_group.php?gid=' . $_GET["gid"] . '">';
                    ?>
                    <label>Username</label>
                    <input name="new_member_username" type="text" required="" class="form-control">
                    <input type="submit" name="submit" value="Add" class="btn btn-success w-md">
                    </form>
                    
                        
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Add Product Modal -->
        <div class="modal fade add_product_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Add a product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    <?php
                        echo '<form method="post" action="../backend/admin/groups/add_product.php?gid=' . $_GET["gid"] . '">';
                    ?>
                    <label>Product Name</label>
                    <input name="product_name" type="text" required="" class="form-control">
                    <input type="submit" name="submit" value="Add" class="btn btn-success w-md">
                    </form>
                    
                        
                    </div>
                    
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
                            <h4 class="header-title">API key</h4>
                            <form method="post">
                            <div class="form-group row">
                                <div class="col-sm-10"> 
                            
                                <?php
                                    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

                                    if (is_admin(get_cookie_information()[2]))
                                    {   
                                        echo '<input type="text" name="api_key" class="form-control" value="' . get_api_key_by_gid($_GET["gid"]) . '"> </div>';;
                                    }
                                ?>

                            
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button name="regenerate" type="submit" class="btn btn-primary w-md">Regenerate</button>
                                </div>
                            </form>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Options</h4>
                            <?php
                                echo '<a href="admin_loader_user_manager.php?gid=' . $_GET["gid"] . '">';
                            ?>
                            <button type="button" class="btn btn-primary w-md">View loader users</button></a>
                            <?php
                                echo '<a href="admin_key_manager.php?gid=' . $_GET["gid"] . '">';
                            ?>
                            <button type="button" class="btn btn-primary w-md" style="margin-left: 1em;">View license keys</button></a>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">PGP</h4>
                            <?php
                                include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';


                                if (is_admin(get_cookie_information()[2]))
                                {
                                    $gid = $_GET["gid"];
                                    echo '
                                    <form method="post" action="../backend/groups/update_pgp.php?gid=' . $_GET["gid"] . '">
                                    <div class="col-lg-12">
                                    <div class="card-box">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Public Key</label>
                                            <textarea name="public_key" class="form-control" rows="5">'.htmlspecialchars(get_public_key_by_gid($gid)).'</textarea>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Private Key</label>
                                            <textarea name="private_key" class="form-control" rows="5">'.htmlspecialchars(get_private_key_by_gid($gid)).'</textarea>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Private Key Password</label>
                                            <input name="private_key_password" class="form-control" rows="5" value="'. htmlspecialchars(get_private_key_password_by_gid($gid)).'">
                                        </div>
                                    </div> <!-- end card-box -->
                                    <input type="submit" value="Save" class="btn btn-primary w-md">
                                    </form>
                                </div>
                                    ';
                                }
                            ?>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Member</h4>
                            <button onclick="open_add_member_modal()" type="button" class="btn btn-primary w-md">Add to group</button>
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Username</th>
                                    <th>Owner</th>
                                    <th>Action (s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                        include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

                                        if (is_admin(get_cookie_information()[2]))
                                        {   
                                            $group_info = get_group_details_by_gid($_GET["gid"]);
                                            $group_member_array = json_decode($group_info["member_array"]);
                                            
                                            foreach ($group_member_array as $member)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $member . '</td>';
                                                echo '<td>' . get_username_by_uid($member) . '</td>';
                                                if ($member == $group_info["owner_uid"])
                                                    echo '<td>Yes</td>';
                                                else
                                                    echo '<td>No</td>';

                                                if ($member != $group_info["owner_uid"])
                                                {
                                                    echo '<td><a href="../backend/admin/groups/set_group_owner.php?gid=' . $_GET["gid"] . '&uid=' . $member .'"><button type="button" class="btn btn-primary w-md">Set owner</button></a>';
                                                    echo '<a href="../backend/admin/groups/kick_member.php?gid=' . $_GET["gid"] . '&uid=' . $member .'"><button style="margin-left: 1em;" type="button" class="btn btn-danger w-md">Kick</button></a></td>';
                                                }
                                                else
                                                {
                                                    echo '<td>None</td>';
                                                }
                                                echo '</tr>';
                                                    

                                            }
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Products</h4>
                            <button onclick="open_add_product_modal()" type="button" class="btn btn-primary w-md">Add product</button>
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                        include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

                                        if (is_admin(get_cookie_information()[2]))
                                        {   
                                            $group_info = get_group_details_by_gid($_GET["gid"]);
                                            $product_array = json_decode($group_info["products_array"]);

                                            $id = 0;
                                            foreach ($product_array as $product)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $id . '</td>';
                                                echo '<td>' . $product . '</td>';
                                                echo '<td><a href="../backend/admin/groups/remove_product.php?index=' . $id .'&gid=' . $_GET["gid"] . '"><button type="button" class="btn btn-danger w-md">Remove</button></a></td>';
                                                echo '</tr>';
                                                $id++;    

                                            }
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>

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
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/js_include.php';
            echo $js;
        ?>

    </body>
    <script>
    function open_add_member_modal()
    {
        $(".add_member_modal").modal();
    }

    function open_add_product_modal()
    {
        $(".add_product_modal").modal();
    }
</script>
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
    $uid = get_cookie_information()[2];
    if (isset($_POST["regenerate"]) && is_admin($uid))
    {
        regenerate_api_key($_GET["gid"]);
        write_log("Admin " . get_username_by_uid($uid) . "\nregenerated api key for group " . $_GET["gid"]);
        echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
    }
                

    
    

?>
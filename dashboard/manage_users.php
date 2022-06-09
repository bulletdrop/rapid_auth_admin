<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - User Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Rapid Auth" name="A secure and high performance auth system" />
		<meta content="Rapid Auth" name="bullet" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

         <!-- jvectormap -->
         <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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


        

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">User Manager</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Username</th>
                                    <th>Last IP Address</th>
                                    <th>Active</th>
                                    <th>Password</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/cookies.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/get_group_info.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/products.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/users/get_user_info.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/keys/keys.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/loader_users/l_users.php';


                                if (!uid_in_group(get_cookie_information()[2]))
                                {
                                    echo '<script>error_msg("You\'re not in a group")</script>';   
                                    
                                }
                                else
                                {
                                    $gid = get_gid_by_uid(get_cookie_information()[2]);
                                    $users = get_loader_users_by_gid($gid);
                                    foreach ($users as $user)
                                    {
                                        echo '<tr>';
                                        //UUID
                                        echo '<td>' . $user[0] . '</td>';
                                        
                                        
                                        //Username 
                                        echo '<td>' . $user[1] . '</td>';
                                        //Last IP Address
                                        echo '<td>' . $user[13] . '</td>';
                                        //Active
                                        if ($user[3] == 0)
                                            echo '<td>No</td>';
                                        else
                                            echo '<td>Yes</td>';
                                        
                                        
                                        echo '<td>' . $user[2] . '<button style="margin-left: 1em;" data-toggle="modal" data-target=".user_editor_modal_id' . $user[0] . '" type="button" class="btn btn-primary w-md">Edit</button></td></td>';
                                        echo '</tr>';


                                        
                                        echo '
                                        <div class="modal fade user_editor_modal_id' . $user[0] . '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel' . $user[0] . '" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel' . $user[0] . '">Key Editor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="card-box">
                                                        <ul class="nav nav-tabs tabs-bordered nav-justified">
                                                        <li class="nav-item">
                                                            <a href="#last_hwid_attempt' . $user[0] . '" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                                Last HWID Attempt
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#user_profile' . $user[0] . '" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                                User Profile
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#current_hwid' . $user[0] . '" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                                Current HWID
                                                            </a>
                                                        </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active show" id="last_hwid_attempt' . $user[0] . '">
                                                            <dl class="row">';

                                                            if (hwid_failed($user[0], $gid))
                                                            echo '
                                                                <dt class="col-sm-6">Windows Username</dt>
                                                                    <dd class="col-sm-6">' . $user[15] . '</dd>
                            
                                                                    <dt class="col-sm-6">GPU Name</dt>
                                                                    <dd class="col-sm-6">' . $user[16] . '</dd>

                                                                    <dt class="col-sm-6">GPU RAM</dt>
                                                                    <dd class="col-sm-6">' . $user[17] . '</dd>

                                                                    <dt class="col-sm-6">Drive count</dt>
                                                                    <dd class="col-sm-6">' . $user[18] . '</dd>

                                                                    <dt class="col-sm-6">CPU Name</dt>
                                                                    <dd class="col-sm-6">' . $user[19] . '</dd>

                                                                    <dt class="col-sm-6">CPU Cores</dt>
                                                                    <dd class="col-sm-6">' . $user[20] . '</dd>

                                                                    <dt class="col-sm-6">OS Caption</dt>
                                                                    <dd class="col-sm-6">' . $user[21] . '</dd>

                                                                    <dt class="col-sm-6">OS Serial Number</dt>
                                                                    <dd class="col-sm-6">' . $user[22] . '</dd>

                                                                    <dt class="col-sm-6">Last IP Address</dt>
                                                                    <dd class="col-sm-6">' . $user[23] . '</dd>
                                                                </dl>
                                                                <form method="post">
                                                                <button name="submit_hwid" type="submit" value="' . $user[0] . '" class="btn btn-primary w-md">Set new HWID</button>
                                                                </form>
                                                                ';
                                                            else
                                                                echo '<dt class="col-sm-6">No failed HWID Attempt</dt></dt></dl>';
                                                            
                                                            $product_array = array();
                                                            if ($user[4] != "0")
                                                            {
                                                                foreach (json_decode($user[4]) as $product)
                                                                {
                                                                    array_push($product_array, 
                                                                    array($product,
                                                                    get_product_name_by_kid_and_gid($product, $gid),
                                                                    get_key_name_by_kid_and_gid($product, $gid),
                                                                    get_days_left_by_kid_and_gid($product, $gid)));
                                                                }
                                                            }
                                                                
                                                            
                                                            
                                                            
                                                            
                                                            

                                                            echo '</div>
                                                            <div class="tab-pane" id="user_profile' . $user[0] . '">
                                                                <form method="post">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Username</label>
                                                                        <div class="col-sm-10"> <input type="text" name="username" class="form-control" value="' . $user[1] . '"> </div>
                                                                    </div>
            
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Password</label>
                                                                        <div class="col-sm-10"> <input type="text" name="password" class="form-control" value="' . $user[2] . '"> </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Note</label>
                                                                        <div class="col-sm-10"><textarea name="note" class="form-control" rows="5">' . $user[24] . '</textarea></div>
                                                                    </div>
                                                                    
            
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Active</label>
                                                                        <div class="col-sm-10"> <input name="active"';
                                                                    
                                                                    if ($user[3] == "1")    
                                                                        echo " checked";

                                                                    echo  ' type="checkbox" data-plugin="switchery" data-color="#039cfd"/></div>
                                                                    </div>';

                                                                    $product_counter = 1;
                                                                    foreach ($product_array as $product)
                                                                    {
                                                                        echo '<div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Product ' . $product_counter . '</label>';
                                                                        echo '<div class="col-sm-10">Key ID: ' . $product[0] . '<br>Product Name: ' . $product[1] . '<br>Key: ' . $product[2] . '<br>Days left: ' . $product[3] .'<br></div>';
                                                                        echo '</div>';
                                                                        $product_counter++;
                                                                    }
                                                                    
                                                                    echo '
                                                                    <button name="submit" type="submit" value="' . $user[0] . '" class="btn btn-primary w-md">Save</button>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane" id="current_hwid' . $user[0] . '">
                                                                <dl class="row">
                                                                    <dt class="col-sm-6">Windows Username</dt>
                                                                    <dd class="col-sm-6">' . $user[5] . '</dd>
                            
                                                                    <dt class="col-sm-6">GPU Name</dt>
                                                                    <dd class="col-sm-6">' . $user[6] . '</dd>

                                                                    <dt class="col-sm-6">GPU RAM</dt>
                                                                    <dd class="col-sm-6">' . $user[7] . '</dd>

                                                                    <dt class="col-sm-6">Drive count</dt>
                                                                    <dd class="col-sm-6">' . $user[8] . '</dd>

                                                                    <dt class="col-sm-6">CPU Name</dt>
                                                                    <dd class="col-sm-6">' . $user[9] . '</dd>

                                                                    <dt class="col-sm-6">CPU Cores</dt>
                                                                    <dd class="col-sm-6">' . $user[10] . '</dd>

                                                                    <dt class="col-sm-6">OS Caption</dt>
                                                                    <dd class="col-sm-6">' . $user[11] . '</dd>

                                                                    <dt class="col-sm-6">OS Serial Number</dt>
                                                                    <dd class="col-sm-6">' . $user[12] . '</dd>

                                                                    <dt class="col-sm-6">Last IP Address</dt>
                                                                    <dd class="col-sm-6">' . $user[13] . '</dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                    <!-- Modal Body end-->
                                                    </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        ';
                                        
                                    }
                                }

                                ?>
                                </tbody>
                            </table>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


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
        

        <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable({
                    keys: true
                });

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'print']
                });

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

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

    //This is the end of the part for every website,
    $gid = get_gid_by_uid(get_cookie_information()[2]);
    if (uid_in_group($gid))
    {
        if (isset($_POST["submit"]))
        {
            $post_username = encrypt_data($_POST["username"], $key);
            $post_password = encrypt_data($_POST["password"], $key);
            $post_note = $_POST["note"];
            $post_active = false;
            if ($_POST["active"] == "on")
                $post_active = true;
            
            if (strlen($post_username) > 0 && strlen($post_password) > 0)
                update_user_by_uuid_and_gid($_POST["submit"], $gid, $post_username, $post_password, $post_note, $post_active);
            echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/manage_users.php";</script>';
        }

        if (isset($_POST["submit_hwid"]))
        {
            set_attempt_hwid_as_new_hwid_by_gid_and_uuid($gid, $_POST["submit_hwid"]);
            write_log("User: " . $dashboard_username. " updated HWID for user: " . $post_username);
            echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/manage_users.php";</script>';
        }
    }
    


?>
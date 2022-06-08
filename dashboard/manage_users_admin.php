<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - User Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
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
                                    <th>Group</th>
                                    <th>Password</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

                                if (is_admin(get_cookie_information()[2]))
                                {
                                    $all_users = get_all_users();
                                    foreach ($all_users as $user)
                                    {
                                        echo '<tr>';
                                        //UUID
                                        echo '<td>' . $user["uid"] . '</td>';
                                        
                                        
                                        //Username 
                                        echo '<td>' . decrypt_data($user["username"], $key) . '</td>';
                                        //Last IP Address
                                        echo '<td>' . $user["last_ip"] . '</td>';
                                    
                                        //Group
                                        if ($user["gid"] == "-1")
                                            echo '<td>None</td>';
                                        else
                                            echo '<td>' . get_group_name_by_gid($user["gid"]) . '</td>';
                                        
                                        
                                        echo '<td>' . decrypt_data($user["email"], $key) . '<button style="margin-left: 1em;" data-toggle="modal" data-target=".user_editor_modal_id' . $user["uid"] . '" type="button" class="btn btn-primary w-md">Edit</button></td></td>';
                                        echo '</tr>';


                                        
                                        echo '
                                        <div class="modal fade user_editor_modal_id' . $user["uid"] . '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel' . $user["uid"] . '" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel' . $user["uid"] . '">User Editor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <div class="card-box">                                
                                                            <form class="form-horizontal" method="post" action="../backend/admin/submit_user_edit.php?uid=' . $user["uid"]. '">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Username</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="username" class="form-control" value="' . decrypt_data($user["username"], $key) . '">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">E-Mail Address</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="email" class="form-control" value="' . decrypt_data($user["email"], $key) . '">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="password" class="form-control" value="' . decrypt_data($user["password"], $key) . '">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Rank</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="rank" class="form-control" value="' . $user["rank"] . '">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Profile picture url</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="profile_picture_url" class="form-control" value="' . $user["profile_picture_url"] . '">
                                                                    </div>
                                                                </div>                                                               
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Note</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea name="note" class="form-control" rows="5">' . $user["note"] . '</textarea>
                                                                    </div>
                                                                </div>   

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Banned</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="checkbox" name="banned"';
                                                                        if ($user["banned"] == "1")
                                                                            echo ' checked ';
                                                                        echo 'data-plugin="switchery" data-color="#039cfd"/>
                                                                    </div>
                                                                </div>   

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Ban message</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="ban_message" class="form-control" value="' . $user["ban_message"] . '">
                                                                    </div>
                                                                </div> 
                                
                                                                <button name="submit" type="submit" value="' . $user["uid"] . '" class="btn btn-primary w-md">Save</button>
                                                            </form>
                                
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

    


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rapid Auth - Group Manager</title>
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


        <!-- Invite new Member Modal -->
        <div class="modal fade invite_member_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    <form method="post">
                    <label>Username</label>
                    <input name="new_member_username" type="text" required="" class="form-control">
                    <input type="submit" name="submit" value="Invite" class="btn btn-success w-md">
                    </form>
                    
                        
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Kick member modal -->
        <div class="modal fade kick_member_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
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
                            <h4 class="m-t-0 header-title">Manage a group</h4>
                            <?php
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/cookies.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/get_group_info.php';
                                include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/users/get_user_info.php';

                                if (!uid_in_group(get_cookie_information()[2]))
                                    echo '<script>error_msg("You\'re not in a group")</script>';   
                                
                                if (uid_in_group(get_cookie_information()[2]) && get_group_owner_uid_by_gid(get_gid_by_uid(get_cookie_information()[2])) != get_cookie_information()[2])
                                    echo '<p>You\'re currently only a group memeber, you can only leave the current group</p>
                                    <button onclick="confirm_leave_group()" type="button" class="btn btn-danger w-md">Leave group</button>';

                                if (get_group_owner_uid_by_gid(get_gid_by_uid(get_cookie_information()[2])) == get_cookie_information()[2])
                                {
                                    $gid = get_gid_by_uid(get_cookie_information()[2]);
                                    $member_array = json_decode(get_member_array_by_gid($gid));
                                    echo '
                                    <div class="col-lg-12">
                                    <div class="card-box">
                                        <h4 class="m-t-0 header-title">Member</h4>
                                        <button onclick="open_invite_modal()" type="button" class="btn btn-primary w-md">Invite</button>
                                        <table style="margin-top: 1em;" class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                            foreach ($member_array as $member)
                                            {
                                                echo '<tr><td>' . $member . '</td>';
                                                echo '<td>' . get_username_by_uid($member) . '</td>';
                                                echo '<td><button onclick="confirm_kick(' . $member . ', ' . get_cookie_information()[2] . ')" type="button" class="btn btn-danger w-md">Kick</button></td></tr>';
                                            }
                                    echo  '</tbody>
                                        </table>
                                        <div style="margin-top: 2em;" class="form-group row">
                                            <label class="col-sm-2 col-form-label">API Key</label>
                                            <div class="col-sm-8"><input type="text" disabled class="form-control" value="' . get_api_key_by_gid($gid) . '"></div>
                                        </div>
                                    </div> <!-- end card-box -->
                                        
                                </div>
                                    ';
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

            function open_invite_modal()
            {
                $(".invite_member_modal").modal();
            }

            function confirm_kick(id, uid)
            {
                if (id == uid)
                {
                    error_msg("You can't kick yourself");
                }
                else
                {
                    document.getElementById("kick_button").onclick = function confirm_kick() {window.location.href = "../backend/groups/kick_member.php?confirmed=yes&id=" + id};
                    $(".kick_member_modal").modal();
                }
                
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

    
    if (!uid_in_group(get_cookie_information()[2]))
        echo '<script>error_msg("You\'re not in a group")</script>';   


    if (get_group_owner_uid_by_gid(get_gid_by_uid(get_cookie_information()[2])) == get_cookie_information()[2])
    {
        if (isset($_POST["submit"]))
        {
            $invited_member_uid = get_uid_by_username($_POST["new_member_username"]);
            $gid = get_gid_by_uid(get_cookie_information()[2]);
            include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/invite_member.php';
            switch (false)
            {
                case !check_if_invite_exist($invited_member_uid, $gid):
                    echo '<script>error_msg("This user is allready invited")</script>';     
                    break;
                case !check_if_allready_in_same_group($gid, $invited_member_uid):
                    echo '<script>error_msg("This user is allready in this group")</script>';    
                    break;
                default:
                    insert_invite_in_db($invited_member_uid, $gid); 
                    echo '<script>window.location.href = "../backend/dashboard/redirect.php?filename=../../dashboard/manage_group.php";</script>';
                    break;
            }
        }
    }
    
    
?>
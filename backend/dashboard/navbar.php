<?php
$nav_bar = ' <header id="topnav">
<nav class="navbar-custom">

    <div class="container-fluid">
        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img id="dashboard_profile_picture_1" src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle"> <span class="ml-1" id="dashboard_username">Agnes K <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                </div>
            </li>
            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                    <i class="dripicons-gear noti-icon"></i>
                </a>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <a href="dashboard.php" class="logo">
                    <span class="logo-lg">
                        <img src="assets/images/logo.png" alt="" height="20">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo_sm.png" alt="" height="28">
                    </span>
                </a>
            </li>
        </ul>
    </div>

</nav>
<!-- end topbar-main -->

<div class="topbar-menu">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="dashboard.php"><i class="mdi mdi-view-dashboard"></i>Dashboard</a>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-key"></i>Keys</a>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li><a href="create_key.php">Create a key</a></li>
                                <li><a href="key_manager.php">Key Manager</a></li>     
                                <li><a href="product_manager.php">Manage Products</a></li>                
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-account-box"></i>Users</a>
                    <ul class="submenu">
                        <li><a href="manage_users.php">Manage Users</a></li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-comment-question-outline"></i>Support</a>
                    <ul class="submenu">
                        <li>
                            <a href="request_support.php">Request support</a>
                        </li> 
                        <li>
                            <a href="support_requests.php">Your support requests</a>
                        </li>      
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-account-multiple"></i>Groups</a>
                    <ul class="submenu">
                        <li><a href="group_invites.php">Group invites</a></li>
                        <li><a href="create_group.php">Create a group</a></li>
                        <li><a href="manage_group.php">Manage your group</a></li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-account-multiple"></i>Group license keys</a>
                    <ul class="submenu">
                        <li><a href="create_group_license_key.php">Create group license key</a></li>
                        <li><a href="admin_license_manager.php">Manage group license keys</a></li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="manage_users_admin.php"><i class="mdi mdi-account-multiple"></i>Dashboard users</a>
                </li>
            </ul>
            <!-- End navigation menu -->

            <div class="clearfix"></div>
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar--> ';
?>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/crypting.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/get_group_info.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/users/get_user_info.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/cookies.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/security/logs.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/products.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/users/authenticate_user.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/create_group.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/get_stats.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/keys/keys.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/groups/group_invites.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/loader_users/l_users.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/support/support_requests.php';

//Admin stuff

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/admin/license_key_manager.php';
?>
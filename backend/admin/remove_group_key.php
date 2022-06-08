<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

if (check_cookie())
{
    $uid = get_cookie_information()[2];

    if (is_admin($uid))
    {
        $statement = $pdo->prepare("DELETE FROM dashboard_group_license_keys WHERE id = ?;");
        $statement->execute(array($_GET["remove"]));
        write_log("Admin: " . get_username_by_uid(get_cookie_information()[2]) . "\nremoved group key: " . $_GET["remove"], true);
        echo '<script>window.location.href = "../../dashboard/admin_license_manager.php";</script>';
    }
}

echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';
?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

if (check_cookie())
{
    $uid = get_cookie_information()[2];
    if (is_admin($uid))
    {
        add_product($_GET["gid"], $_POST["product_name"]);#
        write_log("Admin " . get_username_by_uid($uid) . " added product " . $_POST["product_name"] . " to GID " . $_GET["gid"], true);
        echo '<script>window.location.href = "../../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
    }
}
?>
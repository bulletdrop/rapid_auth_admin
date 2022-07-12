<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (is_admin(get_cookie_information()[2]))
{
    $uid = get_cookie_information()[2];
    $gid = $_GET["gid"];
    $private_key = $_POST["private_key"];
    $public_key = $_POST["public_key"];
    $private_key_password = $_POST["private_key_password"];
    update_group_table($private_key, $public_key, $private_key_password, $gid);
    echo '<script>window.location.href = "../../dashboard/group_detail.php?gid=' . $gid . '";</script>';
}

function update_group_table($private_key, $public_key, $private_key_password, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE dashboard_groups SET private_key = ?, public_key = ?, private_key_password = ? WHERE gid=?;");
    $statement->execute(array($private_key, $public_key, $private_key_password, $gid));
}


?>
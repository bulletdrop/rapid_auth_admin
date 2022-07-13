<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (is_admin(get_cookie_information()[2]))
{
    $uid = get_cookie_information()[2];
    $gid = $_GET["gid"];
    $openssl_crypting_key = $_POST["openssl_crypting_key"];
    update_group_table($openssl_crypting_key, $gid);
    echo '<script>window.location.href = "../../dashboard/group_detail.php?gid=' . $gid . '";</script>';
}

function update_group_table($openssl_crypting_key, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE dashboard_groups SET openssl_crypting_key = ? WHERE gid=?;");
    $statement->execute(array($openssl_crypting_key, $gid));
}


?>
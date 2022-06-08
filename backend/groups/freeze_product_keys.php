<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    $product_id = $_GET["product_id"];
    $uid = get_cookie_information()[2];
    $gid = get_gid_by_uid($uid);
    write_log("User: " . get_username_by_uid($uid) . " freezed all keys for product ID " . $product_id);
    update_keys($product_id, $gid);
    echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';

}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';

function update_keys($product_id, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE loader_keys SET freezed = 1, product_freezed=1 WHERE product_id=? AND owner_gid=? AND days_left > 0 AND freezed=0;");
    $statement->execute(array($product_id, $gid));
}
?>
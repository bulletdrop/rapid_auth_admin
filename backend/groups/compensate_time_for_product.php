<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    $days_to_add = $_POST["days_to_add"];
    $product_id = $_GET["product_id"];
    $uid = get_cookie_information()[2];
    $gid = get_gid_by_uid($uid);

    update_keys($product_id, $days_to_add, $gid);
    echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';

}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';

function update_keys($product_id, $days_to_add, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE loader_keys SET days_left = days_left + ? WHERE product_id=? AND owner_gid=? AND `lifetime`=0 AND days_left > 0;");
    $statement->execute(array($days_to_add, $product_id, $gid));
}
?>
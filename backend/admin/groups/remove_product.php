<?php

include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';


if (check_cookie())
{
    $uid = get_cookie_information()[2];
    if (is_admin($uid))
    {
        $gid = $_GET["gid"];

        write_log("Admin: " . get_username_by_uid($uid) . " deleted product from GID " . $gid, true);
        update_product_array($_GET["index"], $gid);
        
        echo '<script>window.location.href = "../../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
        
    }
}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';


function update_product_array($product_index, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    
    $current_products = get_products_by_gid($gid);
    unset($current_products[$product_index]);
    $new_products_array = json_encode(array_values($current_products));

    $statement = $pdo->prepare("UPDATE dashboard_groups SET products_array = ? WHERE gid = ?;");
    $statement->execute(array($new_products_array, $gid));
}

?>
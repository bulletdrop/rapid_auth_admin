<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';


if (check_cookie())
{
    if ($_GET["confirmed"] == "yes")
    {
        $uid = get_cookie_information()[2];
        $gid = get_gid_by_uid($uid);
        if (get_group_owner_uid_by_gid($gid) == $uid)
        {
            write_log("User: " . get_username_by_uid($uid) . " deleted product", true);
            update_product_array($_GET["id"], $gid);
            echo '<script>window.location.href = "../../dashboard/product_manager.php";</script>';
        }
    }
}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';

echo '<script>window.location.href = "../../dashboard/product_manager.php";</script>';

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
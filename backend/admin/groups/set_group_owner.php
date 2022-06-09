<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    $c_uid = get_cookie_information()[2];
    if (is_admin($c_uid))
    {
        set_owner($_GET["uid"], $_GET["gid"]);
        write_log("Admin: "  . get_username_by_uid($c_uid) . "\nset " . get_username_by_uid($_GET["uid"]) . " as owner of group " . get_group_name_by_gid($_GET["gid"]), true);  
        echo '<script>window.location.href = "../../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
    }
    
}



function set_owner($uid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_groups SET owner_uid=? WHERE gid=?;");
    $statement->execute(array($uid, $gid));
}

?>
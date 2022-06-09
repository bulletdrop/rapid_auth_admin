<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

if (check_cookie())
{
    $c_uid = get_cookie_information()[2];
    if (is_admin($c_uid))
    {
        update_user_table_gid($_GET["uid"], $_GET["gid"]);
        kick_group_array($_GET["gid"], $_GET["uid"]);
        write_log("Admin: " . get_username_by_uid($c_uid) . "\nKicked " . get_username_by_uid($_GET["uid"]) . " from group: " . $_GET["gid"], true);
        echo '<script>window.location.href = "../../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
    }
}
echo '<script>window.location.href = "../../../dashboard/auth-login.php";</script>';

function update_user_table_gid($uid, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE dashboard_users SET gid = -1 WHERE uid=? AND gid=?;");
    $statement->execute(array($uid, $gid));
}

function kick_group_array($gid, $uid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $current_array = json_decode(get_member_array_by_gid($gid));
    
    $uid_index = 0;
    for ($i = 0; $i <= count($current_array); $i++)
    {
        if ($current_array[$i] == $uid)
        {
            $uid_index = $i;
            break;
        }            
    }

    unset($current_array[$uid_index]);

    $new_array = json_encode(array_values($current_array));
    
    $statement = $pdo->prepare("UPDATE dashboard_groups SET member_array = ? WHERE gid=?;");
    $statement->execute(array($new_array, intval($gid)));
}

?>
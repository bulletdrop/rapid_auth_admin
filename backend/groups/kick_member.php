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
            write_log("User: " . get_username_by_uid($uid) . " kicked " . get_username_by_uid($_GET["uid"]) . " from group", true);
            update_user_table_gid($_GET["id"], $gid);
            kick_group_array($gid, $_GET["id"]);
            echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';
        }
    }
}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';

echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';

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
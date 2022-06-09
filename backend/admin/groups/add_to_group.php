<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

if (check_cookie())
{
    $c_uid = get_cookie_information()[2];
    if (is_admin($c_uid))
    {
        $new_member = $_POST["new_member_username"];
        $new_member_uid = get_uid_by_username($new_member);

        if ($new_member_uid == "-1")
        {
            echo "User does not exist";
            write_log("Admin: " . get_username_by_uid($c_uid) . "\n tried to add non-existing user to group: " . $_GET["gid"]);
        }
        else
        {
            $gid = $_GET["gid"];

            write_log("Admin " . get_username_by_uid($c_uid) ."\nAdded " . get_username_by_uid($new_member_uid) . " to group " . get_group_name_by_gid($gid), true);
            if (uid_in_group($new_member_uid))
            {
                echo "got called fr";
                kick_old_group_array($gid, $new_member_uid);
            }
                            
            update_user_table_gid($new_member_uid, $gid);
            update_group_array_admin($gid, $new_member_uid);
            
            //echo '<script>window.location.href = "../../../dashboard/group_detail.php?gid=' . $_GET["gid"] . '";</script>';
        }
        
    }
}
//echo '<script>window.location.href = "../../../dashboard/auth-login.php";</script>';

function update_user_table_gid($uid, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE dashboard_users SET gid = ? WHERE uid=?;");
    $statement->execute(array($gid, $uid));
}

function kick_old_group_array($gid, $uid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $current_array = json_decode(get_member_array_by_gid($gid));
    
    $uid_index = 0;
    for ($i = 0; $i <= count($current_array)-1; $i++)
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

function update_group_array_admin($gid, $uid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $current_array = json_decode(get_member_array_by_gid($gid));
    
    array_push($current_array, intval($uid));
    $new_array = json_encode($current_array);
    
    $statement = $pdo->prepare("UPDATE dashboard_groups SET member_array = ? WHERE gid=?;");
    $statement->execute(array($new_array, intval($gid)));
}

?>
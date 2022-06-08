<?php

if (check_invite_valid())
{
    if ($_POST["answer"] == "Accept")
        accept_invite();
    elseif ($_POST["answer"] == "Decline")
        update_group_invite(false);
}

echo '<script>window.location.href = "../../dashboard/group_invites.php";</script>';


function accept_invite()
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';


    if (!check_cookie())
        echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';
        
    
    $uid = get_cookie_information()[2];

    $uid_in_group = uid_in_group($uid);

    if (!$uid_in_group)
        add_in_group($uid, get_gid_by_invite_id($_GET["id"]));
        echo '<script>window.location.href = "../../dashboard/group_invites.php";</script>';
    
    if ($uid_in_group)
    {
        remove_from_group(get_gid_by_uid($uid), $uid);
        update_group_array(get_gid_by_invite_id($_GET["id"]), $uid);
        update_in_user_table(get_gid_by_invite_id($_GET["id"]), $uid);
        update_group_invite(true);
        echo '<script>window.location.href = "../../dashboard/group_invites.php";</script>';
    }
    

    echo '<script>window.location.href = "../../dashboard/group_invites.php";</script>';   
}

function check_invite_valid()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT id FROM dashboard_group_invites WHERE id = ? AND accepted = 0 AND declined = 0");
    $statement->execute(array($_GET["id"])); 
    
    if ($statement->rowCount() == 0)
        return false;

    return true;
}

function remove_from_group($gid, $uid)
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

function update_group_array($gid, $uid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $current_array = json_decode(get_member_array_by_gid($gid));
    
    array_push($current_array, intval($uid));
    $new_array = json_encode($current_array);
    
    $statement = $pdo->prepare("UPDATE dashboard_groups SET member_array = ? WHERE gid=?;");
    $statement->execute(array($new_array, intval($gid)));
}

function update_in_user_table($gid, $uid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("UPDATE dashboard_users SET gid = ? WHERE uid= ? ;");
    $statement->execute(array($gid, $uid));
}

function get_gid_by_invite_id($id)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT gid FROM dashboard_group_invites WHERE id= ?");
    $statement->execute(array($id));   
    while($row = $statement->fetch()) {
        return $row["gid"];
    }
    
    return "-1";
}

function add_in_group($uid, $gid)
{
    update_group_array($gid, $uid);
    update_in_user_table($gid, $uid);
    update_group_invite(true);
}

function update_group_invite($accepted)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    if ($accepted)
    {
        $statement = $pdo->prepare("UPDATE dashboard_group_invites SET accepted = 1 WHERE id= ? ;");
        $statement->execute(array($_GET["id"]));
    }

    if (!$accepted)
    {
        $statement = $pdo->prepare("UPDATE dashboard_group_invites SET declined = 1 WHERE id= ? ;");
        $statement->execute(array($_GET["id"]));
    }
    
}
//echo $_POST["answer"] . "<br>" . $_GET["id"];
?>
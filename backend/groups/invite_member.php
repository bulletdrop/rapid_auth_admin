<?php

function check_if_invite_exist($uid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT id FROM dashboard_group_invites WHERE uid=? AND accepted=0 AND declined=0 AND gid=?");
    $statement->execute(array($uid, $gid)); 
    
    if ($statement->rowCount() == 0)
        return false;

    return true;
}

function check_if_allready_in_same_group($gid, $uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $member_array = json_decode(get_member_array_by_gid($gid));

    foreach ($member_array as $member)
    {
        if ($member == $uid)
            return true;
    }

    return false;
}

function insert_invite_in_db($uid, $gid)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    $statement = $pdo->prepare("INSERT INTO dashboard_group_invites (gid,`uid`) VALUES (?, ?);");
    $statement->execute(array($gid, $uid));
}

?>
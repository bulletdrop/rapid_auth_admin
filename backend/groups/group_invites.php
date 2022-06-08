<?php

function get_group_invites_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT id, gid, accepted, declined FROM dashboard_group_invites WHERE uid= ? AND accepted=0 AND declined=0");
    $statement->execute(array($uid));  
    $invites = array();
    while($row = $statement->fetch()) {
        array_push($invites, array($row["id"], $row["gid"], $row["accepted"], $row["declined"], get_group_name_by_gid($row["gid"])));
    }
    
    return $invites;
}

?>
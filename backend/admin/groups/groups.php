<?php

function get_all_groups()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $groups = array();

    $statement = $pdo->prepare("SELECT * FROM dashboard_groups");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        array_push($groups, $row);
    }

    return $groups;
}

function get_group_details_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    $statement = $pdo->prepare("SELECT * FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));   
    while($row = $statement->fetch()) {
        return $row;
    }
}


?>
<?php

function get_group_name_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT group_name FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return decrypt_data($row["group_name"], $key);
    }
    
    return "-1";
}


function get_public_key_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT public_key FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["public_key"];
    }
    
    return "-1";
}

function get_private_key_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT private_key FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["private_key"];
    }
    
    return "-1";
}

function get_private_key_password_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT private_key_password FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["private_key_password"];
    }
    
    return "-1";
}

function get_group_gid_by_group_name($group_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT gid FROM dashboard_groups WHERE group_name=?");
    $statement->execute(array(encrypt_data($group_name, $key)));  
    
    while($row = $statement->fetch()) {
        return $row["gid"];
    }
    
    return "-1";
}

function get_group_owner_uid_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT owner_uid FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["owner_uid"];
    }
    
    return "-1";
}

function get_group_owner_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT owner_uid FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["owner_uid"];
    }
    
    return "-1";
}

function get_member_array_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT member_array FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["member_array"];
    }
    
    return "-1";
}

function get_api_key_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT api_key FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row["api_key"];
    }
    
    return "-1";
}


?>
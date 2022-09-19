<?php

function get_rank_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT rid FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return $row['rid'];
    }
    
    return "-1";
}

function get_max_keys_by_rid($rid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT max_keys FROM ranks WHERE rid=?");
    $statement->execute(array($rid));  
    
    while($row = $statement->fetch()) {
        return $row['max_keys'];
    }
    
    return "0";
}

function get_max_rank_rid()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT rid FROM ranks ORDER BY rid DESC LIMIT 1");
    $statement->execute();  
    
    while($row = $statement->fetch()) {
        return $row['rid'];
    }
    
    return "0";
}

function get_rank_name_by_rid($rid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT rank_name FROM ranks WHERE rid=?");
    $statement->execute(array($rid));  
    
    while($row = $statement->fetch()) {
        return $row['rank_name'];
    }
    
    return "0";
}

function get_rid_by_license_key($license_key)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT rid FROM dashboard_group_license_keys WHERE `key_name`=? AND used=0");
    $statement->execute(array(encrypt_data($license_key, $key)));  
    
    while($row = $statement->fetch()) {
        return $row['rid'];
    }
    
    return "0";
}

function get_max_members_by_rid($rid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT max_members FROM ranks WHERE rid=?");
    $statement->execute(array($rid));  
    
    while($row = $statement->fetch()) {
        return $row['max_members'];
    }
    
    return "0";
}

function get_max_keys_by_gid($gid)
{
    return get_max_keys_by_rid(get_rank_by_gid($gid));
}

function get_max_members_by_gid($gid)
{
    return get_max_members_by_rid(get_rank_by_gid($gid));
}

function get_all_ranks()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $all_ranks = array();

    $statement = $pdo->prepare("SELECT * FROM ranks");
    $statement->execute(array());   
    while($row = $statement->fetch()) {
        array_push($all_ranks, $row);
    }

    return $all_ranks;
}

?>
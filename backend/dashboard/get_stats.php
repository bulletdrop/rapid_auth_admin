<?php
function get_js()
{
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/dashboard/dashboard_js.txt');
    $content = str_replace("!KEY_CHART_ARRAY!", json_encode(array_reverse(get_total_keys())), $content);
    $content = str_replace("!USER_CHART_ARRAY!", json_encode(array_reverse(get_total_users())), $content);
    return $content;
}

function get_total_users()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    
    $statement = $pdo->prepare("SELECT total_users FROM `statistics` ORDER BY id DESC LIMIT 12 ");
    $statement->execute(array());   
    $last_10_stats = array();
    
    while($row = $statement->fetch()) {
        array_push($last_10_stats, intval($row["total_users"]));
    }
    
    return $last_10_stats;
}

function get_total_users_last_record()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    
    $statement = $pdo->prepare("SELECT total_users FROM `statistics` ORDER BY id DESC LIMIT 1");
    $statement->execute(array());   
    $total_users = 0;
    
    while($row = $statement->fetch()) {
        $total_users = $row["total_users"];
    }
    
    return $total_users;
}

function get_total_keys_last_record()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    
    $statement = $pdo->prepare("SELECT total_keys FROM `statistics` ORDER BY id DESC LIMIT 1");
    $statement->execute(array());   
    $total_keys = 0;
    
    while($row = $statement->fetch()) {
        $total_keys = $row["total_keys"];
    }
    
    return $total_keys;
}

function get_total_keys()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    
    $statement = $pdo->prepare("SELECT total_keys FROM `statistics` ORDER BY id DESC LIMIT 12 ");
    $statement->execute(array());   
    $last_10_stats = array();
    
    while($row = $statement->fetch()) {
        array_push($last_10_stats, intval($row["total_keys"]));
    }
    
    return $last_10_stats;
}


?>
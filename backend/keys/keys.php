<?php

function get_keys_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT kid, key_name, loader_user_uid, product_id, days_left, freezed, `lifetime` FROM loader_keys WHERE owner_gid=?");
    $statement->execute(array($gid));  
    $keys = array();
    while($row = $statement->fetch()) {
        array_push($keys, array($row["kid"], decrypt_data($row["key_name"], $key), $row["loader_user_uid"], $row["product_id"], $row["days_left"], $row["freezed"], $row["lifetime"]));
    }
    
    return $keys;
}

function update_key($gid, $kid, $loader_user_id, $days_left, $freezed, $lifetime, $key_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE loader_keys SET loader_user_uid = ?, days_left = ?, freezed = ?, `lifetime` = ?, key_name = ?  WHERE owner_gid = ? AND kid = ?;");
    $statement->execute(array($loader_user_id, $days_left, $freezed, $lifetime, encrypt_data($key_name, $key), $gid, $kid));
}

function insert_key_in_db($gid, $key_name, $product_id, $lifetime, $freezed, $days_left)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("INSERT INTO loader_keys (owner_gid, product_id, days_left, freezed, `lifetime`, key_name) VALUES (?, ?, ?, ?, ?, ?);");
    $statement->execute(array($gid, $product_id, $days_left, $freezed, $lifetime, encrypt_data($key_name, $key)));
}

function get_days_left_by_kid_and_gid($kid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT days_left FROM loader_keys WHERE owner_gid=? AND kid=?");
    $statement->execute(array($gid, $kid));  
    
    while($row = $statement->fetch()) {
        return $row["days_left"];
    }
    
    return "0";
}

function get_key_name_by_kid_and_gid($kid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


    $statement = $pdo->prepare("SELECT key_name FROM loader_keys WHERE owner_gid=? AND kid=?");
    $statement->execute(array($gid, $kid));  
    
    while($row = $statement->fetch()) {
        return decrypt_data($row["key_name"], $key);
    }
    
    return "0";
}

function get_product_name_by_kid_and_gid($kid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


    $statement = $pdo->prepare("SELECT product_id FROM loader_keys WHERE owner_gid=? AND kid=?");
    $statement->execute(array($gid, $kid));  
    
    while($row = $statement->fetch()) {
        return get_product_name_by_index($gid, $row["product_id"]);
    }
    
    return "0";
}

?>
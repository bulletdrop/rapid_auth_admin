<?php

function check_license_key_valid($license_key)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT id FROM dashboard_group_license_keys WHERE key_name = ? AND used = 0");
    $statement->execute(array(encrypt_data($license_key, $key))); 
    
    if ($statement->rowCount() == 0)
        return false;

    return true;
}

function check_group_name_in_use($group_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT gid FROM dashboard_groups WHERE group_name = ?");
    $statement->execute(array(encrypt_data($group_name, $key))); 
    
    if ($statement->rowCount() == 0)
        return false;

    return true;
}

function set_key_used($license_key)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_group_license_keys SET used = 1 WHERE key_name= ?;");
    $statement->execute(array(encrypt_data($license_key, $key)));
}

function insert_group_in_db($group_name, $owner_uid, $first_product)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("INSERT INTO dashboard_groups (member_array, group_name, owner_uid, active_license, products_array, api_key) VALUES (?,?,?,1,?,?);");
    $statement->execute(array("[$owner_uid]",encrypt_data($group_name, $key), $owner_uid, "[\"$first_product\"]", generateRandomString(64)));
}

function update_user_table($uid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_users SET gid = ? WHERE uid = ?;");
    $statement->execute(array($gid, $uid));
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
<?php

function get_license_keys()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $license_keys = array();

    $statement = $pdo->prepare("SELECT id, key_name, used FROM dashboard_group_license_keys");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        array_push($license_keys, array("id" => $row["id"], "key_name" => decrypt_data($row["key_name"], $key), "used" => $row["used"]));
    }

    return $license_keys;
}

function insert_group_license_key_in_db($license_key)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("INSERT INTO dashboard_group_license_keys (key_name) VALUES (?)");
    $statement->execute(array(encrypt_data($license_key, $key)));   
}

?>
<?php

function valid_input($username, $password)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT uid FROM dashboard_users WHERE username = ? AND password = ? AND `admin` = 1");
    $statement->execute(array(encrypt_data($username, $key), encrypt_data($password, $key)));   
    if ($statement->fetchColumn() == 0)
        return false;
    
    return true;
}

function update_last_ip($username)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_users SET last_ip = ? WHERE username= ?;");
    $statement->execute(array($_SERVER["HTTP_CF_CONNECTING_IP"], encrypt_data($username, $key)));
}

?>
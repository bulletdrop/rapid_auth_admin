<?php

function get_username_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT username FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        return decrypt_data($row["username"], $key);
    }
    
    return "0";
}

function is_admin($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT `admin` FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        if ($row["admin"] == 1)
            return true;
    }
    
    return false;
}

function get_gid_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT gid FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        return $row["gid"];
    }
    
    return "0";
}

function uid_in_group($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT gid FROM dashboard_users WHERE uid=?");
    $statement->execute(array($uid)); 
    
    while($row = $statement->fetch()) {
        if ($row["gid"] == "-1")
            return false;

    }
    
    return true;
}

function uid_matches_username($username, $uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT email FROM dashboard_users WHERE username= ? AND uid= ?");
    $statement->execute(array(encrypt_data($username, $key), $uid)); 
    
    if ($statement->rowCount() == 0)
        return false;

    return true;
}

function username_matches_password($username, $password)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT uid FROM dashboard_users WHERE username= ? and password= ?");
    $statement->execute(array(encrypt_data($username, $key), encrypt_data($password, $key)));   
    if ($statement->rowCount() == 0)
        return false;
    
    return true;
}

function get_uid_by_username($username)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT uid FROM dashboard_users WHERE username= ?");
    $statement->execute(array(encrypt_data($username, $key)));   
    while($row = $statement->fetch()) {
        return $row["uid"];
    }
    
    return "-1";
}

function get_rank_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT rank FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        return $row["rank"];
    }
    
    return "-1";
}

function get_profile_picture_url_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT profile_picture_url FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        return $row["profile_picture_url"];
    }
    
    return "-1";
}

function get_email_by_username($username)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT email FROM dashboard_users WHERE username= ?");
    $statement->execute(array(encrypt_data($username, $key)));   
    while($row = $statement->fetch()) {
        return decrypt_data($row["email"], $key);
    }
    
    return "-1";
}

function get_username_by_email($email)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT username FROM dashboard_users WHERE email= ?");
    $statement->execute(array(encrypt_data($email, $key)));   
    while($row = $statement->fetch()) {
        return decrypt_data($row["username"], $key);
    }
    
    return "-1";
}

function get_last_ip_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT last_ip FROM dashboard_users WHERE uid= ?");
    $statement->execute(array($uid));   
    while($row = $statement->fetch()) {
        return $row["last_ip"];
    }
    
    return "-1";
}


?>
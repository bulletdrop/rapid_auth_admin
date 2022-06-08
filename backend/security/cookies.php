<?php

function add_cookie($username, $password, $uid)
{
    //Pass only decrypted data 
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $cookie_value = encrypt_data($username . "*#*" . $password . "*#*" . $uid . "*#*" . $_SERVER['REMOTE_ADDR'] . "*#*" . $salt, $key);
    //setcookie("user_cookie", $cookie_value, time()+86400, "/rapid_auth");
    echo '<script>document.cookie = "user_cookie=' . $cookie_value . '; path=/rapid_auth_admin";</script>';
}

function check_cookie()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $cookie_data = explode("*#*", decrypt_data($_COOKIE["user_cookie"], $key));

    if ($cookie_data[4] != $salt)
        return false;
    
    if (!uid_matches_username($cookie_data[0], $cookie_data[2]))
        return false;
    
        
    if ($cookie_data[3] != $_SERVER['REMOTE_ADDR'])
        return false;
    
    if (get_last_ip_by_uid($cookie_data[2]) != $_SERVER['REMOTE_ADDR'])
        return false;
    
    if (!username_matches_password($cookie_data[0], $cookie_data[1]))
        return false;

    if (!is_admin($cookie_data[2]))
        return false;


    return true;
}

function get_cookie_information()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


    $cookie_data = explode("*#*", decrypt_data($_COOKIE["user_cookie"], $key));

    if ($cookie_data[4] != $salt)
        return 0;
    
    return $cookie_data;
}
?>
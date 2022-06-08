<?php
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

if (check_cookie())
{
    $uid = get_cookie_information()[2];

    if (is_admin($uid))
    {
        $banned = 0;
        if ($_POST["banned"] == "on")
            $banned = 1;

        $user_info = array("uid" => $_GET["uid"],
        "username" => encrypt_data($_POST["username"], $key), 
        "password" => encrypt_data($_POST["password"], $key), 
        "email" => encrypt_data($_POST["email"], $key), 
        "rank" => $_POST["rank"], 
        "profile_picture_url" => $_POST["profile_picture_url"], 
        "note" => $_POST["note"], 
        "banned" => $banned, 
        "ban_message" => $_POST["ban_message"]);



        $statement = $pdo->prepare("UPDATE dashboard_users SET username = ?,
        `password` = ?,
        email = ?,
        `rank` = ?,
        profile_picture_url = ?,
        note = ?,
        banned = ?,
        ban_message = ? WHERE `uid` = ? AND `admin` = 0;");
        
        $statement->execute(array($user_info["username"], 
        $user_info["password"], 
        $user_info["email"], 
        $user_info["rank"], 
        $user_info["profile_picture_url"], 
        $user_info["note"], 
        $user_info["banned"], 
        $user_info["ban_message"], 
        $user_info["uid"]));
        
        write_log("Admin: " . get_username_by_uid(get_cookie_information()[2]) . "\nedited user: " . get_username_by_uid($_GET["uid"]), true);
        echo '<script>window.location.href = "../../dashboard/manage_users_admin.php";</script>';
    }
}

echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';
?>
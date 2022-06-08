<?php

function get_loader_users_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT 
    uuid,
    username,
    `password`,
    active,
    key_array,
    windows_username,
    gpu_name,
    gpu_ram,
    drive_count,
    cpu_name,
    cpu_cores,
    os_caption,
    os_serial_number,
    last_ip,
    active_hwid,
    windows_username_attempt,
    gpu_name_attempt,
    gpu_ram_attempt,
    drive_count_attempt,
    cpu_name_attempt,
    cpu_cores_attempt,
    os_caption_attempt,
    os_serial_number_attempt,
    last_ip_attempt,
    note FROM loader_users WHERE group_gid=?");

    $statement->execute(array($gid));  
    $users = array();
    while($row = $statement->fetch()) {
        array_push($users, array(
            $row["uuid"],
            decrypt_data($row["username"], $key),
            decrypt_data($row["password"], $key),
            $row["active"],
            $row["key_array"],
            decrypt_data($row["windows_username"], $key),
            decrypt_data($row["gpu_name"], $key),
            $row["gpu_ram"],
            $row["drive_count"],
            decrypt_data($row["cpu_name"], $key),
            $row["cpu_cores"],
            decrypt_data($row["os_caption"], $key),
            decrypt_data($row["os_serial_number"], $key),
            $row["last_ip"],
            $row["active_hwid"],
            decrypt_data($row["windows_username_attempt"], $key),
            decrypt_data($row["gpu_name_attempt"], $key),
            $row["gpu_ram_attempt"],
            $row["drive_count_attempt"],
            decrypt_data($row["cpu_name_attempt"], $key),
            $row["cpu_cores_attempt"],
            decrypt_data($row["os_caption_attempt"], $key),
            decrypt_data($row["os_serial_number_attempt"], $key),
            $row["last_ip_attempt"],
            $row["note"]
        ));
    }  
    return $users;
}

function hwid_failed($uuid, $gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT failed_hwid_attempt FROM loader_users WHERE uuid=? AND group_gid=?");
    $statement->execute(array($uuid, $gid));  
    
    while($row = $statement->fetch()) {
        if ($row["failed_hwid_attempt"] == "1")
            return true;
    }
    
    return false;
}

function update_user_by_uuid_and_gid($uuid, $gid, $username, $password, $note, $active)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE loader_users SET username = ?, `password` = ?, active = ?, note = ?  WHERE group_gid = ? AND uuid = ?;");
    $statement->execute(array($username, $password, $active, $note, $gid, $uuid));
}

function set_attempt_hwid_as_new_hwid_by_gid_and_uuid($gid, $uuid)
{
    echo "called 2";
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE loader_users SET 
    windows_username = ?,
    gpu_name = ?,
    gpu_ram = ?,
    drive_count = ?,
    cpu_name = ?,
    cpu_cores = ?,
    os_caption = ?,
    os_serial_number = ?,
    last_ip = ?,
    failed_hwid_attempt = '0'
    WHERE group_gid=? AND uuid=?;");
    $statement->execute(get_hwid_attempt_by_gid_and_uuid($gid, $uuid));

    //var_dump(get_hwid_attempt_by_gid_and_uuid($gid, $uuid));
}

function get_hwid_attempt_by_gid_and_uuid($gid, $uuid)
{
    
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT 
    windows_username_attempt,
    gpu_name_attempt,
    gpu_ram_attempt,
    drive_count_attempt,
    cpu_name_attempt,
    cpu_cores_attempt,
    os_caption_attempt,
    os_serial_number_attempt,
    last_ip_attempt
    FROM loader_users WHERE group_gid=? AND uuid =?");

    $statement->execute(array($gid, $uuid));  
    $return_val = array();
    while($row = $statement->fetch()) {
        $return_val = array(
            $row["windows_username_attempt"],
            $row["gpu_name_attempt"],
            $row["gpu_ram_attempt"],
            $row["drive_count_attempt"],
            $row["cpu_name_attempt"],
            $row["cpu_cores_attempt"],
            $row["os_caption_attempt"],
            $row["os_serial_number_attempt"],
            $row["last_ip_attempt"],
            $gid,
            $uuid
        );
    }  

    return $return_val;
}

?>
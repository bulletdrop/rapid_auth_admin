<?php

function insert_new_stats()
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $statement = $pdo->prepare("INSERT INTO `statistics` (total_users, total_groups, total_keys, `date`) VALUES (?, ?, ?, CURRENT_DATE());");
    $statement->execute(array(get_total_users_dump(), get_total_groups_dump(), get_total_keys_dump()));   
}

function get_total_users_dump()
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $statement = $pdo->prepare("SELECT COUNT(uuid) AS user_count FROM loader_users");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        return $row["user_count"];
    }

    return "-1";
}

function get_total_keys_dump()
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $statement = $pdo->prepare("SELECT COUNT(kid) AS key_count FROM loader_keys");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        return $row["key_count"];
    }

    return "-1";
}

function get_total_groups_dump()
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $statement = $pdo->prepare("SELECT COUNT(gid) AS group_count FROM dashboard_groups");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        return $row["group_count"];
    }

    return "-1";
}
?>
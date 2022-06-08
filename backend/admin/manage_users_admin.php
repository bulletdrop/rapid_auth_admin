<?php

function get_all_users()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $all_users = array();

    $statement = $pdo->prepare("SELECT * FROM dashboard_users");
    $statement->execute(array(0));   
    while($row = $statement->fetch()) {
        array_push($all_users, $row);
    }

    return $all_users;
}

?>
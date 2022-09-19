<?php

function get_all_logs()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $all_logs = array();

    $statement = $pdo->prepare("SELECT * FROM logs");
    $statement->execute(array());   
    while($row = $statement->fetch()) {
        array_push($all_logs, $row);
    }

    return $all_logs;
}

?>
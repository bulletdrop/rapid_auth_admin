<?php

function fetch_all_tickets()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT title, `status`, tid FROM `dashboard_support_ticket`");
    $statement->execute(array());  
    
    $tickets = array();

    while($row = $statement->fetch()) 
    {
        array_push($tickets, array($row["tid"], $row["title"], $row["status"]));
    }

    return $tickets;
}

function fetch_ticket_detail_by_tid($tid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT message_history, title FROM `dashboard_support_ticket` WHERE tid=?");
    $statement->execute(array($tid));  
    
    $information = array();

    while($row = $statement->fetch()) 
    {
        $information = array($row["message_history"], $row["title"]);
    }

    return $information;
}

?>
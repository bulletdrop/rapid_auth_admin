<?php

function fetch_tickets_by_uid($uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT title, `status`, tid FROM `dashboard_support_ticket` WHERE owner_uid = ?");
    $statement->execute(array($uid));  
    
    $tickets = array();

    while($row = $statement->fetch()) 
    {
        array_push($tickets, array($row["title"], $row["status"], $row["tid"]));
    }

    return $tickets;
}

function fetch_ticket_detail_by_tid_and_uid($tid, $uid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT message_history, title FROM `dashboard_support_ticket` WHERE owner_uid = ? AND tid=?");
    $statement->execute(array($uid, $tid));  
    
    $information = array();

    while($row = $statement->fetch()) 
    {
        $information = array($row["message_history"], $row["title"]);
    }

    return $information;
}

?>
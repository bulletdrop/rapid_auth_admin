<?php

function get_message_of_the_day()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    
    
    $statement = $pdo->prepare("SELECT message_of_the_day FROM `dashboard_settings` WHERE id=1 ");
    $statement->execute(array(0));   
    
    while($row = $statement->fetch()) {
        return $row["message_of_the_day"];    
    }
}

?>
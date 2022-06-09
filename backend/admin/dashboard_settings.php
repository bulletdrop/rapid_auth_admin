<?php

function update_message_of_the_day($new_message)
{
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';

    $statement = $pdo->prepare("UPDATE dashboard_settings SET message_of_the_day = ? WHERE id = 1;");
    $statement->execute(array($new_message));  
}

?>
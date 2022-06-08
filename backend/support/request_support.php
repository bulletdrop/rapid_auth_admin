<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    if (strlen($_POST["support_message"]) > 1)
    {
        insert_request_in_db(); 
        echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';
    }
    else
        echo '<script>window.location.href = "../../dashboard/dashboard.php";</script>';
}
else
    echo '<script>window.location.href = "../../dashboard/auth-login.php";</script>';


function insert_request_in_db()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $support_message = $_POST["support_message"];
    $support_title = $_POST["support_title"];
    $support_department = $_POST["support_department"];
    $current_date = date("d.m.Y h:i");
    $cookie_uid = get_cookie_information()[2];
    
    $json_array = json_encode(array(array("from" => get_username_by_uid($cookie_uid), "date" => $current_date, "message" => $support_message)));

    $statement = $pdo->prepare("INSERT INTO dashboard_support_ticket (title, message_history, owner_uid, department) VALUES (?, ?, ?, ?);");
    $statement->execute(array($support_title, $json_array, $cookie_uid, $support_department));

    write_log("User: " . get_username_by_uid($cookie_uid) . " created support ticket with title: " . $support_title . " and message: " . $support_message, true);

}
?>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    $new_message = $_POST["new_message"];

    $current_date = date("d.m.Y h:i");
    $uid = get_cookie_information()[2];
    if (is_admin($uid))
    {
        if (strlen($new_message) > 1)
        {
            $new_ticket_json = create_new_array($new_message);
            update_current_ticket($_GET["tid"], $new_ticket_json);
    
            write_log("Admin: " . get_username_by_uid($uid) . " updated support ticket with id: " . $_GET["tid"] . " and message: " . $new_message, true);
        }
    }
    
}

echo '<script>window.location.href = "../../dashboard/admin_tickets.php";</script>';

function update_current_ticket($tid, $new_message_array)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_support_ticket SET message_history = ?, `status` = 1  WHERE tid = ?;");
    $statement->execute(array($new_message_array, $tid));
}

function create_new_array($new_message)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $current_support = fetch_ticket_detail_by_tid($_GET["tid"])[0];

    $current_support_array = json_decode($current_support);
    
    $new_json = array("from" => "Support", "date" => date("d.m.Y h:i"), "message" => $new_message);
    
    array_push($current_support_array, $new_json);

    $new_support_message_array = json_encode($current_support_array);

    return $new_support_message_array;
}

?>
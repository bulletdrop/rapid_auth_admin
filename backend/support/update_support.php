<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';


if (check_cookie())
{
    $new_message = $_POST["new_message"];

    $current_date = date("d.m.Y h:i");
    $uid = get_cookie_information()[2];

    if (strlen($new_message) > 1)
    {
        $new_ticket_json = create_new_array($new_message, $uid);
        update_current_ticket($_GET["tid"], $uid, $new_ticket_json);

        write_log("User: " . get_username_by_uid($uid) . " updated support ticket with id: " . $_GET["tid"] . " and message: " . $new_message, true);
    }
}

echo '<script>window.location.href = "../../dashboard/support_requests.php";</script>';

function update_current_ticket($tid, $uid, $new_message_array)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("UPDATE dashboard_support_ticket SET message_history = ?, `status` = 0  WHERE owner_uid = ? AND tid = ?;");
    $statement->execute(array($new_message_array, $uid, $tid));
}

function create_new_array($new_message, $uid)
{
    $current_support = fetch_ticket_detail_by_tid_and_uid($_GET["tid"], $uid)[0];

    $current_support_array = json_decode($current_support);
    
    $new_json = array("from" => get_username_by_uid($uid), "date" => date("d.m.Y h:i"), "message" => $new_message);
    
    array_push($current_support_array, $new_json);

    $new_support_message_array = json_encode($current_support_array);

    return $new_support_message_array;
}

?>
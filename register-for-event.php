<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];


if (!$event_id) {
    header("Location: events.php");
    exit();
}


if ($user_id) {

    $existing_registration = $ObjDB->fetch(
        "SELECT id FROM event_registrations WHERE user_id = ? AND event_id = ?",
        [$user_id, $event_id]
    );

    if (!$existing_registration) {

        $ObjDB->insert('event_registrations', [
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);
        $_SESSION['msg'] = "You have successfully registered for the event!";
        $_SESSION['msg_type'] = 'success';
    } else {

        $_SESSION['msg'] = "You are already registered for this event.";
        $_SESSION['msg_type'] = 'info';
    }
}


header("Location: event-details.php?id=" . $event_id);
exit();
?>
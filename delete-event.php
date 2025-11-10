<?php
require "ClassAutoLoad.php";

// Admin & security checks
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$event_id = $_GET['id'] ?? null;


if ($event_id) {

    $event = $ObjDB->fetch("SELECT id FROM events WHERE id = ? AND user_id = ?", [$event_id, $_SESSION['user_id']]);


    if ($event) {
        $ObjDB->query("DELETE FROM events WHERE id = ?", [$event_id]);
        $_SESSION['msg'] = 'Event successfully deleted.';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['msg'] = 'You do not have permission to delete this event.';
        $_SESSION['msg_type'] = 'danger';
    }
}


header("Location: dashboard.php");
exit();

?>
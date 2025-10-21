<?php
require "ClassAutoLoad.php";

// Admin & security checks
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$event_id = $_GET['id'] ?? null;

// If we have an event ID, proceed with deletion
if ($event_id) {
    // We check that the event belongs to the logged-in user for security
    $event = $ObjDB->fetch("SELECT id FROM events WHERE id = ? AND user_id = ?", [$event_id, $_SESSION['user_id']]);

    // If the event exists and belongs to the user, delete it
    if ($event) {
        $ObjDB->query("DELETE FROM events WHERE id = ?", [$event_id]);
        $_SESSION['msg'] = 'Event successfully deleted.';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['msg'] = 'You do not have permission to delete this event.';
        $_SESSION['msg_type'] = 'danger';
    }
}

// Redirect back to the dashboard
header("Location: dashboard.php");
exit();

?>
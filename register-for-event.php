<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

// If we don't have a valid event ID, we can't do anything. Redirect away.
if (!$event_id) {
    header("Location: events.php");
    exit();
}

// If we have an event ID and a user ID, proceed
if ($user_id) {
    // Check if the user is already registered to prevent duplicates
    $existing_registration = $ObjDB->fetch(
        "SELECT id FROM event_registrations WHERE user_id = ? AND event_id = ?",
        [$user_id, $event_id]
    );

    if (!$existing_registration) {
        // If not registered, insert the new registration
        $ObjDB->insert('event_registrations', [
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);
        $_SESSION['msg'] = "You have successfully registered for the event!";
        $_SESSION['msg_type'] = 'success';
    } else {
        // If already registered, inform the user
        $_SESSION['msg'] = "You are already registered for this event.";
        $_SESSION['msg_type'] = 'info';
    }
}

// Redirect back to the event details page
header("Location: event-details.php?id=" . $event_id);
exit();
?>
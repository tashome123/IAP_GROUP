<?php
require "ClassAutoLoad.php";

// 1. Get the event ID from the URL first.
$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header("Location: events.php");
    exit();
}

// 2. Fetch the event from the database.
$event = $ObjDB->fetch("SELECT * FROM events WHERE id = ?", [$event_id]);

// If no event is found with that ID, redirect.
if (!$event) {
    header("Location: events.php");
    exit();
}

// 3. NOW, check if the current user is registered for this event.
$is_registered = false;
if (isset($_SESSION['user_id'])) {
    $registration = $ObjDB->fetch(
        "SELECT id FROM event_registrations WHERE user_id = ? AND event_id = ?",
        [$_SESSION['user_id'], $event_id]
    );
    if ($registration) {
        $is_registered = true;
    }
}

// 4. Display the page with all the correct information.
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->event_details_view($conf, $event, $is_registered);
$ObjLayout->footer($conf);
?>
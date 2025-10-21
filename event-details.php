<?php
require "ClassAutoLoad.php";

// Get the event ID from the URL. If it's not there, redirect to the events page.
$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header("Location: events.php");
    exit();
}

// Fetch the specific event from the database
$event = $ObjDB->fetch("SELECT * FROM events WHERE id = ?", [$event_id]);

// If no event is found with that ID, redirect.
if (!$event) {
    header("Location: events.php");
    exit();
}

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->event_details_view($conf, $event); // We will create this function next
$ObjLayout->footer($conf);
?>
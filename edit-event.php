<?php
require "ClassAutoLoad.php";

// Admin & security checks
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header("Location: dashboard.php");
    exit();
}

// Fetch the event to pre-fill the form
$event = $ObjDB->fetch("SELECT * FROM events WHERE id = ?", [$event_id]);
if (!$event) {
    // Event doesn't exist or doesn't belong to this user
    header("Location: dashboard.php");
    exit();
}

// Handle form submission for the update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['event_title'];
    $description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $location = $_POST['event_location'];

    // Update the database record
    $ObjDB->query(
        "UPDATE events SET title = ?, description = ?, event_date = ?, event_time = ?, location = ? WHERE id = ?",
        [$title, $description, $event_date, $event_time, $location, $event_id]
    );

    $_SESSION['msg'] = 'Event updated successfully!';
    $_SESSION['msg_type'] = 'success';
    header("Location: dashboard.php");
    exit();
}

// Display the page
$ObjLayout->create_event_layout_header($conf); // Use the special header for MDB components
$ObjLayout->navbar($conf);
$ObjLayout->edit_event_form($conf, $event); // We'll create this new function next
$ObjLayout->create_event_layout_footer($conf); // Use the special footer
?>
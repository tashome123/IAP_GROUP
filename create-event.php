<?php
require "ClassAutoLoad.php";

// Redirect user to signin page if they are not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_title = $_POST['event_title'];
    $event_desc = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];
    $user_id = $_SESSION['user_id'];

    // Insert into database
    $ObjDB->insert('events', [
        'user_id' => $user_id,
        'title' => $event_title,
        'description' => $event_desc,
        'event_date' => $event_date,
        'event_time' => $event_time,
        'location' => $event_location
    ]);

    // Redirect to a new dashboard page (we'll create this next)
    header("Location: dashboard.php");
    exit();
}

// Display the page layout
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
// We'll create the create_event_form() function in the next step
$ObjLayout->create_event_form($conf);
$ObjLayout->footer($conf);
?>
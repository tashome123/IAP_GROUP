<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// ADD THIS: Redirect admins away from this page
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header("Location: dashboard.php"); // Send admins to their dashboard instead
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch upcoming events the user has registered for
// The JOIN connects registrations to events, filtered by user and future dates
$registered_events = $ObjDB->fetchAll(
    "SELECT e.* FROM event_registrations er 
     JOIN events e ON er.event_id = e.id 
     WHERE er.user_id = ? AND e.event_date >= CURDATE() 
     ORDER BY e.event_date ASC, e.event_time ASC",
    [$user_id]
);

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->my_tickets_view($conf, $registered_events); // Call the new view function
$ObjLayout->footer($conf);
?>
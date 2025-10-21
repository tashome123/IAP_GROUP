<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'] ?? 'user';

$ObjLayout->header($conf);
$ObjLayout->navbar($conf);

// Check the user's role and display the appropriate dashboard
if ($user_role === 'admin') {
    // For admins, fetch events they have created
    $my_events = $ObjDB->fetchAll("SELECT * FROM events WHERE user_id = ? ORDER BY event_date DESC", [$user_id]);
    $ObjLayout->dashboard_view($conf, $my_events); // The existing admin dashboard view
} else {
    // For regular users, fetch events they have registered for
    $registered_events = $ObjDB->fetchAll(
        "SELECT e.* FROM event_registrations er JOIN events e ON er.event_id = e.id WHERE er.user_id = ? ORDER BY e.event_date ASC",
        [$user_id]
    );
    $ObjLayout->user_dashboard_view($conf, $registered_events); // A new view for users
}

$ObjLayout->footer($conf);
?>
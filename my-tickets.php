<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}


if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header("Location: dashboard.php"); // Send admins to their dashboard instead
    exit();
}

$user_id = $_SESSION['user_id'];


$registered_events = $ObjDB->fetchAll(
    "SELECT e.*, er.id as registration_id, er.checked_in_at FROM event_registrations er 
     JOIN events e ON er.event_id = e.id 
     WHERE er.user_id = ? AND e.event_date >= CURDATE() 
     ORDER BY e.event_date ASC, e.event_time ASC",
    [$user_id]
);


$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->my_tickets_view($conf, $registered_events); // Call the new view function
$ObjLayout->footer($conf);
?>
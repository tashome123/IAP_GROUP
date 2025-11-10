<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header("Location: dashboard.php");
    exit();
}


$event = $ObjDB->fetch("SELECT title FROM events WHERE id = ?", [$event_id]);
if (!$event) {
    header("Location: dashboard.php");
    exit();
}


$attendees = $ObjDB->fetchAll(
    "SELECT u.fullname, u.email FROM event_registrations er JOIN users u ON er.user_id = u.id WHERE er.event_id = ?",
    [$event_id]
);


$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->admin_event_attendees_view($conf, $event, $attendees); // We'll create this function next
$ObjLayout->footer($conf);

?>
<?php
require "ClassAutoLoad.php";

// Redirect user to signin page if they are not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Fetch events created by the logged-in user
$user_id = $_SESSION['user_id'];
$my_events = $ObjDB->fetchAll("SELECT * FROM events WHERE user_id = ? ORDER BY event_date DESC", [$user_id]);

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
// We'll create the dashboard_view() function next
$ObjLayout->dashboard_view($conf, $my_events);
$ObjLayout->footer($conf);
?>
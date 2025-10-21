<?php
require "ClassAutoLoad.php";

// Fetch all events from the database, ordered by the soonest event first
$all_events = $ObjDB->fetchAll("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC, event_time ASC");

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->public_events_list($conf, $all_events); // We will create this function next
$ObjLayout->footer($conf);
?>
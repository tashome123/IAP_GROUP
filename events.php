<?php
require "ClassAutoLoad.php";

// --- START: Pagination Logic ---
$events_per_page = 9; // Show 9 events per page (good for a 3-column layout)
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $events_per_page;
// --- END: Pagination Logic ---

$search_term = $_GET['search'] ?? '';
$sql_base = "FROM events WHERE event_date >= CURDATE()";
$params = [];

// If there is a search term, modify the SQL query
if (!empty($search_term)) {
    $sql_base .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = '%' . $search_term . '%';
    $params[] = '%' . $search_term . '%';
}

// --- START: Fetch Total Count and Events for Current Page ---
// First, get the total number of matching events for pagination
$total_events_query = "SELECT COUNT(*) as count " . $sql_base;
$total_events = $ObjDB->fetch($total_events_query, $params)['count'];
$total_pages = ceil($total_events / $events_per_page);

// Now, fetch only the events for the current page
$events_query = "SELECT * " . $sql_base . " ORDER BY event_date ASC, event_time ASC LIMIT ? OFFSET ?";
$params[] = $events_per_page;
$params[] = $offset;
$all_events = $ObjDB->fetchAll($events_query, $params);


if ($all_events === false) {
    $all_events = [];
}


// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
// Pass the new pagination variables to the view
$ObjLayout->public_events_list($conf, $all_events, $search_term, $current_page, $total_pages);
$ObjLayout->footer($conf);
?>
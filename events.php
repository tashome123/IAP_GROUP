<?php
require "ClassAutoLoad.php";


$events_per_page = 9; // Show 9 events per page (good for a 3-column layout)
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $events_per_page;


$search_term = $_GET['search'] ?? '';


$sql_base = "FROM events WHERE 1=1";
$params = [];


$sql_base .= " AND event_date >= CURDATE()";


if (!empty($search_term)) {
    $sql_base .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = '%' . $search_term . '%';
    $params[] = '%' . $search_term . '%';
}


$total_events_query = "SELECT COUNT(*) as count " . $sql_base;
$total_events = $ObjDB->fetch($total_events_query, $params)['count'];
$total_pages = ceil($total_events / $events_per_page);


$events_query = "SELECT * " . $sql_base . " ORDER BY event_date ASC, event_time ASC LIMIT ? OFFSET ?";
$params[] = $events_per_page;
$params[] = $offset;
$all_events = $ObjDB->fetchAll($events_query, $params);


if ($all_events === false) {
    $all_events = [];
}



$ObjLayout->header($conf);
$ObjLayout->navbar($conf);

$ObjLayout->public_events_list($conf, $all_events, $search_term, $current_page, $total_pages); ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const targets = document.querySelectorAll('.animate-on-scroll');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {

                    entry.target.classList.remove('is-visible');
                }
            });
        }, {
            threshold: 0.1
        });

        targets.forEach(target => {
            observer.observe(target);
        });
    });
</script>

<?php $ObjLayout->footer($conf);
?>
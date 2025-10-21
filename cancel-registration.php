<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

// If we have a valid event and user ID, proceed with cancellation
if ($event_id && $user_id) {
    // Delete the specific registration record from the database
    $ObjDB->query(
        "DELETE FROM event_registrations WHERE user_id = ? AND event_id = ?",
        [$user_id, $event_id]
    );

    $_SESSION['msg'] = 'Your registration has been successfully cancelled.';
    $_SESSION['msg_type'] = 'success';
}

// Redirect back to the user's dashboard
header("Location: dashboard.php");
exit();
?>
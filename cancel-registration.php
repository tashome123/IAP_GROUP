<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$event_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];


if ($event_id && $user_id) {

    $ObjDB->query(
        "DELETE FROM event_registrations WHERE user_id = ? AND event_id = ?",
        [$user_id, $event_id]
    );

    $_SESSION['msg'] = 'Your registration has been successfully cancelled.';
    $_SESSION['msg_type'] = 'success';
}

header("Location: dashboard.php");
exit();
?>
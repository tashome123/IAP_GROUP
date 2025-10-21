<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Fetch the current user's information from the database
$user_id = $_SESSION['user_id'];
$user = $ObjDB->fetch("SELECT fullname, email, role FROM users WHERE id = ?", [$user_id]);

// If for some reason the user isn't found, log them out
if (!$user) {
    header("Location: logout.php");
    exit();
}

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->profile_view($conf, $user); // We will create this function next
$ObjLayout->footer($conf);
?>
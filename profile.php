<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$user = $ObjDB->fetch("SELECT fullname, email, role FROM users WHERE id = ?", [$user_id]);


if (!$user) {
    header("Location: logout.php");
    exit();
}


$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->profile_view($conf, $user);
$ObjLayout->footer($conf);
?>
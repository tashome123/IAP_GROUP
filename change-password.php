<?php
require "ClassAutoLoad.php";

// Security check: ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Handle the form submission
$ObjAuth->changePassword($conf, $ObjFncs, $ObjDB);

// Display the page
$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->change_password_form($conf);
$ObjLayout->footer($conf);
?>
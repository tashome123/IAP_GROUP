<?php
require "ClassAutoLoad.php";

$token = $_GET['token'] ?? null;
if (!$token) {
    header("Location: signin.php");
    exit();
}

$ObjAuth->resetPassword($conf, $ObjFncs, $ObjDB);

$ObjLayout->header($conf);
$ObjLayout->reset_password_form($conf, $token);
?>
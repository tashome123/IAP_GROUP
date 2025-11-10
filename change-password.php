<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}


$ObjAuth->changePassword($conf, $ObjFncs, $ObjDB);


$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->change_password_form($conf);
$ObjLayout->footer($conf);
?>
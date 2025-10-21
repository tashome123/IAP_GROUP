<?php
require "ClassAutoLoad.php";

$ObjAuth->forgotPassword($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB);

$ObjLayout->header($conf);
// You don't need a navbar on this page
$ObjLayout->forgot_password_form($conf);
// No footer needed as the form includes all HTML
?>
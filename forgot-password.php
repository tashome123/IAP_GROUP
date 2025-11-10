<?php
require "ClassAutoLoad.php";

$ObjAuth->forgotPassword($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB);

$ObjLayout->header($conf);

$ObjLayout->forgot_password_form($conf);

?>
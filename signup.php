<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "ClassAutoLoad.php";

$ObjAuth->signup($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB);

$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
?>

<style>
    .top-buttons {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }
</style>

<div class="top-buttons">
    <a href="index.php" class="btn btn-outline-primary me-2">Home</a>
    <a href="signin.php" class="btn btn-outline-info">Sign In</a>
</div>

<?php
$ObjLayout->signup($conf);
<?php
require "ClassAutoLoad.php";

// Call verification method
$ObjAuth->verifyAccount($conf, $ObjFncs, $lang, $ObjSendMail, $ObjDB);

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
$ObjLayout->verify($conf);

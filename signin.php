<?php
require "ClassAutoLoad.php";


$ObjAuth->signin($conf, $ObjFncs, $ObjDB);

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
    <a href="index.php" class="btn btn-outline-primary mr-2">Home</a>
    <a href="signup.php" class="btn btn-outline-success">Sign Up</a>
</div>

<?php
$ObjLayout->signin($conf);

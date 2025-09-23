<?php
class Layouts {
    public function header($conf) {
        ?>
        <!DOCTYPE html>
        <html lang="en" data-bs-theme="auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Astro v5.13.2">
        <title><?php echo $conf['site_name']; ?></title>
        <link href="<?php echo $conf['site_url']; ?>/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
        <?php
    }}

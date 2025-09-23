<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/
$conf['site_timezone'] = 'Africa/Nairobi';


$conf['site_name'] = 'Stratheventique';
$conf['site_url'] = 'http://localhost/IAP_Group';
$conf['admin_email'] = 'admin@eventique.com';


$conf['site_lang'] = 'en';
require_once __DIR__ . '/Lang/' . $conf['site_lang'] . '.php';


$conf['db_type'] = 'pdo';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = 'Amerucas.1';
$conf['db_name'] = 'strath';


$conf['mail_type'] = 'smtp';
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'michael.obunga@strathmore.edu';
$conf['smtp_pass'] = 'ziul rgre mmea rsen';
$conf['smtp_port'] = 465;
$conf['smtp_secure'] = 'ssl';



$conf['min_password_length'] = 8;


$conf['valid_email_domain'] = ['yahoo.com', 'gmail.com', 'outlook.com', 'hotmail.com', 'strathmore.edu', 'eventique.com'];


$conf['reg_ver_code'] = rand(100000, 999999);


$conf['ver_code_expiry'] = 10;
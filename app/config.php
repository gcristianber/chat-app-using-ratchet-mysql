<?php

if (($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1')) {
    define('ROOT', 'http://localhost/development/realtime_chat_application_v1/public/');
} else {
    // Replace with your domain name
    define('ROOT', 'https://www.url.com/');
}

define('DB_NAME', 'simple_crud_3');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');

define('UPLOAD_10_MB', 1000000);
define('UPLOAD_100_MB', 10000000);

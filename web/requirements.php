<?php

$allowedIPs = ['127.0.0.1', '::1'];

if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
    header('Content-Type: text/plain', true, 500);
    die('This script is only accessible from localhost.');
}

require __DIR__ . '/../requirements.php';
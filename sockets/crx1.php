<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
    hex_dump($buffer);
});

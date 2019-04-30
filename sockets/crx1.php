<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
    $hexString = bin2hex(join(array_map("chr", $buffer)));
	log_info("application", $hexString);
});

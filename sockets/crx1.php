<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
    if (empty($buffer)) return;
    var_dump(explode(' ',trim(buffer2hex($buffer.""))));
});

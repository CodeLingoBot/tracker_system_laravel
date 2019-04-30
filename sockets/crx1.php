<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
  log_info("app_crx1", buffer2hex($buffer.""));
});

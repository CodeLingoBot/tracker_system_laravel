<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
  $chars = array_map("chr", $buffer);
  var_dump(join($chars));
});

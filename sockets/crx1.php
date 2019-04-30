<?php
include 'autoload.php';
$config = include 'config/crx1.php';
Socket::loop($config['ip'], $config['port'], function ($buffer) {
    if (empty($buffer)) return;
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        log_info("app_crx1", "Connection failed: " . $connection->connect_error);
        return;
    }
    $query = "INSERT INTO received (script, hexa) VALUES ('crx1', '".trim(buffer2hex($buffer.""))."')";
    if ($connection->query($query) !== TRUE) {
        log_info("app_crx1", "Error: " . $query . "<br>" . $connection->error);
    }
    $connection->close();
});

<?php
include 'autoload.php';
Socket::loop(CRX::config('ip'), CRX::config('port'), function ($buffer, $socket) {
    if (empty($buffer)) return;
    $hexString = trim(buffer2hex($buffer.""));
    log_info("app_crx1", $hexString);
    $hexArray = explode(' ', $hexString);
    $hexArrayLen = count($hexArray);
    if ($hexArrayLen < 4 || $hexArray[0].$hexArray[1] != '7878') return;
    $packageLength = $hexArray[2];
    $protocolNumber = $hexArray[3];
    $crx = new CRX();
    if ($protocolNumber=="01"){
        $command = $crx->protocol01($hexArray);
        log_info("app_crx1", $command);
        socket_send($socket, $command, strlen($command), 0);
    }
    /*$connection = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
    if ($connection->connect_error) {
        log_info("app_crx1", "Connection failed: " . $connection->connect_error);
        return;
    }
    $query = "INSERT INTO received (script, hexa) VALUES ('crx1', '".$hexString."')";
    if ($connection->query($query) !== TRUE) {
        log_info("app_crx1", "Error: " . $query . "<br>" . $connection->error);
    }
    $connection->close();*/
});

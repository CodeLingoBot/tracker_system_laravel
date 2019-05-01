<?php
include 'autoload.php';
Socket::loop(CRX::config('ip'), CRX::config('port'), function ($buffer, $socket) {
    if (empty($buffer)) return;
    $hexString = trim(buffer2hex($buffer.""));
    log_info("app_crx1", "Hex String: ".$hexString);
    DB::insert('crx1', $hexString);
    $hexArray = explode(' ', $hexString);
    $hexArrayLen = count($hexArray);
    if ($hexArrayLen < 4 || $hexArray[0].$hexArray[1] != '7878') return;
    $packageLength = $hexArray[2];
    $protocolNumber = $hexArray[3];
    $crx = new CRX();
    try{
        if (method_exists($crx, "protocol".$protocolNumber))
            $command = $crx->{"protocol".$protocolNumber}($buffer, $hexArray);
        else
            log_info("app_crx1", "'protocol".$protocolNumber."' not implemented");
    } catch(Exception $e){
        $command = false;
        log_info("app_crx1", $e->getMessage());
    }
    if ($command)
        socket_send($socket, $command, strlen($command), 0);
});

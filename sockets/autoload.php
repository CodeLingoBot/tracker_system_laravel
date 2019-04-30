<?php
include __DIR__.'/../vendor/autoload.php';
$GLOBALS['logger'] = [];
function log_info($file, $message){
    if (!isset($GLOBALS['logger'][$file])){
        $GLOBALS['logger'][$file] = new Katzgrau\KLogger\Logger(__DIR__.'/logs', Psr\Log\LogLevel::INFO, [
            'filename'=>$file,
            'extension'=>'log'
        ]);
    }
    $GLOBALS['logger'][$file]->info($message);
}
include 'config/_general.php';
include 'classes/CRC.class.php';
include 'classes/Hex.class.php';
include 'classes/Notify.class.php';
include 'classes/Point.class.php';
include 'classes/Serial.class.php';
include 'classes/Socket.class.php';
include 'classes/Tracker.class.php';
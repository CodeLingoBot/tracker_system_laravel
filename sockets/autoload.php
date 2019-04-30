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
    echo $message."\n";
}
include 'config/_general.php';
include 'classes/Socket.class.php';
<?php
include '_functions.php';
include __DIR__.'/../vendor/autoload.php';
include 'config/_general.php';
include 'classes/DB.php';
include 'classes/CRX.php';
include 'classes/Socket.php';
$dotenv = Dotenv\Dotenv::create(__DIR__."/../");
$dotenv->load();
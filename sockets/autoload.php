<?php
include '_functions.php';
include __DIR__.'/../vendor/autoload.php';
include 'config/_general.php';
include 'classes/Socket.class.php';
$dotenv = Dotenv\Dotenv::create(__DIR__."/../");
$dotenv->load();
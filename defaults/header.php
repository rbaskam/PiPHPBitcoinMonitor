<?php
//Turn on/off errors
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);


//Require the composer packages
require dirname(__DIR__, 1) .'/vendor/autoload.php';

//Get ENV data
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__, 1));
$dotenv->load();


<?php
//Turn on/off errors
$showErrors = true;

if ($showErrors) {
    ini_set('memory_limit', '-1');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('max_execution_time', 0);
}

//Require the composer packages
require dirname(__DIR__, 1) .'/vendor/autoload.php';

//Require the BTC Class
require dirname(__DIR__, 1) .'/classes/bitcoin.php';


//Get ENV data
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__, 1));
$dotenv->load();

//Set the Bitcoin Login Details
$userName = getenv('BTCNODEUSER');
$password = getenv('BTCNODEPASS');

//Connect tot he RPC Client
$url = 'http://' . $userName . ':' . $password . '@localhost:8332/';
$bitcoinRPC = new \org\jsonrpcphp\JsonRPCClient($url);
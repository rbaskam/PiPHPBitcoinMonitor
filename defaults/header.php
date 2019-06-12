<?php
//Turn on/off errors
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

//Set the Bitcoin Login Details
$userName = getenv('BTCNODEUSER');
$password = getenv('BTCNODEPASS');

//Require the composer packages
require dirname(__DIR__, 1) .'/vendor/autoload.php';

//Require the BTC Class
require dirname(__DIR__, 1) .'/classes/bitcoin.php';

//Connect tot he RPC Client
$bitcoinRPC = new \org\jsonrpcphp\JsonRPCClient('http://' . $userName . ':' . $password . '@localhost:8332/');;

var_dump($bitcoinRPC);

//Get ENV data
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__, 1));
$dotenv->load();


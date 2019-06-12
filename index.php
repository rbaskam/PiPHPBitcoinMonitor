<?php

//Get the header
require_once __DIR__ . '/defaults/header.php';


//Set the Bitcoin Login Details
$userName = getenv('BTCNODEUSER');
$password = getenv('BTCNODEPASS');

//Run the Client
$bitcoin = new \org\jsonrpcphp\JsonRPCClient('http://' . $userName . ':' . $password . '@127.0.0.1:28332/');;

echo "<pre>\n";
    print_r($bitcoin->getinfo());
echo "</pre>";
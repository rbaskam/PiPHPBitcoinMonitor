<?php
/*
Bitcoin Node Display

A simple class for making calls to BTC Nodes.
https://github.com/rbaskam/PiPHPBitcoinMonitor

====================

The MIT License (MIT)

Copyright (c) 2019 Robert Askam

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

====================
*/

//Get the header
require_once __DIR__ . '/defaults/header.php';

//Connect to the Bitcoin Data
$phpFormat = new PHPFormat();

//Connect to the Bitcoin Data
$bitcoin = new Bitcoin($userName, $password);
$bitcoin->getinfo();


$bitcoinRPC = '';

if ($bitcoin->status == 200) {
    //Connect tot he RPC Client
    $url = 'http://' . $userName . ':' . $password . '@' . $rpcUrl . ':' . $rpcPort . '/';
    $bitcoinRPC = new \org\jsonrpcphp\JsonRPCClient($url);

    //get the information about the current Node
    $nodeData = $bitcoinRPC->getblockchaininfo();
    
    var_dump($nodeData);
}


//Get last Logs from Bitcoin
// $debugLogs = $bitcoin->getDebugLogs(10);

// $transactionInfo = $bitcoin->getrawtransaction('e87f138c9ebf5986151667719825c28458a28cc66f69fed4f1032a93b399fdf8', 1);
// $blockInfo = $bitcoin->getblock('00000000000000000018a65ff0bbbc2a93493c693d05dd65c6a8dcbb881f55fb');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bitcoin Node Checker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="/resources/css/font-awesome.css" />
        <link rel="stylesheet" href="/resources/css/main.css" />
    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>Status of your Node: 
            <?php 
            if ($bitcoin->status == 200) { ?>
                <span class="text-success"> Up and Running</span>
            <?php } else { ?>
                <span class="text-danger">Down</span>
            <?php }
            echo ' (' . $bitcoin->status . ')';
            ?>
            </h1>
            <?php 
            if ($bitcoin->error) {
            ?>
                <p>Message from Node: <span class="text-danger"><?php echo $bitcoin->error; ?></span></p>
            <?php
            } 
            ?>
           
        </div>
        
        
        <div class="container">
            <div class="row">
            <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fa fa-code-fork"></i>
                <span class="count-numbers">
                <?php 
                if (isset($nodeData['blocks']) && isset($nodeData['headers'])) {
                    echo $nodeData['blocks'] . '/' . $nodeData['headers'];
                }                
                ?>
                </span>
                <span class="count-name">Synced Blocks/Headers</span>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-ticket"></i>
                <span class="count-numbers">
                <?php 
                if (isset($nodeData['verificationprogress'])) {
                    echo $nodeData['verificationprogress'] ;
                }                
                ?>
                </span>
                <span class="count-name">Progress with Sync</span>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card-counter success">
                <i class="fa fa-database"></i>
                <span class="count-numbers">
                <?php 
                if (isset($nodeData['size_on_disk'])) {
                    echo $phpFormat->formatBytes($nodeData['size_on_disk']);
                }                
                ?>
                </span>
                <span class="count-name">Size on Disk</span>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa fa-users"></i>
                <span class="count-numbers">35</span>
                <span class="count-name">Users</span>
            </div>
            </div>
        </div>
        </div>
    
        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/popper.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
    </body>
</html>

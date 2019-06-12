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

//Connect to the Class
$bitcoin = new Bitcoin($userName, $password);

//Get some information
$nodeInfo = $bitcoinRPC->getinfo();

//Get last Logs from Bitcoin
// $debugLogs = $bitcoin->getDebugLogs(10);

// $transactionInfo = $bitcoin->getrawtransaction('e87f138c9ebf5986151667719825c28458a28cc66f69fed4f1032a93b399fdf8', 1);
// $blockInfo = $bitcoin->getblock('00000000000000000018a65ff0bbbc2a93493c693d05dd65c6a8dcbb881f55fb');

var_dump($nodeInfo);
echo "<br>";
// var_dump($transactionInfo);
// echo "<br>";
// var_dump($blockInfo);
echo "<br>";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bitcoin Node Checker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/resources/css/bootstrap.min.css">
        
    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>Status of your Node: 
            <?php 
            if ($bitcoin->status == 200) { ?>
                <span class="text-success"> Up and Running </span>
            <?php } else { ?>
                <span class="text-danger">Down</span>
            <?php } ?>
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
                <div class="col-sm-4">
                <h3>Column 1</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                </div>
                <div class="col-sm-4">
                <h3>Column 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                </div>
                <div class="col-sm-4">
                <h3>Column 3</h3>        
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                </div>
            </div>
        </div>
    
        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/popper.min.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
    </body>
</html>

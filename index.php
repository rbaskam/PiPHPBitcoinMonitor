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


//Set the Bitcoin Login Details
$userName = getenv('BTCNODEUSER');
$password = getenv('BTCNODEPASS');

//Connect to the Class
$bitcoin = new Bitcoin($userName, $password);


//Get some information
$bitcoin->getinfo();
$bitcoin->getrawtransaction('e87f138c9ebf5986151667719825c28458a28cc66f69fed4f1032a93b399fdf8', 1);
$bitcoin->getblock('00000000000000000018a65ff0bbbc2a93493c693d05dd65c6a8dcbb881f55fb');


// echo $bitcoin->error;

echo "<br>";

echo $bitcoin->status;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bitcoin Node Checker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>Status of your Node: <?php echo $bitcoin->status?></h1>
            <?php 
            if ($bitcoin->error) {
                echo "<p>$bitcoin->error</p>"; 
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

    </body>
</html>

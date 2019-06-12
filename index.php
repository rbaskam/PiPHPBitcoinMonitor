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
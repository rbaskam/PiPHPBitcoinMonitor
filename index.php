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
$phpFunctions = new PHPFunctions();

//Connect to the Bitcoin Data using this as well as RPC breaks when starting
$bitcoin = new Bitcoin($userName, $password);
$bitcoin->getblockchaininfo();

//Set Default so can be used in Display
$bitcoinRPC = '';
//Check if the Bitcoin Node is up and run the RPC Client
if ($bitcoin->status == 200) {
    //Connect tot he RPC Client
    $url = 'http://' . $userName . ':' . $password . '@' . $rpcUrl . ':' . $rpcPort . '/';
    $bitcoinRPC = new \org\jsonrpcphp\JsonRPCClient($url);

    //get the information about the current Node
    $nodeData = $bitcoinRPC->getblockchaininfo();

    //Get information about loaded wallet
    $walletInfo = $bitcoinRPC->getwalletinfo();

    //Get information about addresses
    $labelsAvailable = $bitcoinRPC->listlabels();

    //Check if we have some labels (only way I can think of for now)
    if (count($labelsAvailable) == 0) {
        //Create a new address and label
        $bitcoinRPC->getnewaddress();
    }

    //Now we have a label we can get a receieveing address
    $labelsAvailable = $bitcoinRPC->listlabels();

    //Get the label if set
    $walletLabel = getenv('BTCWALLETLABEL');
    if ($walletLabel == '') {
        $walletLabel = $labelsAvailable[0];
    }

    //Get the wallet Recieve address
    $walletAddressAndType = $bitcoinRPC->getaddressesbylabel($walletLabel);
}

//Get the debug logs for bitcoin
$bitcoinLogs = $phpFunctions->getBitcoinDebugLog();

//Get Actions if applicable
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'shutdownBitcoin') {
        //Stop the botcoin server
        $message = $bitcoin->stop();
        $bitcoin->getblockchaininfo();
    } else if ($action == 'startBitcoin') {
        //Start the bitcoin server
        $message = $phpFunctions->startBitcoin();
    } else if ($action == 'shutdownPi') {
        //Shut down the Pi
        $message = $phpFunctions->shutDownPi($bitcoin->status);
    } else if ($action == 'createAddress') {
        //Create a new recieveing address
        $bitcoinRPC->getnewaddress();
        //Get the wallet Recieve address
        $walletAddressAndType = $bitcoinRPC->getaddressesbylabel($walletLabel);
    } else if ($action == 'autoPageRefresh') {
        //Use to auto refresh page
        $timeToWait = $_GET['every'];
        //Use this to turn it off
        $autoRefresh = true;

        //Page to refresh
        $page = $_SERVER['PHP_SELF'] . '?action=autoPageRefresh&every=' . $timeToWait;
        header("Refresh: $timeToWait; url=$page");
    }
}

// $transactionInfo = $bitcoin->getrawtransaction('e87f138c9ebf5986151667719825c28458a28cc66f69fed4f1032a93b399fdf8', 1);
// $blockInfo = $bitcoin->getblock('00000000000000000018a65ff0bbbc2a93493c693d05dd65c6a8dcbb881f55fb');

//If status is 500 as in we are loading then refresh every 5 seconds to check
if ($bitcoin->status == 500) {
    $page = $_SERVER['PHP_SELF'];
    $sec = "5";
    header("Refresh: $sec; url=$page");
}
//Get the main view
require_once __DIR__ . '/views/home.php';

?>

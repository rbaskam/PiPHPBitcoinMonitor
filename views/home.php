<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bitcoin Node Checker</title>
        <?php
            require dirname(__DIR__, 1) . "/views/defaults/headTagContents.php";
        ?>
    <body>
        <?php
            require dirname(__DIR__, 1) . "/views/defaults/navigation.php";
        ?>
        
        <div class="jumbotron text-center">
            <h1>Your Node is: 
            <?php 
            if ($bitcoin->status == 200) { ?>
                <span class="text-success"> Up and Running</span>
            <?php } else { ?>
                <span class="text-danger">Down</span>
            <?php }
            ?>
            </h1>
           
            <?php 
            if (isset($nodeData['blocks']) && isset($nodeData['headers'])) {
                if ($nodeData['blocks'] == $nodeData['headers']) {
                ?>
                   <h2 class="text-success"> Synced</h2>
                <?php
                } else {
                ?>
                    <h2 class="text-danger"> Not Synced (<?php echo (intval($nodeData['headers']) - intval($nodeData['blocks'])) ?> block(s) behind)</h2>
                <?php
                }
                
            }                
            ?>           
            
            <?php 
            if ($bitcoin->status != 200) {
            ?>
                <p>Status: <span class="text-danger"><?php echo $bitcoin->status; ?></span></p>
            <?php
            } 
            if ($bitcoin->error) {
            ?>
                <p>Message from Node: <span class="text-danger"><?php echo $bitcoin->error; ?></span></p>
            <?php
            } 


            if (isset($message)) {
            ?>
                <p>Message from Last Action: <span class="text-warning"><?php echo $message; ?></span></p>
            <?php
            } 
            ?>


           
        </div>
        
        
        <div class="container">
            <div class="row">
                <div class="col-md-6">
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

                <div class="col-md-6">
                    <div class="card-counter danger">
                        <i class="fa fa-percent"></i>
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
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card-counter warning">
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
                    <div class="card-counter success">
                        <i class="fa fa-btc"></i>
                        <span class="count-numbers">
                        <?php 
                        if ($bitcoinRPC) {
                            echo $bitcoinRPC->getbalance();
                        }                
                        ?>
                        </span>
                        <span class="count-name">BTC Balance<br>                       
                        </span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter purple">
                        <i class="fa fa-btc"></i>
                        <span class="fas fa-network-wired">
                        <?php 
                        if ($bitcoinRPC) {
                            echo $bitcoinRPC->getconnectioncount();
                        }                
                        ?>
                        </span>
                        <span class="count-name">Connections<br>                       
                        </span>
                    </div>
                </div>
                

                <div class="col-md-3">
                    <div class="card-counter info">
                        <i class="fa fas fa-link"></i>
                        <span class="count-numbers">
                        <?php 
                        if (isset($nodeData['chain'])) {
                            echo ucfirst($nodeData['chain']);
                        }                
                        ?>
                        </span>
                        <span class="count-name">Blockchain</span>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        <div class="container">
            <h2>BTC Wallet</h2><br>
            <p>Here is some information about your BTC Wallet.</p>
            
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Header</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody> 
                    <?php 
                    if (isset($walletInfo)) {
                    ?>                  
                    <tr>                        
                        <td>Wallet Name</td>
                        <td><?php echo $walletInfo['walletname'] ?></td>
                    </tr>
                    <tr>                        
                        <td>Balance</td>
                        <td><?php echo $walletInfo['balance'] ?></td>
                    </tr>
                    <tr>                        
                        <td>Unconfirmed Balance</td>
                        <td><?php echo $walletInfo['unconfirmed_balance'] ?></td>
                    </tr>
                    <tr>                        
                        <td>Transactions</td>
                        <td><?php echo $walletInfo['txcount'] ?></td>
                    </tr>
                    <?php
                    foreach ($walletAddressAndType AS $address => $data) {
                        if ($data['purpose'] != 'receive') {
                            continue;
                        }
                    ?>
                        <tr>
                            <td>Receive Address</td>
                            <td><?php echo $address ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                    <?php 
                    } else {
                    ?> 
                    <tr>                        
                        <td>Wallet Not Found</td>
                        <td>-</td>
                    </tr>

                    <?php 
                    }
                    ?> 

                </tbody>
            </table>     
        </div>
        <hr>
        <div class="container">
            <h2>Bitcoin Logs</h2><br>
            <p>Here are the latest <?php echo getenv('BTCLOGLENGTH') ?> log entries from <?php echo getenv('BTCLOGFILE')?>.</p>
            
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Log</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($bitcoinLogs AS $log) {
                ?>
                    <tr>
                        <td><?php echo $log ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>  
        </div>
        
        <?php
            require dirname(__DIR__, 1) . "/views/defaults/footer.php";
        ?>
        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/popper.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
    </body>
</html>

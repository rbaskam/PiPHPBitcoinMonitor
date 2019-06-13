
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
            <h1>Your Node is: 
            <?php 
            if ($bitcoin->status == 200) { ?>
                <span class="text-success"> Up and Running</span>
            <?php } else { ?>
                <span class="text-danger">Down</span>
            <?php }
            ?>
            </h1>
            <h2>Your Node is: 
            <?php 
            if (isset($nodeData['blocks']) && isset($nodeData['headers'])) {
                if ($nodeData['blocks'] == $nodeData['headers']) {
                    echo '<span class="text-success"> Synced</span>';
                } else {
                    echo '<span class="text-danger"> Not Synced (' . $nodeData['headers'] - $nodeData['blocks'] . ' behind)</span>';
                }
                
            }                
            ?>            
            </h2>
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
                <div class="col-md-6">
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

                    <div class="col-md-6">
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
            <div class="row">
                <h2>Bitcoin Logs</h2>
                <p>Here are the latest <?php echo getenv('BTCLOGLENGTH') ?> log entries from <?php echo getenv('BTCLOGFILE')?>.</p>
                <h2>Striped Rows</h2>
  <p>The .table-striped class adds zebra-stripes to a table:</p> 
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
        </div>
    
        <script src="/resources/js/jquery.min.js"></script>
        <script src="/resources/js/popper.js"></script>
        <script src="/resources/js/bootstrap.min.js"></script>
    </body>
</html>

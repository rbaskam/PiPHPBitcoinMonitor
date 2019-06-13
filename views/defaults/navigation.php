<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="/"><img src="/resources/img/logo.png" alt="logo"></a>
    
    <!-- Links -->
    <ul class="navbar-nav">
        <!-- <li class="nav-item">
            <a class="nav-link" href="/index.php?action=startBitcoin">Start Bitcoin Node</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/index.php?action=shutdownBitcoin">Shutdown Bitcoin Node</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="/index.php?action=createAddress">Create Address</a>
        </li>
        <li class="nav-item">
        <?php 
        if (isset($autoRefresh)) {
        ?>
            <a class="nav-link" href="/index.php">Switch Refresh Off</a>
        <?php
        } else {
        ?>
            <a class="nav-link" href="/index.php?action=autoPageRefresh&every=10">Switch Refresh On</a>
        <?php   
        }
        ?>
            
        </li>
    </ul>
</nav>
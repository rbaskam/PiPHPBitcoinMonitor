<?php

/**
 * Class functions.php
 *
 * Functions Class looks after all PHP functions
 *
 * @category Class
 * @package  Bitcoin Node
 * @author   Robert Askam <rbaskam@gmail.com> 
 * @license  No License 
 * @since    Class available since 12/06/2019
 */
Class PHPFunctions
{

    /**
     * Construct the Class
     *
     * Does what it says on the tin, 
     *    
     */
    public function __construct()
    {

    }    

    public function getBitcoinDebugLog() 
    { 
        //Get how many results you want
        $lengthOfLog = getenv('BTCLOGLENGTH');

        //Get from ENV File
        $logFilePath   = getenv('BTCLOGFILE');

        //Assign File
        $file = file($logFilePath);

        //Return Array
        $debugLog = array();

        //Loop through file lines
        for ($i = max(0, count($file)-$lengthOfLog); $i < count($file); $i++) {
            array_push($debugLog, $file[$i]);
        }

        return $debugLog;
    } 

    public function shutDownBitcoin()
    {
        return exec('bitcoin-cli stop');
    }

    public function shutDownPi($status)
    {
        if ($status == 200) {
            return 'You must shut down Bitcoin first to avoid HDD corruption';
        }

        return exec('sudo shutdown -h');
    }

    public function testExecFunctions()
    {
        $output = shell_exec('ls'); 
  
        // Display the list of all file 
        // and directory 
        echo "<pre>$output</pre>"; 
    }
       
}
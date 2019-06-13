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
        //Return Array
        $debugLog = array();

        //Check file exisits
        if (file_exists($logFilePath)) {

            //Assign File
            $file = file($logFilePath);            

            //Loop through file lines
            for ($i = max(0, count($file)-$lengthOfLog); $i < count($file); $i++) {
                array_push($debugLog, $file[$i]);
            }
        } else {
            array_push($debugLog, 'No File Exists in this location!');
        }
        return $debugLog;
    } 

    public function shutDownBitcoin()
    {
        return shell_exec('sudo bitcoin-cli stop');
    }

    public function startBitcoin()
    {
        return shell_exec('/home/pi/bitcoin/src/bitcoind -daemon');
    }

    public function shutDownPi($status)
    {
        if ($status == 200) {
            return 'You must shut down Bitcoin first to avoid HDD corruption';
        }

        return shell_exec('sudo shutdown -h');
    }
       
}
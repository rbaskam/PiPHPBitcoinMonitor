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

    

    public function getBitcoinDebugLog($length = 10) 
    { 
        //Get from ENV File
        $logFilePath   = dirname(__DIR__, 4) . getenv('BTCLOGFILE');

        //Assign File
        $file = file($logFilePath);

        //Return Array
        $debugLog = array();

        //Loop through file lines
        for ($i = max(0, count($file)-$length); $i < count($file); $i++) {
            array_push($debugLog, $file[$i]);
        }

        return $debugLog;
    } 
       
}
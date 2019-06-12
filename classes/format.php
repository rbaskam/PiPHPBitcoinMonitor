<?php

/**
 * Class format.php
 *
 * Format Class looks after all PHP Formatting
 *
 * @category Class
 * @package  Bitcoin Node
 * @author   Robert Askam <rbaskam@gmail.com> 
 * @license  No License 
 * @since    Class available since 12/06/2019
 */
Class PHPFormat
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

    

    public function formatBytes($bytes, $precision = 2) 
    { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 
       
}
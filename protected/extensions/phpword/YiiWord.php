<?php

/**
 * Wrapper for the PHPWord library.
 * @see README.md
 */
class YiiWord extends CComponent
{
     private static $_isInitialized = false;
    
    /**
     * Register autoloader.
     */
    public static function init()
    {
        if (!self::$_isInitialized) {
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'PHPWord.php');
            spl_autoload_register(array('YiiBase', 'autoload'));
            
            self::$_isInitialized = true;
        }
    }
    
    /**
     * Returns new PHPExcel object. Automatically registers autoloader.
     * @return PHPExcel
     */
    public static function createPHPWord()
    {
        self::init();
        return new PHPWord;
    }
}
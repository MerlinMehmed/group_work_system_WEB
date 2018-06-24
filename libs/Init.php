<?php

class Init
{
    /**
     * Initialize application settings
     *
     * @param $isController {bool} true if the initialization is for controller, default false for view
     */
    public static function _init($isController = false)
    {
        session_start();
        require_once 'Config.php';
        Config::_init($isController);

        spl_autoload_register(function($className)
        {
            $path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . CONFIG['app']['home'] . DIRECTORY_SEPARATOR . $className . '.php';

            require_once $path;
        });
    }
}

?>
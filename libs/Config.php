<?php

class Config
{
    public static function _init($isController)
    {
        $basePath = $isController ? '../' : '';
        $config = parse_ini_file("${basePath}config/config.ini", true);
        define('CONFIG', $config);
    }

}
?>
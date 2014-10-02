<?php
/**
* Easy access to config
*/
class Config
{
    static private $config;

    static public function load()
    {
        self::$config = parse_ini_file(ROOT . 'app/config.ini', true);
    }

    static public function get($value)
    {
        $section = explode('.', $value)[0];
        $key = explode('.', $value)[1];
        return self::$config[$section][$key];
    }
}
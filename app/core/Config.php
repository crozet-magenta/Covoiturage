<?php
/**
* Easy access to config
*/
class Config
{
    static private $config;

    /**
     * Loads the config file into the $config private var
     * @return void
     */
    static public function load()
    {
        self::$config = parse_ini_file(APP . 'Config.ini', true);
    }

    /**
     * Returns the requested config value
     * @param string $value (format : 'Section.Name') the wanted config value
     * @return mixed the config value if found or null otherwise
     */
    static public function get($value)
    {
        $section = explode('.', $value)[0];
        $key = explode('.', $value)[1];
        return isset(self::$config[$section][$key])?self::$config[$section][$key]:null;
    }
}

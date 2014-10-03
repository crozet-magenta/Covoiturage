<?php

/**
* main app class
*/
class App
{
    static function run()
    {
        App::checkVersion();
        App::loadCore();
        if (Config::get('app.Debug')) {
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(E_ALL | E_STRICT);
        } else {
            ini_set('display_errors',0);
            ini_set('display_startup_errors',0);
        }
        Router::dumpRoutes();
    }

    static function loadCore()
    {
        require_once CORE . 'Config.php';
        require_once CORE . 'Router.php';
        require_once CORE . 'Request.php';
        //require_once CORE . 'Helpers.php';

        Config::load();
        Router::load();
    }

    static function checkVersion()
    {
        if (version_compare(phpversion(), '5.4', '<')) {
            die('<meta charset=UTF-8>Votre version de PHP est obsolète, veuillez installer une version plus récente');
        }
    }
}

?>
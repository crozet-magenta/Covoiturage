<?php

/**
* main app class
*/
class App
{
    static function run()
    {
        App::loadCore();
        if (Config::get('app.Debug')) {
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(E_ALL | E_STRICT);
        } else {
            ini_set('display_errors',0);
            ini_set('display_startup_errors',0);
        }
    }

    static function loadCore()
    {
        require_once ROOT . 'app/Config.php';
        require_once ROOT . 'app/Router.php';
        require_once ROOT . 'app/Request.php';
        //require_once ROOT . 'app/Helpers.php';

        Config::load();
        Router::load();
    }
}

?>
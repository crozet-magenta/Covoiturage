<?php

/**
* main app class
*/
class App
{
    /**
     * Fires the application
     * @return void
     */
    static function run()
    {
        self::checkVersion();
        self::loadCore();
        self::setErrorMode();

        Router::dispatch();
    }

    /**
     * Checks if current PHP version is up to date enough
     *
*@return void
     */
    static public function checkVersion()
    {
        if (version_compare(phpversion(), '5.5', '<=')) {
            echo '<meta charset=UTF-8>';
            trigger_error('Votre version de PHP (' . phpversion() . ') est obsolète. Veuillez installer une version plus récente (PHP 5.5 minimum)', E_USER_ERROR);
        }
    }

    /**
     * includes the core files
     *
*@return void
     */
    static private function loadCore()
    {
        session_start();
        require_once CORE . 'Config.php';
        require_once CORE . 'Request.php';
        require_once CORE . 'Url.php';
        require_once CORE . 'View.php';
        require_once CORE . 'Router.php';
        require_once CORE . 'Database.php';
        require_once CORE . 'Collection.php';
        require_once CORE . 'Auth.php';

        spl_autoload_register('App::ClassLoader');
        Config::load();
        Router::load();

    }

    /**
     * Sets the display errors parameter at true or false based on the debug state in the config
     * @return void
     */
    static private function setErrorMode()
    {
        if (Config::get('app.Debug')) {
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(E_ALL | E_STRICT);
        } else {
            ini_set('display_errors',0);
            ini_set('display_startup_errors',0);
        }
    }

    /**
     * gets the existing CSRF token or a new one if current is too old
     *
     * @return string the generated CSRF token
     */
    static public function getCSRF()
    {
        if (!isset($_SESSION['__CSRF']) || (($_SESSION['__GENERATED'] + 3000) < microtime(true))) {
            $_SESSION['__CSRF'] = sha1(microtime(true)) . uniqid();
            $_SESSION['__GENERATED'] = microtime(true);
        }
        return $_SESSION['__CSRF'];
    }

    /**
     * sends a HTML email using a view
     *
     * @param string $from    mail of the sender
     * @param string $to      mail of the receiver
     * @param string $subject subject of the mail
     * @param string $view    view to use for the mail
     * @param array  $data    data to pass to the view
     *
     * @return bool true if the mail was successfully accepted for delivery, false otherwise.
     */
    static public function sendMail($from, $to, $subject, $view, array $data = [])
    {
        $headers = 'From: ' . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $viewName = str_replace('.', '/', $view);
        if (!file_exists(APP . 'views/' . $viewName . '.php')) {
            trigger_error('File ' . $viewName . '.php does not exist in ' . APP . 'views/', E_USER_ERROR);
        }
        extract($data);

        ob_start();
        include APP . 'views/' . $viewName . '.php';
        $message = ob_get_clean();

        return mail($to, utf8_decode($subject), $message, $headers);
    }

    /**
     * class loader for models
     *
     * @param string $classModel the name of the class to load
     */
    static private function ClassLoader($classModel)
    {
        require APP . 'models/' . $classModel . 'Model.php';
    }
}

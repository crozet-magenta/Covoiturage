<?php
define('START', microtime(true));
define('ROOT', __DIR__ . '/');


require_once 'app/App.php';
App::run();


if (Config::get('app.Debug')) {
    define('STOP', microtime(true));
    echo 'Page generated in ' . number_format(round(STOP - START,3)*1000, 0, ',', ' ') . ' ms';
}
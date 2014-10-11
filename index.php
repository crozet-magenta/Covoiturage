<?php
define('START', microtime(true));
define('ROOT', __DIR__ . '/');
define('APP',  __DIR__ . '/app/');
define('CORE', __DIR__ . '/app/core/');

require_once CORE . 'App.php';
App::run();


if (Config::get('app.Debug')) {
    function human_filesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$sz[$factor];
    }
    define('STOP', microtime(true));
    echo '<p>Page generated in ' . number_format(round(STOP - START,3)*1000, 0, ',', ' ') . ' ms<br>(memory usage : ' . human_filesize(memory_get_usage()) . ')</p>';
}

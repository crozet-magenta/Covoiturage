<?php

/**
* Router class to link urls and controllers
*/
class Router
{
    static private $routes;
    
    static public function load()
    {
        require_once ROOT . 'app/routes.php';
    }

    static public function register($method, $param)
    {
        if (!in_array($method, Request::$authorizedMethods)){
            trigger_error('Invalid method provided in Router::register()', E_USER_ERROR);
        }
        if (!isset($param['url']) | !isset($param['controller']) | !isset($param['action'])) {
            trigger_error('Missing parameters for Router::register()', E_USER_ERROR);
        }

        $name       = (isset($param['name']))?$param['name']:'';
        $url        = $param['url'];
        $controller = $param['controller'];
        $action     = $param['action'];

        $route               = self::parseUrl($url);
        $route['url']        = $url;
        $route['controller'] = $controller;
        $route['action']     = $action;

        self::$routes[$method][] = $route;
    }

    static private function parseUrl($url)
    {
        $parts = explode('/', $url);
        unset($parts[0]);
        $parsed['pattern'] = '\\/';
        foreach ($parts as $part) {
            if ($part[0] != '{') {
                $parsed['pattern'].= $part . '\\/';
                $parsed['params']  = array();
            } else if ($part[1] != '?') {
                $parsed['pattern'] .= '(\w*)\\/';
                $parsed['params'][] = substr($part, 1, -1);
            } else {
                $parsed['pattern'] .= '(?:(\w*)\\/)?';
                $parsed['params'][] = substr($part, 2, -1);
            }
        }
        return $parsed;
    }

    static public function dumpRoutes()
    {
        echo '<pre>';
        foreach (self::$routes as $method => $routes) {
            echo $method . ' routes : <br>';
            foreach ($routes as $route) {
                echo "- {$route['url']} => {$route['controller']}@{$route['action']}(" . implode(',', $route['params']) . ")<br>";
            }
            echo '<br>';
        }
        echo '</pre>';
    }
}
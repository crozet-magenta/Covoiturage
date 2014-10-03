<?php

/**
* Router class to link urls and controllers
*/
class Router
{
    static private $routes;
    static private $default;
    static private $host;
    
    static public function load()
    {
        require_once APP . 'routes.php';
        self::$host = Config::get('app.Host');
    }

    static public function register($method, $param)
    {
        if (!in_array($method, Request::$authorizedMethods)){
            trigger_error('Invalid method provided in Router::register()', E_USER_ERROR);
        }
        if (!isset($param['url']) | !isset($param['controller']) | !isset($param['action'])) {
            trigger_error('Missing parameters for Router::register()', E_USER_ERROR);
        }

        $route               = self::parseUrl($param['url']);
        $route['url']        = $param['url'];
        $route['controller'] = $param['controller'];
        $route['action']     = $param['action'];

        self::$routes[$method][] = $route;
    }

    static public function fallback($param)
    {
        if (!isset($param['controller']) | !isset($param['action'])) {
            trigger_error('Missing parameters for Router::default()', E_USER_ERROR);
        }

        self::$default['controller'] = $param['controller'];
        self::$default['action']     = $param['action'];

    }

    static private function parseUrl($url)
    {
        $parts = explode('/', $url);
        unset($parts[0]);
        $parsed['pattern'] = '#^\\/';
        $parsed['params']  = array();
        foreach ($parts as $part) {
            if ($part[0] != '{') {
                $parsed['pattern'].= $part . '\\/';
            } else if ($part[1] != '?') {
                $parsed['pattern'] .= '(\w*)\\/';
                $parsed['params'][] = substr($part, 1, -1);
            } else {
                $parsed['pattern'] .= '(?:(\w*)\\/)?';
                $parsed['params'][] = substr($part, 2, -1);
            }
            
        }
        $parsed['pattern'].= '$#';
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

    static public function dispatch()
    {
        $request = Request::getURI();
        $method  = Request::getMethod();
        foreach (self::$routes[$method] as $route) {
            preg_match($route['pattern'], $request, $params);
            if (isset($params[0])) {
                unset($params[0]);
                $controller = $route['controller'];
                $action = $route['action'];
                include APP . 'controllers/' . $controller . 'Controller.php';
                $class = new $controller();
                call_user_func([$class, $action], $params);
                return;
            }
        }
        if (!empty(self::$default)) {
            $controller = self::$default['controller'];
            $action = self::$default['action'];
            include APP . 'controllers/' . $controller . 'Controller.php';
            $class = new $controller();
            call_user_func([$class, $action], $params);
        }
    }
}
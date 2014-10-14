<?php

/**
* Router class to link urls and controllers
*/
class Router
{
    static private $routes;
    static private $default;
    
    /**
     * Loads the routes file
     * stores the host name in $host
     * @return void
     */
    static public function load()
    {
        require_once APP . 'Routes.php';
    }

    /**
     * Add a route to the application
     * @param string $method the authorized HTTP method for this route
     * @param array $param associative array containing url, controller and action for the route
     * @return void
     */
    static public function register($method, $param)
    {
        if (!in_array($method, Request::$authorizedMethods)){
            trigger_error('Invalid method provided in Router::register() expecting one of ' . implode(', ', Request::$authorizedMethods), E_USER_ERROR);
        }
        if (!isset($param['url']) | !isset($param['controller']) | !isset($param['action'])) {
            trigger_error('Missing parameters for Router::register()', E_USER_ERROR);
        }
        if (!file_exists(APP . 'controllers/' . $param['controller'] . '.php')) {
            trigger_error('File ' . $param['controller'] . '.php does not exist in ' . APP . 'controllers/' , E_USER_ERROR);
        }
        include_once APP . 'controllers/' . $param['controller'] . '.php';
        if (!class_exists($param['controller'])) {
            trigger_error('Controller ' . $param['controller'] . ' does not exist', E_USER_ERROR);
        }
        if (!method_exists($param['controller'], $param['action'])) {
            trigger_error('Controller' . $param['controller'] . ' has no method ' . $param['action'], E_USER_ERROR);
        }

        $route               = self::parseUrl($param['url']);
        $route['url']        = $param['url'];
        $route['controller'] = $param['controller'];
        $route['action']     = $param['action'];

        self::$routes[$method][] = $route;
    }

    /**
     * Add a fallback route used if the requested URL is not registred as a route
     * @param array $param associative array containing controller and action for the route
     * @return void
     */
    static public function fallback($param)
    {
        if (!isset($param['controller']) | !isset($param['action'])) {
            trigger_error('Missing parameters for Router::default()', E_USER_ERROR);
        }

        self::$default['controller'] = $param['controller'];
        self::$default['action']     = $param['action'];

    }

    /**
     * Parses the route URI into a regex pattern
     * @param string $url the URI to parse
     * @return string the match pattern for the URI (regex)
     */
    static private function parseUrl($uri)
    {
        $parts = explode('/', $uri);
        unset($parts[0]);
        $parsed['pattern'] = '#^\\/';
        $parsed['params']  = array();
        $parsed['par']  = ['needed' => array(), 'optional' => array()];
        foreach ($parts as $part) {
            if (strlen($part) < 3) {
                $parsed['pattern'].= $part . '\\/';
            } else {
                if ($part[0] != '{') {
                    $parsed['pattern'].= $part . '\\/';
                } else if ($part[1] != '?') {
                    $parsed['pattern'] .= '([\w-]*)\\/';
                    $parsed['params'][] = substr($part, 1, -1);
                    $parsed['par']['needed'][] = substr($part, 1, -1);
                } else {
                    $parsed['pattern'] .= '(?:([\w-]*)\\/)?';
                    $parsed['params'][] = substr($part, 2, -1);
                    $parsed['par']['optional'][] = substr($part, 2, -1);
                }
            }
            
        }
        $parsed['pattern'].= '$#';
        return $parsed;
    }

    /**
     * Dumps all registred routes (for debugging purposes)
     * @return void
     */
    static public function dumpRoutes()
    {
        echo '<pre>';
        foreach (self::$routes as $method => $routes) {
            echo $method . ' routes : <br>';
            foreach ($routes as $route) {
                echo "- {$route['url']} (-- {$route['pattern']} --)=> {$route['controller']}@{$route['action']}(" . implode(',', $route['params']) . ")<br>";
            }
            echo '<br>';
        }
        echo '</pre>';
    }

    static public function getRawRoutes()
    {
        return self::$routes;
    }

    /**
     * Gets the requested URI and calls the proper controller and action
     * @return void
     */
    static public function dispatch()
    {
        $request = Url::getURI();
        $method  = Request::getMethod();
        foreach (self::$routes[$method] as $route) {
            preg_match($route['pattern'], $request, $params);
            if (isset($params[0])) {
                unset($params[0]);
                $controller = $route['controller'];
                $action = $route['action'];
                $class = new $controller();
                call_user_func_array([$class, $action], $params);
                return;
            }
        }
        if (!empty(self::$default)) {
            $controller = self::$default['controller'];
            $action = self::$default['action'];
            $class = new $controller();
            call_user_func([$class, $action]);
        }
    }
}

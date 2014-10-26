<?php

/**
* Url relative functions
*/
class Url
{
    
    /**
     * Get the full requested URL with GET parameters
     * @return string the URL
     */
    static public function getFull()
    {
        return 'https://' . Config::get('app.Host') . $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the full requested URL without GET parameters
     * @return string the URL
     */
    static public function getClean()
    {
        return explode('?', self::getFull())[0];
    }

    /**
     * Gets the requested URL without domain and GET parameters
     * @return string the URI
     */
    static public function getURI()
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0] . '/';
    }

    /**
     * returns the full url to a given uri
     * @param string $uri the target uri
     * @return string the full url
     */
    static public function to($uri)
    {
        $host = Config::get('app.Host');
        return 'https://' . $host . $uri;
    }

    static public function redirect($to)
    {
        echo '<meta http-equiv="refresh" content="0;URL=' . Url::to($to) . '">';
        die();
    }

    static public function route($to, array $params = array())
    {
        $tmp        = explode('@', $to);
        $controller = $tmp[0];
        $action     = $tmp[1];
        $routes     = Router::getRawRoutes();

        foreach ($routes as $method) {
            foreach ($method as $route) {
                if ($route['controller'] == $controller && $route['action'] == $action) {
                    $url = $route['url'];
                    foreach ($route['par']['needed'] as $name) {
                        if (!isset($params[$name]) || empty($params[$name])) {
                            trigger_error('Missing or empty parameter "' . $name . '" for route ' . $to . ' in Url::route()', E_USER_ERROR);
                        }
                        $url = str_replace('{'. $name .'}' , $params[$name], $url);
                    }
                    foreach ($route['par']['optional'] as $name) {
                        if (isset($params[$name]) && !empty($params[$name])) {
                            $url = str_replace('{?'. $name .'}' , $params[$name], $url);
                        } else {
                            $url = str_replace('{?'. $name .'}' , '', $url);
                        }
                    }
                    return self::to($url);
                }
            }
        }
        trigger_error('Unknown route for ' . $to . ' in Url::route()', E_USER_ERROR);
    }
}
<?php

/**
* Request helper to parse url
*/
class Request
{
    static public $authorizedMethods = ['GET', 'POST', 'PUT', 'DELETE'];

    /**
     * Gets the current HTTP method from the _method POST data if exists or from the HTTP headers
     * @return type
     */
    static public function getMethod()
    {
        if (isset($_POST['_method']) && in_array($_POST['_method'], self::$authorizedMethods)) {
            $method = $_POST['_method'];
        } else {
            $method = $_SERVER['REQUEST_METHOD'];
        }
        return $method;
    }

    /**
     * checks if the curret request is a GET HTTP request
     * @return boolean
     */
    static public function isGet()
    {
        return self::getMethod() == 'GET';
    }

    /**
     * checks if the curret request is a POST HTTP request
     * @return boolean
     */
    static public function isPost()
    {
        return self::getMethod() == 'POST';
    }

    /**
     * checks if the curret request is a PUT HTTP request
     * @return boolean
     */
    static public function isPut()
    {
        return self::getMethod() == 'PUT';
    }

    /**
     * checks if the curret request is a DELETE HTTP request
     * @return boolean
     */
    static public function isDelete()
    {
        return self::getMethod() == 'DELETE';
    }

    /**
     * Get the full requested URL with GET parameters
     * @return string the URL
     */
    static public function getFull()
    {
        return 'http://' . Config::get('app.Host') . $_SERVER['REQUEST_URI'];
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

}

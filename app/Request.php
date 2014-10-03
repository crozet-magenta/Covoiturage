<?php

/**
* Request helper to parse url
*/
class Request
{
    static public $authorizedMethods = ['GET', 'POST', 'PUT', 'DELETE'];

    static private function getMethod()
    {
        if (isset($_POST['_method']) && in_array($_POST['_method'], self::$authorizedMethods)) {
            $method = $_POST['_method'];
        } else {
            $method = $_SERVER['REQUEST_METHOD'];
        }
        return $method;
    }

    static public function isGet()
    {
        return self::getMethod() == 'GET';
    }

    static public function isPost()
    {
        return self::getMethod() == 'POST';
    }

    static public function isPut()
    {
        return self::getMethod() == 'PUT';
    }

    static public function isDelete()
    {
        return self::getMethod() == 'DELETE';
    }
}
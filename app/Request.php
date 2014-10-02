<?php

/**
* Request helper to parse url
*/
class Request
{
    static private function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    static public function isGet()
    {
        return self::getMethod() == 'GET';
    }

    static public function isPost()
    {
        return self::getMethod() == 'POST';
    }
}
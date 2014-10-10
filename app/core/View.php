<?php

/**
* renders th views
*/
class View
{
    
    static public function render($name, array $data = array())
    {
        $name = str_replace('.', '/', $name);
        extract($data);
        include APP . 'views/' . $name . 'View.php';
    }
}
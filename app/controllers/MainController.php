<?php

/**
* Main controller
*/
class Main
{
    public function home()
    {
        echo 'this is the home controller :)<br>';
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}
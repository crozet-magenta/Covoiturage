<?php

/**
* Main controller
*/
class Main
{
    public function home()
    {
        echo 'this is the home controller :)<br><a href="/Hello" title="hello">go to hello world</a><br><a href="/Hello/name" title="hello">go to hello name</a><br>';
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}

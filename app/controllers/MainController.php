<?php

/**
* Main controller
*/
class Main
{
    public function home()
    {
        $content = 'this is the home controller :)<br>
                <a href="' . Url::route('Test@hello') . '" title="hello">go to hello world</a><br>
                <a href="' . Url::route('Test@hello', ['name' => 'world']) . '" title="hello">go to hello name</a><br>';
        View::render('Main.home', compact('content'));
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}

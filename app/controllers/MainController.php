<?php

/**
* Main controller
*/
class Main
{
    public function home()
    {
        $title = 'Accueil du site';
        View::addTemplate('base', compact('title'));
        View::render('Main.home');
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}

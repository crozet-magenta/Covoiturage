<?php

/**
* Main controller
*/
class MainController
{
    public function home()
    {
        $title = 'Accueil du site';
        $data = Main::test();
        View::addTemplate('base', compact('title'));
        View::render('Main.home', compact('data'));
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}

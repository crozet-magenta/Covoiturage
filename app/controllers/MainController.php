<?php

/**
* Main controller
*/
class MainController
{
    public function home()
    {
        $title = 'Accueil du site';
        View::addTemplate('baseView', compact('title'));
        View::render('main.home');
    }

    public function fallback()
    {
        header("HTTP/1.0 404 Not Found");

        $title = 'Page not found';
        View::addTemplate('baseView', compact('title'));
        View::render('error.404');
    }
}

<?php

/**
* Main controller
*/
class MainController
{
    public function home()
    {
        $title = 'Accueil du site';
        View::render('baseView', compact('title'));
    }

    public function fallback()
    {
        echo 'this page does not exist<br>';
    }
}

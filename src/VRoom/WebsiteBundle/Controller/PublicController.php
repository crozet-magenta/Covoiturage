<?php

namespace VRoom\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends Controller
{

    public function homeAction()
    {
        return $this->render('VRoomWebsiteBundle:Public:home.html.twig');
    }

    public function profileAction()
    {
        return $this->render('VRoomWebsiteBundle:Public:profile.html.twig');
    }
}
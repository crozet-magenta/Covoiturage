<?php

namespace VRoom\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VRoom\WebsiteBundle\Entity\Offer;
use VRoom\WebsiteBundle\Entity\User;
use VRoom\WebsiteBundle\Form\OfferType;

class PublicController extends Controller
{

    public function homeAction()
    {
        return $this->render('VRoomWebsiteBundle:Public:home.html.twig');
    }

    public function profileAction(User $user)
    {
        $repo = $this->getDoctrine()->getRepository('VRoomWebsiteBundle:path');
        $paths = $repo->findByUser($user);
        return $this->render('VRoomWebsiteBundle:Public:profile.html.twig', compact('user', 'path'));
    }

    public function offerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new OfferType(), new Offer());
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $user = $this->get('security.context')->getToken()->getUser();
                $offer = $form->getData();
                $offer->setUser($user);

                $em->persist($offer);
                $em->flush();
                return $this->redirectToRoute('home');
            }
        }
        return $this->render('VRoomWebsiteBundle:Public:registerOffer.html.twig', ['form'=>$form->createView()]);
    }
}
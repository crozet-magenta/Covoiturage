<?php
/**
 * Created by PhpStorm.
 * User: crozet
 * Date: 07/01/15
 * Time: 11:09
 */

namespace VRoom\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use VRoom\WebsiteBundle\Entity\User;
use VRoom\WebsiteBundle\Form\UserType;


class SecurityController extends Controller{
    public function registerAction() {
        $form = $this->createForm(new UserType(), new User());
        $em = $this->getDoctrine()->getManager();


    }

    public function loginAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('home'));
        }

        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('VRoomWebsiteBundle:Public:home.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
} 
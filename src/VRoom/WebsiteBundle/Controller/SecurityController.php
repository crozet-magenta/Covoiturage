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

    public function registerAction(Request $request) {
        $form = $this->createForm(new UserType(), new User(), ['attr'=>['class'=>'main-form']]);
        $form->add('Envoyer', 'submit');
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $user = $form->getData();

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);
                $user->setRegistration(new \DateTime());
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('home');
            }
        }
        return $this->render('VRoomWebsiteBundle:Public:register.html.twig', ['form'=>$form->createView()]);
    }
} 
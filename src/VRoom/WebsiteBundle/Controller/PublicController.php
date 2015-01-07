<?php

namespace VRoom\WebsiteBundle\Controller;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
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
        $latitude = unserialize(
                    file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])
                )['geoplugin_latitude'];
        $longitude = unserialize(
            file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])
        )['geoplugin_longitude'];
        var_dump($latitude, $longitude);
        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('VRoomWebsiteBundle:City', 'c');

        //"SELECT *, 3956 * 2 * ASIN(SQRT(POWER(SIN((43.2965 - abs(latitude)) * pi()/180 / 2),2) + COS(43.29 * pi()/180 ) * COS(abs(latitude) *  pi()/180) * POWER(SIN((5.3698 - longitude) *  pi()/180 / 2), 2) )) as distance FROM cities having distance < 50 ORDER BY `distance`  ASC;"
        $query = $em->createNativeQuery(
                'SELECT *,
                3956 * 2 * ASIN(SQRT(POWER(SIN(( :latitude - abs(c.latitude)) * pi()/180 / 2),2)
                + COS( :latitude * pi()/180 ) * COS(abs(c.latitude) *  pi()/180) * POWER(SIN(( :longitude - c.longitude) *  pi()/180 / 2), 2) ))
                as distance
                FROM cities c
                having distance < 50
                ORDER BY distance  ASC
                LIMIT 25', $rsm
            );
        $query->setParameter('latitude', $latitude)->setParameter('longitude', $longitude);

        $data = $query->getResult();
        return $this->render('VRoomWebsiteBundle:Public:home.html.twig', compact('data'));
    }

    public function profileAction(User $user)
    {
        $repo = $this->getDoctrine()->getRepository('VRoomWebsiteBundle:Offer');
        $hash = md5(strtolower(trim($user->getEmail())));
        $offers = $repo->findByUser($user);
        return $this->render('VRoomWebsiteBundle:Public:profile.html.twig', compact('user', 'offers', 'hash'));
    }

    public function offerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new OfferType(), new Offer(), ['em'=>$em,]);
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
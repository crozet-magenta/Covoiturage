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
        $em = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('VRoomWebsiteBundle:City', 'c');

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
        $latitude = unserialize(
            file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])
        )['geoplugin_latitude'];
        $longitude = unserialize(
            file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])
        )['geoplugin_longitude'];
        $query->setParameter('latitude', $latitude)->setParameter('longitude', $longitude);
        $data = $query->getResult();
        $ids = [];
        foreach ($data as $city) {
            $ids[] = $city->getId();
        }
        $query = $em->getRepository('VRoomWebsiteBundle:Path')->createQueryBuilder('p')
            ->where('p.startCity in (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery();
        $paths = $query->getResult();
        $ids = [];
        foreach ($paths as $path) {
            $ids[] = $path->getId();
        }
        $data = $em->getRepository('VRoomWebsiteBundle:Offer')->findBy(['path' => $ids]);
        return $this->render('VRoomWebsiteBundle:Public:home.html.twig', compact('data'));
    }

    public function profileAction(User $user)
    {
        $repo     = $this->getDoctrine()->getRepository('VRoomWebsiteBundle:Offer');
        $offers   = $repo->findByUser($user);
        $repo     = $this->getDoctrine()->getRepository('VRoomWebsiteBundle:Comment');
        $comments = $repo->findByUser($user);
        return $this->render('VRoomWebsiteBundle:Public:profile.html.twig', compact('user', 'offers', 'comments'));
    }

    public function offerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new OfferType(), new Offer(), ['em'=>$em,'attr'=>['class'=>'main-form']]);
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

    public function offerDetailsAction(Offer $offer)
    {
        return $this->render('VRoomWebsiteBundle:Public:offerDetails.html.twig', compact('offer'));
    }
}
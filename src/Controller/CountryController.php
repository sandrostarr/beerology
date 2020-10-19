<?php


namespace App\Controller;


use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CountryController extends AbstractController
{
    /**
     * @Route("/countries/new")
     */
    public function newAction()
    {
        $country = new Country();
        $country->setName('Ireland'.rand(1, 100));
        $country->setContent('Ireland is a country!');
        $country->setImage('URL123');

        $em = $this->getDoctrine()->getManager();
        $em->persist($country);
        $em->flush();


        return new Response('<html><body>Country created!</body></html>');
    }

    /**
     * @Route("/countries")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('App:Country')
            ->findAll();
        dump($countries);die;
    }

    /**
     * @Route("/countries/{countryName}")
     */
    public function showAction($countryName)
    {
        return new Response('Under the sea!');
    }
}
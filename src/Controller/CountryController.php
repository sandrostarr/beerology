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

        return $this->render('countries/list.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/countries/{countryName}", name="country_show")
     */
    public function showAction($countryName)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('App:Country')
            ->findOneBy(['name' => $countryName]);

        if(!$country) {
            throw $this->createNotFoundException('No country found!');
        }

        return $this->render('countries/show.html.twig', [
            'country' => $country
        ]);


    }
}
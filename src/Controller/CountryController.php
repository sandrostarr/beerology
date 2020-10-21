<?php


namespace App\Controller;


use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CountryController extends AbstractController
{
    /**
     * @Route("/country/new")
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
     * @Route("/country")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('App:Country')
            ->findAll();

        return $this->render('country/list.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/country/{name}", name="country_show")
     */
    public function showAction(Country $country)
    {
        dump($country);
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('App:Country')
            ->findOneBy(['name' => $country->getName()]);

        if(!$country) {
            throw $this->createNotFoundException('No country found!');
        }

        return $this->render('country/show.html.twig', [
            'country' => $country
        ]);


    }
}
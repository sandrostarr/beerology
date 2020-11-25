<?php


namespace App\Controller;


use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/country", name="countries")
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
     * @Route("/country-ajax-sort", name="country_ajax_sort")
     * @param Request $request
     * @return Response
     */
    public function ajaxActionAsc(Request $request)
    {
        $data = $request->getContent();

        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('App:Country')
            ->findAll();

        if($data == 'sortType=sort_alp_desc') {
            $country = $em->getRepository('App:Country')
                ->sortBy('name', 'DESC');
        }
        else if($data == 'sortType=sort_alp_asc') {
            $country = $em->getRepository('App:Country')
                ->sortBy('name', 'ASC');
        } else {
            $country = $em->getRepository('App:Country')
                ->findAll();
        }

        return $this->render('country/_sortlist.html.twig', [
            'countries' => $country
        ]);
    }

    /**
     * @Route("/country-ajax-search", name="country_ajax_search")
     * @param Request $request
     * @return Response
     */
    public function ajaxActionDesc(Request $request)
    {
        //$data = json_decode($request->getContent(), true);
        $data = $request->getContent();

        $search_result = explode('=', $data);
        $search_result = $search_result[1];

        $em = $this->getDoctrine()->getManager();

//        $styles = $em->getRepository('App:Style')
//            ->findBy(['name' => 'Unde quis ex.']);

        $countries = $em->getRepository('App:Country')
            ->findAllLike($search_result);


        return $this->render('country/_sortlist.html.twig', [
            'countries' => $countries
        ]);
    }

    /**
     * @Route("/country/{name}", name="country_show")
     */
    public function showAction(Country $country)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $em->getRepository('App:Country')
            ->findOneBy(['name' => $country->getName()]);
        $countries = $em->getRepository('App:Country')
            ->findAll();

        if(!$country) {
            throw $this->createNotFoundException('No country found!');
        }

        return $this->render('country/show.html.twig', [
            'country' => $country,
            'countries' => $countries
        ]);


    }
}
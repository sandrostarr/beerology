<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('App:Article')
            ->findBy(array(),
                array('id' => 'ASC'),
                5,
                0);
        $styles = $em->getRepository('App:Style')
            ->findBy(array(),
                array('id' => 'DESC'),
                7,
                0);
        $countries = $em->getRepository('App:Country')
            ->findBy(array(),
                array('id' => 'ASC'),
                11,
                0);

        return $this->render('main.html.twig', [
            'articles' => $articles,
            'styles' => $styles,
            'countries' => $countries,
        ]);
    }
}
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
        $last_article = $em->getRepository('App:Article')
            ->findBy(array(),
                array('id' => 'ASC'),
                1,
                0)[0];
        $articles = $em->getRepository('App:Article')
            ->findBy(array(),
                array('id' => 'ASC'),
                4,
                1);
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
            'lastArticle' => $last_article,
            'styles' => $styles,
            'countries' => $countries,
        ]);
    }
}
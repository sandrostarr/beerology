<?php


namespace App\Controller;

use App\Entity\Style;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends  AbstractController
{
    /**
     * @Route("/style")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $styles = $em->getRepository('App:Article')
            ->findAll();
        $style_sections = $em->getRepository('App:ArticleSection')
            ->findAll();

        return $this->render('style/list.html.twig', [
            'styleSections' => $style_sections,
            'styles' => $styles,
        ]);
    }
}
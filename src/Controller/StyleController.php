<?php


namespace App\Controller;

use App\Entity\Style;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends  AbstractController
{
    /**
     * @Route("/style/new")
     */
    public function newAction()
    {
        return new Response('<html><body>New style!</body></html>');
    }

    /**
     * @Route("/style")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $style_sections = $em->getRepository('App:StyleSection')
            ->findAll();

        return $this->render('style/list.html.twig', [
            'styles' => $style_sections,
        ]);
    }
}
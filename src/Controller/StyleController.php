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
        $styles = $em->getRepository('App:Style')
            ->findAll();

        return $this->render('style/list.html.twig', [
            'styleSections' => $style_sections,
            'styles' => $styles,
        ]);
    }

    /**
     * @Route("/style/{name}", name="style_show")
     */
    public function showAction(Style $style)
    {
        $em = $this->getDoctrine()->getManager();
        $style = $em->getRepository('App:Style')
            ->findOneBy(['name' => $style->getName()]);
        $style_section = $style->getStyleSection();


        if(!$style) {
            throw $this->createNotFoundException('No style found!');
        }

        return $this->render('style/show.html.twig', [
            'style' => $style,
            'styleSection' => $style_section
        ]);


    }
}
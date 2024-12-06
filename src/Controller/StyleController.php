<?php


namespace App\Controller;

use App\Entity\Style;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/style", name="styles")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $styles = $em->getRepository('App:Style')
            ->findAllPublished();
        $style_sections = $em->getRepository('App:StyleSection')
            ->findAll();

        return $this->render('style/list.html.twig', [
            'styleSections' => $style_sections,
            'styles' => $styles,
        ]);
    }

    /**
     * @Route("/style-ajax-sort", name="style_ajax_sort")
     * @param Request $request
     * @return Response
     */
    public function ajaxActionAsc(Request $request)
    {
        $data = $request->getContent();

        $em = $this->getDoctrine()->getManager();
        $styles = $em->getRepository('App:Style')
            ->findAll();

        if($data == 'sortType=sort_alp_desc') {
            $style_sections = $em->getRepository('App:StyleSection')
                ->sortBy('name', 'DESC');
        }
        else if($data == 'sortType=sort_alp_asc') {
            $style_sections = $em->getRepository('App:StyleSection')
                ->sortBy('name', 'ASC');
        } else {
            $style_sections = $em->getRepository('App:StyleSection')
                ->findAll();
        }

        return $this->render('style/_sortlist.html.twig', [
            'styleSections' => $style_sections,
            'styles' => $styles,
        ]);
    }

    /**
     * @Route("/style-ajax-search", name="style_ajax_search")
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

        $styles = $em->getRepository('App:Style')
            ->findAllLike($search_result);

        $style_sections = $em->getRepository('App:StyleSection')
            ->findAll();

        return $this->render('style/_searchlist.html.twig', [
            'styleSections' => $style_sections,
            'styles' => $styles
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
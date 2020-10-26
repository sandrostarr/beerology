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
     * @Route("/news")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('App:Article')
            ->findAll();
        $article_sections = $em->getRepository('App:ArticleSection')
            ->findAll();
        $tags = $em->getRepository('App:ArticleSection')
            ->findAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'articleSections' => $article_sections,
            'tags' => $tags,
        ]);
    }
}
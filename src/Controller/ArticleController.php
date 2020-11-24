<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleSection;
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
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else $page = 1;


        $em = $this->getDoctrine()->getManager();
        $articles_count = count($em->getRepository('App:Article')
            ->findAll());
        $article_sections = $em->getRepository('App:ArticleSection')
            ->findAll();
        $tags = $em->getRepository('App:ArticleSection')
            ->findAll();

        $articles_per_page = 10;
        $total_pages = ceil($articles_count / $articles_per_page);
        $shift = $articles_per_page * ($page - 1);

        $articles = $em->getRepository('App:Article')
            ->findBy(
                array(),
                array('views' => 'DESC')
            );

//        $articles = $em->getRepository('App:Article')
//            ->findBy(
//                array(),
//                array(),
//                $articles_per_page,
//                $shift
//            );

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'articleSections' => $article_sections,
            'tags' => $tags,
            'page' => $page,
            'total_pages' => $total_pages,
        ]);
    }

    /**
     * @Route("/news-ajax-sort", name="news_ajax_sort")
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
                ->findAllDesc();
        }
        else if($data == 'sortType=sort_alp_asc') {
            $country = $em->getRepository('App:Country')
                ->findAllAsc();
        } else {
            $country = $em->getRepository('App:Country')
                ->findAll();
        }

        return $this->render('country/_sortlist.html.twig', [
            'countries' => $country
        ]);
    }

    /**
     * @Route("/news/{name}", name="article_show")
     */
    public function showAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('App:Article')
            ->findOneBy(['name' => $article->getName()]);
        $articles = $em->getRepository('App:Article')
            ->findAll();
        $article_sections = $em->getRepository('App:ArticleSection')
            ->findAll();
        $article_section = $article->getArticleSection()->getId();
        $three_articles = $em->getRepository('App:Article')
            ->findBy(['article_section' => $article_section],
                array('views' => 'DESC'),
                3);

        if(!$article) {
            throw $this->createNotFoundException('No article found!');
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'three_articles' => $three_articles,
            'articleSections' => $article_sections,
        ]);

    }

    /**
     * @Route("/news/section/{name}", name="section_show")
     */
    public function showSectionAction(ArticleSection $article_section)
    {
        $em = $this->getDoctrine()->getManager();
        $section = $em->getRepository('App:ArticleSection')
            ->findOneBy(['name' => $article_section->getName()]);
//        $articles = $em->getRepository('App:Article')
//            ->findAll();
        $article_sections = $em->getRepository('App:ArticleSection')
            ->findAll();
//        $article_section = $article->getArticleSection()->getId();
        $articles = $em->getRepository('App:Article')
            ->findBy(['article_section' => $section]);

        if(!$section) {
            throw $this->createNotFoundException('No section found!');
        }

        return $this->render('article/listSection.html.twig', [
            'section' => $section,
            'articles' => $articles,
            'articleSections' => $article_sections,
        ]);

    }
}
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

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('App:Article')
            ->findAllPublished();
        $article_sections = $em->getRepository('App:ArticleSection')
            ->findAll();
        $tags = $em->getRepository('App:ArticleSection')
            ->findAll();

        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else $page = 1;

        $articles_count = count($articles);
        $articles_per_page = 10;
        $total_pages = ceil($articles_count / $articles_per_page);
        $shift = $articles_per_page * ($page - 1);

        $articles = array_slice($articles, $shift, $articles_per_page);

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'articleSections' => $article_sections,
            'tags' => $tags,
            'page' => $page,
            'total_pages' => $total_pages,
            'articles_count' => $articles_count,
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

        if($data == 'sortType=sort_date_desc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('post_date', 'DESC');
        }
        else if($data == 'sortType=sort_date_asc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('post_date', 'ASC');
        }
        else if($data == 'sortType=sort_views_desc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('views', 'DESC');
        }
        else if($data == 'sortType=sort_views_asc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('views', 'ASC');
        }
        else if($data == 'sortType=sort_likes_desc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('likes', 'DESC');
        }
        else if($data == 'sortType=sort_likes_asc') {
            $articles = $em->getRepository('App:Article')
                ->sortBy('likes', 'ASC');
        } else {
            $articles = $em->getRepository('App:Article')
                ->findBy(
                    array(),
                    array('post_date' => 'DESC')
                );
        }

        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else $page = 1;

        $articles_count = count($articles);
        $articles_per_page = 10;
        $total_pages = ceil($articles_count / $articles_per_page);
        $shift = $articles_per_page * ($page - 1);

        $articles = array_slice($articles, $shift, $articles_per_page);

        return $this->render('article/_sortlist.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'total_pages' => $total_pages,
        ]);
    }

    /**
     * @Route("/news-ajax-search", name="news_ajax_search")
     * @param Request $request
     * @return Response
     */
    public function ajaxActionDesc(Request $request)
    {
        $data = $request->getContent();

        $search_result = explode('=', $data);
        $search_result = $search_result[1];

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('App:Article')
            ->findAllLike($search_result);


        return $this->render('article/_sortlist.html.twig', [
            'articles' => $articles
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
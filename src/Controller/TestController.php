<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/genus")
     */
    public function showAction()
    {
        return new Response('Under the sea!');
    }
}
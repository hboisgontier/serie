<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'hello_index')]
    public function index(): Response
    {
        return $this->render('hello/list.html.twig');
        /*return $this->json([
            'message' => 'Hello world!',
        ]);*/
        //return new Response("<!Doctype HTML><html><head></head><body>Hello World!</body></html>");
    }
}

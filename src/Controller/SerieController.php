<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'serie_list')]
    public function index(): Response
    {
        return $this->render('serie/list.html.twig');
    }

    #[Route('/serie/{id}', name: 'serie_detail', requirements:['id' => '\d+'], methods:['GET'])]
    public function detail($id) : Response {
        dump($id);
        return $this->render('serie/detail.html.twig',
            compact("id"));
    }
}

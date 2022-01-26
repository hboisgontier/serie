<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'default')]
    public function default(): Response
    {
        $series = ['Game of thrones', 'Le bureau des légendes'];
        return $this->render('default/list.html.twig',
            [
                "series" => $series,
                "h1" => "Series",
            ]);
    }

    #[Route('/', name: 'index')]
    public function index() : Response {
        $h1 = 'Index';
        $series = ['Lupin'];
        return $this->render('default/list.html.twig',
            compact("h1", "series"));
    }
}

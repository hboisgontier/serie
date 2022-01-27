<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'serie_list')]
    public function index(SerieRepository $repo): Response
    {
        $series = $repo->findAll();
        //$series =$repo->findBy([], ['vote'=>'DESC']);
        return $this->render('serie/list.html.twig', ['series'=>$series]);
    }

    #[Route('/serie/{id}', name: 'serie_detail', requirements:['id' => '\d+'], methods:['GET'])]
    public function detail($id, SerieRepository $repo) : Response {
        $serie = $repo->find($id);
        if(!$serie)
            throw new NotFoundHttpException();
        return $this->render('serie/detail.html.twig',
            compact("id", "serie"));
    }

    #[Route('/serie/add', name: 'serie_add')]
    public function add(EntityManagerInterface $em): Response {
        $serie = new Serie();
        $serie->setName('test serie')
                ->setTmdbId(854)
                ->setDateCreated(new \DateTime());
        $em->persist($serie);
        $em->flush();
        $serie->setOverview('bla bla...');
        $serie->setDateModified(new \DateTime());
        $em->flush();
        $em->remove($serie);
        $em->flush();
        return $this->render('serie/add.html.twig');
    }
}

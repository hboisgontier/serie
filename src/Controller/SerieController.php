<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
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
        //$series = $repo->findBy(['vote'=>8]);
        return $this->render('serie/list.html.twig', ['series'=>$series]);
    }

    #[Route('/serie/good', name: 'serie_good')]
    public function good(SerieRepository $repo): Response {
        $series = $repo->findGoodSeries();
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
    public function add(EntityManagerInterface $em, Request $request): Response {
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());
        $formbuilder = $this->createForm(SerieType::class, $serie);
        // hydrate l'instance avec les données du formulaire
        $formbuilder->handleRequest($request);
        if($formbuilder->isSubmitted()) {
            $em->persist($serie);
            $em->flush();
            // ajout d'un message flash
            $serieName = $serie->getName();
            $this->addFlash('success', "the serie $serieName has been saved");
            // redirection vers une page de simple consutltation pour ne pas refaire
            // le traitement si l'utilisateur actualise la page
            return $this->redirectToRoute('serie_detail', ['id'=>$serie->getId()]);
        }
        $serieform = $formbuilder->createView();
        return $this->render('serie/add.html.twig', ['serieform'=>$serieform]);
    }
}

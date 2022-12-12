<?php

namespace App\Controller;

use App\Entity\Team;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Team::class);
        $team = $repository->findAll();
        return $this->render('page/index.html.twig', compact('team'));
    }
    

    #[Route('/about', name: 'about')]
    public function about(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Team::class);
        $team = $repository->findAll();
        return $this->render('page/about.html.twig', compact('team'));
    }
    

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', []);
    }
}


<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Team;
use App\Form\ContactFormType;
use App\Service\ProductsService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    public function teamTemplate(ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Team::class);
    $team = $repository->findAll();
    return $this->render('partials/_team.html.twig',compact('team'));
    }


    #[Route('/', name: 'index')]
    public function index(ProductsService $productsService, ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Category::class);
        $categories = $repository->findAll();
        
        $products = $productsService->getProducts();
        return $this->render('page/index.html.twig', compact('products', 'categories'));
    }
    
    #[Route('/about', name: 'about')]
    public function about(ManagerRegistry $doctrine): Response
    {
        return $this->render('page/about.html.twig');
    }
    
    

    #[Route('/contact', name: 'contact')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contacto);
            $entityManager->flush();
            return $this->redirectToRoute('index', []);
        }
        return $this->render('page/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}


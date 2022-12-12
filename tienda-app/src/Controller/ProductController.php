<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/brand', name: 'brand')]
    public function brand(): Response
    {
        return $this->render('product/brand.html.twig', []);
    }

    #[Route('/special', name: 'special')]
    public function special(): Response
    {
        return $this->render('product/special.html.twig', []);
    }
}

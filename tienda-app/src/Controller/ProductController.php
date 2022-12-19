<?php

namespace App\Controller;

use App\Service\ProductsService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/brand', name: 'brand')]
    public function index(ProductsService $productsService): Response
    {
        $products = $productsService->getProducts();
        return $this->render('product/brand.html.twig', compact('products'));
    }

    #[Route('/special', name: 'special')]
    public function special(): Response
    {
        return $this->render('product/special.html.twig', []);
    }
}

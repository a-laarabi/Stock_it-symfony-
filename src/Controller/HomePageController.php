<?php

namespace App\Controller;

use App\Repository\ProductsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }
}

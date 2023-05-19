<?php

namespace App\Controller;

use App\Repository\ProductsRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home_page')]
    public function index(ProductsRepository $productsRepository, EntityManagerInterface $entityManager): Response
    {
        return $this->render('home_page/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }
}

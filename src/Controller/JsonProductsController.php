<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JsonProductsController extends AbstractController
{
    #[Route('/json_products', name: 'app_json_products')]
    public function index(ProductsRepository $productsRepository): Response
    {

        $response = new Response();

        $products = $productsRepository->findAll();


        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'picture' => $product->getProductPicture(),
                'name' => $product->getProductName(),
                'quantity' => $product->getQuantity(),
                'price' => $product->getPrice(),
                'createdAt' => $product->getCreatedAt(),
                'description' => $product->getProductDescription(),
                // 'type' => $product->getType(),
            ];
        }

        $Jsom = [
            'length' => count($products),
            'data' => $data,
        ];

        $response->setContent(json_encode($Jsom));

        $response->headers->set('Access-Control-Allow-Origin', '*');

        // return new JsonResponse($Jsom);
        return $response;
    }
}

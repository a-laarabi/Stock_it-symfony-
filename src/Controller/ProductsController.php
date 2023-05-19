<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use App\Service\FileUploader;
use App\Entity\Products;
use App\Form\ProductsType;
use App\Form\EditProductsType;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/products')]
#[IsGranted('ROLE_USER')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'app_products_index', methods: ['GET'])]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }

    #[Route('/ajax', name: 'show_ajax', methods: ['GET', 'POST'])]
    public function ajaxAction(Request $request, ProductsRepository $productsRepository) : Response
    {
        $products = $productsRepository->findAll();

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach($products as $product) {
                $temp = array(
                    'name' => $product->getProductName(),
                    'price' => $product->getPrice(),
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('Ajax/index.html.twig');
        }
    }


    #[Route('/new', name: 'app_products_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductsRepository $productsRepository, FileUploader $fileUploader): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //move the file
            /*
                $Upload_destination = $this->getParameter('Upload_destination');

                $file = $product->getProductPicture();
                $newPictureName = uniqid("IMG-", true) . "." . $file->guessExtension();


                $file->move($Upload_destination, $newPictureName);

                $product->setProductPicture($newPictureName);
            */

            //End of moving the file

            //Using the service to upload the file

                $file = $product->getProductPicture();
                $newPictureName = $fileUploader->uploadFile($file);
                $product->setProductPicture($newPictureName);

            //End of Service

            //Check the date automatically
                $product->setCreatedAt(date("Y-m-d h:i:sa"));
            // End date

            $productsRepository->save($product, true);




            return $this->redirectToRoute('app_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('products/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_products_show', methods: ['GET'])]
    public function show(Products $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_products_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Products $product, ProductsRepository $productsRepository): Response
    {
        $form = $this->createForm(EditProductsType::class, $product);
        // $form = $this->createForm(null, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $productsRepository->save($product, true);

            return $this->redirectToRoute('app_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('products/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_products_delete', methods: ['POST'])]
    public function delete(Request $request, Products $product, ProductsRepository $productsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productsRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_products_index', [], Response::HTTP_SEE_OTHER);
    }
}

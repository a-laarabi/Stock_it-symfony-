<?php

namespace App\Controller;

use App\Repository\StuffRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowStuffController extends AbstractController
{
    #[Route('/show_stuff', name: 'show_stuff')]
    #[IsGranted('ROLE_USER')]

    public function index(StuffRepository $stuffRepository): Response
    {
        return $this->render('show_stuff/index.html.twig', [
            'stuffs' => $stuffRepository->findAll(),
        ]);
    }
}

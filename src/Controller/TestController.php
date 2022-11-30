<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\ClientApi;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(ManagerRegistry $doctrine, Request $request, ClientApi $clientApi): Response
    {
        $movies = $doctrine->getManager()->getRepository(Movie::class)->findBy(['id' => 1]);

        $clientApi->getPosterFromMovie($movies[0]);
        dd($movie);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}

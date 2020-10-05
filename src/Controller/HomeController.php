<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {


    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response {
        $properties = $repository->findLatest();

<<<<<<< Updated upstream
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
=======
<<<<<<< HEAD
    public function index(): Response {
        #return new Response('Mon agence');
        return new Response($this->twig->render('pages/home.html.twig'));
=======
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
>>>>>>> feat/doctrine
>>>>>>> Stashed changes
    }

}
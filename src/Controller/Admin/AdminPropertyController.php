<?php


namespace App\Controller\Admin;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     * @param PropertyRepository $repository
     */
    public function __construct (PropertyRepository $repository) {
        $this->repository = $repository;
    }

    // récupérer l'ensemble de biens

    /**
     * @Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function index(): Response {
            $properties = $this->repository->findAll();
            return $this->render('admin/property/index.html.twig', compact('properties'));
    }


    /**
     * @Route("/admin/{id}", name="admin.property.edit")
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property) {
        return $this->render('admin/property/edit.html.twig', compact('property'));
    }

}
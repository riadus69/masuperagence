<?php


namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     * @param PropertyRepository $repository
     */
    public function __construct (PropertyRepository $repository, EntityManagerInterface $em) {
        $this->repository = $repository;
        $this->em = $em;
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



    //La méthode add
    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request) {
        //die('riad');
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Persist la nouvelle entité elle sera traqué par l'entité manager qui sera en mesure de faire les changements
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }


    //La méthode update
    // je peux aussi utiliser cette route là =>  @Route("/admin/property/{id}", name="admin.property.edit", requirements={"id":"\d+"})
    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property, Request $request) {
        $form = $this->createForm(PropertyType::class, $property);
        //Traiter les datas après avoir cliquer sur btn Edit
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }


    //La méthode remove
    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return Response
     */
    public function delete(Property $property, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succés');
            //return new Response('Suppression');
        }
        return $this->redirectToRoute('admin.property.index');
    }




}
<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name: 'home_vehicule')]
    public function index(VehiculeRepository $vehiculeRepo): Response
    {
        $lesVehicules=$vehiculeRepo->findAll();

        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $lesVehicules,
        ]);
    }

    #[Route('/vehiculeAdd', name: 'add_vehicule')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $vehicule= new Vehicule();
        $formV=$this->createForm(VehiculeType::class, $vehicule);
        $formV->handleRequest($req);

        if($formV->isSubmitted() && $formV->isValid()){
            $entityMana->persist($vehicule);
            $entityMana->flush($vehicule);

            return $this->redirectToRoute('home_vehicule');
        }

        return $this->render('vehicule/insert.html.twig', [
            'formV'=>$formV,
        ]);
    }

    #[Route('/vehiculeDelete/{id}', name: 'delete_vehicule')]
    public function delete($id, EntityManagerInterface $entityMana, VehiculeRepository $vehiculeRepo) :Response
    {
        $vehicule=$vehiculeRepo->find(['id'=>$id]);
        $entityMana->remove($vehicule);
        $entityMana->flush();

        return $this->redirectToRoute('home_vehicule');
    }

    #[Route('/vehiculeEdit/{id}', name: 'edit_vehicule')]
    public function update($id, EntityManagerInterface $entityMana, VehiculeRepository $vehiculeRepo, Request $req) :Response
    {
        $vehicule=$vehiculeRepo->find(['id'=>$id]);
        $editFormV=$this->createForm(VehiculeType::class, $vehicule);
        $editFormV->handleRequest($req);

        if($editFormV->isSubmitted() && $editFormV->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_vehicule');
        }

        return $this->render('vehicule/update.html.twig', [
            'editFormV'=>$editFormV,
        ]);
    }
}

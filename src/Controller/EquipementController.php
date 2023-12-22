<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    #[Route('/equipement', name: 'home_equipement')]
    public function index(EquipementRepository $equipementRepo): Response
    {
        $lesEquipements=$equipementRepo->findAll();

        return $this->render('equipement/index.html.twig', [
            'equipements' => $lesEquipements
        ]);
    }

    #[Route('/equipementAdd', name: 'add_equipement')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $equipement= new Equipement();
        $formE=$this->createForm(EquipementType::class, $equipement);
        $formE->handleRequest($req);

        if($formE->isSubmitted() && $formE->isValid()){
            $entityMana->persist($equipement);
            $entityMana->flush($equipement);

            return $this->redirectToRoute('home_equipement');
        }

        return $this->render('equipement/insert.html.twig', [
            'formE'=>$formE,
        ]);
    }

    #[Route('/equipementDelete/{id}', name: 'delete_equipement')]
    public function delete($id, EntityManagerInterface $entityMana, EquipementRepository $equipementRepo) :Response
    {
        $equipement=$equipementRepo->find(['id'=>$id]);
        $entityMana->remove($equipement);
        $entityMana->flush();

        return $this->redirectToRoute('home_equipement');
    }

    #[Route('/equipementEdit/{id}', name: 'edit_equipement')]
    public function update($id, EntityManagerInterface $entityMana, EquipementRepository $equipementRepo, Request $req) :Response
    {
        $equipement=$equipementRepo->find(['id'=>$id]);
        $editFormE=$this->createForm(EquipementType::class, $equipement);
        $editFormE->handleRequest($req);

        if($editFormE->isSubmitted() && $editFormE->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_equipement');
        }

        return $this->render('equipement/update.html.twig', [
            'editFormE'=>$editFormE
        ]);
    }
}

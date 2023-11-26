<?php

namespace App\Controller;

use App\Entity\Pompier;
use App\Form\PompierType;
use App\Repository\PompierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PompierController extends AbstractController
{
    #[Route('/pompier', name: 'home_pompier')]
    public function index(PompierRepository $pompierRepo): Response
    {
        $lesPompiers=$pompierRepo->findAll();
        return $this->render('pompier/index.html.twig', [
            'pompiers' => $lesPompiers,
        ]);
    }

    #[Route('/pompierAdd', name: 'add_pompier')]
    public function add(Request $req,EntityManagerInterface $entityMana) :Response
    {
        $pompier= new Pompier();
        $formP=$this->createForm(PompierType::class, $pompier);
        $formP->handleRequest($req);

        if($formP->isSubmitted() && $formP->isValid()){
            $entityMana->persist($pompier);
            $entityMana->flush($pompier);
            return $this->redirectToRoute('home_pompier');
        }

        return $this->render('pompier/insert.html.twig', [
           'formP'=>$formP,
        ]);
    }

    #[Route('pompierDelete/{id}', name: 'delete_pompier')]
    public function delete($id, EntityManagerInterface $entitMana, PompierRepository $pompierRepo) : Response
    {
        $pompier=$pompierRepo->find(['id'=>$id]);

        $entitMana->remove($pompier);
        $entitMana->flush();

        return $this->redirectToRoute('home_pompier');
    }

    #[Route('pompierEdit/{id}', name: 'edit_pompier')]
    public function update($id, EntityManagerInterface $entityMana, PompierRepository $pompierRepo, Request $req) : Response
    {
        $pompier=$pompierRepo->find(['id'=>$id]);
        $editFormP=$this->createForm(PompierType::class, $pompier);
        $editFormP->handleRequest($req);

        if($editFormP->isSubmitted() && $editFormP->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_pompier');
        }

        return $this->render('pompier/update.html.twig', [
            'editFormP'=>$editFormP,
        ]);
    }
}

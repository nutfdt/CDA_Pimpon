<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'home_formation')]
    public function index(FormationRepository $formationRepo): Response
    {
        $lesFormations=$formationRepo->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $lesFormations,
        ]);
    }

    #[Route('/formationAdd', name: 'add_formation')]
    public function add(Request $req,EntityManagerInterface $entityMana) :Response
    {
        $formation= new Formation();
        $formF=$this->createForm(FormationType::class, $formation);
        $formF->handleRequest($req);

        if($formF->isSubmitted() && $formF->isValid()){
            $entityMana->persist($formation);
            $entityMana->flush($formation);
            return $this->redirectToRoute('home_formation');
        }

        return $this->render('formation/insert.html.twig', [
           'formF'=>$formF,
        ]);
    }

    #[Route('formationDelete/{id}', name: 'delete_formation')]
    public function delete($id, EntityManagerInterface $entitMana, FormationRepository $formationRepo) : Response
    {
        $formation=$formationRepo->find(['id'=>$id]);

        $entitMana->remove($formation);
        $entitMana->flush();

        return $this->redirectToRoute('home_formation');
    }

    #[Route('formationEdit/{id}', name: 'edit_formation')]
    public function update($id, EntityManagerInterface $entityMana, FormationRepository $formationRepo, Request $req) : Response
    {
        $formation=$formationRepo->find(['id'=>$id]);
        $editFormF=$this->createForm(FormationType::class, $formation);
        $editFormF->handleRequest($req);

        if($editFormF->isSubmitted() && $editFormF->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_formation');
        }

        return $this->render('formation/update.html.twig', [
            'editFormF'=>$editFormF,
        ]);
    }
}

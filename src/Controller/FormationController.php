<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Form\FormerType;
use App\Repository\FormationRepository;
use App\Repository\PompierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('joinFormation/{id}', name: 'join_formation')]
    public function join($id, EntityManagerInterface $entityMana, PompierRepository $pompierRepository,
                         FormationRepository $formationRepo, Request $req) :Response
    {
        $joinFormF=$this->createForm(FormerType::class);
        $joinFormF->handleRequest($req);
        if ($joinFormF->isSubmitted() && $joinFormF->isValid()) {
            $data = $joinFormF->getData();

            // Ajoutez la formation au pompier
            $pompier = $data['pompier'];
            $formation = $formationRepo->find(['id'=>$id]);
            $pompier->addFormation($formation);

            // Enregistrez les changements dans la base de données
            // $entityManager = $this->getDoctrine()->getManager();
            $entityMana->persist($pompier);
            $entityMana->flush();

            // Redirigez l'utilisateur vers la page de succès ou ailleurs
            return $this->redirectToRoute('home_formation');
        }

        return $this->render('formation/join.html.twig', [
            'joinFormF' => $joinFormF,
        ]);
    }
    #[Route('/listeFormationPompier/{id}', name:'listeFormationPompier')]
    public function listePompiersParFormation($id, FormationRepository $formationRepo) : Response
    {
        $formation= $formationRepo->find(['id'=>$id]);
        // Récupérez les pompiers pour la formation spécifiée
        $pompiers = $formation->getPompiers();

        return $this->render('formation/listePompiers.html.twig', [
            'formation' => $formation,
            'pompiers' => $pompiers,
        ]);
    }
    #[Route("/deletePompierFormation/{id}/{idP}", name:"deletePompierFormation")]
    public function deletePompierFormation($id, $idP, FormationRepository $formationRepo, PompierRepository $pompierRepo,EntityManagerInterface $entityManager, Request $req) : Response
    {
        $formation=$formationRepo->find(['id'=>$id]);
        $pompier=$pompierRepo->find(['id'=>$idP]);
        $formation->removePompier($pompier);
        $entityManager->persist($formation);
        $entityManager->flush();
        return $this->redirectToRoute('home_formation');

    }
}

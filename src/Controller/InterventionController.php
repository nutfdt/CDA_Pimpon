<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Form\InterventionType;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterventionController extends AbstractController
{
    #[Route('/intervention', name: 'home_intervention')]
    public function index(InterventionRepository $interventionRepo): Response
    {
        $lesInterventions=$interventionRepo->findAll();
        return $this->render('intervention/index.html.twig', [
            'interventions' => $lesInterventions,
        ]);
    }

    #[Route('/interventionAdd', name: 'add_intervention')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $intervention=new Intervention();
        $formI=$this->createForm(InterventionType::class, $intervention);
        $formI->handleRequest($req);

        if($formI->isSubmitted() && $formI->isValid()){
            $entityMana->persist($intervention);
            $entityMana->flush($intervention);

            return $this->redirectToRoute('home_intervention');
        }

        return $this->render('intervention/insert.html.twig', [
            'formI'=>$formI,
        ]);
    }

    #[Route('/interventionDelete/{id}', name: 'delete_intervention')]
    public function delete($id, EntityManagerInterface $entityMana, InterventionRepository $interventionRepo) : Response
    {
        $intervention=$interventionRepo->find(['id'=>$id]);
        $entityMana->remove($intervention);
        $entityMana->flush();

        return $this->redirectToRoute('home_intervention');
    }

    #[Route('/interventionEdit/{id}', name: 'edit_intervention')]
    public function update($id, EntityManagerInterface $entityMana, InterventionRepository $interventionRepo, Request $req) : Response
    {
        $intervention=$interventionRepo->find(['id'=>$id]);
        $editFormI=$this->createForm(InterventionType::class, $intervention);
        $editFormI->handleRequest($req);

        if($editFormI->isSubmitted() && $editFormI->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_intervention');
        }

        return $this->render('intervention/update.html.twig', [
            'editFormI'=>$editFormI,
        ]);
    }
}

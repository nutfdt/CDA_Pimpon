<?php

namespace App\Controller;

use App\Entity\DetailIntervention;
use App\Form\DetailInterventionType;
use App\Repository\DetailInterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailInterventionController extends AbstractController
{
    #[Route('/detailInter', name: 'home_detailInter')]
    public function index(DetailInterventionRepository $detailInterRepo): Response
    {
        $lesDetailsInter=$detailInterRepo->findAll();

        return $this->render('detail_intervention/index.html.twig', [
            'detailInters' => $lesDetailsInter,
        ]);
    }

    #[Route('/detailInterAdd', name: 'add_detailInter')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $detailInter= new DetailIntervention();
        $formDI=$this->createForm(DetailInterventionType::class, $detailInter);
        $formDI->handleRequest($req);

        if($formDI->isSubmitted() && $formDI->isValid()){
            $entityMana->persist($detailInter);
            $entityMana->flush($detailInter);

            return $this->redirectToRoute('home_detailInter');
        }

        return $this->render('detail_intervention/insert.html.twig', [
            'formDI'=>$formDI,
        ]);
    }

    #[Route('/detailInterDelete', name: 'delete_detailInter')]
    public function delete($id, EntityManagerInterface $entityMana, DetailInterventionRepository $detailInterRepo, Request $req) : Response
    {
        $detailInter=$detailInterRepo->find(['id'=>$id]);
        $entityMana->remove($detailInter);
        $entityMana->flush();

        return $this->redirectToRoute('home_detailInter');
    }

    #[Route('/detailInterEdit/{id}', name: 'edit_detailInter')]
    public function update($id, EntityManagerInterface $entityMana, DetailInterventionRepository $detailInterRepo, Request $req) : Response
    {
        $detailInter=$detailInterRepo->find(['id'=>$id]);
        $editFormDI=$this->createForm(DetailInterventionType::class, $detailInter);
        $editFormDI->handleRequest($req);

        if($editFormDI->isSubmitted() && $editFormDI->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_detailInter');
        }

        return $this->render('detail_intervention/update.html.twig', [
            'editFormDI'=>$editFormDI,
        ]);
    }


}

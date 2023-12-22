<?php

namespace App\Controller;

use App\Entity\Caserne;
use App\Form\CaserneType;
use App\Form\StockerType;
use App\Repository\CaserneRepository;
use App\Repository\EquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CaserneController extends AbstractController
{
    #[Route('/caserne', name: 'home_caserne')]
    public function index(CaserneRepository $caserneRepo): Response
    {
        $lesCasernes=$caserneRepo->findAll();
        return $this->render('caserne/index.html.twig', [
            'casernes' => $lesCasernes,
        ]);
    }

    #[Route('/caserneAdd', name: 'add_caserne')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $caserne= new Caserne();
        $formC=$this->createForm(CaserneType::class, $caserne);
        $formC->handleRequest($req);

        if($formC->isSubmitted() && $formC->isValid()){
            $entityMana->persist($caserne);
            $entityMana->flush($caserne);
            return $this->redirectToRoute('home_caserne');
        }

        return $this->render('caserne/insert.html.twig', [
            'formC'=>$formC,
        ]);
    }

    #[Route('/caserneDelete/{id}', name: 'delete_caserne')]
    public function delete($id, EntityManagerInterface $entityMana, CaserneRepository $caserneRepo) : Response
    {
        $caserne=$caserneRepo->find(['id'=>$id]);

        $entityMana->remove($caserne);
        $entityMana->flush();

        return $this->redirectToRoute('home_caserne');
    }

    #[Route('/caserneEdit/{id}', name: 'edit_caserne')]
    public function update($id, EntityManagerInterface $entityMana, CaserneRepository $caserneRepo, Request $req) : Response
    {
        $caserne=$caserneRepo->find(['id'=>$id]);
        $editFormC=$this->createForm(CaserneType::class, $caserne);
        $editFormC->handleRequest($req);

        if($editFormC->isSubmitted() && $editFormC->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_caserne');
        }
        return $this->render('caserne/update.html.twig', [
            'editFormC'=>$editFormC,
        ]);
    }
    #[Route('/stockerCaserne/{id}', name: 'stockerCaserne')]
    public function stocker($id, EntityManagerInterface $entityMana, EquipementRepository $equipementRepo,
                            CaserneRepository $caserneRepo, Request $req): Response
    {
        $stockerForm=$this->createForm(StockerType::class);
        $stockerForm->handleRequest($req);
        if($stockerForm->isSubmitted() && $stockerForm->isValid()){
            $data=$stockerForm->getData();
            $equipement=$data['equipement'];
            $caserne=$caserneRepo->find(['id'=>$id]);
            $equipement->addCaserne($caserne);

            $entityMana->persist($equipement);
            $entityMana->flush();

            return $this->redirectToRoute('home_caserne');
        }

        return $this->render('caserne/stocker.html.twig', [
            'stockerForm'=>$stockerForm,
        ]);
    }
    #[Route('/listeStock/{id}', name:'listeStock')]
    public function listeStock($id, CaserneRepository $caserneRepo): Response
    {
        $caserne=$caserneRepo->find(['id'=>$id]);

        $equipements=$caserne->getEquipements();

        return $this->render('caserne/listeStock.html.twig', [
            'equipements'=>$equipements,
            'caserne'=>$caserne,
        ]);
    }
    #[Route('/deleteStock/{id}/{idE}', name:'deleteStock')]
    public function deleteStock($id, $idE, CaserneRepository $caserneRepo, EquipementRepository $equipementRepo,
                                EntityManagerInterface $entityMana, Request $req) :Response
    {
        $caserne=$caserneRepo->find(['id'=>$id]);
        $equipement=$equipementRepo->find(['id'=>$idE]);
        $caserne->removeEquipement($equipement);

        $entityMana->persist($caserne);
        $entityMana->flush();
        return $this->redirectToRoute('home_caserne');
    }
}

<?php

namespace App\Controller;

use App\Entity\Companie;
use App\Form\CompanieType;
use App\Repository\CompanieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CompanieController extends AbstractController
{
    #[Route('/companie', name: 'home_companie')]
    public function index(CompanieRepository $companieRepo): Response
    {
        $lesCompanies=$companieRepo->findAll();

        return $this->render('companie/index.html.twig', [
            'companies' => $lesCompanies,
        ]);
    }

    #[Route('/companieAdd', name: 'add_companie')]
    public function add(Request $req,EntityManagerInterface $entityMana) :Response
    {
        $companie= new Companie();
        $formC=$this->createForm(CompanieType::class, $companie);
        $formC->handleRequest($req);

        if($formC->isSubmitted() && $formC->isValid()){
            $entityMana->persist($companie);
            $entityMana->flush($companie);
            return $this->redirectToRoute('home_companie');
        }

        return $this->render('companie/insert.html.twig', [
           'formC'=>$formC,
        ]);
    }

    #[Route('companieDelete/{id}', name: 'delete_companie')]
    public function delete($id, EntityManagerInterface $entitMana, CompanieRepository $companieRepo) : Response
    {
        $companie=$companieRepo->find(['id'=>$id]);

        $entitMana->remove($companie);
        $entitMana->flush();

        return $this->redirectToRoute('home_companie');
    }

    #[Route('companieEdit/{id}', name: 'edit_companie')]
    public function update($id, EntityManagerInterface $entityMana, CompanieRepository $companieRepo, Request $req) : Response
    {
        $companie=$companieRepo->find(['id'=>$id]);
        $editFormC=$this->createForm(CompanieType::class, $companie);
        $editFormC->handleRequest($req);

        if($editFormC->isSubmitted() && $editFormC->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_companie');
        }

        return $this->render('companie/update.html.twig', [
            'editFormC'=>$editFormC,
        ]);
    }
}

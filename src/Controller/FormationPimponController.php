<?php

namespace App\Controller;

use App\Entity\FormationPimpon;
use App\Form\FormationPimponType;
use App\Repository\FormationPimponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationPimponController extends AbstractController
{
    #[Route('/formation-pimpon', name: 'home_formation_pimpon')]
    public function index(FormationPimponRepository $formpimponRepo): Response
    {
        $lesFormationsPimpons=$formpimponRepo->findAll();
        return $this->render('formation_pimpon/index.html.twig', [
            'formationspimpons' => $lesFormationsPimpons,
        ]);
    }

    #[Route('formpimponAdd', name: 'add_formpimpon')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $formationpimpon= new FormationPimpon();
        $formpimpon=$this->createForm(FormationPimponType::class, $formationpimpon);
        $formpimpon->handleRequest($req);

        if($formpimpon->isSubmitted() && $formpimpon->isValid()){
            $entityMana->persist($formationpimpon);
            $entityMana->flush($formationpimpon);

            return $this->redirectToRoute('home_formation_pimpon');
        }

        return $this->render('formation_pimpon/insert.html.twig', [
            'formpimpon'=>$formpimpon,
        ]);
    }

    #[Route('formpimponDelete/{id}', name: 'delete_formpimpon')]
    public function delete($id, EntityManagerInterface $entityMana, FormationPimponRepository $formpimponRepo) : Response
    {
        $formationpimpon=$formpimponRepo->find(['id'=>$id]);
        $entityMana->remove($formationpimpon);
        $entityMana->flush();

        return $this->redirectToRoute('home_formation_pimpon');
    }

    #[Route('formpimponEdit/{id}', name: 'edit_formpimpon')]
    public function update($id, EntityManagerInterface $entityMana, FormationPimponRepository $formpimponRepo, Request $req) : Response
    {
        $formationpimpon=$formpimponRepo->find(['id'=>$id]);
        $editformpimpon=$this->createForm(FormationPimponType::class, $formationpimpon);
        $editformpimpon->handleRequest($req);

        if($editformpimpon->isSubmitted() && $editformpimpon->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_formation_pimpon');
        }

        return $this->render('formation_pimpon/update.html.twig', [
            'editformpimpon'=>$editformpimpon,
        ]);
    }
}

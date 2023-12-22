<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeVType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    #[Route('/type', name: 'home_type')]
    public function index(TypeRepository $typeRepo): Response
    {
        $lesTypes=$typeRepo->findAll();

        return $this->render('type/index.html.twig', [
            'types' => $lesTypes,
        ]);
    }
    #[Route('/typeAdd', name: 'add_type')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $type=new Type();
        $formT=$this->createForm(TypeVType::class, $type);
        $formT->handleRequest($req);

        if($formT->isSubmitted() && $formT->isValid()){
            $entityMana->persist($type);
            $entityMana->flush($type);
            return $this->redirectToRoute('home_type');
        }
        return $this->render('type/insert.html.twig', [
            'formT'=>$formT,
        ]);
    }

    #[Route('/typeDelete/{id}', name:'delete_type')]
    public function delete($id, EntityManagerInterface $entityMana, TypeRepository $typeRepo) :Response
    {
        $type=$typeRepo->find(['id'=>$id]);
        $entityMana->remove($type);
        $entityMana->flush();

        return $this->redirectToRoute('home_type');
    }

    #[Route('/typeEdit/{id}', name: 'edit_type')]
    public function update($id, EntityManagerInterface $entityMana, TypeRepository $typeRepo, Request $req):Response
    {
        $type=$typeRepo->find(['id'=>$id]);
        $editFormT=$this->createForm(TypeVType::class, $type);
        $editFormT->handleRequest($req);
        if($editFormT->isSubmitted() && $editFormT->isValid()){
            $entityMana->flush();
            return $this->redirectToRoute('home_type');
        }
        return $this->render('type/update.html.twig', [
            'editFormT'=>$editFormT,
        ]);
    }
}

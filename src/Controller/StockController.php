<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    #[Route('/stock', name: 'home_stock')]
    public function index(StockRepository $stockRepo): Response
    {
        $lesStocks=$stockRepo->findAll();
        return $this->render('stock/index.html.twig', [
            'stocks' => $lesStocks,
        ]);
    }

    #[Route('stockAdd', name: 'add_stock')]
    public function add(Request $req, EntityManagerInterface $entityMana) : Response
    {
        $stock= new Stock();
        $formS=$this->createForm(StockType::class, $stock);
        $formS->handleRequest($req);

        if($formS->isSubmitted() && $formS->isValid()){
            $entityMana->persist($stock);
            $entityMana->flush($stock);

            return $this->redirectToRoute('home_stock');
        }

        return $this->render('stock/insert.html.twig', [
            'formS'=>$formS,
        ]);
    }

    #[Route('stockDelete/{id}', name: 'delete_stock')]
    public function delete($id, EntityManagerInterface $entityMana, StockRepository $stockRepo) : Response
    {
        $stock=$stockRepo->find(['id'=>$id]);
        $entityMana->remove($stock);
        $entityMana->flush();

        return $this->redirectToRoute('home_stock');
    }

    #[Route('stockEdit/{id}', name: 'edit_stock')]
    public function update($id, EntityManagerInterface $entityMana, StockRepository $stockRepo, Request $req) : Response
    {
        $stock=$stockRepo->find(['id'=>$id]);
        $editFormS=$this->createForm(StockType::class, $stock);
        $editFormS->handleRequest($req);

        if($editFormS->isSubmitted() && $editFormS->isValid()){
            $entityMana->flush();

            return $this->redirectToRoute('home_stock');
        }

        return $this->render('stock/update.html.twig', [
            'editFormS'=>$editFormS,
        ]);
    }
}

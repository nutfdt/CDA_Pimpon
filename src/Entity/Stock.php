<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?Caserne $idCaserne = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    private ?Equipement $idEquipement = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?int $limiteStock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCaserne(): ?Caserne
    {
        return $this->idCaserne;
    }

    public function setIdCaserne(?Caserne $idCaserne): static
    {
        $this->idCaserne = $idCaserne;

        return $this;
    }

    public function getIdEquipement(): ?Equipement
    {
        return $this->idEquipement;
    }

    public function setIdEquipement(?Equipement $idEquipement): static
    {
        $this->idEquipement = $idEquipement;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getLimiteStock(): ?int
    {
        return $this->limiteStock;
    }

    public function setLimiteStock(int $limiteStock): static
    {
        $this->limiteStock = $limiteStock;

        return $this;
    }
}

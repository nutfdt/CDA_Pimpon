<?php

namespace App\Entity;

use App\Repository\DetailInterventionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailInterventionRepository::class)]
class DetailIntervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detailInterventions')]
    private ?Intervention $idIntervention = null;

    #[ORM\ManyToOne(inversedBy: 'detailInterventions')]
    private ?Pompier $idPompier = null;

    #[ORM\ManyToOne(inversedBy: 'detailInterventions')]
    private ?Vehicule $idVehicule = null;

    #[ORM\Column(length: 20)]
    private ?string $heureDebut = null;

    #[ORM\Column(length: 20)]
    private ?string $heureFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIntervention(): ?Intervention
    {
        return $this->idIntervention;
    }

    public function setIdIntervention(?Intervention $idIntervention): static
    {
        $this->idIntervention = $idIntervention;

        return $this;
    }

    public function getIdPompier(): ?Pompier
    {
        return $this->idPompier;
    }

    public function setIdPompier(?Pompier $idPompier): static
    {
        $this->idPompier = $idPompier;

        return $this;
    }

    public function getIdVehicule(): ?Vehicule
    {
        return $this->idVehicule;
    }

    public function setIdVehicule(?Vehicule $idVehicule): static
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?string
    {
        return $this->heureFin;
    }

    public function setHeureFin(string $heureFin): static
    {
        $this->heureFin = $heureFin;

        return $this;
    }
}

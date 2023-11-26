<?php

namespace App\Entity;

use App\Repository\FormationPimponRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationPimponRepository::class)]
class FormationPimpon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'formationspimpons')]
    private ?Pompier $idPompier = null;

    #[ORM\ManyToOne(inversedBy: 'formationspimpons')]
    private ?Formation $idFormation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdFormation(): ?Formation
    {
        return $this->idFormation;
    }

    public function setIdFormation(?Formation $idFormation): static
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}

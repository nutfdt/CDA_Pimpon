<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(length: 70)]
    private ?string $urgence = null;

    #[ORM\Column(length: 150)]
    private ?string $conclusion = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Vehicule $idVehicule = null;

    #[ORM\ManyToMany(targetEntity: Pompier::class, inversedBy: 'interventions')]
    private Collection $pompiers;

    public function __construct()
    {
        $this->pompiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getUrgence(): ?string
    {
        return $this->urgence;
    }

    public function setUrgence(string $urgence): static
    {
        $this->urgence = $urgence;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): static
    {
        $this->conclusion = $conclusion;

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

    /**
     * @return Collection<int, Pompier>
     */
    public function getPompiers(): Collection
    {
        return $this->pompiers;
    }

    public function addPompier(Pompier $pompier): static
    {
        if (!$this->pompiers->contains($pompier)) {
            $this->pompiers->add($pompier);
        }

        return $this;
    }

    public function removePompier(Pompier $pompier): static
    {
        $this->pompiers->removeElement($pompier);

        return $this;
    }
}
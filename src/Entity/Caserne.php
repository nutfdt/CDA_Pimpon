<?php

namespace App\Entity;

use App\Repository\CaserneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaserneRepository::class)]
class Caserne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'casernes')]
    private ?Companie $idCompanie = null;

    #[ORM\OneToMany(mappedBy: 'idCaserne', targetEntity: Pompier::class)]
    private Collection $pompiers;

    #[ORM\OneToMany(mappedBy: 'idCaserne', targetEntity: Vehicule::class)]
    private Collection $vehicules;

    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'casernes')]
    private Collection $equipements;

    public function __construct()
    {
        $this->pompiers = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getIdCompanie(): ?Companie
    {
        return $this->idCompanie;
    }

    public function setIdCompanie(?Companie $idCompanie): static
    {
        $this->idCompanie = $idCompanie;

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
            $pompier->setIdCaserne($this);
        }

        return $this;
    }

    public function removePompier(Pompier $pompier): static
    {
        if ($this->pompiers->removeElement($pompier)) {
            // set the owning side to null (unless already changed)
            if ($pompier->getIdCaserne() === $this) {
                $pompier->setIdCaserne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setIdCaserne($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getIdCaserne() === $this) {
                $vehicule->setIdCaserne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }
}

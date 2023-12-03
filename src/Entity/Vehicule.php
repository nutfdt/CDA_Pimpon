<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    private ?Caserne $idCaserne = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    private ?Type $idType = null;

    #[ORM\OneToMany(mappedBy: 'idVehicule', targetEntity: DetailIntervention::class)]
    private Collection $detailInterventions;

    public function __construct()
    {
        $this->detailInterventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
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

    public function getIdType(): ?Type
    {
        return $this->idType;
    }

    public function setIdType(?Type $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * @return Collection<int, DetailIntervention>
     */
    public function getDetailInterventions(): Collection
    {
        return $this->detailInterventions;
    }

    public function addDetailIntervention(DetailIntervention $detailIntervention): static
    {
        if (!$this->detailInterventions->contains($detailIntervention)) {
            $this->detailInterventions->add($detailIntervention);
            $detailIntervention->setIdVehicule($this);
        }

        return $this;
    }

    public function removeDetailIntervention(DetailIntervention $detailIntervention): static
    {
        if ($this->detailInterventions->removeElement($detailIntervention)) {
            // set the owning side to null (unless already changed)
            if ($detailIntervention->getIdVehicule() === $this) {
                $detailIntervention->setIdVehicule(null);
            }
        }

        return $this;
    }
}

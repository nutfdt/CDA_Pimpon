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

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $urgence = null;

    #[ORM\Column(length: 255)]
    private ?string $conclusion = null;

    #[ORM\OneToMany(mappedBy: 'idIntervention', targetEntity: DetailIntervention::class)]
    private Collection $detailInterventions;

    public function __construct()
    {
        $this->detailInterventions = new ArrayCollection();
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

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
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
            $detailIntervention->setIdIntervention($this);
        }

        return $this;
    }

    public function removeDetailIntervention(DetailIntervention $detailIntervention): static
    {
        if ($this->detailInterventions->removeElement($detailIntervention)) {
            // set the owning side to null (unless already changed)
            if ($detailIntervention->getIdIntervention() === $this) {
                $detailIntervention->setIdIntervention(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PompierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PompierRepository::class)]
class Pompier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\Column(length: 10)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $mdp = null;

    #[ORM\OneToMany(mappedBy: 'idPompier', targetEntity: DetailIntervention::class)]
    private Collection $detailInterventions;

    public function __construct()
    {
        $this->detailInterventions = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

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
            $detailIntervention->setIdPompier($this);
        }

        return $this;
    }

    public function removeDetailIntervention(DetailIntervention $detailIntervention): static
    {
        if ($this->detailInterventions->removeElement($detailIntervention)) {
            // set the owning side to null (unless already changed)
            if ($detailIntervention->getIdPompier() === $this) {
                $detailIntervention->setIdPompier(null);
            }
        }

        return $this;
    }
}

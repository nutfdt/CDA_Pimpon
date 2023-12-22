<?php

namespace App\Entity;

use App\Repository\CompanieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanieRepository::class)]
class Companie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $secteur = null;

    #[ORM\OneToMany(mappedBy: 'idCompanie', targetEntity: Caserne::class)]
    private Collection $casernes;

    public function __construct()
    {
        $this->casernes = new ArrayCollection();
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

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * @return Collection<int, Caserne>
     */
    public function getCasernes(): Collection
    {
        return $this->casernes;
    }

    public function addCaserne(Caserne $caserne): static
    {
        if (!$this->casernes->contains($caserne)) {
            $this->casernes->add($caserne);
            $caserne->setIdCompanie($this);
        }

        return $this;
    }

    public function removeCaserne(Caserne $caserne): static
    {
        if ($this->casernes->removeElement($caserne)) {
            // set the owning side to null (unless already changed)
            if ($caserne->getIdCompanie() === $this) {
                $caserne->setIdCompanie(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column(length: 150)]
    private ?string $libelle = null;

    #[ORM\Column(length: 70)]
    private ?string $nomContact = null;

    #[ORM\Column(length: 10)]
    private ?string $telContact = null;

    #[ORM\ManyToMany(targetEntity: Caserne::class, mappedBy: 'equipements')]
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
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

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): static
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getTelContact(): ?string
    {
        return $this->telContact;
    }

    public function setTelContact(string $telContact): static
    {
        $this->telContact = $telContact;

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
            $caserne->addEquipement($this);
        }

        return $this;
    }

    public function removeCaserne(Caserne $caserne): static
    {
        if ($this->casernes->removeElement($caserne)) {
            $caserne->removeEquipement($this);
        }

        return $this;
    }
}

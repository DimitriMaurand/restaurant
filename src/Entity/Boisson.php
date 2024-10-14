<?php

namespace App\Entity;

use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
class Boisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['boisson'])]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Groups(['boisson'])]
    private ?string $nom = null;

    #[ORM\Column(length: 70, nullable: true)]
    #[Groups(['boisson'])]
    private ?string $appelation = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['boisson'])]
    private ?int $annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['boisson'])]
    private ?string $composition = null;

    #[ORM\Column]
    #[Groups(['boisson'])]
    private ?int $volume = null;

    #[ORM\Column]
    #[Groups(['boisson'])]
    private ?float $prix = null;

    #[ORM\Column]
    #[Groups(['boisson'])]
    private ?bool $estAlcolisee = null;

    #[ORM\Column]
    #[Groups(['boisson'])]
    private ?bool $disponible = null;

    /**
     * @var Collection<int, Allergene>
     */
    #[ORM\ManyToMany(targetEntity: Allergene::class, inversedBy: 'boissons')]
    #[Groups(['boisson'])]
    private Collection $allergenes;

    #[ORM\ManyToOne(inversedBy: 'boissons')]
    private ?CategorieBoisson $categorieBoisson = null;

    public function __construct()
    {
        $this->allergenes = new ArrayCollection();
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

    public function getAppelation(): ?string
    {
        return $this->appelation;
    }

    public function setAppelation(?string $appelation): static
    {
        $this->appelation = $appelation;
        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): static
    {
        $this->annee = $annee;
        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): static
    {
        $this->composition = $composition;
        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): static
    {
        $this->volume = $volume;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function isEstAlcolisee(): ?bool
    {
        return $this->estAlcolisee;
    }

    public function setEstAlcolisee(bool $estAlcolisee): static
    {
        $this->estAlcolisee = $estAlcolisee;
        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): static
    {
        $this->disponible = $disponible;
        return $this;
    }

    /**
     * @return Collection<int, Allergene>
     */
    public function getAllergenes(): Collection
    {
        return $this->allergenes;
    }

    public function addAllergene(Allergene $allergene): static
    {
        if (!$this->allergenes->contains($allergene)) {
            $this->allergenes->add($allergene);
            $allergene->addBoisson($this);
        }
        return $this;
    }

    public function removeAllergene(Allergene $allergene): static
    {
        if ($this->allergenes->removeElement($allergene)) {
            $allergene->removeBoisson($this);
        }
        return $this;
    }

    public function getCategorieBoisson(): ?CategorieBoisson
    {
        return $this->categorieBoisson;
    }

    public function setCategorieBoisson(?CategorieBoisson $categorieBoisson): static
    {
        $this->categorieBoisson = $categorieBoisson;
        return $this;
    }
}

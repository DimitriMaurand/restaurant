<?php

namespace App\Entity;

use App\Repository\AllergeneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AllergeneRepository::class)]
class Allergene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['prod', 'allergene'])]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Groups(['prod', 'allergene'])]
    private ?string $nom = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'allergenes')]
    #[Groups(['allergene'])]
    private Collection $produits;

    /**
     * @var Collection<int, Boisson>
     */
    #[ORM\ManyToMany(targetEntity: Boisson::class, mappedBy: 'allergenes')]
    #[Groups(['allergene'])]
    private Collection $boissons;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->boissons = new ArrayCollection();
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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addAllergene($this);
        }
        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeAllergene($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): static
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons->add($boisson);
            $boisson->addAllergene($this);
        }
        return $this;
    }

    public function removeBoisson(Boisson $boisson): static
    {
        if ($this->boissons->removeElement($boisson)) {
            $boisson->removeAllergene($this);
        }
        return $this;
    }
}

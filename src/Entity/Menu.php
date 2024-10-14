<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['menu'])]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Groups(['menu'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Groups(['menu'])]
    private ?float $prix = null;

    #[ORM\Column]
    #[Groups(['menu'])]
    private ?bool $disponible = null;

    /**
     * @var Collection<int, produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'menus')]
    #[Groups(['menu'])]
    private Collection $menuProduit;

    public function __construct()
    {
        $this->menuProduit = new ArrayCollection();
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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
     * @return Collection<int, produit>
     */
    public function getMenuProduit(): Collection
    {
        return $this->menuProduit;
    }

    public function addMenuProduit(Produit $menuProduit): static
    {
        if (!$this->menuProduit->contains($menuProduit)) {
            $this->menuProduit->add($menuProduit);
        }

        return $this;
    }

    public function removeMenuProduit(Produit $menuProduit): static
    {
        $this->menuProduit->removeElement($menuProduit);

        return $this;
    }
}

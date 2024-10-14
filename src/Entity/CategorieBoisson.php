<?php

namespace App\Entity;

use App\Repository\CategorieBoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieBoissonRepository::class)]
class CategorieBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    /**
     * @var Collection<int, boisson>
     */
    #[ORM\OneToMany(targetEntity: Boisson::class, mappedBy: 'categorieBoisson')]
    private Collection $acategorieboisson;

    public function __construct()
    {
        $this->acategorieboisson = new ArrayCollection();
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
     * @return Collection<int, boisson>
     */
    public function getAcategorieboisson(): Collection
    {
        return $this->acategorieboisson;
    }

    public function addAcategorieboisson(Boisson $acategorieboisson): static
    {
        if (!$this->acategorieboisson->contains($acategorieboisson)) {
            $this->acategorieboisson->add($acategorieboisson);
            $acategorieboisson->setCategorieBoisson($this);
        }

        return $this;
    }

    public function removeAcategorieboisson(Boisson $acategorieboisson): static
    {
        if ($this->acategorieboisson->removeElement($acategorieboisson)) {
            // set the owning side to null (unless already changed)
            if ($acategorieboisson->getCategorieBoisson() === $this) {
                $acategorieboisson->setCategorieBoisson(null);
            }
        }

        return $this;
    }
}

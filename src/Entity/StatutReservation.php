<?php

namespace App\Entity;

use App\Repository\StatutReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutReservationRepository::class)]
class StatutReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Relation>
     */
    #[ORM\OneToMany(targetEntity: Relation::class, mappedBy: 'astatutrelation')]
    private Collection $relations;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'ReservationASatatu')]
    private Collection $reservations;

    public function __construct()
    {
        $this->relations = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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
     * @return Collection<int, Relation>
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(Relation $relation): static
    {
        if (!$this->relations->contains($relation)) {
            $this->relations->add($relation);
            $relation->setAstatutrelation($this);
        }

        return $this;
    }

    public function removeRelation(Relation $relation): static
    {
        if ($this->relations->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getAstatutrelation() === $this) {
                $relation->setAstatutrelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setReservationASatatu($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getReservationASatatu() === $this) {
                $reservation->setReservationASatatu(null);
            }
        }

        return $this;
    }
}

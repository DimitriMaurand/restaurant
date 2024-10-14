<?php

namespace App\Entity;

use App\Repository\RelationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationRepository::class)]
class Relation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'relations')]
    private ?StatutReservation $astatutrelation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAstatutrelation(): ?StatutReservation
    {
        return $this->astatutrelation;
    }

    public function setAstatutrelation(?StatutReservation $astatutrelation): static
    {
        $this->astatutrelation = $astatutrelation;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    private ?string $nom = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: 'Le numéro de téléphone est obligatoire.')]
    #[Assert\Regex(
        pattern: '/^\+?[0-9]{10,15}$/',
        message: 'Le numéro de téléphone doit être valide et contenir entre 10 et 15 chiffres.',
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'L\'email est obligatoire.')]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.',
    )]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnvoi = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $rgpd = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?StatutReservation $ReservationASatatu = null;

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

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): static
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getRgpd(): ?\DateTimeInterface
    {
        return $this->rgpd;
    }

    public function setRgpd(\DateTimeInterface $rgpd): static
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    public function getReservationASatatu(): ?StatutReservation
    {
        return $this->ReservationASatatu;
    }

    public function setReservationASatatu(?StatutReservation $ReservationASatatu): static
    {
        $this->ReservationASatatu = $ReservationASatatu;

        return $this;
    }
}

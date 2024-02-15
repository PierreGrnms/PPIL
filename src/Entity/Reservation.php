<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[Broadcast]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $reserv_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $reserv_fin = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $id_offre = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getReservDebut(): ?\DateTimeInterface
    {
        return $this->reserv_debut;
    }

    public function setReservDebut(\DateTimeInterface $reserv_debut): static
    {
        $this->reserv_debut = $reserv_debut;

        return $this;
    }

    public function getReservFin(): ?\DateTimeInterface
    {
        return $this->reserv_fin;
    }

    public function setReservFin(\DateTimeInterface $reserv_fin): static
    {
        $this->reserv_fin = $reserv_fin;

        return $this;
    }

    public function getIdUser(): ?Utilisateur
    {
        return $this->id_user;
    }

    public function setIdUser(?Utilisateur $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdOffre(): ?Offre
    {
        return $this->id_offre;
    }

    public function setIdOffre(?Offre $id_offre): static
    {
        $this->id_offre = $id_offre;

        return $this;
    }
}

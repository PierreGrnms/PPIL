<?php

namespace App\Entity;

use App\Repository\EmprunteurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EmprunteurRepository::class)]
#[Broadcast]
class Emprunteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'emprunteur', cascade: ['persist', 'remove'])]
    private ?Utilisateur $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
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
}

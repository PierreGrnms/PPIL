<?php

namespace App\Entity;

use App\Repository\PreteurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PreteurRepository::class)]
#[Broadcast]
class Preteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'preteur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_user = null;

    #[ORM\Column(type: Types::BLOB)]
    private $enSommeil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Utilisateur
    {
        return $this->id_user;
    }

    public function setIdUser(Utilisateur $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getEnSommeil()
    {
        return $this->enSommeil;
    }

    public function setEnSommeil($enSommeil): static
    {
        $this->enSommeil = $enSommeil;

        return $this;
    }
}

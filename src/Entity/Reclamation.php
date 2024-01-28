<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
#[Broadcast]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $id_offre = null;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    private ?Utilisateur $id_user_emetteur = null;

    #[ORM\Column(length: 255)]
    private ?string $id_user_receveur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

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

    public function getIdUserEmetteur(): ?Utilisateur
    {
        return $this->id_user_emetteur;
    }

    public function setIdUserEmetteur(?Utilisateur $id_user_emetteur): static
    {
        $this->id_user_emetteur = $id_user_emetteur;

        return $this;
    }

    public function getIdUserReceveur(): ?string
    {
        return $this->id_user_receveur;
    }

    public function setIdUserReceveur(string $id_user_receveur): static
    {
        $this->id_user_receveur = $id_user_receveur;

        return $this;
    }
}

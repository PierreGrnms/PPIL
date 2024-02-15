<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[Broadcast]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_mess = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Conversation $id_conv = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

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

    public function getDateMess(): ?\DateTimeInterface
    {
        return $this->date_mess;
    }

    public function setDateMess(\DateTimeInterface $date_mess): static
    {
        $this->date_mess = $date_mess;

        return $this;
    }

    public function getIdConv(): ?Conversation
    {
        return $this->id_conv;
    }

    public function setIdConv(?Conversation $id_conv): static
    {
        $this->id_conv = $id_conv;

        return $this;
    }
}

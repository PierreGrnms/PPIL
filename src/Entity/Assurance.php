<?php

namespace App\Entity;

use App\Repository\AssuranceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AssuranceRepository::class)]
#[Broadcast]
class Assurance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $num_assu = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_assu = null;

    #[ORM\Column]
    private ?float $prix_assu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAssu(): ?string
    {
        return $this->num_assu;
    }

    public function setNumAssu(string $num_assu): static
    {
        $this->num_assu = $num_assu;

        return $this;
    }

    public function getNomAssu(): ?string
    {
        return $this->nom_assu;
    }

    public function setNomAssu(string $nom_assu): static
    {
        $this->nom_assu = $nom_assu;

        return $this;
    }

    public function getPrixAssu(): ?float
    {
        return $this->prix_assu;
    }

    public function setPrixAssu(float $prix_assu): static
    {
        $this->prix_assu = $prix_assu;

        return $this;
    }
}

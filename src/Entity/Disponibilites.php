<?php

namespace App\Entity;

use App\Repository\DisponibilitesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: DisponibilitesRepository::class)]
#[Broadcast]
class Disponibilites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fin = null;

    #[ORM\ManyToOne(inversedBy: 'disponibilites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $id_offre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): static
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): static
    {
        $this->fin = $fin;

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

    public function find_dispo(DateTimeInterface $creneauDebut, DateTimeInterface $creneauFin): ?Disponibilites
    {
        $qb = $this->createQueryBuilder('d')
            ->where('d.debut = :debut')
            ->andWhere('d.fin = :fin')
            ->setParameter('debut', $creneauDebut)
            ->setParameter('fin', $creneauFin)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }
}

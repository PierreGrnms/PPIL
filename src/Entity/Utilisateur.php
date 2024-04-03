<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse mail est déjà liée à un compte.')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_de_la_rue = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_rue = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_telephone = null;

    #[ORM\Column]
    private ?float $porte_monnaie = null;

    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Offre::class)]
    private Collection $offres;

    #[ORM\Column(nullable: true)]
    private ?bool $enSommeil = null;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @param Collection $offres
     */


    public function addOffres(Offre $offre): void
    {
        $this->offres->add($offre);
        $offre->setIdUser($this);
        /*if (!isset($this->offres)) {
            $this->offres = new ArrayCollection();

        }
        if (!$this->offres->contains($offre)) {
            $this->offres->add($offre);
            $offre->setIdUser($this);
        }*/
    }

    /**
     * @return Collection
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomDeLaRue(): ?string
    {
        return $this->nom_de_la_rue;
    }

    public function setNomDeLaRue(string $nom_de_la_rue): static
    {
        $this->nom_de_la_rue = $nom_de_la_rue;

        return $this;
    }

    public function getNumeroRue(): ?string
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(string $numero_rue): static
    {
        $this->numero_rue = $numero_rue;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodepostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(string $numero_telephone): static
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    public function getPorteMonnaie(): ?float
    {
        return $this->porte_monnaie;
    }

    public function setPorteMonnaie(float $porte_monnaie): static
    {
        $this->porte_monnaie = $porte_monnaie;

        return $this;
    }

    public function isEnSommeil(): ?bool
    {
        return $this->enSommeil;
    }

    public function setEnSommeil(?bool $enSommeil): static
    {
        $this->enSommeil = $enSommeil;

        return $this;
    }
}

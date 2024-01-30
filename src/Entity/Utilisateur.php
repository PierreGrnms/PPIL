<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $id_user = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_de_la_rue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero_telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $porte_monnaie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_de_carte_bancaire = null;

    #[ORM\ManyToOne(inversedBy: 'id_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InscriptionAnnuelle $inscriptionAnnuelle = null;

    #[ORM\OneToMany(mappedBy: 'id_utilisateur', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'id_user_emetteur', targetEntity: Reclamation::class)]
    private Collection $reclamations;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToOne(mappedBy: 'id_user', cascade: ['persist', 'remove'])]
    private ?Preteur $preteur = null;

    #[ORM\OneToOne(mappedBy: 'id_user', cascade: ['persist', 'remove'])]
    private ?Emprunteur $emprunteur = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?string
    {
        return $this->id_user;
    }

    public function setIdUser(string $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->id_user;
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

    public function setNom(?string $nom): static
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

    public function getAdresseMail(): ?string
    {
        return $this->adresse_mail;
    }

    public function setAdresseMail(string $adresse_mail): static
    {
        $this->adresse_mail = $adresse_mail;

        return $this;
    }

    public function getNomDeLaRue(): ?string
    {
        return $this->nom_de_la_rue;
    }

    public function setNomDeLaRue(?string $nom_de_la_rue): static
    {
        $this->nom_de_la_rue = $nom_de_la_rue;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(?string $numero_telephone): static
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    public function getPorteMonnaie(): ?string
    {
        return $this->porte_monnaie;
    }

    public function setPorteMonnaie(?string $porte_monnaie): static
    {
        $this->porte_monnaie = $porte_monnaie;

        return $this;
    }

    public function getCodeDeCarteBancaire(): ?string
    {
        return $this->code_de_carte_bancaire;
    }

    public function setCodeDeCarteBancaire(?string $code_de_carte_bancaire): static
    {
        $this->code_de_carte_bancaire = $code_de_carte_bancaire;

        return $this;
    }

    public function getInscriptionAnnuelle(): ?InscriptionAnnuelle
    {
        return $this->inscriptionAnnuelle;
    }

    public function setInscriptionAnnuelle(?InscriptionAnnuelle $inscriptionAnnuelle): static
    {
        $this->inscriptionAnnuelle = $inscriptionAnnuelle;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdUtilisateur() === $this) {
                $message->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): static
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations->add($reclamation);
            $reclamation->setIdUserEmetteur($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): static
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getIdUserEmetteur() === $this) {
                $reclamation->setIdUserEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setIdUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdUser() === $this) {
                $reservation->setIdUser(null);
            }
        }

        return $this;
    }

    public function getPreteur(): ?Preteur
    {
        return $this->preteur;
    }

    public function setPreteur(Preteur $preteur): static
    {
        // set the owning side of the relation if necessary
        if ($preteur->getIdUser() !== $this) {
            $preteur->setIdUser($this);
        }

        $this->preteur = $preteur;

        return $this;
    }

    public function getEmprunteur(): ?Emprunteur
    {
        return $this->emprunteur;
    }

    public function setEmprunteur(?Emprunteur $emprunteur): static
    {
        // unset the owning side of the relation if necessary
        if ($emprunteur === null && $this->emprunteur !== null) {
            $this->emprunteur->setIdUser(null);
        }

        // set the owning side of the relation if necessary
        if ($emprunteur !== null && $emprunteur->getIdUser() !== $this) {
            $emprunteur->setIdUser($this);
        }

        $this->emprunteur = $emprunteur;

        return $this;
    }
}

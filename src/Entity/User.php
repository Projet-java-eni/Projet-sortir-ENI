<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"username"}, message="Un compte avec ce nom d'utilisateur existe deja !")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $familyName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private ?string $telephone;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isAdmin;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="user", orphanRemoval=true)
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Campus $campus;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="membres")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="organisateur")
     */
    private $sortiesOrganisees;

    /**
     * @ORM\ManyToMany(targetEntity=Sortie::class, mappedBy="participants")
     */
    private $sortiesParticipees;

    /**
     * @ORM\OneToOne(targetEntity=Groupe::class, mappedBy="proprietaire", cascade={"persist", "remove"})
     */
    private ?Groupe $groupesGeres;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->sortiesOrganisees = new ArrayCollection();
        $this->sortiesParticipees = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * Une fonction qui affiche une version lisible
     * de la personne, pour l'afficher sur la liste
     * des gens inscrits à une sortie par exemple
     * @return string
     */
    public function getFriendlyName(): string
    {
        if($this->firstName && $this->familyName)
        {
            return "$this->firstName {$this->familyName[0]}.";
        }

        if(str_contains($this->username, '@'))
        {
            return explode('@', $this->username)[0];
        }

        return $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        //permet de garantir que les utilisateurs auront au moins ce rôle
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // do not touch !!!
        // $this->password = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(?string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
//        return $this->isAdmin;
        return in_array('ROLE_ADMIN', $this->getRoles());
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;
        $roles = $this->getRoles();
        if ($isAdmin === true)
        {
            $roles[] = 'ROLE_ADMIN';
        }
        else
        {
            unset($roles[array_search('ROLE_ADMIN', $roles)]);
        }

        $this->setRoles(array_unique($roles));
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setUser($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getUser() === $this) {
                $photo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addMembre($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeMembre($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSortiesOrganisees(): Collection
    {
        return $this->sortiesOrganisees;
    }

    public function addSortiesOrganisee(Sortie $sortiesOrganisee): self
    {
        if (!$this->sortiesOrganisees->contains($sortiesOrganisee)) {
            $this->sortiesOrganisees[] = $sortiesOrganisee;
            $sortiesOrganisee->setOrganisateur($this);
        }

        return $this;
    }

    public function removeSortiesOrganisee(Sortie $sortiesOrganisee): self
    {
        if ($this->sortiesOrganisees->removeElement($sortiesOrganisee)) {
            // set the owning side to null (unless already changed)
            if ($sortiesOrganisee->getOrganisateur() === $this) {
                $sortiesOrganisee->setOrganisateur(null);
            }
        }

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSortiesParticipees(): Collection
    {
        return $this->sortiesParticipees;
    }

    public function addSortiesParticipee(Sortie $sortiesParticipee): self
    {
        if (!$this->sortiesParticipees->contains($sortiesParticipee)) {
            $this->sortiesParticipees[] = $sortiesParticipee;
            $sortiesParticipee->addParticipant($this);
        }

        return $this;
    }

    public function removeSortiesParticipee(Sortie $sortiesParticipee): self
    {
        if ($this->sortiesParticipees->removeElement($sortiesParticipee)) {
            $sortiesParticipee->removeParticipant($this);
        }

        return $this;
    }

    public function getGroupesGeres(): ?Groupe
    {
        return $this->groupesGeres;
    }

    public function setGroupesGeres(Groupe $groupesGeres): self
    {
        // set the owning side of the relation if necessary
        if ($groupesGeres->getProprietaire() !== $this) {
            $groupesGeres->setProprietaire($this);
        }

        $this->groupesGeres = $groupesGeres;

        return $this;
    }
}

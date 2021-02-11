<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="user", indexes={@ORM\Index(columns={"email","num_intervenant","nom","prenom","portable","fixe","type_du_contrat"}, flags={"fulltext"})})
 */
class User implements UserInterface
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
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumIntervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $Portable;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     */
    private $Fixe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TypeDuContrat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNumIntervenant(): ?string
    {
        return $this->NumIntervenant;
    }

    public function setNumIntervenant(string $NumIntervenant): self
    {
        $this->NumIntervenant = $NumIntervenant;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPortable(): ?string
    {
        return $this->Portable;
    }

    public function setPortable(?string $Portable): self
    {
        $this->Portable = $Portable;

        return $this;
    }

    public function getFixe(): ?string
    {
        return $this->Fixe;
    }

    public function setFixe(?string $Fixe): self
    {
        $this->Fixe = $Fixe;

        return $this;
    }

    public function getTypeDuContrat(): ?string
    {
        return $this->TypeDuContrat;
    }

    public function setTypeDuContrat(string $TypeDuContrat): self
    {
        $this->TypeDuContrat = $TypeDuContrat;

        return $this;
    }
}

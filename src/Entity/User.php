<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Fitness\Bundle\TrainingBundle\Entity\Training;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user", schema="public")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\Email()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string")
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private string $secondName;

    /**
     * @ORM\Column(type="float")
     */
    private float $height;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private int $sex;

    /**
     * @ORM\Column(type="date")
     */
    private string $birthday;

    /**
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @ORM\Column(type="bigint")
     */
    private int $phone;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private int $city;

    /**
     * @ORM\Column(type="string")
     */
    private string $address;

    /**
     * @ORM\Column(type="string", name="post_code")
     */
    private string $postCode;

    /**
     * @ORM\Column(type="datetime", name="create_at")
     */
    private string $createAt;

    /**
     * @ORM\Column(type="datetime", name="update_at")
     */
    private string $updateAt;

    /**
     * @ORM\ManyToMany(targetEntity="Fitness\Bundle\TrainingBundle\Entity\Training", inversedBy="users")
     */
    private Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }

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

    public function addExercises(Training $training)
    {
        $this->trainings->add($training) ;
    }
}

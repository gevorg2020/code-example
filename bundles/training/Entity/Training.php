<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\TrainingRepository")
 * @ORM\Table(name="training", schema="public")
 */
class Training
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="trainings", cascade={"persist"})
     * @ORM\JoinTable(
     *     name="public.user_training",
     *     joinColumns={
     *          @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     }
     * )
     */
    private Collection $users;

    /**
     * @ORM\ManyToMany(targetEntity="Fitness\Bundle\TrainingBundle\Entity\Exercise", inversedBy="trainings")
     */
    private Collection $exercises;

    private UserTraining $userTraining;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param Collection $users
     */
    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    /**
     * @return Collection
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    /**
     * @param Collection $exercises
     */
    public function setExercises(Collection $exercises): void
    {
        $this->exercises = $exercises;
    }

    public function addExercises(Exercise $supplier)
    {
        $this->exercises->add($supplier) ;
    }

    public function addUser(User $user)
    {
        $this->users->add($user) ;
    }

    /**
     * @return UserTraining
     */
    public function getUserTraining(): UserTraining
    {
        return $this->userTraining;
    }

    /**
     * @param UserTraining $userTraining
     */
    public function setUserTraining(UserTraining $userTraining): void
    {
        $this->userTraining = $userTraining;
    }
}

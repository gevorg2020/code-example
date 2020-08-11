<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\UserTrainingRepository")
 * @ORM\Table(name="user_training", schema="public")
 */
class UserTraining
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
    */
    private Training $training;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @ORM\Column(type="integer", name="week_day")
     */
    private int $weekDay;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Training
     */
    public function getTraining(): Training
    {
        return $this->training;
    }

    /**
     * @param Training $training
     */
    public function setTraining(Training $training): void
    {
        $this->training = $training;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    /**
     * @param int $weekDay
     */
    public function setWeekDay(int $weekDay): void
    {
        $this->weekDay = $weekDay;
    }
}

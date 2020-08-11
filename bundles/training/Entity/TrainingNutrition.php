<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="training_nutrition", schema="public")
 */
class TrainingNutrition
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
     * @ORM\OneToOne(targetEntity="Nutrition")
     * @ORM\JoinColumn(name="nutrition_id", referencedColumnName="id")
     */
    private Nutrition $nutrition;

    /**
     * @ORM\Column(type="integer", nullable=false)
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
     * @return Nutrition
     */
    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }

    /**
     * @param Nutrition $nutrition
     */
    public function setNutrition(Nutrition $nutrition): void
    {
        $this->nutrition = $nutrition;
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

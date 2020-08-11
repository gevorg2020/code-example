<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\NutritionRepository")
 * @ORM\Table(name="nutrition", schema="public")
 */
class Nutrition
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
     * @ORM\Column(type="text", nullable=false)
     */
    private string $description;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $mill;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $calories;

    /**
     * @ORM\Column(type="integer")
     */
    private int $protein;

    /**
     * @ORM\OneToMany(targetEntity="Food", mappedBy="nutrition_id")
    */
    private array $foods;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getMill(): int
    {
        return $this->mill;
    }

    /**
     * @param int $mill
     */
    public function setMill(int $mill): void
    {
        $this->mill = $mill;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     */
    public function setCalories(int $calories): void
    {
        $this->calories = $calories;
    }

    /**
     * @return int
     */
    public function getProtein(): int
    {
        return $this->protein;
    }

    /**
     * @param int $protein
     */
    public function setProtein(int $protein): void
    {
        $this->protein = $protein;
    }

    /**
     * @return array
     */
    public function getFoods(): array
    {
        return $this->foods;
    }

    /**
     * @param array $foods
     */
    public function setFoods(array $foods): void
    {
        $this->foods = $foods;
    }
}

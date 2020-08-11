<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class NutritionDto
{
    private string $name;

    private string $description;

    /**
     * @SerializedName("week_day")
     */
    private int $weekDay;

    private int $mill;

    private int $calories;

    private int $protein;

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
}

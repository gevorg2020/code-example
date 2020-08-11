<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TrainingDto
{
    private int $id;

    private string $name;

    private string $description;

    /**
     * @SerializedName("week_day")
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
     * @var ExerciseDto[]
    */
    private array $exercise;

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
     * @return ExerciseDto[]
     */
    public function getExercise(): array
    {
        return $this->exercise;
    }

    /**
     * @param ExerciseDto[] $exercise
     */
    public function setExercise(array $exercise): void
    {
        $this->exercise = $exercise;
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
}

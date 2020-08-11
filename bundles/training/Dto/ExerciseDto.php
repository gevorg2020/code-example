<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Dto;

class ExerciseDto
{
    private int $id;

    private string $name;

    private string $description;

    private string $videoPath = '';

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
     * @return string
     */
    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    /**
     * @param string $videoPath
     */
    public function setVideoPath(string $videoPath): void
    {
        $this->videoPath = $videoPath;
    }
}

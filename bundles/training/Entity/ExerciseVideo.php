<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\ExerciseVideoRepository")
 * @ORM\Table(name="exercise_video", schema="public")
 * @UniqueEntity(
 *      fields={"userTrainingId", "exerciseId"},
 *      message="Video alresy exist."
 * )
 */
class ExerciseVideo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer", nullable=false, name="user_training_id")
     */
    private int $userTrainingId;

    /**
     * @ORM\OneToOne(targetEntity="Exercise")
     * @ORM\JoinColumn(columnDefinition="exercise_id", referencedColumnName="id")
     */
    private Exercise $exercise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $videoPath;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserTrainingId(): int
    {
        return $this->userTrainingId;
    }

    /**
     * @param int $userTrainingId
     */
    public function setUserTrainingId(int $userTrainingId): void
    {
        $this->userTrainingId = $userTrainingId;
    }

    /**
     * @return Exercise
     */
    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    /**
     * @param Exercise $exercise
     */
    public function setExercise(Exercise $exercise): void
    {
        $this->exercise = $exercise;
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

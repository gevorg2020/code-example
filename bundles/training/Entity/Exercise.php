<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\ExerciseRepository")
 * @ORM\Table(name="exercise", schema="public")
 */
class Exercise
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
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=255, name="video_path", nullable=true)
    */
    private string $videoPath;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Fitness\Bundle\TrainingBundle\Entity\Training",
     *     inversedBy="exercises",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="public.training_exercise",
     *     joinColumns={
     *          @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     *     }
     * )
     */
    private Collection $trainings;

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
     * @return Collection
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    /**
     * @param Collection $trainings
     */
    public function setTrainings(Collection $trainings): void
    {
        $this->trainings = $trainings;
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

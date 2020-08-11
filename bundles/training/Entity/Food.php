<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fitness\Bundle\TrainingBundle\Repository\FoodRepository")
 * @ORM\Table(name="food", schema="public")
 */
class Food
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $count;

    /**
     * @ORM\ManyToOne(targetEntity="Nutrition")
     * @ORM\JoinColumn(name="nutrition_id", referencedColumnName="id")
     */
    private int $nutrition;

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
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }
}

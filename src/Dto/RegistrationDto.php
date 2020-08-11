<?php

declare(strict_types=1);

namespace App\Dto;

use Fitness\Bundle\TrainingBundle\Dto\ExerciseDto;

class RegistrationDto
{
    private string $email;

    private string $password;

    private ExerciseDto $exerciseDto;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return ExerciseDto
     */
    public function getExerciseDto(): ExerciseDto
    {
        return $this->exerciseDto;
    }

    /**
     * @param ExerciseDto $exerciseDto
     */
    public function setExerciseDto(ExerciseDto $exerciseDto): void
    {
        $this->exerciseDto = $exerciseDto;
    }
}

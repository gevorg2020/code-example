<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Service;

use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Fitness\Bundle\TrainingBundle\Dto\TrainingDto;
use Fitness\Bundle\TrainingBundle\Entity\UserTraining;
use Fitness\Bundle\TrainingBundle\Repository\UserTrainingRepository;

class TrainingService
{
    private UserTrainingRepository $userTrainingRepository;

    private ExerciseService $exerciseService;

    private UserService $userService;

    public function __construct(
        UserTrainingRepository $userTrainingRepository,
        ExerciseService $exerciseService,
        UserService $userService
    ) {
        $this->userTrainingRepository = $userTrainingRepository;
        $this->exerciseService = $exerciseService;
        $this->userService = $userService;
    }

    /**
     * @return TrainingDto[] array
     *
     * @throws UserNotFoundException
     */
    public function getTrainingsByCurrencyUser(): array
    {
        $user = $this->userService->getCurrencyUser();
        $userTrainings = $this->userTrainingRepository->findByUserId($user->getId());

        $trainingsDto = [];
        foreach ($userTrainings as $userTraining) {
            $trainingsDto[] = $this->createDto($userTraining);
        }

        return $trainingsDto;
    }
    
    /**
     * @param UserTraining $userTraining
     *
     * @return TrainingDto
     */
    private function createDto(UserTraining $userTraining): TrainingDto
    {
        $trainingDto = new TrainingDto();
        $trainingDto->setId($userTraining->getTraining()->getId());
        $trainingDto->setName($userTraining->getTraining()->getName());
        $trainingDto->setDescription($userTraining->getTraining()->getDescription());
        $trainingDto->setWeekDay($userTraining->getWeekDay());

        $exercisesDto = $this->exerciseService->getExercisesDto($userTraining->getTraining()->getExercises());
        $trainingDto->setExercise($exercisesDto);

        return $trainingDto;
    }
}

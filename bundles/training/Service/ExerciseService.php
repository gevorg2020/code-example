<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Service;

use App\Service\UserService;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Fitness\Bundle\TrainingBundle\Dto\ExerciseDto;
use Fitness\Bundle\TrainingBundle\Entity\Exercise;
use Fitness\Bundle\TrainingBundle\Entity\ExerciseVideo;
use Fitness\Bundle\TrainingBundle\Repository\ExerciseRepository;
use Fitness\Bundle\TrainingBundle\Repository\UserTrainingRepository;
use App\Exception\UserNotFoundException;
use InvalidArgumentException;

class ExerciseService
{

    private UserTrainingRepository $userTrainingRepository;

    private UserService $userService;

    private EntityManagerInterface $entityManager;

    private ValidatorInterface $validator;

    private ExerciseRepository $exerciseRepository;

    /**
     * ExerciseService constructor.
     *
     * @param UserTrainingRepository $userTrainingRepository
     * @param UserService            $userService
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     * @param ExerciseRepository     $exerciseRepository
     */
    public function __construct(
        UserTrainingRepository $userTrainingRepository,
        UserService $userService,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        ExerciseRepository $exerciseRepository
    ) {
        $this->userTrainingRepository = $userTrainingRepository;
        $this->userService = $userService;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->exerciseRepository = $exerciseRepository;
    }

    /**
     * @param Collection $exercises
     *
     * @return ExerciseDto[]
     */
    public function getExercisesDto(Collection $exercises): array
    {
        $exercisesDto = [];
        foreach ($exercises as $exercise) {
            $exercisesDto[] = $this->createDto($exercise);
        }

        return $exercisesDto;
    }


    /**
     * @param string $filePath
     * @param int    $trainingId
     * @param int    $exerciseId
     *
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     * @throws EntityNotFoundException
     */
    public function attachFile(string $filePath, int $trainingId, int $exerciseId)
    {
        $user = $this->userService->getCurrencyUser();

        $userTraining = $this->userTrainingRepository->findByUserIdAndTrainingId(
            $user->getId(),
            $trainingId
        );

        $exercise = $this->exerciseRepository->findById($exerciseId);

        $exerciseVideo = new ExerciseVideo();
        $exerciseVideo->setVideoPath($filePath);
        $exerciseVideo->setUserTrainingId($userTraining->getId());
        $exerciseVideo->setExercise($exercise);

        $this->validateExerciseVideo($exerciseVideo);
        $this->entityManager->persist($exerciseVideo);
        $this->entityManager->flush();
    }

    /**
     * @param ExerciseDto $exerciseDto
     */
    public function createExercise(ExerciseDto $exerciseDto): void
    {
        $exercise = new Exercise();
        $exercise->setName($exerciseDto->getName());
        $exercise->setDescription($exerciseDto->getDescription());

        $this->entityManager->persist($exercise);
        $this->entityManager->flush();
    }

    /**
     * @param int $exerciseId
     *
     * @return ExerciseDto
     */
    public function getExerciseById(int $exerciseId): ExerciseDto
    {
        $exercise = $this->exerciseRepository->findById($exerciseId);

        return $this->createDto($exercise);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $exercises = $this->exerciseRepository->findAll();

        $exerciseDto = [];
        foreach ($exercises as $exercise) {
            $exerciseDto[] = $this->createDto($exercise);
        }

        return $exerciseDto;
    }

    /**
     * @param Exercise $exercise
     *
     * @return ExerciseDto
     */
    private function createDto(Exercise $exercise): ExerciseDto
    {
        $exerciseDto = new ExerciseDto();
        $exerciseDto->setId($exercise->getId());
        $exerciseDto->setName($exercise->getName());
        $exerciseDto->setDescription($exercise->getDescription());

        return $exerciseDto;
    }

    /**
     * @param ExerciseVideo $exerciseVideo
     */
    private function validateExerciseVideo(ExerciseVideo $exerciseVideo): void
    {
        $errors = $this->validator->validate($exerciseVideo);
        foreach ($errors as $validationError) {
            throw new InvalidArgumentException((string) $validationError);
        }
    }
}

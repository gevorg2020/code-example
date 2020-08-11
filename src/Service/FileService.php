<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\VideoFileDto;
use App\Exception\UserNotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use InvalidArgumentException;
use Fitness\Bundle\TrainingBundle\Service\ExerciseService;

class FileService
{
    private SluggerInterface $slugger;

    private ParameterBagInterface $params;

    private ValidatorInterface $validator;

    private ExerciseService $exerciseService;

    /**
     * FileService constructor.
     *
     * @param SluggerInterface      $slugger
     * @param ParameterBagInterface $params
     * @param ValidatorInterface    $validator
     * @param ExerciseService       $exerciseService
     */
    public function __construct(
        SluggerInterface $slugger,
        ParameterBagInterface $params,
        ValidatorInterface $validator,
        ExerciseService $exerciseService
    ) {
        $this->slugger = $slugger;
        $this->params = $params;
        $this->validator = $validator;
        $this->exerciseService = $exerciseService;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $trainingId
     * @param int          $exerciseId
     *
     * @return string
     *
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     * @throws EntityNotFoundException
     */
    public function uploadExerciseFile(UploadedFile $uploadedFile, int $trainingId, int $exerciseId): string
    {
        $fileDto = new VideoFileDto();
        $fileDto->setUploadFile($uploadedFile);
        $this->validate($fileDto);

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $this->params->get('upload_videos'),
            $newFilename
        );

        $filePath = $this->params->get('front_video_file_path') . $newFilename;
        $this->exerciseService->attachFile($filePath, $trainingId, $exerciseId);

        return $newFilename;
    }

    /**
     * @param VideoFileDto $fileDto
     *
     * @throws InvalidArgumentException
     */
    private function validate(VideoFileDto $fileDto)
    {
        $validationErrors = $this->validator->validate($fileDto);

        foreach ($validationErrors as $validationError) {
            throw new InvalidArgumentException((string) $validationError);
        }
    }
}

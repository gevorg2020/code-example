<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\UserNotFoundException;
use App\Service\FileService;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Fitness\Bundle\TrainingBundle\Service\ExerciseService;
use InvalidArgumentException;
use Swagger\Annotations as SWG;

/**
 * @Security(name="Bearer")
 * @SWG\Tag(name="Exercise")
 * @Route("exercise")
 */
class ExerciseController
{
    private FileService $fileService;

    private ExerciseService $exerciseService;

    private SerializerInterface $serializer;

    /**
     * ExerciseController constructor.
     *
     * @param FileService         $fileService
     * @param ExerciseService     $exerciseService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        FileService $fileService,
        ExerciseService $exerciseService,
        SerializerInterface $serializer
    ) {
        $this->fileService = $fileService;
        $this->exerciseService = $exerciseService;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param int $exerciseId
     * @param int $trainingId
     *
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     * @throws EntityNotFoundException
     *
     * @return Response
     *
     * @IsGranted("ROLE_USER")
     *
     * @Route("/attach-file/training/{trainingId}/exercise/{exerciseId}", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get trainings for currency users",
     * )
     * @SWG\Parameter(
     *      name="file",
     *      in="formData",
     *      required=true,
     *      type="file",
     *      description="training image"
     * )
     */
    public function actionAttachFile(Request $request, int $trainingId, int $exerciseId): Response
    {
        $uploadedFile = $request->files->get('file');
        try {
            $this->fileService->uploadExerciseFile(
                $uploadedFile,
                $trainingId,
                $exerciseId
            );
        } catch (InvalidArgumentException $e) {
            throw new HttpException(405, $e->getMessage());
        }

        return new Response();
    }
}

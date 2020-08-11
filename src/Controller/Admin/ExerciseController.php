<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Fitness\Bundle\TrainingBundle\Dto\ExerciseDto;
use Fitness\Bundle\TrainingBundle\Service\ExerciseService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Security(name="Bearer")
 * @SWG\Tag(name="Admin Exercise")
 * @Route("exercise")
 */
class ExerciseController
{
    private ExerciseService $exerciseService;

    private SerializerInterface $serializer;

    /**
     * ExerciseController constructor.
     *
     * @param ExerciseService     $exerciseService
     * @param SerializerInterface $serializer
     */
    public function __construct(ExerciseService $exerciseService, SerializerInterface $serializer)
    {
        $this->exerciseService = $exerciseService;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/create", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Create exercise",
     * )
     *
     * @SWG\Parameter(
     *    name="Create exercise",
     *    in="body",
     *    required=true,
     *    @SWG\Schema(
     *        ref=@Model(type=ExerciseDto::class)
     *    )
     * )
     */
    public function actionCreate(Request $request): Response
    {
        /**@var ExerciseDto $exerciseDto*/
        $exerciseDto = $this->serializer->deserialize(
            $request->getContent(),
            ExerciseDto::class,
            JsonEncoder::FORMAT
        );

        $this->exerciseService->createExercise($exerciseDto);

        return new Response();
    }

    /**
     * @return Response
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/get-list", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get exercise by id",
     *     @SWG\Schema(
     *        ref=@Model(type=ExerciseDto::class)
     *     )
     * )
     */
    public function getList(): Response
    {
        $exerciseDto = $this->exerciseService->getList();

        $json = $this->serializer->serialize($exerciseDto, JsonEncoder::FORMAT);

        return new Response($json);
    }

    /**
     * @param int $exerciseId
     *
     * @return Response
     *
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/get-by-id/{exerciseId}", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get exercise by id",
     *     @SWG\Schema(
     *        ref=@Model(type=ExerciseDto::class)
     *     )
     * )
     */
    public function actionGet(int $exerciseId): Response
    {
        $exerciseDto = $this->exerciseService->getExerciseById($exerciseId);

        $json = $this->serializer->serialize($exerciseDto, JsonEncoder::FORMAT);

        return new Response($json);
    }
}

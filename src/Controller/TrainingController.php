<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\UserNotFoundException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Fitness\Bundle\TrainingBundle\Dto\TrainingDto;
use Fitness\Bundle\TrainingBundle\Service\TrainingService;
use Swagger\Annotations as SWG;

/**
 * @Security(name="Bearer")
 * @SWG\Tag(name="Training")
 */
class TrainingController
{
    private TrainingService $trainingService;

    private SerializerInterface $serializer;

    public function __construct(
        TrainingService $trainingService,
        SerializerInterface $serializer
    ) {
        $this->trainingService = $trainingService;
        $this->serializer = $serializer;
    }

    /**
     * @throws UserNotFoundException
     *
     * @param Request $request
     * @return Response
     *
     * @IsGranted("ROLE_USER")
     *
     * @Route("/trainings", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get trainings for currency users",
     *     @SWG\Schema(
     *        ref=@Model(type=TrainingDto::class)
     *     )
     * )
     */
    public function actionGetTrainings(Request $request): Response
    {
        $trainings = $this->trainingService->getTrainingsByCurrencyUser();
        $response = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new Response($response);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Fitness\Bundle\TrainingBundle\Service\TrainingService;

/**
 * @Security(name="Bearer")
 * @SWG\Tag(name="Nutrition")
 */
class NutritionController
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
     * @param Request $request
     *
     * @Route("/get", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get nutrition by user"
     * )
     *
     * @return Response
     */
    public function actionGetNutrition(Request $request): Response
    {
        return new Response();
    }

    /**
     * @param Request $request
     *
     * @Route("/create", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Create nutrition"
     * )
     *
     * @return Response
     */
    public function actionCreateNutrition(Request $request): Response
    {
        return new Response();
    }
}

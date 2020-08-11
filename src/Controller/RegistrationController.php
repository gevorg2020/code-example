<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\RegistrationDto;
use App\Exception\RegistrationException;
use App\Service\RegistrationService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Swagger\Annotations as SWG;

/**
 * @SWG\Tag(name="Registration")
 */
class RegistrationController
{
    private RegistrationService $registrationService;

    private SerializerInterface $serializer;

    /**
     * RegistrationController constructor.
     *
     * @param RegistrationService $registrationService
     * @param SerializerInterface $serializer
     */
    public function __construct(RegistrationService $registrationService, SerializerInterface $serializer)
    {
        $this->registrationService = $registrationService;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws RegistrationException
     *
     * @Route("/registration", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Registration new user"
     * )
     * @SWG\Parameter(
     *    name="Registration",
     *    in="body",
     *    required=true,
     *    @SWG\Schema(
     *        ref=@Model(type=RegistrationDto::class)
     *    )
     * )
    */
    public function actionRegistration(Request $request): Response
    {
        /** @var RegistrationDto $registrationDto */
        $registrationDto = $this->serializer->deserialize(
            $request->getContent(),
            RegistrationDto::class,
            JsonEncoder::FORMAT
        );

        $this->registrationService->registrationUser($registrationDto);

        return new Response();
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Swagger\Annotations as SWG;
use App\Dto\UserDto;

/**
 * @Security(name="Bearer")
 * @SWG\Tag(name="Users")
 */
class UserController
{
    private UserService $userService;

    private SerializerInterface $serializer;

    public function __construct(UserService $userService, SerializerInterface $serializer)
    {
        $this->userService = $userService;
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
     * @Route("/currency-user", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Get currency user",
     *     @SWG\Schema(
     *        ref=@Model(type=UserDto::class)
     *     )
     * )
     *
     */
    public function actionGetCurrencyUser(Request $request): Response
    {
        $user = $this->userService->getCurrencyUserDto();
        $response = $this->serializer->serialize($user, JsonEncoder::FORMAT);

        return new Response($response);
    }
}

<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Service;

use App\Exception\UserNotFoundException;
use App\Service\UserService;

class NutritionService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws UserNotFoundException
     */
    public function getNutritionBuCurrencyUser()
    {
        $user = $this->userService->getCurrencyUser();
    }
}

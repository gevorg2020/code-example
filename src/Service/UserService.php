<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\User;
use App\Enum\RolesEnum;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use InvalidArgumentException;

class UserService
{
    private Security $security;

    /**
     * UserService constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function getCurrencyUser(): User
    {
        $user = $this->security->getUser();
        if ($user === null) {
            throw new UserNotFoundException('User not found');
        }

        if (!($user instanceof User)) {
            throw new InvalidArgumentException('User must be App\Entity\User::class');
        }

        return $user;
    }

    /**
     * @return UserDto
     *
     * @throws UserNotFoundException
     */
    public function getCurrencyUserDto(): UserDto
    {
        $user = $this->getCurrencyUser();

        return $this->createDto($user);
    }

    /**
     * @param User $user
     * @return UserDto
     */
    private function createDto(User $user): UserDto
    {
        $userDto = new UserDto();
        $roles = $this->getRole($user->getRoles());
        $userDto->setEmail($user->getEmail());
        $userDto->setRole($roles);

        return $userDto;
    }

    /**
     * @param string[] $roles
     *
     * @return string
     */
    private function getRole(array $roles): string
    {
        if (in_array(RolesEnum::ROLE_USER, $roles)) {
            return 'user';
        }

        return 'admin';
    }
}

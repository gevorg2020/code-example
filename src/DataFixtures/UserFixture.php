<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    public const FIRST_USER = 'user@admin.ru';

    public const SECOND_USER = 'admin@admin.ru';

    public const USER_LIST = [
        self::FIRST_USER,
        self::SECOND_USER,
    ];

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail(self::FIRST_USER);
        $user->setRoles(['ROLE_USER']);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));

        $this->addReference(self::FIRST_USER, $user);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail(self::SECOND_USER);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));

        $this->addReference(self::SECOND_USER, $user);
        $manager->persist($user);
        $manager->flush();
    }
}

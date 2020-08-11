<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Fitness\Bundle\TrainingBundle\Entity\UserTraining;

class UserTrainingFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $userTraining = new UserTraining();
            $userTraining->setTraining($this->getReference("Training {$i}"));
            $userTraining->setUser($this->getReference(UserFixture::USER_LIST[rand(0, 1)]));
            $userTraining->setWeekDay(rand(1, 7));
            $manager->persist($userTraining);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return class-string[]
     */
    public function getDependencies()
    {
        return [
            TrainingFixture::class,
            UserFixture::class
        ];
    }
}

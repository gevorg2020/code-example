<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Fitness\Bundle\TrainingBundle\Entity\Exercise;
use Fitness\Bundle\TrainingBundle\Entity\Training;

class TrainingFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $exerciseIncrement = 30;
        $exercises = $this->createExerciseFixture($manager, $exerciseIncrement);

        for ($i = 0; $i < 20; $i++) {
            $training = new Training();
            $training->setName("Training {$i}");
            $training->setDescription("Some description about this training........");
            $rand = rand(3, 10);
            $exerciseIdAlreadySet = [];

            for ($te = 0; $te < $rand; $te++) {
                $newItem = $this->getUnsetExercise($exerciseIdAlreadySet, ($exerciseIncrement-1));
                $exerciseIdAlreadySet[] = $newItem;
                $training->addExercises($exercises[$newItem]);
            }

            $this->addReference("Training {$i}", $training);
            $manager->persist($training);
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
            UserFixture::class
        ];
    }

    /**
     * @param ObjectManager $manager
     * @param int $count
     *
     * @return array
     */
    private function createExerciseFixture(ObjectManager $manager, int $count): array
    {
        $exerciseIds = [];
        for ($i = 0; $i < $count; $i++) {
            $exercise = new Exercise();
            $exercise->setName("Exercise $i");
            $exercise->setDescription("Some description about this exercise........");
            $manager->persist($exercise);

            $exerciseIds[] = $exercise;
        }

        $manager->flush();

        return $exerciseIds;
    }

    /**
     * @param array $setExerciseIds
     * @param int $exerciseIncrement
     *
     * @return int
     */
    private function getUnsetExercise(array $setExerciseIds, int $exerciseIncrement): int
    {
        $exerciseId = rand(0, $exerciseIncrement);
        while (in_array($exerciseId, $setExerciseIds)) {
            $exerciseId = rand(0, $exerciseIncrement);
        }

        return $exerciseId;
    }
}

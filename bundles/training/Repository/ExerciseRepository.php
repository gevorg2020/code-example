<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fitness\Bundle\TrainingBundle\Entity\Exercise;
use InvalidArgumentException;

/**
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends EntityRepository
{
    /**
     * @param int $id
     *
     * @return Exercise
     */
    public function findById(int $id): Exercise
    {
        $exercise = $this->find($id);

        if ($exercise === null) {
            throw new InvalidArgumentException(sprintf('Exercise with %b not found', $id));
        }

        return $exercise;
    }
}

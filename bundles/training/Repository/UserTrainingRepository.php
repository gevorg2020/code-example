<?php

declare(strict_types=1);

namespace Fitness\Bundle\TrainingBundle\Repository;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Fitness\Bundle\TrainingBundle\Entity\Training;
use Fitness\Bundle\TrainingBundle\Entity\UserTraining;

class UserTrainingRepository extends EntityRepository
{
    /**
     * @param int $userId
     * @param int $trainingId
     *
     * @return UserTraining
     *
     * @throws NonUniqueResultException
     * @throws EntityNotFoundException
     */
    public function findByUserIdAndTrainingId(int $userId, int $trainingId): UserTraining
    {
        $qb = $this->createQueryBuilder('user_training');

        $query = $qb->select('user_training')
            ->leftJoin('user_training.training', 'training')
            ->leftJoin('user_training.user', 'user')
            ->where($qb->expr()->eq('training.id', ':trainingId'))
            ->andWhere($qb->expr()->eq('user.id', ':userId'))
            ->setParameters([
                ':userId' => $userId,
                ':trainingId' => $trainingId
            ]);

        $userTraining = $query->getQuery()->getOneOrNullResult();

        if ($userTraining === null) {
            throw new EntityNotFoundException(UserTraining::class);
        }

        return $userTraining;
    }

    /**
     * @param int $userId
     * @return UserTraining[]
     */
    public function findByUserId(int $userId): array
    {
        $qb = $this->createQueryBuilder('user_training');

        $query = $qb->select('user_training')
            ->leftJoin('user_training.user', 'u')
            ->where($qb->expr()->eq('u.id', ':userId'))
            ->setParameter(':userId', $userId);

        return $query->getQuery()->execute();
    }
}

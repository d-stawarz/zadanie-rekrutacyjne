<?php

namespace App\Repository;

use App\Entity\CurrentWeatherRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CurrentWeatherRequest>
 *
 * @method CurrentWeatherRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentWeatherRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentWeatherRequest[]    findAll()
 * @method CurrentWeatherRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentWeatherRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentWeatherRequest::class);
    }

    public function save(CurrentWeatherRequest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CurrentWeatherRequest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}

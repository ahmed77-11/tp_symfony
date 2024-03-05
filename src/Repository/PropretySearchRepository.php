<?php

namespace App\Repository;

use App\Entity\PropretySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PropretySearch>
 *
 * @method PropretySearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropretySearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropretySearch[]    findAll()
 * @method PropretySearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropretySearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropretySearch::class);
    }

    //    /**
    //     * @return PropretySearch[] Returns an array of PropretySearch objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PropretySearch
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

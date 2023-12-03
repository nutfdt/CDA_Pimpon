<?php

namespace App\Repository;

use App\Entity\DetailIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailIntervention>
 *
 * @method DetailIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailIntervention[]    findAll()
 * @method DetailIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailInterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailIntervention::class);
    }

//    /**
//     * @return DetailIntervention[] Returns an array of DetailIntervention objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailIntervention
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

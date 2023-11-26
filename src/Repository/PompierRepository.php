<?php

namespace App\Repository;

use App\Entity\Pompier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pompier>
 *
 * @method Pompier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pompier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pompier[]    findAll()
 * @method Pompier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PompierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pompier::class);
    }

//    /**
//     * @return Pompier[] Returns an array of Pompier objects
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

//    public function findOneBySomeField($value): ?Pompier
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

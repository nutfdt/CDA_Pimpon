<?php

namespace App\Repository;

use App\Entity\Caserne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caserne>
 *
 * @method Caserne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caserne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caserne[]    findAll()
 * @method Caserne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaserneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caserne::class);
    }

//    /**
//     * @return Caserne[] Returns an array of Caserne objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Caserne
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

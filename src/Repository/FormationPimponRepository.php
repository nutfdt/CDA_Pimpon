<?php

namespace App\Repository;

use App\Entity\FormationPimpon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormationPimpon>
 *
 * @method FormationPimpon|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationPimpon|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationPimpon[]    findAll()
 * @method FormationPimpon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationPimponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationPimpon::class);
    }

//    /**
//     * @return FormationPimpon[] Returns an array of FormationPimpon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormationPimpon
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Retoucheur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Retoucheur>
 *
 * @method Retoucheur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Retoucheur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Retoucheur[]    findAll()
 * @method Retoucheur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetoucheurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retoucheur::class);
    }

//    /**
//     * @return Retoucheur[] Returns an array of Retoucheur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Retoucheur
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

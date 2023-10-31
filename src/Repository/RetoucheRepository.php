<?php

namespace App\Repository;

use App\Entity\Retouche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Retouche>
 *
 * @method Retouche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Retouche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Retouche[]    findAll()
 * @method Retouche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetoucheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retouche::class);
    }

//    /**
//     * @return Retouche[] Returns an array of Retouche objects
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

//    public function findOneBySomeField($value): ?Retouche
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

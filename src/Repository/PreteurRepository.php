<?php

namespace App\Repository;

use App\Entity\Preteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Preteur>
 *
 * @method Preteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preteur[]    findAll()
 * @method Preteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preteur::class);
    }

//    /**
//     * @return Preteur[] Returns an array of Preteur objects
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

//    public function findOneBySomeField($value): ?Preteur
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

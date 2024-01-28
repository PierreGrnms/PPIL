<?php

namespace App\Repository;

use App\Entity\InscriptionAnnuelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionAnnuelle>
 *
 * @method InscriptionAnnuelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionAnnuelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionAnnuelle[]    findAll()
 * @method InscriptionAnnuelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionAnnuelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionAnnuelle::class);
    }

//    /**
//     * @return InscriptionAnnuelle[] Returns an array of InscriptionAnnuelle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InscriptionAnnuelle
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

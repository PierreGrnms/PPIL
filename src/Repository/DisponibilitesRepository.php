<?php

namespace App\Repository;

use App\Entity\Disponibilites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Disponibilites>
 *
 * @method Disponibilites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disponibilites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disponibilites[]    findAll()
 * @method Disponibilites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisponibilitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disponibilites::class);
    }

//    /**
//     * @return Disponibilites[] Returns an array of Disponibilites objects
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

//    public function findOneBySomeField($value): ?Disponibilites
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
